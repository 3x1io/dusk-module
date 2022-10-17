<?php

namespace Modules\Dusk\Tests;

use Modules\Base\Services\Core\Abstracts\HasMake;
use Modules\Dusk\Services\Components\Log;
use Modules\Dusk\Services\Core\Browser;
use Modules\Dusk\Services\Core\Chrome;

class UserLogin extends HasMake
{
    private Chrome $dusk;

    public function __construct()
    {
        $this->dusk = Browser::make('web')->run();
    }

    public function run(): void
    {
        try {
            $this->dusk->browse(function ($browser) {
                //Sad Empty Inputs :(
                $browser->visit(url('login'));
                $browser->pause(2000);
                $browser->click('#app > div > div > div > div > div:nth-child(3) > form > button');
                $browser->pause(2000);
                Log::make("Login Empty Validation and pass")->save();

                //Sad Bad Value Email :(
                $browser->visit(url('login'));
                $browser->pause(2000);
                $browser->type('#email', 'admin.....32');
                $browser->pause(2000);
                $browser->type('#password', 'QTS@2022');
                $browser->pause(2000);
                $browser->click('#app > div > div > div > div > div:nth-child(3) > form > button');
                $browser->pause(2000);
                Log::make("Login Bad Value Email and pass")->save();

                //Sad Bad Value Email/Password :(
                $browser->visit(url('login'));
                $browser->pause(2000);
                $browser->type('#email', 'admin@admin.io');
                $browser->pause(2000);
                $browser->type('#password', 'QTS@2021');
                $browser->pause(2000);
                $browser->click('#app > div > div > div > div > div:nth-child(3) > form > button');
                $browser->pause(2000);
                Log::make("Login Bad Value Email/Password and pass")->save();

                //Happy :)
                $browser->visit(url('login'));
                $browser->pause(2000);
                $browser->type('#email', 'admin@admin.com');
                $browser->pause(2000);
                $browser->type('#password', 'QTS@2022');
                $browser->pause(2000);
                $browser->click('#app > div > div > div > div > div:nth-child(3) > form > button');
                $browser->pause(2000);
                Log::make("Login Success and pass")->save();
            });
        } catch (\Exception $e) {
            if (!strpos($e, 'file_put_contents')) {
                Log::make("Login Failed Error: " . $e)->type('danger')->save();
            }
        }

        $this->dusk->stop();
    }
}
