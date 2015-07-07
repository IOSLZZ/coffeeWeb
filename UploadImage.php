<?php
$title = "Upload Image";
$content = '<form method="POST" enctype="multipart/form-data">
				<label for="file">Filename: </label>
				<input type="file" name="file" id="file"/></br>
				<input type="submit" value="Submit" name="submit"/>	
			</form>';
			
// 当用户点击submit提交上传的文件时
if(isset($_POST["submit"])){
	// 创建SAE storage存储
	$s = new SaeStorage();
	$domain = 'coffee';
	
	// Check if filetype is a valid format
	$fileType = $_FILES["file"]["type"]; // $_FILES["file"]["type"] - 被上传文件的类型

	if(($fileType=="image/gif") || 
		($fileType=="image/jpeg")||
		($fileType=="image/jpg")||
		($fileType=="image/png")){
	// Check if file exists 判断文件是否已经存在
		if($s->fileExists($domain,$filename) == true) {
            echo "File already exists";
        }
		else{
		//move_uploaded_file() 函数将上传的文件移动到新位置。若成功，则返回 true，否则返回 false。
		// $_FILES["file"]["tmp_name"] - 存储在服务器的文件的临时副本的名称	
		// 第一个参数是 要移动的文件，第二个是 文件的新位置	
		$filename = $_FILES["file"]["name"];
			 $s->upload( $domain,$filename,$_FILES[file][tmp_name])； 
			//move_uploaded_file($_FILES["file"]["tmp_name"],"images/Coffee/".$filename);
			echo "Uploaded in "."images/Coffee/".$_FILES["file"]["name"];
		}
	}

}

			
include './templates.php';
?>

