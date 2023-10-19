# File manager <strong>V_1.2.8</strong>
<p>A simple file manager</p>
<p>This version of the manager is limited in functionality. It has been adapted to work with sessions. This code does not require a database.</p>
<p>This file manager comes from my CRM <a href="https://crm.js-info.fr" target="_blank">crm.js-info.fr</a>.</p>
<h3>Requirements:</h3>
<ol>
<li>PHP 8.1 or higher</li>
</ol>
<h3>Installation:</h3>
<ol>
<li>Edit the htaccess file by replacing the domain with this line : <u>file.js-info.fr</u>/$1</li>
<li>Edit the configuration file and change the value of $root_path with the server path to the final folder.</li>
<li>Edit all occurrences of the PHP array_slice function in HTML template files. The number must correspond to the number of folders up to and including the personal folder (currently the value is: 10).</li>
<li>Change all occurrences of the 2nd parameter of FileSystems::getSliceDirs. The number must correspond to the number of folders up to and including the personal folder (currently the value is: 10).</li>
</ol>
<h3>Demo:</h3>
<ol>
<li><a href="https://file.js-info.fr/datas/data" target="_blank">file.js-info.fr</a></li>
</ol>
<h3>Contact:</h3>
<ol>
<li>Julien Senechal</li>
<li><a href="mailto:contact@js-info.fr">contact@js-info.fr</a></li>
</ol>
<hr />
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
