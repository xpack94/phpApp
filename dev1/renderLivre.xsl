<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    exclude-result-prefixes="xs"
    version="1.0">
   
   <!-- fichier pour visualiser les informations de tout les livres 
        comme leurs informations personnels et les informations des 
        auteurs des livres
   -->
   
    <xsl:template match="text/text()" name="tokenize">
        <xsl:param name="text" select="."/>
        <xsl:param name="separator" select="' '"/>
        <xsl:choose>
            <xsl:when test="not(contains($text, $separator))">
                    <xsl:variable name="auteur_id" select="normalize-space($text)"/>
                <div xmlns="http://www.w3.org/1999/xhtml" class="auteurs">
                    
                    <!-- chercher les informations de l'auteur -->
                    <xsl:for-each select="../auteur">
                        <xsl:if test="./@ident = $auteur_id" >
                            <img width="100" height="100" src="{photo}" class="auteur_image"/>
                            <div class="auteur_info">
                            <p>nom:<xsl:value-of select="nom"/></p> 
                            <p>prenom:<xsl:value-of select="prenom"/></p>
                            <p>pays:<xsl:value-of select="pays"/></p> 
                            <xsl:if test="commentaire != '' ">
                                <p>commentaire:<xsl:value-of select="commentaire"/></p>
                            </xsl:if>
                           
                            </div>
                        </xsl:if>
                        
                        
                    
                    </xsl:for-each>
                </div>    
                
            </xsl:when>
            <xsl:otherwise>
                
                    <xsl:variable name="auteur_id" select="normalize-space(substring-before($text, $separator))"/>
                <div xmlns="http://www.w3.org/1999/xhtml" class="auteurs">
                    <!-- chercher les informations de l'auteur -->
                    <xsl:for-each select="../auteur">
                        <xsl:if test="./@ident = $auteur_id" >
                            <img width="100" height="100" src="{photo}" class="auteur_image"/>
                            <div class="auteur_info">
                            <p>nom:<xsl:value-of select="nom"/></p> 
                            <p>prenom:<xsl:value-of select="prenom"/></p>
                            <p>pays:<xsl:value-of select="pays"/></p> 
                            <xsl:if test="commentaire != '' ">
                                <p>commentaire:<xsl:value-of select="commentaire"/></p>
                            </xsl:if>
                           
                            </div>
                        </xsl:if>
                    </xsl:for-each>
                   </div>
                
                <xsl:call-template name="tokenize">
                    <xsl:with-param name="text" select="substring-after($text, $separator)"/>
                </xsl:call-template>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>
   
   
   
    <xsl:template match="/">
        <xsl:param name="separator" select="' '"/>
        <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <title>
                        livre
                    </title>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
                    <link rel="stylesheet" href="livre.css" />
                </head>
                <body>
                   <div class="container">
                      
                      
                       <xsl:for-each select="//livre">
                           <xsl:sort select="./@auteur"  order="descending" />
                           <h1 class="book"></h1>
                             <div class="book_container">
                               <div class="row">
                                   <div class="col-md-5 col-lg-5">
                                        <xsl:if test="couverture !=''">
                                            <img width="275" height="275" src="{couverture}" class="cover"/>
                                        </xsl:if>
                                   </div>
                               <div class="col-lg-7 col-md-7">
                                    <p>titre du livre: <xsl:value-of select="titre"/></p>
                                    
                                    
                                    <p>année :<xsl:value-of select="annee"/></p>
                                    <p> prix:<xsl:value-of select="prix"/></p>
                                   
                                    
                                    <xsl:if test="commentaire !=''">
                                        <p> <xsl:value-of select="commentaire"/></p>   
                                    </xsl:if>
                               </div>
                               </div>
                             
                          
                           
                               <!-- tester si le livre a un auteur-->
                               <xsl:if test="./@auteur !=''">
                                 
                                   <h2>auteurs du livre:</h2>
                                        <xsl:call-template name="tokenize">
                                            <xsl:with-param name="text" select="./@auteur"/>
                                        </xsl:call-template>
                                   
                                   
                               </xsl:if>
                               
                           
                           
                             </div>
                           
                           
                       </xsl:for-each>
                   </div>
                </body>
            </html>
        </xsl:template>
    
    
</xsl:stylesheet>