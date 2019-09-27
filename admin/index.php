<?php include_once "../includes/functions.php";
session_start();
if(isset($_SESSION['author_role'])){
?>

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
    <title>Admin Panel</title>
</head>
<body>

<nav class="navbar navbar-dark fixed-top bg-dark sticky-top shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="logout.php">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>

        
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
               <h6>Howdy<?php
                    echo $_SESSION['author_name']
               ?>|Your role is <?php  echo $_SESSION['author_role']   ?></h6>
            

        </div>
        <div id="admin-index-form">
            <h1>Your Profile</h1>
                <form method="POST">
                    <div class="form-group">
                
                    Name : <input name="author_name" type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $_SESSION['author_name']; ?>"  aria-describedby="emailHelp" placeholder="Enter Name">
                            <br>
                    Email :<input type="email" name="author_email" class="form-control" id="exampleInputEmail1" value="<?php echo $_SESSION['author_email']; ?>" aria-describedby="emailHelp" placeholder="Enter email">
                            <br>
                    Password :<input type="password"name="author_password" class="form-control"  id="exampleInputPassword1" placeholder="Password">
                            <br>
                    Your Bio :<textarea name="author_bio" class="form-control"  id="exampleFormControlTextarea1" rows="3"><?php echo $_SESSION['author_bio']; ?></textarea>
                </div>
                
                    <button type="submit"  name="update"  class="btn btn-primary">Update</button>
                </form>
        <?php

        if(isset($_POST['update'])){
            $author_name=mysqli_real_epace_string($conn,$_POST['author_name']);
            $author_email=mysqli_real_epace_string($conn,$_POST['author_email']);
            $author_password=mysqli_real_epace_string($conn,$_POST['author_password']);
            $author_bio=mysqli_real_epace_string($conn,$_POST['author_bio']);

            if(empty($author_name) OR empty($author_email) OR empty($author_password) OR empty($author_bio)){
               echo "Empty Fields";
            }else{
                // cheking if email is valid
                if(!filter_var($author_email,FILTER_VALIDATE_EMAIL)){
                    echo "Please enter a Valid email";
                }else{
                    //check if Password entred is new
                    if(empty($author_password)){
                        //user his dont want change hhis password
                        $sql="UPDATE `author` SET author_name='$author_name',author_email='$author_email',author_password='$author_password',author_bio='$author_bio' WHERE ";
                    }else{
                        //user want to change password

                    }
                }
            }
        }



?>

        </div>

    </main>

  </div>
</div>

</body>
</html>
<?php
}else{
header("Location:login.php?message=Please+Loggin");
}
?>

