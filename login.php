<?php
session_start();

if (isset($_SESSION["login"])) {
  header("Location: index.php");
}
include('inc/config.php');

if (isset($_POST["m_login"])) {
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $sql = $conn->query("SELECT * FROM tb_masyarakat where username='$user'");

  //cek username
  if (mysqli_num_rows($sql) === 1) {

    //cek password
    $row = mysqli_fetch_assoc($sql);
    if (password_verify($pass, $row["password"])) {

      //cek session
      $_SESSION["login"] = true;
      $_SESSION['username'] = $row['username'];
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['id_masyarakat'] = $row['id_masyarakat'];

      header('location:./');
      exit;
    }
  }

  $error = true;
}


?>

<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Responsive Login and Signup Form </title>

        <!-- CSS -->
        <link rel="stylesheet" href="css/style.css">
                
        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
                        
    </head>
    <body>
        <section class="container forms">
            <div class="form login">
                <div class="form-content">
                    <header>Login</header>
                    <?php if (isset($error)) : ?>
                    <p style="color:red; font-style:italic; text-align:center;">Username / Password salah</p>
                  <?php endif; ?>
                    <form action="" method="POST">
                        <div class="field input-field">
                            <input type="text" placeholder="Username" name="user" class="input">
                        </div>

                        <div class="field input-field">
                            <input type="password" placeholder="Password" name="pass" class="password">
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="field button-field">
                            <button type="submit" name="m_login">Login</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Login sebagai <a href="#" class="link signup-link">Admin</a></span>
                    </div>

                    <div class="line"></div>

                    <div class="form-link">
                    <span>Belum punya Akun? <a href="daftar.php" >Daftar</a></span>
                      </div>
                </div>

            </div>

            <!-- Signup Form -->

            <div class="form signup">
                <div class="form-content">
                    <header>Admin</header>
                    <form action="" method="POST">
                        <div class="field input-field">
                            <input type="text" placeholder="Username" name="username" class="input">
                        </div>

                        <div class="field input-field">
                            <input type="password" placeholder="Password" name="password" class="password">
                        </div>

                        <div class="field button-field">
                            <button type="submit" name="login">Login</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Login sebagai <a href="#" class="link login-link">Masyarakat</a></span>
                    </div>
                </div>                

            </div>
        </section>

        <!-- JavaScript -->
        <script src="js/script.js"></script>
    </body>
</html>

<?php

include('inc/config.php');

if(isset($_POST["login"])){
  $user = $_POST['username'];
  $pass = $_POST['password'];
    $sql = $conn->query("SELECT * FROM tb_admin where username='$user'");

      //cek username
      if(mysqli_num_rows($sql) === 1 ) {

        //cek password
        $row = mysqli_fetch_assoc($sql);
	       if(password_verify($pass, $row["password"])){

           //cek session
           $_SESSION["login"] = true;
           if ($row['role']  == "Administrator") {
            $_SESSION['username'] = $username;
            $_SESSION['nama']= $row['nama'];
            $_SESSION['id_admin']  = $row['id_admin'];
            $_SESSION['role']    = $row['role'];

            header('location:./');
            exit;
        } 
        elseif ($row['role'] == "Petugas") {
          $_SESSION['username'] = $username;
          $_SESSION['nama']= $row['nama'];
          $_SESSION['id_admin']  = $row['id_admin'];
          $_SESSION['role']    = $row['role'];

            header('location:./');
            exit;
		  }
		}
  }

    $error = true;
	}


 ?>
