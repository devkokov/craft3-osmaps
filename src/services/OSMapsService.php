<?php
/**
 * OS Maps plugin for Craft CMS 3.x
 *
 * Integration with the Ordnance Survey Maps API
 *
 * @link      https://github.com/devkokov
 * @copyright Copyright (c) 2019 Dimitar Kokov
 */

namespace DevKokov\OSMaps\Services;

use craft\base\Component;
use GuzzleHttp\Client;
use Proxy\Adapter\Guzzle\GuzzleAdapter;
use Proxy\Filter\RemoveEncodingFilter;
use Proxy\Proxy;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\ServerRequestFactory;

/**
 * OsMapsService Service
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Dimitar Kokov
 * @package   OSMaps
 * @since     1.0.0
 */
class OSMapsService extends Component
{
    const ROUTE_WMTS = 'https://api2.ordnancesurvey.co.uk/mapping_api/v1/service/wmts';

    /**
     * @param string $toUrl
     * @return ResponseInterface
     */
    public function route($toUrl)
    {
        $guzzle = new Client();
        $proxy = new Proxy(new GuzzleAdapter($guzzle));
        $proxy->filter(new RemoveEncodingFilter());
        $request = ServerRequestFactory::fromGlobals();
        return $proxy->forward($request)->to($toUrl);
    }
}
