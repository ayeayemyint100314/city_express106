<?php
require_once "dbconn.php";
if (!isset($_SESSION)) {
    session_start(); // create a session if not exists
}
try {
    $sql = "SELECT i.item_id, i.item_name, i.price,
		    c.cname as category ,
		    i.description, i.quantity,
		    i.img_path
            from item i, category c
            where i.category = c.cid";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $items = $stmt->fetchAll(); //print_r($items);

} catch (PDOException $e) {
    echo $e->getMessage();
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>

</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <?php require_once "navbarbar.php"; ?>
        </div>
        <div class="row">

            <div class="col-md-10 my-5 mx-auto">
                <?php
                if (isset($_SESSION['insertSuccess'])) {
                    echo "<p class='alert alert-success'>$_SESSION[insertSuccess] </p>";
                    unset($_SESSION['insertSuccess']);
                } else  if (isset($_SESSION['updateSuccess'])) {
                    echo "<p class='alert alert-success'>$_SESSION[updateSuccess] </p>";
                    unset($_SESSION['updateSuccess']);
                }


                ?>
                <p class="text-start"><a class="btn btn-outline-primary mx-auto" href="./insert_item.php">Add New Item</a></p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th>Image</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        if (isset($items)) {
                            foreach ($items as $item) {
                                echo "<tr>
                                <td>$item[item_name]</td>
                                <td>$item[price]</td>
                                <td class=text-wrap>$item[description]</td>
                                <td>$item[quantity]</td>
                                <td>$item[category]</td>
                                <td><img style=width:60px;height:80px; src=$item[img_path]></td>  
                                <td><a class='btn btn-primary rounded-pill' href=editItem.php?id=$item[item_id]>Edit</a></td>           
                              </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</body>

</html>