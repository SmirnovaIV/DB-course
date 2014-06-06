<?php
 class umiEventFeed {private static $connection;private $id;private $date;private $params;public static function setConnection(iConnection $v4717d53ebfdfea8477f780ec66151dcb) {self::$connection = $v4717d53ebfdfea8477f780ec66151dcb;}public static function getConnection() {if (is_null(self::$connection)) {throw new Exception('No database connection is set');}return self::$connection;}public static function create(umiEventFeedType $v599dcce2998a6b40b1e38e8c6006cb0a, $v21ffce5b8a6cc8cc6a41448dd69623c9 = array(), $v7552cd149af7495ee7d8225974e50f80 = null, $v16b2b26000987faccb260b9d39df1269 = null) {$v5f694956811487225d15e973ca38fbab = $v599dcce2998a6b40b1e38e8c6006cb0a->getId();$v5fc732311905cb27e82d67f4f6511f7f = time();$v21ffce5b8a6cc8cc6a41448dd69623c9 = serialize($v21ffce5b8a6cc8cc6a41448dd69623c9);$v7552cd149af7495ee7d8225974e50f80 = (int) $v7552cd149af7495ee7d8225974e50f80;$v16b2b26000987faccb260b9d39df1269 = (int) $v16b2b26000987faccb260b9d39df1269;self::getConnection()->query("INSERT INTO `umi_event_feeds` (type_id, date, params, element_id, object_id) VALUES('{$v5f694956811487225d15e973ca38fbab}', '{$v5fc732311905cb27e82d67f4f6511f7f}', '{$v21ffce5b8a6cc8cc6a41448dd69623c9}', '{$v7552cd149af7495ee7d8225974e50f80}', '{$v16b2b26000987faccb260b9d39df1269}')");}public static function markReadEvent($v53cc4db543d7a569e51c1d76ac6f278e, $v8e44f0089b076e18a718eb9ca3d94674) {$v53cc4db543d7a569e51c1d76ac6f278e = (int) $v53cc4db543d7a569e51c1d76ac6f278e;$v8e44f0089b076e18a718eb9ca3d94674 = (int) $v8e44f0089b076e18a718eb9ca3d94674;self::getConnection()->query("INSERT INTO `umi_event_user_history` (user_id, event_id) VALUES('{$v8e44f0089b076e18a718eb9ca3d94674}', '{$v53cc4db543d7a569e51c1d76ac6f278e}')");}public static function markUnreadEvent($v53cc4db543d7a569e51c1d76ac6f278e, $v8e44f0089b076e18a718eb9ca3d94674) {$v53cc4db543d7a569e51c1d76ac6f278e = (int) $v53cc4db543d7a569e51c1d76ac6f278e;$v8e44f0089b076e18a718eb9ca3d94674 = (int) $v8e44f0089b076e18a718eb9ca3d94674;self::getConnection()->query("DELETE FROM `umi_event_user_history` WHERE user_id = '{$v8e44f0089b076e18a718eb9ca3d94674}' AND event_id = '{$v53cc4db543d7a569e51c1d76ac6f278e}'");}public function findEventIdByElementId($v7552cd149af7495ee7d8225974e50f80) {$v7552cd149af7495ee7d8225974e50f80 = (int) $v7552cd149af7495ee7d8225974e50f80;$v53cc4db543d7a569e51c1d76ac6f278e = false;$v16908b0605f2645dfcb4c3a8d248cef3 = self::getConnection()->queryResult("SELECT id FROM `umi_event_feeds` WHERE element_id = {$v7552cd149af7495ee7d8225974e50f80}");foreach($v16908b0605f2645dfcb4c3a8d248cef3 as $v4119639092e62c55ea8be348e4d9260d) {$v53cc4db543d7a569e51c1d76ac6f278e = $v4119639092e62c55ea8be348e4d9260d['id'];}return $v53cc4db543d7a569e51c1d76ac6f278e;}public function findEventIdByObjectId($v16b2b26000987faccb260b9d39df1269) {$v16b2b26000987faccb260b9d39df1269 = (int) $v16b2b26000987faccb260b9d39df1269;$v53cc4db543d7a569e51c1d76ac6f278e = false;$v16908b0605f2645dfcb4c3a8d248cef3 = self::getConnection()->queryResult("SELECT id FROM `umi_event_feeds` WHERE object_id = {$v16b2b26000987faccb260b9d39df1269}");foreach($v16908b0605f2645dfcb4c3a8d248cef3 as $v4119639092e62c55ea8be348e4d9260d) {$v53cc4db543d7a569e51c1d76ac6f278e = $v4119639092e62c55ea8be348e4d9260d['id'];}return $v53cc4db543d7a569e51c1d76ac6f278e;}public static function getList($vd14a8022b085f9ef19d479cbdd581127 = array(), $v8e44f0089b076e18a718eb9ca3d94674, $vaa9f73eea60a006820d0f8768bc8a3fc = null, $v7a86c157ee9713c34fbd7a1ee40f0c5a = null, $ve4dfb3f5dd911dc868eb4f2c2a836d64 = null, $v813e94378d42501d835b2ed6253dc463 = null) {$vaa9f73eea60a006820d0f8768bc8a3fc = (int) $vaa9f73eea60a006820d0f8768bc8a3fc;$v7a86c157ee9713c34fbd7a1ee40f0c5a = (int) $v7a86c157ee9713c34fbd7a1ee40f0c5a;$ve4dfb3f5dd911dc868eb4f2c2a836d64 = (int) $ve4dfb3f5dd911dc868eb4f2c2a836d64;$v813e94378d42501d835b2ed6253dc463 = (int) $v813e94378d42501d835b2ed6253dc463;$v8e44f0089b076e18a718eb9ca3d94674 = (int) $v8e44f0089b076e18a718eb9ca3d94674;$v10ae9fc7d453b0dd525d0edf2ede7961 = array();$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT @a:=(SELECT `read` FROM `umi_event_user_history` WHERE `event_id` = `id` AND `user_id` = {$v8e44f0089b076e18a718eb9ca3d94674} GROUP BY event_id) as `read`, `id` FROM `umi_event_feeds` WHERE";if (is_array($vd14a8022b085f9ef19d479cbdd581127) && count($vd14a8022b085f9ef19d479cbdd581127)) {foreach ($vd14a8022b085f9ef19d479cbdd581127 as &$v5f694956811487225d15e973ca38fbab) {$v5f694956811487225d15e973ca38fbab = self::getConnection()->escape($v5f694956811487225d15e973ca38fbab);}$vac5c74b64b4b8352ef2f181affb5ac2a .= " `type_id` IN ('" . implode("', '", $vd14a8022b085f9ef19d479cbdd581127) . "') AND";}if ($ve4dfb3f5dd911dc868eb4f2c2a836d64) $vac5c74b64b4b8352ef2f181affb5ac2a .= " `date` > {$ve4dfb3f5dd911dc868eb4f2c2a836d64} AND";if ($v813e94378d42501d835b2ed6253dc463) $vac5c74b64b4b8352ef2f181affb5ac2a .= " `date` < {$v813e94378d42501d835b2ed6253dc463} AND";$vac5c74b64b4b8352ef2f181affb5ac2a .= " `date` > 0 ORDER BY `date` DESC";if ($vaa9f73eea60a006820d0f8768bc8a3fc > 0) $vac5c74b64b4b8352ef2f181affb5ac2a .= " LIMIT {$vaa9f73eea60a006820d0f8768bc8a3fc}";if ($v7a86c157ee9713c34fbd7a1ee40f0c5a > 0) $vac5c74b64b4b8352ef2f181affb5ac2a .= " OFFSET {$v7a86c157ee9713c34fbd7a1ee40f0c5a}";$v16908b0605f2645dfcb4c3a8d248cef3 = self::getConnection()->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);foreach($v16908b0605f2645dfcb4c3a8d248cef3 as $v4119639092e62c55ea8be348e4d9260d) {$v10ae9fc7d453b0dd525d0edf2ede7961[$v4119639092e62c55ea8be348e4d9260d['id']] = array(     'read' => (int) $v4119639092e62c55ea8be348e4d9260d['read'],     'event' => self::get($v4119639092e62c55ea8be348e4d9260d['id'])    );}return $v10ae9fc7d453b0dd525d0edf2ede7961;}public static function getUnreadList($v5f694956811487225d15e973ca38fbab, $v8e44f0089b076e18a718eb9ca3d94674, $vaa9f73eea60a006820d0f8768bc8a3fc = null, $v7a86c157ee9713c34fbd7a1ee40f0c5a = null, $ve4dfb3f5dd911dc868eb4f2c2a836d64 = null, $v813e94378d42501d835b2ed6253dc463 = null) {$vaa9f73eea60a006820d0f8768bc8a3fc = (int) $vaa9f73eea60a006820d0f8768bc8a3fc;$v7a86c157ee9713c34fbd7a1ee40f0c5a = (int) $v7a86c157ee9713c34fbd7a1ee40f0c5a;$ve4dfb3f5dd911dc868eb4f2c2a836d64 = (int) $ve4dfb3f5dd911dc868eb4f2c2a836d64;$v813e94378d42501d835b2ed6253dc463 = (int) $v813e94378d42501d835b2ed6253dc463;$v8e44f0089b076e18a718eb9ca3d94674 = (int) $v8e44f0089b076e18a718eb9ca3d94674;$v5f694956811487225d15e973ca38fbab = self::getConnection()->escape($v5f694956811487225d15e973ca38fbab);$v10ae9fc7d453b0dd525d0edf2ede7961 = array();$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT id 
					FROM `umi_event_feeds`
						WHERE 
							type_id = '{$v5f694956811487225d15e973ca38fbab}' AND
							id NOT IN 
								(SELECT event_id FROM umi_event_user_history WHERE user_id = {$v8e44f0089b076e18a718eb9ca3d94674})
							AND";if ($ve4dfb3f5dd911dc868eb4f2c2a836d64) $vac5c74b64b4b8352ef2f181affb5ac2a .= " date > {$ve4dfb3f5dd911dc868eb4f2c2a836d64} AND";if ($v813e94378d42501d835b2ed6253dc463) $vac5c74b64b4b8352ef2f181affb5ac2a .= " date < {$v813e94378d42501d835b2ed6253dc463} AND";$vac5c74b64b4b8352ef2f181affb5ac2a .= " date > 0 ORDER BY `date` DESC";if ($vaa9f73eea60a006820d0f8768bc8a3fc > 0) $vac5c74b64b4b8352ef2f181affb5ac2a .= " LIMIT {$vaa9f73eea60a006820d0f8768bc8a3fc}";if ($v7a86c157ee9713c34fbd7a1ee40f0c5a > 0) $vac5c74b64b4b8352ef2f181affb5ac2a .= " OFFSET {$v7a86c157ee9713c34fbd7a1ee40f0c5a}";$v16908b0605f2645dfcb4c3a8d248cef3 = self::getConnection()->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);foreach($v16908b0605f2645dfcb4c3a8d248cef3 as $v4119639092e62c55ea8be348e4d9260d) {$v10ae9fc7d453b0dd525d0edf2ede7961[$v4119639092e62c55ea8be348e4d9260d['id']] = self::get($v4119639092e62c55ea8be348e4d9260d['id']);}return $v10ae9fc7d453b0dd525d0edf2ede7961;}public static function deleteList($vd14a8022b085f9ef19d479cbdd581127 = array(), $ve4dfb3f5dd911dc868eb4f2c2a836d64 = null, $v813e94378d42501d835b2ed6253dc463 = null) {$ve4dfb3f5dd911dc868eb4f2c2a836d64 = (int) $ve4dfb3f5dd911dc868eb4f2c2a836d64;$v813e94378d42501d835b2ed6253dc463 = (int) $v813e94378d42501d835b2ed6253dc463;$vac5c74b64b4b8352ef2f181affb5ac2a = "DELETE FROM umi_event_feeds WHERE";if (is_array($vd14a8022b085f9ef19d479cbdd581127) && count($vd14a8022b085f9ef19d479cbdd581127)) {foreach ($vd14a8022b085f9ef19d479cbdd581127 as &$v5f694956811487225d15e973ca38fbab) {$v5f694956811487225d15e973ca38fbab = self::getConnection()->escape($v5f694956811487225d15e973ca38fbab);}$vac5c74b64b4b8352ef2f181affb5ac2a .= " type_id IN ('" . implode("', '", $vd14a8022b085f9ef19d479cbdd581127) . "') AND";}if ($ve4dfb3f5dd911dc868eb4f2c2a836d64) $vac5c74b64b4b8352ef2f181affb5ac2a .= " date < {$ve4dfb3f5dd911dc868eb4f2c2a836d64} AND";if ($v813e94378d42501d835b2ed6253dc463) $vac5c74b64b4b8352ef2f181affb5ac2a .= " date > {$v813e94378d42501d835b2ed6253dc463} AND";$vac5c74b64b4b8352ef2f181affb5ac2a .= " date > 0";self::getConnection()->query($vac5c74b64b4b8352ef2f181affb5ac2a);}public static function deleteEvent($v53cc4db543d7a569e51c1d76ac6f278e) {$v53cc4db543d7a569e51c1d76ac6f278e = (int) $v53cc4db543d7a569e51c1d76ac6f278e;$vac5c74b64b4b8352ef2f181affb5ac2a = "DELETE FROM umi_event_feeds WHERE id={$v53cc4db543d7a569e51c1d76ac6f278e}";self::getConnection()->query($vac5c74b64b4b8352ef2f181affb5ac2a);}public static function getListCount($vd14a8022b085f9ef19d479cbdd581127 = array(), $v8e44f0089b076e18a718eb9ca3d94674 = null, $ve4dfb3f5dd911dc868eb4f2c2a836d64 = null, $v813e94378d42501d835b2ed6253dc463 = null) {$ve4dfb3f5dd911dc868eb4f2c2a836d64 = (int) $ve4dfb3f5dd911dc868eb4f2c2a836d64;$v813e94378d42501d835b2ed6253dc463 = (int) $v813e94378d42501d835b2ed6253dc463;$v8e44f0089b076e18a718eb9ca3d94674 = (int) $v8e44f0089b076e18a718eb9ca3d94674;$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT count(*)	FROM `umi_event_feeds` WHERE";if (is_array($vd14a8022b085f9ef19d479cbdd581127) && count($vd14a8022b085f9ef19d479cbdd581127)) {foreach ($vd14a8022b085f9ef19d479cbdd581127 as &$v5f694956811487225d15e973ca38fbab) {$v5f694956811487225d15e973ca38fbab = self::getConnection()->escape($v5f694956811487225d15e973ca38fbab);}$vac5c74b64b4b8352ef2f181affb5ac2a .= " type_id IN ('" . implode("', '", $vd14a8022b085f9ef19d479cbdd581127) . "') AND";}if ($v8e44f0089b076e18a718eb9ca3d94674) {$vac5c74b64b4b8352ef2f181affb5ac2a .= " id NOT IN (SELECT event_id FROM umi_event_user_history WHERE user_id = {$v8e44f0089b076e18a718eb9ca3d94674}) AND";}if ($ve4dfb3f5dd911dc868eb4f2c2a836d64) $vac5c74b64b4b8352ef2f181affb5ac2a .= " date > {$ve4dfb3f5dd911dc868eb4f2c2a836d64} AND";if ($v813e94378d42501d835b2ed6253dc463) $vac5c74b64b4b8352ef2f181affb5ac2a .= " date < {$v813e94378d42501d835b2ed6253dc463} AND";$vac5c74b64b4b8352ef2f181affb5ac2a .= " date > 0";$ve45da171ed59f4e3d9e611043bea6380 = self::getConnection()->queryResult($vac5c74b64b4b8352ef2f181affb5ac2a);foreach($ve45da171ed59f4e3d9e611043bea6380 as $v4119639092e62c55ea8be348e4d9260d) {return $v4119639092e62c55ea8be348e4d9260d[0];}}public function __construct($vb80bb7740288fda1f201890375a60c8f) {$vb80bb7740288fda1f201890375a60c8f = (int) $vb80bb7740288fda1f201890375a60c8f;$this->id = $vb80bb7740288fda1f201890375a60c8f;$this->load();}public static function get($vb80bb7740288fda1f201890375a60c8f) {return new self($vb80bb7740288fda1f201890375a60c8f);}public function getId() {return $this->id;}public function getTypeId() {return $this->typeId;}public function getDate() {return $this->date;}public function getParams() {return $this->params;}public function load() {$vb80bb7740288fda1f201890375a60c8f = (int) $this->id;$vce3280d763b11208823de6adaa1d80dd = self::getConnection()->queryResult("SELECT type_id, date, params FROM umi_event_feeds WHERE id = {$vb80bb7740288fda1f201890375a60c8f}", true);if (!$vce3280d763b11208823de6adaa1d80dd || !$vce3280d763b11208823de6adaa1d80dd->length()) {throw new privateException("Failed to load info for umiEventFeed with id {$vb80bb7740288fda1f201890375a60c8f}");}foreach ($vce3280d763b11208823de6adaa1d80dd as $vcaf9b6b99962bf5c2264824231d7a40c) {$this->date = $vcaf9b6b99962bf5c2264824231d7a40c['date'];$this->params = unserialize($vcaf9b6b99962bf5c2264824231d7a40c['params']);$this->typeId = $vcaf9b6b99962bf5c2264824231d7a40c['type_id'];}}}?>
