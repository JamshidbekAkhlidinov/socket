<?php

class chatroomes {
    private $id;
    private $userId;
    private $msg;
    private $created_at;
    protected $dbCon;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
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
        $sql = "INSERT INTO `chatrooms`(`id`, `user_id`, `msg`, `created_at`) VALUES (null, :user_id, :msg, :craeted_at)";
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




}


?>