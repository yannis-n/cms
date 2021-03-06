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
                $per_page = 5;
                $count = ceil(countPublishedPosts() / $per_page);

                if ($count >= 1){
                  if (isset($_GET['page'])){
                    $page = $_GET['page'];
                  }else{
                    $page = 1;
                  }
                  $beggining = ($page - 1) * $per_page;

                  $query = "SELECT * FROM Posts WHERE post_status = 'published' LIMIT $beggining, $per_page";
                  $posts = mysqli_query($connection, $query);

                  while ($row = mysqli_fetch_assoc($posts)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_user = $row['post_user'];
                    $post_image = $row['post_image'];
                    $post_date = $row['post_date'];
                    $post_content = substr($row['post_content'], 0, 100);
                 ?>

                 <h2>
                     <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                 </h2>
                 <p class="lead">
                     by <a href="author_posts.php?author=<?php echo $post_user ?>&p_id=<?php echo $post_id ?>"><?php echo $post_user ?></a>
                 </p>
                 <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                 <hr>
                 <a href="post.php?p_id=<?php echo $post_id ?>">
                   <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                 </a>
                 <hr>
                 <p><?php echo $post_content ?></p>
                 <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                 <hr>

               <?php }
             } else {
               echo "No Posts avalaible";
             }
                ?>



            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>


        </div>
        <!-- /.row -->

        <ul class="pager">
          <?php
            for ($i = 1; $i <=$count; $i++){
              if ($i == $page){
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
              }else{
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
              }
            }
           ?>
        </ul>
        <hr>
<?php include "includes/footer.php" ?>
