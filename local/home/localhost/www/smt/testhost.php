<?php
 class testHost {function testWWWApache() {if (!isset($this->parsedPhpInfo['server api']) && !isset($this->parsedPhpInfo['server_software']) ) {$this->assert(false, 13018);}else {if(isset($this->parsedPhpInfo['server api']) && strpos($this->parsedPhpInfo['server api'], 'apache') === false){if(isset($this->parsedPhpInfo['server_software']) && strpos($this->parsedPhpInfo['server_software'], 'apache') === false) {$this->assert(false, 13019);}}}}function testALLPhpVersion() {$vd6f966670a0018925185d18904ec47e9 = PHP_VERSION;preg_match("/[1-9]+.[0-9]+.[0-9]+/", $vd6f966670a0018925185d18904ec47e9, $v9c28d32df234037773be184dbdafc274);$vd6f966670a0018925185d18904ec47e9 = $v9c28d32df234037773be184dbdafc274[0];$this->assert(version_compare($vd6f966670a0018925185d18904ec47e9, '5.2.11', '>=') && version_compare($vd6f966670a0018925185d18904ec47e9, '5.5.8', '<='), 13000);}function testALLSuhosin() {foreach($this->parsedPhpInfo as $v3c6e0b8a9c15224a8228b9a98ca1531d => $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {if(strpos($v3c6e0b8a9c15224a8228b9a98ca1531d, 'suhosin') !== false ) {$this->assert(false, 13001, false);break;}}}function testALLMemoryLimit() {if (!isset($this->parsedPhpInfo['memory_limit'])) {$this->assert(false, 13002, false);}else {if(!preg_match('/G/i', $this->parsedPhpInfo['memory_limit']) && !preg_match('/T/i', $this->parsedPhpInfo['memory_limit'])) {if(preg_match('/K/i', $this->parsedPhpInfo['memory_limit'])) {$this->assert(false, 13003);}else {$this->assert(intval($this->parsedPhpInfo['memory_limit']) >= 32 || intval($this->parsedPhpInfo['memory_limit']) == -1, 13003);}}else {$this->assert(true, 13003);}}}function testALLSafeMode() {if (!isset($this->parsedPhpInfo['safe_mode'])) {$this->assert(false, 13004, false);}else {$this->assert($this->parsedPhpInfo['safe_mode'] == 'off', 13005);}}function testALLRegisterGlobals() {if (!isset($this->parsedPhpInfo['register_globals'])) {$this->assert(false, 13080, false);}else {$this->assert($this->parsedPhpInfo['register_globals'] == 'off', 13081, false);}}function testWWWModRewrite() {if (!isset($this->parsedPhpInfo['loaded modules'])) {$this->assert(false, 13006, false);}else {$this->assert(strpos($this->parsedPhpInfo['loaded modules'], 'mod_rewrite') !== false, 13007);}}function testWWWModAuth() {if (!isset($this->parsedPhpInfo['loaded modules'])) {$this->assert(false, 13008, false);}else {$this->assert(strpos($this->parsedPhpInfo['loaded modules'], 'mod_auth') !== false, 13009);}}function testALLLibraries() {$v550d742961671466d104ab3e933c790d = array('zlib', 'gd', 'libxml', 'iconv', 'xsl', 'simplexml', 'xmlreader', 'multibyte');$v68e77c9c4d583159feeb1bf44c9a631a = 0;foreach ($v550d742961671466d104ab3e933c790d as $v3c6e0b8a9c15224a8228b9a98ca1531d => $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {$v7e85bcb66fb9a809d5ab4f62a8b8bea8 = true;if ($v3a6d0284e743dc4a9b86f97d6dd1a3bf == 'multibyte') $v7e85bcb66fb9a809d5ab4f62a8b8bea8 = false;if (isset($this->parsedPhpInfo["{$v3a6d0284e743dc4a9b86f97d6dd1a3bf} support"])) {$v3a6d0284e743dc4a9b86f97d6dd1a3bf = "{$v3a6d0284e743dc4a9b86f97d6dd1a3bf} support";}if (!isset($this->parsedPhpInfo[$v3a6d0284e743dc4a9b86f97d6dd1a3bf])) {$this->assert(false, 13020 + $v68e77c9c4d583159feeb1bf44c9a631a++, $v7e85bcb66fb9a809d5ab4f62a8b8bea8);}else {$this->assert($this->parsedPhpInfo[$v3a6d0284e743dc4a9b86f97d6dd1a3bf] == 'enabled' ||     $this->parsedPhpInfo[$v3a6d0284e743dc4a9b86f97d6dd1a3bf] == 'active', 13030 + $v68e77c9c4d583159feeb1bf44c9a631a++, $v7e85bcb66fb9a809d5ab4f62a8b8bea8);}}}function testJSONSupport() {if (!function_exists('json_decode') || !function_exists('json_encode')) {$this->assert(false, 13028, true);}}function testALLAllowUrlFopen() {if(!isset($this->parsedPhpInfo['allow_url_fopen']) && !isset($this->parsedPhpInfo['curl support'])){$this->assert(false, 13040);}elseif ($this->parsedPhpInfo['allow_url_fopen'] == 'off') {if (isset($this->parsedPhpInfo['curl support']) && strpos($this->parsedPhpInfo['curl support'], "enable")!==false) {$this->checkSession('curl');}else {$this->assert(false, 13041);}}else {$this->checkSession();}}function testALLIIS() {if(isset($this->parsedPhpInfo['_server["server_software"]']) && (strpos($this->parsedPhpInfo['_server["server_software"]'], "iis") !== false || strpos($this->parsedPhpInfo['_server["server_software"]'], "windows") !== false)){$this->assert(false, 13090, false);}}function testALLPerms() {$this->assert(is_writable(dirname(__FILE__)), 13010);}function checkSession($v15d61712450a686a7f365adf4fef581f = 'fopen') {if (!$this->domain) return;file_put_contents(CURRENT_WORKING_DIR . '/umi_smt.php', '<?php 
			@session_start(); 
			$_SESSION["test"] = "test"; 
			$sessionId = session_id();
			@session_write_close(); 
			unset($_SESSION["test"]); 
			@session_start($sessionId);
			echo($_SESSION["test"]);');if (!defined("PHP_FILES_ACCESS_MODE")) {$v15d61712450a686a7f365adf4fef581f = substr(decoct(fileperms(__FILE__)), -4, 4);chmod(CURRENT_WORKING_DIR . '/umi_smt.php', octdec($v15d61712450a686a7f365adf4fef581f));}else {chmod(CURRENT_WORKING_DIR . '/umi_smt.php', PHP_FILES_ACCESS_MODE);}$v19e03fd9d22ec02340b6c0a1e3ffacc7 = 'http://' . $this->domain . '/umi_smt.php';$result = '';if ($v15d61712450a686a7f365adf4fef581f == 'fopen') {$result = file_get_contents($v19e03fd9d22ec02340b6c0a1e3ffacc7);}else {$vd88fc6edf21ea464d35ff76288b84103 = curl_init();curl_setopt($vd88fc6edf21ea464d35ff76288b84103, CURLOPT_URL, $v19e03fd9d22ec02340b6c0a1e3ffacc7);curl_setopt($vd88fc6edf21ea464d35ff76288b84103, CURLOPT_HEADER, 0);curl_setopt($vd88fc6edf21ea464d35ff76288b84103, CURLOPT_RETURNTRANSFER, 1);$result = curl_exec($vd88fc6edf21ea464d35ff76288b84103);}$this->assert($result == 'test', 13083);unlink(CURRENT_WORKING_DIR . '/umi_smt.php');}function testALLConnect() {$v2a304a1348456ccd2234cd71a81bd338 = @mysql_connect ($this->host, $this->user, $this->password);$vd77d5e503ad1439f585ac494268b351b = @mysql_select_db($this->database);$this->assert($v2a304a1348456ccd2234cd71a81bd338 && $vd77d5e503ad1439f585ac494268b351b, 13011);if ($v2a304a1348456ccd2234cd71a81bd338 && $vd77d5e503ad1439f585ac494268b351b){$v17569e8ba32971d8bf01ca2706bdeaf2 = mysql_get_server_info();if (!$v17569e8ba32971d8bf01ca2706bdeaf2) {$this->assert(false, 13070);}else {preg_match("/[1-9]+.[0-9]+.[0-9]+/", $v17569e8ba32971d8bf01ca2706bdeaf2, $v9c28d32df234037773be184dbdafc274);$v17569e8ba32971d8bf01ca2706bdeaf2 = $v9c28d32df234037773be184dbdafc274[0];$this->assert(version_compare($v17569e8ba32971d8bf01ca2706bdeaf2, '4.1.0', '>='), 13071);}$vf1965a857bc285d26fe22023aa5ab50d=mysql_fetch_array(mysql_query("show variables like 'character_set_database'"));$this->assert($vf1965a857bc285d26fe22023aa5ab50d[1] == 'utf8', 13012, false);$v07cc694b9b3fc636710fa08b6922c42b = time();$this->assert(mysql_query("create table `test{$v07cc694b9b3fc636710fa08b6922c42b}` (a int not null auto_increment, primary key (a))"), 13013);$this->assert(mysql_query("create temporary table `temporary_table{$v07cc694b9b3fc636710fa08b6922c42b}` like `test{$v07cc694b9b3fc636710fa08b6922c42b}`"), 13048);mysql_query("drop temporary table `temporary_table{$v07cc694b9b3fc636710fa08b6922c42b}`");$this->assert(mysql_query("alter table `test{$v07cc694b9b3fc636710fa08b6922c42b}` ADD b int(7) NULL"), 13014);$this->assert(mysql_query("insert into `test{$v07cc694b9b3fc636710fa08b6922c42b}` (b) values (11)"), 13043);$this->assert(mysql_query("select * from `test{$v07cc694b9b3fc636710fa08b6922c42b}`"), 13044);$this->assert(mysql_query("update `test{$v07cc694b9b3fc636710fa08b6922c42b}` set b=12 where b=11"), 13045);$this->assert(mysql_query("delete from `test{$v07cc694b9b3fc636710fa08b6922c42b}`"), 13046);$this->assert(mysql_query("SET foreign_key_checks = 1"), 13047);$this->assert(mysql_query("drop table `test{$v07cc694b9b3fc636710fa08b6922c42b}`"), 13015);$vbc2d9bd849140ea4ae2437007f5a8371 = false;$result = mysql_query("SHOW VARIABLES LIKE 'have_innodb'");if (mysql_numrows($result) > 0) {$vf1965a857bc285d26fe22023aa5ab50d = mysql_fetch_array($result);if (strtolower($vf1965a857bc285d26fe22023aa5ab50d['Value']) == "yes") {$vbc2d9bd849140ea4ae2437007f5a8371 = true;}}else {$result = mysql_query("SHOW ENGINES");if (mysql_numrows($result) > 0) {while($vf1965a857bc285d26fe22023aa5ab50d = mysql_fetch_assoc($result)) {if (strtolower($vf1965a857bc285d26fe22023aa5ab50d['Engine']) == 'innodb' && (strtolower($vf1965a857bc285d26fe22023aa5ab50d['Support']) == 'yes' || strtolower($vf1965a857bc285d26fe22023aa5ab50d['Support']) == 'default')) {$vbc2d9bd849140ea4ae2437007f5a8371 = true;break;}}}}$this->assert($vbc2d9bd849140ea4ae2437007f5a8371, 13016);}}function run(){$v9cf2b355321721c32cf156db7683c382 = get_class_methods($this);foreach ($v9cf2b355321721c32cf156db7683c382 as $vddaa6e8c8c412299272e183087b8f7b6) {if ( (preg_match("/^testALL/i", $vddaa6e8c8c412299272e183087b8f7b6))     || (preg_match("/^testCLI/i", $vddaa6e8c8c412299272e183087b8f7b6) && $this->cli_mode)     || (preg_match("/^testWWW/i", $vddaa6e8c8c412299272e183087b8f7b6) && !$this->cli_mode) ) {$this->$vddaa6e8c8c412299272e183087b8f7b6();}}}function assert($v2063c1608d6e0baf80249c42e2be5804, $v0279985cdca9ad2836b5dc949af215c8, $v7e85bcb66fb9a809d5ab4f62a8b8bea8 = true, $v6efc3a4b88162d72cd844eaabb9a0153 = '') {if(!$v2063c1608d6e0baf80249c42e2be5804) {$this->listErrors[] = array($v0279985cdca9ad2836b5dc949af215c8, $v7e85bcb66fb9a809d5ab4f62a8b8bea8, $v6efc3a4b88162d72cd844eaabb9a0153);}}function getPhpInfo($result) {$v9b207167e5381c47682c6b4f58a623fb = explode('<h1>PHP Credits</h1>', $result);$result = $v9b207167e5381c47682c6b4f58a623fb[0];preg_match_all("/<tr>(.+)<\/tr>/", $result, $v9c28d32df234037773be184dbdafc274);foreach ($v9c28d32df234037773be184dbdafc274[0] as $vb45cffe084dd3d20d928bee85e7b0f21) {if(preg_match_all("/<td class=\"[ve]\">(.+?)<\/td>/", $vb45cffe084dd3d20d928bee85e7b0f21, $vf09cc7ee3a9a93273f4b80601cafb00c)){if (!isset($vf09cc7ee3a9a93273f4b80601cafb00c[1][1])) {$vf09cc7ee3a9a93273f4b80601cafb00c[1][1] = "";}$this->parsedPhpInfo[trim(strtolower($vf09cc7ee3a9a93273f4b80601cafb00c[1][0]))] = strip_tags(trim(strtolower($vf09cc7ee3a9a93273f4b80601cafb00c[1][1])));}}preg_match_all("/<tr class=\"h\">(.+)<\/tr>/", $result, $v84f95e51c35582fb69b329b6e2d54bdb);foreach ($v84f95e51c35582fb69b329b6e2d54bdb[0] as $vb45cffe084dd3d20d928bee85e7b0f21) {if(preg_match_all("/<th>(.+?)<\/th>/", $vb45cffe084dd3d20d928bee85e7b0f21, $v26359b33721f89c49ebffc1040dfb4ec)){if(isset($v26359b33721f89c49ebffc1040dfb4ec[1][0]) && isset($v26359b33721f89c49ebffc1040dfb4ec[1][1]))$this->parsedPhpInfo[trim(strtolower($v26359b33721f89c49ebffc1040dfb4ec[1][0]))] = strip_tags(trim(strtolower($v26359b33721f89c49ebffc1040dfb4ec[1][1])));}}}function getPhpInfoCli($result) {$v3be2a3b771431f2096ff984899869fa6 = explode("\n", strtolower($result));foreach($v3be2a3b771431f2096ff984899869fa6 as $v3c6e0b8a9c15224a8228b9a98ca1531d=>$v2063c1608d6e0baf80249c42e2be5804) {if (false===strpos($v2063c1608d6e0baf80249c42e2be5804, '=>')) {continue;}$v78f0805fa8ffadabda721fdaf85b3ca9 = explode('=>', $v2063c1608d6e0baf80249c42e2be5804);foreach($v78f0805fa8ffadabda721fdaf85b3ca9 as $v8ce4b16b22b58894aa86c421e8759df3=>$v9e3669d19b675bd57058fd4664205d2a) {$v78f0805fa8ffadabda721fdaf85b3ca9[$v8ce4b16b22b58894aa86c421e8759df3] = trim($v9e3669d19b675bd57058fd4664205d2a);}$this->parsedPhpInfo[$v78f0805fa8ffadabda721fdaf85b3ca9[0]] = $v78f0805fa8ffadabda721fdaf85b3ca9[1];}}function testHost($v0e05d74bbc655cc42c026f2353d1eb63 = array(), $vad5f82e879a9c5d6b5b442eb37e50551 = null) {$this->listErrors = array();$this->parsedPhpInfo = array();$this->cli_mode = (boolean) (defined('UMICMS_CLI_MODE') && UMICMS_CLI_MODE);$this->domain = $vad5f82e879a9c5d6b5b442eb37e50551;if(count($v0e05d74bbc655cc42c026f2353d1eb63)) {$this->parsedPhpInfo = $v0e05d74bbc655cc42c026f2353d1eb63;}else {ob_start();phpinfo();$result = ob_get_clean();if (strpos($result, "<html") !== false) {$this->getPhpInfo($result);}else {$this->getPhpInfoCli($result);}}}function setConnect($v67b3dba8bc6778101892eb77249db32e, $vee11cbb19052e40b07aac0ca060c23ee, $v5f4dcc3b5aa765d61d8327deb882cf99, $v11e0eed8d3696c0a632f822df385ab3c) {$this->user = $vee11cbb19052e40b07aac0ca060c23ee;$this->host = $v67b3dba8bc6778101892eb77249db32e;$this->password = $v5f4dcc3b5aa765d61d8327deb882cf99;$this->database = $v11e0eed8d3696c0a632f822df385ab3c;}function getResults(){$this->run();return $this->listErrors;}};?>
