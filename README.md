# File manager <strong>V_1.2.8</strong>
<p>Un simple gestionnaire de fichiers</p>
<p>Cette version du gestionnaire est limitée en fonctionnalités. Il a été adapté pour fonctionner avec les sessions. Ce code ne nécessite pas de base de données.</p>
<p>Ce gestionnaire de fichiers est issu de mon CRM <a href="https://crm.js-info.fr" target="_blank">crm.js-info.fr</a>.</p>
<h3>Prérequis :</h3>
<ol>
<li>PHP 8.1 ou version supérieure</li>
</ol>
<h3>Installation :</h3>
<ol>
<li>Modifier le fichier htaccess en remplaçant le domaine par cette ligne : <u>file.js-info.fr</u>/$1</li>
<li>Modifier le fichier de configuration et changer la valeur de $root_path avec le chemin du serveur jusqu'au dossier final.</li>
<li>Modifier toutes les occurrences de la fonction PHP array_slice dans les fichiers du template HTML. Le numéro doit correspondre au nombre de dossiers jusqu'au dossier personnel inclus (actuellement la valeur est : 10).</li>
<li>Modifier toutes les occurrences du 2ème paramètre de FileSystems::getSliceDirs. Le numéro doit correspondre au nombre de dossiers jusqu'au dossier personnel inclus (actuellement la valeur est : 10).</li>
</ol>
<h3>Démo :</h3>
<ol>
<li><a href="https://file.js-info.fr/datas/data" target="_blank">file.js-info.fr</a></li>
</ol>
<h3>Contact :</h3>
<ol>
<li>Julien Senechal</li>
<li><a href="mailto:contact@js-info.fr">contact@js-info.fr</a></li>
</ol>
