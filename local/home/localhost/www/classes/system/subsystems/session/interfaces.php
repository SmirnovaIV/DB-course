<?php
 interface iSession{public static function getInstance();public static function recreateInstance($v08a3fc7e7897fe3ca69d19f76f86e93c = false);public static function destroy();public static function commit();public static function getId();public static function setId($vb80bb7740288fda1f201890375a60c8f);public static function getName();public static function setName($vb068931cc450442b63f5b3d276ea4297);}interface iSessionValidation {public function isValid();public function setValid($vce74825b5a01c99b06af231de0bd667d = true);}?>