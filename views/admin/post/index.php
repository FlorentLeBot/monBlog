<h1>Administration des articles</h1>
<?php if(isset($_GET['success'])): ?>
    <div>Vous êtes connecté !</div>
    <?php endif ?>

<a class="new-article-btn" href="/monblog/admin/posts/create">Création d'un nouvel article</a>

<table>
    <thead>
        <th>ID</th>
        <th>Titre</th>
        <th>Publié le</th>
        <th>Action</th>
    </thead>
    <tbody>

        <?php foreach ($params['posts'] as $post) : ?>
            <tr>
                <td><?= $post->id ?></td>
                <td><?= $post->title ?></td>
                <td><?= $post->getCreatedAt() ?></td>
                <td>
                    <a href="/monblog/admin/posts/edit/<?= $post->id ?>">Modifier</a>
                    <form action="/monblog/admin/posts/delete/<?= $post->id ?>" method="post">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>