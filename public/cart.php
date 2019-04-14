<?php include('includes/header.php'); ?>

<?php 

if(isset($_POST['checkout'])){

}
?>

<div class="cart-container">
<div>
  <ul class="list-group">
  <?php 
  if(isset($_COOKIE['cart'])){

    $cartItem = json_decode($_COOKIE['cart'], true);
    $i = 0;
    foreach($cartItem as $key => $value){
  ?>
  <li class="list-group-item">
      <img src="https://picsum.photos/50/50" alt="Event image">
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
        <span class="input-group-text" id="inputGroup-sizing-default">Nr of tickets</span>
      </div>
        <input type="number" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
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


<div>
</div>
</div>

<?php

?>

<?php include('includes/footer.php'); ?> 