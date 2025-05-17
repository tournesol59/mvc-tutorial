<h1>Livres from <?= $livres[1]['author'] ?></h1>
<table>

<?php foreach($livres as $livre): ?>
 <tr>
 <td><?= $livre['title'] ?></td>
 </tr>
<?php endforeach ?>
</table>
<a href="index.php?p=login">Votre page de demarrage</a>

