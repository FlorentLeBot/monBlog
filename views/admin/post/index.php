<h1>Administration des articles</h1>

<table>
    <thead>
        <th>ID</th>
        <th>Titre</th>
        <th>Publié le</th>
        <th>Action</th>
    </thead>
    <tbody>

        <?php foreach ($params['posts'] as $post) : ?>
            <div>
                <th><?= $post->id ?></th>
                <td><?= $post->title ?></td>
                <td><?= $post->getCreatedAt() ?></td>
                <td>
                    <a href="/monblog/admin/posts/edit/<?= $post->id ?>">Modifier</a>
                    <form action="/monblog/admin/posts/delete/<?= $post->id ?>" method="post">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </div>
        <?php endforeach ?>

    </tbody>
</table>