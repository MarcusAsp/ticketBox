<button type="button" class="btn btn-primary alert alert-success" data-toggle="modal" data-target="#addEvent" data-whatever="@mdo">Add Event</button>

<div class="modal fade" id="addEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">Event Name</span>
            </div>
            <input name="eventName" type="text" class="form-control" value="">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">NR/Tickets</span>
            </div>
            <input name="nrTickets" type="text" class="form-control" value="">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">Location</span>
            </div>
            <input name="location" type="text" class="form-control" value="">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">Price</span>
            </div>
            <input name="price" type="text" class="form-control" value="">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">Date</span>
            </div>
            <input name="date" type="date" class="form-control" value="">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">Active Event</span>
            </div>
            <select name="activeEvent" class="form-control">
                    <option value='True' selected>True</option>
                    <option value='False'>False</option>
            </select>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="add">Add Event</button>
          </div>
        </form>
      </div>
      <?php 
        if(isset($_POST['add'])){
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $eventName = filter_input(INPUT_POST, 'eventName', FILTER_SANITIZE_STRING);
        $nrTickets = filter_input(INPUT_POST, 'nrTickets', FILTER_VALIDATE_INT);
        $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
        $date = preg_replace("([^0-9/\s\-])", "", $_POST['date']);
        $activeEvent = filter_input(INPUT_POST, 'activeEvent', FILTER_VALIDATE_INT);
            

        if($activeEvent == "True"){
            $activeEventNumber = 1;
        }else{
            $activeEventNumber = 0;
        }
          
        $query = [$eventName, $nrTickets, $location, $price, $date, $activeEventNumber];
        $event->createEvent($query);
        }
      ?>
    </div>
  </div>
</div>