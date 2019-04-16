<?php
/*
    Detta är sidan där användare loggar in och köper sina utvalda biljetter
    beroende på vilka events som är tillagda i "cart" cookien.
*/ 
?>
<?php include('includes/header.php'); ?>
<?php include('src/cart.inc.php'); ?>

<?php 
if(isset($_COOKIE['cart'])){
  $cartItem = json_decode($_COOKIE['cart'], true);
}

if(isset($_POST['checkout'])){
  $loopCount = filter_input(INPUT_POST, 'loopCount', FILTER_SANITIZE_NUMBER_INT);
  $loopCount = (int)$loopCount;
  
  $user = $_SESSION['user'];

  $cartClass = new Cart();

    for($index = 0; $index < $loopCount; $index++){
      $number = strval($index);
      $eventId = filter_input(INPUT_POST, 'eventId'.$number, FILTER_SANITIZE_NUMBER_INT);
      $nrOfEvents = filter_input(INPUT_POST, 'nrOfEvents'.$number, FILTER_SANITIZE_NUMBER_INT);

      $eventId = (int)$eventId;
      $nrOfEvents = (int)$nrOfEvents;

      $cartClass->buyEvents($eventId, $nrOfEvents, $user);
    }
    setcookie("cart","",time()-3600);
    Header('Location: my-page.php');
}
?>

<div class="cart-container">
<div>
  <ul class="list-group">
  <?php
  if(isset($_COOKIE['cart'])){
    $i = 0;
    foreach($cartItem as $key => $value){
  ?>
  <li class="list-group-item">
      <img src="https://picsum.photos/900/50" alt="Event image">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
      
        <input name="eventId" type="hidden" value="<?php echo($cartItem[$key]['eventId']); ?>">
        <span class="input-group-text" id="inputGroup-sizing-default">Event: <?php echo($cartItem[$key]['eventName']); ?></span>
      </div>
      <input name="eventName" type="hidden" value="<?php echo($cartItem[$key]['eventName']); ?>">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">Price: <?php echo($cartItem[$key]['eventPrice']); ?></span>
      </div>
      <input name="eventPrice" type="hidden" value="<?php echo($cartItem[$key]['eventPrice']); ?>">
      <div class="input-group-prepend">
        <span class="input-group-text" >Nr of tickets</span>
      </div>
        <input type="number" id="nrOfTickets<?php echo($i); ?>" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="1">
    </div>
    <button class="btn btn-danger removeCartButton">Remove <label id="removeCartId<?php echo($i); ?>" style="display:none;"><?php echo($i); ?></label></button>
  </li>
  <?php
  $i++;
   }
}else{
?>
  <span class="form-control" id="inputGroup-sizing-default">Nothing in Cart</span>
<?php
}
?>
  </ul>
</div>


<?php
if(isset($_COOKIE['cart'])){
  ?>
  <div class="cartLog list-group-item">
  <div>
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
?>
<div>
<form method="POST">
<?php
$itemIndex = 0;
 foreach($cartItem as $key => $value){
?>
  <input name="eventId<?php echo($itemIndex); ?>" type="hidden" value="<?php echo($cartItem[$key]['eventId']); ?>">
  <input name="nrOfEvents<?php echo($itemIndex); ?>" id="nrOfEvents<?php echo($itemIndex); ?>" type="hidden" value="1">
<?php
$itemIndex++;
}
?>
<input name="loopCount" type="hidden" value="<?php echo($itemIndex); ?>">
<input type="submit" class="btn btn-outline-success" name="checkout" value="Buy">
</form>
</div>
<?php
}
}
?>
</div>

<?php include('includes/footer.php'); ?> 