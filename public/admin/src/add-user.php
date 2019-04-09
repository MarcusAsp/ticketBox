<button type="button" class="btn btn-primary alert alert-success" data-toggle="modal" data-target="#addUser" data-whatever="@mdo">Add user</button>

<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
          
            <div class="input-group-prepend">
              <span class="input-group-text" id="">First name:</span>
            </div>
            <input name="firstName" type="text" class="form-control" value="">

            <div class="input-group-prepend">
              <span class="input-group-text" id="">Last name:</span>
            </div>
            <input name="lastName" type="text" class="form-control" value="">

            <div class="input-group-prepend">
              <span class="input-group-text" id="">Password:</span>
            </div>
            <input name="password" type="text" class="form-control" value="">

            <div class="input-group-prepend">
              <span class="input-group-text" id="">E-mail:</span>
            </div>
            <input name="email" type="text" class="form-control" value="">

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="add">Add User</button>
          </div>
          </div>
        </form>
<?php
    if (isset($_POST['add'])) {
      $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
      $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

      $password = hash('sha256', $password);

      $query = [$firstName, $lastName, $password, $email];
      $users->createUser($query);
     }
?>
    </div>
  </div>
</div>