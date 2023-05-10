<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'hrdbid.cbjjp9rsqbdd.us-east-1.rds.amazonaws.com';
    $DATABASE_USER = 'admin';
    $DATABASE_PASS = 'HRDBHRDB';
    $DATABASE_NAME = 'HRDB';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="test.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>SCBC Human Resource Management</h1>
            <a href="main.php"><i class="fas fa-home"></i>Home</a>
    	</div>
    </nav>
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>
