<?php
/**
 * OS Maps plugin for Craft CMS 3.x
 *
 * Integration with the Ordnance Survey Maps API
 *
 * @link      https://github.com/devkokov
 * @copyright Copyright (c) 2019 Dimitar Kokov
 */

namespace DevKokov\OSMaps\Controllers;

use craft\web\Controller;

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
    protected $allowAnonymous = ['index'];

    /**
     * Handle a request going to our plugin's index action URL
     * e.g.: actions/os-maps/api
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return 'Hello World';
    }
}
