<?php
 class redirects implements iRedirects {public static function getInstance() {static $v7123a699d77db6479a1d8ece2c4f1c16;if(is_null($v7123a699d77db6479a1d8ece2c4f1c16)) {$v7123a699d77db6479a1d8ece2c4f1c16 = new redirects;}return $v7123a699d77db6479a1d8ece2c4f1c16;}public function add($v36cd38f49b9afa08222c0dc9ebfe35eb, $v42aefbae01d2dfd981f7da7d823d689e, $v9acb44549b41563697bb490144ec6258 = 301) {if($v36cd38f49b9afa08222c0dc9ebfe35eb == $v42aefbae01d2dfd981f7da7d823d689e) return;$v36cd38f49b9afa08222c0dc9ebfe35eb = l_mysql_real_escape_string($this->parseUri($v36cd38f49b9afa08222c0dc9ebfe35eb));$v42aefbae01d2dfd981f7da7d823d689e = l_mysql_real_escape_string($this->parseUri($v42aefbae01d2dfd981f7da7d823d689e));$v9acb44549b41563697bb490144ec6258 = (int) $v9acb44549b41563697bb490144ec6258;l_mysql_query("START TRANSACTION /* Adding new redirect records */");$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
INSERT INTO `cms3_redirects`
	(`source`, `target`, `status`)
	SELECT `source`, '{$v42aefbae01d2dfd981f7da7d823d689e}', '{$v9acb44549b41563697bb490144ec6258}' FROM `cms3_redirects`	
		WHERE `target` = '{$v36cd38f49b9afa08222c0dc9ebfe35eb}'
SQL;
DELETE FROM `cms3_redirects` WHERE `target` = '{$v36cd38f49b9afa08222c0dc9ebfe35eb}'
SQL;
INSERT INTO `cms3_redirects`
	(`source`, `target`, `status`)
	VALUES
	('{$v36cd38f49b9afa08222c0dc9ebfe35eb}', '{$v42aefbae01d2dfd981f7da7d823d689e}', '{$v9acb44549b41563697bb490144ec6258}')
SQL;
DELETE FROM `cms3_redirects` WHERE `id` = '{$vb80bb7740288fda1f201890375a60c8f}'
SQL;
SELECT `target`, `status` FROM `cms3_redirects`
	WHERE `source` = '{$vf0183130c6c478a364b95e4325786eb9}'
	ORDER BY `id` DESC LIMIT 1
SQL;
SELECT `source`, `target`, `status` FROM `cms3_redirects`
	WHERE `source` = '{$v059db73d368bc8964f075448480bb487}'
	ORDER BY `id` DESC LIMIT 1
SQL;