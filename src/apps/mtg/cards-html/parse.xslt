<?xml version="1.0" encoding="utf-8" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fn="urn:http://www.w3.org/2005/02/xpath-functions" version='1.0'> 
	<xsl:output method="text" media-type="text/javascript" />
	<xsl:strip-space elements="*"/>	
	<xsl:template match='/'>
		<xsl:choose>
			<xsl:when test='//table[@class="cardItemTable"]/tr'>
				<xsl:apply-templates select='//table[@class="cardItemTable"]'></xsl:apply-templates>
			</xsl:when>
			<xsl:otherwise>
				<xsl:apply-templates select='//table[@class="cardDetails"]'></xsl:apply-templates>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	
	<xsl:template match='//table[@class="cardDetails"]'>
		<xsl:text>{</xsl:text>
		<xsl:apply-templates select="tr/td/div/div[@class='row']"/>
		<xsl:text>"Url":"","tappo":"EOF"}</xsl:text>
	</xsl:template>
	
	<xsl:template match='//table[@class="cardItemTable"]'>
		<xsl:text>[</xsl:text>
		<xsl:for-each select="tr/td/table/tr/td/div[@class='cardInfo']">
			<xsl:text>{"CardName":"</xsl:text>
			<xsl:call-template name="escape">
				<xsl:with-param name="text" select='span[@class="cardTitle"]/a'/>
			</xsl:call-template>
			<xsl:text>","Types":"</xsl:text>
			<xsl:call-template name="escape">
				<xsl:with-param name="text" select='span[@class="typeLine"]'/>
			</xsl:call-template>
			<xsl:text>","CardText":"</xsl:text>
			<xsl:call-template name="escape">
				<xsl:with-param name="text" select='div[@class="rulesText"]'/>
			</xsl:call-template>
			<xsl:text>","FlavorText":"","Artist":"", "Url":"http://gatherer.wizards.com/Pages/Search/</xsl:text>
			<xsl:call-template name="break">
				<xsl:with-param name="text" select='span[@class="cardTitle"]/a/@href'/>
			</xsl:call-template><xsl:text>","tappo":"EOF"},</xsl:text>
		</xsl:for-each>
		<xsl:text>{"tappo":"EOF"}]</xsl:text>
	</xsl:template>
	
	
	<xsl:template match="tr/td/div/div[@class='row']">
		<xsl:variable name="lbl"><xsl:call-template name="escapeName"><xsl:with-param name="text" select='div[@class="label"]'/></xsl:call-template></xsl:variable>
		<xsl:choose>
			<xsl:when test="$lbl='CardText'">
				<xsl:text>"</xsl:text><xsl:value-of select="$lbl"/><xsl:text>":"</xsl:text>
				<xsl:choose>
					<xsl:when test="div[@class='value']/div[@class='cardtextbox']">
						<xsl:for-each select="div[@class='value']/div[@class='cardtextbox']">
							<xsl:call-template name="escape"><xsl:with-param name="text" select='normalize-space(.)'/></xsl:call-template><xsl:text>; </xsl:text>  
						</xsl:for-each>
					</xsl:when>
					<xsl:otherwise>
						<xsl:call-template name="escape"><xsl:with-param name="text" select="div[@class='value']"/></xsl:call-template>
					</xsl:otherwise>
				</xsl:choose>
				<xsl:text>","CardScript":"</xsl:text>
				<xsl:choose>
					<xsl:when test="div[@class='value']/div[@class='cardtextbox']">
						<xsl:for-each select="div[@class='value']/div[@class='cardtextbox']">
							<xsl:text>@[</xsl:text>
							<xsl:call-template name="escape"><xsl:with-param name="text" select='normalize-space(.)'/></xsl:call-template>
							<xsl:text>], </xsl:text> 
						</xsl:for-each>
					</xsl:when>
					<xsl:otherwise>
						<xsl:text>@[</xsl:text>
						<xsl:call-template name="escape"><xsl:with-param name="text" select="div[@class='value']"/></xsl:call-template>
						<xsl:text>]</xsl:text>
					</xsl:otherwise>
				</xsl:choose>
			</xsl:when>
			<xsl:otherwise>
			<xsl:text>"</xsl:text><xsl:value-of select="$lbl"/><xsl:text>":"</xsl:text>
			<xsl:call-template name="escape"><xsl:with-param name="text" select="div[@class='value']"/></xsl:call-template>
			</xsl:otherwise>
		</xsl:choose>
		<xsl:text>", </xsl:text>
	</xsl:template>
	
	<xsl:template name="break"><xsl:param name="text" select="."/><xsl:choose><xsl:when test='contains($text, "&#xa;")'><xsl:call-template name="break"><xsl:with-param name="text" select='substring-after($text, "&#xa;")'/></xsl:call-template></xsl:when><xsl:otherwise><xsl:value-of select="normalize-space($text)"/></xsl:otherwise></xsl:choose></xsl:template>
	
	<xsl:template name="escape">
		<xsl:param name="text"></xsl:param>		
		<xsl:variable name="textTemp" select="translate($text,'&quot;','')"/>
		<xsl:value-of select='normalize-space(translate(translate(normalize-space($textTemp),"#",""),"&apos;",""))'></xsl:value-of>
	</xsl:template>
	<xsl:template name="escapeName">
		<xsl:param name="text"/>		
		<xsl:variable name="textTemp" select="translate($text,'&quot;','')"/>
		<xsl:value-of select='normalize-space(translate(translate(translate(translate(normalize-space($textTemp)," ",""),"#",""),"&apos;",""),":",""))'></xsl:value-of>
	</xsl:template>
</xsl:stylesheet>