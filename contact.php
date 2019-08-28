<?php include 'inc/header.php'; ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $fm->validation($_POST['firstname']);
    $lastname = $fm->validation($_POST['lastname']);
    $email = $fm->validation($_POST['email']);
    $body = $fm->validation($_POST['body']);

    $firstname = mysqli_real_escape_string($db->conn, $firstname);
    $lastname = mysqli_real_escape_string($db->conn, $lastname);
    $email = mysqli_real_escape_string($db->conn, $email);
    $body = mysqli_real_escape_string($db->conn, $body);

if (empty($firstname)) {
	$_SESSION['firstname_error'] = "";
}elseif ( empty($lastname)) {
	$_SESSION['lastname_error'] = "";
}elseif (empty($email)) {
	$_SESSION['email_error'] = "";
}elseif (empty($body)) {
	$_SESSION['body_error'] = "";
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['invalid_email'] = "";
}else{
	$sqlinsert = "INSERT INTO tbl_contact(firstname, lastname, email, body) VALUES ('$firstname', '$lastname', '$email', '$body')";
		$post_insert = $db->insert($sqlinsert);
		if ($post_insert) {
		    $_SESSION['sendsuccess'] ="";
		}else{
			$_SESSION['sendfailed'] = '';
		}
     }
 
 }
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php
					if (isset($_SESSION['sendsuccess'])) { ?>
						<span style="color: green;">Message Sent Successfully</span>
					<?php } ?>
					<?php
					if (isset($_SESSION['sendfailed'])) { ?>
						<span style="color: red;">Message Not Send</span>
					<?php } ?>
	<form action="" method="post">
		<table>
			<tr>
				<td>Your First Name:</td>
				<td>
				<input type="text" name="firstname" placeholder="Enter first name" <?php if(isset($email)){ echo "value = '$firstname'"; } ?>"/>
				<?php
				if (isset($_SESSION['firstname_error'])) { ?>
					<span style="color: red;">First Name is Required</span>
				<?php } ?>
				</td>
			</tr>
			<tr>
				<td>Your Last Name:</td>
				<td>
				<input type="text" name="lastname" placeholder="Enter Last name" <?php if(isset($email)){ echo "value = '$lastname'"; } ?>/>
				<?php
				if (isset($_SESSION['lastname_error'])) { ?>
					<span style="color: red;">Last Name is Required</span>
				<?php } ?>
				</td>
			</tr>
			
			<tr>
				<td>Your Email Address:</td>
				<td>
				<input type="text" name="email" placeholder="Enter Email Address" <?php if(isset($email)){ echo "value = '$email'"; } ?> />
				<?php
				if (isset($_SESSION['email_error'])) { ?>
					<span style="color: red;">Email is Required</span>
				<?php } ?>
				<?php 
				if (isset($_SESSION['invalid_email'])) { ?>
					<span style="color: red;">Invalid Email..</span>
				<?php } ?>
				</td>
			</tr>
			<tr>
				<td>Your Message:</td>
				<td>
				<textarea name="body"><?php if (isset($body)) {
					echo $body;
				}  ?></textarea>
				<?php
				if (isset($_SESSION['body_error'])) { ?>
					<span style="color: red;">Content is Required</span>
				<?php } ?>
				</td>
			</tr>

			<tr>
				<td></td>
				<td>
				<input type="submit" name="submit" value="send"/>
				</td>
			</tr>
		</table>
	<form>				
 </div>

</div>

<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>		

<?php unset($_SESSION['sendsuccess']) ?>
<?php unset($_SESSION['sendfailed']) ?>
<?php unset($_SESSION['email_error']) ?>
<?php unset($_SESSION['firstname_error']) ?>
<?php unset($_SESSION['body_error']) ?>
<?php unset($_SESSION['lastname_error']) ?>
<?php unset($_SESSION['invalid_email']) ?>