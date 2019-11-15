<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/imports.css">
    <style>
        .container {
            margin: 100px auto;
        }
    </style>
</head>
<body>


<!-- Begin page content -->
<div class="container">
    <div id="pageheading">
        <h1>Login</h1>
    </div>
    <form>
        <div class="form-group">
            <label for="InputEmail">Email address</label>
            <input type="email" class="form-control" id="InputEmail" placeholder="Emailadress" required>
        </div>
        <div class="form-group">
            <label for="InputWachtwoord1">Password</label>
            <input type="password" class="form-control" id="InputWachtwoord1" placeholder="Wachtwoord" required>
        </div>
        <button type="submit" class="btn btn-success">Inloggen</button>
    </form>
    <p>
        Nog geen account?<br>
        <a href="register.php">Maak hier een account aan</a>
    </p>
</div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/imports-dist.js"></script>
</body>
</html>