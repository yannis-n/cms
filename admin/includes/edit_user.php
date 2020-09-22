<?php
  if (isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];

    if (!empty($user_id)){
      $query = "SELECT * FROM users WHERE user_id = {$user_id}";

      $user = mysqli_query($connection, $query);

      while($row = mysqli_fetch_assoc($user)) {
          $user_id          = $row['user_id'];
          $user_username     = $row['user_username'];
          $user_password     = $row['user_password'];
          $user_firstname      = $row['user_firstname'];
          $user_lastname     = $row['user_lastname'];
          $user_email       = $row['user_email'];
          $user_role      = $row['user_role'];
          $user_image        = $row['user_image'];
           }

      if (isset($_POST['update_user'])){
        $user_username     = $_POST['user_username'];
        $user_firstname      = $_POST['user_firstname'];
        $user_lastname     = $_POST['user_lastname'];
        $user_email       = $_POST['user_email'];
        $user_role      = $_POST['user_role'];

        // move_uploaded_file($post_image_temp, "../images/$post_image");
        //
        // if(empty($post_image)) {
        //
        //   $query = "SELECT * FROM posts WHERE post_id = $post_id ";
        //   $select_image = mysqli_query($connection,$query);
        //
        //   while($row = mysqli_fetch_array($select_image)) {
        //
        //      $post_image = $row['post_image'];
        //
        //   }
        //
        //
        // }
      //
      //
        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' =>12 ));

        $query = "UPDATE users SET ";
        $query .="user_username  = '{$user_username}', ";
        $query .="user_firstname = '{$user_firstname}', ";
        $query .="user_lastname   =  '{$user_lastname}', ";
        $query .="user_password   =  '{$user_password}', ";
        $query .="user_email = '{$user_email}', ";
        $query .="user_role = '{$user_role}' ";
        $query .= "WHERE user_id = {$user_id} ";

        $update_user = mysqli_query($connection,$query);

        confirmQuery($update_user);

      }
    }else{
      header("Location: index.php");
    }
  }


 ?>

<form action="" method="post" enctype="multipart/form-data">


  <div class="form-group">
     <label for="user_username">Username:</label>
      <input type="text" class="form-control" name="user_username" value="<?php echo $user_username ?>">
  </div>

  <div class="form-group">
     <label for="user_firstname">First Name:</label>
      <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
  </div>

  <div class="form-group">
     <label for="user_lastname">Last Name:</label>
      <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
  </div>

<div class="form-group">

  <select name="user_role" id="">
    <option value='<?php echo $user_role ?>'><?php echo $user_role; ?></option>
          <?php
          if($user_role == 'admin' ) {
    echo "<option value='subscriber'>Subscriber</option>";
          } else {
    echo "<option value='admin'>Admin</option>";
          }
        ?>
  </select>
  </div>

  <div class="form-group">
     <label for="user_email">Email:</label>
      <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
  </div>

  <div class="form-group">
     <label for="user_password">Password:</label>
      <input type="password" class="form-control" name="user_password" value="<?php echo $user_password ?>">
  </div>


   <div class="form-group">
      <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
  </div>


</form>
