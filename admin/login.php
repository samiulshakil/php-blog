<?php 
include '../lib/session.php'; 
session::check_login();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/database.php'; ?>
<?php include '../helpers/format.php'; ?>

<?php 
	$db = new database();
	$fm = new format();

?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$username = $fm->validation($_POST['username']); 			
			$password =  $fm->validation(md5($_POST['password'])); 

			$username = mysqli_real_escape_string($db->conn, $username);			
			$password = mysqli_real_escape_string($db->conn, $password);

			$sql = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";	
			$result = $db->select($sql);
			if ($result != false) {
				$value = $result->fetch_assoc();
				$row = mysqli_num_rows($result);
				if ($row > 0 ) {
					session::set("login" , true);
					$_SESSION['username'] = "author";
					header("location: index.php");
				}else{
					echo "<span class='success: red'>No Result Found!</span>";
				}
			}else{
				echo "<span class='error'>Username or password not matched!</span>";
			}		
		}
	 ?>
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>