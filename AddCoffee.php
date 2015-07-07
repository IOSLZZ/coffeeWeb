<?php
require './controller/CoffeeController.php';
$coffeeController = new CoffeeController();


$title = "Add a new coffee";
$content = "<form action='' method='POST'>
	<fieldset>
		<legend>Add a new coffee</legend>
		<label for='name' class='labelTag'>Name: </label>
		<input type='text' class='inputField' name='txtName'/></br>
	
		<label for='type' class='labelTag'>Type: </label>
		<select class='inputField' name='ddlType'>
			<option value=''>ALL</option>
		".$coffeeController->CreateOptionValues($coffeeController->GetCoffeeTypes())."
		</select></br>
		
		<label for='price' class='labelTag'>Price: </label>
		<input type='text' class='inputField' name='txtPrice'/></br>
		
		<label for='roast' class='labelTag'>Roast: </label>
		<input type='text' class='inputField' name='txtRoast'/></br>
		
		<label for='country' class='labelTag'>Country: </label>
		<input type='text' class='inputField' name='txtCountry'/></br>
		
		<label for='image' class='labelTag'>Image: </label>
		<select class='inputField' name='ddlImage'>
		".$coffeeController->GetImages()."
		</select></br>
		
		<label for='review' class='labelTag'>Review: </label>
		<textarea cols='70' rows='12' name='txtReview'></textarea></br>
		<input type='submit' value='Submit'>
	</fieldset>	
</form>
";
if(isset($_POST["txtName"])){
	$coffeeController->InsertCoffee();
}

include 'templates.php';
?>

