<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xs="http://www.w3.org/2001/XMLSchema" exclude-result-prefixes="xs" version="2.0">
    
    <!--  fichier pour visualiser les informations associées à tous les auteurs les informations des livres 
        qu'ils ont écrit affichés en ordre croissant de leur prix) ou à un seul auteur dont le nom sera passé 
        comme valeur du paramètre auteur.--> 
    
    <xsl:param name="auteur" select="'all'"/>
    <xsl:template match="/bibliotheque">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <title> Classement des auteurs et du prix de leurs livre </title>              
                <meta charset="UTF-8"/>
                <link rel="stylesheet" type="text/css" href="styl.css"/>
            </head>
            <body class="centrer">
                <div>
                    <h1> Auteurs à succées et leurs principales oeuvres</h1>
                    <h3> Classement des autres par prix des oeuvres</h3>
                </div>
                <xsl:choose>
                    <xsl:when test="$auteur ='all'">
                        <xsl:for-each select="//auteur">
                            <xsl:sort order="ascending" select="prix/value"></xsl:sort>
                            
                            <div>
                                <br/>
                                <h2 class="para">Information personnelles de l'auteur</h2>                               
                                <h3 class = "enonce">Nom de l'auteur:</h3>
                                <p> <xsl:value-of select="nom"/> </p>                              
                                <h3 class = "enonce">Prenom de l'auteur:</h3>
                                <p> <xsl:value-of select="prenom"/> </p>                              
                                <h3 class = "enonce">Pays de l'auteur:</h3>
                                <p><xsl:value-of select="pays"/></p>
                                
                                <xsl:if test="commentaire">
                                    <h3 class = "enonce">commentraie à propos de l'auteur:</h3>
                                    <p><xsl:value-of select="commentaire"/></p>
                                </xsl:if>
                                
                                <h3 class = "enonce"> Livres ecrit par l'auteur :  </h3>
                                <xsl:call-template name="auteure">
                                    <xsl:with-param name="auteur_spec" select="@ident"/>
                                </xsl:call-template>
                                  
                                    <h3 class = "enonce">Photo de l'auteur</h3>
                                    <img>
                                        <xsl:attribute name="src">
                                            <xsl:value-of select="photo"/>
                                        </xsl:attribute>
                                    </img>                               
                            </div>
                        </xsl:for-each>
                    </xsl:when>
                    
                    <xsl:otherwise>
                        <xsl:for-each select="//auteur">
                            <xsl:if test="@ident=$auteur">
                                <div>
                                    <h2>Information personnelles de l'auteur</h2>
                                    
                                    <h3>Nom de l'auteur:</h3>
                                    <p> <xsl:value-of select="nom"/> </p>
                                    
                                    <h3>Prenom de l'auteur:</h3>
                                    <p> <xsl:value-of select="prenom"/> </p>
                                    
                                    <h3>Pays de l'auteur:</h3>
                                    <p><xsl:value-of select="pays"/></p>
                                    
                                    <xsl:if test="commentaire">
                                        <h3>commentraie à propos de l'auteur:</h3>
                                        <p><xsl:value-of select="commentaire"/></p>
                                    </xsl:if>

                                    <h3> Livres ecrit par l'auteur :  </h3>
                                    <xsl:call-template name="auteure">
                                        <xsl:with-param name="auteur_spec" select="@ident"/>
                                    </xsl:call-template>

                                        <h3>Photo de l'auteur</h3>
                                        <img>
                                            <xsl:attribute name="src">
                                                <xsl:value-of select="photo"/>
                                            </xsl:attribute>
                                        </img>
                                </div>
                            </xsl:if>
                        </xsl:for-each>
                    </xsl:otherwise>
                    
                </xsl:choose>
            </body>
        </html>
    </xsl:template>
    
    
    
    
    <xsl:template name="auteure">
        <xsl:param name="auteur_spec"/>
        <xsl:for-each select="//livre">
            <!-- On classe les livres en ordre croissant de prix -->
            <xsl:sort select="prix" data-type="number" />
            <p>
                <xsl:variable name="Livrechoisit">
                    
                    -Titre du livre :
                    <xsl:value-of select="titre"/>
                    .----Année du livre :
                    <xsl:value-of select="annee"/>
                    .----Prix du livre :
                    <xsl:value-of select="prix"/>
                    <!-- pour la selection de l'attribut de l'element valeur-->
                    <xsl:value-of select="valeur/@monnaie"/>
                    .----Langue du livre : 
                    <xsl:value-of select="@Langue"/>
                    
                </xsl:variable>
                
                <xsl:if test="contains(@auteur, $auteur_spec)">
                    <h2>
                        <xsl:value-of select="$Livrechoisit"/>
                    </h2>
                    
                </xsl:if>
            </p>
        </xsl:for-each>
    </xsl:template>
    
</xsl:stylesheet>


