
<h2>Votre pret a bien ete traite</h2>
<?php
   require_once(ROOT.'app/controllers/LogApplication.php');
   $error_msg=LogApplication::statusReserve ?>
<?php if ($error_msg==="savedemprunt") : ?>

<p>Le livre que vous avez emprunte <?=$param['title'] ?> a bien ete traite</p>

<?php else: ?>

<p>Le livre <?=$param['title'] ?> n a pas pu etre emprunte</p>

<?php endif; ?>