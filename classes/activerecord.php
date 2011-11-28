<?php

namespace Adodb;

import('adodb5/adodb-active-record.inc', 'vendor');

use \ADODB_Active_Record;

class ActiveRecord extends \ADODB_Active_Record { 

	/**
	 * Allow ActiveRecord to use multiple database connection
	 *
	 * @see ADOdb Manual (http://phplens.com/lens/adodb/docs-active-record.htm) Dealing with Multiple Databases
	 * @access public
	 */
	public function __construct() 
	{
		$name = '';
		
		if (!empty($this->_dbat)) 
		{
			$name = $this->_dbat;
		}

		DB::make($name);
		parent::__construct();
	}
}