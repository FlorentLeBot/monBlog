<h1>Mes derniers articles</h1>

<!-- je boucle sur mes postes -->
<div class="blog-article">
    <?php foreach ($params['posts'] as $post) : ?>
        <article id="blog-article">
            <?php //var_dump($post); 
            ?>
            <h2><?= $post->title ?></h2>

            <div id="badge">
                <!-- récupération des tags -->
                <?php foreach ($post->getTags() as $tag) : ?>
                    <span class="badge"><a href="tags/<?= $tag->id ?>"><?= $tag->name ?></a></span>
                <?php endforeach ?>
            </div>


            <p class="blog-excerpt"><?= $post->getExcerpt() ?></p>
            <div class="column">
                <small class="created-at">Publié le <?= $post->getCreatedAt() ?></small>
                <a class="read-more" href="posts/<?= $post->id ?>">Lire plus</a>
            </div>
        </article>
    <?php endforeach ?>
</div>