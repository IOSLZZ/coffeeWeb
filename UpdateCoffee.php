<?php
require './controller/CoffeeController.php';
$coffeeController = new CoffeeController();

$title = "Update Coffee Data";
$content = $coffeeController->CreateUpdateForm($_GET["id"]);

if(isset($_POST["txtName"])){
	$coffeeController->UpdateCoffee($_GET["id"]);
}
include './templates.php';

?>

