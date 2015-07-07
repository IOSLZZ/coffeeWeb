<?php 
// 获取到映射的 CoffeeEntity表，进行数据库操作
require("entity/CoffeeEntity.php");

// Contains database related code for the Coffee page
class CoffeeModel{
	// Get all coffee type from the database and return them in an array
	
	function GetCoffeeTypes(){
		
		//$connect = mysql_connect('localhost','g201185075','g201185075');
		//mysql_select_db('g201185075');
		$connect = mysql_connect('w.rdc.sae.sina.com.cn:3307','kyolyw3n4w','2ljwki54ikm353z5hz4h0lj5j2jl42xw1x0wmh43');
		mysql_select_db('app_kepunacoffee');
		
		mysql_query("set names utf8");
		
		//mysql_select_db($database);
		
		$result = mysql_query("select distinct type from coffee")or die(mysql_error());
		$types = array();
		
		// Get data from database;
		while($row = mysql_fetch_array($result)){
			array_push($types,$row[0]);
		}
		
		// Close connection and return result array
		mysql_close();
		return $types;
	}	
	// Get coffeeEntity objects from the database and return them in an array
	function GetCoffeeByType($type){
		//$connect = mysql_connect('localhost','g201185075','g201185075');
		//mysql_select_db('g201185075');
		
		$connect = mysql_connect('w.rdc.sae.sina.com.cn:3307','kyolyw3n4w','2ljwki54ikm353z5hz4h0lj5j2jl42xw1x0wmh43');
		mysql_select_db('app_kepunacoffee');
		mysql_query("set names utf8");
		
		$temp = $type;
		if($temp == ""){
			$sql = "select * from coffee";
		}else{
			$sql = "select * from coffee where type like'$type' ";
		}
		
		$result = mysql_query($sql)or die(mysql_error());
		$coffeeArray = array();
		while($row = mysql_fetch_array($result)){
			$id = $row[0];
			$name = $row[1];
			$type = $row[2];
			$price = $row[3];
			$roast = $row[4];
			$country = $row[5];
			$image = $row[6];
			$review = $row[7];
			
			// Create coffeeBean and store them in an array
			// 把数据封装成一个coffeeBean
			$coffee = new CoffeeEntity($id,$name,$type,$price,$roast,$country,$image,$review);
			array_push($coffeeArray,$coffee);
	//测试 foreach ($coffee as $key=>$val){
		//		echo($key.':'.$val.'<br/>');
	//}
		}
		
		mysql_close();
		return $coffeeArray;
		
	}

	function GetCoffeeById($id){
		//$connect = mysql_connect('localhost','g201185075','g201185075');
		//mysql_select_db('g201185075');
		
		$connect = mysql_connect('w.rdc.sae.sina.com.cn:3307','kyolyw3n4w','2ljwki54ikm353z5hz4h0lj5j2jl42xw1x0wmh43');
		mysql_select_db('app_kepunacoffee');
		mysql_query("set names utf8");
		
		$sql = "select * from coffee where id=$id";
		$result = mysql_query($sql)or die(mysql_error());
		
		while($row=mysql_fetch_array($result)){
			$name = $row[1];
			$type = $row[2];
			$price = $row[3];
			$roast = $row[4];
			$country = $row[5];
			$image = substr($row[6],14);
			$review = $row[7];
			
			$coffee = new CoffeeEntity(-1,$name,$type,$price,$roast,$country,$image,$review);	
		}
		mysql_close();
		return $coffee;
	
	}
	function InsertCoffee(CoffeeEntity $coffee){
		$sql = sprintf("insert into coffee(name,type,price,roast,country,image,review)
						values('%s','%s','%s','%s','%s','%s','%s')",
						//mysql_real_escape_string($coffee->name), // 给sprintf()函数传入真实的值
						//mysql_real_escape_string($coffee->type),
						//mysql_real_escape_string($coffee->price), // 给sprintf()函数传入真实的值
						//mysql_real_escape_string($coffee->roast),
						//mysql_real_escape_string($coffee->country), // 给sprintf()函数传入真实的值
						//mysql_real_escape_string("images/Coffee/".$coffee->image),
						//mysql_real_escape_string($coffee->review) // 给sprintf()函数传入真实的值
						$coffee->name, // 给sprintf()函数传入真实的值
						$coffee->type,
						$coffee->price, // 给sprintf()函数传入真实的值
						$coffee->roast,
						$coffee->country, // 给sprintf()函数传入真实的值
						$coffee->image,
						$coffee->review 
				);
		$this->PerformQuery($sql);
	}
	function UpdateCoffee($id,CoffeeEntity $coffee){
		$sql = sprintf("UPDATE coffee SET
							name='%s',type='%s',price='%s',roast='%s',country='%s',image='%s',review='%s'
						WHERE id= $id ",
						//mysql_real_escape_string($coffee->name), // 给sprintf()函数传入真实的值
						//mysql_real_escape_string($coffee->type),
						//mysql_real_escape_string($coffee->price), // 给sprintf()函数传入真实的值
						//mysql_real_escape_string($coffee->roast),
						//mysql_real_escape_string($coffee->country), // 给sprintf()函数传入真实的值
						//mysql_real_escape_string("images/Coffee/".$coffee->image),
						//mysql_real_escape_string($coffee->review) // 给sprintf()函数传入真实的值
						$coffee->name, 
						$coffee->type,
						$coffee->price, 
						$coffee->roast,
						$coffee->country,
						"images/Coffee/".$coffee->image,
						$coffee->review 
						
				);
		$this->PerformQuery($sql);
	}
	function DeleteCoffee($id){
		$sql = "DELETE FROM coffee WHERE id = $id";
		$this->PerformQuery($sql);
	}
	function PerformQuery($sql){
		//$connect = mysql_connect('localhost','g201185075','g201185075');
		//mysql_select_db('g201185075');
		
		$connect = mysql_connect('w.rdc.sae.sina.com.cn:3307','kyolyw3n4w','2ljwki54ikm353z5hz4h0lj5j2jl42xw1x0wmh43');
		mysql_select_db('app_kepunacoffee');
		mysql_query("set names utf8");
		
		mysql_query($sql) or die(mysql_error());
		mysql_close();
	}
	
	
}


?>

