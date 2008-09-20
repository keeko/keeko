<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
	version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns="http://www.w3.org/1999/xhtml">

	<xsl:template match="/">
		<xsl:call-template name="Wizard">
			<xsl:with-param name="wizard" select="wizard"/>
		</xsl:call-template>
	</xsl:template>

	<xsl:template name="Wizard">
		<xsl:param name="wizard"/>
		
		<div id="wizardHead">
			<h1><xsl:value-of select="$wizard/@title"/></h1>
			<p id="wizardDescription"><xsl:value-of select="$wizard/@description"/></p>
		
			<form action="{$wizard/webform/@target}" method="{$wizard/webform/@method}">
				<xsl:choose>
					<xsl:when test="$wizard/webform/errors">
						errors
						<ul>
							<xsl:for-each select="$wizard/webform/errors">
								<li><xsl:value-of select="error"/></li>
							</xsl:for-each>
						</ul>
					</xsl:when>
					<xsl:otherwise>
						<xsl:call-template name="WizardStep">
							<xsl:with-param name="step" select="$wizard/webform/step[@active = 'yes']"/>
						</xsl:call-template>
					</xsl:otherwise>
				</xsl:choose>
				
				<xsl:call-template name="WebformArea">
					<xsl:with-param name="area" select="$wizard/webform/area[@id = 'wizardButtonBar']"/>
				</xsl:call-template>
			</form>
		</div>
	</xsl:template>
	
	<xsl:template name="WizardStep">
		<xsl:param name="step"/>
		
		<xsl:call-template name="WebformArea">
			<xsl:with-param name="area" select="$step/area"/>
		</xsl:call-template>
	</xsl:template>
</xsl:stylesheet>
