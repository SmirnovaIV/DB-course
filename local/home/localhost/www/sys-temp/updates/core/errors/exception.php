<?php
 if(!headers_sent()) {header("Content-type: text/html; charset=utf-8");}if(!isset($ve1671797c52e15f763380b45e841ec32)) {$ve1671797c52e15f763380b45e841ec32 = null;}if(!isset($v78e731027d8fd50ed642340b7c9a63b3)) {if($ve1671797c52e15f763380b45e841ec32 instanceof Exception) {$v78e731027d8fd50ed642340b7c9a63b3 = $ve1671797c52e15f763380b45e841ec32->getMessage();}else {$v78e731027d8fd50ed642340b7c9a63b3 = "Error message not provided";}}if(!isset($v03288653302635fb2b0f9e5386599cd1)) {$v03288653302635fb2b0f9e5386599cd1 = 'Backtrace not provided';}$v78e731027d8fd50ed642340b7c9a63b3 = htmlspecialchars($v78e731027d8fd50ed642340b7c9a63b3);$v78e731027d8fd50ed642340b7c9a63b3 = nl2br($v78e731027d8fd50ed642340b7c9a63b3);$v03288653302635fb2b0f9e5386599cd1 = htmlspecialchars($v03288653302635fb2b0f9e5386599cd1);if (!DEBUG_SHOW_BACKTRACE && $ve1671797c52e15f763380b45e841ec32 instanceof Exception && get_class($ve1671797c52e15f763380b45e841ec32) == 'databaseException') {$v78e731027d8fd50ed642340b7c9a63b3 = '<p>Произошла критическая ошибка. Скорее всего, потребуется участие разработчиков.  Подробности по ссылке <a title="" target="_blank" href="http://errors.umi-cms.ru/17000/">17000</a></p>';}?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Неперехваченное исключение</title>
	<link href="/errors/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
	function displayTrace(link) {
		if(link) link.style.display = 'none';
		document.getElementById('trace').style.display = '';
	}
	
	function sendErrorReport() {
		var url = "http://www.umi-cms.ru/errors-gw/accept-bug.php";
		url += "?log=" + sendErrorReport.errorMessage;
		
		var d = new Date;
		url += "&t=" + d.getTime();
		var script = document.createElement('script');
		script.charset = "utf-8";
		script.src = url;
		document.body.appendChild(script);
	}
	
	function solutionFound(solutionText) {
		var obj = document.getElementById('solution');
		obj.style.display = '';
		obj.innerHTML = '<b>Найдено решение для данной проблемы:</b><br />' + solutionText;
	}
</script>
</head>
<body>
	<div class="exception">
		<div id="header">
			<h1>Неперехваченное исключение</h1>
			<a target="_blank" title="UMI.CMS" href="http://umi-cms.ru"><img class="logo" src="/errors/images/main_logo.png" alt="UMI.CMS" /></a>
		</div>
		<div id="message">
			<h2>Ошибка <?php if($ve1671797c52e15f763380b45e841ec32 instanceof Exception) {echo "(", get_class($ve1671797c52e15f763380b45e841ec32), ")";}?>: <?php echo $v78e731027d8fd50ed642340b7c9a63b3;?></h2>
			<p id="solution" style="display: none;"></p>
				<?php
    if (DEBUG_SHOW_BACKTRACE) {?>
					<p>
						<a href="#" onclick="javascript: displayTrace(this);">
							Показать отладочную информацию
						</a>
					</p>

					<div id="trace" class="trace" style="display: none;"><pre><?php echo $v03288653302635fb2b0f9e5386599cd1;?></pre></div>
				<?php
    }?>
		</div>
		<div id="footer">
			<p><a href="http://www.umi-cms.ru/support">Поддержка пользователей UMI.CMS</a></p>
		</div>
	</div>
</body>
</html>
<?php
  if (!defined('CURRENT_WORKING_DIR')) define('CURRENT_WORKING_DIR', dirname(dirname(__FILE__)));require_once CURRENT_WORKING_DIR . "/classes/system/utils/logger/iLogger.php";require_once CURRENT_WORKING_DIR . "/classes/system/utils/logger/logger.php";if(!function_exists("tryCreateCrashReport")) {function tryCreateCrashReport($v78e731027d8fd50ed642340b7c9a63b3, $v03288653302635fb2b0f9e5386599cd1) {$ve797f7a309e6fcc5b5b392cc9e6d6f6f = CURRENT_WORKING_DIR . "/errors/logs/exceptions/";if(!is_dir($ve797f7a309e6fcc5b5b392cc9e6d6f6f)) {mkdir($ve797f7a309e6fcc5b5b392cc9e6d6f6f, 0777, true);}try {$v6db435f352d7ea4a67807a3feb447bf7 = new umiLogger($ve797f7a309e6fcc5b5b392cc9e6d6f6f);$v6db435f352d7ea4a67807a3feb447bf7->pushGlobalEnviroment();$v6db435f352d7ea4a67807a3feb447bf7->push($v78e731027d8fd50ed642340b7c9a63b3);$v6db435f352d7ea4a67807a3feb447bf7->push($v03288653302635fb2b0f9e5386599cd1);$va1418f90d6bbbdcf92159eb1bf7b0736 = $v6db435f352d7ea4a67807a3feb447bf7->save();unset($v6db435f352d7ea4a67807a3feb447bf7);}catch (Exception $ve1671797c52e15f763380b45e841ec32) {echo "Can't log exception: ", $ve1671797c52e15f763380b45e841ec32->getMessage();exit();}}tryCreateCrashReport($v78e731027d8fd50ed642340b7c9a63b3, $v03288653302635fb2b0f9e5386599cd1);if (DEBUG_SHOW_BACKTRACE) {$v88daa5a9868fcf90fb6450a2e9191b96 = $v78e731027d8fd50ed642340b7c9a63b3 . "\n\n\n" . $v03288653302635fb2b0f9e5386599cd1;if($v88daa5a9868fcf90fb6450a2e9191b96) {$v88daa5a9868fcf90fb6450a2e9191b96 = base64_encode($v88daa5a9868fcf90fb6450a2e9191b96);echo <<<JS
<script type="text/javascript" charset="utf-8">
var errorLogMessage = new String('{$v88daa5a9868fcf90fb6450a2e9191b96}');
sendErrorReport.errorMessage = encodeURIComponent(errorLogMessage);
setTimeout(sendErrorReport, 500);
</script>
JS;    }}}?>