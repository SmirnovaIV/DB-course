<?php
class loginzaAPI {const VERSION = '1.0';const API_URL = 'http://loginza.ru/api/%method%';const WIDGET_URL = 'https://loginza.ru/api/widget';public $providers = array(  'yandex' => array('title'=>'Яндекс', 'enabled'=>true),   'vkontakte' => array('title'=>'Вконтакте', 'enabled'=>true),   'facebook' => array('title'=>'Facebook', 'enabled'=>true),   'google' => array('title'=>'Google Accounts', 'enabled'=>true),   'openid' => array('title'=>'OpenID', 'enabled'=>true),   'myopenid' => array('title'=>'MyOpenID', 'enabled'=>true),   'twitter' => array('title'=>'Twitter', 'enabled'=>true),   'rambler' => array('title'=>'Rambler', 'enabled'=>true),   'mailru' => array('title'=>'Mail.ru', 'enabled'=>true),   'mailruapi' => array('title'=>'Mail.ru', 'enabled'=>false),   'loginza' => array('title'=>'Loginza', 'enabled'=>true),   'webmoney' => array('title'=>'WebMoney', 'enabled'=>true),   'flickr' => array('title'=>'flickr', 'enabled'=>true),   'lastfm' => array('title'=>'lastfm', 'enabled'=>true),   'verisign' => array('title'=>'verisign', 'enabled'=>false),   'aol'  => array('title'=>'aol', 'enabled'=>false),  );public function getAuthInfo ($v94a08da1fecbb6e8b46990538c7b50b2) {return $this->apiRequert('authinfo', array('token' => $v94a08da1fecbb6e8b46990538c7b50b2));}public function getWidgetUrl ($vf5d1fdc9ec4f37dda01e638b24de7233=null, $v9e9f3d70bd8c8957627eada96d967706=null, $v380e537acdaedd487ca1adb49d020f7e='') {$v21ffce5b8a6cc8cc6a41448dd69623c9 = array();if (!$vf5d1fdc9ec4f37dda01e638b24de7233) {$v21ffce5b8a6cc8cc6a41448dd69623c9['token_url'] = $this->currentUrl();}else {$v21ffce5b8a6cc8cc6a41448dd69623c9['token_url'] = $vf5d1fdc9ec4f37dda01e638b24de7233;}if ($v9e9f3d70bd8c8957627eada96d967706) {$v21ffce5b8a6cc8cc6a41448dd69623c9['provider'] = $v9e9f3d70bd8c8957627eada96d967706;}if ($v380e537acdaedd487ca1adb49d020f7e) {$v21ffce5b8a6cc8cc6a41448dd69623c9['overlay'] = $v380e537acdaedd487ca1adb49d020f7e;}return self::WIDGET_URL.'?'.http_build_query($v21ffce5b8a6cc8cc6a41448dd69623c9, '', '&');}private function currentUrl () {$v572d4e421e5e6b9bc11d815e8a027112 = array();if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {$v572d4e421e5e6b9bc11d815e8a027112['sheme'] = "https";$v572d4e421e5e6b9bc11d815e8a027112['port'] = '443';}else {$v572d4e421e5e6b9bc11d815e8a027112['sheme'] = 'http';$v572d4e421e5e6b9bc11d815e8a027112['port'] = '80';}$v572d4e421e5e6b9bc11d815e8a027112['host'] = $_SERVER['HTTP_HOST'];if (strpos($v572d4e421e5e6b9bc11d815e8a027112['host'], ':') === false && $_SERVER['SERVER_PORT'] != $v572d4e421e5e6b9bc11d815e8a027112['port']) {$v572d4e421e5e6b9bc11d815e8a027112['host'] .= ':'.$_SERVER['SERVER_PORT'];}if (isset($_SERVER['REQUEST_URI'])) {$v572d4e421e5e6b9bc11d815e8a027112['request'] = $_SERVER['REQUEST_URI'];}else {$v572d4e421e5e6b9bc11d815e8a027112['request'] = $_SERVER['SCRIPT_NAME'] . $_SERVER['PATH_INFO'];$v1b1cc7f086b3f074da452bc3129981eb = $_SERVER['QUERY_STRING'];if (isset($v1b1cc7f086b3f074da452bc3129981eb)) {$v572d4e421e5e6b9bc11d815e8a027112['request'] .= '?'.$v1b1cc7f086b3f074da452bc3129981eb;}}return $v572d4e421e5e6b9bc11d815e8a027112['sheme'].'://'.$v572d4e421e5e6b9bc11d815e8a027112['host']."/users/loginza/?from_page=".urlencode($v572d4e421e5e6b9bc11d815e8a027112['sheme'].'://'.$v572d4e421e5e6b9bc11d815e8a027112['host'].$v572d4e421e5e6b9bc11d815e8a027112['request']);}private function apiRequert($vea9f6aca279138c58f705c8d4cb4b8ce, $v21ffce5b8a6cc8cc6a41448dd69623c9) {$v572d4e421e5e6b9bc11d815e8a027112 = str_replace('%method%', $vea9f6aca279138c58f705c8d4cb4b8ce, self::API_URL).'?'.http_build_query($v21ffce5b8a6cc8cc6a41448dd69623c9, '', '&');if ( function_exists('curl_init') ) {$vf6e57c9de709e45feb0d955351f53548 = curl_init($v572d4e421e5e6b9bc11d815e8a027112);$v83647c700b7d38852412f4f946f00c88 = 'LoginzaAPI'.self::VERSION.'/php'.phpversion();curl_setopt($vf6e57c9de709e45feb0d955351f53548, CURLOPT_RETURNTRANSFER, true);curl_setopt($vf6e57c9de709e45feb0d955351f53548, CURLOPT_HEADER, false);curl_setopt($vf6e57c9de709e45feb0d955351f53548, CURLOPT_USERAGENT, $v83647c700b7d38852412f4f946f00c88);curl_setopt($vf6e57c9de709e45feb0d955351f53548, CURLOPT_SSL_VERIFYPEER, false);$v4ba3140bbd48ef6e8c760d4fc1cb9963 = curl_exec($vf6e57c9de709e45feb0d955351f53548);curl_close($vf6e57c9de709e45feb0d955351f53548);$vfb5270b9d9076a4df05bfce5b30d4307 = $v4ba3140bbd48ef6e8c760d4fc1cb9963;}else {$vfb5270b9d9076a4df05bfce5b30d4307 = file_get_contents($v572d4e421e5e6b9bc11d815e8a027112);}return $this->decodeJSON($vfb5270b9d9076a4df05bfce5b30d4307);}private function decodeJSON ($v8d777f385d3dfec8815d20f7496026dc) {if ( function_exists('json_decode') ) {return json_decode ($v8d777f385d3dfec8815d20f7496026dc);}if (!class_exists('Services_JSON')) {require_once( dirname( __FILE__ ) . '/json.php' );}$v466deec76ecdf5fca6d38571f6324d54 = new Services_JSON();return $v466deec76ecdf5fca6d38571f6324d54->decode($v8d777f385d3dfec8815d20f7496026dc);}public function debugPrint ($v22ee3ffe33763d6f064f80ca74ecdc65, $vf8e45531a3ea3d5c1247b004985175a4=false) {if (!$vf8e45531a3ea3d5c1247b004985175a4){echo "<h3>Debug print:</h3>";}echo "<table border>";foreach ($v22ee3ffe33763d6f064f80ca74ecdc65 as $v3c6e0b8a9c15224a8228b9a98ca1531d => $v2063c1608d6e0baf80249c42e2be5804) {if (!is_array($v2063c1608d6e0baf80249c42e2be5804) && !is_object($v2063c1608d6e0baf80249c42e2be5804)) {echo "<tr><td>$v3c6e0b8a9c15224a8228b9a98ca1531d</td> <td><b>$v2063c1608d6e0baf80249c42e2be5804</b></td></tr>";}else {echo "<tr><td>$v3c6e0b8a9c15224a8228b9a98ca1531d</td> <td>";$this->debugPrint($v2063c1608d6e0baf80249c42e2be5804, true);echo "</td></tr>";}}echo "</table>";}public function getProvider() {$result = array();foreach( $this->providers as $v8ce4b16b22b58894aa86c421e8759df3=>$v9e3669d19b675bd57058fd4664205d2a) {if($v9e3669d19b675bd57058fd4664205d2a['enabled'] ) $result[$v8ce4b16b22b58894aa86c421e8759df3] = $v9e3669d19b675bd57058fd4664205d2a['title'];}return $result;}}?>