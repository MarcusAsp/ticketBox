<?php include('includes/admin-header.php'); ?>
<?php include('src/events.inc.php'); ?>
<?php

    $event = new Event();

    if(isset($_POST['saveForm'])){
        
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $eventName = filter_input(INPUT_POST, 'eventName', FILTER_SANITIZE_STRING);
        $nrTickets = filter_input(INPUT_POST, 'nrTickets', FILTER_SANITIZE_NUMBER_INT);
        $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
        $date = preg_replace("([^0-9/\s\-])", "", $_POST['date']);
        $activeEvent = filter_input(INPUT_POST, 'activeEvent', FILTER_SANITIZE_STRING);
        
        echo "<script>confirm('Nu har jag klickat');</script>";
        if($activeEvent = "True"){
            $activeEventNumber = 1;
            echo "<script>confirm('Nu sätts den till 1');</script>";
        }else{
            $activeEventNumber = 0;
        }
        $query = [$eventName, $nrTickets, $location, $price, $date, $activeEventNumber];
        $event->saveForm($query, $id);
    }

    if(isset($_POST['deleteRow'])){
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $event->deleteRow($id);
    }
   
   $eventRows = $event->loadEvents();
?>

<?php
   foreach($eventRows as $event){
?>
<form method="POST">
    <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">Event Id: <?php echo($event['id']); ?></span>
                <input name="id" type="text" value="<?php echo($event['id']); ?>" style="display:none;">
            </div>

            <div class="input-group-prepend">
                <span class="input-group-text" id="">Event Name</span>
            </div>
            <input name="eventName" type="text" class="form-control" value="<?php echo($event['name']); ?>">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">NR/Tickets</span>
            </div>
            <input name="nrTickets" type="text" class="form-control" value="<?php echo($event['nrTickets']); ?>">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">Location</span>
            </div>
            <input name="location" type="text" class="form-control" value="<?php echo($event['location']); ?>">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">Price</span>
            </div>
            <input name="price" type="text" class="form-control" value="<?php echo($event['price']); ?>">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">Date</span>
            </div>
            <input name="date" type="date" class="form-control" value="<?php echo($event['date']); ?>">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">Active Event</span>
            </div>
            <select name="activeEvent" class="form-control">
                <?php
                if ($event['activeEvent'] == 0){
                    echo ("
                    <option value='True' selected>True</option>
                    <option value='False'>False</option>
                    ");
                }else{
                    echo ("
                    <option value='True'>True</option>
                    <option value='False' selected>False</option>
                    ");
                }
                ?>
            </select>
            <input type="submit" name="saveForm" class="form-control btn btn-success" value="Save">
            <input type="submit" name="deleteRow" class="form-control btn btn-danger" value="Delete">
    </div>
</form>
<?php
}
?>
<?php include('includes/footer.php'); ?> 