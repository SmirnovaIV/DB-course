<?php
 class umiFieldTypeWrapper extends translatorWrapper {public function translate($v8d777f385d3dfec8815d20f7496026dc) {return $this->translateData($v8d777f385d3dfec8815d20f7496026dc);}protected function translateData(iUmiFieldType $v833750ac635fcc57dc33ecafe365f9a7) {$v26b75b176d665f24a5fd22a2ad815763 = array(    'attribute:id'   => $v833750ac635fcc57dc33ecafe365f9a7->getId(),    'attribute:name'  => $v833750ac635fcc57dc33ecafe365f9a7->getName(),    'attribute:data-type' => $v833750ac635fcc57dc33ecafe365f9a7->getDataType()   );if($v833750ac635fcc57dc33ecafe365f9a7->getIsMultiple()) {$v26b75b176d665f24a5fd22a2ad815763['attribute:multiple'] = "multiple";}return $v26b75b176d665f24a5fd22a2ad815763;}};?>