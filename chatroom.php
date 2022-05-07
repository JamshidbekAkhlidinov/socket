<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <h1 align='center'>Chatga hush kelibsiz</h1>
    <hr>
    <div class="container row">
        <div class="col-lg-4">
            <table class="table table-striped">
                <tr>
                    <th>User</th>
                </tr>
                <tr>
                    <td>
                        <?php
                    foreach($_SESSION['user'] as $key=>$value){
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
                <div class="message">
                    <table id="chats" class="table table-striped">
                        <tr>
                            <th colspan="4">
                                <b>Chat Room</b>
                            </th>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                    </table>
                </div>
        </div>
    </div>

</body>

</html>