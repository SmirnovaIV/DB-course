<?php
 class umiDate implements iUmiDate {public $timestamp;public static $defaultFormatString = DEFAULT_DATE_FORMAT;public function __construct($vd7e6d55ba379a13d08c25d15faf2a23b = false) {if($vd7e6d55ba379a13d08c25d15faf2a23b === false) {$vd7e6d55ba379a13d08c25d15faf2a23b = self::getCurrentTimeStamp();}$this->setDateByTimeStamp($vd7e6d55ba379a13d08c25d15faf2a23b);}public function getCurrentTimeStamp() {if (isset($_SERVER['REQUEST_TIME'])) {return $_SERVER['REQUEST_TIME'];}else {return time();}}public function getDateTimeStamp() {return intval($this->timestamp);}public function getFormattedDate($v3c64ab0a1c8c902a8cfc3bdeedccd50a = false) {if($v3c64ab0a1c8c902a8cfc3bdeedccd50a === false) {$v3c64ab0a1c8c902a8cfc3bdeedccd50a = self::$defaultFormatString;}return date($v3c64ab0a1c8c902a8cfc3bdeedccd50a, $this->timestamp);}public function setDateByTimeStamp($vd7e6d55ba379a13d08c25d15faf2a23b) {if(!is_numeric($vd7e6d55ba379a13d08c25d15faf2a23b)) {return false;}$this->timestamp = $vd7e6d55ba379a13d08c25d15faf2a23b;return true;}public function setDateByString($ved2f216e8eb7276d3e828504ebdf5437) {$ved2f216e8eb7276d3e828504ebdf5437 = umiObjectProperty::filterInputString($ved2f216e8eb7276d3e828504ebdf5437);$vd7e6d55ba379a13d08c25d15faf2a23b  = strlen($ved2f216e8eb7276d3e828504ebdf5437) ? self::getTimeStamp($ved2f216e8eb7276d3e828504ebdf5437) : 0;return $this->setDateByTimeStamp($vd7e6d55ba379a13d08c25d15faf2a23b);}public static function getTimeStamp($ved2f216e8eb7276d3e828504ebdf5437) {return toTimeStamp($ved2f216e8eb7276d3e828504ebdf5437);}public function __toString() {return $this->getFormattedDate();}}?>