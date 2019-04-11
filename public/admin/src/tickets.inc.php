<?php
class Ticket {
    private $db;

    public $nrOfTickets;

    public function __construct(){
        $this->db = new Dbh();
        $this->db = $this->db->connect();  
    }

    public function loadTickets(){
        $stmt = $this->db->prepare("SELECT * FROM ticketbox.tickets");
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                }
                return $data;
            }
        }
    }

    public function updateTicket($fields, $orderNumber){
        try{
            $stmt = $this->db->prepare("UPDATE ticketBox.event 
            SET userId = :userId, eventId = :eventId WHERE id = :id");

            $stmt->bindValue(':id', $orderNumber, PDO::PARAM_INT);
            $stmt->bindValue(':userId', $fields[0], PDO::PARAM_STR);
            $stmt->bindValue(':eventId', $fields[1], PDO::PARAM_INT);
           

            if($stmt->execute()){
            header('Location: tickets.php');
            }
        }catch(PDOException $e){
            echo($e->getMessage());
        }
    }

    public function deleteTicket($ticketNr, $eventId){
        try{
            $stmt = $this->db->prepare("DELETE FROM ticketBox.tickets WHERE id = :id");
            $stmt->bindValue(':id', $ticketNr, PDO::PARAM_INT);
            $result = $stmt->execute();
            if($result){
                $stmt1 = $this->db->prepare("SELECT nrTickets FROM event WHERE id = :id");
                $stmt1->bindValue(':id', $eventId, PDO::PARAM_INT);
                $result1 = $stmt1->execute();
                    if($result1){
                        $nrOfTickets = $stmt1->fetchColumn();
                        $nrOfTickets = (int)$nrOfTickets;
                        $nrOfTickets++;
                        $stmt2 = $this->db->prepare("UPDATE event SET nrTickets = :tickets WHERE event.id = :id");
                        $stmt2->bindValue(':id', $eventId, PDO::PARAM_INT);
                        $stmt2->bindValue(':tickets', $nrOfTickets, PDO::PARAM_INT);
                        $result2 = $stmt2->execute();
                        if($result2){
                            header('Location: tickets.php');
                        }
                    }
            }else {?>
                <p class="alert alert-warning">Try Again</p>
            <?php }
        }catch(PDOException $e){
            echo($e->getMessage());
        }
    }
    
    public function createTicket($fields){
        print_r($fields); 
        try{
        $stmt = $this->db->prepare("INSERT INTO ticketBox.tickets (userId, eventId) VALUES (?,?)");
            if($stmt->execute( [ $fields[0], $fields[1] ] )){
                $stmt1 = $this->db->prepare("SELECT nrTickets FROM event WHERE id = :id");
                $stmt1->bindValue(':id', $fields[1], PDO::PARAM_INT);
                $result1 = $stmt1->execute();
                    if($result1){
                        $nrOfTickets = $stmt1->fetchColumn();
                        $nrOfTickets = (int)$nrOfTickets;
                        $nrOfTickets--;
                        $stmt2 = $this->db->prepare("UPDATE event SET nrTickets = :tickets WHERE event.id = :id");
                        $stmt2->bindValue(':id', $fields[1], PDO::PARAM_INT);
                        $stmt2->bindValue(':tickets', $nrOfTickets, PDO::PARAM_INT);
                        $result2 = $stmt2->execute();
                        if($result2){
                            header('Location: tickets.php');
                        }
                    }
            }
        }catch(PDOException $e){
            echo($e->getMessage());
        }
    }

} /* End of class */

