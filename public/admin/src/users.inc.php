<?php 
/*
    Den här filen inkluderar man för att få med "Users" klassen och alla dess funktioner för CRUD mm.
*/ 
?>
<?php
class Users
{
    private $db;

    public function __construct()
    {
        $this->db = new Dbh();
        $this->db = $this->db->connect();
    }

    public function loadUsers()
    {
        $stmt = $this->db->prepare("SELECT * FROM users");
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
                return $data;
            }
        }
    }

    public function updateUser($fields, $orderNumber){
        try {
            $stmt = $this->db->prepare("UPDATE ticketBox.users SET firstName = :firstName, lastName = :lastName, password = :password, email = :email WHERE id = :id");
            $stmt->bindValue(':id', $orderNumber, PDO::PARAM_INT);
            $stmt->bindValue(':firstName', $fields[0], PDO::PARAM_STR);
            $stmt->bindValue(':lastName', $fields[1], PDO::PARAM_STR);
            $stmt->bindValue(':password', $fields[2], PDO::PARAM_STR);
            $stmt->bindValue(':email', $fields[3], PDO::PARAM_STR);
            if ($stmt->execute()) {
                header('Location: users.php');
            }
        } catch (PDOException $e) {
            echo ($e->getMessage());
        }
    }

    public function deleteUser($userNr)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM ticketBox.users WHERE id = :id");
            $stmt->bindValue(':id', $userNr, PDO::PARAM_INT);
            $result = $stmt->execute();
            if ($result) {
                header('Location: users.php');
            } else { ?>
                <p class="alert alert-warning">Try Again</p>
            <?php
            }
        } catch (PDOException $e) {
            echo ($e->getMessage());
        }
    }

    public function createUser($userInfo)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM ticketBox.users WHERE `email` = :email");
            if($stmt->execute([':email' => $userInfo[3]]) && $stmt->fetchColumn()){
                echo "<script>alert('User aready exists!');</script>";
            }else {
                $stmt = $this->db->prepare("INSERT INTO ticketBox.users 
                (`firstName`, `lastName`, `email`, `password`)
                VALUES (?,?,?,?)");
                if($stmt->execute([$userInfo[0],$userInfo[1],$userInfo[3],$userInfo[2]])){
                    header('Location: users.php');
                }
            }  
        } catch (PDOException $e) {
            echo ($e->getMessage());
        }
    }
}
