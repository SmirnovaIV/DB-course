<?php
 class sampleManifestCallback implements iManifestCallback {public function onBeforeTransactionExecute(iTransaction $vf4d5b76a2418eba4baeabc1ed9142b54) {$this->log("Запуск транзакции \"" . $vf4d5b76a2418eba4baeabc1ed9142b54->getTitle() . "\"");}public function onAfterTransactionExecute(iTransaction $vf4d5b76a2418eba4baeabc1ed9142b54) {}public function onBeforeActionExecute(iAtomicAction $v418c5509e2171d55b0aee5c2ea4442b5) {$this->log("Выполняется действие \"" . $v418c5509e2171d55b0aee5c2ea4442b5->getTitle() . "\"");}public function onAfterActionExecute(iAtomicAction $v418c5509e2171d55b0aee5c2ea4442b5) {}public function onBeforeExecute() {$this->log("Запуск манифеста");}public function onAfterExecute() {$this->log("Завершение манифеста");}public function onBeforeRollback() {$this->log("Начинаем откат изменений", true);}public function onAfterRollback() {}public function onException(Exception $ve1671797c52e15f763380b45e841ec32) {$this->log("Возникло исключение", true);}protected function log($v6e2baaf3b97dbeef01c0043275f9a0e7, $v81ae42f244763331c3caaced7f5a1dc0 = false) {if($v81ae42f244763331c3caaced7f5a1dc0) {$v6e2baaf3b97dbeef01c0043275f9a0e7 = "<font color=\"red\">{$v6e2baaf3b97dbeef01c0043275f9a0e7}</font>";}echo $v6e2baaf3b97dbeef01c0043275f9a0e7, "\n";}public function onBeforeActionRollback(iAtomicAction $v418c5509e2171d55b0aee5c2ea4442b5) {$this->log("Откатывается действие \"" . $v418c5509e2171d55b0aee5c2ea4442b5->getTitle() . "\"", true);}public function onAfterActionRollback(iAtomicAction $v418c5509e2171d55b0aee5c2ea4442b5) {}};?>