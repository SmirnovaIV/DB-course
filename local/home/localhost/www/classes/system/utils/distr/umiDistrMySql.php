<?php
 class umiDistrMySql extends umiDistrInstallItem {protected $tableName, $permissions, $sqls = Array();public function __construct($v80071f37861c360a27b7327e132c911a = false) {if($v80071f37861c360a27b7327e132c911a !== false) {$this->tableName = $v80071f37861c360a27b7327e132c911a;$this->readTableDefinition();$this->readData();}}public function pack() {return base64_encode(serialize($this));}public static function unpack($v8d777f385d3dfec8815d20f7496026dc) {return base64_decode(unserialize($v8d777f385d3dfec8815d20f7496026dc));}public function restore() {}protected function readTableDefinition() {$vac5c74b64b4b8352ef2f181affb5ac2a = "SHOW CREATE TABLE {$this->tableName}";$result = l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);list(, $v568d8e07bbe5575518d5005e559743c3) = mysql_fetch_row($result);$this->sqls[] = $v568d8e07bbe5575518d5005e559743c3;}protected function readData() {$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT * FROM {$this->tableName}";$result = l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);$vdf347a373b8f92aa0ae3dd920a5ec2f6 = Array();while($vf1965a857bc285d26fe22023aa5ab50d = mysql_fetch_assoc($result)) {$vdf347a373b8f92aa0ae3dd920a5ec2f6[] = $vf1965a857bc285d26fe22023aa5ab50d;}if($vdf347a373b8f92aa0ae3dd920a5ec2f6) {$this->sqls[] = $this->generateInsertRows($vdf347a373b8f92aa0ae3dd920a5ec2f6);}}protected function generateInsertRow($vf1965a857bc285d26fe22023aa5ab50d) {$vac5c74b64b4b8352ef2f181affb5ac2a = "INSERT INTO {$this->tableName} (";$vd05b6ed7d2345020440df396d6da7f73 = array_keys($vf1965a857bc285d26fe22023aa5ab50d);$v7dabf5c198b0bab2eaa42bb03a113e55 = sizeof($vd05b6ed7d2345020440df396d6da7f73);for($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $v7dabf5c198b0bab2eaa42bb03a113e55;$v865c0c0b4ab0e063e5caa3387c1a8741++) {$vac5c74b64b4b8352ef2f181affb5ac2a .= "`" . $vd05b6ed7d2345020440df396d6da7f73[$v865c0c0b4ab0e063e5caa3387c1a8741] . "`";if($v865c0c0b4ab0e063e5caa3387c1a8741 < ($v7dabf5c198b0bab2eaa42bb03a113e55 - 1)) {$vac5c74b64b4b8352ef2f181affb5ac2a .= ", ";}}unset($vd05b6ed7d2345020440df396d6da7f73);$vac5c74b64b4b8352ef2f181affb5ac2a .= ") VALUES(";$vd4a4083280c17fd21f33d4b866e01e19 = $vac5c74b64b4b8352ef2f181affb5ac2a;$vac5c74b64b4b8352ef2f181affb5ac2a = "";$vf09cc7ee3a9a93273f4b80601cafb00c = array_values($vf1965a857bc285d26fe22023aa5ab50d);$v7dabf5c198b0bab2eaa42bb03a113e55 = sizeof($vf09cc7ee3a9a93273f4b80601cafb00c);for($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $v7dabf5c198b0bab2eaa42bb03a113e55;$v865c0c0b4ab0e063e5caa3387c1a8741++) {$vac5c74b64b4b8352ef2f181affb5ac2a .= $vd4a4083280c17fd21f33d4b866e01e19;$v3a6d0284e743dc4a9b86f97d6dd1a3bf = $vf09cc7ee3a9a93273f4b80601cafb00c[$v865c0c0b4ab0e063e5caa3387c1a8741];if(strlen($v3a6d0284e743dc4a9b86f97d6dd1a3bf)) {$v3a6d0284e743dc4a9b86f97d6dd1a3bf = "'" . mysql_escape_string($v3a6d0284e743dc4a9b86f97d6dd1a3bf) . "'";}else {$v3a6d0284e743dc4a9b86f97d6dd1a3bf = "NULL";}$vac5c74b64b4b8352ef2f181affb5ac2a .= $v3a6d0284e743dc4a9b86f97d6dd1a3bf;if($v865c0c0b4ab0e063e5caa3387c1a8741 < ($v7dabf5c198b0bab2eaa42bb03a113e55 - 1)) {$vac5c74b64b4b8352ef2f181affb5ac2a .= ", ";}}unset($vf09cc7ee3a9a93273f4b80601cafb00c);$vac5c74b64b4b8352ef2f181affb5ac2a .= ")";return $vac5c74b64b4b8352ef2f181affb5ac2a;}protected function generateInsertRows($vdf347a373b8f92aa0ae3dd920a5ec2f6) {$vac5c74b64b4b8352ef2f181affb5ac2a = "INSERT INTO {$this->tableName} (";$vd05b6ed7d2345020440df396d6da7f73 = array_keys($vdf347a373b8f92aa0ae3dd920a5ec2f6[0]);$v7dabf5c198b0bab2eaa42bb03a113e55 = sizeof($vd05b6ed7d2345020440df396d6da7f73);for($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $v7dabf5c198b0bab2eaa42bb03a113e55;$v865c0c0b4ab0e063e5caa3387c1a8741++) {$vac5c74b64b4b8352ef2f181affb5ac2a .= "`" . $vd05b6ed7d2345020440df396d6da7f73[$v865c0c0b4ab0e063e5caa3387c1a8741] . "`";if($v865c0c0b4ab0e063e5caa3387c1a8741 < ($v7dabf5c198b0bab2eaa42bb03a113e55 - 1)) {$vac5c74b64b4b8352ef2f181affb5ac2a .= ", ";}}unset($vd05b6ed7d2345020440df396d6da7f73);$vac5c74b64b4b8352ef2f181affb5ac2a .= ") VALUES";for($v7b8b965ad4bca0e41ab51de7b31363a1 = 0;$v7b8b965ad4bca0e41ab51de7b31363a1 < sizeof($vdf347a373b8f92aa0ae3dd920a5ec2f6);$v7b8b965ad4bca0e41ab51de7b31363a1++) {$vf1965a857bc285d26fe22023aa5ab50d = $vdf347a373b8f92aa0ae3dd920a5ec2f6[$v7b8b965ad4bca0e41ab51de7b31363a1];$vac5c74b64b4b8352ef2f181affb5ac2a .= "(";$vf09cc7ee3a9a93273f4b80601cafb00c = array_values($vf1965a857bc285d26fe22023aa5ab50d);$v7dabf5c198b0bab2eaa42bb03a113e55 = sizeof($vf09cc7ee3a9a93273f4b80601cafb00c);for($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $v7dabf5c198b0bab2eaa42bb03a113e55;$v865c0c0b4ab0e063e5caa3387c1a8741++) {$v3a6d0284e743dc4a9b86f97d6dd1a3bf = $vf09cc7ee3a9a93273f4b80601cafb00c[$v865c0c0b4ab0e063e5caa3387c1a8741];if(strlen($v3a6d0284e743dc4a9b86f97d6dd1a3bf)) {$v3a6d0284e743dc4a9b86f97d6dd1a3bf = "'" . mysql_escape_string($v3a6d0284e743dc4a9b86f97d6dd1a3bf) . "'";}else {$v3a6d0284e743dc4a9b86f97d6dd1a3bf = "NULL";}$vac5c74b64b4b8352ef2f181affb5ac2a .= $v3a6d0284e743dc4a9b86f97d6dd1a3bf;if($v865c0c0b4ab0e063e5caa3387c1a8741 < ($v7dabf5c198b0bab2eaa42bb03a113e55 - 1)) {$vac5c74b64b4b8352ef2f181affb5ac2a .= ", ";}}unset($vf09cc7ee3a9a93273f4b80601cafb00c);$vac5c74b64b4b8352ef2f181affb5ac2a .= ")";if($v7b8b965ad4bca0e41ab51de7b31363a1 < (sizeof($vdf347a373b8f92aa0ae3dd920a5ec2f6) - 1)) {$vac5c74b64b4b8352ef2f181affb5ac2a .= ", ";}}return $vac5c74b64b4b8352ef2f181affb5ac2a;}};?>