<?xml version="1.0" encoding="utf-8"?>
<!--<!DOCTYPE xsl:stylesheet SYSTEM	"ulang://i18n/smthng.dtd:file">
-->
<xsl:stylesheet	version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:xlink="http://www.w3.org/TR/xlink"
	xmlns:umi="http://www.umi-cms.ru/TR/umi"
	exclude-result-prefixes="xlink">

	<xsl:output encoding="utf-8" method="html" indent="yes"/>
	<xsl:include href="common.xsl" />

	<xsl:template match="/">
		<html lang="en">
			<head>
				<meta charset="UTF-8"/>
				<title><xsl:value-of select="result/@title"/></title>
				<link rel="stylesheet" href="{$template-resources}css/styles.css"/>
				<link href="{$template-resources}plugins/magnific_popup/magnific-popup.css" rel="stylesheet" type="text/css" media="all"/>
				<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>			
				<script src="{$template-resources}plugins/magnific_popup/jquery.magnific-popup.min.js"></script>
				<script>
					$(document).ready(function() {
					$('.popup-gallery').magnificPopup({
					delegate: 'a',
					type: 'image',
					tLoading: 'Loading image #%curr%...',
					mainClass: 'mfp-img-mobile',
					gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
					},
					image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
					return item.el.attr('title') + '<small><xsl:value-of select="document(concat('uobject://', $user/@id))//property[@name = 'fname']/value"/><xsl:text> </xsl:text><xsl:value-of select="document(concat('uobject://', $user/@id))//property[@name = 'lname']/value"/></small>';
					}
					}
					});
					});
				</script>
			</head>
			<body>
				<div class="all">
					<div class="container">
						<h1><xsl:value-of select="result/@site-name"/></h1>
					</div>
					<xsl:apply-templates select="document('udata://content/menu/')/udata"/>
					<xsl:apply-templates select="result"/>
				</div>
			</body>
		</html>
	</xsl:template>

</xsl:stylesheet>