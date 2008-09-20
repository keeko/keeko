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
				<xsl:if test="/keeko/settings/mode = 'window'">
					<link type="text/css" rel="stylesheet" href="admin/designs/greenglass/xhtml1/window.css"/>
				</xsl:if>
			</head>
			<body class="keeko">
				<xsl:if test="/keeko/settings/mode != 'window'">
					<xsl:call-template name="pageHeader"/>
					<div id="topbar">
						<ul id="menu">
							<xsl:apply-templates select="//block[@name = 'menu']"/>
						</ul>
					</div>
				</xsl:if>
				<div id="content">
					<xsl:apply-templates select="//block[@name = 'content']/action"/>
				</div>
				
				<xsl:if test="/keeko/settings/mode != 'window'">
					<div id="footer">
						<a href="{/keeko/settings/url}&amp;format=raw">RAW format</a> © 2008 creative2
					</div>
				</xsl:if>
			</body>
		</html>
	</xsl:template>
	
	<xsl:template match="block[@name = 'menu']">
		<xsl:call-template name="BuildMenu">
			<xsl:with-param name="parent" select="menu"/>
		</xsl:call-template>
	</xsl:template>

	<xsl:template name="BuildMenu">
		<xsl:param name="parent"/>
		
		<xsl:for-each select="$parent/items/item">
			<li>
				<xsl:variable name="module" select="module/@unixname"/>
				<xsl:variable name="action" select="action/@name"/>
				<xsl:variable name="extra" select="@extra"/>
				<xsl:variable name="text">
					<xsl:choose>
						<xsl:when test="$module and $action">
							<xsl:value-of select="/keeko/i18n/menu/item[@module=$module and @action=$action]"/>
						</xsl:when>
						<xsl:otherwise>
							<xsl:value-of select="/keeko/i18n/menu/item[@constant = $extra]"/>
						</xsl:otherwise>
					</xsl:choose>
				</xsl:variable>
				<xsl:variable name="hasItems" select="count(items/item) > 0"/>

				<xsl:if test="@parentId = '0'">
					<xsl:attribute name="class">top</xsl:attribute>
				</xsl:if>
				<a href="">
					<xsl:attribute name="class">
						<xsl:if test="@parentId = '0'">topLink </xsl:if>
						<xsl:if test="not(@parentId = '0') and $hasItems">fly </xsl:if>
					</xsl:attribute>
					<xsl:attribute name="href">
						<xsl:choose>
							<xsl:when test="$module and $action">
								<xsl:text>admin.php?module=</xsl:text>
								<xsl:value-of select="$module"/>
								<xsl:text>&amp;action=</xsl:text>
								<xsl:value-of select="$action"/>
							</xsl:when>
							<xsl:otherwise>#</xsl:otherwise>
						</xsl:choose>
					</xsl:attribute>
					<xsl:choose>
						<xsl:when test="@image != ''">
							<span style="background-image: url('{@image}');">
								<xsl:value-of select="$text"/>
							</span>
						</xsl:when>
						<xsl:otherwise><xsl:value-of select="$text"/></xsl:otherwise>
					</xsl:choose>
					
				<xsl:if test="$hasItems">	
					<xsl:comment><![CDATA[[if IE 7]><!]]></xsl:comment>
				</xsl:if>
				</a>
				<xsl:if test="$hasItems">	
					<xsl:comment><![CDATA[<![endif]]]></xsl:comment>
					<xsl:comment><![CDATA[[if lte IE 6]><table><tr><td><![endif]]]></xsl:comment>
					<ul class="sub">
						<xsl:call-template name="BuildMenu">
							<xsl:with-param name="parent" select="."/>
						</xsl:call-template>
					</ul>
					<xsl:comment><![CDATA[[if lte IE 6]></td></tr></table></a><![endif]]]></xsl:comment>
				</xsl:if>
			</li>
		</xsl:for-each>
	</xsl:template>

</xsl:stylesheet>
