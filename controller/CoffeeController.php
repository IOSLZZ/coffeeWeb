<script>
	function del(id){
		var msg = confirm("Are you sure you wish to delete this item?");
		if(msg){
			window.location ="CoffeeOverview.php?deleteId="+id;
			window.parent.main.document.location.reload();
		}
	}
</script>
<?php 
require("model/CoffeeModel.php");

class CoffeeController{

	function CreateCoffeeDropdownList(){
	
		$coffeeModel = new CoffeeModel();
		$result = "<form action='' method='post' width='200px' >
					Please select a type:
					<select name='types'>
						<option value='%'>ALL</option>"
						.$this->CreateOptionValues($coffeeModel->GetCoffeeTypes()).
					"</select>
					<input type='submit' value='Search' >
				</form>";
				
		return $result;
	}
	// 
	function CreateOptionValues(array $valueArray){
		$result = "";
		foreach($valueArray as $value){
			$result = $result."<option value='$value'>$value</option> ";
		}
		return $result;
	}
	// 
	function CreateCoffeeTables($types){
		
		$coffeeModel = new CoffeeModel();
		// 这里coffeeArray里存放的是一个个 coffeeBean对象
		$coffeeArray = $coffeeModel->GetCoffeeByType($types);
		//echo count($coffeeArray);
		$result = "";
		
		foreach ($coffeeArray as $key => $coffee) 
        {	
            echo $coffee->name;
			$result = $result.
					"<table class = 'coffeeTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$coffee->image' /></th>
                            <th width = '75px' >Name: </th>
                            <td>$coffee->name</td>
                        </tr>
                        
                        <tr>
                            <th>Type: </th>
                            <td>$coffee->type</td>
                        </tr>
                        
                        <tr>
                            <th>Price: </th>
                            <td>$coffee->price</td>
                        </tr>
                        
                        <tr>
                            <th>Roast: </th>
                            <td>$coffee->roast</td>
                        </tr>
                        
                        <tr>
                            <th>Origin: </th>
                            <td>$coffee->country</td>
                        </tr>
                        
                        <tr>
                            <td colspan='2' >$coffee->review</td>
                        </tr>                      
                     </table>";
        }        
		
		return $result;
	}
	
	//管理页面 -管理咖啡列表
	function CreateOverviewTable(){
		$result = "<table class='overviewTable'>
					<tr>
						<td></td>
						<td></td>
						<td>ID</td>
						<td>Name</td>
						<td>Type</td>
						<td>Price</td>
						<td>Country</td>
						<td>Roast</td>
					</tr>
					";
					
		$coffeeArray = $this->GetCoffeeByType('');
		foreach($coffeeArray as $key =>$value){
			$result = $result.
			"
			<tr>
				<td><a href='UpdateCoffee.php?id=$value->id'>Update</a></td>
				<td><a href='javascript:void(0);' onclick='del($value->id);'>Delete</a></td>
				<td>$value->id</td>
				<td>$value->name</td>
				<td>$value->type</td>
				<td>$value->price</td>
				<td>$value->country</td>
				<td>$value->roast</td>
			</tr>
			";
		}
		$result = $result."</table>";
		return $result;
	}
	
	//
	function CreateUpdateForm($id){
		$coffee = $this->GetCoffeeById($id);
		$result = "<form action='' method='POST'>
						<fieldset>
				<legend>Update Coffee Data</legend>
				<input type='hidden' value='$id' name='id'/>
				<label for='name' class='labelTag'>Name: </label>
				<input type='text' class='inputField' name='txtName' value='$coffee->name'/></br>
			
				<label for='type' class='labelTag'>Type: </label>
				<select class='inputField' name='ddlType'>
					<option value='$coffee->name'>$coffee->type</option>
					".$this->CreateOptionValues($this->GetCoffeeTypes())."
				</select></br>
				
				<label for='price' class='labelTag'>Price: </label>
				<input type='text' class='inputField' name='txtPrice' value='$coffee->price' /></br>
				
				<label for='roast' class='labelTag'>Roast: </label>
				<input type='text' class='inputField' name='txtRoast' value='$coffee->roast'/></br>
				
				<label for='country' class='labelTag'>Country: </label>
				<input type='text' class='inputField' name='txtCountry' value='$coffee->country'/></br>
				
				<label for='image' class='labelTag'>Image: </label>
				<select class='inputField' name='ddlImage'>
					<option value='$coffee->image'>$coffee->image</option>
					".$this->GetImages()."
				</select></br>
				
				<label for='review' class='labelTag'>Review: </label>
				<textarea cols='70' rows='12' name='txtReview'>$coffee->review</textarea></br>
				<input type='submit' value='Submit'>
			</fieldset>	
			</form>
			";
			
			return $result;
	
	}
	
	function InsertCoffee(){
		// 接受提交过来的值
		$name = $_POST["txtName"];
		$type = $_POST["ddlType"];
		$price = $_POST["txtPrice"];
		$roast = $_POST["txtRoast"];
		$country = $_POST["txtCountry"];
		$image = $_POST["ddlImage"];
		$review = $_POST["txtReview"];
		
		$coffee = new CoffeeEntity(-1,$name,$type,$price,$roast,$country,$image,$review);
		$coffeeModel = new CoffeeModel();
		$coffeeModel->InsertCoffee($coffee);
		
	}
	function UpdateCoffee($id){
		// 接受提交过来的值
		$name = $_POST["txtName"];
		$type = $_POST["ddlType"];
		$price = $_POST["txtPrice"];
		$roast = $_POST["txtRoast"];
		$country = $_POST["txtCountry"];
		$image = $_POST["ddlImage"];
		$review = $_POST["txtReview"];
		
		$coffee = new CoffeeEntity($id,$name,$type,$price,$roast,$country,$image,$review);
		$coffeeModel = new CoffeeModel();
		$coffeeModel->UpdateCoffee($id,$coffee);
	
	}
	function DeleteCoffee($id){
		$coffeeModel = new CoffeeModel();
		$coffeeModel->DeleteCoffee($id);
	}
	
	// Get Data Method
	function GetCoffeeById($id){
		$coffeeModel = new CoffeeModel();
		return $coffeeModel->GetCoffeeById($id); // 返回一组coffee Bean
	}
	function GetCoffeeByType($type){
		$coffeeModel = new CoffeeModel();
		return $coffeeModel->GetCoffeeByType($type);
	}
	function GetCoffeeTypes(){
		$coffeeModel = new CoffeeModel();
		return $coffeeModel->GetCoffeeTypes(); 
	}
	/**
	function GetImages(){
	// select folder to scan
		$handle = opendir("");
	// Read all files and store names in array
		while($image =readdir($handle)){
			$images[] = $image;
		}
		closedir($handle);
		// Exclude all filenames where filname length<3
		$imageArray = array();
		foreach($images as $image){
			if(strlen($image)>2){
				array_push($imageArray,$image);
			}
		}
		// Create <select><option>Values and return result
		$result = $this->CreateOptionValues($imageArray);
		return $result;
	}
	**/
	function GetImages(){
		$sae_storage = new SaeStorage();
		$domainName = "coffee";
		$listfiles = $sae_storage->getListByPath($domainName);
		
		$files = $listfiles["files"];

		$imageUrls = array();
		foreach($files as $imagefile){
 
			$tempName=$imagefile["Name"];
			$imageUrl = $sae_storage->getUrl($domainName,$tempName);
			echo $imageUrl;
			array_push($imageUrls, $imageUrl);
		}
   			
		
		//$filename = $_FILES["file"]["name"];
		//move_uploaded_file($_FILES["file"]["tmp_name"],"images/Coffee/".$filename);
		
    
		$result = $this->CreateOptionValues($imageUrls);
		return $result;
	
	}

}


?>