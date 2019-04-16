<?php
/*
    Den här filen inkluderar man för att få med "Users" klassen och alla dess funktioner för CRUD mm.
*/ 

class Event {
    private $db;

    public function __construct(){
        $this->db = new Dbh();
        $this->db = $this->db->connect();
    }

    public function loadEvents(){
        $stmt = $this->db->prepare("SELECT * FROM event");
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                }
                return $data;
            }
        }
    }

    public function saveForm($fields, $orderNumber){
        try{
            $stmt = $this->db->prepare("UPDATE ticketBox.event 
            SET name = :eventName, date = :date, activeEvent = :activeEvent, price = :price, location = :location, nrTickets = :nrTickets
            WHERE id = :id");

            $stmt->bindValue(':id', $orderNumber, PDO::PARAM_INT);
            $stmt->bindValue(':eventName', $fields[0], PDO::PARAM_STR);
            $stmt->bindValue(':nrTickets', $fields[1], PDO::PARAM_INT);
            $stmt->bindValue(':location', $fields[2], PDO::PARAM_STR);
            $stmt->bindValue(':price', $fields[3], PDO::PARAM_INT);
            $stmt->bindValue(':date', $fields[4], PDO::PARAM_STR);
            $stmt->bindValue(':activeEvent', $fields[5], PDO::PARAM_INT);

            if($stmt->execute()){
            header('Location: events.php');
            }
        }catch(PDOException $e){
            echo($e->getMessage());
        }
    }

    public function deleteRow($eventNr){
        try{
            $stmt = $this->db->prepare("DELETE FROM ticketBox.event WHERE id = :id");
            $stmt->bindValue(':id', $eventNr, PDO::PARAM_INT);
            $result = $stmt->execute();
            if($result){
                header('Location: events.php');
            }else {?>
                <p class="alert alert-warning">Try Again</p>
            <?php }
        }catch(PDOException $e){
            echo($e->getMessage());
        }
    }
    
    public function createEvent($fields){
        try{
        $stmt = $this->db->prepare("INSERT INTO ticketBox.event (name, nrTickets, location, price, date, activeEvent) 
        VALUES (?,?,?,?,?,?)");
            if($stmt->execute([$fields[0], $fields[1], $fields[2], $fields[3], $fields[4], $fields[5]])){
            header('Location: events.php');
            }
        }catch(PDOException $e){
            echo($e->getMessage());
        }
    }


}

