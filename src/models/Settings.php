<?php
/**
 * OS Maps plugin for Craft CMS 3.x
 *
 * Integration with the Ordnance Survey Maps API
 *
 * @link      https://github.com/Burnthebook
 * @copyright Copyright (c) 2019 Burnthebook Ltd.
 */

namespace Burnthebook\OSMaps\Models;

use craft\base\Model;

/**
 * OsMaps Settings Model
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Dimitar Kokov
 * @package   OSMaps
 * @since     1.0.0
 */
class Settings extends Model
{
    public $apiKey = '';
    public $maxZoomLevel = 10;

    public function rules()
    {
        return [
            ['apiKey', 'string'],
            ['apiKey', 'default', 'value' => ''],
            ['maxZoomLevel', 'integer'],
            ['maxZoomLevel', 'default', 'value' => 10],
        ];
    }
}
