<?php
class loginzaUserProfile {private $profile;private $translate = array( 'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e', 'ж'=>'g', 'з'=>'z', 'и'=>'i', 'й'=>'y', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p', 'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'ы'=>'i', 'э'=>'e', 'А'=>'A', 'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E', 'Ж'=>'G', 'З'=>'Z', 'И'=>'I', 'Й'=>'Y', 'К'=>'K', 'Л'=>'L', 'М'=>'M', 'Н'=>'N', 'О'=>'O', 'П'=>'P', 'Р'=>'R', 'С'=>'S', 'Т'=>'T', 'У'=>'U', 'Ф'=>'F', 'Ы'=>'I', 'Э'=>'E', 'ё'=>"yo", 'х'=>"h", 'ц'=>"ts", 'ч'=>"ch", 'ш'=>"sh", 'щ'=>"shch", 'ъ'=>"", 'ь'=>"", 'ю'=>"yu", 'я'=>"ya", 'Ё'=>"YO", 'Х'=>"H", 'Ц'=>"TS", 'Ч'=>"CH", 'Ш'=>"SH", 'Щ'=>"SHCH", 'Ъ'=>"", 'Ь'=>"", 'Ю'=>"YU", 'Я'=>"YA" );function __construct($v7d97481b1fe66f4b51db90da7e794d9f) {$this->profile = $v7d97481b1fe66f4b51db90da7e794d9f;}public function genNickname () {if (!empty($this->profile->nickname)) {return $this->profile->nickname;}elseif (!empty($this->profile->email) && preg_match('/^(.+)\@/i', $this->profile->email, $ve80674170aae03909a55625e9cc9cf97)) {return $ve80674170aae03909a55625e9cc9cf97[1];}if ( ($vc315cc04ecbdbc749a09addc62016d54 = $this->genFullName()) ) {return $this->normalize($vc315cc04ecbdbc749a09addc62016d54, '.');}$v9dea51b41ad380aa83f2a25a7cecc5eb = array(   '([^\.]+)\.ya\.ru',   '([^\.]+)\.livejournal\.com',   'openid\.mail\.ru\/[^\/]+\/([^\/?]+)',   'openid\.yandex\.ru\/([^\/?]+)',   '([^\.]+)\.myopenid\.com'  );foreach ($v9dea51b41ad380aa83f2a25a7cecc5eb as $v240bf022e685b0ee30ad9fe9e1fb5d5b) {if (preg_match('/^https?\:\/\/'.$v240bf022e685b0ee30ad9fe9e1fb5d5b.'/i', $this->profile->identity, $result)) {return $result[1];}}return false;}public function genUserEmail () {if (!empty($this->profile->email))   {return $this->profile->email;}return '';}public function genProvider () {if (!empty($this->profile->provider))   {return $this->profile->provider;}return '';}public function genUserSite () {if (!empty($this->profile->web->blog)) {return $this->profile->web->blog;}elseif (!empty($this->profile->web->default)) {return $this->profile->web->default;}return $this->profile->identity;}public function genDisplayName () {if ( ($vc315cc04ecbdbc749a09addc62016d54 = $this->genFullName()) ) {return $vc315cc04ecbdbc749a09addc62016d54;}elseif ( ($ve80674170aae03909a55625e9cc9cf97 = $this->genNickname()) ) {return $ve80674170aae03909a55625e9cc9cf97;}$ve20e9d9090fd30cb5ff14506dda46859 = parse_url($this->profile->identity);$result = $ve20e9d9090fd30cb5ff14506dda46859['host'];if ($ve20e9d9090fd30cb5ff14506dda46859['path'] != '/') {$result .= $ve20e9d9090fd30cb5ff14506dda46859['path'];}return $result.$ve20e9d9090fd30cb5ff14506dda46859['query'];}public function getFname() {if ( !empty($this->profile->name->first_name))  return $this->profile->name->first_name;return false;}public function getLname() {if ( !empty($this->profile->name->last_name))  return $this->profile->name->last_name;return false;}public function genFullName () {if ( !empty($this->profile->name->full_name)) {return $this->profile->name->full_name;}elseif ( !empty($this->profile->name->first_name) || !empty($this->profile->name->last_name) ) {$v4d9d6c17eeae2754c9b49171261b93bd = !empty($this->profile->name->first_name)?$this->profile->name->first_name:'';$vf8e19f449f17c9d37dcc93dd244ec3bb = !empty($this->profile->name->last_name)?$this->profile->name->last_name:'';return trim($v4d9d6c17eeae2754c9b49171261b93bd.' '.$vf8e19f449f17c9d37dcc93dd244ec3bb);}return '';}public function genRandomPassword ($vf5a8e923f8cd24b56b3bab32358cc58a=6, $v3f0dc2d51eb1e9756ef83da0ce4f4d19='a-z,0-9') {$vb69d9bc635ccd79ad2c64bc862abe3b4 = array();$vb69d9bc635ccd79ad2c64bc862abe3b4['a-z'] = 'qwertyuiopasdfghjklzxcvbnm';$vb69d9bc635ccd79ad2c64bc862abe3b4['A-Z'] = strtoupper($vb69d9bc635ccd79ad2c64bc862abe3b4['a-z']);$vb69d9bc635ccd79ad2c64bc862abe3b4['0-9'] = '0123456789';$vb69d9bc635ccd79ad2c64bc862abe3b4['~'] = '~!@#$%^&*()_+=-:";\'/\\?><,.|{}[]';$vdbd153490a1c3720a970a611afc4371c = '';$v5f4dcc3b5aa765d61d8327deb882cf99 = '';if (!empty($v3f0dc2d51eb1e9756ef83da0ce4f4d19)) {$vcc36e012e7a669058ebc7e01573ca736 = explode(',', $v3f0dc2d51eb1e9756ef83da0ce4f4d19);foreach ($vcc36e012e7a669058ebc7e01573ca736 as $v599dcce2998a6b40b1e38e8c6006cb0a) {if (array_key_exists($v599dcce2998a6b40b1e38e8c6006cb0a, $vb69d9bc635ccd79ad2c64bc862abe3b4)) {$vdbd153490a1c3720a970a611afc4371c .= $vb69d9bc635ccd79ad2c64bc862abe3b4[$v599dcce2998a6b40b1e38e8c6006cb0a];}else {$vdbd153490a1c3720a970a611afc4371c .= $v599dcce2998a6b40b1e38e8c6006cb0a;}}}for ($v865c0c0b4ab0e063e5caa3387c1a8741=0;$v865c0c0b4ab0e063e5caa3387c1a8741<$vf5a8e923f8cd24b56b3bab32358cc58a;$v865c0c0b4ab0e063e5caa3387c1a8741++) {$v5f4dcc3b5aa765d61d8327deb882cf99 .= $vdbd153490a1c3720a970a611afc4371c[ rand(0, strlen($vdbd153490a1c3720a970a611afc4371c)-1) ];}return $v5f4dcc3b5aa765d61d8327deb882cf99;}private function normalize ($vb45cffe084dd3d20d928bee85e7b0f21, $v9273b45ef4c6dcf0560ab389b358394d='-') {$vb45cffe084dd3d20d928bee85e7b0f21 = strtr($vb45cffe084dd3d20d928bee85e7b0f21, $this->translate);return substr(trim(preg_replace('/[^\w]+/i', $v9273b45ef4c6dcf0560ab389b358394d, $vb45cffe084dd3d20d928bee85e7b0f21), $v9273b45ef4c6dcf0560ab389b358394d), 0, 40);}}?>