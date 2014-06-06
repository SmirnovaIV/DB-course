<?php
class umiDirectory implements iUmiDirectory, IteratorAggregate {protected $s_dir_path = "";protected $is_broken = false;protected $arr_files = array();protected $arr_dirs = array();protected $arr_objs = array();protected $is_readed = false;public function __construct($v40a9b083c3f1470a5d6db5014dcf3da9) {while (substr($v40a9b083c3f1470a5d6db5014dcf3da9, -1)=="/") $v40a9b083c3f1470a5d6db5014dcf3da9=substr($v40a9b083c3f1470a5d6db5014dcf3da9, 0, (strlen($v40a9b083c3f1470a5d6db5014dcf3da9)-1));if(is_dir($v40a9b083c3f1470a5d6db5014dcf3da9)) {$this->s_dir_path = $v40a9b083c3f1470a5d6db5014dcf3da9;}else {$this->is_broken = true;return false;}}public function getPath() {return $this->s_dir_path;}public function getName() {$vecc36294ab8c5c533b35f3e32182f913 = explode("/", $this->s_dir_path);return array_pop($vecc36294ab8c5c533b35f3e32182f913);}public function getIterator() {$this->read();return new umiDirectoryIterator($this->arr_objs);}private function read() {if($this->is_readed) {return false;}else {$this->is_readed = true;}$this->arr_files = array();$this->arr_dirs = array();if($v0fea6a13c52b4d4725368f24b045ca84 = self::cache($this->s_dir_path)) {list($this->arr_files, $this->arr_dirs, $this->arr_objs) = $v0fea6a13c52b4d4725368f24b045ca84;return;}if (is_dir($this->s_dir_path) && is_readable($this->s_dir_path)) {if ($vf6822f7a2c7f67642432cae7c6e16f11 = opendir($this->s_dir_path)) {$v2f45bcacffcc7baec90959eca25ca543 = "";while (($ve7f75a362d2d248bbabd5abbdbb8ab25 = readdir($vf6822f7a2c7f67642432cae7c6e16f11)) !== false) {if(defined("CURRENT_VERSION_LINE")) {if(CURRENT_VERSION_LINE == "demo") {if($ve7f75a362d2d248bbabd5abbdbb8ab25 == "demo") continue;}}$vf6fe2202aaa5491a9c7a9fef46f44483 = $this->s_dir_path."/".$ve7f75a362d2d248bbabd5abbdbb8ab25;if (is_file($vf6fe2202aaa5491a9c7a9fef46f44483)) {$this->arr_files[$ve7f75a362d2d248bbabd5abbdbb8ab25] = $vf6fe2202aaa5491a9c7a9fef46f44483;$this->arr_objs[] = $vf6fe2202aaa5491a9c7a9fef46f44483;}elseif (is_dir($vf6fe2202aaa5491a9c7a9fef46f44483) && $ve7f75a362d2d248bbabd5abbdbb8ab25 != ".." && $ve7f75a362d2d248bbabd5abbdbb8ab25 != ".") {$this->arr_dirs[$ve7f75a362d2d248bbabd5abbdbb8ab25] = $vf6fe2202aaa5491a9c7a9fef46f44483;$this->arr_objs[] = $vf6fe2202aaa5491a9c7a9fef46f44483;}}if(isset($vdcce6f99e5ae80245b8c2ed99b43823b)) {closedir($vdcce6f99e5ae80245b8c2ed99b43823b);}}}self::cache($this->s_dir_path, Array($this->arr_files, $this->arr_dirs, $this->arr_objs));}public function getIsBroken() {return (bool) $this->is_broken;}public function getFSObjects($vd1c23eb6cdb82a62e26a8b358943d104=0, $v680c0a11687c0b2cf6554086431e2d31="", $v17fa2d7e21098f98c5ecf28224bd9e90=false) {$this->read();$v7dc5291b1ee158186937dced87c5cdbd =array();$v563a5461acd4cf632a113d5b105e817e = array();switch ($vd1c23eb6cdb82a62e26a8b358943d104) {case 1:         $v563a5461acd4cf632a113d5b105e817e = $this->arr_files;break;case 2:         $v563a5461acd4cf632a113d5b105e817e = $this->arr_dirs;break;default:     $v563a5461acd4cf632a113d5b105e817e = array_merge($this->arr_dirs, $this->arr_files);}foreach ($v563a5461acd4cf632a113d5b105e817e as $v378a57caf83c2685b4ec1da99037a754 => $vf6fe2202aaa5491a9c7a9fef46f44483) {if ((!$v17fa2d7e21098f98c5ecf28224bd9e90 || is_readable($vf6fe2202aaa5491a9c7a9fef46f44483)) && (!strlen($v680c0a11687c0b2cf6554086431e2d31)) || preg_match("/".$v680c0a11687c0b2cf6554086431e2d31."/i", $v378a57caf83c2685b4ec1da99037a754)) {$v7dc5291b1ee158186937dced87c5cdbd[$v378a57caf83c2685b4ec1da99037a754] = $vf6fe2202aaa5491a9c7a9fef46f44483;}}ksort ($v7dc5291b1ee158186937dced87c5cdbd);return $v7dc5291b1ee158186937dced87c5cdbd;}public function getFiles($v680c0a11687c0b2cf6554086431e2d31="", $v17fa2d7e21098f98c5ecf28224bd9e90=false) {return $this->getFSObjects(1, $v680c0a11687c0b2cf6554086431e2d31, $v17fa2d7e21098f98c5ecf28224bd9e90);}public function getDirectories($v680c0a11687c0b2cf6554086431e2d31="", $v17fa2d7e21098f98c5ecf28224bd9e90=false) {return $this->getFSObjects(2, $v680c0a11687c0b2cf6554086431e2d31, $v17fa2d7e21098f98c5ecf28224bd9e90);}public function getAllFiles($vd1c23eb6cdb82a62e26a8b358943d104=0, $v680c0a11687c0b2cf6554086431e2d31="", $v17fa2d7e21098f98c5ecf28224bd9e90=false) {$v45b963397aa40d4a0063e0d85e4fe7a1 = $this->getFSObjects($vd1c23eb6cdb82a62e26a8b358943d104, $v680c0a11687c0b2cf6554086431e2d31, $v17fa2d7e21098f98c5ecf28224bd9e90);$result = array_flip($v45b963397aa40d4a0063e0d85e4fe7a1);$v33030abc929f083da5f6c3f755b46034 = $this->getFSObjects(2, $v680c0a11687c0b2cf6554086431e2d31, $v17fa2d7e21098f98c5ecf28224bd9e90);foreach ($v33030abc929f083da5f6c3f755b46034 as $v736007832d2167baaae763fd3a3f3cf1) {$v736007832d2167baaae763fd3a3f3cf1 = new umiDirectory($v736007832d2167baaae763fd3a3f3cf1);$v61bc14cb8b5ad53713391fa68d17e48c = $v736007832d2167baaae763fd3a3f3cf1->getAllFiles($vd1c23eb6cdb82a62e26a8b358943d104, $v680c0a11687c0b2cf6554086431e2d31="", $v17fa2d7e21098f98c5ecf28224bd9e90);$result = array_merge($result, $v61bc14cb8b5ad53713391fa68d17e48c);}return $result;}public function delete($vf8532b6380228945d474f37fb6cdac27 = false) {if(is_writable($this->s_dir_path)) {if($vf8532b6380228945d474f37fb6cdac27) {foreach($this as $v447b7147e84be512208dcc0995d67ebc) {if($v447b7147e84be512208dcc0995d67ebc instanceof umiDirectory) {$v447b7147e84be512208dcc0995d67ebc->delete(true);}else if ($v447b7147e84be512208dcc0995d67ebc instanceof umiFile) {$v447b7147e84be512208dcc0995d67ebc->delete();}}}return @rmdir($this->s_dir_path);}else {return false;}}public static function requireFolder($v851148b4fd8fd7ae74bd9100c5c0c898, $v2d5ec04ac614a2ce7db2e49fce18670c = "") {if(!$v851148b4fd8fd7ae74bd9100c5c0c898) return false;if(is_dir($v851148b4fd8fd7ae74bd9100c5c0c898) == false) {mkdir($v851148b4fd8fd7ae74bd9100c5c0c898, 0777, true);}$vf1717c0d3bb9106455d837859192864e = realpath($v851148b4fd8fd7ae74bd9100c5c0c898);$v2d5ec04ac614a2ce7db2e49fce18670c = realpath($v2d5ec04ac614a2ce7db2e49fce18670c);return (substr($vf1717c0d3bb9106455d837859192864e, 0, strlen($v2d5ec04ac614a2ce7db2e49fce18670c)) == $v2d5ec04ac614a2ce7db2e49fce18670c);}public function __toString() {return "umiDirectory::{$this->s_dir_path}";}protected static function cache($v3c6e0b8a9c15224a8228b9a98ca1531d, $v2063c1608d6e0baf80249c42e2be5804 = NULL) {static $v0fea6a13c52b4d4725368f24b045ca84 = Array();if($v2063c1608d6e0baf80249c42e2be5804) {return $v0fea6a13c52b4d4725368f24b045ca84[$v3c6e0b8a9c15224a8228b9a98ca1531d] = $v2063c1608d6e0baf80249c42e2be5804;}if(isset($v0fea6a13c52b4d4725368f24b045ca84[$v3c6e0b8a9c15224a8228b9a98ca1531d])) {return $v0fea6a13c52b4d4725368f24b045ca84[$v3c6e0b8a9c15224a8228b9a98ca1531d];}else {return NULL;}}}class umiDirectoryIterator implements Iterator {private $arr_objs = array();public function __construct($v563a5461acd4cf632a113d5b105e817e) {if (is_array($v563a5461acd4cf632a113d5b105e817e)) {$this->arr_objs = $v563a5461acd4cf632a113d5b105e817e;}}public function rewind() {reset($this->arr_objs);}public function current() {$vdcb9afbd8280826e367d80729a873796 = null;$vf6fe2202aaa5491a9c7a9fef46f44483 = current($this->arr_objs);if (is_file($vf6fe2202aaa5491a9c7a9fef46f44483)) {if (umiImageFile::getIsImage($vf6fe2202aaa5491a9c7a9fef46f44483)) {$vdcb9afbd8280826e367d80729a873796 = new umiImageFile($vf6fe2202aaa5491a9c7a9fef46f44483);}else {$vdcb9afbd8280826e367d80729a873796 = new umiFile($vf6fe2202aaa5491a9c7a9fef46f44483);}}elseif (is_dir($vf6fe2202aaa5491a9c7a9fef46f44483)) {$vdcb9afbd8280826e367d80729a873796 = new umiDirectory($vf6fe2202aaa5491a9c7a9fef46f44483);}return $vdcb9afbd8280826e367d80729a873796;}public function key() {return current($this->arr_objs);}public function next() {$vdcb9afbd8280826e367d80729a873796 = null;$vf6fe2202aaa5491a9c7a9fef46f44483 = next($this->arr_objs);if (is_file($vf6fe2202aaa5491a9c7a9fef46f44483)) {if (umiImageFile::getIsImage($vf6fe2202aaa5491a9c7a9fef46f44483)) {$vdcb9afbd8280826e367d80729a873796 = new umiImageFile($vf6fe2202aaa5491a9c7a9fef46f44483);}else {$vdcb9afbd8280826e367d80729a873796 = new umiFile($vf6fe2202aaa5491a9c7a9fef46f44483);}}elseif (is_dir($vf6fe2202aaa5491a9c7a9fef46f44483)) {$vdcb9afbd8280826e367d80729a873796 = new umiDirectory($vf6fe2202aaa5491a9c7a9fef46f44483);}return $vdcb9afbd8280826e367d80729a873796;}public function valid() {return !is_null($this->current());}}?>