<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon blog</title>
    <!-- feuille de syle css -->
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'style.css' ?>">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="/monblog">Accueil</a></li>
                <!-- <li><a href="/"></a>Blog</li> -->
                <li><a href="#">Jeux de société</a></li>
                <li><a href="/monblog/posts">Blog</a></li>
                <?php if (isset($_SESSION['authentication'])) : ?>
                    <li><a href="/monblog/logout">Se déconnecter</a></li>
                <?php endif ?>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>