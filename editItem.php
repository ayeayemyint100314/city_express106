
<?php
require_once "dbconn.php";
if(!isset($_SESSION))
{
    session_start();
}

    if(isset($_GET['id']))
    {
        $sql = "SELECT i.item_id, i.item_name, i.price,
		    c.cname as category ,
		    i.description, i.quantity,
		    i.img_path
            from item i, category c
            where i.category = c.cid AND
            i.item_id = ? ";

           $stmt =  $conn->prepare($sql);
           $stmt->execute([$_GET['id']]);
           $item = $stmt->fetch();
           print_r($item);



    }



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<p></p>
    
</body>
</html>