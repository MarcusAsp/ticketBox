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
    <p class="card-text">Plats: <?php echo($event['location']); ?></p>
    <p class="card-text">Datum: <?php echo($event['date']); ?></p>
    <p class="card-text">Biljetter kvar: <?php echo($event['nrTickets']); ?>st</p>
    <button id="addToCart" class="btn btn-primary">Add to Cart</button>
  </div>
</div>
<?php 
}
?>

</div>

<?php include('includes/footer.php'); ?> 