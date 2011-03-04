#Introduction

Implement a bridge to use ADOdb Database Abstraction Layer with FuelPHP. This is an alternative option if you project require the use of ADOdb Library.
Installation

##Requirements

The planned requirements for Fuel are as follows:

* PHP 5.3 or greater
* Source code of ADODb Database Abstraction Layer Library (not included)

##Download version 1.0.0 now.

The DB class use the configuration from ``/app/config/db.php`` to make it easier to use. All you need to do is download ADOdb5 library and place it in ``/fuel/core/vendor/adodb5``

From there you can just start using ADOdb by enabling adodb package from ``/app/config/config.php``
Accessing ADOdb Library

	$db = \Adodb\DB::factory();

You can also make multiple connection by adding the connection name as a parameter:

	$name = 'qa';
	$db = \Adodb\DB::factory($name);
