<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Fist Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Date</th>
      <th>Change to Admin</th>
      <th>Change to Subscriber</th>
      <th>Delete</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
<?php
  $query = "SELECT * FROM users";
  $comments = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($comments)){
    $user_id          = $row['user_id'];
    $user_username     = $row['user_username'];
    $user_password     = $row['user_password'];
    $user_firstname      = $row['user_firstname'];
    $user_lastname     = $row['user_lastname'];
    $user_email       = $row['user_email'];
    $user_role      = $row['user_role'];
    $user_image        = $row['user_image'];
    $user_date        = $row['user_date'];

    echo "<tr>";
    echo "<td>{$user_id}</td>";
    echo "<td>{$user_username}</td>";
    echo "<td>{$user_firstname}</td>";
    echo "<td>{$user_lastname}</td>";


    echo "<td>{$user_email}</td>";
    echo "<td>{$user_role}</td>";
    echo "<td>{$user_date}</td>";

    // $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
    // $post = mysqli_query($connection, $query);
    // while($row = mysqli_fetch_assoc($post)){
    // $post_id = $row['post_id'];
    // $post_title = $row['post_title'];
    // echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
    // }
    echo "<td><a href='users.php?change_to_admin={$user_id}'>Change to Admin</a></td>";
    echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Change To Subscriber</a></td>";

    echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
    echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
    echo "</tr>";
  } ?>
</tbody>
</table>

<?php
  if (isset($_GET['delete'])){
    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ){
      $user_id = escape($_GET['delete']);
      $query = "DELETE FROM users WHERE user_id={$user_id}";
      $delete_query = mysqli_query($connection, $query);
      if (!$delete_query){
        die("The post could not be deleted!" . mysqli_error($connection));
      }else{
        header("Location: users.php");
      }
    }
  }

  if (isset($_GET['change_to_admin'])){
    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ){
      $user_id = $_GET['change_to_admin'];
      $query = "UPDATE users SET user_role = 'admin' WHERE user_id={$user_id}";
      $change_to_admin_query = mysqli_query($connection, $query);
      if (!$change_to_admin_query){
        die("The Query failed!" . mysqli_error($connection));
      }else{
        header("Location: users.php");
      }
    }
  }

  if (isset($_GET['change_to_subscriber'])){
    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ){
      $user_id = $_GET['change_to_subscriber'];
      $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id={$user_id}";
      $change_to_subscriber_query = mysqli_query($connection, $query);
      if (!$change_to_subscriber_query){
        die("The Query failed!" . mysqli_error($connection));
      }else{
        header("Location: users.php");
      }
    }
  }
?>
