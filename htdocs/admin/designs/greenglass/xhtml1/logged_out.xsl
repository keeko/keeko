<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
	version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns="http://www.w3.org/1999/xhtml">

	<xsl:import href="header.xsl"/>

	<xsl:output 
		method="xml"
		encoding="utf-8"
		indent="yes"
		doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
		doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
		cdata-section-elements=""/>

	<xsl:template match="/">
		<xsl:apply-templates select="/keeko/page"/>
	</xsl:template>
	
	<xsl:template match="page">
		<html>
			<head>
				<title>Keeko Administration</title>
				<xsl:call-template name="htmlHeaders"/>
			</head>
			<body>
				<xsl:call-template name="pageHeader"/>
				<div id="content">
					<xsl:apply-templates select="//block[@name = 'content']/action"/>
				</div>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
