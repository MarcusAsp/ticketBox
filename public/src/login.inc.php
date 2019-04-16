<?php 
class User {
    private $db;
    public function __construct(){
        $this->db = new Dbh();
        $this->db = $this->db->connect();
    }

    public function logIn($email, $password){
        $stmt = $this->db->prepare("SELECT * FROM ticketBox.users WHERE email = :email AND password = :pass");
        if($stmt->execute([':email' => $email, ':pass' => $password]) && $stmt->fetchColumn()){
            $_SESSION['user'] = $email;
            Header('Location: '.$_SERVER['PHP_SELF']);
        }else {
            echo "<script>alert('User does not exists!');</script>";
         }
        
    }

    public function createAccount($userInfo){
        $stmt = $this->db->prepare("SELECT * FROM ticketBox.users WHERE email = :email");
        if($stmt->execute([':email' => $userInfo[2]]) && $stmt->fetchColumn()){
            echo "<script>alert('User aready exists!');</script>";
        }else {
        $stmt = $this->db->prepare("INSERT INTO ticketBox.users 
        (`firstName`, `lastName`, `email`, `password`)
        VALUES (?,?,?,?)");
        $answer = $stmt->execute([$userInfo[0],$userInfo[1],$userInfo[2],$userInfo[3]]);

        $_SESSION['user'] = $userInfo[2];
        Header('Location: '.$_SERVER['PHP_SELF']);
        }
    }
}