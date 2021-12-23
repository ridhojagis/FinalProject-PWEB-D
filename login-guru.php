<!-- <?php
session_start();

// if (isset($_SESSION['email'])) {
//   header('Location: table.php');
// }

include_once("database/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

	$stmt = $conn->prepare('SELECT * FROM guru WHERE guru_email= ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row["guru_password"] == $password) {
              $_SESSION['email'] = $row['guru_email'];
			  $_SESSION['user_type'] = 'guru';
			  
              header('Location: profil-guru.php');
            } else {
                echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
            }
        }
    } else {
        echo "<script>alert('Email anda tidak dapat ditemukan. Silahkan coba lagi!')</script>";
    }
}
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Halaman Login Guru</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

  <!-- Template Main CSS File -->
  <link rel="stylesheet" type="text/css" href="assets/css/login.css">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="my-login-page" style="background-image: url(./assets/img/bg-login.jpg);">
	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top d-flex align-items-center ">
		<div class="container d-flex align-items-center justify-content-between">
	
		  <h1 class="logo"><a href="index.php">Sekolahku</a></h1>
		  <!-- Uncomment below if you prefer to use an image logo -->
		  <!-- <a href=index.php" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
	
		  <nav id="navbar" class="navbar">
			<ul>
			  <li><a class="nav-link scrollto" href="index.php">Home</a></li>
			  <li>
				<div class="dropdown">
				  <a class="getstarted scrollto active dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="login_carijasa.php">Login</a>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item" href="login-guru.php">Guru</a>
				    <a class="dropdown-item" href="login-siswa.php">Siswa</a>
				  </ul>
			  </li>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		  </nav>
	
		</div>
	  </header>
	  <!-- End Header -->
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<!-- <a href="index.php"><img src="assets/img/logo-viufinder.png" alt="logo"></a> -->
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title text-center">LOGIN GURU</h4>
							<form action="" method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="email">E-mail</label>
									<input id="email" type="email" class="form-control" placeholder="type email" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" placeholder="type password" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Remember Me
											<a href="forgot.php" class="float-right">
												Forgot Password?
											</a>
										</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
								<div class="mt-4 text-center">
									Don't have an account? <a href="register-guru.php">Create One</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="assets/js/login.js"></script>

</body>
</html>
