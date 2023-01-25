<?php
    include('../admin/php/connection.php');
    $con = connect();
    session_start();
    $hasActiveSession = false;
    if(isset($_SESSION['client_user_id'])){
        $hasActiveSession = true;
        $userId = $_SESSION['client_user_id'];
        $userQuery = $con->prepare('SELECT * FROM users WHERE id = ?');
        $userQuery->bind_param('i', $userId);
        $userQuery->execute();
        $userResult = $userQuery->get_result();
        $userdata = $userResult->fetch_assoc();
    }else{
        header('Location: ../');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <!-- <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script> -->
    <script src="jquery.js"></script>
    <script src="js/address.js"></script>
    <title>Edit Profile | D' Original Lola Berta's Lechon Haus</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="padding: 0px; -webkit-user-select: none; background-color: #fe6917;">
        <div class="container">
            <div class="navbar-brand" style="margin: 0;">
                <a href="<?php echo $_SERVER['PHP_SELF'] ?>"><img style="cursor: pointer margin: 0px;pointer-events: none;" id="logo-ni-lola" src="../admin/Branding/received_727156111882599 page logo.png" height="70px" width="70px" alt="" srcset=""></a>
                <?php 
                        if($hasActiveSession){
                        ?>
                        
                            <span class="ms-3 fw-bold text-light me-5">Welcome, <?php echo $userdata['name'];?></span>
                            
                        <?php
                        }
                    ?>
            </div>
            <button class="navbar-toggler shadow" style="border: solid 2px rgb(255, 124, 36);border-radius: 25%;" data-bs-toggle="collapse" data-bs-target="#nav-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="nav-menu" class="collapse navbar-collapse mt-3">
                <ul class="navbar-nav ms-auto">
                    <li id="searchNav" class="nav-item mx-2">
                        
                            <form action="../products/" method="GET">
                                <div class="input-group col-8 shadow">
                                    <input type="text" class="form-control mt-0 mb-0" name="search" id="searchProductInput" placeholder="Search..." required>
                                    <button class="btn btn-warning mt-0" id="searchProduct">Search</button>
                                </div>
                            </form>
                            
                        
                    </li>
                    <li class="nav-item mx-2">
                        <a class="myCart btn btn-warning shadow" id="mainCart" href="../cart/">My Cart</a>
                    </li>
                    <?php
                        if($hasActiveSession){
                    ?>
                        <li class="nav-item mx-2">
                            <a class="nav-link text-light" href="../orders/">My Orders</a>
                        </li>
                    <?php
                        }
                    ?>
                    <li class="nav-item mx-2">
                        <a href="../" class="nav-link text-light" id="homeNav" style="color: white;">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <section>
        <div class="container">
            <div class="card col col-lg-6 mx-auto mt-5 shadow">
                <div class="card-header d-flex">
                    <img src="../footer.png" style="height: 50px; width: 50px; object-fit: cover" alt="">
                    <strong class="fw-bold ms-3 align-self-center">Edit Profile</strong>
                </div>
                <div class="card-body">
                    <form action="../profile/" method="POST">
                        <input name="new-name" value="<?php echo $userdata['name'] ?>" required type="text" class="form-control" placeholder="Name">

                        <input name="new-contact" value="<?php echo $userdata['contact_number'] ?>" required type="number" class="form-control mt-3" placeholder="Contact">

                        <input name="new-email" value="<?php echo $userdata['email'] ?>" required type="email" class="form-control mt-3" placeholder="Email">
                        <button class="my-btn mt-3 w-100">Confirm</button>
                    </form>
                    
                </div>
            </div>
        </div>
        
    </section>
</body>
</html>