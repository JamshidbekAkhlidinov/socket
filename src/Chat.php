<?php
namespace MyApp;

use DateTime;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use users;

include_once "../db/users.php";
include_once "../db/chatrooms.php";
class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo "server ishga tushdi\n\n";
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        
        $chatrooms = new \ChatRooms();
        $data = json_decode($msg,true);
        $chatrooms->setCreatedAt(date('H:i:s d-m-Y'));
        $chatrooms->setUserId($data['userId']);
        $chatrooms->setMsg($data['msg']);
        if($chatrooms->saveChatRoom()) {
            $objuser = new users();
            $data['dt'] = date('H:i:s d-m Y');
            $objuser->setId($data['userId']);
            $user = $objuser->getUserbyId();
            $data['from'] = $user['name'];
            $data['msg'] = $data['msg'];
        }
        

        foreach ($this->clients as $client) {
            if ($from == $client) {
                $data['from'] = "Me";
            }else{
                $data['from'] = $user['name'];
            }
            $client->send(json_encode($data));

        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}

?>