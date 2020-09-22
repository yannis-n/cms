<?php include "db.php" ?>
<?php session_start(); ?>
<?php if (isset($_POST['login'])){
  $user_username = $_POST['user_username'];
  $user_password = $_POST['user_password'];

  $user_username = mysqli_real_escape_string($connection, $user_username);
  $user_password = mysqli_real_escape_string($connection, $user_password);

  $query = "SELECT * FROM users WHERE user_username = '{$user_username}'";
  $select_user_query = mysqli_query($connection, $query);

  if (!$select_user_query){
    die("Query Failed! ". mysqli_error($connection));
  }

  while ($row = mysqli_fetch_assoc($select_user_query)){
    $db_user_id          = $row['user_id'];
    $db_user_username     = $row['user_username'];
    $db_user_password     = $row['user_password'];
    $db_user_firstname      = $row['user_firstname'];
    $db_user_lastname     = $row['user_lastname'];
    $db_user_email       = $row['user_email'];
    $db_user_role      = $row['user_role'];
  }


  if (password_verify($user_password, $db_user_password)){
    $_SESSION['user_id'] =  $db_user_id;
    $_SESSION['user_username'] =  $db_user_username;
    $_SESSION['user_firstname'] =  $db_user_firstname;
    $_SESSION['user_lastname'] =  $db_user_lastname;
    $_SESSION['user_role'] =  $db_user_role;
    header("Location: ../admin/index.php");
  }else{
    header("Location: ../index.php");

  }


} ?>
