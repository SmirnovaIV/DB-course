<?php
 interface iUmiCaptcha {public static function generateCaptcha($v66f6181bcb4cff4cd38fbc804a036db6="default", $vb082bdddeadb1ea23f679c64ae900ef9="sys_captcha", $ve98737036f7752124468103e7fcdb14d="");public static function isNeedCaptha();public static function checkCaptcha();public static function getDrawer();}abstract class captchaDrawer {const length = 6;const alphabet = '23456789qwertyuipasdfghjkzxcvbnm';abstract public function draw($ve17984fe4663335cfb61cb593aa80a76);public function getRandomCode() {$v2fa47f7c65fec19cc163b195725e3844 = 6;$vc13367945d5d4c91047b3b50234aa7ab = '';$v523713c7fd004fb51d3740aa893ac207 = self::alphabet;$v4a8a08f09d37b73795649038408b5f33 = strlen($v523713c7fd004fb51d3740aa893ac207) - 1;for($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $v2fa47f7c65fec19cc163b195725e3844;$v865c0c0b4ab0e063e5caa3387c1a8741++) {$vc13367945d5d4c91047b3b50234aa7ab .= $v523713c7fd004fb51d3740aa893ac207{rand(0, $v4a8a08f09d37b73795649038408b5f33)};}return $vc13367945d5d4c91047b3b50234aa7ab;}};?>