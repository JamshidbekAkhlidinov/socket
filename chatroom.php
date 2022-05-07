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
</head>
<body>
    <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, sint eum quod, nam corporis dolorem voluptates velit et libero veritatis facere vel deleniti iste cupiditate ipsum. Quas eius magnam expedita.</h3>
    <pre>
<?php
print_r($_SESSION);
        ?>
    </pre>
</body>
</html>