# File manager
 Un simple gestionnaire de fichier

Installation
Modifier le fichier htaccess et modifier le domaine à cette ligne : RewriteRule (.*) https://file.js-info.fr/$1 [R=301,L]
Modifier le fichier de configuration et changer la valeur de $root_path par le chemin du serveur jusqu'au dossier final

Modifier toute les valeurs de la fonction PHP array_slice dans les fichier du templates html, le numéro doit correspondre au nombre de dossier jusqu'au dossier personnel inclus (actuelement la valeur est : 10)
Modifier toute les valeurs du 2ème paramètre de FileSystems::getSliceDirs, le numéro doit correspondre au nombre de dossier jusqu'au dossier personnel inclus (actuelement la valeur est : 10)
