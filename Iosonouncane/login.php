<?php
//redirige l'utente se già loggato
session_start();
if(isset($_SESSION['user'])) header("Location:admin.php");
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/login.css" media="all">
</head>
<body>
    <div id="login-controls">
        <a href="index.php">Home Page<br /></a>
        <h2>Login</h2>
        <!--mostra un messaggio di errore -->
        <?php if(@$_GET['err'] == 1) { ?>
        <div class="error-text">Login Fallito. Per favore riprova!</div>
        <?php } ?>
        <form method="POST" action="index.php">
            <p>Username:<br />
                <input type="text" name="user" />
            </p>
            <p>Password:<br />
                <input type="text" name="pass" />
            </p>
            <input type="submit" name="op" value="login" />
        </form>
    </div>
</body>
</html>
