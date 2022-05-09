<?php
session_start();

if(isset($_SESSION['user'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <h1 align='center'>Chatga hush kelibsiz</h1>
    <hr>
    <div class="container-fluid row">
        <div class="col-lg-4">
            <table class="table table-striped">
                <tr>
                    <th>User</th>
                </tr>
                <tr>
                    <td>
                        
                        <?php
                    foreach($_SESSION['user'] as $key=>$value){
                        $userId = $key;
                        echo '<input type="hidden" name="userId" id="userId" value="'.$key.'">';
                        echo "<div>".$value['name']."</div>";
                        echo "<div>".$value['email']."</div>";
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <th>Users</th>
                </tr>
                <td>
                    <?php 
                    include_once "./db/users.php";
                     $users = new users;
                     $users2 = $users->getAllUsers();   
                    foreach($users2 as $user){
                        if(!isset($_SESSION['user'][$user['id']])){
                        ?>
                    <div><?=$user['name']?></div>
                    <div><?=$user['email']?></div>
                    <hr>
                    <?php
                        }
                    }
                ?>
                </td>
            </table>
        </div>

        <div class="col-lg-8">
                <div class="message" style=" height: 200px; overflow-y: auto;">
                    <table id="chats" class="table table-hover">
                       <thead>
                        <tr>
                            <th valign="top">
                                <div><b>Form</b></div>
                                <div>Message</div>
                            </th>
                            <th valign="top" align="right">Message Time</th>
                        </tr>
                       </thead>
                       <tbody></tbody>
                        <?php
                        include_once "db/chatrooms.php";
                        $chatrooms = new ChatRooms;
                        $all = $chatrooms->getAllMessage();
                        foreach($all  as $one){
                            if($userId==$one['user_id']){
                                $from =  "Me";
                            }else{
                                $from = $one['name'];
                            }
                            echo '<tr>
                                        <td valign="top">
                                            <div>
                                                <b>'.$from.'</b>
                                            </div>
                                            <div>'.$one['msg'].'</div>
                                        </td>
                                        <td valign="top" align="right">'.$one['created_at'].'</td>
                                    </tr>';
                        }
                        ?>
                    </table>
                </div>
                <form action="" method="" class="chat-room-frm">
                    <div class="form-group">
                        <textarea name="msg" id="msg" cols="30" rows="5" class="form-control" placeholder="Enter message"></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                        <input type="button" value="Send" class="btn btn-success" id="send" name="send">
                    </div>
                </form>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
       
       $(document).ready(function(){
        var conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            console.log(e.data);
            
            var data = JSON.parse(e.data);
            var row = '<tr><td valign="top"><div><b>'+data.from+'</b></div><div>'+data.msg+'</div></td><td valign="top" align="right">'+data.dt+'</td></tr>';

            $("#chats > tbody").prepend(row);

        };


        $("#send").click(function(){
            var userId = $("#userId").val();
            var msg = $("#msg").val();
            $("#msg").val('');

            var data = {
                userId: userId,
                msg: msg
            };
            conn.send(JSON.stringify(data));
        });

       });


    </script>

</body>

</html>

<?php
}else{
    header('location: login.php');
}
?>