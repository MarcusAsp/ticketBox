<?php 
/*
    På den här sidan kan admin göra CRUD för biljetter eller "tickets"
*/ 
?>
<?php require_once('includes/admin-header.php'); ?>
<?php include('src/tickets.inc.php'); ?>

<?php

    $ticket = new Ticket();
?>
<?php
    if(isset($_POST['saveTicket'])){
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);
        $eventId = filter_input(INPUT_POST, 'eventId', FILTER_SANITIZE_NUMBER_INT);
        
        
        $query = [$userId, $eventId];
        $ticket->updateTicket($query, $id);
    }

    if(isset($_POST['deleteTicket'])){
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $eventId = filter_input(INPUT_POST, 'eventId', FILTER_SANITIZE_NUMBER_INT);
        $ticket->deleteTicket($id, $eventId);
    }
   
$ticketRows = $ticket->loadTickets();

include_once('src/add-ticket.php');

foreach($ticketRows as $ticketRow){
?>
<form method="POST">
    <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">Ticket Id: <?php echo($ticketRow['id']); ?></span>
                <input name="id" type="text" value="<?php echo($ticketRow['id']); ?>" style="display:none;">
            </div>
            <div class="input-group-prepend">
                <span class="input-group-text" id="">User Id:</span>
            </div>
            <input name="userId" type="text" class="form-control" value="<?php echo($ticketRow['userId']); ?>">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">Event Id:</span>
            </div>
            <input name="eventId" type="text" class="form-control" value="<?php echo($ticketRow['eventId']); ?>">

            <input type="submit" name="saveTicket" class="form-control btn btn-success" value="Save">
            <input type="submit" name="deleteTicket" class="form-control btn btn-danger" value="Delete">
    </div>
</form>
<hr><br>
<?php
}
?>
<?php include('includes/footer.php'); ?> 
