<?php
 class systemDomainRestriction extends baseRestriction implements iNormalizeInRestriction, iNormalizeOutRestriction {protected $errorMessage = 'restriction-error-domain-id';public function validate($v2063c1608d6e0baf80249c42e2be5804, $v16b2b26000987faccb260b9d39df1269 = false) {$v72ee76c5c29383b7c9f9225c1fa4d10b = (int) $v2063c1608d6e0baf80249c42e2be5804;$ve4e46deb7f9cc58c7abfb32e5570b6f3 = domainsCollection::getInstance();return ($ve4e46deb7f9cc58c7abfb32e5570b6f3->getDomain($v72ee76c5c29383b7c9f9225c1fa4d10b) instanceof iDomain);}public function normalizeOut($v2063c1608d6e0baf80249c42e2be5804, $v16b2b26000987faccb260b9d39df1269 = false) {if(is_numeric($v2063c1608d6e0baf80249c42e2be5804)) {$vad5f82e879a9c5d6b5b442eb37e50551 = selector::get('domain')->id($v2063c1608d6e0baf80249c42e2be5804);return ($vad5f82e879a9c5d6b5b442eb37e50551 instanceof iDomain) ? $vad5f82e879a9c5d6b5b442eb37e50551->getHost() : $v2063c1608d6e0baf80249c42e2be5804;}else return $v2063c1608d6e0baf80249c42e2be5804;}public function normalizeIn($v2063c1608d6e0baf80249c42e2be5804, $v16b2b26000987faccb260b9d39df1269 = false) {$vad5f82e879a9c5d6b5b442eb37e50551 = null;if(is_numeric($v2063c1608d6e0baf80249c42e2be5804)) {$vad5f82e879a9c5d6b5b442eb37e50551 = selector::get('domain')->id($v2063c1608d6e0baf80249c42e2be5804);}else {$vad5f82e879a9c5d6b5b442eb37e50551 = selector::get('domain')->host($v2063c1608d6e0baf80249c42e2be5804);}return ($vad5f82e879a9c5d6b5b442eb37e50551 instanceof iDomain) ? (int) $vad5f82e879a9c5d6b5b442eb37e50551->getId() : null;}};?>