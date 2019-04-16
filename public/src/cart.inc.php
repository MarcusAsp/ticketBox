<?php
class Cart {
    private $db;
    public function __construct()
    {
        $this->db = new Dbh();
        $this->db = $this->db->connect();
    }

    public function buyEvents($eventId, $nrOfEvents, $user)
    {
        try {
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :user");
            $stmt->bindValue(':user', $user, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $userId = $stmt->fetchColumn();
                $userId = (int)$userId;
                for ($i = 0; $i < $nrOfEvents; $i++) {
                    $stmt1 = $this->db->prepare("INSERT INTO ticketBox.tickets
                    (userId, eventId)
                    VALUES (?,?)");
                    if($stmt1->execute([$userId, $eventId])){
                        $stmt3 = $this->db->prepare("UPDATE ticketBox.event SET nrTickets = nrTickets-1
                        WHERE id = :id");
                        $stmt3->bindValue(':id', $eventId, PDO::PARAM_INT);
                        if($stmt3->execute()){
                            $id = $this->db->lastInsertId();
                            $id = (int)$id;

                            $stmt2 = $this->db->prepare("INSERT INTO ticketBox.orders
                            (userId, eventId, ticketId, usedTicket) 
                            VALUES (:userId, :eventId, :id, 0)");

                            $stmt2->bindValue(':userId', $userId, PDO::PARAM_INT);
                            $stmt2->bindValue(':eventId', $eventId, PDO::PARAM_INT);
                            $stmt2->bindValue(':id', $id, PDO::PARAM_INT);
                                if($stmt2->execute()){
                                    echo('<script>console.log("Hej");</script>');
                                }else{
                                    echo('<script>alert("Fel på stmt2->execute");</script>');
                                }
                            }else{
                                echo('<script>alert("Fel på stmt3->execute");</script>');
                            }

                        }else{
                            echo('<script>alert("Fel på stmt1->execute");</script>');
                        }
                    }
                }else{
                    echo('<script>alert("Fel på stmt->execute");</script>');
                }
            }catch (PDOException $e) {
            echo ($e->getMessage());
        }
    }
}
