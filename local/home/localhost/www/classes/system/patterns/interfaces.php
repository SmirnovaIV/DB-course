<?php
 interface iSingleton {public static function getInstance($v4a8a08f09d37b73795649038408b5f33 = NULL);};interface iUmiEntinty {public function getId();public function commit();public function update();public static function filterInputString($vb45cffe084dd3d20d928bee85e7b0f21);};interface iMapContainer {public function get($v3c6e0b8a9c15224a8228b9a98ca1531d);public function set($v3c6e0b8a9c15224a8228b9a98ca1531d, $v2063c1608d6e0baf80249c42e2be5804);public function del($v3c6e0b8a9c15224a8228b9a98ca1531d);public function getArrayCopy();public function clear();public function __get($v3c6e0b8a9c15224a8228b9a98ca1531d);public function __set($v3c6e0b8a9c15224a8228b9a98ca1531d, $v2063c1608d6e0baf80249c42e2be5804);public function __unset($v3c6e0b8a9c15224a8228b9a98ca1531d);}?>