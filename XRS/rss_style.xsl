<?xml version="1.0" encoding="ISO-8859-1"?>
	<xsl:stylesheet version="1.0" 
     xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
     xmlns:dc="http://purl.org/dc/elements/1.1/">
	<xsl:output method="html" version="4" encoding="iso-8859-1" indent="yes" />
	<xsl:template match="channel">
    <html>
       	<head>
        	<title><xsl:value-of select="title" /> - <xsl:value-of select="description" /></title>
<style type="text/css">
body {
    font-family:"Trebuchet MS",Verdana,Arial,Helvetica,sans-serif;
    font-size:10pt; 
    }

td {
    font-family:"Trebuchet MS",Verdana,Arial,Helvetica,sans-serif;
    font-size:10pt; 
    border: solid 1px rgb(200,200,200); 
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 6px;
    padding-bottom: 6px;
    }
    
</style>
        	<meta http-equiv="refresh" content="3600" />
       	</head>
       	<body>
        <div align="center">
        	<br />
					<table width="80%">
            <tr>
            	<td align="center" style="border: none !important;">
                <a href="{link}"><big><big><b><xsl:value-of select="title" /></b></big></big></a><br />
              	<a href="{image/link}" target="_blank"><img src="{image/url}" alt="{image/title}" title="{description}" border="0" width="{image/width}" height="{image/height}" /></a>
            	</td>
            	
            	<td style="border: none !important">
            	<b><big><xsl:value-of select="description" /></big></b><br/>
            	<br />
            	<a href="http://validator.w3.org/feed/check.cgi?url=http://www.pixtiz.com/fluxrss.xml"><img src="http://www.pixtiz.com/images/favicon.png" alt="[Valid RSS]" title="Validate my RSS feed" width="16" height="16" /></a><br />
            	Cette page est au format RSS 2.0. <br />
            	Elle est conçue pour être lue par des aggrégateurs de flux RSS.<br />
            	<br /> 
            	</td>
          	</tr>
			<xsl:call-template name="item" />
			</table>      
       	</div>
       	<hr />
    </body>
    </html>
	</xsl:template>

	<xsl:template match="item" name="item">
		<xsl:for-each select="item">
		<tr>
		<td colspan="2">
			<a href="{link}" target="_blank"><b><xsl:value-of select="title" /></b></a>
	    <br />
	    <xsl:value-of select="description" />

	    </td>
	    </tr>
		</xsl:for-each>
	</xsl:template>
</xsl:stylesheet>
