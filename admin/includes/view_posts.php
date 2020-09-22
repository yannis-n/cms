<?php include "delete_modal.php";?>

<?php
  if (isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $checkBoxValue){
      $bulk_options = $_POST['bulk_options'];

      switch($bulk_options){
        case 'published':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}";
        $update_to_published_status = mysqli_query($connection, $query);
        confirmQuery($update_to_published_status);
        break;

        case 'draft':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}";
        $update_to_draft_status = mysqli_query($connection, $query);
        confirmQuery($update_to_draft_status);
        break;

        case 'delete':
        $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}";
        $delete_posts = mysqli_query($connection, $query);
        confirmQuery($delete_posts);
        break;

        case 'clone':
        $query = "SELECT * FROM posts WHERE post_id = {$checkBoxValue}";
        $select_post = mysqli_query($connection, $query);
        confirmQuery($select_post);

        while($row = mysqli_fetch_assoc($select_post)){
          $post_id = $row['post_id'];
          $post_category_id = $row['post_category_id'];
          $post_title = $row['post_title'];
          $post_author = $row['post_author'];
          $post_date = $row['post_date'];
          $post_image = $row['post_image'];
          $post_content = $row['post_content'];
          $post_comment_count = $row['post_comment_count'];
          $post_status = $row['post_status'];
          $post_tags = $row['post_tags'];

          $query = "INSERT INTO posts(post_title, post_author, post_category_id, post_date, post_image,post_content,post_tags,post_status) ";
          $query .= "VALUES('{$post_title}', '{$post_author}', '{$post_category_id}', now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') ";
          $create_post_query = mysqli_query($connection, $query);
          confirmQuery($create_post_query);
        break;
        }
      }
    }
  }
 ?>

<form class="" action="" method="post">
  <table class="table table-bordered table-hover">

    <div id="bulkOptionsContainer" class="col-xs-4">
      <select class="form-control" name="bulk_options">
        <option value="">Select Option</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="clone">Clone</option>
        <option value="delete">Delete</option>
      </select>
    </div>
    <div class="col-xs-4">

    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>

     </div>

    <thead>
      <tr>
        <th><input id="selectAllBoxes" type="checkbox"></th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Commnents</th>
        <th>Date</th>
        <th>Views</th>
        <th>View Post</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
  <?php
    $query = "SELECT * FROM posts ORDER BY post_id DESC";
    $posts = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($posts)){
      $post_id = $row['post_id'];
      $post_category_id = $row['post_category_id'];
      $post_title = $row['post_title'];
      $post_author = $row['post_author'];
      $post_user = $row['post_user'];
      $post_date = $row['post_date'];
      $post_image = $row['post_image'];
      $post_content = $row['post_content'];
      $post_views_count = $row['post_views_count'];
      $post_status = $row['post_status'];
      $post_tags = $row['post_tags'];

      echo "<tr>";
      ?>
      <td><input class='checkBoxes' id='selectAllBoxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $post_id ?>"></td>
      <?php
      echo "<td>{$post_id}</td>";

      if(!empty($post_author)) {

           echo "<td>$post_author</td>";


      } elseif(!empty($post_user)) {

          echo "<td>$post_user</td>";


      }      echo "<td>{$post_title}</td>";

      $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
      $categories = mysqli_query($connection, $query);

      if ($categories){
        while($row = mysqli_fetch_assoc($categories)){
        $cat_title = $row['cat_title'];
        }
      }else{
        $cat_title = "";
      }
      echo "<td>{$cat_title}</td>";
      echo "<td>{$post_status}</td>";
      echo "<td><img width='100' src='../images/{$post_image}'></td>";
      echo "<td>{$post_tags}</td>";

      $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
      $send_comment_query = mysqli_query($connection, $query);
      $count_comments = mysqli_num_rows($send_comment_query);



      echo "<td><a href='./comments.php?source=post&post_id={$post_id}'>{$count_comments}</a></td>";
      echo "<td>{$post_date}</td>";
      echo "<td>{$post_views_count}</td>";
      echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
      echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
      echo "<td><a class='delete-link' rel={$post_id}>Delete</a></td>";
      echo "</tr>";
    } ?>
  </tbody>
  </table>
</form>

<?php if (isset($_GET['delete'])){
  $post_id = $_GET['delete'];
  $query = "DELETE FROM posts WHERE post_id={$post_id}";
  $delete_query = mysqli_query($connection, $query);
  if (!$delete_query){
    die("The post could not be deleted!" . mysqli_error($connection));
  }else{
    header("Location: posts.php");
  }
} ?>

<script type="text/javascript">

$(document).ready(function(){
  $('.delete-link').on('click', function(){
    let id = $(this).attr('rel');
    let deleteURL = "posts.php?delete=" + id;
    $('.modal_delete_link').attr('href', deleteURL);
    $('#myModal').modal('show');
  })
})

</script>
