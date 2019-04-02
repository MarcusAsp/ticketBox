<?php 
class User {
    private $db;
    public function __construct(){
        $this->db = new Dbh();
        $this->db = $this->db->connect();
    }

    public function logIn($username, $password){
        $stmt = $this->db->prepare("SELECT * FROM ticketBox.users WHERE `e-mail` = :username AND `password` = :pass");
        if($stmt->execute([':username' => $username, ':pass' => $password]) && $stmt->fetchColumn()){
            $_SESSION['user'] = $username;
        }else {
            echo "<script>alert('User does not exists!');</script>";
         }
        
    }

    public function logOut(){
        unset($_SESSION['user']);
        session_destroy();
        header("Location: index.php");
    }


    public function createAccount($userInfo){
        $stmt = $this->db->prepare("SELECT * FROM ticketBox.users WHERE `e-mail` = :email");
        if($stmt->execute([':email' => $userInfo[0]]) && $stmt->fetchColumn()){
            echo "<script>alert('User aready exists!');</script>";
        }else {
        $stmt = $this->db->prepare("INSERT INTO ticketBox.users 
        (`e-mail`, `firstName`, `lastName`, `password`)
        VALUES (?,?,?,?)");
        $answer = $stmt->execute([$userInfo[0],$userInfo[1],$userInfo[2],$userInfo[3]]);
        }
        $_SESSION['user'] = $userInfo[0];
        header("Location: index.php");
    }
}