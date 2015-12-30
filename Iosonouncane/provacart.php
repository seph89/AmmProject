<?php require_once 'cart.php';
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="public/css/shop.css" media="all">
    </head>
    <body>
       <div id="shop">
           <a href="index.php">Home Page<br /><br /></a>
           Nel nostro Shop potrai acquistare i CD di Iosonouncane <br />
           e pagarli in sicurezza tramite Paypal!
        <?php products(); ?>
        
        <br /> <br />
        
        <?php cart(); ?>
       </div>
    </body>
</html>