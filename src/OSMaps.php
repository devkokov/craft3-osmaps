<?php
/**
 * OS Maps plugin for Craft CMS 3.x
 *
 * Integration with the Ordnance Survey Maps API
 *
 * @link      https://github.com/devkokov
 * @copyright Copyright (c) 2019 Dimitar Kokov
 */

namespace DevKokov\OSMaps;

use DevKokov\OSMaps\Services\OSMapsService as OsMapsServiceService;
use DevKokov\OSMaps\Variables\OSMapsVariable;
use DevKokov\OSMaps\Models\Settings;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * @author    Dimitar Kokov
 * @package   OSMaps
 * @since     1.0.0
 *
 * @property  OSMapsServiceService $osMapsService
 * @property  Settings $settings
 * @method    Settings getSettings()
 */
class OSMaps extends Plugin
{
    /** @var OSMaps */
    public static $plugin;

    public $schemaVersion = '1.0.0';

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Register our variables
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('osMaps', OSMapsVariable::class);
            }
        );

        Craft::info(
            Craft::t(
                'os-maps',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    /**
     * Creates and returns the model used to store the plugin’s settings.
     *
     * @return Settings
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * Returns the rendered settings HTML, which will be inserted into the content
     * block on the settings page.
     *
     * @return string The rendered settings HTML
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'os-maps/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
