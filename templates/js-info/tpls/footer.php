<?php

defined('_EXEC') or die;
// $top = shell_exec("top -n 1 -b");
// $pwd = shell_exec("pwd");
// $ls = shell_exec("ls");
// debug($top);

// $dateert = strftime("%Y-%m-%d %H:%M");
// debug($dateert);
// debug(date("Y-m-d h:i"));

// debug($_SESSION['user']);
// debug($customer);
// debug('toto');
// debug(count($customers));
// debug(count($messages));
// debug('toto tableau de bord');
?>
<div class="overlay toggle-icon"></div>
<a href="javaScript:;" class="back-to-top" title="Haut de page<?php $langs->lang("TOP_OF_PAGE", "footer") ?>"><i class='bx bxs-up-arrow-alt'></i></a>
<footer class="page-footer">
	<p class="mb-0"><span><?php $langs->lang("COPYRIGHT", "footer") ?> <?php echo date("Y") ?>. <?php $langs->lang("ALL_RIGHTS_RESERVED", "footer") ?></span> | <a href="/legals/legalnotice" title="<?php $langs->lang("LEGAL_NOTICE", "footer") ?>"><?php $langs->lang("LEGAL_NOTICE", "footer") ?></a> | <a href="/legals/termsofuse" title="<?php $langs->lang("TERMS_OF_USE", "footer") ?>"><?php $langs->lang("TERMS_OF_USE", "footer") ?></a></p>
</footer>