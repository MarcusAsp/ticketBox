<?php 
/*
    På den här sidan kan admin hantera event med hjälp av POST formulär som tar in olika värden som filtreras och sparas i databasen
    *CRUD* fungerar till 100%
*/ 
?>

<?php require_once('includes/admin-header.php'); ?>
<?php include('src/events.inc.php'); ?>
<?php

    $event = new Event();

    if(isset($_POST['saveForm'])){
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $eventName = filter_input(INPUT_POST, 'eventName', FILTER_SANITIZE_STRING);
        $nrTickets = filter_input(INPUT_POST, 'nrTickets', FILTER_VALIDATE_INT);
        $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
        $date = preg_replace("([^0-9/\s\-])", "", $_POST['date']);
        $activeEvent = filter_input(INPUT_POST, 'activeEvent', FILTER_SANITIZE_STRING);
        
        /*
            Om eventet är aktivt eller "true" så kommer den printa ut 1. Och om det är false så blir värdet 0
            och stoppas sedan in i databasen. 
            (Detta läses in längre ner på sidan)
        */ 

        if($activeEvent == "True"){
            $activeEventNumber = 1;
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

  <?php  include('src/add-event.php'); ?>

<?php
/*
   Loopar ut alla rader som stoppats in i arrayen $eventRows och sätter värdena i taggarna som angivits
*/ 
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
   </div>
   <div class="input-group mb-3">
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
                /*
                    Om eventet är aktivt så kommer den printa ut True. Och likadant tvärt om
                */ 
                if ($event['activeEvent'] == 0){
                    echo ("
                    <option value='True' >True</option>
                    <option value='False' selected>False</option>
                    ");
                }else{
                    echo ("
                    <option value='True' selected>True</option>
                    <option value='False'>False</option>
                    ");
                }
                ?>
            </select>
            <input type="submit" name="saveForm" class="form-control btn btn-success" value="Save">
            <input type="submit" name="deleteRow" class="form-control btn btn-danger" value="Delete">
    </div>
</form>
<hr><br>
<?php
}
?>
<?php include('includes/footer.php'); ?> 