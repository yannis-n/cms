<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                      <h1 class="page-header">
                          Comments
                      </h1>


                          <?php if (isset($_GET['source'])){
                            $source = $_GET['source'];
                          }else{
                            $source='';
                          }
                          switch($source){

                          case 'post':
                          include "includes/post_comments.php";
                          break;

                          case 'edit_post':
                          include "includes/edit_post.php";
                          break;

                          default:
                          include "includes/view_comments.php";
                          break;
                          }

                           ?>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/admin_footer.php" ?>
