<?php if (isset($_SESSION['errors'])) : ?>


    <?php foreach ($_SESSION['errors'] as $errorsArray) : ?>
        <?php foreach ($errorsArray as $errors) : ?>
            <div>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>
    <?php endforeach ?>
<?php endif ?>
<?php session_destroy() ?>

<h1>Se connecter</h1>

<form action="/monblog/login" method="post">
    <div>
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" ?>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" ?>
    </div>

    <button type="submit">Se connecter</button>
</form>