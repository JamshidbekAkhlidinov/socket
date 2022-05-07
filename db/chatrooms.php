<?php

class ChatRooms {
    private $id;
    private $userId;
    private $msg;
    private $created_at;
    protected $dbCon;

    /**
     * @return mixed
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }


    
    

    public function __construct()
    {
        require_once "DbConnect.php";
        $db = new DbConnect();
        $this->dbCon = $db->connect();
    }


   public function saveChatRoom(){
        $sql = "INSERT INTO `chatrooms`(`id`, `user_id`, `msg`, `created_at`) VALUES (null, :user_id, :msg, :created_at)";
        $stmt = $this->dbCon->prepare($sql);
       $stmt->bindParam(':user_id',$this->userId);
       $stmt->bindParam(':msg',$this->msg);
       $stmt->bindParam(':created_at',$this->created_at);

       if($stmt->execute()){
           return true;
       }else{
           return false;
       }
   }

   public function getAllMessage(){
        $sql = "SELECT c.*, u.name FROM `chatrooms` c JOIN users u ON(c.user_id = u.id) ORDER BY `c`.`created_at` DESC";
        $stmt = $this->dbCon->prepare($sql);
        $stmt->execute();
        $message = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $message;
    }



}


?>