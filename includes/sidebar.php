<div class="col-md-4">

    <!-- Blog Search Well -->



    <div class="well">
        <h4>Blog Search</h4>
        <form class="" action="search.php" method="post">
          <div class="input-group">
              <input name="search" type="text" class="form-control">
              <span class="input-group-btn">
                  <button name="submit" class="btn btn-default" type="submit">
                      <span class="glyphicon glyphicon-search"></span>
              </button>
              </span>
          </div>
        </form>
        <!-- /.input-group -->
    </div>

    <?php
      $query = "SELECT * FROM Categories";
      $categories = mysqli_query($connection, $query);
     ?>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                  <?php while($row = mysqli_fetch_assoc($categories)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];

                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                  } ?>

                </ul>
            </div>
        </div>
    </div>

    <?php if (!$_SESSION['user_username']){ ?>
      <div class="well">
          <h4>Log in </h4>
          <form class="" action="includes/login.php" method="post">
            <div class="form-group">
              <input name="user_username" type="text" class="form-control" placeholder="Enter Username">
            </div>
            <div class="input-group">
                <input type="password" name="user_password" class="form-control" value="" placeholder="Enter Password">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" name="login">Submit</button>
                </span>
            </div>
          </form>
          <!-- /.input-group -->
      </div>
    <?php }else{ ?>
      <div class="well">
          <h4>Logged in as <?php echo $_SESSION['user_username'] ?> </h4>
          <a href="includes/logout.php" class="btn btn-primary">Logout</a>
      </div>
    <?php } ?>
    <!-- Side Widget Well -->
    <?php include "widget.php" ?>

</div>
