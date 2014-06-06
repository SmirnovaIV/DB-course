<?php
 class umiObjectsExpiration extends singleton implements iSingleton, iUmiObjectsExpiration {protected $defaultExpires = 86400;protected function __construct() {}public static function getInstance($v4a8a08f09d37b73795649038408b5f33 = NULL) {return parent::getInstance(__CLASS__);}public function isExpirationExists($v16b2b26000987faccb260b9d39df1269) {$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
			SELECT
				`obj_id`
			FROM
				`cms3_objects_expiration`
			WHERE
				`obj_id` = {$v16b2b26000987faccb260b9d39df1269}
			LIMIT 1
SQL;
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
SQL;
DELETE FROM `cms3_objects`
	WHERE `id` IN (
		SELECT `obj_id`
			FROM `cms3_objects_expiration`
				WHERE (`entrytime` + `expire`) >= '{$v07cc694b9b3fc636710fa08b6922c42b}'
	)
SQL;
			UPDATE
				`cms3_objects_expiration`
			SET
				`entrytime`='{$v07cc694b9b3fc636710fa08b6922c42b}',
				`expire`='{$v09bcb72d61c0d6d1eff5336da6881557}'
			WHERE
				`obj_id` = '{$v16b2b26000987faccb260b9d39df1269}'
SQL;
INSERT INTO `cms3_objects_expiration`
	(`obj_id`, `entrytime`, `expire`)
		VALUES ('{$v16b2b26000987faccb260b9d39df1269}', '{$v07cc694b9b3fc636710fa08b6922c42b}', '{$v09bcb72d61c0d6d1eff5336da6881557}')
SQL;
DELETE FROM `cms3_objects_expiration`
	WHERE `obj_id` = '{$v16b2b26000987faccb260b9d39df1269}'
SQL;