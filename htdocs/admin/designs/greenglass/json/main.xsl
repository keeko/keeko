<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output
		method="text"/>
		
	<xsl:template match="/">
		<xsl:apply-templates select="//block[@name = 'content']/action"/>
	</xsl:template>
	
	<xsl:template name="jsonize">
		<xsl:param name="Root"/>
		
		<xsl:text>[</xsl:text>
		
		<xsl:if test="$Root/error">
			<xsl:text>{error:"</xsl:text>
			<xsl:value-of select="$Root/error/@code"/>
			<xsl:text>"}</xsl:text>
		</xsl:if>
		
		<xsl:if test="$Root/error and count($Root/json/*) &gt; 0">
			<xsl:text>,</xsl:text>
		</xsl:if>
		
		<xsl:if test="count($Root/json/*) &gt; 0">
			<xsl:call-template name="jsonizeObjects">
				<xsl:with-param name="Parent" select="$Root/json"/>
			</xsl:call-template>
		</xsl:if>
		
		<xsl:text>]</xsl:text>
	</xsl:template>
	
	<xsl:template name="jsonizeObjects">
		<xsl:param name="Parent"/>
		
		<xsl:for-each select="$Parent/*">
			<xsl:call-template name="jsonizeObject">
				<xsl:with-param name="Obj" select="."/>
			</xsl:call-template>
			
			<xsl:if test="position() != last()">
				<xsl:text>,</xsl:text>
			</xsl:if>
		</xsl:for-each>
	</xsl:template>
	
	<xsl:template name="jsonizeObject">
		<xsl:param name="Obj"/>
		
		<xsl:text>{</xsl:text>
			
			<xsl:for-each select="$Obj/@*">
				<xsl:value-of select="name(.)"/>
				<xsl:text>:"</xsl:text>
				<xsl:value-of select="."/>
				<xsl:text>"</xsl:text>
				
				<xsl:if test="position() != last()">
					<xsl:text>,</xsl:text>
				</xsl:if>
			</xsl:for-each>
			
			<xsl:if test="count($Obj/@*) &gt; 0 and count($Obj/*) &gt; 0">
				<xsl:text>,</xsl:text>
			</xsl:if>
			
			<xsl:for-each select="$Obj/*">
				<xsl:value-of select="name(.)"/>
				<xsl:text>:</xsl:text>
				<xsl:call-template name="jsonizeObject">
					<xsl:with-param name="Obj" select="."/>
				</xsl:call-template>

				<xsl:if test="position() != last()">
					<xsl:text>,</xsl:text>
				</xsl:if>
			</xsl:for-each>
			
		<xsl:text>}</xsl:text>
	</xsl:template>
</xsl:stylesheet>
