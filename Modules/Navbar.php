<?php
?>
<!DOCTYPE>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="/css/bootstrap.css">
<!--    <link type="text/css" rel="stylesheet" href="/css/bootstrap-grid.css">-->
<!--    <link type="text/css" rel="stylesheet" href="/css/bootstrap-reboot.css">-->

</head>
<body>
<nav class="navbar fixed-top navbar-light bg-primary">
    <a class="navbar-brand" href="homepage.php">
        <img src="/Images/wide-world-importers-logo-small.png" width="250" height="90" class="d-inline-block align-bottom">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarWWI" aria-controls="navbarWWI" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarWWI">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="itemsDropdown" role="button" data-toggle="dropdown">
                    Artikelen
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Chocolade</a>
                    <a class="dropdown-item" href="#">kantoor Artikelen</a>
                    <a class="dropdown-item" href="#">jeweetwel</a>
                </div>
            </li>
        </ul>
    <form class="form-inline">
        <input type="search" placeholder="Search" class="form-control mr-sm-2">
        <button class="btn bg-secondary btn-outline-secondary my-2 my-sm-0" type="submit">Zoeken</button>
    </form>
    </div>
</nav>
<script src="/js/jquery-3.3.1.slim.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.bundle.js"></script>
<script src="/js/bootstrap.js"></script>

</body>
</html>
