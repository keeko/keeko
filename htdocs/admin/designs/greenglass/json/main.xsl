<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output
		method="text"/>
		
	<xsl:template match="/">
		<xsl:apply-templates select="//block[@name = 'content']/action"/>
	</xsl:template>
</xsl:stylesheet>
