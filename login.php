<?php
session_start();
session_unset();
ob_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<h2 style="color:aliceblue;">
<?php
if (isset($_POST['join']) and isset($_POST['name']) and strlen($_POST['name'])>5 and  strlen($_POST['email'])>5 and isset($_POST['email'])){
    // session_start();
    require_once "./db/users.php";
    $join = new users;

    $join->setEmail($_POST['email']);
    $join->setName($_POST['name']);	
    $join->setPass(123);
	$join->setLoginStatus(1);
	$join->setLastLogin(time());
    $data = $join->getUserEmail();

    if(is_array($data) and count($data)>0){
        $join->setId($data['id']);
        if($join->updatedloginStatus()){
            echo "userLogin";
            $_SESSION['user'][$data['id']] = $data;
            // include_once "./chatroom.php";
			header("location: chatroom.php");

        }else{
            echo "field to login";
        }
    }else{
        if ($join->save()){
            // $join->setId($lastid);
            $_SESSION['user'][$data['id']] = $data;
			// include_once "./chatroom.php";
			header("location: chatroom.php");
            echo "saved";
        }else{
            echo "no saved";
        }
    }


  
}


?>
</h2>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Regstration</h3>
		
			</div>
			<div class="card-body">
				<form method="POST" action="login.php">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="name" class="form-control" placeholder="name">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="email" name="email" class="form-control" placeholder="Email">
					</div>
					
					<div class="form-group">
						<input type="submit" name="join" value="Login" class="btn-block btn float-right login_btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>