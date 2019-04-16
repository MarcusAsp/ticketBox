<?php
/*
    Detta är sidan där användaren lägger till event i sin varukorg med hjälp cookies i javascript
    som heter "cart"
*/ 
?>
<?php include('includes/header.php'); ?>
<?php include('src/shop-events.inc.php'); ?>

<?php 

$eventShop = new Events();

$eventList = $eventShop->getEvents();
?>

<div class="shop-container">

<?php 
foreach($eventList as $event){
?>
<div class="card" style="width: 18rem;">
  <input type="text" style="display:none;" class="eventId" value="<?php echo($event['id']); ?>">
  <img class="card-img-top" src="https://picsum.photos/286/180" alt="<?php echo($event['name']); ?>">
  <div class="card-body">
    <h5 class="card-title eventName"><?php echo($event['name']); ?></h5>
    <p class="card-text">Price: <label class="eventPrice"><?php echo($event['price']); ?></label>kr</p>
    <p class="card-text">Location: <?php echo($event['location']); ?></p>
    <p class="card-text">Date: <?php echo($event['date']); ?></p>
    <p class="card-text">Tickets left: <?php echo($event['nrTickets']); ?></p>
    <button id="addToCart" class="btn btn-primary">Add to Cart</button>
  </div>
</div>
<?php 
}
?>

</div>

<?php include('includes/footer.php'); ?> 