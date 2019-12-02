<?php
/**
 * OS Maps plugin for Craft CMS 3.x
 *
 * Integration with the Ordnance Survey Maps API
 *
 * @link      https://github.com/devkokov
 * @copyright Copyright (c) 2019 Dimitar Kokov
 */

namespace DevKokov\OSMaps\controllers;

use craft\web\Controller;
use DevKokov\OSMaps\OSMaps;

/**
 * API Controller
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    Dimitar Kokov
 * @package   OSMaps
 * @since     1.0.0
 */
class ApiController extends Controller
{
    protected $allowAnonymous = true;

    /**
     * Proxy requests going to OS Maps WMTS service
     * e.g.: actions/os-maps/api/wmts
     *
     * @return mixed
     */
    public function actionWmts()
    {
        return OSMaps::$plugin->osMapsService->route(
            OSMaps::$plugin->osMapsService::ROUTE_WMTS
        );
    }
}
