<?php
include "../Modules/functions.php";
?>
<!-- Begin page content -->
<div class="container mb-5">
    <div class="row mt-5">
        <div class="col-2"></div>
        <div class="col-4 border-right">
            <div class="mb-5">
                <h1>Bestellen<br><br></h1>
                <h4>Bestaande Klant</h4>
            </div>
            <form action="../BackgroundCode/login_validation.php" method="POST">
                <div class="input-group  mb-3 w-100">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                    <input type="text" class="form-control rounded" placeholder="E-Mail" name="email" required>
                </div>
                <div class="input-group  mb-3 w-100">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    <input type="password" class="form-control rounded" placeholder="Wachtwoord" name="password"
                           required>
                </div>
                <div class="row float-right mr-1">
                    <button type="submit" id="inlogbutton" class="btn btn-success pl-4 px-4 mb-3">Inloggen</button>
                </div>
                </span>
            </form>
        </div>

        <div class="col-6">
            <div class="row mb-5 justify-content-between"></div>
            <div class="row mb-5 justify-content-between"></div>
            <div class="row mb-5 justify-content-between"></div>
            <div class="row mb-5 justify-content-between"></div>
            <div class="row mb-5 justify-content-between"></div>
            <div class="row mb-5 justify-content-between"></div>
            <div      class="row ml-1">

                 <a href="<?php echo $prefix; ?>Pages/bestel.php">
                    <button name="inlogbutton" id="inlogbutton" class="btn btn-success">Doorgaan als gast</button>
                </a>
            </div>
            </div>
        </div>
    </div>
</div>

