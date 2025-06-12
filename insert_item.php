<?php
require_once "dbconn.php";
$sql = "select c.cid, c.cname from category c ";
$stmt = $conn->query($sql);
$stmt->execute();
$categories = $stmt->fetchAll();


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
            <div class="col-md-12">
                <form>

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
                        <select class="form-select" aria-label="Default select example">
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

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>





            </div>




        </div>

    </div>



</body>

</html>