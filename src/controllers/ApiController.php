<?php
/**
 * OS Maps plugin for Craft CMS 3.x
 *
 * Integration with the Ordnance Survey Maps API
 *
 * @link      https://github.com/Burnthebook
 * @copyright Copyright (c) 2019 Burnthebook Ltd.
 */

namespace Burnthebook\OSMaps\controllers;

use Craft;
use craft\web\Controller;
use craft\web\Response;
use Burnthebook\OSMaps\OSMaps;

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
    protected array|int|bool $allowAnonymous = true;

    /**
     * Proxy requests going to OS Maps WMTS service
     * e.g.: actions/os-maps/api/wmts
     *
     * @return string
     */
    public function actionWmts() : ?string
    {
        $response = OSMaps::$plugin->osMapsService->routeWmts();

        $code = $response->getStatusCode();
        Craft::$app->getResponse()->setStatusCode($code);

        if ($code == 200) {
            Craft::$app->getResponse()->format = Response::FORMAT_RAW;
            Craft::$app->getResponse()->getHeaders()->set('content-type', 'image/png');
        }

        return (string) $response->getBody();
    }
}
