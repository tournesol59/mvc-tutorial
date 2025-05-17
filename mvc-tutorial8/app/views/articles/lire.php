<h1>Livres</h1>
<table>

<?php foreach($articles as $article): ?>
 <tr>
 <td><?= $article['title'] ?></td>

 <td><?= $article['author'] ?></td>>
 </tr>
<?php endforeach ?>
</table>
