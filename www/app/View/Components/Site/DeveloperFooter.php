<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;
use Logger;

class DeveloperFooter extends Component
{
    protected $config;
    protected $footerEnabled;
    protected $footerCache;
    protected $footerBaseDir;
    protected $footerFullDir;
    protected $footerFileName;
    protected $footerFile;
    protected $footerApi;
    protected $footerSiteDomain;
    protected $footerSiteLang;
    protected $footerBodyDefault;
    protected $httpClientTimeOut = 60;

    public $footerText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->config = config('site.remote-footer');

        $this->footerEnabled = $this->config['enabled'] ?? null;
        $this->footerCache = $this->config['cache'] ?? false;
        $this->footerApi = $this->config['api'] ?? null;
    }

    public function get($domain, $lang = 'pl')
    {
        Logger::setPrefix('Developer Footer: ');
        if (empty($this->footerEnabled) || empty($this->footerApi)) {
            Logger::log('disabled or no api provided');
            return '';
        }
        $this->footerSiteLang = $lang;
        $this->footerSiteDomain = $domain;

        $this->footerBaseDir = $this->config['basedir'];
        $this->footerFileName = $this->config['filename'];
        $this->footerFullDir = $this->footerBaseDir . DIRECTORY_SEPARATOR . $this->footerSiteLang;
        $this->footerFile = $this->footerFullDir . DIRECTORY_SEPARATOR . $this->footerFileName;

        if ($this->footerCache && file_exists($this->footerFile) && date("d-m-Y", filemtime($this->footerFile)) == date("d-m-Y")) {
            Logger::log('get from cache');
            return file_get_contents($this->footerFile);
            //
        } else {
            Logger::log('get from api');
            $footer = $this->getFromApi();
            file_put_contents($this->footerFile, $footer);
            return $footer;
        }
    }

    public function getFromApi()
    {
        $this->footerBodyDefault = $this->config['body-default'];

        $this->httpClientTimeOut = $this->config['http-timeout'];

        if (!is_dir($this->footerFullDir)) {
            @mkdir($this->footerFullDir, 0755, true);
        }

        $response = \Http::withOptions(
            [
                'allow_redirects' => true,
            ]
        )
        ->withHeaders(
            [
                'Referer' => $this->footerSiteDomain,
            ]
        )
        ->timeout(3)
        ->get(
            $this->footerApi,
            [
                'lang' => $this->footerSiteLang,
                'md5' => 'ccc0704d910edaa245d643367b2409d4',
            ]
        );

        $code = $response->status();
        $body = $response->body();

        if (!$response->ok()) {
            Logger::log('response failed - get default');
            $body = $this->footerBodyDefault;
        } elseif(mb_strlen($body) > 150) {
            Logger::log('response too long - get default');
            $body = $this->footerBodyDefault;
        } elseif (!$body) {
            Logger::log('no body - get default');
            $body = $this->footerBodyDefault;
        }

        Logger::log('response successfull');
        return trim($body);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $domain = str_replace(['http://', 'https://'], '', request()->root());
        $lang = config('app.locale');
        $this->footerText = $this->get($domain, $lang);
        return view('components.site.developer-footer');
    }
}
