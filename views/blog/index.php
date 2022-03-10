<h1>Mes derniers articles</h1>

<!-- je boucle sur mes postes -->
<?php foreach($params['posts'] as $post): ?>
    <article>
        <h2><?= $post->title ?></h2>
        <small><?= $post->getCreatedAt() ?></small>
        <p><?= $post->getExcerpt() ?></p>
        <a href="/posts/<?= $post->id ?>">Lire plus</a>
    </article>
<?php endforeach ?>