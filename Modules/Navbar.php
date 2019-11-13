<?php
?>
<!DOCTYPE>
<html>
<head>
    <link type="text/css" rel="stylesheel" href="/css/bootstrap.css">
</head>
<body>
<nav class="navbar navbar-light bg-primary">
    <a class="navbar-brand" href="homepage.php">
        <img src="/Images/wide-world-importers-logo-small.png" width="250" height="90" class="d-inline-block align-bottom">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarWWi" aria-controls="#navbarWWi">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarWWi">
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
    </div>

    <form class="form-inline">
        <input type="search" placeholder="Search" class="form-control mr-sm-2">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Zoeken</button>
    </form>
</nav>

</body>
</html>
