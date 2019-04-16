<?php
/*
    Detta är landnings sidan för användare
*/ 
?>
<?php include('includes/header.php'); ?>

<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="https://picsum.photos/800/300" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://picsum.photos/800/300" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://picsum.photos/800/300" alt="Third slide">
    </div>
  </div>
</div>

<?php
    if(isset($_SESSION['user'])){
        echo "<h5>Välkommen ".$_SESSION['user']."</h5>";
    }else{
        echo "<h5>Inte inloggad</h5>";
    }
?>

<?php include('includes/footer.php'); ?> 