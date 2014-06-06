<?php
 class umiObjectsExpiration extends singleton implements iSingleton, iUmiObjectsExpiration {protected $defaultExpires = 86400;protected function __construct() {}public static function getInstance($v4a8a08f09d37b73795649038408b5f33 = NULL) {return parent::getInstance(__CLASS__);}public function isExpirationExists($v16b2b26000987faccb260b9d39df1269) {$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
			SELECT
				`obj_id`
			FROM
				`cms3_objects_expiration`
			WHERE
				`obj_id` = {$v16b2b26000987faccb260b9d39df1269}
			LIMIT 1
SQL;   $v9b207167e5381c47682c6b4f58a623fb = l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);return mysql_num_rows($v9b207167e5381c47682c6b4f58a623fb) > 0;}public function getExpiredObjectsByTypeId($v5f694956811487225d15e973ca38fbab, $vaa9f73eea60a006820d0f8768bc8a3fc = 50) {$v07cc694b9b3fc636710fa08b6922c42b = time();$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
			SELECT
				`obj_id`
			FROM
				`cms3_objects_expiration`
			WHERE
				`obj_id`  IN (
					SELECT
						`id`
					FROM
						`cms3_objects`
					WHERE
						`type_id`='{$v5f694956811487225d15e973ca38fbab}'
					)
				AND (`entrytime` +  `expire`) <= {$v07cc694b9b3fc636710fa08b6922c42b}
			ORDER BY (`entrytime` +  `expire`)
			LIMIT {$vaa9f73eea60a006820d0f8768bc8a3fc}
SQL;   $result = array();$v9b207167e5381c47682c6b4f58a623fb = l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);if (mysql_numrows($v9b207167e5381c47682c6b4f58a623fb) > 0) {while($vf1965a857bc285d26fe22023aa5ab50d = mysql_fetch_assoc($v9b207167e5381c47682c6b4f58a623fb)) {$result[] = $vf1965a857bc285d26fe22023aa5ab50d['obj_id'];}}return $result;}public function run() {return;$v07cc694b9b3fc636710fa08b6922c42b = time();$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
DELETE FROM `cms3_objects`
	WHERE `id` IN (
		SELECT `obj_id`
			FROM `cms3_objects_expiration`
				WHERE (`entrytime` + `expire`) >= '{$v07cc694b9b3fc636710fa08b6922c42b}'
	)
SQL;   l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);}public function update($v16b2b26000987faccb260b9d39df1269, $v09bcb72d61c0d6d1eff5336da6881557 = false) {if($v09bcb72d61c0d6d1eff5336da6881557 == false) {$v09bcb72d61c0d6d1eff5336da6881557 = $this->defaultExpires;}$v16b2b26000987faccb260b9d39df1269 = (int) $v16b2b26000987faccb260b9d39df1269;$v09bcb72d61c0d6d1eff5336da6881557 = (int) $v09bcb72d61c0d6d1eff5336da6881557;$v07cc694b9b3fc636710fa08b6922c42b = time();$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
			UPDATE
				`cms3_objects_expiration`
			SET
				`entrytime`='{$v07cc694b9b3fc636710fa08b6922c42b}',
				`expire`='{$v09bcb72d61c0d6d1eff5336da6881557}'
			WHERE
				`obj_id` = '{$v16b2b26000987faccb260b9d39df1269}'
SQL;   l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);}public function add($v16b2b26000987faccb260b9d39df1269, $v09bcb72d61c0d6d1eff5336da6881557 = false) {if($v09bcb72d61c0d6d1eff5336da6881557 == false) {$v09bcb72d61c0d6d1eff5336da6881557 = $this->defaultExpires;}$v16b2b26000987faccb260b9d39df1269 = (int) $v16b2b26000987faccb260b9d39df1269;$v09bcb72d61c0d6d1eff5336da6881557 = (int) $v09bcb72d61c0d6d1eff5336da6881557;$v07cc694b9b3fc636710fa08b6922c42b = time();$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
INSERT INTO `cms3_objects_expiration`
	(`obj_id`, `entrytime`, `expire`)
		VALUES ('{$v16b2b26000987faccb260b9d39df1269}', '{$v07cc694b9b3fc636710fa08b6922c42b}', '{$v09bcb72d61c0d6d1eff5336da6881557}')
SQL;   l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);}public function clear($v16b2b26000987faccb260b9d39df1269) {$v16b2b26000987faccb260b9d39df1269 = (int) $v16b2b26000987faccb260b9d39df1269;$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
DELETE FROM `cms3_objects_expiration`
	WHERE `obj_id` = '{$v16b2b26000987faccb260b9d39df1269}'
SQL;   l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);}};?>