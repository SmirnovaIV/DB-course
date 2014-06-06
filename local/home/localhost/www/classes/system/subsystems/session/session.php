<?php
 class session implements iSession, iMapContainer, iSessionValidation {private static $isStarted = false;protected function __construct() {if(!self::$isStarted || !isset($_SESSION)) {@session_start();self::$isStarted = true;}}public static function getInstance() {return new session();}public static function recreateInstance($v08a3fc7e7897fe3ca69d19f76f86e93c = false) {if ((bool) $v08a3fc7e7897fe3ca69d19f76f86e93c) {self::destroy();}else {self::commit();}return self::getInstance();}public function get($vb068931cc450442b63f5b3d276ea4297) {return isset($_SESSION) ? getArrayKey($_SESSION, $vb068931cc450442b63f5b3d276ea4297) : false;}public function set($vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804) {return self::$isStarted ? $_SESSION[$vb068931cc450442b63f5b3d276ea4297] = $v2063c1608d6e0baf80249c42e2be5804 : false;}public function del($vb068931cc450442b63f5b3d276ea4297) {if(is_array($vb068931cc450442b63f5b3d276ea4297)) {foreach($vb068931cc450442b63f5b3d276ea4297 as $vf9b65f1001fbbc301b0c275da73b16ca) {unset($_SESSION[$vf9b65f1001fbbc301b0c275da73b16ca]);}}else {unset($_SESSION[$vb068931cc450442b63f5b3d276ea4297]);}}public function getArrayCopy() {return isset($_SESSION) ? $_SESSION : array();}public function clear() {session_unset();$_SESSION = array();}public static function commit() {self::$isStarted = false;session_commit();}public static function destroy() {self::$isStarted = false;session_destroy();}public static function setId($vb80bb7740288fda1f201890375a60c8f) {return session_id($vb80bb7740288fda1f201890375a60c8f);}public static function getId() {return session_id();}public static function setName($vb068931cc450442b63f5b3d276ea4297) {return session_name($vb068931cc450442b63f5b3d276ea4297);}public static function getName() {return session_name();}public function __get($vb068931cc450442b63f5b3d276ea4297) {return $this->get($vb068931cc450442b63f5b3d276ea4297);}public function __set($vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804) {return $this->set($vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804);}public function __unset($vb068931cc450442b63f5b3d276ea4297) {$this->del($vb068931cc450442b63f5b3d276ea4297);}public function setValid($vce74825b5a01c99b06af231de0bd667d = true) {if ($vce74825b5a01c99b06af231de0bd667d) {$this->set("starttime", time());}else {$this->set("starttime", time() - (SESSION_LIFETIME + 1) * 60);}}public function isValid() {if (!$this->get("starttime")) {return SESSION_LIFETIME * 60;}elseif ($this->get("starttime") + SESSION_LIFETIME * 60 < time()) {return false;}else {return $this->get("starttime") + SESSION_LIFETIME * 60 - time();}}}?>