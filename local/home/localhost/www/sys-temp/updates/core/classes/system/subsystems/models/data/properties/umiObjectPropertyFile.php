<?php
 class umiObjectPropertyFile extends umiObjectProperty {protected function loadValue() {$v9b207167e5381c47682c6b4f58a623fb = Array();$v3aabf39f2d943fa886d86dcbbee4d910 = $this->field_id;if ($v8d777f385d3dfec8815d20f7496026dc = $this->getPropData()) {foreach ($v8d777f385d3dfec8815d20f7496026dc['text_val'] as $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {if (is_null($v3a6d0284e743dc4a9b86f97d6dd1a3bf)) continue;$v3a6d0284e743dc4a9b86f97d6dd1a3bf = self::unescapeFilePath($v3a6d0284e743dc4a9b86f97d6dd1a3bf);$v8c7dd922ad47494fc02c388e12c00eac = new umiFile(self::filterOutputString($v3a6d0284e743dc4a9b86f97d6dd1a3bf));if ($v8c7dd922ad47494fc02c388e12c00eac->getIsBroken()) continue;$v9b207167e5381c47682c6b4f58a623fb[] = $v8c7dd922ad47494fc02c388e12c00eac;}return $v9b207167e5381c47682c6b4f58a623fb;}$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT text_val FROM {$this->tableName} WHERE obj_id = '{$this->object_id}' AND field_id = '{$v3aabf39f2d943fa886d86dcbbee4d910}' LIMIT 1";$result = l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a, true);while (list($v3a6d0284e743dc4a9b86f97d6dd1a3bf) = mysql_fetch_row($result)) {if (is_null($v3a6d0284e743dc4a9b86f97d6dd1a3bf)) continue;$v8c7dd922ad47494fc02c388e12c00eac = new umiFile($v3a6d0284e743dc4a9b86f97d6dd1a3bf);if ($v8c7dd922ad47494fc02c388e12c00eac->getIsBroken()) continue;$v9b207167e5381c47682c6b4f58a623fb[] = $v8c7dd922ad47494fc02c388e12c00eac;}return $v9b207167e5381c47682c6b4f58a623fb;}protected function saveValue() {$this->deleteCurrentRows();if (is_null($this->value)) {return;}$v2817f701d5e1a1181e657251363295fd = 0;foreach ($this->value as $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {if (!$v3a6d0284e743dc4a9b86f97d6dd1a3bf) continue;if (is_object($v3a6d0284e743dc4a9b86f97d6dd1a3bf)) {if (!@is_file($v3a6d0284e743dc4a9b86f97d6dd1a3bf->getFilePath())) {continue;}$v3a6d0284e743dc4a9b86f97d6dd1a3bf = l_mysql_real_escape_string($v3a6d0284e743dc4a9b86f97d6dd1a3bf->getFilePath());}else {$v3a6d0284e743dc4a9b86f97d6dd1a3bf = l_mysql_real_escape_string($v3a6d0284e743dc4a9b86f97d6dd1a3bf);}$vac5c74b64b4b8352ef2f181affb5ac2a = "INSERT INTO {$this->tableName} (obj_id, field_id, text_val) VALUES('{$this->object_id}', '{$this->field_id}', '{$v3a6d0284e743dc4a9b86f97d6dd1a3bf}')";l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);++$v2817f701d5e1a1181e657251363295fd;}if (!$v2817f701d5e1a1181e657251363295fd) {$this->fillNull();}}};?>