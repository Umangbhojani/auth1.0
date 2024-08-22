<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    .navbar {
      width: 98%;
      background-color: #333;
      padding: 16px;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      position: relative;
    }

    .user-icon {
      color: white;
      cursor: pointer;
      font-size: 18px;
      display: flex;
      align-items: center;
    }

    .user-icon img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      margin-right: 8px;
    }

    .dropdown {
      display: none;
      position: absolute;
      top: 50px;
      right: 16px;
      background-color: white;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 4px;
      z-index: 1000;
    }

    .dropdown a {
      display: block;
      padding: 12px;
      text-decoration: none;
      color: #333;
      font-size: 14px;
    }

    .dropdown a:hover {
      background-color: #f4f4f4;
    }

    .dropdown .logout {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .dropdown .logout img {
      width: 16px;
      height: 16px;
      margin-left: 8px;
    }

    .user-icon.active + .dropdown {
      display: block;
    }
  </style>
</head>
<body>

<?php 
session_start();
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: index.php");
    exit();
}

echo '
<div class="navbar">
  <div class="user-icon" onclick="toggleDropdown()">
    <img src="https://via.placeholder.com/30" alt="User Icon">
   '.$username.'
  </div>
  <div class="dropdown">
    <a href="#">'.$username.'</a>
    <a href="index.php" class="logout">Logout <img src="https://via.placeholder.com/16/logout.png" alt="Logout Icon"></a>
  </div>
</div>';
?>

<script>
  function toggleDropdown() {
    const userIcon = document.querySelector('.user-icon');
    userIcon.classList.toggle('active');
  }

  window.onclick = function(event) {
    if (!event.target.matches('.user-icon') && !event.target.closest('.dropdown')) {
      const dropdowns = document.getElementsByClassName("dropdown");
      for (let i = 0; i < dropdowns.length; i++) {
        let openDropdown = dropdowns[i];
        if (openDropdown.style.display === "block") {
          openDropdown.style.display = "none";
        }
      }
      const userIcon = document.querySelector('.user-icon');
      userIcon.classList.remove('active');
    }
  }
</script>

</body>
</html>
