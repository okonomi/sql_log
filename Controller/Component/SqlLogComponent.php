<?php
/*
 * SQL logger that writes to a file
 * Copyright (c) 2008 Matt Curry
 * www.PseudoCoder.com
 *
 * 90% of this code is taken from the DebugKit
 * http://thechaw.com/debug_kit
 *
 * @author      Matt Curry <matt@pseudocoder.com>
 * @license     MIT
 *
 */
App::uses('ConnectionManager', 'Model');
class SqlLogComponent extends Component {

/**
 * Status whether component is enable or disable
 *
 * @var boolean
 **/
	public $_debugWas = 0;

/**
 * Status whether component is enable or disable
 *
 * @var boolean
 **/
	public $enabled = false;

/**
 * Status whether component is enable or disable
 *
 * @var boolean
 **/
	private $_toFile = 'sql_log';

/**
 * Initialize callback.
 * If automatically disabled, tell component collection about the state.
 *
 * @return bool
 **/
	public function initialize($controller) {
		if ($recordTo = Configure::read('SqlLog.record')) {
			$this->_debugWas = Configure::read('debug');
			Configure::write('debug', 2);
			$this->enabled = true;
			
			if($recordTo !== true) {
				$this->_toFile = $recordTo.'.sql';
			}
		}
	}
	
	function beforeRender(Controller $controller) {
		if (!class_exists('ConnectionManager') || !$this->enabled) {
			return false;
		}
		$noLogs = !isset($logs);
		if ($noLogs) { 
			$sources = ConnectionManager::sourceList();
		
			$logs = array();
			foreach ($sources as $source) {
				$db = ConnectionManager::getDataSource($source);
				if (!method_exists($db, 'getLog')) {
					continue;
				}
				$logs[$source] = $db->getLog();
				foreach ($logs[$source] as $log) {
					$this->log($log[0], $this->_toFile);
				}
			}
		}
		
		Configure::write('debug', $this->_debugWas);
	}
}
?>