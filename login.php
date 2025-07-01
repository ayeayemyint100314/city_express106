<?php
require_once "dbconn.php";
if (!isset($_SESSION)) {
    session_start();
}
// detecting whether login button is pressed or not
if (isset($_POST['loginBtn'])) {
    $email =  $_POST['email'];// email that user filled
    $password = $_POST['password'];// password that user typed
    try {
        $sql = "select * from admin where email=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        $adminInfo = $stmt->fetch(); // false if there is no record with this this email
        if($adminInfo)
        {   // when there is email in the table and check password is correct
            $status = password_verify($password, $adminInfo['password']);
            if($status) // check whether status is true
            {
                $_SESSION['loginSuccess']= "Welcome admin";
                 $_SESSION['adminEmail']= $email;

                header("Location:viewItem.php");
            }
            else{
                $message= "email or password is incorrect.";
            }
        }
        else{
            $message = "email or password is incorrect.";
        }



    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php require_once "navbarbar.php"  ?>
        </div>
        <div class="row">
            <div class="col-md-4 mx-auto pt-5 bg-light">
                <?php     
                    if(isset($message))
                    echo "<p class='alert alert-danger'>$message </p>";
                ?>
                <form action="login.php" class="form" method="post">
                    <fieldset class="border border-1">
                        <legend>Login Here</legend>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <button class="btn btn-outline-primary mt-2" name="loginBtn">Login</button>

                    </fieldset>
                </form>



            </div>


        </div>







    </div>

</body>

</html>