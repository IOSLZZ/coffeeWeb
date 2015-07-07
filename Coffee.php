<?php 
//require("controller/CoffeeController.php");
require 'controller/CoffeeController.php';
$coffeeController = new CoffeeController();

if(isset($_POST['types'])){
	// Fill page with coffees of the selected type
	$coffeeTables = $coffeeController->CreateCoffeeTables($_POST['types']);
	
}
else{
	//Page is loaded for the first time. no type selected -> Fetch all types
	$coffeeTables = $coffeeController->CreateCoffeeTables('');
}

$title = 'Coffee overview';

$content = $coffeeController->CreateCoffeeDropdownList().$coffeeTables;

include 'templates.php';
?>