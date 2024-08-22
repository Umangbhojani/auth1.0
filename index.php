<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      background-color: #f4f4f4;
    }

    .card {
      width: 350px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
      overflow: hidden;
      margin: 10px;
      background-color: #fff;
    }

    .card-header {
      background-color: #333;
      padding: 16px;
      text-align: center;
    }

    .card-header .text-header {
      margin: 0;
      font-size: 18px;
      color: rgb(255, 255, 255);
    }

    .card-body {
      padding: 16px;
    }

    .form-group {
      margin-bottom: 10px;
    }

    .form-group label {
      display: block;
      font-size: 14px;
      color: #333;
      font-weight: bold;
      margin-bottom: 1px;
    }

    .form-group input[type="email"],
    .form-group input[type="password"] {
      width: 95%;
      padding: 8px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .btn-group {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 15px;
    }

    .btn {
      padding: 12px 24px;
      font-size: 16px;
      border: none;
      border-radius: 4px;
      background-color: #333;
      color: #fff;
      text-transform: uppercase;
      transition: background-color 0.2s ease-in-out;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #ccc;
      color: #333;
    }

    .new-user {
      font-size: 14px;
      color: #555;
    }

    .new-user a {
      color: #333;
      text-decoration: none;
      font-weight: bold;
      margin-left: 5px;
    }

    .new-user a:hover {
      text-decoration: underline;
    }

    .error {
      color: red;
      font-size: 14px;
      margin-top: 10px;
      text-align: center;
    }
    
    .success {
      color: green;
      font-size: 14px;
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  
<div class="card">
  <div class="card-header">
    <div class="text-header">Umang : Login</div>
  </div>
  <div class="card-body">
    <form action="" method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input required="" class="form-control px-2" name="email" id="email" type="email">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input required="" class="form-control" name="password" id="password" type="password">
      </div>
      <div class="btn-group">
        <button type="submit" class="btn">Login</button>
        <div class="new-user">
          New User? <a href="Register.php">Register</a>
        </div>
      </div>
    </form>
    
    <?php
session_start(); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    include("users.php");

    $email = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT * FROM register WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user["password"])) {
            $_SESSION['username'] = $user['username'];

            if ($email === 'admin123@gmail.com' && $password === 'admin') {
                header('Location: admin.php');
            } else {
                header("Location: Dashboard.php");
                exit();
            }
        } else {
            echo "<div class='error'>Invalid password.</div>";
        }
    } else {
        echo "<div class='error'>No user found with this email.</div>";
    }

    mysqli_close($conn);
}
?>

  </div>
</div>

</body>
</html>
