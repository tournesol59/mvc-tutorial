<?php foreach($articles as $article): ?>

<h2><a href="articles/lire/<?=$article['title'] ?>"><?= $article['title'] ?>"</a></h2>

<p><?= $article['author'] ?></p>
<?php endforeach ?>
