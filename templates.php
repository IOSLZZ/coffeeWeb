<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php  echo $title; ?></title>
	 <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<div class="wrapper">
    <div class="head-banner"></div>
    <nav class="navigation">
        <ul class="nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="Coffee.php">Coffee</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="#">About</a></li>
			<li><a href="Management.php">Management</a></li>
        </ul>
    </nav>
    <div class="content-area"><?php echo $content; ?></div>
    <div class="sidebar"></div>
    <footer>All rights reverse</footer>
</div>

</body>
</html>