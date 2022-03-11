<h1><?= $params['tag']->name ?></h1>

<!-- je boucle sur mes postes -->
<?php foreach ($params['tag']->getPosts() as $post) : ?>
    <article>
        <div id="badge">
            <!-- récupération des titres des articles par tags -->
            <a href="posts/<?= $post->id ?>"><?= $post->title ?></a>
        </div>
    </article>
<?php endforeach ?>