<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
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
      box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
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
      color: #fff;
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

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"] {
      width: 95%;
      padding: 8px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 4px;
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
      width: 100%;
    }

    .btn:hover {
      background-color: #ccc;
      color: #333;
    }

    .error {
      color: red;
      font-size: 14px;
      margin-top: 10px;
    }

    .success {
      color: green;
      font-size: 14px;
      margin-top: 10px;
    }
  </style>
</head>

<body>

  <div class="card">
    <div class="card-header">
      <div class="text-header">Register</div>
    </div>
    <div class="card-body">
      <form action="" method="POST">
        <div class="form-group">
          <label for="username">Username:</label>
          <input required class="form-control" name="username" id="username" type="text">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input required class="form-control" name="email" id="email" type="email">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input required class="form-control" name="password" id="password" type="password">
        </div>
        <div class="form-group">
          <label for="contacts">Contacts:</label>
          <input required class="form-control" name="contacts" id="contacts" type="text">
        </div>
        <button type="submit" class="btn">Register</button>
      </form>

      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $contacts = $_POST["contacts"];

        include("users.php");
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $email = mysqli_real_escape_string($conn, $email);
        $checkQuery = "SELECT COUNT(*) AS count FROM register WHERE email = '$email'";
        $result = mysqli_query($conn, $checkQuery);

        if (!$result) {
          die("<div class='error'>Error checking email: " . mysqli_error($conn) . "</div>");
        }

        $row = mysqli_fetch_assoc($result);
        if ($row['count'] > 0) {
          echo '<div class="error">Error: Email already registered.</div>';
        } else {
          $username = mysqli_real_escape_string($conn, $username);
          $sql = "INSERT INTO register (username, email, password, contacts) VALUES ('$username', '$email', '$hashedPassword','$contacts')";

          if (mysqli_query($conn, $sql)) {
            echo '<div class="success">Registration successful! Redirecting to login...</div>';
            header('Refresh: 2; URL=index.php');
          } else {
            echo '<div class="error">Error: ' . mysqli_error($conn) . '</div>';
          }
        }

        mysqli_close($conn);
      }
      ?>
    </div>
  </div>

</body>

</html>