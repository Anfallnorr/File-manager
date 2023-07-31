# File manager
<h1> Un simple gestionnaire de fichier</h1>

<h2>Prérequis</h2>
<p>PHP 8.1 ou supérieur</p>

<h2>Installation</h2>
<p>Modifier le fichier htaccess et modifier le domaine à cette ligne : RewriteRule (.*) https://file.js-info.fr/$1 [R=301,L]</p>
<p>Modifier le fichier de configuration et changer la valeur de $root_path par le chemin du serveur jusqu'au dossier final</p>
<br />
<p>Modifier toute les valeurs de la fonction PHP array_slice dans les fichier du templates html, le numéro doit correspondre au nombre de dossier jusqu'au dossier personnel inclus (actuelement la valeur est : 10)</p>
<p>Modifier toute les valeurs du 2ème paramètre de FileSystems::getSliceDirs, le numéro doit correspondre au nombre de dossier jusqu'au dossier personnel inclus (actuelement la valeur est : 10)</p>
