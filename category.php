<?php include "includes/header.php" ?>

<?php include "includes/navigation.php" ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

              <h1 class="page-header">
                  Page Heading
                  <small>Secondary Text</small>
              </h1>

              <?php
                if (isset($_GET['category'])){
                  $post_category = $_GET['category'];
                }
                $stmt = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content  FROM Posts WHERE post_category_id = ? AND post_status = ?");
                $published = 'published';

                if (isset($stmt)){
                  mysqli_stmt_bind_param($stmt, "is", $post_category, $published);
                  mysqli_stmt_execute($stmt);
                  mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
                }

                  while (mysqli_stmt_fetch($stmt)){

                 ?>

                 <h2>
                     <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                 </h2>
                 <p class="lead">
                     by <a href=""><?php echo $post_author ?></a>
                 </p>
                 <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                 <hr>
                 <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                 <hr>
                 <p><?php echo $post_content ?></p>
                 <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                 <hr>

               <?php }

                ?>




            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>


        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php" ?>
