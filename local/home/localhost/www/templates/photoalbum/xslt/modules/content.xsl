<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet	version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:umi="http://www.umi-cms.ru/TR/umi">

	<xsl:template match="result[@module = 'content' and @method = 'content']">
		<div class="container shadow" umi:element-id="{/result/@pageId}" umi:field-name="content" umi:empty="Содержание страницы">
			<xsl:value-of select="page//property[@name = 'content']/value" disable-output-escaping="yes" />
		</div>
	</xsl:template>

	<xsl:template match="result[@module = 'content' and @method = 'content' and page/@alt-name = 'users']">
		<div class="container shadow" umi:element-id="{/result/@pageId}" umi:field-name="content" umi:empty="Содержание страницы">
			<div class="users">
				<xsl:apply-templates select="document('udata://users/list_users/notemplate/')//item[@id != 2 and @id != 337]" mode="user"/>
				<div class="clear"></div>
			</div>
		</div>
	</xsl:template>

	<xsl:template match="item" mode="user">
		<div class="user">
			<!-- <div class="avatar">
				<img src="http://farm9.staticflickr.com/8378/8559402848_9fcd90d20b_s.jpg" alt=""/>
			</div> -->
			<div class="info">
				<div class="name"><a href="/users/profile/{@id}"><xsl:value-of select="document(concat('uobject://', @id))//property[@name = 'fname']/value"/><xsl:text> </xsl:text><xsl:value-of select="document(concat('uobject://', @id))//property[@name = 'lname']/value"/></a></div>
			</div>
		</div>
	</xsl:template>

	<xsl:template match="udata[@module = 'content' and @method = 'menu']">
		<div class="container menu">
			<ul class="menu" umi:module='content' umi:method='menu' umi:element-id="0" umi:button-position="bottom left" umi:region="list" umi:sortable="sortable">
				<xsl:apply-templates select="items/item" mode="menu" />
				
			</ul>
			<xsl:apply-templates select="$user" mode="user_menu"/>
		</div>
	</xsl:template>

	<xsl:template match="item" mode="menu">
		<li umi:region="row">
			<a href="{@link}" umi:element-id="{@id}" umi:field-name="name" umi:delete="delete" umi:empty="Название страницы">
				<xsl:value-of select="." />
			</a>
		</li>
	</xsl:template>

	<xsl:template match="item[@status = 'active']" mode="menu">
		<li umi:region="row" class="active">
			<a href="{@link}" umi:element-id="{@id}" umi:field-name="name" umi:delete="delete" umi:empty="Название страницы">
				<xsl:value-of select="." />
			</a>
		</li>
	</xsl:template>

	<xsl:template match="user[@status = 'auth']" mode="user_menu">
		<ul class="user_menu">
			<li>
				<a href="/users/profile/">
					<xsl:value-of select="@login" />
				</a>
			</li>
			<li>
				<a href="/users/logout/">
					Выйти
				</a>
			</li>
		</ul>
	</xsl:template>

	<xsl:template match="user[@type = 'guest']" mode="user_menu">
		<ul class="user_menu">
			<xsl:if test="not($method = 'auth')">
				<li class="user_button">
					<a href="/users/auth/">
						Войти
					</a>
				</li>
			</xsl:if>
			<xsl:if test="$method = 'auth'">
				<li class="user_button">
					<a href="/users/registrate/">
						Зарегистрироваться
					</a>
				</li>
			</xsl:if>
		</ul>
	</xsl:template>

	<xsl:template match="result[@module = 'content' and @method = 'notfound']">
		<xsl:apply-templates select="document('udata://content/sitemap')/udata" />
	</xsl:template>


	<xsl:template match="result[@module = 'content' and @method = 'sitemap']">
		<xsl:apply-templates select="document('udata://content/sitemap')/udata/items" />
	</xsl:template>



	<xsl:template match="udata[@method = 'sitemap']//items">
		<ul class="menu" umi:module='content' umi:method='menu' umi:element-id="0" umi:button-position="bottom left" umi:region="list" umi:sortable="sortable">
			<xsl:apply-templates select="item" />
		</ul>
	</xsl:template>

	<xsl:template match="udata[@method = 'sitemap']//item">
		<li umi:region="row">
			<a href="{@link}" umi:element-id="{@id}" umi:field-name="name" umi:delete="delete" umi:empty="Название страницы">
				<xsl:value-of select="@name" />
			</a>

			<xsl:apply-templates select="items" />
		</li>
	</xsl:template>
</xsl:stylesheet>