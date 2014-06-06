<?php
 interface iUmiTemplater {public function setScope($v7552cd149af7495ee7d8225974e50f80, $v16b2b26000987faccb260b9d39df1269 = false);public static function loadTemplates($v9cd3487945daada914909f0b525e1284);public static function getTemplates($v9cd3487945daada914909f0b525e1284);}abstract class umiTemplater implements iUmiTemplater {protected $templatesSource;protected $scopeElementId = false, $scopeObjectId = false, $scopeObject = false;protected static $callStackEnabled = false;protected static $commentsStack = array();abstract public function parse($v87cd8b8808600624d8c590cfc2e6e94b, $v9a0364b9e99bb480dd25e1f0284c8555 = null);protected function replaceCommentsBeforeParse($v9a0364b9e99bb480dd25e1f0284c8555) {if (strpos($v9a0364b9e99bb480dd25e1f0284c8555, '<!--') === false || (int) mainConfiguration::getInstance()->get('system', 'parse-macroses-in-comments')) {return $v9a0364b9e99bb480dd25e1f0284c8555;}if (preg_match_all("/<!--.*?-->/mu", $v9a0364b9e99bb480dd25e1f0284c8555, $v9c28d32df234037773be184dbdafc274)) {$va5d491060952aa8ad5fdee071be752de = array_unique($v9c28d32df234037773be184dbdafc274[0]);foreach($va5d491060952aa8ad5fdee071be752de as $v06d4cd63bde972fc66a0aed41d2f5c51) {$vdd395d6201581ad212d782d571f0ad64 = '[hc_' . md5($v06d4cd63bde972fc66a0aed41d2f5c51) . ']';if ( !isset(self::$commentsStack[$vdd395d6201581ad212d782d571f0ad64]) ) {self::$commentsStack[$vdd395d6201581ad212d782d571f0ad64] = $v06d4cd63bde972fc66a0aed41d2f5c51;}$v9a0364b9e99bb480dd25e1f0284c8555 = str_replace($v06d4cd63bde972fc66a0aed41d2f5c51, $vdd395d6201581ad212d782d571f0ad64, $v9a0364b9e99bb480dd25e1f0284c8555);}}return $v9a0364b9e99bb480dd25e1f0284c8555;}public function replaceCommentsAfterParse($v9a0364b9e99bb480dd25e1f0284c8555) {return str_replace(array_keys(self::$commentsStack), array_values(self::$commentsStack), $v9a0364b9e99bb480dd25e1f0284c8555);}public function __construct($v9cd3487945daada914909f0b525e1284) {$v2245023265ae4cf87d02c8b6ba991139 = mainConfiguration::getInstance();$this->templatesSource = $v9cd3487945daada914909f0b525e1284;}public function setScope($v7552cd149af7495ee7d8225974e50f80, $v16b2b26000987faccb260b9d39df1269 = false) {$this->scopeElementId = $v7552cd149af7495ee7d8225974e50f80;$this->scopeObjectId = $v16b2b26000987faccb260b9d39df1269;$this->scopeObject = false;}public function getScopeObject() {if ($this->scopeObject !== false) return $this->scopeObject;if($this->scopeElementId === false && $this->scopeObjectId === false) {return $this->scopeObject = null;}$vb81ca7c0ccaa77e7aa91936ab0070695 = umiHierarchy::getInstance();$v5891da2d64975cae48d175d1e001f5da = umiObjectsCollection::getInstance();if ($this->scopeElementId && ($v8e2dcfd7e7e24b1ca76c1193f645902b = $vb81ca7c0ccaa77e7aa91936ab0070695->getElement($this->scopeElementId))) {return $this->scopeObject = $v8e2dcfd7e7e24b1ca76c1193f645902b->getObject();}if ($this->scopeObjectId && ($va8cfde6331bd59eb2ac96f8911c4b666 = $v5891da2d64975cae48d175d1e001f5da->getObject($this->scopeObjectId))) {return $this->scopeObject = $va8cfde6331bd59eb2ac96f8911c4b666;}return $this->scopeObject = null;}public function cleanup($v9a0364b9e99bb480dd25e1f0284c8555) {$v41275a535677f79ff347e01bc530c176 = permissionsCollection::getInstance();$v2245023265ae4cf87d02c8b6ba991139 = mainConfiguration::getInstance();if (!$v41275a535677f79ff347e01bc530c176->isAdmin() && (int) $v2245023265ae4cf87d02c8b6ba991139->get('system', 'clean-eip-attributes')) {$v9a0364b9e99bb480dd25e1f0284c8555 = $this->cleanEIPAttributes($v9a0364b9e99bb480dd25e1f0284c8555);}if (!intval($v2245023265ae4cf87d02c8b6ba991139->get("kernel", "show-broken-macro"))) {$v9a0364b9e99bb480dd25e1f0284c8555 = $this->cleanBrokenMacro($v9a0364b9e99bb480dd25e1f0284c8555);}$v9a0364b9e99bb480dd25e1f0284c8555 = $this->replaceCommentsAfterParse($v9a0364b9e99bb480dd25e1f0284c8555);$v9a0364b9e99bb480dd25e1f0284c8555 = str_replace(array("&amp;#37;"), "%", $v9a0364b9e99bb480dd25e1f0284c8555);return $v9a0364b9e99bb480dd25e1f0284c8555;}public static final function create($v599dcce2998a6b40b1e38e8c6006cb0a, $v9cd3487945daada914909f0b525e1284 = null) {$v599dcce2998a6b40b1e38e8c6006cb0a = strtoupper($v599dcce2998a6b40b1e38e8c6006cb0a);if (!strlen($v599dcce2998a6b40b1e38e8c6006cb0a)) {throw new coreException("Templater type required for create instance.");}$v6f66e878c62db60568a3487869695820 = __CLASS__ . $v599dcce2998a6b40b1e38e8c6006cb0a;if (!class_exists($v6f66e878c62db60568a3487869695820)) {$v47826cacc65c665212b821e6ff80b9b0 =  dirname(__FILE__) . '/types/' . $v6f66e878c62db60568a3487869695820 . '.php';if (!is_file($v47826cacc65c665212b821e6ff80b9b0)) {throw new coreException("Can't load templater implemantation \"{$v47826cacc65c665212b821e6ff80b9b0}\".");}require_once $v47826cacc65c665212b821e6ff80b9b0;}if (!class_exists($v6f66e878c62db60568a3487869695820)) {throw new coreException("Templater class \"{$v6f66e878c62db60568a3487869695820}\" not found");}$v640eac53ad75db5c49a9ec86390d8530 = new $v6f66e878c62db60568a3487869695820($v9cd3487945daada914909f0b525e1284);if (!$v640eac53ad75db5c49a9ec86390d8530 instanceof umiTemplater) {throw new coreException("Templater class \"{$v6f66e878c62db60568a3487869695820}\" should be instance of " . __CLASS__);}return $v640eac53ad75db5c49a9ec86390d8530;}public function getTemplatesSource() {return $this->templatesSource;}public function setFilePath($v47826cacc65c665212b821e6ff80b9b0) {$this->templatesSource = $v47826cacc65c665212b821e6ff80b9b0;}public static $blocks = Array();public static function pushEditable($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce, $vb80bb7740288fda1f201890375a60c8f) {if($v22884db148f0ffb0d830ba431102b0b5 === false && $vea9f6aca279138c58f705c8d4cb4b8ce === false) {if($v8e2dcfd7e7e24b1ca76c1193f645902b = umiHierarchy::getInstance()->getElement($vb80bb7740288fda1f201890375a60c8f)) {$v94efb9bd8805ffa2a3d248cbe836b6ef = $v8e2dcfd7e7e24b1ca76c1193f645902b->getTypeId();if($v481a5f16b24d461e31d85aba607238b8 = umiObjectTypesCollection::getInstance()->getType($v94efb9bd8805ffa2a3d248cbe836b6ef)) {$v09f4280d9972439d11df682357c4b807 = $v481a5f16b24d461e31d85aba607238b8->getHierarchyTypeId();if($v5f8d8192d2d4ff7e065aaf1958d15913 = umiHierarchyTypesCollection::getInstance()->getType($v09f4280d9972439d11df682357c4b807)) {$v22884db148f0ffb0d830ba431102b0b5 = $v5f8d8192d2d4ff7e065aaf1958d15913->getName();$vea9f6aca279138c58f705c8d4cb4b8ce = $v5f8d8192d2d4ff7e065aaf1958d15913->getExt();}else {return false;}}}}self::$blocks[] = array($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce, $vb80bb7740288fda1f201890375a60c8f);return true;}public static function prepareQuickEdit() {$v5e72c7891093d301b60783c6a47f7aa0 = self::$blocks;if(sizeof($v5e72c7891093d301b60783c6a47f7aa0) == 0) return;$v3c6e0b8a9c15224a8228b9a98ca1531d = md5(getServerProtocol() . "://" . getServer('HTTP_HOST') . getServer('REQUEST_URI'));$_SESSION[$v3c6e0b8a9c15224a8228b9a98ca1531d] = $v5e72c7891093d301b60783c6a47f7aa0;}final public static function getSomething($vc65f234fae60d823c1f1bf00566248a0 = "pro", $v67b3dba8bc6778101892eb77249db32e = null) {$v836c673259e51101a01e755a34f97359 = getServer('SERVER_ADDR');if (is_null($v67b3dba8bc6778101892eb77249db32e)) {$v9d6e24ec78d309695833f4c9f8310d7a = domainsCollection::getInstance()->getDefaultDomain();$v67b3dba8bc6778101892eb77249db32e = $v9d6e24ec78d309695833f4c9f8310d7a->getHost();}$v43c8ce94d81492e62c60092a3664a65f = $v836c673259e51101a01e755a34f97359 ? md5($v836c673259e51101a01e755a34f97359) : md5(str_replace("\\", "", getServer('DOCUMENT_ROOT')));$v834c51a71b8c3cca066197db43bb209d = '';switch ($vc65f234fae60d823c1f1bf00566248a0) {case "pro":     $v834c51a71b8c3cca066197db43bb209d = md5(md5(md5(md5(md5(md5(md5(md5(md5(md5($v67b3dba8bc6778101892eb77249db32e))))))))));break;case "shop":     $v834c51a71b8c3cca066197db43bb209d =  md5(md5($v67b3dba8bc6778101892eb77249db32e . "shop"));break;case "lite":     $v834c51a71b8c3cca066197db43bb209d = md5(md5(md5(md5(md5($v67b3dba8bc6778101892eb77249db32e)))));break;case "start":     $v834c51a71b8c3cca066197db43bb209d = md5(md5(md5($v67b3dba8bc6778101892eb77249db32e)));break;case "trial":     $v834c51a71b8c3cca066197db43bb209d = md5(md5(md5(md5(md5(md5($v67b3dba8bc6778101892eb77249db32e))))));break;}return strtoupper(substr($v43c8ce94d81492e62c60092a3664a65f, 0, 11) . "-" . substr($v834c51a71b8c3cca066197db43bb209d, 0, 11));}protected function cleanEIPAttributes($v9a0364b9e99bb480dd25e1f0284c8555) {return preg_replace('/[\s+]umi\:[^=\'"]+=["\'][^"\']*["\']/i', '', $v9a0364b9e99bb480dd25e1f0284c8555);}protected function cleanBrokenMacro($v9a0364b9e99bb480dd25e1f0284c8555) {$v9a0364b9e99bb480dd25e1f0284c8555 = preg_replace("/%(?!cut%)([A-z_]{3,})%/m", "", $v9a0364b9e99bb480dd25e1f0284c8555);$v9a0364b9e99bb480dd25e1f0284c8555 = preg_replace("/%([A-zА-Яа-я0-9]+\s+[A-zА-Яа-я0-9_]+\([A-zА-Яа-я \/\._\-\(\)0-9%:<>,!@\|'&=;\?\+#]*\))%/mu", "", $v9a0364b9e99bb480dd25e1f0284c8555);return $v9a0364b9e99bb480dd25e1f0284c8555;}public static function setEnabledCallStack($va10311459433adf322f2590a4987c423 = true) {return self::$callStackEnabled = $va10311459433adf322f2590a4987c423;}public static function isEnabledCallStack() {return self::$callStackEnabled;}public function getCallStackXML() {if (self::isEnabledCallStack()) {return umiBaseStream::getCalledStreams();}return $this->disabledCallStackError();}protected function disabledCallStackError() {$vdd988cfd769c9f7fbd795a0f5da8e751 = new DOMDocument('1.0', 'utf-8');$vdd988cfd769c9f7fbd795a0f5da8e751->appendChild($vdd988cfd769c9f7fbd795a0f5da8e751->createElement('error', 'Call stack disabled.'));return $vdd988cfd769c9f7fbd795a0f5da8e751->saveXML();}public function putLangs($v9a0364b9e99bb480dd25e1f0284c8555) {return def_module::parseTPLMacroses($v9a0364b9e99bb480dd25e1f0284c8555);}public function parseInput($va43c1b0aa53a0c908810c06ab1ff3967, $vc9e9a848920877e76685b2e4e76de38d = 1) {return def_module::parseTPLMacroses($va43c1b0aa53a0c908810c06ab1ff3967);}public function init() {}public function getIsInited() {return def_module::isXSLTResultMode();}public function setIsInited($v22af645d1859cb5ca6da0c484f1f37ea) {return def_module::isXSLTResultMode($v22af645d1859cb5ca6da0c484f1f37ea);}public function parseResult() {return $this->parse(array(), null);}}?>