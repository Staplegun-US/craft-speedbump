<?php
namespace staplegun\speedbump;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class SpeedbumpAssets extends AssetBundle
{
    public function init()
    {
        // define the path that your publishable resources live
        $this->sourcePath = '@staplegun/speedbump/resources';

        // define the dependencies
        $this->depends = [
            CpAsset::class,
        ];

        // define the relative path to CSS/JS files that should be registered with the page
        // when this asset bundle is registered
        $this->js = [
            'speedbump.min.js',
        ];

        $this->css = [
            'speedbump.css',
        ];

        parent::init();
    }
}