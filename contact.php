 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->

    <?php  include "includes/navigation.php"; ?>

<?php
  if (isset($_POST['submit'])){
      $to = $_POST['email'];
      $subject = $_POST['subject'];
      $body = $_POST['body'];

      $to = mysqli_real_escape_string($connection, $to);
      $subject = mysqli_real_escape_string($connection, $subject);
      $body = mysqli_real_escape_string($connection, $body);

      $msg = wordwrap($body,70);

      // send email
      mail($to, $subject,$msg);


    }
 ?>
    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="" method="post" autocomplete="off">
                        <div class="form-group">
                           <label for="email" class="sr-only">Email</label>
                           <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                           <label for="subject" class="sr-only">Subject:</label>
                           <input type="text" name="subject" id="subject" class="form-control" placeholder="">
                         </div>
                         <div class="form-group">
                            <label for="body" class="sr-only">Content:</label>
                            <textarea name="body" id="editor" rows="8" cols="80"></textarea>
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
