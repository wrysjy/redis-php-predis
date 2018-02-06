<?php
if(!empty($_POST["register-user"])) {

	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) {
		if(empty($_POST[$key])) {
		$error_message = "All Fields are required";
		break;
		}
	}

	/* Password Matching Validation */
	if($_POST['password'] != $_POST['confirm_password']){ 
	$error_message = 'Passwords should be same<br>'; 
	}

	require '../predis/src/Autoloader.php';
    Predis\Autoloader::register();  

	$client = new Predis\Client(); 

	$username = 'user:'.$_POST['userName'];
	$pass = $_POST['password'];
	$cpass = $_POST['confirm_password'];
	$name = $_POST['Name'];
	$yob = $_POST['yob'];

	//$client -> HMSET('username',$username,'password',,$cpass,$name,$yob);
	echo $client -> HMSET($username,'password',$pass,'cpassword',$cpass,'name',$name,'yob',$yob);

	header("Location: success.html");
	die();	
	
}
?>
<html>
<head>
<title>User Registration</title>
<style>
body{
	width:610px;
	font-family:calibri;
}
.error-message {
	padding: 7px 10px;
	background: #fff1f2;
	border: #ffd5da 1px solid;
	color: #d6001c;
	border-radius: 4px;
}
.success-message {
	padding: 7px 10px;
	background: #cae0c4;
	border: #c3d0b5 1px solid;
	color: #027506;
	border-radius: 4px;
}
.demo-table {
	background: #d9eeff;
	width: 100%;
	border-spacing: initial;
	margin: 2px 0px;
	word-break: break-word;
	table-layout: auto;
	line-height: 1.8em;
	color: #333;
	border-radius: 4px;
	padding: 20px 40px;
}
.demo-table td {
	padding: 15px 0px;
}
.demoInputBox {
	padding: 10px 30px;
	border: #a9a9a9 1px solid;
	border-radius: 4px;
}
.btnRegister {
	padding: 10px 30px;
	background-color: #3367b2;
	border: 0;
	color: #FFF;
	cursor: pointer;
	border-radius: 4px;
	margin-left: 180px;
}
</style>
</head>
<body>
<form name="frmRegistration" method="post" action="">
<table border="0" width="500" align="center" class="demo-table">
<?php if(!empty($success_message)) { ?>	
<div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
<?php } ?>
<?php if(!empty($error_message)) { ?>	
<div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
<?php } ?>
<tr>
<td>User Name</td>
<td><input type="text" class="demoInputBox" name="userName" value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>"></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" class="demoInputBox" name="password" value=""></td>
</tr>
<tr>
<td>Confirm Password</td>
<td><input type="password" class="demoInputBox" name="confirm_password" value=""></td>
</tr>
<tr>
<td>Name</td>
<td><input type="text" class="demoInputBox" name="Name" value="<?php if(isset($_POST['Name'])) echo $_POST['Name']; ?>"></td>
</tr>
<tr>
<td>Year Of Birth</td>
<td><input type="text" class="demoInputBox" name="yob" value="<?php if(isset($_POST['yob'])) echo $_POST['yob']; ?>"></td>
</tr>
<tr>
<td colspan=2>
<input type="submit" name="register-user" value="Register" class="btnRegister"></td>
</tr>
</table>
</form>
</body></html>