<?php
 class xmlTranslator implements iXmlTranslator {public static $showHiddenFieldGroups = false;public static $showUnsecureFields = false;protected $domDocument = false;protected $currentPageTranslated = false;protected static $shortKeys = array(   '@' => 'attribute',   '#' => 'node',   '+' => 'nodes',   '%' => 'xlink',   '*' => 'comment'  );public function __construct(DOMDocument $vc2d66aafee5d0e58e7682dd3e7b5d7f6) {$this->domDocument = $vc2d66aafee5d0e58e7682dd3e7b5d7f6;}public function translateToXml(DOMElement $v173a1756d2d82394cb803161f70f9a38, $v56491f2e1c74898e18bb6e47d2425b19) {return $this->chooseTranslator($v173a1756d2d82394cb803161f70f9a38, $v56491f2e1c74898e18bb6e47d2425b19);}public function chooseTranslator(DOMElement $v173a1756d2d82394cb803161f70f9a38, $v56491f2e1c74898e18bb6e47d2425b19, $ve30d41e6c131a13252ce15184b24d99b = false) {switch(gettype($v56491f2e1c74898e18bb6e47d2425b19)) {case "array": {$this->translateArray($v173a1756d2d82394cb803161f70f9a38, $v56491f2e1c74898e18bb6e47d2425b19);break;}case "object": {$v7c27535f88bae9519ceb14a8983c57ff = translatorWrapper::get($v56491f2e1c74898e18bb6e47d2425b19);$v7c27535f88bae9519ceb14a8983c57ff->isFull = $ve30d41e6c131a13252ce15184b24d99b;$this->chooseTranslator($v173a1756d2d82394cb803161f70f9a38, $v7c27535f88bae9519ceb14a8983c57ff->translate($v56491f2e1c74898e18bb6e47d2425b19));break;}default: {$this->translateBasic($v173a1756d2d82394cb803161f70f9a38, $v56491f2e1c74898e18bb6e47d2425b19);break;}}}public static function isParseTPLMacrosesAllowed() {static $v22ee71e9dcc9ca12fc313c6e1ce3f806;if (is_bool($v22ee71e9dcc9ca12fc313c6e1ce3f806)) return $v22ee71e9dcc9ca12fc313c6e1ce3f806;$v22ee71e9dcc9ca12fc313c6e1ce3f806 = true;if (cmsController::getInstance()->getCurrentMode() == "admin") {$v22ee71e9dcc9ca12fc313c6e1ce3f806 = false;}elseif (defined('XML_MACROSES_DISABLE') && XML_MACROSES_DISABLE) {$v9cf41e5f460b6ae5505f9809fe9f5d37 = mainConfiguration::getInstance()->get('kernel', 'xml-macroses.allowed');$v22ee71e9dcc9ca12fc313c6e1ce3f806 = (is_array($v9cf41e5f460b6ae5505f9809fe9f5d37) && count($v9cf41e5f460b6ae5505f9809fe9f5d37));}return $v22ee71e9dcc9ca12fc313c6e1ce3f806;}public static function getAllowedTplMacroses() {if (defined('XML_MACROSES_DISABLE') && XML_MACROSES_DISABLE) {return mainConfiguration::getInstance()->get('kernel', 'xml-macroses.allowed');}else {return null;}}public static function executeMacroses($v56491f2e1c74898e18bb6e47d2425b19, $vaf0bf69b4590545119c86ee0e59c088d = false, $v5d8603331b744a86bd36e07552225714 = false) {if (self::isParseTPLMacrosesAllowed()) {if (strpos($v56491f2e1c74898e18bb6e47d2425b19, '%') === false) return $v56491f2e1c74898e18bb6e47d2425b19;$v8980246496f088322ddf9eca96750755 = umiTemplater::create('TPL');$v8980246496f088322ddf9eca96750755->executeOnlyAllowedMacroses(self::getAllowedTplMacroses());$v8980246496f088322ddf9eca96750755->setScope($vaf0bf69b4590545119c86ee0e59c088d, $v5d8603331b744a86bd36e07552225714);$v56491f2e1c74898e18bb6e47d2425b19 = $v8980246496f088322ddf9eca96750755->parse(array(), $v56491f2e1c74898e18bb6e47d2425b19);}return $v56491f2e1c74898e18bb6e47d2425b19;}protected function translateBasic(DOMElement $v173a1756d2d82394cb803161f70f9a38, $v56491f2e1c74898e18bb6e47d2425b19) {$vdd988cfd769c9f7fbd795a0f5da8e751 = $this->domDocument;$v56491f2e1c74898e18bb6e47d2425b19 = self::executeMacroses($v56491f2e1c74898e18bb6e47d2425b19);$v8e2dcfd7e7e24b1ca76c1193f645902b = $vdd988cfd769c9f7fbd795a0f5da8e751->createTextNode($v56491f2e1c74898e18bb6e47d2425b19);$v173a1756d2d82394cb803161f70f9a38->appendChild($v8e2dcfd7e7e24b1ca76c1193f645902b);}protected function translateArray(DOMElement $v173a1756d2d82394cb803161f70f9a38, $v56491f2e1c74898e18bb6e47d2425b19) {$vdd988cfd769c9f7fbd795a0f5da8e751 = $this->domDocument;foreach($v56491f2e1c74898e18bb6e47d2425b19 as $v3c6e0b8a9c15224a8228b9a98ca1531d => $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {if($this->isKeySubnodes($v3c6e0b8a9c15224a8228b9a98ca1531d)) {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d);$v9b207167e5381c47682c6b4f58a623fb[$v3c6e0b8a9c15224a8228b9a98ca1531d] = Array();$v9b207167e5381c47682c6b4f58a623fb[$v3c6e0b8a9c15224a8228b9a98ca1531d]['nodes:item'] = $v3a6d0284e743dc4a9b86f97d6dd1a3bf;$v3a6d0284e743dc4a9b86f97d6dd1a3bf = $v9b207167e5381c47682c6b4f58a623fb;unset($v9b207167e5381c47682c6b4f58a623fb);}switch(true) {case $this->isKeyANull($v3c6e0b8a9c15224a8228b9a98ca1531d): {break;}case $this->isKeyAFull($v3c6e0b8a9c15224a8228b9a98ca1531d): {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d);if($v3c6e0b8a9c15224a8228b9a98ca1531d == false) {$v8e2dcfd7e7e24b1ca76c1193f645902b = $v173a1756d2d82394cb803161f70f9a38;}else {$v8e2dcfd7e7e24b1ca76c1193f645902b = $vdd988cfd769c9f7fbd795a0f5da8e751->createElement($v3c6e0b8a9c15224a8228b9a98ca1531d);}$this->chooseTranslator($v8e2dcfd7e7e24b1ca76c1193f645902b, $v3a6d0284e743dc4a9b86f97d6dd1a3bf, true);if($v3c6e0b8a9c15224a8228b9a98ca1531d != false) {$v173a1756d2d82394cb803161f70f9a38->appendChild($v8e2dcfd7e7e24b1ca76c1193f645902b);}break;}case $this->isKeyAnAttribute($v3c6e0b8a9c15224a8228b9a98ca1531d): {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d);if($v3a6d0284e743dc4a9b86f97d6dd1a3bf === "" || is_null($v3a6d0284e743dc4a9b86f97d6dd1a3bf) || is_array($v3a6d0284e743dc4a9b86f97d6dd1a3bf)) break;$v173a1756d2d82394cb803161f70f9a38->setAttribute($v3c6e0b8a9c15224a8228b9a98ca1531d, $v3a6d0284e743dc4a9b86f97d6dd1a3bf);break;}case $this->isKeyANode($v3c6e0b8a9c15224a8228b9a98ca1531d): {$v36c4536996ca5615dcf9911f068786dc = $vdd988cfd769c9f7fbd795a0f5da8e751->createTextNode((string) $v3a6d0284e743dc4a9b86f97d6dd1a3bf);$v173a1756d2d82394cb803161f70f9a38->appendChild($v36c4536996ca5615dcf9911f068786dc);break;}case $this->isKeyNodes($v3c6e0b8a9c15224a8228b9a98ca1531d): {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d);if(is_array($v3a6d0284e743dc4a9b86f97d6dd1a3bf)) {foreach($v3a6d0284e743dc4a9b86f97d6dd1a3bf as $vf19e92e810d08b6cf2d0265b779064d9) {$v8e2dcfd7e7e24b1ca76c1193f645902b = $vdd988cfd769c9f7fbd795a0f5da8e751->createElement($v3c6e0b8a9c15224a8228b9a98ca1531d);$this->chooseTranslator($v8e2dcfd7e7e24b1ca76c1193f645902b, $vf19e92e810d08b6cf2d0265b779064d9);$v173a1756d2d82394cb803161f70f9a38->appendChild($v8e2dcfd7e7e24b1ca76c1193f645902b);}}break;}case $this->isKeyXml($v3c6e0b8a9c15224a8228b9a98ca1531d): {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d);$v3a6d0284e743dc4a9b86f97d6dd1a3bf = html_entity_decode($v3a6d0284e743dc4a9b86f97d6dd1a3bf, ENT_COMPAT, "utf-8");$v3a6d0284e743dc4a9b86f97d6dd1a3bf = str_replace('&', '&amp;', $v3a6d0284e743dc4a9b86f97d6dd1a3bf);$v75e4635b97622e5504161a4a8ba7bea8 = @secure_load_simple_xml($v3a6d0284e743dc4a9b86f97d6dd1a3bf);if($v75e4635b97622e5504161a4a8ba7bea8 !== false) {if($vce2efc879f403662a84494ec120a1543 = dom_import_simplexml($v75e4635b97622e5504161a4a8ba7bea8)) {$vce2efc879f403662a84494ec120a1543 = $vdd988cfd769c9f7fbd795a0f5da8e751->importNode($vce2efc879f403662a84494ec120a1543, true);$v173a1756d2d82394cb803161f70f9a38->appendChild($vce2efc879f403662a84494ec120a1543);}break;}else {$v173a1756d2d82394cb803161f70f9a38->appendChild($vdd988cfd769c9f7fbd795a0f5da8e751->createTextNode($v3a6d0284e743dc4a9b86f97d6dd1a3bf));break;}}case $this->isKeyXLink($v3c6e0b8a9c15224a8228b9a98ca1531d): {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d);$v173a1756d2d82394cb803161f70f9a38->setAttribute("xlink:" . $v3c6e0b8a9c15224a8228b9a98ca1531d, $v3a6d0284e743dc4a9b86f97d6dd1a3bf);break;}case $this->isKeyComment($v3c6e0b8a9c15224a8228b9a98ca1531d): {$v173a1756d2d82394cb803161f70f9a38->appendChild(new DOMComment(' ' . $v3a6d0284e743dc4a9b86f97d6dd1a3bf . ' '));break;}default: {if($v3c6e0b8a9c15224a8228b9a98ca1531d === 0) {throw new coreException("Can't translate to xml key {$v3c6e0b8a9c15224a8228b9a98ca1531d} with value {$v3a6d0284e743dc4a9b86f97d6dd1a3bf}");break;}$v8e2dcfd7e7e24b1ca76c1193f645902b = $vdd988cfd769c9f7fbd795a0f5da8e751->createElement($v3c6e0b8a9c15224a8228b9a98ca1531d);$this->chooseTranslator($v8e2dcfd7e7e24b1ca76c1193f645902b, $v3a6d0284e743dc4a9b86f97d6dd1a3bf);$v173a1756d2d82394cb803161f70f9a38->appendChild($v8e2dcfd7e7e24b1ca76c1193f645902b);break;}}}}protected function isKeyANull($v3c6e0b8a9c15224a8228b9a98ca1531d) {return $this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d) == "void";}protected function isKeyAFull($v3c6e0b8a9c15224a8228b9a98ca1531d) {return $this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d) == "full";}protected function isKeyAnAttribute($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v518d8dec3947df909fe6e4c9940f98a6 = $this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d);return ($v518d8dec3947df909fe6e4c9940f98a6 == "attr" || $v518d8dec3947df909fe6e4c9940f98a6 == "attribute");}protected function isKeyANode($v3c6e0b8a9c15224a8228b9a98ca1531d) {return ($this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d) == "node");}protected function isKeyNodes($v3c6e0b8a9c15224a8228b9a98ca1531d) {return ($this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d) == "nodes"  || $this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d) == "list");}protected function isKeySubnodes($v3c6e0b8a9c15224a8228b9a98ca1531d) {return ($this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d) == "subnodes");}protected function isKeyXml($v3c6e0b8a9c15224a8228b9a98ca1531d) {return ($this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d) == "xml");}protected function isKeyXLink($v3c6e0b8a9c15224a8228b9a98ca1531d) {return ($this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d) == "xlink");}protected function isKeyComment($v3c6e0b8a9c15224a8228b9a98ca1531d) {return ($this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d) == "comment");}public static function getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v8b04d5e3775d298e78455efc5ca404d5 = substr($v3c6e0b8a9c15224a8228b9a98ca1531d, 0, 1);if(isset(self::$shortKeys[$v8b04d5e3775d298e78455efc5ca404d5])) {return substr($v3c6e0b8a9c15224a8228b9a98ca1531d, 1);}if($v5e0bdcbddccca4d66d74ba8c1cee1a68 = strpos($v3c6e0b8a9c15224a8228b9a98ca1531d, ":")) {++$v5e0bdcbddccca4d66d74ba8c1cee1a68;}else {$v5e0bdcbddccca4d66d74ba8c1cee1a68 = 0;}return substr($v3c6e0b8a9c15224a8228b9a98ca1531d, $v5e0bdcbddccca4d66d74ba8c1cee1a68);}public static function getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v8b04d5e3775d298e78455efc5ca404d5 = substr($v3c6e0b8a9c15224a8228b9a98ca1531d, 0, 1);if(isset(self::$shortKeys[$v8b04d5e3775d298e78455efc5ca404d5])) {return self::$shortKeys[$v8b04d5e3775d298e78455efc5ca404d5];}if($v5e0bdcbddccca4d66d74ba8c1cee1a68 = strpos($v3c6e0b8a9c15224a8228b9a98ca1531d, ":")) {return substr($v3c6e0b8a9c15224a8228b9a98ca1531d, 0, $v5e0bdcbddccca4d66d74ba8c1cee1a68);}else {return false;}}};?>
