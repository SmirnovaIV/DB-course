<?php
 abstract class singleton {private static $instances = Array();abstract protected function __construct();public static function getInstance($v4a8a08f09d37b73795649038408b5f33 = NULL) {if (!isset(singleton::$instances[$v4a8a08f09d37b73795649038408b5f33])) {singleton::$instances[$v4a8a08f09d37b73795649038408b5f33] = new $v4a8a08f09d37b73795649038408b5f33;}return singleton::$instances[$v4a8a08f09d37b73795649038408b5f33];}public function __clone() {throw new coreException('Singletone clonning is not permitted.');}public static function setInstance($v7123a699d77db6479a1d8ece2c4f1c16, $v6f66e878c62db60568a3487869695820 = NULL) {if (is_null($v6f66e878c62db60568a3487869695820)) {throw new coreException('Unknown class name for set instance.');}return singleton::$instances[$v6f66e878c62db60568a3487869695820] = $v7123a699d77db6479a1d8ece2c4f1c16;}protected function disableCache() {if(!defined('MYSQL_DISABLE_CACHE')) {define('MYSQL_DISABLE_CACHE', '1');}}protected function translateLabel($vd304ba20e96d87411588eeabac850e34) {$v851f5ac9941d720844d143ed9cfcf60a = "i18n::";if(substr($vd304ba20e96d87411588eeabac850e34, 0, strlen($v851f5ac9941d720844d143ed9cfcf60a)) == $v851f5ac9941d720844d143ed9cfcf60a) {$v341be97d9aff90c9978347f66f945b77 = getLabel(substr($vd304ba20e96d87411588eeabac850e34, strlen($v851f5ac9941d720844d143ed9cfcf60a)));}else {$v341be97d9aff90c9978347f66f945b77 = getLabel($vd304ba20e96d87411588eeabac850e34);}return (is_null($v341be97d9aff90c9978347f66f945b77)) ? $vd304ba20e96d87411588eeabac850e34 : $v341be97d9aff90c9978347f66f945b77;}};?>