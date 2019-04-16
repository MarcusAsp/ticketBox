<?php 
/*
    På den här sidan kan admin scanna biljetter. Söka på biljetter och "blippa" bijetter
*/ 
?>
<?php include('includes/admin-header.php'); ?>
<?php include('src/tickets.inc.php'); ?>
<?php
  $ticket = new Ticket();

  if(isset($_POST['scanTicket'])){
    $ticketId = filter_input(INPUT_POST, 'ticketId', FILTER_SANITIZE_NUMBER_INT);

    $ticket->scanTicket($ticketId);
  }

  if(isset($_POST['search'])){
    $search = filter_input(INPUT_POST, 'searchInput', FILTER_SANITIZE_STRING);

    $ticketRows = $ticket->readTickets($search);
  }else{
  $ticketRows = $ticket->readTickets();
}
?>
<div class="input-group mb-3 searchForm">
<form method="POST">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"> Search:</span>
        <input name="searchInput" type="text" class="form-control">
      </div>
        <input type="submit" name="search" class="form-control btn btn-primary" value="Search">
    </div>
</form>
</div>
<?php
  foreach($ticketRows as $ticket){
?>
<form method="POST">
    <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"> Ticket number: <?php echo($ticket['ticketId']) ?></span>
                <input name="ticketId" type="hidden" value="<?php echo($ticket['ticketId']) ?>">
            </div>
            <div class="input-group-prepend">
                <span class="input-group-text"> User email: <?php echo($ticket['email']) ?></span>
            </div>
            <div class="input-group-prepend">
                <span class="input-group-text"> Event: <?php echo($ticket['even']) ?></span>
            </div>
            <?php
              if($ticket['usedTicket'] == 1){
                ?>
                <div class="input-group-prepend">
                  <label>Ticket already scanned</label>
                </div>
                <?php
              }else{
                ?>
                <div class="input-group-prepend">
                  <input type="submit" name="scanTicket" class="form-control btn btn-success" value="*Blip it*">
                </div>
                <?php
              }
            ?>
    </div>
</form>
<br>
<?php
}
?>

<?php include('includes/footer.php'); ?> 