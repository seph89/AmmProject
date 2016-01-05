<?php
require_once ROOT.DS."controllers".DS."controller_menu.php";
$ConMenuObj = new ConMenu();
$auxMenu = $ConMenuObj->takeMenu($param);	
		
$linkNum = count($auxMenu); // variabile con il numero massimo di link
$liMenu = '';

// ciclo che itera i dati del database e li registra in una variabile
for($i=0;$i!=$linkNum;$i++){	
	$liMenu .= "<li><a href='?page={$auxMenu[$i]['menu_id']}' title='{$auxMenu[$i]['menu_title']}'>{$auxMenu[$i]['menu_name']}</a></li>";
}
?>

<header>
	<nav>
	<h1><a href="http://spano.sc.unica.it/amm2015/scanuAndrea/Iosonouncane/index.php" title="HOME" >Iosonouncane</a></h1>
		<ul id="nav">
			<?=$liMenu;?>
                    <li><a href="http://spano.sc.unica.it/amm2015/scanuAndrea/Iosonouncane/carrello.php" title="SHOP">Shop</a></li>
                    <li><a href="http://spano.sc.unica.it/amm2015/scanuAndrea/Iosonouncane/login.php" title="LOGIN">LOGIN</a></li>
		</ul>
	</nav>
</header>