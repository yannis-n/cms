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
                            Blank Page
                            <small>Subheading</small>
                        </h1>

                        <?php insert_categories(); ?>

                         <?php delete_category(); ?>

                        <div class="col-xs-6">
                          <form class="" action="" method="post">
                            <div class="form-group">
                              <label for="cat-title">Add Category:</label>
                              <input class="form-control" type="text" name="cat_title" value="">
                            </div>
                            <div class="form-group">
                              <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                          </form>

                          <?php if (isset($_GET['edit'])){
                            $cat_id = $_GET['edit'];
                            include "includes/update_categories.php";
                          } ?>

                        </div>
                        <div class="col-xs-6">
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php find_categories() ?>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/admin_footer.php" ?>
