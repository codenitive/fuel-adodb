<?php

namespace Adodb;

import('adodb5/adodb.inc', 'vendor');
import('adodb5/adodb-errorhandler.inc', 'vendor');
import('adodb5/adodb-active-record.inc', 'vendor');

use \ADONewConnection;
use \ADODB_Active_Record;

/**
 * Implement a bridge to use ADOdb Database Abstraction Layer with FuelPHP. This
 * is an alternative option if you project require the use of ADOdb Library.
 *
 * The DB class use the configuration from /app/config/db.php to make it easier
 * to use. All you need to do is download ADOdb5 library and place it in /fuel/vendor/adodb5
 *
 * From there you can just start using ADOdb by enabling adodb package from /app/config/config.php
 *
 *
 * @author Mior Muhammad Zaki <crynobone@gmail.com>
 */

class DB {
    protected static $instances = array ();
    protected static $active = '';

    public function __construct($name = null) 
    {
        return static::factory($name);
    }
    
    public static function _init() 
    {
        \Config::load('db', true);
        
        static::$active = \Config::get('db.active');
    }
    
    /**
     * Accessing ADOdb Library:
     * $db = \Adodb\DB::factory();
     *
     * You can also make multiple connection by adding the connection name as a parameter
     * $name = 'qa';
     * $db = \Adodb\DB::factory($name);
     *
     * @access public
     * @param string $name
     * @return object ADOdb
     */
    public static function factory($name = null) 
    {
        if (\empty($name)) 
        {
            $name = static::$active;
        }

        if (!\isset(static::$instances[$name])) 
        {
            $config = \Config::get("db.{$name}");

            if (\is_null($config)) 
            {
                throw new \Fuel_Exception("Unable to get configuration for {$name}");
            }

            $dsn = $config['type'] . '://' . $config['connection']['username']
                       . ':' . $config['connection']['password'] . '@' . $config['connection']['hostname']
                       . '/' . $config['connection']['database'];

            try 
            {
                static::$instances[$name] =& ADONewConnection($dsn);
                \ADODB_Active_Record::SetDatabaseAdapter(static::$instances[$name], $name);
            }
            catch(\Fuel_Exception $e) {
                throw new \Fuel_Exception($e);
            }
        }

        return static::$instances[$name];
    }
}