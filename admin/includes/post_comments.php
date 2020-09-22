<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Author</th>
      <th>Comment</th>
      <th>Category</th>
      <th>Status</th>
      <th>Date</th>
      <th>In response to</th>
      <th>Approve</th>
      <th>Unapprove</th>
      <th>Delete</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
<?php
  $post_id = $_GET['post_id'];
  $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
  $comments = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($comments)){
    $comment_id          = $row['comment_id'];
    $comment_post_id     = $row['comment_post_id'];
    $comment_author      = $row['comment_author'];
    $comment_content     = $row['comment_content'];
    $comment_email       = $row['comment_email'];
    $comment_status      = $row['comment_status'];
    $comment_date        = $row['comment_date'];

    echo "<tr>";
    echo "<td>{$comment_id}</td>";
    echo "<td>{$comment_author}</td>";
    echo "<td>{$comment_content}</td>";
    echo "<td>{$comment_email}</td>";

    // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
    // $categories = mysqli_query($connection, $query);
    //
    // if ($categories){
    //   while($row = mysqli_fetch_assoc($categories)){
    //   $cat_title = $row['cat_title'];
    //   }
    // }else{
    //   $cat_title = "";
    // }
    // echo "<td>{$cat_title}</td>";
    echo "<td>{$comment_status}</td>";
    echo "<td>{$comment_date}</td>";

    $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
    $post = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($post)){
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
    }


    echo "<td><a href='./comments.php?source=post&post_id={$post_id}&approve={$comment_id}'>Approve</a></td>";
    echo "<td><a href='./comments.php?source=post&post_id={$post_id}&unapprove={$comment_id}'>Unapprove</a></td>";
    echo "<td><a href=''>Edit</a></td>";
    echo "<td><a href='./comments.php?source=post&post_id={$post_id}&delete={$comment_id}'>Delete</a></td>";
    echo "</tr>";
  } ?>
</tbody>
</table>

<?php
  if (isset($_GET['delete'])){
    $comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id={$comment_id}";
    $delete_query = mysqli_query($connection, $query);
    if (!$delete_query){
      die("The post could not be deleted!" . mysqli_error($connection));
    }else{
      header("Location: ./comments.php?source=post&post_id=".$_GET['post_id']);
    }
  }

  if (isset($_GET['unapprove'])){
    $comment_id = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id={$comment_id}";
    $approve_comment_query = mysqli_query($connection, $query);
    if (!$approve_comment_query){
      die("The Query failed!" . mysqli_error($connection));
    }else{
      header("Location: ./comments.php?source=post&post_id=".$_GET['post_id']);
    }
  }

  if (isset($_GET['approve'])){
    $comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id={$comment_id}";
    $unapprove_comment_query = mysqli_query($connection, $query);
    if (!$unapprove_comment_query){
      die("The Query failed!" . mysqli_error($connection));
    }else{
      header("Location: ./comments.php?source=post&post_id=".$_GET['post_id']);
    }
  }
?>
