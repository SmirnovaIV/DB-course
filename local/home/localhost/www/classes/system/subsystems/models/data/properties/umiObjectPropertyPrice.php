<?php
 class umiObjectPropertyPrice extends umiObjectPropertyFloat {protected $dbValue;protected function loadValue() {$v9b207167e5381c47682c6b4f58a623fb = parent::loadValue();$v78a5eb43deef9a7b5b9ce157b9d52ac4 = 0;if (is_array($v9b207167e5381c47682c6b4f58a623fb) && isset($v9b207167e5381c47682c6b4f58a623fb[0])) {list($v78a5eb43deef9a7b5b9ce157b9d52ac4) = $v9b207167e5381c47682c6b4f58a623fb;}$this->dbValue = $v78a5eb43deef9a7b5b9ce157b9d52ac4;if ($v3766293ae0857925595a6f0bf40531a8 = cmsController::getInstance()->getModule("eshop")) {$v78a5eb43deef9a7b5b9ce157b9d52ac4 = $v3766293ae0857925595a6f0bf40531a8->calculateDiscount($this->object_id, $v78a5eb43deef9a7b5b9ce157b9d52ac4);}$v161c9aaa4fe035e7b2f465bc59f3ab45 = new umiEventPoint("umiObjectProperty_loadPriceValue");$v161c9aaa4fe035e7b2f465bc59f3ab45->setParam("object_id", $this->object_id);$v161c9aaa4fe035e7b2f465bc59f3ab45->addRef("price", $v78a5eb43deef9a7b5b9ce157b9d52ac4);$v161c9aaa4fe035e7b2f465bc59f3ab45->call();$v9b207167e5381c47682c6b4f58a623fb = Array($v78a5eb43deef9a7b5b9ce157b9d52ac4);return $v9b207167e5381c47682c6b4f58a623fb;}protected function saveValue() {$this->deleteCurrentRows();$v2817f701d5e1a1181e657251363295fd = 0;foreach ($this->value as $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {if ($v3a6d0284e743dc4a9b86f97d6dd1a3bf === false || $v3a6d0284e743dc4a9b86f97d6dd1a3bf === "") continue;if (strpos(".", $v3a6d0284e743dc4a9b86f97d6dd1a3bf) === false) {$v3a6d0284e743dc4a9b86f97d6dd1a3bf = str_replace(",", ".", $v3a6d0284e743dc4a9b86f97d6dd1a3bf);}$v3a6d0284e743dc4a9b86f97d6dd1a3bf = abs((float) $v3a6d0284e743dc4a9b86f97d6dd1a3bf);if ($v3a6d0284e743dc4a9b86f97d6dd1a3bf > 999999999.99) {$v3a6d0284e743dc4a9b86f97d6dd1a3bf = 999999999.99;}$vac5c74b64b4b8352ef2f181affb5ac2a = "INSERT INTO {$this->tableName} (obj_id, field_id, float_val) VALUES('{$this->object_id}', '{$this->field_id}', '{$v3a6d0284e743dc4a9b86f97d6dd1a3bf}')";l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);if ($v56bd7107802ebe56c6918992f0608ec6 = l_mysql_error()) {throw new coreException($v56bd7107802ebe56c6918992f0608ec6);}++$v2817f701d5e1a1181e657251363295fd;}$this->dbValue = $this->value;if (!$v2817f701d5e1a1181e657251363295fd) {$this->fillNull();}}public function __wakeup() {if ($this->dbValue) {$v78a5eb43deef9a7b5b9ce157b9d52ac4 = $this->dbValue;if ($v3766293ae0857925595a6f0bf40531a8 = cmsController::getInstance()->getModule("eshop")) {$v78a5eb43deef9a7b5b9ce157b9d52ac4 = $v3766293ae0857925595a6f0bf40531a8->calculateDiscount($this->object_id, $v78a5eb43deef9a7b5b9ce157b9d52ac4);}$v161c9aaa4fe035e7b2f465bc59f3ab45 = new umiEventPoint("umiObjectProperty_loadPriceValue");$v161c9aaa4fe035e7b2f465bc59f3ab45->setParam("object_id", $this->object_id);$v161c9aaa4fe035e7b2f465bc59f3ab45->addRef("price", $v78a5eb43deef9a7b5b9ce157b9d52ac4);$v161c9aaa4fe035e7b2f465bc59f3ab45->call();$v2063c1608d6e0baf80249c42e2be5804 = Array($v78a5eb43deef9a7b5b9ce157b9d52ac4);$this->value = $v2063c1608d6e0baf80249c42e2be5804;}}};?>