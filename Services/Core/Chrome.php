<?php

namespace Modules\Dusk\Services\Core;

use Illuminate\Support\Collection;
use Laravel\Dusk\Chrome\SupportsChrome;
use Facebook\WebDriver\WebDriverPlatform;
use Laravel\Dusk\Concerns\ProvidesBrowser;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\WebDriverBrowserType;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;

class Chrome
{
    use ProvidesBrowser,
        SupportsChrome;

    public $getDriver;

    /**
     * Request caller name.
     *
     * @var string
     */
    protected $callerName;

    /**
     * A list of remote web driver arguments.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $arguments;

    /**
     * Set the maximum time of a request to remote WebDriver server.
     *
     * @var int
     */
    protected $requestTimeout = 50000;

    /**
     * Set timeout for the connect phase to remote WebDriver server in ms.
     *
     * @var int
     */
    protected $connectTimeout = 50000;

    /**
     * Initialises the dusk browser and starts the chrome driver.
     *
     * @return void
     */
    public function __construct(string $callerName)
    {
        $this->callerName = $callerName;
        $this->arguments = Collection::make();
    }

    /**
     * Start the browser.
     *
     * @return $this
     */
    public function start()
    {
        static::startChromeDriver();

        return $this;
    }

    /**
     * Stop the browser.
     *
     * @return $this
     */
    public function stop()
    {
        try {
            $this->closeAll();
        } catch (\Exception $e) {
            throw $e;
        } finally {
            static::stopChromeDriver();

            return $this;
        }
    }

    /**
     * Set the request timeout.
     *
     * @return $this
     */
    public function setRequestTimeout(int $timeout)
    {
        $this->requestTimeout = $timeout;

        return $this;
    }

    /**
     * Set the connect timeout.
     *
     * @return $this
     */
    public function setConnectTimeout(int $timeout)
    {
        $this->connectTimeout = $timeout;

        return $this;
    }

    /**
     * Run the browser in headless mode.
     *
     * @return $this
     */
    public function headless()
    {
        return $this->addArgument('--headless');
    }

    public function remote()
    {
        return $this->addArgument('--remote-debugging-port=9222');
    }

    public function cookie()
    {
        return $this->addArgument('--enable-file-cookies');
    }

    /**
     * Disable the browser using gpu.
     *
     * @return $this
     */
    public function disableGpu()
    {
        return $this->addArgument('--disable-gpu');
    }

    /**
     * Disable the sandbox.
     *
     * @return $this
     */
    public function noSandbox()
    {
        return $this->addArgument('--no-sandbox');
    }

    /**
     * Disables the use of a zygote process for forking child processes.
     *
     * @return $this
     */
    public function noZygote()
    {
        return $this->noSandbox()->addArgument('--no-zygote');
    }

    /**
     * Ignore SSL certificate error messages.
     *
     * @return $this
     */
    public function ignoreSslErrors()
    {
        return $this->addArgument('--ignore-certificate-errors');
    }

    /**
     * Set the initial browser window size.
     *
     * @param $width the browser width in pixels
     * @param $height the browser height in pixels
     *
     * @return $this
     */
    public function windowSize(int $width, int $height)
    {
        return $this->addArgument('--window-size=' . $width . ',' . $height);
    }

    /**
     * Set the user agent.
     *
     * @param $useragent the user agent to use
     *
     * @return $this
     */
    public function proxyServer(string $url)
    {
        return $this->addArgument('--proxy-server=' . $url);
    }

    public function userAgent(string $useragent)
    {
        return $this->addArgument('--user-agent=' . $useragent);
    }

    public function disableExtensions()
    {
        return $this->addArgument('--disable-extensions');
    }

    public function disableNotifications()
    {
        return $this->addArgument('--disable-notifications');
    }

    public function disableInfobars()
    {
        return $this->addArgument('disable-infobars');
    }


    public function browserData($path)
    {
        return $this->addArgument('--user-data-dir=' . $path);
    }

    public function setProfile($id)
    {
        return $this->addArgument('--profile-directory=Profile ' . $id);
    }

    /**
     * Add a browser option.
     *
     * @return $this
     */
    protected function addArgument(string $argument)
    {
        if ($this->arguments->contains($argument)) {
            return;
        }

        $this->arguments->push($argument);

        return $this;
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    public function driver()
    {
        $options = (new ChromeOptions())->addArguments($this->arguments->toArray());

        $this->getDriver =  RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                $options
            ),
            $this->connectTimeout,
            $this->requestTimeout
        );

        return $this->getDriver;
    }

    /**
     * Get the browser caller name.
     *
     * @return string
     */
    protected function getCallerName()
    {
        return \str_replace('\\', '_', \get_class($this)) . '_' . $this->callerName;
    }
}
