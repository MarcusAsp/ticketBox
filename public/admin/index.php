<?php include('includes/admin-header.php'); ?>

<?php
    if(isset($_SESSION['admin'])){
        echo "<h5>Välkommen ".$_SESSION['admin']."</h5>";
    }else{
        echo ('
        <div class="loginAdmin">
        <div>
          <div class="card-body">
            <form method="POST">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Admin</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="Username" name="adminusername">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="adminpassword">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10">
                  <input type="submit" class="btn btn-primary" value="Sign in" name="logInAdmin">
                </div>
              </div>
            </form>
          </div>
        </div>
        </div>
        ');
    }
?>

<?php include('includes/footer.php'); ?> 