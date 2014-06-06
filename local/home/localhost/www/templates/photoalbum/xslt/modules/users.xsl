<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet	version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="result[@module = 'users' and @method = 'registrate']">
		<div class="container">
			<xsl:apply-templates select="document('udata://system/listErrorMessages')/items"/>
			<form action="/users/registrate_do/" method="post" class="shadow">
				<h3>Зарегистрируйтесь</h3>
				<div class="field">
					<label for="login">Логин:</label>
					<input type="text" name="login"/>
				</div>
				<div class="field">
					<label for="password">Пароль:</label>
					<input type="password" name="password"/>
				</div>
				<div class="field">
					<label for="password_confirm">Повторите пароль:</label>
					<input type="password" name="password_confirm"/>
				</div>
				<div class="field">
					<label for="email">E-mail:</label>
					<input type="text" name="email"/>
				</div>
				<div class="field">
					<label for="fname">Имя:</label>
					<input type="text" name="data[new][fname]"/>
				</div>
				<div class="field">
					<label for="lname">Фамилия:</label>
					<input type="text" name="data[new][lname]"/>
				</div>
				<xsl:apply-templates select="document('udata://system/captcha')/udata" />
				<div class="button">
					<input type="submit" class="button" value="Зарегистрироваться"/>
				</div>
			</form>
		</div>
	</xsl:template>

	<xsl:template match="udata[@method='captcha']">
		<div id="box_{@name}" class="input_box captcha">
			<div class="captcha"><img src="{url}{@random_string}"/></div>
			<label for="captcha">
				Введите код с картинки
			</label>
			<input name="captcha" class="captcha" type="text"/>
		</div>
	</xsl:template>


	<xsl:template match="result[@module = 'users' and @method = 'login']">
		<xsl:apply-templates select="document('udata://users/auth/')/udata" />
	</xsl:template>

	<xsl:template match="result[@module = 'users' and @method = 'auth']">
		<xsl:apply-templates select="document('udata://users/auth/')/udata" />
		<xsl:if test="$user/@status = 'auth'">
			<script>
				location.href = 'http://localhost/users/profile/';
			</script>
		</xsl:if>
	</xsl:template>

	<xsl:template match="udata[@module = 'users' and @method = 'auth']">
		<form method="post" action="/users/login_do/" class="shadow">
			<p>
				<xsl:text>Логин: </xsl:text>
				<input type="text" name="login" id="login" />
			</p>
			<p>
				<xsl:text>Пароль: </xsl:text>
				<input type="password" name="password" id="password" />
			</p>
			<p>
				<input type="submit" value="Войти" />
			</p>
		</form>
	</xsl:template>

	<xsl:template match="result[@module = 'users' and @method = 'profile']">
		<div class="container shadow">
			<div class="users">
				<div class="user">
					<div class="info">
						<div class="name"><a href="#"><xsl:value-of select="document(concat('uobject://', udata/id))//property[@name = 'fname']/value"/><xsl:text> </xsl:text><xsl:value-of select="document(concat('uobject://', udata/id))//property[@name = 'lname']/value"/></a></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="sep"></div>
			<div class="popup-gallery">
				<xsl:apply-templates select="document(concat('ufs://images/users/user',udata/id))//file[@ext = 'jpg' or @ext = 'jpeg' or @ext = 'png']" mode="popup-gallery">
					<xsl:with-param name="dir" select="concat('/images/users/user',udata/id,'/')"/>
				</xsl:apply-templates>
			</div>
		</div>
		<xsl:if test="udata/id = $user/@id">
			<div class="container shadow">
				<form action="/content/loadfile/" method="post" enctype="multipart/form-data">
					<label for="file">Выберите файл:</label>
					<input type="file" name="file" id="file"/>
					<input type="hidden" name="user_id" value="{udata/id}"/>
					<input type="submit" name="submit" value="Загрузить фотографию"/>
				</form>
			</div>
		</xsl:if>
	</xsl:template>

	<xsl:template match="result[(@module = 'content' and @method = 'loadfile') or (@module = 'users' and @method = 'registrate_done')]">
		<script>
			location.href = 'http://localhost/users/profile/';
		</script>
	</xsl:template>

	<xsl:template match="file" mode="popup-gallery">
		<xsl:param name="dir"></xsl:param>
		<xsl:variable name="path" select="concat($dir,@name)"></xsl:variable>
		<xsl:variable name="tmb" select="document(concat('udata://system/makeThumbnailFull/(.',$path,')/87/87/notemplate/0/1'))//src"></xsl:variable>
		<a href="{$path}" title="">
			<img src="{$tmb}" width="87" height="87"/>
		</a>
	</xsl:template>

	<xsl:template match="result[@module = 'users' and @method = 'login_do']">
		<xsl:if test="$user/@status = 'auth'">
			<script>
				location.href = 'http://localhost/users/profile/';
			</script>
		</xsl:if>
		<div class="container">
			<p align="center">
				Судя по всему произошла ошибка! Пожалуйста, попробуйте повторно пройти авторизацию.
			</p>
			
		</div>
		<form method="post" action="/users/login_do/" class="shadow">
			<p>
				<xsl:text>Логин: </xsl:text>
				<input type="text" name="login" id="login" />
			</p>
			<p>
				<xsl:text>Пароль: </xsl:text>
				<input type="password" name="password" id="password" />
			</p>
			<p>
				<input type="submit" value="Войти" />
			</p>
		</form>
	</xsl:template>

</xsl:stylesheet>