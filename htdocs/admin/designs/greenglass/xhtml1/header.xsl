<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
	version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns="http://www.w3.org/1999/xhtml">

	<xsl:template name="htmlHeaders">
		<link type="text/css" rel="stylesheet" href="admin/designs/greenglass/xhtml1/yui-reset.css"/>
		<link type="text/css" rel="stylesheet" href="admin/designs/greenglass/xhtml1/yui-fonts.css"/>
		<link type="text/css" rel="stylesheet" href="admin/designs/greenglass/xhtml1/admin.css"/>
		<xsl:comment><xsl:value-of select="/keeko/settings/mode"/></xsl:comment>
		<xsl:apply-templates select="head"/>
	</xsl:template>

	<xsl:template name="pageHeader">
		<div id="head">Keeko Administration</div>
	</xsl:template>
	
	<xsl:template match="head">
		<xsl:for-each select="*">
			<xsl:element name="{local-name()}">
				<xsl:copy-of select="@*"/>
				<xsl:choose>
		    		<xsl:when test="local-name() = 'script'">
		    			<xsl:comment><xsl:apply-templates/></xsl:comment>
		    		</xsl:when>
		    		<xsl:otherwise>
			    		<xsl:apply-templates/>
		    		</xsl:otherwise>
		    	</xsl:choose>
			</xsl:element>
		</xsl:for-each>
	</xsl:template>
</xsl:stylesheet>
