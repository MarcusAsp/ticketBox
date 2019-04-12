<?php 
class Events {

    private $db;
    public function __construct(){
        $this->db = new Dbh();
        $this->db = $this->db->connect();
    }

    public function getEvents(){
        $stmt = $this->db->prepare("SELECT * FROM event WHERE activeEvent = 1 && nrTickets > 0");
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $row;
                }
                return $data;
            }
        }
        
    }

    
}