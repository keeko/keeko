<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
	version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns="http://www.w3.org/1999/xhtml">

	<!-- <xsl:template match="/">
		<xsl:call-template name="Webform">
			<xsl:with-param name="form" select="webform"/>
		</xsl:call-template>
	</xsl:template>-->
	
	<xsl:template name="Webform">
		<xsl:param name="form"/>
		
		<form action="{$form/@target}" method="{$form/@method}" id="{$form/@id}">
			<xsl:for-each select="$form/area">
				<xsl:call-template name="WebformArea">
					<xsl:with-param name="area" select="."/>
				</xsl:call-template>
			</xsl:for-each>
		</form>
	</xsl:template>
	
	<xsl:template name="WebformArea">
		<xsl:param name="area"/>
		
		<fieldset>
			<xsl:if test="$area/@label != ''">
				<legend id="{$area/@id}"><xsl:value-of select="$area/@label"/></legend>
			</xsl:if>
			
			<xsl:for-each select="$area/control">
				<xsl:call-template name="WebformControl">
					<xsl:with-param name="control" select="."/>
				</xsl:call-template>
			</xsl:for-each>
		</fieldset>

	</xsl:template>

	<xsl:template name="WebformControl">
		<xsl:param name="control"/>

		<xsl:choose>
			<xsl:when test="$control/@type = 'SingleLine'">
				<label>
					<xsl:value-of select="$control/@label"/>
					<xsl:if test="$control/@description != ''">
						<p><xsl:value-of select="$control/@description"/></p>
					</xsl:if>

					<input type="text" value="{$control/@value}" name="{$control/@name}" id="{$control/@id}">
						<xsl:if test="$control/@disabled = 'yes'">
							<xsl:attribute name="disabled">disabled</xsl:attribute>
						</xsl:if>
					</input>
				</label>
			</xsl:when>

			<xsl:when test="$control/@type = 'Password'">
				<label>
					<xsl:value-of select="$control/@label"/>
					<xsl:if test="$control/@description != ''">
						<p><xsl:value-of select="$control/@description"/></p>
					</xsl:if>

					<input type="password" value="{$control/@value}" name="{$control/@name}" id="{$control/@id}">
						<xsl:if test="$control/@disabled = 'yes'">
							<xsl:attribute name="disabled">disabled</xsl:attribute>
						</xsl:if>
					</input>
				</label>
			</xsl:when>
			
			<xsl:when test="$control/@type = 'Hidden'">
				<input type="hidden" value="{$control/@value}" name="{$control/@name}" id="{$control/@id}"/>
			</xsl:when>
			
			<xsl:when test="$control/@type = 'Radio'">
				<label>
					<input type="radio" value="{$control/@value}" name="{$control/@name}" id="{$control/@id}">
						<xsl:if test="$control/@checked = 'yes'">
							<xsl:attribute name="checked">checked</xsl:attribute>
						</xsl:if>
						<xsl:if test="$control/@disabled = 'yes'">
							<xsl:attribute name="disabled">disabled</xsl:attribute>
						</xsl:if>
					</input>
					<xsl:value-of select="$control/@label"/>
				</label>
			</xsl:when>
			
			<xsl:when test="$control/@type = 'CheckBox'">
				<label>
					<input type="checkbox" value="{$control/@value}" name="{$control/@name}" id="{$control/@id}">
						<xsl:if test="$control/@checked = 'yes'">
							<xsl:attribute name="checked">checked</xsl:attribute>
						</xsl:if>
						<xsl:if test="$control/@disabled = 'yes'">
							<xsl:attribute name="disabled">disabled</xsl:attribute>
						</xsl:if>
					</input>
					<xsl:value-of select="$control/@label"/>
				</label>
			</xsl:when>

			<xsl:when test="$control/@type = 'MultiLine'">
				<label>
					<xsl:value-of select="$control/@label"/>
					<xsl:if test="$control/@description != ''">
						<p><xsl:value-of select="$control/@description"/></p>
					</xsl:if>

					<textarea value="{$control/@value}" name="{$control/@name}" id="{$control/@id}">
						<xsl:if test="$control/@disabled = 'yes'">
							<xsl:attribute name="disabled">disabled</xsl:attribute>
						</xsl:if>
						<xsl:value-of select="$control/@default"/>
						<xsl:comment></xsl:comment>
					</textarea>
				</label>
			</xsl:when>

			<xsl:when test="$control/@type = 'Group'">
				<label>
					<xsl:value-of select="$control/@label"/>
					<xsl:if test="$control/@description != ''">
						<p><xsl:value-of select="$control/@description"/></p>
					</xsl:if>
				</label>

				<ul class="group group{$control/@direction}">
					<xsl:for-each select="$control/control">
						<li>
							<xsl:call-template name="WebformControl">
								<xsl:with-param name="control" select="."/>
							</xsl:call-template>
						</li>
					</xsl:for-each>
				</ul>
			</xsl:when>
			
			<xsl:when test="$control/@type = 'ComboBox'">
				<label>
					<xsl:value-of select="$control/@label"/>
					<xsl:if test="$control/@description != ''">
						<p><xsl:value-of select="$control/@description"/></p>
					</xsl:if>
					<select name="{$control/@name}" id="{$control/@id}">
						<xsl:if test="$control/@disabled = 'yes'">
							<xsl:attribute name="disabled">disabled</xsl:attribute>
						</xsl:if>
						<xsl:for-each select="$control/option">
							<option value="{@value}">
								<xsl:if test="@checked = 'yes'">						
									<xsl:attribute name="selected">selected</xsl:attribute>
								</xsl:if>
								<xsl:value-of select="@label"/>
							</option>
						</xsl:for-each>
					</select>
				</label>
			</xsl:when>

			<xsl:when test="$control/@type = 'Submit'">
				<input type="submit" value="{$control/@value}" name="{$control/@name}" id="{$control/@id}">
					<xsl:if test="$control/@disabled = 'yes'">
						<xsl:attribute name="disabled">disabled</xsl:attribute>
					</xsl:if>
				</input>
			</xsl:when>

			<xsl:when test="$control/@type = 'Reset'">
				<input type="reset" value="{$control/@value}" name="{$control/@name}" id="{$control/@id}">
					<xsl:if test="$control/@disabled = 'yes'">
						<xsl:attribute name="disabled">disabled</xsl:attribute>
					</xsl:if>
				</input>
			</xsl:when>
		</xsl:choose>

	</xsl:template>
</xsl:stylesheet>
