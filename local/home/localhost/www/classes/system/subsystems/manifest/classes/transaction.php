<?php
 class transaction implements iTransaction {protected $name, $title = "",    $actions = Array(), $completedActions = Array(), $callback,   $manifest;public function __construct($vb068931cc450442b63f5b3d276ea4297, manifest $v7f5cb74af5d7f4b82200738fdbdc5a45) {$this->name = (string) $vb068931cc450442b63f5b3d276ea4297;$this->manifest = $v7f5cb74af5d7f4b82200738fdbdc5a45;}public function getName() {return $this->name;}public function setTitle($vd5d3db1765287eef77d7927cc956f50a) {$this->title = (string) $vd5d3db1765287eef77d7927cc956f50a;}public function getTitle() {return $this->title;}public function addAtomicAction(iAtomicAction $v418c5509e2171d55b0aee5c2ea4442b5) {$this->actions[] = $v418c5509e2171d55b0aee5c2ea4442b5;}public function execute() {$vb6ce8e4371695e3fe1f36a93821e5b8d = &$this->completedActions;foreach($this->actions as $v418c5509e2171d55b0aee5c2ea4442b5) {if(in_array($v418c5509e2171d55b0aee5c2ea4442b5, $vb6ce8e4371695e3fe1f36a93821e5b8d)) {continue;}$v21ffce5b8a6cc8cc6a41448dd69623c9 = $this->getManifest()->getParams();foreach($v21ffce5b8a6cc8cc6a41448dd69623c9 as $vb068931cc450442b63f5b3d276ea4297 => $v2063c1608d6e0baf80249c42e2be5804) {$v418c5509e2171d55b0aee5c2ea4442b5->addParam($vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804);}$this->executeAction($v418c5509e2171d55b0aee5c2ea4442b5);$vb6ce8e4371695e3fe1f36a93821e5b8d[] = $v418c5509e2171d55b0aee5c2ea4442b5;if($this->getManifest()->hibernationsCountLeft > 0) {if($v418c5509e2171d55b0aee5c2ea4442b5->hibernate()) {$v418c5509e2171d55b0aee5c2ea4442b5->refresh();}}}}protected function executeAction(iAtomicAction $v418c5509e2171d55b0aee5c2ea4442b5) {try {if($this->callback instanceof iManifestCallback) {$this->callback->onBeforeActionExecute($v418c5509e2171d55b0aee5c2ea4442b5);$v418c5509e2171d55b0aee5c2ea4442b5->setCallback($this->callback);}$v418c5509e2171d55b0aee5c2ea4442b5->execute();if($this->callback instanceof iManifestCallback) {$this->callback->onAfterActionExecute($v418c5509e2171d55b0aee5c2ea4442b5);}}catch(Exception $ve1671797c52e15f763380b45e841ec32) {$this->rollback();throw $ve1671797c52e15f763380b45e841ec32;}}public function rollback() {$vb6ce8e4371695e3fe1f36a93821e5b8d = array_reverse($this->completedActions);foreach($vb6ce8e4371695e3fe1f36a93821e5b8d as $v418c5509e2171d55b0aee5c2ea4442b5) {try {if($this->callback instanceof iManifestCallback) {$this->callback->onBeforeActionRollback($v418c5509e2171d55b0aee5c2ea4442b5);}$v418c5509e2171d55b0aee5c2ea4442b5->rollback();if($this->callback instanceof iManifestCallback) {$this->callback->onAfterActionRollback($v418c5509e2171d55b0aee5c2ea4442b5);}}catch(Exception $ve1671797c52e15f763380b45e841ec32) {$this->registerException($ve1671797c52e15f763380b45e841ec32);}}}public function setCallback(iManifestCallback $v924a8ceeac17f54d3be3f8cdf1c04eb2) {$this->callback = $v924a8ceeac17f54d3be3f8cdf1c04eb2;}public function getManifest() {return $this->manifest;}protected function registerException(Exception $ve1671797c52e15f763380b45e841ec32) {if($this->callback instanceof iManifestCallback) {$this->callback->onException($ve1671797c52e15f763380b45e841ec32);}}};?>