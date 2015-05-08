<?php namespace DancerDeck\Services\View;

class AssetManager
{
    // Assets to load
    public $js_assets = [];
    public $css_assets = [];

    // Public paths
    public $javascript_url = '/js/';
    public $css_url = '/css/';
    public $image_url = '/images/';

    public function __construct()
    {
        // Set asset cdn URL if in production mode
        /*
        if(\App::environment('production'))
        {
            $this->javascript_url = \Config::get('cdn.javascript') . 'assets/js/';
            $this->css_url = \Config::get('cdn.css') . 'assets/css/';
            $this->image_url = \Config::get('cdn.images') . 'assets/images/';
        }
        */
    }

    public function withJs($js)
    {
        $this->js_assets[] = self::makeAssetUrl($js, $this->javascript_url);

        return $this;
    }

    public function withCss($css)
    {
        $this->css_assets[] = self::makeAssetUrl($css, $this->css_url);

        return $this;
    }

    private static function makeAssetUrl($asset, $url)
    {
        // Detect if this is local or remote asset
        if( ! self::isRemoteUrl($asset))
        {
            return $url . self::getAssetFileName($asset);
        }

        return $asset;
    }

    public function getJs()
    {
        return $this->js_assets;
    }

    public function getCss()
    {
        return $this->css_assets;
    }

    public function getImageUrl($image)
    {
        return $this->image_url . $image;
    }

    public static function isRemoteUrl($url)
    {
        return preg_match('/^(https?:)?\/\/(.+)/', $url) === 1;
    }

    // Get name of the compiled asset
    public static function getAssetFileName($asset)
    {
        return $asset;

        // Only need to alter the name on production
        if( ! \App::environment('production')) return $asset;

        $name = \Config::get('asset_names.' . md5($asset));

        return $name ?: $asset;
    }
}
