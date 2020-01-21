<?php
/**
 * OS Maps plugin for Craft CMS 3.x
 *
 * Integration with the Ordnance Survey Maps API
 *
 * @link      https://github.com/Burnthebook
 * @copyright Copyright (c) 2019 Burnthebook Ltd.
 */

namespace DevKokov\OSMaps\Variables;

use craft\helpers\Template;
use craft\helpers\UrlHelper;
use DevKokov\OSMaps\OSMaps;

/**
 * OS Maps Variable
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Dimitar Kokov
 * @package   OSMaps
 * @since     1.0.0
 */
class OSMapsVariable
{
    public function getApiUrl($params = [], $resource = 'wmts')
    {
        $defaultParams = [
            'wmts' => [
                'service' => 'WMTS',
                'request' => 'GetTile',
                'version' => '1.0.0',
                'layer' => 'Road 27700',
                'style' => 'true',
                'format' => 'image/png',
                'tileMatrixSet' => 'EPSG:27700',
                'tileMatrix' => 'EPSG:27700:{z}',
                'tileRow' => '{y}',
                'tileCol' => '{x}'
            ]
        ];

        $url = UrlHelper::url('actions/os-maps/api/' . $resource, array_merge($defaultParams[$resource], $params));

        // decode dynamic variable placeholders
        $url = str_replace(['%7Bx%7D', '%7By%7D', '%7Bz%7D'], ['{x}', '{y}', '{z}'], $url);

        return Template::raw($url);
    }

    /**
     * @return int
     */
    public function getMaxZoomLevel()
    {
        return OSMaps::$plugin->getSettings()->maxZoomLevel;
    }

    /**
     * @param int $zoomLevel
     * @param string $CRSName
     * @return int
     */
    public function convertGMapsZoomLevel($zoomLevel, $CRSName = 'EPSG:27700')
    {
        $mapping = [
            'EPSG:27700' => [
                0 => 0,
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
                8 => 1,
                9 => 2,
                10 => 3,
                11 => 4,
                12 => 5,
                13 => 6,
                14 => 7,
                15 => 8,
                16 => 9,
                17 => 10,
                18 => 11,
                19 => 12,
                20 => 13,
            ]
        ];

        if (isset($mapping[$CRSName]) && isset($mapping[$CRSName][$zoomLevel])) {
            return $mapping[$CRSName][$zoomLevel];
        }

        return $zoomLevel;
    }
}
