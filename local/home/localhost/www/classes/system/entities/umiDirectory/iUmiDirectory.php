<?php
 interface iUmiDirectory {public function getPath();public function getName();public function getIsBroken();public function getFSObjects($v726e8e4809d4c1b28a6549d86436a124 = 0, $vf2ce11ebf110993621bedd8e747d7b1b = "", $v327b3f8ccde0226c924bcb6f34a30232 = false);public function getFiles($vf2ce11ebf110993621bedd8e747d7b1b = "", $v327b3f8ccde0226c924bcb6f34a30232 = false);public function getDirectories($vf2ce11ebf110993621bedd8e747d7b1b = "", $v327b3f8ccde0226c924bcb6f34a30232 = false);public function getAllFiles($vd1c23eb6cdb82a62e26a8b358943d104=0, $v680c0a11687c0b2cf6554086431e2d31="", $v17fa2d7e21098f98c5ecf28224bd9e90=false);public function delete($vf8532b6380228945d474f37fb6cdac27 = true);public static function requireFolder($v851148b4fd8fd7ae74bd9100c5c0c898, $v2d5ec04ac614a2ce7db2e49fce18670c = "");};?>