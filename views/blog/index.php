<h1>Mes derniers articles</h1>

<!-- je boucle sur mes postes -->
<?php foreach ($params['posts'] as $post) : ?>
    <article>
        <?php //var_dump($post); 
        ?>
        <h2><?= $post->title ?></h2>

        <div id="badge">
            <!-- récupération des tags -->
            <?php foreach ($post->getTags() as $tag) : ?>
                <span class="badge"><?= $tag->name ?></span>
            <?php endforeach ?>
        </div>

        <small>Publié le <?= $post->getCreatedAt() ?></small>
        <p><?= $post->getExcerpt() ?></p>
        <a href="posts/<?= $post->id ?>">Lire plus</a>
    </article>
<?php endforeach ?>