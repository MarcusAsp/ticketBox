<?php 
class User {
    private $db;
    public function __construct(){
        $this->db = new Dbh();
        $this->db = $this->db->connect();
    }

    public function logIn($email, $password){
        $stmt = $this->db->prepare("SELECT * FROM ticketbox.users WHERE `e-mail` = :email AND `password` = :pass");
        if($stmt->execute([':email' => $email, ':pass' => $password]) && $stmt->fetchColumn()){
            $_SESSION['user'] = $email;
        }else {
            echo "<script>alert('User does not exists!');</script>";
         }
        
    }

    public function createAccount($userInfo){
        echo "<script>console.log('Döda mig');</script>";
        $stmt = $this->db->prepare("SELECT * FROM ticketbox.users WHERE `e-mail` = :email");
        if($stmt->execute([':email' => $userInfo[2]]) && $stmt->fetchColumn()){
            echo "<script>alert('User aready exists!');</script>";
        }else {
        $stmt = $this->db->prepare("INSERT INTO ticketbox.users 
        (`firstName`, `lastName`, `e-mail`, `password`)
        VALUES (?,?,?,?)");
        $answer = $stmt->execute([$userInfo[0],$userInfo[1],$userInfo[2],$userInfo[3]]);
        }
        $_SESSION['user'] = $userInfo[2];
        header("Location: index.php");
    }
}