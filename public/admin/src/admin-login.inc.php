<?php 
/*
    Den här filen inkluderar man för att få med "Admin" klassen och alla dess funktioner för inlog mm.
*/ 

class Admin {
    private $db;
    public function __construct(){
        $this->db = new Dbh();
        $this->db = $this->db->connect();
    }

    public function logIn($username, $password){
        $stmt = $this->db->prepare("SELECT * FROM ticketBox.admin WHERE `username` = :username AND `password` = :pass");
        if($stmt->execute([':username' => $username, ':pass' => $password]) && $stmt->fetchColumn()){
            $_SESSION['admin'] = $username;
        }else {
            echo "<script>alert('Admin does not exists!');</script>";
         }
        
    }

    public function createAccount($userInfo){
        $stmt = $this->db->prepare("SELECT * FROM ticketBox.users WHERE `e-mail` = :email");
        if($stmt->execute([':email' => $userInfo[2]]) && $stmt->fetchColumn()){
            echo "<script>alert('User aready exists!');</script>";
        }else {
        $stmt = $this->db->prepare("INSERT INTO ticketBox.users 
        (`firstName`, `lastName`, `e-mail`, `password`)
        VALUES (?,?,?,?)");
        $answer = $stmt->execute([$userInfo[0],$userInfo[1],$userInfo[2],$userInfo[3]]);
        }
        $_SESSION['user'] = $userInfo[2];
        header("Location: index.php");
    }
}