<?php include "includes/header.php" ?>

<?php include "includes/navigation.php" ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
              <?php
               if (isset($_GET['p_id']) && isset($_SESSION['user_role'])){
               $post_id = $_GET['p_id'];
               $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$post_id}";
               $send_query = mysqli_query($connection, $view_query);
              ?>
              <h1 class="page-header">
                  Page Heading
                  <small>Secondary Text</small>
              </h1>

              <?php
                if($_SESSION['user_role'] == 'admin'){
                  $query = "SELECT * FROM posts WHERE post_id=$post_id";
                } else {
                  $query = "SELECT * FROM posts WHERE post_id=$post_id AND post_status = 'publishes'";
                }
                $posts = mysqli_query($connection, $query);

                if (mysqli_num_rows($posts) >=1 ){
                  while ($row = mysqli_fetch_assoc($posts)){
                    $post_title = $row['post_title'];
                    $post_user = $row['post_user'];
                    $post_image = $row['post_image'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];


                 ?>

                 <!-- First Blog Post -->
                 <h2>
                     <a href="#"><?php echo $post_title ?></a>
                 </h2>
                 <p class="lead">
                     by <a href="index.php"><?php echo $post_user ?></a>
                 </p>
                 <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                 <hr>
                 <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                 <hr>
                 <p><?php echo $post_content ?></p>

                 <hr>

               <?php }

              include "includes/comments.php";

             }else{
               echo "No post available";
             }
             ?>




            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>


        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php" ?>


<?php } else {
  header("Location: index.php");
} ?>
