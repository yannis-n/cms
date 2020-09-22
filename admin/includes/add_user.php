
<?php


   if(isset($_POST['create_user'])) {

      $user_username        = escape($_POST['user_username']);
      $user_firstname       = escape($_POST['user_firstname']);
      $user_lastname        = escape($_POST['user_lastname']);
      $user_role          = escape($_POST['user_role']);
      $user_email         = escape($_POST['user_email']);
      $user_password      = escape($_POST['user_password']);
      $post_date         = escape(date('d-m-y'));

      $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' =>12 ));

      $query = "INSERT INTO users(user_username, user_firstname, user_lastname, user_date, user_role, user_email, user_password) ";
      $query .= "VALUES('{$user_username}', '{$user_firstname}', '{$user_lastname}', now(),'{$user_role}','{$user_email}','{$user_password}') ";
      $create_user_query = mysqli_query($connection, $query);
      confirmQuery($create_user_query);
      echo "User added: ". "<a href='users.php'>View users</a>" ;
   }




?>

    <form action="" method="post" enctype="multipart/form-data">


      <div class="form-group">
         <label for="user_username">Username:</label>
          <input type="text" class="form-control" name="user_username">
      </div>

      <div class="form-group">
         <label for="user_firstname">First Name:</label>
          <input type="text" class="form-control" name="user_firstname">
      </div>

      <div class="form-group">
         <label for="user_lastname">Last Name:</label>
          <input type="text" class="form-control" name="user_lastname">
      </div>


       <div class="form-group">
         <select name="user_role" id="">
             <option value="admin">Admin</option>
             <option value="subscriber">Subscriber</option>
         </select>
      </div>

      <div class="form-group">
         <label for="user_email">Email:</label>
          <input type="email" class="form-control" name="user_email">
      </div>

      <div class="form-group">
         <label for="user_password">Password:</label>
          <input type="password" class="form-control" name="user_password">
      </div>

      <!-- <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div> -->

      <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="Add user">
      </div>


</form>
