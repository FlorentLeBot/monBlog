<h1>Modifier <?= $params['post']->title ?></h1>

<form action="/monblog/admin/posts/edit/<?= $params['post']->id ?>" method="post">
    <div>
        <label for="title">Titre de l'article</label>
        <input type="text" name="title" id="title" value="<?= $params['post']->title ?>">
    </div>
    <div>
        <label for="content">Contenu de l'article</label>
        <textarea name="content" id="content" cols="30" rows="10"><?= $params['post']->content ?></textarea>
    </div>
    <button type="submit">Enregistrer les modifications</button>
</form>