<?php
  if (isset($_POST['create_comment'])){
    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment_content'];

    if(!empty($comment_content) && !empty($comment_author) && !empty($comment_email)){
      $query = "INSERT INTO comments(comment_post_id,
                                      comment_author,
                                      comment_email,
                                      comment_content,
                                      comment_status,
                                      comment_date)
                                      VALUES($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

      $create_comment_query = mysqli_query($connection, $query);
      if (!$create_comment_query){
        die("The Query failed!" . mysqli_error($connection));
      }

      if (!$update_comment_count){
        die("The Query failed!" . mysqli_error($connection));
      }
    } else {
      echo "<script>alert('Fields cannot be empty!')</script>";
    }
  }
 ?>

  <!-- Comments Form -->
  <div class="well">
      <h4>Leave a Comment:</h4>
      <form role="form" action="" method="post">
        <div class="form-group">
          <label for="comment_author">Author:</label>
          <input type="text" class="form-control" name="comment_author" value="">
        </div>
        <div class="form-group">
          <label for="comment_email">Email</label>
          <input type="text"class="form-control"  name="comment_email" value="">
        </div>
        <div class="form-group">
          <label for="comment_content">Comment</label>
          <textarea class="form-control" name="comment_content" rows="3"></textarea>
        </div>
        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
      </form>
  </div>

  <hr>
  <!-- Posted Comments -->
  <?php
  $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} AND comment_status ='approved' ORDER BY comment_id DESC";
  $select_comment_query = mysqli_query($connection , $query);
  if (!$select_comment_query){
    die("The Query failed!" . mysqli_error($connection));
  }

  while ($row = mysqli_fetch_assoc($select_comment_query)){
    $comment_date = $row['comment_date'];
    $comment_content = $row['comment_content'];
    $comment_author = $row['comment_author'];

   ?>
   <div class="media">
       <a class="pull-left" href="#">
           <img class="media-object" src="http://placehold.it/64x64" alt="">
       </a>
       <div class="media-body">
           <h4 class="media-heading"><?php echo $comment_author ?>
               <small><?php echo $comment_date ?></small>
           </h4>
           <?php echo $comment_content ?>
       </div>
   </div>

  <?php } ?>



  <!-- Comment -->
