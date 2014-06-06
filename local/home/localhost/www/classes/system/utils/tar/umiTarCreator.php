<?php
class umiTarCreator {const TAR_CHUNK_SIZE = 512;const READ_CHUNK_SIZE = 2048;private $archiveFilename = null;private $listFilename = null;private $handle = null;public function __construct($v1290c602f3164c4bb1987e9151a021eb, $v32e4baaff2491fd54edac3496c6e06cd) {$this->archiveFilename = $v1290c602f3164c4bb1987e9151a021eb;$this->listFilename = $v32e4baaff2491fd54edac3496c6e06cd;}public function process($vaa9f73eea60a006820d0f8768bc8a3fc = false) {$v10ae9fc7d453b0dd525d0edf2ede7961 = $this->loadList();$this->open();if(!$vaa9f73eea60a006820d0f8768bc8a3fc) {$vaa9f73eea60a006820d0f8768bc8a3fc = count($v10ae9fc7d453b0dd525d0edf2ede7961);}for($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $vaa9f73eea60a006820d0f8768bc8a3fc;$v865c0c0b4ab0e063e5caa3387c1a8741++) {$vb068931cc450442b63f5b3d276ea4297 = rtrim($v10ae9fc7d453b0dd525d0edf2ede7961[$v865c0c0b4ab0e063e5caa3387c1a8741], "\r\n");if(!strlen($vb068931cc450442b63f5b3d276ea4297)) continue;$vcaf9b6b99962bf5c2264824231d7a40c = stat(rtrim($vb068931cc450442b63f5b3d276ea4297, "/\\"));if(is_dir(rtrim($vb068931cc450442b63f5b3d276ea4297, "/\\"))) {$this->writeDirectory($vb068931cc450442b63f5b3d276ea4297, $vcaf9b6b99962bf5c2264824231d7a40c);}else {$this->writeFile($vb068931cc450442b63f5b3d276ea4297, $vcaf9b6b99962bf5c2264824231d7a40c);}}$v10ae9fc7d453b0dd525d0edf2ede7961 = array_slice($v10ae9fc7d453b0dd525d0edf2ede7961, $vaa9f73eea60a006820d0f8768bc8a3fc);$this->saveList($v10ae9fc7d453b0dd525d0edf2ede7961);if(empty($v10ae9fc7d453b0dd525d0edf2ede7961)) {fwrite($this->handle, str_repeat(chr(0), umiTarCreator::TAR_CHUNK_SIZE * 2));}$this->close();return empty($v10ae9fc7d453b0dd525d0edf2ede7961);}private function open() {if($this->handle == null) {$this->handle = fopen($this->archiveFilename, 'ab');if($this->handle === false) {throw new Exception("umiTarCreator: Can't open {$this->archiveFilename}");}}return $this->handle;}private function close() {if($this->handle != null) {fclose($this->handle);}}private function loadList() {$v10ae9fc7d453b0dd525d0edf2ede7961 = file($this->listFilename, FILE_IGNORE_NEW_LINES);if($v10ae9fc7d453b0dd525d0edf2ede7961 == false) {throw new Exception("umiTarCreator: Can't read list of files {$this->archiveFilename}");}return $v10ae9fc7d453b0dd525d0edf2ede7961;}private function saveList($v10ae9fc7d453b0dd525d0edf2ede7961) {file_put_contents($this->listFilename, implode("\n", $v10ae9fc7d453b0dd525d0edf2ede7961));}private function writeDirectory($vb068931cc450442b63f5b3d276ea4297, $v77ddcb5f19832f4145345889013ab3a4) {$this->writeHeader($vb068931cc450442b63f5b3d276ea4297, $v77ddcb5f19832f4145345889013ab3a4, '5');}private function writeFile($vb068931cc450442b63f5b3d276ea4297, $v77ddcb5f19832f4145345889013ab3a4) {$this->writeHeader($vb068931cc450442b63f5b3d276ea4297, $v77ddcb5f19832f4145345889013ab3a4);$va43c1b0aa53a0c908810c06ab1ff3967 = fopen($vb068931cc450442b63f5b3d276ea4297, "rb");$vf4aea2ef06eadd2023751cd1c042c2e0 = 0;$vd1415738730d3a560c393e6e74888931 = 0;do{$v8d777f385d3dfec8815d20f7496026dc = fread($va43c1b0aa53a0c908810c06ab1ff3967, umiTarCreator::READ_CHUNK_SIZE);$v4757fe07fd492a8be0ea6a760d683d6e = ftell($va43c1b0aa53a0c908810c06ab1ff3967);$vf4aea2ef06eadd2023751cd1c042c2e0 = $v4757fe07fd492a8be0ea6a760d683d6e - $vd1415738730d3a560c393e6e74888931;$vd1415738730d3a560c393e6e74888931 = $v4757fe07fd492a8be0ea6a760d683d6e;fwrite($this->handle, $v8d777f385d3dfec8815d20f7496026dc, $vf4aea2ef06eadd2023751cd1c042c2e0);}while($vf4aea2ef06eadd2023751cd1c042c2e0 == umiTarCreator::READ_CHUNK_SIZE);$v95fe270925c68e1d2c732cbeea907ce2 = floor($v77ddcb5f19832f4145345889013ab3a4['size'] / umiTarCreator::TAR_CHUNK_SIZE) + 1;$v86a6d791105388a90ca1040b1d1df664 = $v95fe270925c68e1d2c732cbeea907ce2 * umiTarCreator::TAR_CHUNK_SIZE - $v77ddcb5f19832f4145345889013ab3a4['size'];fwrite($this->handle, str_repeat(chr(0), $v86a6d791105388a90ca1040b1d1df664), $v86a6d791105388a90ca1040b1d1df664);fclose($va43c1b0aa53a0c908810c06ab1ff3967);}private function writeHeader($vb068931cc450442b63f5b3d276ea4297, $v77ddcb5f19832f4145345889013ab3a4, $v599dcce2998a6b40b1e38e8c6006cb0a = '0') {$v49f290d6e8459c53f31f97de37921086 = function_exists('posix_getpwuid') ? posix_getpwuid($v77ddcb5f19832f4145345889013ab3a4['uid']) : array('name' => '');$v2e847b4bdd51143b305f4f5ad6691d5f = function_exists('posix_getgrgid') ? posix_getgrgid($v77ddcb5f19832f4145345889013ab3a4['gid']) : array('name' => '');$v15d61712450a686a7f365adf4fef581f = sprintf("%07o", fileperms(rtrim($vb068931cc450442b63f5b3d276ea4297, "/\\")));$v9871d3a2c554b27151cacf1422eec048 = sprintf("%07o", $v77ddcb5f19832f4145345889013ab3a4['uid']);$v2d53a8fb7abf5be7f4a3cf4b565cc75c = sprintf("%07o", $v77ddcb5f19832f4145345889013ab3a4['gid']);$vf7bd60b75b29d79b660a2859395c1a24 = sprintf("%011o", $v77ddcb5f19832f4145345889013ab3a4['size']);$v7076b27a4ff56615fedb41f803f69baa = sprintf("%011o", $v77ddcb5f19832f4145345889013ab3a4['mtime']);$v226190d94b21d1b0c7b1a42d855e419d = '        ';$v4040592cec1880aa70936989f05e7c31 = $v49f290d6e8459c53f31f97de37921086['name'];$vbf7813cb217b0818d203a86281bf0545 = $v2e847b4bdd51143b305f4f5ad6691d5f['name'];$vef5825b6e596a968aaa775f9ea4f1a3d = '0000000';$vd2891cdf485d7bc1e545d276a7b0df2f = '0000000';$v2f3a4fccca6406e35bcf33e92dd93135    = 'ustar ';$v2af72f100c356273d46284f6fd1dfc08  = '00';$vb0af62cad58ccb302131b0fde0f87e36 = '';$v851f5ac9941d720844d143ed9cfcf60a   = '';$v4040592cec1880aa70936989f05e7c31    = '';if(strlen($vb068931cc450442b63f5b3d276ea4297) > 100) {$v38ba60b5ece08bbd7694cd83fc4ae1be = strpos($vb068931cc450442b63f5b3d276ea4297, '/', strlen($vb068931cc450442b63f5b3d276ea4297) - 100);$v851f5ac9941d720844d143ed9cfcf60a = substr($vb068931cc450442b63f5b3d276ea4297, 0, $v38ba60b5ece08bbd7694cd83fc4ae1be);$vb068931cc450442b63f5b3d276ea4297 = substr($vb068931cc450442b63f5b3d276ea4297, $v38ba60b5ece08bbd7694cd83fc4ae1be + 1);}$v099fb995346f31c749f6e40db0f395e3 = pack('a100a8a8a8a12a12a8a1a100a6a2a32a32a8a8a155x12',       $vb068931cc450442b63f5b3d276ea4297, $v15d61712450a686a7f365adf4fef581f, $v9871d3a2c554b27151cacf1422eec048, $v2d53a8fb7abf5be7f4a3cf4b565cc75c, $vf7bd60b75b29d79b660a2859395c1a24, $v7076b27a4ff56615fedb41f803f69baa,       $v226190d94b21d1b0c7b1a42d855e419d, $v599dcce2998a6b40b1e38e8c6006cb0a, $vb0af62cad58ccb302131b0fde0f87e36, $v2f3a4fccca6406e35bcf33e92dd93135, $v2af72f100c356273d46284f6fd1dfc08,       $v4040592cec1880aa70936989f05e7c31, $vbf7813cb217b0818d203a86281bf0545, $vef5825b6e596a968aaa775f9ea4f1a3d, $vd2891cdf485d7bc1e545d276a7b0df2f, $v851f5ac9941d720844d143ed9cfcf60a);$v226190d94b21d1b0c7b1a42d855e419d = 0;for($v865c0c0b4ab0e063e5caa3387c1a8741=0;$v865c0c0b4ab0e063e5caa3387c1a8741 < umiTarCreator::TAR_CHUNK_SIZE;$v865c0c0b4ab0e063e5caa3387c1a8741++) {$v226190d94b21d1b0c7b1a42d855e419d += ord($v099fb995346f31c749f6e40db0f395e3[$v865c0c0b4ab0e063e5caa3387c1a8741]);}$v226190d94b21d1b0c7b1a42d855e419d = sprintf("%06o\0 ", $v226190d94b21d1b0c7b1a42d855e419d);$v099fb995346f31c749f6e40db0f395e3 = substr_replace($v099fb995346f31c749f6e40db0f395e3, $v226190d94b21d1b0c7b1a42d855e419d, 148, 8);if(fwrite($this->handle, $v099fb995346f31c749f6e40db0f395e3, umiTarCreator::TAR_CHUNK_SIZE) != umiTarCreator::TAR_CHUNK_SIZE) {throw new Exception("umiTarCreator: Can't write header for {$v851f5ac9941d720844d143ed9cfcf60a}/{$vb068931cc450442b63f5b3d276ea4297} to {$this->archiveFilename}");}}};?>
