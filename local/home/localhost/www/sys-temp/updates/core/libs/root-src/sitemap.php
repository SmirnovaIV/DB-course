<?php
 header("Content-type: text/xml");if (ob_get_level()>0) {ob_clean();}require CURRENT_WORKING_DIR . '/libs/config.php';echo '<?xml version="1.0" encoding="UTF-8"?>
	<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';$v8b1dc169bf460ee884fceef66c6607d6 = cmsController::getInstance();$v72ee76c5c29383b7c9f9225c1fa4d10b = $v8b1dc169bf460ee884fceef66c6607d6->getCurrentDomain()->getId();$v100664c6e2c0333b19a729f2f3ddb7dd = CURRENT_WORKING_DIR . "/sys-temp/sitemap/{$v72ee76c5c29383b7c9f9225c1fa4d10b}/";$v736007832d2167baaae763fd3a3f3cf1 = dir($v100664c6e2c0333b19a729f2f3ddb7dd);while (false !== ($v8c7dd922ad47494fc02c388e12c00eac = $v736007832d2167baaae763fd3a3f3cf1->read())) {if(is_file($v100664c6e2c0333b19a729f2f3ddb7dd . $v8c7dd922ad47494fc02c388e12c00eac)) readfile($v100664c6e2c0333b19a729f2f3ddb7dd . $v8c7dd922ad47494fc02c388e12c00eac);}$v736007832d2167baaae763fd3a3f3cf1->close();echo '</urlset>';?>
