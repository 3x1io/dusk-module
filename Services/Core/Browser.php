<?php

namespace Modules\Dusk\Services\Core;

use Modules\Base\Services\Core\Abstracts\HasMake;
use Modules\Dusk\Services\Components\Log;

class Browser extends HasMake
{
    private ?string $ip = null;
    private ?bool $show = true;
    private ?bool $hasCookies = false;
    private ?Chrome $dusk;

    public function __construct()
    {
        $this->dusk = new Chrome('web');
    }

    public function cookies(): void
    {
        $path = "";
        if ($this->name === 'web') {
            $path = config('services.cookies.path') . '/cookies/web_cookies';
        } else {
            $path = config('services.cookies.path') . '/cookies/mobile_cookies';
        }

        $this->dusk->browserData($path);
    }

    public function agent(): void
    {
        if ($this->name === 'web') {
            $this->dusk->userAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.75 Safari/537.36 Edg/99.0.1150.36a');
        } else {
            $this->dusk->userAgent('Mozilla/5.0 (Linux; Android 10; HD1913) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.79 Mobile Safari/537.36 EdgA/97.0.1072.69');
        }
    }

    public function run(): Chrome | bool
    {
        Log::make("Start Setup Browser For " . $this->name)->save();

        try {
            if (!$this->show) {
                $this->dusk->headless()
                    ->disableGpu()
                    ->noSandbox();
            }


            $this->dusk->windowSize(1200, 1200);
            $this->dusk->ignoreSslErrors();
            $this->dusk->disableExtensions();
            $this->dusk->disableNotifications();
            $this->dusk->disableInfobars();

            if ($this->ip) {
                $this->dusk->proxyServer('socks4://' . $this->ip);
            }

            if ($this->hasCookies) {
                $this->dusk->cookie();
                $this->cookies();
            }

            $this->agent();
            $this->dusk->start();

            return $this->dusk;
        } catch (\Exception $e) {
            $this->dusk->stop();
            Log::make("Browser Setup Error: " . $e)->type('danger')->save();
            return false;
        }
    }

    public function ip($ip): ?static
    {
        $this->ip = $ip;
        return $this;
    }

    public function hasCookies($hasCookies): ?static
    {
        $this->hasCookies = $hasCookies;
        return $this;
    }

    public function show($show): ?static
    {
        $this->show = $show;
        return $this;
    }

    public function stop(): void
    {
        $this->dusk->stop();
    }

    public static function find(string $string, string $start, string $end): string
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}
