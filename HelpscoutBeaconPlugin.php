<?php
/**
 * Helpscout Beacon plugin for Craft CMS
 *
 * Beacon!
 *
 * --snip--
 * Craft plugins are very much like little applications in and of themselves. We’ve made it as simple as we can,
 * but the training wheels are off. A little prior knowledge is going to be required to write a plugin.
 *
 * For the purposes of the plugin docs, we’re going to assume that you know PHP and SQL, as well as some semi-
 * advanced concepts like object-oriented programming and PHP namespaces.
 *
 * https://craftcms.com/docs/plugins/introduction
 * --snip--
 *
 * @author    Jan Henckens
 * @copyright Copyright (c) 2016 Jan Henckens
 * @link      http://janhenckens.com
 * @package   HelpscoutBeacon
 * @since     1.0.0
 */

namespace Craft;

class HelpscoutBeaconPlugin extends BasePlugin
{
    /**
     * Called after the plugin class is instantiated; do any one-time initialization here such as hooks and events:
     *
     * craft()->on('entries.saveEntry', function(Event $event) {
     *    // ...
     * });
     *
     * or loading any third party Composer packages via:
     *
     * require_once __DIR__ . '/vendor/autoload.php';
     *
     * @return mixed
     */
    public function init()
    {

        $plugin = craft()->plugins->getPlugin('helpscoutbeacon');
        $settings = $plugin->getSettings();


        if ( craft()->request->isCpRequest() && craft()->userSession->isLoggedIn() )
        {
            craft()->templates->includeJs('
            var formId = "'. $settings->beaconFormId . '";
            !function (e, o, n) {
                window.HSCW = o, window.HS = n, n.beacon = n.beacon || {};
                var t = n.beacon;
                t.userConfig = {}, t.readyQueue = [], t.config = function (e) {
                    this.userConfig = e
                },
                    t.ready = function (e) {
                        this.readyQueue.push(e)
                    },
                    o.config = {
                        docs: {enabled: 0, baseUrl: ""},
                        contact: {enabled: 1, formId: formId},
                    };
                var r = e.getElementsByTagName("script")[0], c = e.createElement("script");
                c.type = "text/javascript", c.async = !0, c.src = "https://djtflbt20bdde.cloudfront.net/",
                    r.parentNode.insertBefore(c, r)
            }(document, window.HSCW || {}, window.HS || {}
            );');
        }
    }

    /**
     * Returns the user-facing name.
     *
     * @return mixed
     */
    public function getName()
    {
         return Craft::t('Helpscout Beacon');
    }

    /**
     * Plugins can have descriptions of themselves displayed on the Plugins page by adding a getDescription() method
     * on the primary plugin class:
     *
     * @return mixed
     */
    public function getDescription()
    {
        return Craft::t('Beacon!');
    }

    /**
     * Plugins can have links to their documentation on the Plugins page by adding a getDocumentationUrl() method on
     * the primary plugin class:
     *
     * @return string
     */
//    public function getDocumentationUrl()
//    {
//        return 'https://github.com/janhenckens/helpscoutbeacon/blob/master/README.md';
//    }



    /**
     * Returns the version number.
     *
     * @return string
     */
    public function getVersion()
    {
        return '1.0.0';
    }

    /**
     * As of Craft 2.5, Craft no longer takes the whole site down every time a plugin’s version number changes, in
     * case there are any new migrations that need to be run. Instead plugins must explicitly tell Craft that they
     * have new migrations by returning a new (higher) schema version number with a getSchemaVersion() method on
     * their primary plugin class:
     *
     * @return string
     */
    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    /**
     * Returns the developer’s name.
     *
     * @return string
     */
    public function getDeveloper()
    {
        return 'Jan Henckens';
    }

    /**
     * Returns the developer’s website URL.
     *
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'http://janhenckens.com';
    }

    /**
     * Returns whether the plugin should get its own tab in the CP header.
     *
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }

    /**
     * Called right before your plugin’s row gets stored in the plugins database table, and tables have been created
     * for it based on its records.
     */
    public function onBeforeInstall()
    {
    }

    /**
     * Called right after your plugin’s row has been stored in the plugins database table, and tables have been
     * created for it based on its records.
     */
    public function onAfterInstall()
    {
    }

    /**
     * Called right before your plugin’s record-based tables have been deleted, and its row in the plugins table
     * has been deleted.
     */
    public function onBeforeUninstall()
    {
    }

    /**
     * Called right after your plugin’s record-based tables have been deleted, and its row in the plugins table
     * has been deleted.
     */
    public function onAfterUninstall()
    {
    }

    /**
     * Defines the attributes that model your plugin’s available settings.
     *
     * @return array
     */
    protected function defineSettings()
    {
        return array(
            'beaconFormId' => array(AttributeType::String, 'label' => 'Beacon Form Id', 'default' => ''),
            'beaconIcon' => array(AttributeType::Mixed, 'label' => 'Beacon Icon', 'default' => ''),
        );
    }

    /**
     * Returns the HTML that displays your plugin’s settings.
     *
     * @return mixed
     */
    public function getSettingsHtml()
    {
       return craft()->templates->render('helpscoutbeacon/HelpscoutBeacon_Settings', array(
           'settings' => $this->getSettings()
       ));
    }

    /**
     * If you need to do any processing on your settings’ post data before they’re saved to the database, you can
     * do it with the prepSettings() method:
     *
     * @param mixed $settings  The Widget's settings
     *
     * @return mixed
     */
    public function prepSettings($settings)
    {
        // Modify $settings here...

        return $settings;
    }

}