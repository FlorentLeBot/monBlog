<h1><?= $params['post']->title ?></h1>
<div id="badge">
    <!-- récupération des tags -->
    <?php foreach ($params['post']->getTags() as $tag) : ?>
        <span class="badge"><?= $tag->name ?></span>
    <?php endforeach ?>
</div>
<p><?= $params['post']->content ?></p>
<img src="<?php $params['post']->image?>" alt="mon image">
<a href="/monblog/posts">Revenir sur les derniers articles</a>