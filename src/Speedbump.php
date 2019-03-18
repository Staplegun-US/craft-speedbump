<?php
/**
 * Speedbump plugin for Craft CMS 3.x
 *
 * Alerts users when navigating to any un-whitelisted links.
 *
 * @link      https://staplegun.us
 * @copyright Copyright (c) 2019 STAPLEGUN
 */

namespace staplegun\speedbump;

use staplegun\speedbump\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\View;

use yii\base\Event;

/**
 * Craft plugins are very much like little applications in and of themselves. We’ve made
 * it as simple as we can, but the training wheels are off. A little prior knowledge is
 * going to be required to write a plugin.
 *
 * For the purposes of the plugin docs, we’re going to assume that you know PHP and SQL,
 * as well as some semi-advanced concepts like object-oriented programming and PHP namespaces.
 *
 * https://craftcms.com/docs/plugins/introduction
 *
 * @author    STAPLEGUN
 * @package   Speedbump
 * @since     0.0.3
 *
 */
class Speedbump extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * Speedbump::$plugin
     *
     * @var Speedbump
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * To execute your plugin’s migrations, you’ll need to increase its schema version.
     *
     * @var string
     */
    public $schemaVersion = '0.0.3';

    // Public Methods
    // =========================================================================

    /**
     * Set our $plugin static property to this class so that it can be accessed via
     * Speedbump::$plugin
     *
     * Called after the plugin class is instantiated; do any one-time initialization
     * here such as hooks and events.
     *
     * If you have a '/vendor/autoload.php' file, it will be loaded for you automatically;
     * you do not need to load it in your init() method.
     *
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Craft::$app->view->hook(
          'speedbump',
          [$this, 'onRegisterHook']
          // function(array &$context) {
          //
          // }
        );

        // Do something after we're installed
        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                    // We were just installed
                }
            }
        );



/**
 * Logging in Craft involves using one of the following methods:
 *
 * Craft::trace(): record a message to trace how a piece of code runs. This is mainly for development use.
 * Craft::info(): record a message that conveys some useful information.
 * Craft::warning(): record a warning message that indicates something unexpected has happened.
 * Craft::error(): record a fatal error that should be investigated as soon as possible.
 *
 * Unless `devMode` is on, only Craft::warning() & Craft::error() will log to `craft/storage/logs/web.log`
 *
 * It's recommended that you pass in the magic constant `__METHOD__` as the second parameter, which sets
 * the category to the method (prefixed with the fully qualified class name) where the constant appears.
 *
 * To enable the Yii debug toolbar, go to your user account in the AdminCP and check the
 * [] Show the debug toolbar on the front end & [] Show the debug toolbar on the Control Panel
 *
 * http://www.yiiframework.com/doc-2.0/guide-runtime-logging.html
 */
        Craft::info(
            Craft::t(
                'speedbump',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    public function onRegisterHook (&$context)
    {
      $response = $this->displayHook();
      return $response;
    }

    // Protected Methods
    // =========================================================================
    protected function displayHook() {
      $oldMode = Craft::$app->view->getTemplateMode();
      Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
      $settings = $this->getSettings();
      $html = Craft::$app->view->renderTemplate('speedbump/speedbump', ['settings' => $settings]);

      Craft::$app->view->setTemplateMode($oldMode);

      return $html;
    }
    protected function createSettingsModel()
    {
        return new Settings();
    }
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'speedbump/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
