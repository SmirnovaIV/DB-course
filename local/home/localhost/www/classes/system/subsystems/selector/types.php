<?php
 class selectorType {protected $typeClass, $objectType, $hierarchyType, $selector;protected static $typeClasses = array('object-type', 'hierarchy-type');public function __construct($v2dda916891cbd0bf046213df34800783, $v5b3c32009797feb79096d52e56a56b82) {$this->setTypeClass($v2dda916891cbd0bf046213df34800783);$this->selector = $v5b3c32009797feb79096d52e56a56b82;}public function name($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce) {if(!$vea9f6aca279138c58f705c8d4cb4b8ce && $v22884db148f0ffb0d830ba431102b0b5 == 'content') $vea9f6aca279138c58f705c8d4cb4b8ce = 'page';switch($this->typeClass) {case 'object-type': {$v0e8133eb006c0f85ed9444ae07a60842 = umiObjectTypesCollection::getInstance();$v6301cee35ea764a1e241978f93f01069 = $v0e8133eb006c0f85ed9444ae07a60842->getBaseType($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce);return $this->setObjectType($v0e8133eb006c0f85ed9444ae07a60842->getType($v6301cee35ea764a1e241978f93f01069));}case 'hierarchy-type': {$v6942e8fa62b3cc9d93881a58210e2fd7 = umiHierarchyTypesCollection::getInstance();$v89b0b9deff65f8b9cd1f71bc74ce36ba = $v6942e8fa62b3cc9d93881a58210e2fd7->getTypeByName($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce);return $this->setHierarchyType($v89b0b9deff65f8b9cd1f71bc74ce36ba);}}}public function id($vb80bb7740288fda1f201890375a60c8f) {if(is_array($vb80bb7740288fda1f201890375a60c8f)) {$result = null;foreach($vb80bb7740288fda1f201890375a60c8f as $vb5210062221c584573e8e554dfcfd026) {$this->selector->types($this->typeClass)->id($vb5210062221c584573e8e554dfcfd026);}return $result;}switch($this->typeClass) {case 'object-type': {$v0e8133eb006c0f85ed9444ae07a60842 = umiObjectTypesCollection::getInstance();return $this->setObjectType($v0e8133eb006c0f85ed9444ae07a60842->getType($vb80bb7740288fda1f201890375a60c8f));}case 'hierarchy-type': {$v6942e8fa62b3cc9d93881a58210e2fd7 = umiHierarchyTypesCollection::getInstance();return $this->setHierarchyType($v6942e8fa62b3cc9d93881a58210e2fd7->getType($vb80bb7740288fda1f201890375a60c8f));}}}public function guid($v1e0ca5b1252f1f6b1e0ac91be7e7219e) {if($this->typeClass != 'object-type') {throw new selectorException("Select by guid is allowed only for object-type");}if(is_array($v1e0ca5b1252f1f6b1e0ac91be7e7219e)) {$v0d36323f5b053b8f3a0db27177660854[] = array();foreach($v1e0ca5b1252f1f6b1e0ac91be7e7219e as $v9e3669d19b675bd57058fd4664205d2a) {$v0d36323f5b053b8f3a0db27177660854[] = umiObjectTypesCollection::getInstance()->getTypeIdByGUID($v9e3669d19b675bd57058fd4664205d2a);}$v1e0ca5b1252f1f6b1e0ac91be7e7219e = $v0d36323f5b053b8f3a0db27177660854;}else {$v1e0ca5b1252f1f6b1e0ac91be7e7219e = umiObjectTypesCollection::getInstance()->getTypeIdByGUID($v1e0ca5b1252f1f6b1e0ac91be7e7219e);}return $this->id($v1e0ca5b1252f1f6b1e0ac91be7e7219e);}public function setTypeClass($v2dda916891cbd0bf046213df34800783) {if(in_array($v2dda916891cbd0bf046213df34800783, self::$typeClasses)) {$this->typeClass = $v2dda916891cbd0bf046213df34800783;}else {throw new selectorException(     "Unkown type class \"{$v2dda916891cbd0bf046213df34800783}\". These types are only supported: " . implode(", ", self::$typeClasses)    );}}public function getFieldId($v972bf3f05d14ffbdb817bef60638ff00) {if(is_null($this->objectType)) {if(is_null($this->hierarchyType)) {throw new selectorException("Object and hierarchy type prop can't be empty both");}$v0e8133eb006c0f85ed9444ae07a60842 = umiObjectTypesCollection::getInstance();$v6301cee35ea764a1e241978f93f01069 = $v0e8133eb006c0f85ed9444ae07a60842->getTypeByHierarchyTypeId($this->hierarchyType->getId());if($v726e8e4809d4c1b28a6549d86436a124 = $v0e8133eb006c0f85ed9444ae07a60842->getType($v6301cee35ea764a1e241978f93f01069)) {$this->setObjectType($v726e8e4809d4c1b28a6549d86436a124);}else {return false;}}return $this->objectType->getFieldId($v972bf3f05d14ffbdb817bef60638ff00);}public function __get($v23a5b8ab834cb5140fa6665622eb6417) {$v48f492cfc4344663d5a15ab0d2025226 = array('objectType', 'hierarchyType');if(in_array($v23a5b8ab834cb5140fa6665622eb6417, $v48f492cfc4344663d5a15ab0d2025226)) {return $this->$v23a5b8ab834cb5140fa6665622eb6417;}}protected function setObjectType($v726e8e4809d4c1b28a6549d86436a124) {if($v726e8e4809d4c1b28a6549d86436a124 instanceof iUmiObjectType) {$this->objectType = $v726e8e4809d4c1b28a6549d86436a124;}else {throw new selectorException("Wrong object type given");}}protected function setHierarchyType($v89b0b9deff65f8b9cd1f71bc74ce36ba) {if($v89b0b9deff65f8b9cd1f71bc74ce36ba instanceof iUmiHierarchyType) {$this->hierarchyType = $v89b0b9deff65f8b9cd1f71bc74ce36ba;}else {throw new selectorException("Wrong hierarchy type given");}}};?>