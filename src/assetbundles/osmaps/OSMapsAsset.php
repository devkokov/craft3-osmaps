<?php
/**
 * OS Maps plugin for Craft CMS 3.x
 *
 * Integration with the Ordnance Survey Maps API
 *
 * @link      https://github.com/devkokov
 * @copyright Copyright (c) 2019 Dimitar Kokov
 */

namespace DevKokov\OSMaps\AssetBundles\OSMaps;

use craft\web\AssetBundle;

/**
 * OsMapsAsset AssetBundle
 *
 * http://www.yiiframework.com/doc-2.0/guide-structure-assets.html
 *
 * @author    Dimitar Kokov
 * @package   OSMaps
 * @since     1.0.0
 */
class OSMapsAsset extends AssetBundle
{
    /**
     * Initializes the bundle.
     */
    public function init()
    {
        $this->sourcePath = "@devkokov/osmaps/assetbundles/osmaps";

        $this->js = [
            'js/leaflet.js'
        ];

        $this->css = [
            'css/leaflet.css'
        ];

        parent::init();
    }
}
