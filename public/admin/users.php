<?php 
/*
    På den här sidan kan admin göra CRUD för användare eller "users"
*/ 
?>
<?php require_once('includes/admin-header.php'); ?>
<?php include('src/users.inc.php'); ?>

<?php

    $users = new Users();
?>
<?php
    if(isset($_POST['saveUser'])){
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        
        $query = [$firstName, $lastName, $password, $email];
        $users->updateUser($query, $id);
    }

    if(isset($_POST['deleteUser'])){
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $users->deleteUser($id);
    }
   
   $usersRows = $users->loadUsers();
?>


<?php include_once('src/add-user.php'); ?>

<?php
   foreach($usersRows as $userRow){
?>
<form method="POST">
    <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">User Id: <?php echo($userRow['id']); ?></span>
                <input name="id" type="text" value="<?php echo($userRow['id']); ?>" style="display:none;">
            </div>
            <div class="input-group-prepend">
                <span class="input-group-text" id="">First name:</span>
            </div>
            <input name="firstName" type="text" class="form-control" value="<?php echo($userRow['firstName']); ?>">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">Last name:</span>
            </div>
            <input name="lastName" type="text" class="form-control" value="<?php echo($userRow['lastName']); ?>">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">Password:</span>
            </div>
            <input name="password" type="text" class="form-control" value="<?php echo($userRow['password']); ?>">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">E-mail:</span>
            </div>
            <input name="email" type="text" class="form-control" value="<?php echo($userRow['email']); ?>">

            <span class="input-group-text" id="">Date Added: <?php echo($userRow['dateAdded']); ?></span>

            <input type="submit" name="saveUser" class="form-control btn btn-success" value="Save">
            <input type="submit" name="deleteUser" class="form-control btn btn-danger" value="Delete">
    </div>
</form>
<hr><br>
<?php
}
?>
<?php include('includes/footer.php'); ?> 
