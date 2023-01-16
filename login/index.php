
<?php
    include('../admin/php/connection.php');
    session_start();
    $loginIsValid = false;
    $con = connect();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])){

        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $query = $con->prepare('SELECT * FROM users WHERE email = ?');
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();

        if($data = $result->fetch_assoc()){
            if(password_verify($password, $data['password'])){
                $loginIsValid = true;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../jquery.js"></script>
    <script src="js/main.js"></script>
    <script src="js/signup.js"></script>
    <script src="../js/inputState.js"></script>
    <script src="../js/buttonstate.js"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Login | D' Original Lola Berta's Lechon Haus</title>
</head>
<body>
    <div id="background" style="height: 100vh; width: 100%" class="bg-dark">
        <div class="container" style="height: 100%; width: 100%; display: flex; align-items: center; justify-content: center">
            <div class="row row-cols-1 row-cols-md-2 g-3" style="z-index: 1">
                <div class="col text-center p-3">
                    <img src="../footer.png" class="img-fluid"alt="">
                    <p class="text-light fs-5">Sign Up and shop! It's easy!</p>
                    <a href="../" style="text-decoration: none" class="my-btn">Go Back to Home Page</a>
                </div>
                <div class="col p-3">
                    <div class="mt-4 mx-auto card shadow">
                        <div class="card-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <input required name="email" type="text" placeholder="Email" class="form-control <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && !$loginIsValid) { echo 'is-invalid'; } ?>">
                                <?php if(!$loginIsValid){ 
                                    ?>
                                    <div class="invalid-feedback">Invalid Credentials</div>
                                 <?php
                                 }else{
                                    session_start();
                                    $_SESSION['client_user_id'] = $data['id'];
                                    header('Location: ../');
                                 }
                                 ?>
                                
                                <input required name="password" type="password" placeholder="Password" class="form-control mt-3">
                                <button class="my-btn mt-3 w-100" style="border-radius: 5px">Log In</button>
                                
                            </form>
                            <p class="fs-6 mt-3 lead text-center text-secondary">or</p>
                            <button class="my-btn-outline w-100" data-bs-target="#signup-modal" data-bs-toggle="modal">Sign Up</button>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            
        </div>
    </div>

    <div class="modal fade" id="signup-modal" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title d-flex">
                        <img style="object-fit: contain" height="50" width="50" src="../footer.png" alt="" class="img-fluid">
                        <div class="ms-3">
                            <h3 class="fw-bold">Sign Up</h3>
                            <p>Please fill out the details below.</p>
                        </div>
                        
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <input id="signup-name" type="text" placeholder="Name" class="form-control">
                        <div class="invalid-feedback" id="signup-name-error"></div>
                    </div>
                    <div>
                        <input id="signup-email" type="text" placeholder="Email" class="form-control mt-3">
                        <div class="invalid-feedback" id="signup-email-error"></div>
                    </div>
                    
                    <div>
                        <input id="signup-password" type="password" placeholder="Password" class="form-control mt-3">
                        <div class="invalid-feedback" id="signup-password-error"></div>
                    </div>
                    <div>
                        <input id="signup-retype-password" type="password" placeholder="Retype Password" class="form-control mt-3">
                        <div class="invalid-feedback" id="retype-password-error"></div>
                    </div>
                    
                    <button id="signup" class="my-btn w-100 mt-3" style="border-radius: 5px">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>