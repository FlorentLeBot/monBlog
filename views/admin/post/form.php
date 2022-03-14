<h1><?= $params['post']->title ?? 'Créer un nouvel article' ?></h1>

<form enctype="multipart/form-data" action="<?= isset($params['post']) ? "/monblog/admin/posts/edit/{$params['post']->id}" :  "/monblog/admin/posts/create" ?>" method="post">
    <div>
        <label for="title">Titre de l'article</label>
        <input type="text" name="title" id="title" value="<?= $params['post']->title ?? '' ?>">
    </div>
    <div>
        <label for="content">Contenu de l'article</label>
        <textarea name="content" id="content" cols="30" rows="10"><?= $params['post']->content ?? '' ?></textarea>
    </div>
    <div>
        <label for="tags">Tags de l'article</label>
        <select multiple name="tags[]" id="tags">
            <?php foreach ($params['tags'] as $tag) : ?>
                <option value="<?= $tag->id ?>" <?php if (isset($params['post'])) : ?> <?php foreach ($params['post']->getTags() as $postTag) {
                                                                                            echo ($tag->id === $postTag->id) ? 'selected' : '';
                                                                                        }
                                                                                        ?> <?php endif ?>><?= $tag->name ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div>
        <input type="file" name="image">
    </div>


    <button type="submit"><?= isset($params['post']) ? 'Enregistrer les modifications' : 'Publier mon article' ?></button>
</form>