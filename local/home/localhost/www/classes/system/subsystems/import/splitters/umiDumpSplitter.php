<?php
 class umiDumpSplitter extends umiImportSplitter {protected function readDataBlock() {secure_load_dom_document(file_get_contents($this->file_path), $v9a09b4dfda82e3e665e31092d1c3ec8d);$this->offset = 0;$this->complete = true;return $v9a09b4dfda82e3e665e31092d1c3ec8d;}public function translate(DomDocument $v9a09b4dfda82e3e665e31092d1c3ec8d) {return $v9a09b4dfda82e3e665e31092d1c3ec8d->saveXML();}}?>