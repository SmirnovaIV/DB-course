<?php
class regedit extends singleton implements iRegedit {protected $cacheFilePath, $cache = Array(), $cacheSaved = false;public static function getInstance($v4a8a08f09d37b73795649038408b5f33 = NULL) {return parent::getInstance(__CLASS__);}public function getKey($vd6fe1d0be6347b8ef2427fa629c04485, $v5809e03a3657bacd238321e736b9e85d = 0) {static $v0fea6a13c52b4d4725368f24b045ca84 = array();$vd6fe1d0be6347b8ef2427fa629c04485 = trim($vd6fe1d0be6347b8ef2427fa629c04485, "/");if(isset($this->cache['keys'][$vd6fe1d0be6347b8ef2427fa629c04485])) {return $this->cache['keys'][$vd6fe1d0be6347b8ef2427fa629c04485];}$vbb90bf734107ea3b2f4c14a5d4bc4f91 = 0;$ve030113b0d5493f188b4b49370f633b3 = array();foreach(explode("/", $vd6fe1d0be6347b8ef2427fa629c04485) as $v3c6e0b8a9c15224a8228b9a98ca1531d) {$v3c6e0b8a9c15224a8228b9a98ca1531d = l_mysql_real_escape_string($v3c6e0b8a9c15224a8228b9a98ca1531d);$ve030113b0d5493f188b4b49370f633b3[] = $v3c6e0b8a9c15224a8228b9a98ca1531d;$vfab0f4eae0e259eb1421e3cc7acca9b1 = implode('/', $ve030113b0d5493f188b4b49370f633b3);if(isset($v0fea6a13c52b4d4725368f24b045ca84[$vfab0f4eae0e259eb1421e3cc7acca9b1])) {$vbb90bf734107ea3b2f4c14a5d4bc4f91 = $v0fea6a13c52b4d4725368f24b045ca84[$vfab0f4eae0e259eb1421e3cc7acca9b1];continue;}$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT id FROM cms_reg WHERE rel = '$vbb90bf734107ea3b2f4c14a5d4bc4f91' AND var = '{$v3c6e0b8a9c15224a8228b9a98ca1531d}'";$result = l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a, true);if(mysql_num_rows($result)) {list($vbb90bf734107ea3b2f4c14a5d4bc4f91) = mysql_fetch_row($result);$v0fea6a13c52b4d4725368f24b045ca84[$vfab0f4eae0e259eb1421e3cc7acca9b1] = $vbb90bf734107ea3b2f4c14a5d4bc4f91;}else {return $this->cache['keys'][$vd6fe1d0be6347b8ef2427fa629c04485] = false;}}return $this->cache['keys'][$vd6fe1d0be6347b8ef2427fa629c04485] = (int) $vbb90bf734107ea3b2f4c14a5d4bc4f91;}public function getVal($vd6fe1d0be6347b8ef2427fa629c04485) {$vbb90bf734107ea3b2f4c14a5d4bc4f91 = $this->getKey($vd6fe1d0be6347b8ef2427fa629c04485);if(isset($this->cache['values'][$vd6fe1d0be6347b8ef2427fa629c04485])) {return $this->cache['values'][$vd6fe1d0be6347b8ef2427fa629c04485];}if($vbb90bf734107ea3b2f4c14a5d4bc4f91) {if(isset($this->cache['values'][$vbb90bf734107ea3b2f4c14a5d4bc4f91])) {return $this->cache['values'][$vbb90bf734107ea3b2f4c14a5d4bc4f91];}$this->cacheSaved = false;$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT val FROM cms_reg WHERE id = '{$vbb90bf734107ea3b2f4c14a5d4bc4f91}'";$result = l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a, true);list($v2063c1608d6e0baf80249c42e2be5804) = mysql_fetch_row($result);return $this->cache['values'][$vbb90bf734107ea3b2f4c14a5d4bc4f91] = $v2063c1608d6e0baf80249c42e2be5804;}else {return $this->cache['values'][$vd6fe1d0be6347b8ef2427fa629c04485] = false;}}public function setVar($vd6fe1d0be6347b8ef2427fa629c04485, $v2063c1608d6e0baf80249c42e2be5804) {return $this->setVal($vd6fe1d0be6347b8ef2427fa629c04485, $v2063c1608d6e0baf80249c42e2be5804);}public function setVal($vd6fe1d0be6347b8ef2427fa629c04485, $v2063c1608d6e0baf80249c42e2be5804) {if(defined('CURRENT_VERSION_LINE') && CURRENT_VERSION_LINE == 'demo') {return false;}$this->resetCache();$vbb90bf734107ea3b2f4c14a5d4bc4f91 = $this->getKey($vd6fe1d0be6347b8ef2427fa629c04485);if($vbb90bf734107ea3b2f4c14a5d4bc4f91 == false) {$vbb90bf734107ea3b2f4c14a5d4bc4f91 = $this->createKey($vd6fe1d0be6347b8ef2427fa629c04485);}$v2063c1608d6e0baf80249c42e2be5804 = l_mysql_real_escape_string($v2063c1608d6e0baf80249c42e2be5804);$vac5c74b64b4b8352ef2f181affb5ac2a = "UPDATE cms_reg SET val = '{$v2063c1608d6e0baf80249c42e2be5804}' WHERE id = '{$vbb90bf734107ea3b2f4c14a5d4bc4f91}'";l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);$this->resetCache();return true;}public function delVar($vd6fe1d0be6347b8ef2427fa629c04485) {if(defined('CURRENT_VERSION_LINE') && CURRENT_VERSION_LINE == 'demo') {return false;}$vbb90bf734107ea3b2f4c14a5d4bc4f91 = $this->getKey($vd6fe1d0be6347b8ef2427fa629c04485);if($vbb90bf734107ea3b2f4c14a5d4bc4f91) {$vac5c74b64b4b8352ef2f181affb5ac2a = "DELETE FROM cms_reg WHERE rel = '{$vbb90bf734107ea3b2f4c14a5d4bc4f91}' OR id = '{$vbb90bf734107ea3b2f4c14a5d4bc4f91}'";l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a, true);$this->resetCache();return true;}else {return false;}}public function getList($vd6fe1d0be6347b8ef2427fa629c04485) {if(isset($this->cache['lists'][$vd6fe1d0be6347b8ef2427fa629c04485])) {return $this->cache['lists'][$vd6fe1d0be6347b8ef2427fa629c04485];}$vbb90bf734107ea3b2f4c14a5d4bc4f91 = $this->getKey($vd6fe1d0be6347b8ef2427fa629c04485);if($vd6fe1d0be6347b8ef2427fa629c04485 == "//") {$vbb90bf734107ea3b2f4c14a5d4bc4f91 = 0;}if($vbb90bf734107ea3b2f4c14a5d4bc4f91 || $vd6fe1d0be6347b8ef2427fa629c04485 == "//") {if(isset($this->cache['lists'][$vbb90bf734107ea3b2f4c14a5d4bc4f91])) {return $this->cache['lists'][$vbb90bf734107ea3b2f4c14a5d4bc4f91];}$this->cacheSaved = false;$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT id, var, val FROM cms_reg WHERE rel = '{$vbb90bf734107ea3b2f4c14a5d4bc4f91}' ORDER BY id ASC";$result = l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a, true);$vf09cc7ee3a9a93273f4b80601cafb00c = Array();while(list(, $vb2145aac704ce76dbe1ac7adac535b23, $v3a6d0284e743dc4a9b86f97d6dd1a3bf) = mysql_fetch_array($result)) {$vf09cc7ee3a9a93273f4b80601cafb00c[] = Array($vb2145aac704ce76dbe1ac7adac535b23, $v3a6d0284e743dc4a9b86f97d6dd1a3bf);}return $this->cache['lists'][$vbb90bf734107ea3b2f4c14a5d4bc4f91] = $vf09cc7ee3a9a93273f4b80601cafb00c;}else {return $this->cache['lists'][$vd6fe1d0be6347b8ef2427fa629c04485] = false;}}final public static function checkSomething($v0cc175b9c0f1b6a831c399e269772661, $v92eb5ffee6ae2fec3ad71c777531578f, $ve70c4df10ef0983b9c8c31bd06b2a2c3=false) {$v5be98dd7e06f372f5de05104c7cb0bcc = 3600*24*30;if(array_search($_SERVER['HTTP_HOST'], array('localhost', 'subdomain.localhost')) !== false && $_SERVER['SERVER_ADDR'] == '127.0.0.1') {return true;}$v03355d867dcc3a38043185573f43b600 = self::getInstance()->getVal("//modules/autoupdate/system_edition") == 'commerce_enc';foreach ($v92eb5ffee6ae2fec3ad71c777531578f as $vc65f234fae60d823c1f1bf00566248a0 => $v0a3d72134fb3d6c024db4c510bc1605b) {$vce74825b5a01c99b06af231de0bd667d = (substr($v0cc175b9c0f1b6a831c399e269772661, 12, strlen($v0cc175b9c0f1b6a831c399e269772661) - 12) == $v0a3d72134fb3d6c024db4c510bc1605b);if ($vce74825b5a01c99b06af231de0bd667d === true) {if (!defined('CURRENT_VERSION_LINE')) {define("CURRENT_VERSION_LINE", $vc65f234fae60d823c1f1bf00566248a0);}if ($vc65f234fae60d823c1f1bf00566248a0 == "trial" || $v03355d867dcc3a38043185573f43b600) {if (file_exists(SYS_CACHE_RUNTIME . "trash")) {unlink(SYS_CACHE_RUNTIME . "trash");}$v1ed2e1b19b6e55d52d2473be17a4afd9 = filectime(__FILE__);$v59014f3a655d50ab70a71206fb9aff27 = time();if (($v59014f3a655d50ab70a71206fb9aff27 - $v1ed2e1b19b6e55d52d2473be17a4afd9) > $v5be98dd7e06f372f5de05104c7cb0bcc) {if ($ve70c4df10ef0983b9c8c31bd06b2a2c3) {return false;}else {include CURRENT_WORKING_DIR . "/errors/trial_expired.html";exit();}}}return true;}}return false;}final public function checkSelfKeycode() {$v1a54c1036ccb10069e9c06281d52007a = $this->getVal("//settings/keycode");if (strlen($v1a54c1036ccb10069e9c06281d52007a)==0) {return false;}$v903931b3a9d25a70683f51ab9d363d2e = $this->getVal("//settings/system_edition");$v1f0f70bf2b5ad94c7387e64c16dc455a = array('commerce', 'business', 'corporate', 'commerce_enc', 'business_enc', 'corporate_enc');$v45cee5e0fe2cae080c44e7a4ffc70361 = in_array($v903931b3a9d25a70683f51ab9d363d2e, $v1f0f70bf2b5ad94c7387e64c16dc455a) ? 'pro' : $v903931b3a9d25a70683f51ab9d363d2e;$v92eb5ffee6ae2fec3ad71c777531578f = array($v45cee5e0fe2cae080c44e7a4ffc70361 => umiTemplater::getSomething($v45cee5e0fe2cae080c44e7a4ffc70361));return self::checkSomething($v1a54c1036ccb10069e9c06281d52007a, $v92eb5ffee6ae2fec3ad71c777531578f, true);}public function getDaysLeft() {return 30 - floor((time() - filectime(__FILE__)) / (3600*24));}protected function __construct() {$v2245023265ae4cf87d02c8b6ba991139 = mainConfiguration::getInstance();$this->cacheFilePath = $v2245023265ae4cf87d02c8b6ba991139->includeParam('system.runtime-cache') . 'registry';$this->loadCache();}public function __destruct() {if(!$this->cacheSaved) {$this->saveCache();}}protected function loadCache() {$vb99eb979e6f6efabc396f777b503f7e7 = cacheFrontend::getInstance();if($vb99eb979e6f6efabc396f777b503f7e7->getIsConnected()) {if($v0fea6a13c52b4d4725368f24b045ca84 = $vb99eb979e6f6efabc396f777b503f7e7->loadSql("registry")) {$this->cache = unserialize($v0fea6a13c52b4d4725368f24b045ca84);$this->cacheSaved = true;return;}}if(file_exists($this->cacheFilePath)) {$v0fea6a13c52b4d4725368f24b045ca84 = unserialize(file_get_contents($this->cacheFilePath));if(is_array($v0fea6a13c52b4d4725368f24b045ca84)) {$this->cacheSaved = true;$this->cache = $v0fea6a13c52b4d4725368f24b045ca84;}}}protected function saveCache() {if(is_array($this->cache)) {if(is_dir(dirname($this->cacheFilePath))) {file_put_contents($this->cacheFilePath, serialize($this->cache));}if(cacheFrontend::getInstance()->getIsConnected()) {cacheFrontend::getInstance()->saveSql("registry", serialize($this->cache));}}$this->cacheSaved = true;}protected function createKey($vd6fe1d0be6347b8ef2427fa629c04485) {$vd6fe1d0be6347b8ef2427fa629c04485 = trim($vd6fe1d0be6347b8ef2427fa629c04485, "/");$vf961aedab905271a350c4e6eb6d7b6b9 = "//";$va722790b49e8eb1f37a1c672326ec501 = 0;$vbb90bf734107ea3b2f4c14a5d4bc4f91 = null;foreach(explode("/", $vd6fe1d0be6347b8ef2427fa629c04485) as $v3c6e0b8a9c15224a8228b9a98ca1531d) {$v3c6e0b8a9c15224a8228b9a98ca1531d = l_mysql_real_escape_string($v3c6e0b8a9c15224a8228b9a98ca1531d);$vf961aedab905271a350c4e6eb6d7b6b9 .= $v3c6e0b8a9c15224a8228b9a98ca1531d . "/";if($vbb90bf734107ea3b2f4c14a5d4bc4f91 = $this->getKey($vf961aedab905271a350c4e6eb6d7b6b9)) {$va722790b49e8eb1f37a1c672326ec501 = $vbb90bf734107ea3b2f4c14a5d4bc4f91;}else {$vac5c74b64b4b8352ef2f181affb5ac2a = "INSERT INTO cms_reg (rel, var, val) VALUES ('{$va722790b49e8eb1f37a1c672326ec501}', '{$v3c6e0b8a9c15224a8228b9a98ca1531d}', '')";l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a, true);$va722790b49e8eb1f37a1c672326ec501 = $vbb90bf734107ea3b2f4c14a5d4bc4f91 = (int) l_mysql_insert_id();}}return $vbb90bf734107ea3b2f4c14a5d4bc4f91;}protected function resetCache($v14f802e1fba977727845e8872c1743a7 = false) {if(is_array($v14f802e1fba977727845e8872c1743a7)) {foreach($v14f802e1fba977727845e8872c1743a7 as $v3c6e0b8a9c15224a8228b9a98ca1531d) {if(isset($this->cache[$v3c6e0b8a9c15224a8228b9a98ca1531d])) {unset($this->cache[$v3c6e0b8a9c15224a8228b9a98ca1531d]);}}}else {$this->cache = Array();}$this->saveCache();}};?>