<?php include "includes/admin_header.php" ?>

<?php
  if (isset($_SESSION['user_id'])){
    $user_id=$_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id = {$user_id}";

    $user = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($user)) {
        $user_id          = $row['user_id'];
        $user_username     = $row['user_username'];
        $user_password     = $row['user_password'];
        $user_firstname      = $row['user_firstname'];
        $user_lastname     = $row['user_lastname'];
        $user_email       = $row['user_email'];
        $user_image        = $row['user_image'];
         }

         if (isset($_POST['update_profile'])){
           $user_username     = $_POST['user_username'];
           $user_firstname      = $_POST['user_firstname'];
           $user_lastname     = $_POST['user_lastname'];
           $user_email       = $_POST['user_email'];

           $query = "UPDATE users SET ";
           $query .="user_username  = '{$user_username}', ";
           $query .="user_firstname = '{$user_firstname}', ";
           $query .="user_lastname   =  '{$user_lastname}', ";
           $query .="user_email = '{$user_email}' ";
           $query .= "WHERE user_id = {$user_id} ";

           $update_profile = mysqli_query($connection,$query);

           confirmQuery($update_profile);

         }
  }


 ?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                      <h1 class="page-header">
                          Profile
                      </h1>


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
                           <label for="user_email">Email:</label>
                            <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
                        </div>

                        <div class="form-group">
                           <label for="user_password">Password:</label>
                            <input type="password" class="form-control" name="user_password">
                        </div>


                         <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_profile" value="Update profile">
                        </div>


                      </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/admin_footer.php" ?>
