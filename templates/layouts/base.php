<?php

/**
 * @var User $user
 */

use App\Model\User;

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MVC Framework</title>
<!--    lux  sketchy  journal-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/lux/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/lux/_variables.scss">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
            crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark" style="margin-bottom: 1.5rem">

    <div class="container-fluid">
        <a class="navbar-brand" href="/">Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/articles">Les posts</a></li>
                <li class="nav-item"><a class="nav-link active" href="/contact">Contact</a></li>

            </ul>

            <ul class="navbar-nav d-flex" style="margin-left: auto">
                <?php if (isset($user)){ ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="true">
                        <?= 'Bonjour '. $user?->getPseudo() ?>
                    </a>
                    <div class="dropdown-menu">
                        <?php if ($user?->getStatus() == 'admin') {
                            echo '<a class="dropdown-item" href="/admin">Administration</a>
                                    <div class="dropdown-divider"></div>';
                        } ?>
                        <a class="dropdown-item" href="/logout">Se déconnecter</a>
                    </div>
                </li>

            </ul>
            <?php } ?>

            <?php if ($user == null) { ?>
                <div class="d-flex">
                    <ul class="navbar-nav d-flex" style="margin-left: auto">
                        <li class="nav-item"><a class="nav-link active" href="/register">Register</a></li>
                    </ul>
                    <a class="nav-link active" href="/login">Login</a>
                </div>
            <?php } ?>


        </div>
    </div>
</nav>
<div class="container" style="margin-bottom: 29.5em">
    {{ content }}
</div>

<!-- Footer-->
<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted"> Copyright &copy; IMAMOS95 2023 |
    <a href="/"
       class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap"/>
        </svg>
    </a>

    <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
    </ul>

</footer>

</body>
</html>
