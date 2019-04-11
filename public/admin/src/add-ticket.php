<button type="button" class="btn btn-primary alert alert-success" data-toggle="modal" data-target="#addTicket" data-whatever="@mdo">Add Ticket</button>

<div class="modal fade" id="addTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Ticket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">User Id:</span>
            </div>
            <input name="userId" type="text" class="form-control" value="">

            <div class="input-group-prepend">
                <span class="input-group-text" id="">Event Id:</span>
            </div>
            <input name="eventId" type="text" class="form-control" value="">

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="add">Add Ticket</button>
          </div>
        </form>
      </div>
      <?php 
        if(isset($_POST['add'])){
        $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);
        $eventId = filter_input(INPUT_POST, 'eventId', FILTER_SANITIZE_NUMBER_INT);

        $query = [$userId, $eventId];
        $ticket->createTicket($query);
        }
      ?>
    </div>
  </div>
</div>