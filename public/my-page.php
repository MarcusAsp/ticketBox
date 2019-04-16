<?php include('includes/header.php'); ?>
<div class="shop-container">
<?php 
if(!isset($_SESSION['user'])){
?>
    <h2>Log in to proceed</h2>
    <div>
    <button type="button" class="btn btn-outline-secondary text-dark" data-toggle="modal" data-target="#logInModal">Log in</button>
    <button type="button" class="btn btn-outline-secondary text-dark" data-toggle="modal" data-target="#signUpModal">Sign up</button>
    </div>
<?php
}else{

$user = new User();
$theUser = $_SESSION['user'];
$userTickets = $user->readUserTickets($theUser);
if($userTickets == null){
?>
<span class="form-control" id="inputGroup-sizing-default">No tickets recorded</span>
<?php
}else{
foreach($userTickets as $ticket){
?>
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="https://picsum.photos/286/180" alt="<?php echo($ticket['eventName']); ?>">
  <div class="card-body">
    <h5 class="card-title"><?php echo($ticket['eventName']); ?></h5>
    <p class="card-text">Location: <?php echo($ticket['location']); ?></p>
    <p class="card-text">Date: <?php echo($ticket['date']); ?></p>
    <br>
    <p class="card-text">Ticket Id: <?php echo($ticket['ticketId']); ?></p>
    <p class="card-text">Ticket bought: <?php echo($ticket['ticketBought']); ?></p>
  </div>
</div>
<?php 
}}}
?>
</div>
<?php include('includes/footer.php'); ?> 