<?php
 class CheckPermissionsAction extends atomicAction {public function execute() {$ve6c2a6346c15ba2584950ab8e0f946f8 = $this->getParam('target');if(file_exists($ve6c2a6346c15ba2584950ab8e0f946f8) == false) {throw new Exception("Doesn't exsist target \"{$ve6c2a6346c15ba2584950ab8e0f946f8}\"");}if(is_writable($ve6c2a6346c15ba2584950ab8e0f946f8) == false) {throw new Exception("Target must be writable \"{$ve6c2a6346c15ba2584950ab8e0f946f8}\"");}}public function rollback() {}};?>