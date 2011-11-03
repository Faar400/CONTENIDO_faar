<?php
/**
 * Project:
 * CONTENIDO Content Management System
 *
 * Description:
 * Effective setting manager class. Provides a interface to retrieve effective
 * settings.
 *
 * Requested effective settings will be cached at first time. Further requests will
 * return cached settings.
 *
 * The order to retrieve a effective setting is:
 * System => Client => Client (language) => Group => User
 *
 * - System properties can be overridden by the client
 * - Client properties can be overwridden by client language
 * - Client language properties can be overwridden by group
 * - Group properties can be overwridden by user
 *
 *
 * Requirements:
 * @con_php_req 5.0
 *
 *
 * @package     CONTENIDO Backend classes
 * @subpackage  Setting
 * @version     0.1
 * @author      Murat Purc <murat@purc.de>
 * @copyright   four for business AG <www.4fb.de>
 * @license     http://www.contenido.org/license/LIZENZ.txt
 * @link        http://www.4fb.de
 * @link        http://www.contenido.org
 * @since       file available since CONTENIDO release 4.9.0
 *
 * {@internal
 *   created 2011-11-03
 *
 *   $Id: $:
 * }}
 *
 */

if (!defined('CON_FRAMEWORK')) {
    die('Illegal call');
}


class Contenido_Effective_Setting
{
    /**
     * @var array
     */
    protected static $_settings = array();

    /**
     * @var User
     */
    protected static $_user;

    /**
     * @var cApiClient
     */
    protected static $_client;

    /**
     * @var cApiClientLanguage
     */
    protected static $_clientLanguage;


    /**
     * Returns effective setting for a property. The requested setting will be cached
     * at first time, the next time the cached value will be returned.
     *
     * The order is:
     * System => Client => Client (language) => Group => User
     *
     * System properties can be overridden by the group, and group
     * properties can be overridden by the user.
     *
     * @param   string  $type The type of the item
     * @param   string  $name The name of the item
     * @param   string  $default Optional default value
     * @return  string|bool  The setting value or false 
     */
    public static function get($type, $name, $default = '')
    {
        global $auth;

        $key = $auth->auth['uid'] . '_' . $type . '_' . $name;

        $value = self::_get($key);
        if (false !== $value) {
            return $value;
        }

        if ($auth->auth['uid'] != 'nobody') {
            $obj = self::_getUserInstance();
            $value = $obj->getUserProperty($type, $name, true);
        }

        if (false === $value) {
            $obj = self::_getClientLanguageInstance();
            $value = $obj->getProperty($type, $name);
        }

        if (false === $value) {
            $obj = self::_getClientInstance();
            $value = self::$_client->getProperty($type, $name);
        }

        if ($value == false) {
            $value = getSystemProperty($type, $name);
        }

        if ($value == false) {
            $value = $default;
        }

        self::_set($key, $value);

        return $value;
    }


    /**
     * Returns effective setting for a type of properties. Caches also the 
     * collected settings, but contrary to get() it returns never cached entries.
     *
     * The order is:
     * System => Client => Client (language) => Group => User
     *
     * System properties can be overridden by the group, and group
     * properties can be overridden by the user.
     *
     * @param   string  $type The type of the item
     * @return  array  Assoziative array like $arr[name] = value
     */
    public static function getByType($type)
    {
        global $auth;

        $settings = getSystemPropertiesByType($type);

        $obj = self::_getClientInstance();
        $settings = array_merge($settings, $obj->getPropertiesByType($type));

        $obj = self::_getClientLanguageInstance();
        $settings = array_merge($settings, $obj->getPropertiesByType($type));

        if ($auth->auth['uid'] != 'nobody') {
            $obj = self::_getUserInstance();
            $settings = array_merge($settings, $obj->getUserPropertiesByType($type, true));
        }

        // cache all settings, to return them from cache in case of calling get()
        foreach ($settings as $setting => $value) {
            $key = $auth->auth['uid'] . '_' . $type . '_' . $setting;
            self::_set($key, $value);
        }

        return $settings;
    }


    /**
     * Resets all properties of the effective settings class.
     * Usable to start getting settings from scratch.
     */
    public static function reset()
    {
        self::$_settings = array();
        unset(self::$_user, self::$_client, self::$_clientLanguage);
    }


    /**
     * Returns the user object instance.
     *
     * @return  User
     */
    protected function _getUserInstance()
    {
        global $auth;

        if (!isset(self::$_user)) {
            self::$_user = new User();
            self::$_user->loadUserByUserID($auth->auth['uid']);
        }
        return self::$_user;
    }


    /**
     * Returns the client language object instance.
     *
     * @return  cApiClientLanguage
     */
    protected function _getClientLanguageInstance()
    {
        global $client, $lang;

        if (!isset(self::$_clientLanguage)) {
            self::$_clientLanguage = new cApiClientLanguage(false, $client, $lang);
        }
        return self::$_clientLanguage;
    }


    /**
     * Returns the client language object instance.
     *
     * @return  cApiClient
     */
    protected function _getClientInstance()
    {
        global $client;

        if (!isset(self::$_client)) {
            self::$_client = new cApiClient($client);
        }
        return self::$_client;
    }


    /**
     * Setting getter.
     *
     * @param   string  $key  The setting key
     * @return  string|bool  The setting value or false 
     */
    protected static function _get($key)
    {
        return (isset(self::$_settings[$key])) ? self::$_settings[$key] : false;
    }


    /**
     * Setting setter.
     *
     * @param   string  $key  The setting key
     * @param   string  $value  Value to store
     * @return  string|bool  The setting value or false 
     */
    protected static function _set($key, $value)
    {
        self::$_settings[$key] = $value;
    }

}