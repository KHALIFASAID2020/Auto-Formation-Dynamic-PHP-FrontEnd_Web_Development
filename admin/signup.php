

<?php include_once "../includes/functions.php"?>
<?php include_once "../includes/connection.php"?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="style/css" href="../style/style.css">
    <title>Signup</title>
</head>
<body>	
    <?php
			if(isset($_GET['message'])){
				$msg = $_GET['message'];
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				'.$msg.'
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>';
			}
		?>
		
		<div style="width:500px;margin:auto auto;  margin-top:250px;">
		<form method="post" class="form-signin">
      <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
      
	  <input type="text" name="author_name" id="input" class="form-control" required placeholder="Enter name"  autofocus>
	  
      <input type="email" name="author_email" id="inputEmail" class="form-control" required placeholder="Email address"  autofocus>
      
      <input type="password" name="author_password" id="inputPassword" class="form-control" required placeholder="Password" >
  
      <button class="btn btn-lg btn-primary btn-block" name="signup" type="submit">Sign Up</button>
     
    </form>
		</div>
		
		<?php 
			if(isset($_POST['signup'])){
				
				$author_name = mysqli_real_escape_string($conn, $_POST['author_name']);
				$author_email = mysqli_real_escape_string($conn, $_POST['author_email']);
				$author_password = mysqli_real_escape_string($conn, $_POST['author_password']);
				
				//checking for empty fields
				if(empty($author_name) OR empty($author_email) OR empty($author_password)){
					header("Location:signup.php?message=Empty+Fields");
					exit();
				}
				
				//checking for validity of email
			    if(!filter_var($author_email,FILTER_VALIDATE_EMAIL)){
					header("Location:signup.php?message=Please+Enter+A+Valid+email");
					exit();
				} else {
                    //if email exists
                    $sql="SELECT * FROM `author` WHERE author_email='$author_email' ";
                    $result=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        header("Location:signup.php?message=Email+Already+Exist");
                        exit();
                    }else{
                        //hashing password:
                        $hash=password_hash($author_password,PASSWORD_DEFAULT);

                        //signing the user
                        $sql="INSERT INTO `author` (`author_name`,`author_email`,`author_password`,`author_bio`,`author_role`) 
                        VALUES ('$author_name','$author_email','$hash','Enter Bio','author')";
                        if(mysqli_query($conn,$sql)){
                            header("Location:signup.php?message=Successfuly+register");
                            exit();
                        }
                        else{
                            header("Location:signup.php?message=Failed");
                            exit();
                        }
                    }
                }
}
?>

</body>
</html>