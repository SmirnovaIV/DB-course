<?php
 class SaveBranchTableRelationsAction extends atomicAction {public function execute() {$v47826cacc65c665212b821e6ff80b9b0 = CURRENT_WORKING_DIR . "/cache/branchedTablesRelations.rel";if(is_file($v47826cacc65c665212b821e6ff80b9b0)) {unlink($v47826cacc65c665212b821e6ff80b9b0);}umiBranch::saveBranchedTablesRelations();}public function rollback() {$v47826cacc65c665212b821e6ff80b9b0 = CURRENT_WORKING_DIR . "/cache/branchedTablesRelations.rel";if(is_file($v47826cacc65c665212b821e6ff80b9b0)) {unlink($v47826cacc65c665212b821e6ff80b9b0);}}};?>