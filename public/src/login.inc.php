<?php 
class User {
    private $db;
    public function __construct(){
        $this->db = new Dbh();
        $this->db = $this->db->connect();
    }

    public function logIn($userInfo){
        $stmt = $this->db->prepare("SELECT * FROM classicmodels.users WHERE username = :username AND `password` = :pass");
        if($stmt->execute([':username' => $userInfo[0], ':pass' => $userInfo[1]]) && $stmt->fetchColumn()){
            $_SESSION['user'] = $userInfo[0];
            header("Location: index.php");
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
        $stmt = $this->db->prepare("SELECT * FROM classicmodels.users WHERE username = :username");
        if($stmt->execute([':username' => $userInfo[0]]) && $stmt->fetchColumn()){
            echo "<script>alert('User aready exists!');</script>";
        }else {
        $stmt = $this->db->prepare("INSERT INTO classicmodels.users 
        (username, `password`)
        VALUES (?,?)");
        $answer = $stmt->execute([$userInfo[0],$userInfo[1]]);
        }
        $_SESSION['user'] = $userInfo[0];
        header("Location: index.php");
    }
}