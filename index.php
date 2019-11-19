<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/imports.css">
    <script src="js/imports-dist.js"></script>
    <title>WWI Webshop</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container">

        <div class="col-2">
            <img src="Images/logo.png" style="width: 40px; height: 40px;" alt="Logo WWI">
            <a class="navbar-brand mb-0 h1 text-white ml-2 mr-5" href="#">WWI</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="col-3">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Bekijk assortiment
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Categorie 1</a>
                        <a class="dropdown-item" href="#">Categorie 2</a>
                        <a class="dropdown-item" href="#">Categorie 3</a>
                        <a class="dropdown-item" href="#">Categorie 3</a>
                    </div>
                </li>
            </ul>
        </div>

        <div class="col-4">
            <form class="form-inline">
                <input class="form-control w-100" type="search" placeholder="Zoeken..." aria-label="Search">
            </form>
        </div>

        <div class="col-3 pl-5 align-middle d-flex">
            <div class="text-white float-right ">
                <i class="fas fa-user pr-4" style="font-size: 20px;"></i>
                <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
            </div>
        </div>
    </div>
</nav>
<div class="container">
<div id="carouselExampleIndicators" class="carousel slide mt-5" data-ride="carousel">
    <ol class="carousel-indicators rounded">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner rounded">
        <div class="carousel-item active">
            <img class="d-block w-100" src="https://socialbrothers.nl/wp-content/uploads/2016/11/r_atr-header-main.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block justify-content-start">
                <h5>Productnaam 1</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi et nisl hendrerit, aliquet mi sed, scelerisque tortor. Aliquam eu scelerisque quam, ac tristique dolor. Aliquam nulla risus, fermentum feugiat tortor quis, facilisis cursus arcu.</p>
                <button type="button" class="btn btn-success text-white">Bekijken </button>
            </div>
        </div>
        <div class="carousel-item rounded" >
            <img class="d-block w-100" src="https://socialbrothers.nl/wp-content/uploads/2016/11/r_atr-header-main.jpg" alt="Second slide">
            <div class="carousel-caption d-none d-md-block justify-content-start">
                <h5>Productnaam 2</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi et nisl hendrerit, aliquet mi sed, scelerisque tortor. Aliquam eu scelerisque quam, ac tristique dolor. Aliquam nulla risus, fermentum feugiat tortor quis, facilisis cursus arcu.</p>
                <button type="button" class="btn btn-success text-white">Bekijken </button>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://socialbrothers.nl/wp-content/uploads/2016/11/r_atr-header-main.jpg" alt="Third slide">
            <div class="carousel-caption d-none d-md-block justify-content-start">
                <h5>Productnaam 3</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi et nisl hendrerit, aliquet mi sed, scelerisque tortor. Aliquam eu scelerisque quam, ac tristique dolor. Aliquam nulla risus, fermentum feugiat tortor quis, facilisis cursus arcu.</p>
                <button type="button" class="btn btn-success text-white">Bekijken </button>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

    <div class="row mt-5">
        <div class="col-3">
            <a href="#" class="text-decoration-none">
            <div class="card border-0">
                <img src="Images/product1.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                <div class="card-body">
                    <h3 class="card-title h5 text-dark">Productnaam</h3>
                    <i class="fas fa-star rating"></i>
                    <i class="fas fa-star rating"></i>
                    <i class="fas fa-star rating"></i>
                    <i class="fas fa-star rating"></i>
                    <i class="fas fa-star-half-alt rating"></i>
                </div>
            </div>
            </a>
        </div>
        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card border-0">
                    <img src="Images/product2.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-dark">Productnaam</h3>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star-half-alt rating"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card border-0">
                    <img src="Images/product3.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-dark">Productnaam</h3>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star-half-alt rating"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card border-0">
                    <img src="Images/product4.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-dark">Productnaam</h3>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star-half-alt rating"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card border-0">
                    <img src="Images/product5.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-dark">Productnaam</h3>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star-half-alt rating"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card border-0">
                    <img src="Images/product12.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-dark">Productnaam</h3>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star-half-alt rating"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card border-0">
                    <img src="Images/product7.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-dark">Productnaam</h3>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star-half-alt rating"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card border-0">
                    <img src="Images/product8.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-dark">Productnaam</h3>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star-half-alt rating"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card border-0">
                    <img src="Images/product9.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-dark">Productnaam</h3>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star-half-alt rating"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card border-0">
                    <img src="Images/product10.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-dark">Productnaam</h3>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star-half-alt rating"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card border-0">
                    <img src="Images/product11.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-dark">Productnaam</h3>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star-half-alt rating"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card border-0">
                    <img src="Images/product12.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-dark">Productnaam</h3>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star rating"></i>
                        <i class="fas fa-star-half-alt rating"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card align-items-center border-0">
                    <div class="card-body">
                        <h3 class="h4 text-dark">Categorie 1</h3>
                    </div>
                    <img src="Images/Categorie14.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-primary font-weight-bold">Bekijk categorie</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card align-items-center border-0">
                    <div class="card-body">
                        <h3 class="h4 text-dark">Categorie 2</h3>
                    </div>
                    <img src="Images/Categorie14.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-primary font-weight-bold">Bekijk categorie</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card align-items-center border-0">
                    <div class="card-body">
                        <h3 class="h4 text-dark">Categorie 3</h3>
                    </div>
                    <img src="Images/Categorie14.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-primary font-weight-bold">Bekijk categorie</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-3">
            <a href="#" class="text-decoration-none">
                <div class="card align-items-center border-0">
                    <div class="card-body">
                        <h3 class="h4 text-dark">Categorie 4</h3>
                    </div>
                    <img src="Images/Categorie14.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                    <div class="card-body">
                        <h3 class="card-title h5 text-primary font-weight-bold">Bekijk categorie</h3>
                    </div>
                </div>
            </a>
        </div>

    </div>


</div>


<footer class="text-white bg-primary mt-5">
    <div class="container">
        <div class="row pt-3 pb-4 ">
            <div class="col-6">
                <img class="float-left mr-1" src="Images/logo.png" width="40px" height="40px"><h2>WWI</h2>
                <p class="pt-2">Lorem sdsdsdsddsdipsum dolor sit amet, consectetur adipiscing elit. Morbi et nisl hendrerit, aliquet mi sed, scelerisque tortor. Aliquam eu scelerisque quam, ac tristique dolor. Aliquam nulla risus, fermentum feugiat tortor quis, facilisis cursus arcu. Sed eu purus placerat, aliquet augue nec, molestie felis. Fusce porta.</p>

            </div>
            <div class="col-6">
                <h2>Klantenservice</h2>
                <p class="pt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi et nisl hendrerit, aliquet mi sed, scelerisque tortor. Aliquam eu scelerisque quam, ac tristique dolor. Aliquam nulla risus, fermentum feugiat tortor quis, facilisis cursus arcu. Sed eu purus placerat, aliquet augue nec, molestie felis. Fusce porta.</p>

            </div>
        </div>
    </div>
</footer>
</body>
</html>

