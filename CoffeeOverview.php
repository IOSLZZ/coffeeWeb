<?php
require './controller/CoffeeController.php';
$coffeeController = new CoffeeController();

$title = "CoffeeOverview";
$content = $coffeeController->CreateOverviewTable();

if(isset($_GET["deleteId"])){
	$coffeeController->DeleteCoffee($_GET["deleteId"]);
	echo "<script type='text/javascript'>document.location.href='CoffeeOverview.php'</script>";
}
include './templates.php';

?>