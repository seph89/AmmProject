<?php
require_once ('controllers/user_controller.php');
require_once ('models/user_model.php');
//
session_start();
if(!isset($_SESSION['user'])){
    header("Location:login.php");
}
else{
    $user = $_SESSION['user'];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf8">
<title>Admin Panel MVC</title>

<!--<link rel="stylesheet" href="public/css/reset.css" media="all">-->
<link rel="stylesheet" href="public/css/admin.css" media="all">

</head>

<body> 
<nav id="homeNav">
	<ul>
                <li><a href="index.php?op=logout">Logout</a>
		<li><a href="index.php">Home Page</a></li>
		<li><a href="admin.php?content">Gestione Contenuto</a></li>
		<li><a href="admin.php?menu">Gestione Menu</a></li>
	</ul>
</nav>

<?php
define('ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
$param = 'backend';

if(isset($_GET['menu'])){
	require_once ROOT.DS."views".DS."backend".DS."view_adm_menu.php";
} elseif(isset($_GET['content'])) {
	require_once ROOT.DS."views".DS."backend".DS."view_adm_content.php";
}
?>

</body>
</html>