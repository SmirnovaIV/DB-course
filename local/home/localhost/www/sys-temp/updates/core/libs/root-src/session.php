<?php
 require CURRENT_WORKING_DIR . "/libs/config.php";$v418c5509e2171d55b0aee5c2ea4442b5 = getRequest("a");$v21d6f40cfb511982e4424e0e250a9557 = session::getInstance();if (!empty($_COOKIE['u-login']) && !empty($_COOKIE['u-password-md5'])) {echo SESSION_LIFETIME * 60;exit();}if (system_getSession()) {if (false !== ($vab9b69f140a1e5d13d4862be384ae223 = $v21d6f40cfb511982e4424e0e250a9557->isValid())) {if($v418c5509e2171d55b0aee5c2ea4442b5 == "ping") {$v21d6f40cfb511982e4424e0e250a9557->setValid();$vab9b69f140a1e5d13d4862be384ae223 = $v21d6f40cfb511982e4424e0e250a9557->isValid();}echo $vab9b69f140a1e5d13d4862be384ae223;exit();}else {session::destroy();system_removeSession();exit("-1");}}elseif($v418c5509e2171d55b0aee5c2ea4442b5 == "ping" && getRequest('u-login') && getRequest('u-password')) {if (umiAuth::tryPreAuth() != umiAuth::PREAUTH_INVALID) {$v3e6d17f66651c4d9e5bed84613507302 = permissionsCollection::getInstance();if ($v3e6d17f66651c4d9e5bed84613507302->isSv($v3e6d17f66651c4d9e5bed84613507302->getUserId())) {$v21d6f40cfb511982e4424e0e250a9557->setValid();echo SESSION_LIFETIME * 60;exit();}else {exit("-1");}}else {exit("-1");}}else {exit("-1");}?>