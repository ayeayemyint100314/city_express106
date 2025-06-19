<?php
require_once "dbconn.php";
if(!isset($_SESSION))
{
    session_start();
}
$sql = "select c.cid, c.cname from category c ";
$stmt = $conn->query($sql);
$stmt->execute();
$categories = $stmt->fetchAll();

if (isset($_POST['insertItem'])) {
    $name = $_POST['itemName'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $filename =  $_FILES['img']['name'];
    $filepath = "item_img/" . $filename;

    $status = move_uploaded_file($_FILES['img']['tmp_name'],  $filepath);
    if ($status) // storing file to a specified directory is sussessful
    {
        try {
            $sql = "insert into item values (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            // null is for ID which is auto increment primary key
            $status = $stmt->execute([null, $name, $price, $category, $description, $filepath, $quantity]);
            $lastId = $conn->lastInsertId();
            if($status)
            {   $_SESSION['insertSuccess'] = "New item with $lastId has been inserted successfully!";
               header("Location:viewItem.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php require_once "navbarbar.php";  ?>

        </div>
        <div class="row my-5">
            <div class="col-md-4 mx-auto">
                <h4 class="text-center">Insert Item </h4>
                <form class="border border-primary p-3" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="itemName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="itemName">
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label"> Price</label>
                        <input type="number" class="form-control" name="price">

                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label"> Quantity</label>
                        <input type="number" class="form-control" name="quantity">

                    </div>
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">item image</label>
                        <input class="form-control form-control-sm" name="img" type="file">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="category">
                            <option selected>Open this select menu</option>
                            <?php
                            if (isset($categories)) {
                                foreach ($categories as $category) {
                            ?>
                                    <option value="<?php echo $category['cid']; ?>">
                                        <?php echo $category['cname']; ?></option>

                            <?php }
                            } ?>

                        </select>

                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" name="description" placeholder="write description here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Description</label>
                    </div>

                    <button type="submit" class="btn btn-primary" name="insertItem">Submit</button>
                </form>





            </div>




        </div>

    </div>



</body>

</html>