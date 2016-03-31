<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : timetableDays.xsl
    Created on : March 31, 2016, 1:38 PM
    Author     : Marisa Doig
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="/">
        <h1>Timetable by Days</h1>
        <table>
            <xsl:call-template name='headings'/>
            <xsl:call-template name='cells'/>
        </table>
    </xsl:template>
    
    <xsl:template name='headings'>
        <thead>
            <tr>
                <th></th>
                <xsl:for-each select='/timetable/days/day'>
                    <th>
                        <xsl:value-of select='./@which'/>
                    </th>
                </xsl:for-each>
            </tr>
        </thead>        
    </xsl:template>
    
    <xsl:template name='cells'>            
        <xsl:for-each select='/timetable/periods/period'>
            <xsl:variable name='currentPeriod' select='./@which'/>
            <tr>
                <td>
                    <xsl:value-of select='$currentPeriod'/>
                </td>
                <xsl:for-each select='/timetable/days/day'>
                    <td>
                        <xsl:for-each select='./dayslot'>
                            <xsl:if test='./@period = $currentPeriod'>
                                <xsl:value-of select='./@course'/>
                                <br/>
                                <xsl:value-of select='./type'/>
                                <br/>
                                <xsl:value-of select='./instructor'/>
                                <br/>
                                <xsl:value-of select='./room'/>
                                <br/>
                            </xsl:if>
                        </xsl:for-each>
                    </td>              
                </xsl:for-each> 
            </tr> 
        </xsl:for-each>               
    </xsl:template>

</xsl:stylesheet>
