# File manager
<p>Un simple gestionnaire de fichiers</p>
<h3>Prérequis :</h3>
<ol>
<li>PHP 8.1 ou version supérieure</li>
</ol>
<h3>Installation :</h3>
<ol>
<li>Modifier le fichier htaccess en remplaçant le domaine par cette ligne : RewriteRule (.*) https://file.js-info.fr/$1 [R=301,L]</li>
<li>Modifier le fichier de configuration et changer la valeur de $root_path avec le chemin du serveur jusqu'au dossier final.</li>
<li>Modifier toutes les occurrences de la fonction PHP array_slice dans les fichiers du template HTML. Le numéro doit correspondre au nombre de dossiers jusqu'au dossier personnel inclus (actuellement la valeur est : 10).</li>
<li>Modifier toutes les occurrences du 2ème paramètre de FileSystems::getSliceDirs. Le numéro doit correspondre au nombre de dossiers jusqu'au dossier personnel inclus (actuellement la valeur est : 10).</li>
</ol>
<h3>Démo :</h3>
<ol>
<li>https://file.js-info.fr/datas/data</li>
</ol>
<h3>Contact :</h3>
<ol>
<li>Julien Senechal</li>
<li>contact@js-info.fr</li>
</ol>
