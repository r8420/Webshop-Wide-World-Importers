<body>
<div id="page-container">
    <div id="content-wrap">
        <nav class="navbar navbar-expand-lg bg-primary navbar-light">
            <div class="container">
                <a class="navbar-brand text-white mb-0 h1" href="/index.php">
                    <img src="../Images/logo.png" width="40" height="40" alt="">
                    WWI</a>
                <div class="my-2 my-lg-0 d-lg-none">
                    <div class="fas dropdown fa-user text-white ml-5 mr-4" id="navbarDropdown1" role="button"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                            <a class="dropdown-item" href="/Pages/login.php" onclick="window.location.href='/Pages/login.php'">Inloggen</a>
                            <a class="dropdown-item" href="/Pages/registreren.php" onclick="window.location.href='/Pages/registreren.php'">Account aanmaken</a>
                        </div>
                    </div>
                    <a href="/Pages/winkelwagen.php">
                        <i class="fas fa-shopping-cart text-white"></i>
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white font-weight-bold" href="#" id="navbarDropdown"
                               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categorieën bekijken
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Categorie 1</a>
                                <a class="dropdown-item" href="#">Categorie 2</a>
                                <a class="dropdown-item" href="#">Categorie 3</a>
                            </div>
                        </li>
                    </ul>
                    <form class="form-inline mr-md-auto w-50" method="get" action="/Pages/zoekpagina.php">
                        <input class="form-control mr-sm-2 w-75" type="search" name="search" placeholder="Zoeken..."
                               aria-label="Search">
                    </form>
                </div>
                <div class="my-2 my-lg-0 d-none d-lg-block ">
                    <div class="fas dropdown fa-user text-white ml-5 mr-4" id="navbarDropdown1" href="#" role="button"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                            <a class="dropdown-item" href="/Pages/login.php" onclick="window.location.href='/Pages/login.php'">Inloggen</a>
                            <a class="dropdown-item" href="/Pages/registreren.php" onclick="window.location.href='/Pages/registreren.php'">Account aanmaken</a>
                        </div>
                    </div>
                    <a href="/Pages/winkelwagen.php">
                        <i class="fas fa-shopping-cart text-white"></i>
                    </a>
                </div>
            </div>
        </nav>


