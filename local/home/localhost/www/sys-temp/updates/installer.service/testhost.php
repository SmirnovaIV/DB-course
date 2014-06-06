<?php
	class testHost {
		/**
		* Проверка веб-сервера
		*/
		function testWWWApache() {
			if (!isset($this->parsedPhpInfo['server api']) && !isset($this->parsedPhpInfo['server_software']) ) {
				$this->assert(false, 13018);
			}
			else {
				if(isset($this->parsedPhpInfo['server api']) && strpos($this->parsedPhpInfo['server api'], 'apache') === false){
					if(isset($this->parsedPhpInfo['server_software']) && strpos($this->parsedPhpInfo['server_software'], 'apache') === false) {
						$this->assert(false, 13019);
					}
				}
			}
		}

		/**
		* Проверка версии PHP
		*/
		function testALLPhpVersion() {
			$phpVersion = PHP_VERSION;
			preg_match("/[1-9]+.[0-9]+.[0-9]+/", $phpVersion, $matches);
			$phpVersion = $matches[0];

			$this->assert(version_compare($phpVersion, '5.2.11', '>=') && version_compare($phpVersion, '5.5.8', '<='), 13000);
		}


		/**
		* Проверка отсутствия Suhosin Patch
		*/
		function testALLSuhosin() {
			foreach($this->parsedPhpInfo as $key => $val) {
				if(strpos($key, 'suhosin') !== false ) {
					$this->assert(false, 13001, false);
					break;
				}
			}
		}

		/**
		* Проверка параметра memory_limit
		*/
		function testALLMemoryLimit() {
			if (!isset($this->parsedPhpInfo['memory_limit'])) {
				$this->assert(false, 13002, false);
			}
			else {
				if(!preg_match('/G/i', $this->parsedPhpInfo['memory_limit']) && !preg_match('/T/i', $this->parsedPhpInfo['memory_limit'])) {
					if(preg_match('/K/i', $this->parsedPhpInfo['memory_limit'])) {
						$this->assert(false, 13003);
					} else {
						$this->assert(intval($this->parsedPhpInfo['memory_limit']) >= 32 || intval($this->parsedPhpInfo['memory_limit']) == -1, 13003);
					}
				} else {
					$this->assert(true, 13003);
				}
			}
		}

		/**
		* Проверка safe_mode=0ff
		*/

		function testALLSafeMode() {

			if (!isset($this->parsedPhpInfo['safe_mode'])) {
				$this->assert(false, 13004, false);
			}
			else {
				$this->assert($this->parsedPhpInfo['safe_mode'] == 'off', 13005);
			}
		}
		/**
		* Проверка register_globals=0ff
		*/

		function testALLRegisterGlobals() {

			if (!isset($this->parsedPhpInfo['register_globals'])) {
				$this->assert(false, 13080, false);
			} else {
				$this->assert($this->parsedPhpInfo['register_globals'] == 'off', 13081, false);
			}
		}

		/**
		* Проверка наличия модуля mod_rewrite
		*/
		function testWWWModRewrite() {
			if (!isset($this->parsedPhpInfo['loaded modules'])) {
				$this->assert(false, 13006, false);
			}
			else {
				$this->assert(strpos($this->parsedPhpInfo['loaded modules'], 'mod_rewrite') !== false, 13007);
			}
		}

		/**
		* Проверка наличия модуля mod_auth
		*/
		function testWWWModAuth() {
			if (!isset($this->parsedPhpInfo['loaded modules'])) {
				$this->assert(false, 13008, false);
			}
			else {
				$this->assert(strpos($this->parsedPhpInfo['loaded modules'], 'mod_auth') !== false, 13009);
			}
		}

		/**
		* Проверка наличия библиотек
		*/
		function testALLLibraries() {

			$libraries = array('zlib', 'gd', 'libxml', 'iconv', 'xsl', 'simplexml', 'xmlreader', 'multibyte');

			$errorCounter = 0;
			foreach ($libraries as $key => $val) {

				$critical = true;
				if ($val == 'multibyte') $critical = false;

				if (isset($this->parsedPhpInfo["{$val} support"])) {
					$val = "{$val} support";
				}

				if (!isset($this->parsedPhpInfo[$val])) {
					$this->assert(false, 13020 + $errorCounter++, $critical);
				}
				else {
					$this->assert($this->parsedPhpInfo[$val] == 'enabled' ||
					$this->parsedPhpInfo[$val] == 'active', 13030 + $errorCounter++, $critical);
				}
			}
		}

		function testJSONSupport() {
			if (!function_exists('json_decode') || !function_exists('json_encode')) {
				$this->assert(false, 13028, true);
			}
		}

		/**
		* Проверка allow_url_fopen=on или наличие библиотеки curl
		*/
		function testALLAllowUrlFopen() {
			if(!isset($this->parsedPhpInfo['allow_url_fopen']) && !isset($this->parsedPhpInfo['curl support'])){
				$this->assert(false, 13040);
			}
			elseif ($this->parsedPhpInfo['allow_url_fopen'] == 'off') {
				if (isset($this->parsedPhpInfo['curl support']) && strpos($this->parsedPhpInfo['curl support'], "enable")!==false) {
					$this->checkSession('curl');
				} else {
					$this->assert(false, 13041);
				}
			} else {
				$this->checkSession();
			}
		}

		/**
		* Проверка IIS
		*/
		function testALLIIS() {
			if(isset($this->parsedPhpInfo['_server["server_software"]']) && (strpos($this->parsedPhpInfo['_server["server_software"]'], "iis") !== false || strpos($this->parsedPhpInfo['_server["server_software"]'], "windows") !== false)){
				$this->assert(false, 13090, false);
			}
		}

		/**
		* Проверка текущей директории на запись
		*/
		function testALLPerms() {
			$this->assert(is_writable(dirname(__FILE__)), 13010);
		}

		/**
		* Проверка работы сессии
		*/
		function checkSession($mode = 'fopen') {
			if (!$this->domain) return;

			file_put_contents(CURRENT_WORKING_DIR . '/umi_smt.php', '<?php 
			@session_start(); 
			$_SESSION["test"] = "test"; 
			$sessionId = session_id();
			@session_write_close(); 
			unset($_SESSION["test"]); 
			@session_start($sessionId);
			echo($_SESSION["test"]);');

			if (!defined("PHP_FILES_ACCESS_MODE")) {
				$mode = substr(decoct(fileperms(__FILE__)), -4, 4);
				chmod(CURRENT_WORKING_DIR . '/umi_smt.php', octdec($mode));
			} else {
				chmod(CURRENT_WORKING_DIR . '/umi_smt.php', PHP_FILES_ACCESS_MODE);
			}

			$checkUrl = 'http://' . $this->domain . '/umi_smt.php';
			$result = '';

			if ($mode == 'fopen') {
				$result = file_get_contents($checkUrl);	
			} else {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $checkUrl);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($ch);
			}

			$this->assert($result == 'test', 13083);

			unlink(CURRENT_WORKING_DIR . '/umi_smt.php');
		}

		/**
		* Проверка коннекта к бд, определение кодировки, разрешений на изменения
		*/
		function testALLConnect() {
			$link = @mysql_connect ($this->host, $this->user, $this->password);

			$db = @mysql_select_db($this->database);

			$this->assert($link &&	$db, 13011);

			if ($link && $db){

				/**
				* Проверка версии MySQL
				*/

				$mysqlVersion = mysql_get_server_info();

				if (!$mysqlVersion) {
					$this->assert(false, 13070);
				} else {
					preg_match("/[1-9]+.[0-9]+.[0-9]+/", $mysqlVersion, $matches);
					$mysqlVersion = $matches[0];
					$this->assert(version_compare($mysqlVersion, '4.1.0', '>='), 13071);
				}

				$row=mysql_fetch_array(mysql_query("show variables like 'character_set_database'"));
				$this->assert($row[1] == 'utf8', 13012, false);
				
				$time = time();

				$this->assert(mysql_query("create table `test{$time}` (a int not null auto_increment, primary key (a))"), 13013);

				$this->assert(mysql_query("create temporary table `temporary_table{$time}` like `test{$time}`"), 13048);
				mysql_query("drop temporary table `temporary_table{$time}`");

				$this->assert(mysql_query("alter table `test{$time}` ADD b int(7) NULL"), 13014);

				$this->assert(mysql_query("insert into `test{$time}` (b) values (11)"), 13043);

				$this->assert(mysql_query("select * from `test{$time}`"), 13044);

				$this->assert(mysql_query("update `test{$time}` set b=12 where b=11"), 13045);

				$this->assert(mysql_query("delete from `test{$time}`"), 13046);

				$this->assert(mysql_query("SET foreign_key_checks = 1"), 13047);

				$this->assert(mysql_query("drop table `test{$time}`"), 13015);

				$innoDBSupported = false;
				$result = mysql_query("SHOW VARIABLES LIKE 'have_innodb'");
				if (mysql_numrows($result) > 0) {
					$row = mysql_fetch_array($result);
					if (strtolower($row['Value']) == "yes") {
						$innoDBSupported = true;
					}
				} else {
					$result = mysql_query("SHOW ENGINES");
					if (mysql_numrows($result) > 0) {
						while($row = mysql_fetch_assoc($result)) {
							if (strtolower($row['Engine']) == 'innodb' && (strtolower($row['Support']) == 'yes' || strtolower($row['Support']) == 'default')) {
								$innoDBSupported = true;
								break;
							}
						}
					}
				}
				$this->assert($innoDBSupported, 13016);

			}
		}

		/**
		* Запускает тесты
		*/
		function run(){
			$classMethods = get_class_methods($this);
			foreach ($classMethods as $methodName) {
				if ( (preg_match("/^testALL/i", $methodName))
					|| (preg_match("/^testCLI/i", $methodName) && $this->cli_mode)
					|| (preg_match("/^testWWW/i", $methodName) && !$this->cli_mode) ) {
					$this->$methodName();
				}
			}

		}

		/**
		* Добавляет сообщение в случае ошибки
		*
		* @param Boolean $value Есть ошибка/нет ошибки
		* @param String $errorCode Код ошибки
		* @param Boolean $critical Критичность
		* @param String $errorParams Дополнительные параметры ошибки
		*/
		function assert($value, $errorCode, $critical = true, $errorParams = '') {
			if(!$value) {
				$this->listErrors[] = array($errorCode, $critical, $errorParams);
			}
		}

		/**
		* Заносит все данные функции phpinfo() в массив $this->parsedPhpInfo
		*
		*/

		function getPhpInfo($result) {
			$res = explode('<h1>PHP Credits</h1>', $result);
			$result = $res[0];

			preg_match_all("/<tr>(.+)<\/tr>/", $result, $matches);
			foreach ($matches[0] as $string) {
				if(preg_match_all("/<td class=\"[ve]\">(.+?)<\/td>/", $string, $values)){
					if (!isset($values[1][1])) {
						$values[1][1] = "";
					}
					$this->parsedPhpInfo[trim(strtolower($values[1][0]))] = strip_tags(trim(strtolower($values[1][1])));
				}
			}

			preg_match_all("/<tr class=\"h\">(.+)<\/tr>/", $result, $matches2);
			foreach ($matches2[0] as $string) {
				if(preg_match_all("/<th>(.+?)<\/th>/", $string, $values2)){
					if(isset($values2[1][0]) && isset($values2[1][1]))$this->parsedPhpInfo[trim(strtolower($values2[1][0]))] = strip_tags(trim(strtolower($values2[1][1])));
				}
			}
		}

		/**
		* Разбирает данные функции phpinfo() в консольном режиме в массив $this->parsedPhpInfo
		*
		*/
		function getPhpInfoCli($result) {
			$phpinfo = explode("\n", strtolower($result));
			foreach($phpinfo as $key=>$value) {
				if (false===strpos($value, '=>')) {
					//unset($phpinfo[$key]);
					continue;
				}
				$parts = explode('=>', $value);
					foreach($parts as $k=>$v) {
						$parts[$k] = trim($v);
					}
				$this->parsedPhpInfo[$parts[0]] = $parts[1];
			}
		}

		/**
		* Конструктор для php4
		*
		* @param mixed $phpInfo
		* @return testHost
		*/
		function testHost($phpInfo = array(), $domain = null) {
			$this->listErrors = array();
			$this->parsedPhpInfo = array();
			$this->cli_mode = (boolean) (defined('UMICMS_CLI_MODE') && UMICMS_CLI_MODE);
			$this->domain = $domain;

			if(count($phpInfo)) {
				$this->parsedPhpInfo = $phpInfo;
			} else {
				ob_start();
				phpinfo();
				$result = ob_get_clean();

				if (strpos($result, "<html") !== false) {
					$this->getPhpInfo($result);
				}
				else {
					$this->getPhpInfoCli($result);
				}
			}
		}

		function setConnect($host, $user, $password, $database) {
			$this->user = $user;
			$this->host = $host;
			$this->password = $password;
			$this->database = $database;
		}

		function getResults(){
			$this->run();
			return $this->listErrors;
		}

	};
?>
