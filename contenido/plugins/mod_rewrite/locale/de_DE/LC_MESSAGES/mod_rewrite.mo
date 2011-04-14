��    %      D  5   l      @  j   A     �  E   �  E   �     ?  �  O     �          '  O   /  I     M   �  G        _     d  )   |  /   �  *   �  0        2     >      N  >   o  ?   �  F   �  �   5	  T   �	  S   )
  P   }
  ,   �
  �   �
  !   �     �                2  ,  K  {   x     �  k   �  F   f     �    �     �     �       O   
  O   Z  O   �  O   �     J  ,   R  8     -   �  8   �  -        M     Y      m  >   �  T   �  Z   "  �   }  _   L  _   �  _     /   l    �  "   �     �     �     �  (                     "                 	                $            
             !                         #                             %                                                 # enable apache mod rewrite module
RewriteEngine on

# disable apache mod rewrite module
RewriteEngine off Author Configuration could not saved. Please check write permissions for %s  Configuration has <b>not</b> been saved, because of enabled debugging Contenido forum Disabling of plugin does not result in disabling mod rewrite module of the web server - This means,<br /> all defined rules in the .htaccess are still active and could create unwanted side effects.<br /><br />Apache mod rewrite could be enabled/disabled by setting the RewriteEngine directive.<br />Any defined rewrite rules could remain in the .htaccess and they will not processed,<br />if the mod rewrite module is disabled E-Mail to author Enable Advanced Mod Rewrite Example Invalid separator for article words, allowed is one of following characters: %s Invalid separator for article, allowed is one of following characters: %s Invalid separator for category words, allowed one of following characters: %s Invalid separator for category, allowed one of following characters: %s Note Please check your input Please specify separator (%s) for article Please specify separator (%s) for article words Please specify separator (%s) for category Please specify separator (%s) for category words Plugin page Plugin settings Plugin thread in Contenido forum Separator for category and article words must not be identical Separator for category and category words must not be identical Separator for category-article and article words must not be identical The .htaccess file could not found either in Contenido installation directory nor in client directory.<br />It should set up in %sFunctions%s area, if needed. The article name has a invalid format, allowed are the chars /^[a-zA-Z0-9\-_\/\.]*$/ The file extension has a invalid format, allowed are the chars \.([a-zA-Z0-9\-_\/]) The root directory has a invalid format, alowed are the chars [a-zA-Z0-9\-_\/\.] The specified directory "%s" does not exists The specified directory "%s" does not exists in DOCUMENT_ROOT "%s". this could happen, if clients DOCUMENT_ROOT differs from Contenido backends DOCUMENT_ROOT. However, the setting will be taken over because of disabled check. Value has to be between 0 an 100. Value has to be numeric. Version Visit plugin page opens page in new window Project-Id-Version: Contenido Plugin Advanced Mod Rewrite
Report-Msgid-Bugs-To: 
POT-Creation-Date: 2011-04-14 02:03+0100
PO-Revision-Date: 2011-04-14 02:04+0100
Last-Translator: Murat Purc <murat@purc.de>
Language-Team: Murat Purc <murat@purc.de>
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
X-Poedit-Language: German
X-Poedit-Country: GERMANY
X-Poedit-Basepath: C:/dev/websites/contenido/src/
X-Poedit-KeywordsList: i18n
X-Poedit-SourceCharset: iso-8859-1
X-Poedit-SearchPath-0: contenido/plugins/mod_rewrite
 # aktivieren des apache mod rewrite moduls
RewriteEngine on

# deaktivieren des apache mod rewrite moduls
RewriteEngine off Autor Konfiguration konnte nicht gespeichert werden. &Uuml;berpr&uuml;fen Sie bitte die Schreibrechte f&uuml;r %s Konfiguration wurde <b>nicht</b> gespeichert, weil debugging aktiv ist Contenido Forum Beim Deaktivieren des Plugins wird das mod rewrite Modul des Webservers nicht mit deaktiviert - Das bedeutet, <br />dass alle in der .htaccess definerten Regeln weiterhin aktiv sind und einen unerw&uuml;nschten Nebeneffekt haben k&ouml;nnen.<br /><br />Apache mod rewrite l&auml;sst sich in der .htaccess durch das Setzen der RewriteEngine-Direktive aktivieren/deaktivieren.<br />Wird das mod rewrite Modul deaktiviert, k&ouml;nnen die in der .htaccess definierten Regeln weiterhin bleiben, sie werden <br />dann nicht verarbeitet. E-Mail an Autor Advanced Mod Rewrite aktivieren Beispiel Trenner f&uuml;r Kategorie ist ung&uuml;ltig, erlaubt ist eines der Zeichen: %s Trenner f&uuml;r Kategorie ist ung&uuml;ltig, erlaubt ist eines der Zeichen: %s Trenner f&uuml;r Kategorie ist ung&uuml;ltig, erlaubt ist eines der Zeichen: %s Trenner f&uuml;r Kategorie ist ung&uuml;ltig, erlaubt ist eines der Zeichen: %s Hinweis Bitte &uuml;berpr&uuml;fen Sie ihre Eingaben Bitte Trenner (%s) f&uuml;r Kategoriew&ouml;rter angeben Bitte Trenner (%s) f&uuml;r Kategorie angeben Bitte Trenner (%s) f&uuml;r Kategoriew&ouml;rter angeben Bitte Trenner (%s) f&uuml;r Kategorie angeben Pluginseite Plugineinstellungen Pluginbeitrag im Contenido Forum Separator for category and article words must not be identical Trenner f&uuml;r Kategorie und Kategoriew&ouml;rter d&uuml;rfen nicht identisch sein Trenner f&uuml;r Kategorie-Artikel und Artikelw&ouml;rter d&uuml;rfen nicht identisch sein Es wurde weder im Contenido Installationsverzeichnis noch im Mandantenverzeichnis eine .htaccess Datei gefunden.<br />Die .htaccess Datei sollte gegebenenfalls im Bereich %sFunktionen%s eingerichtet werden. Das Rootverzeichnis hat ein ung&uuml;ltiges Format, erlaubt sind die Zeichen [a-zA-Z0-9\-_\/\.] Das Rootverzeichnis hat ein ung&uuml;ltiges Format, erlaubt sind die Zeichen [a-zA-Z0-9\-_\/\.] Das Rootverzeichnis hat ein ung&uuml;ltiges Format, erlaubt sind die Zeichen [a-zA-Z0-9\-_\/\.] Das angegebene Verzeichnis "%s" existiert nicht Das angegebene Verzeichnis "%s" existiert nicht im DOCUMENT_ROOT "%s". Das kann vorkommen, wenn das DOCUMENT_ROOT des Mandanten vom Contenido Backend DOCUMENT_ROOT abweicht. Die Einstellung wird dennoch &uuml;bernommen, da die &Uuml;berpr&uuml;fung abgeschaltet wurde. Wert muss zwischen 0 und 100 sein. Wert muss numerisch sein. Version Pluginseite besuchen &ouml;ffnet Seite in einem neuen Fenster 