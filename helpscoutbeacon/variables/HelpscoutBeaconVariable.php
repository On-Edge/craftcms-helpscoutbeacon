<?php
/**
 * Helpscout Beacon plugin for Craft CMS
 *
 * Helpscout Beacon Variable
 *
 * --snip--
 * Craft allows plugins to provide their own template variables, accessible from the {{ craft }} global variable
 * (e.g. {{ craft.pluginName }}).
 *
 * https://craftcms.com/docs/plugins/variables
 * --snip--
 *
 * @author    Jan Henckens
 * @copyright Copyright (c) 2016 Jan Henckens
 * @link      http://janhenckens.com
 * @package   HelpscoutBeacon
 * @since     1.0.0
 */

namespace Craft;

class HelpscoutBeaconVariable
{
    /**
     * Whatever you want to output to a Twig tempate can go into a Variable method. You can have as many variable
     * functions as you want.  From any Twig template, call it like this:
     *
     *     {{ craft.helpscoutBeacon.exampleVariable }}
     *
     * Or, if your variable requires input from Twig:
     *
     *     {{ craft.helpscoutBeacon.exampleVariable(twigValue) }}
     */
    public function exampleVariable($optional = null)
    {
        return "And away we go to the Twig template...";
    }
}