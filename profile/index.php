<?php
    include('../admin/php/connection.php');
    $con = connect();
    $today = today();
    session_start();
    $hasActiveSession = false;
    if(isset($_SESSION['client_user_id'])){
        

        $hasActiveSession = true;
        $userId = $_SESSION['client_user_id'];
        $userquery = $con->prepare('SELECT * FROM users WHERE id = ?');
        $userquery->bind_param('i', $userId);
        $userquery->execute();
        $userresult = $userquery->get_result();
        $userdata = $userresult->fetch_assoc();


        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new-address'])){
            $newAddress = htmlspecialchars($_POST['new-address']);
            $newAddressQuery = $con->prepare('INSERT INTO delivery_addresses(user_id, address, created_at, updated_at)VALUES(?,?,?,?)');
            $newAddressQuery->bind_param('isss', $userId, $newAddress, $today, $today);
            $newAddressQuery->execute();
        }

        $addressQuery = $con->prepare('SELECT * FROM delivery_addresses WHERE user_id = ?');
        $addressQuery->bind_param('i', $userId);
        $addressQuery->execute();
        $addressResult = $addressQuery->get_result();

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <!-- <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script> -->
    <script src="jquery.js"></script>
    <script src="js/address.js"></script>
    <title>Profile | D' Original Lola Berta's Lechon Haus</title>
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
                        
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
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

    <section id="profile" class="mt-5">
        <div class="container">
            <div class="card col col-xl-6 mx-auto shadow">
                <img src="../lechon1.jpg" height="150" style="object-fit: cover;" alt="" class="card-img-top">
                <div class="card-body text-center">
                    <h3 class="fw-bold text-secondary"><?php echo $userdata['name']; ?></h3>
                    <i><?php echo $userdata['email'] ?></i>
                    <p><?php echo $userdata['contact_number'] ?></p>
                </div>
            </div>
            <div class="card col col-xl-6 mx-auto shadow mt-3">
                <div class="card-header">
                    <h5 class="fw-bold text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                    </svg><span class="ms-3">My Addresses</span></h5>
                </div>
                <div class="card-body">
                    <?php
                        while($addressData = $addressResult->fetch_assoc()){
                    ?>
                        <div class="card shadow-sm mt-2">
                            <div class="card-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                </svg><span class="ms-3"><?php echo $addressData['address'] ?></span>
                            </div>
                        </div>
                    <?php
                        }
                    ?>

                    <button id="add-address" data-bs-target="#add-address-modal" data-bs-toggle="modal" class="btn btn-link mt-3 fs-5" style="color: orangered; text-decoration: none">+ Add Address</button>
                </div>
            </div>
        </div>
        
    </section>

    <div class="modal fade" id="add-address-modal" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <div class="modal-title d-flex">
                        <img src="../footer.png" style="height: 50px; width: 50px; object-fit: cover" alt="" class="img-fluid">
                        <h4 class="align-self-center ms-3 fw-bold">Add Address</h4>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <input name="new-address" placeholder="Enter New Address" type="text" required class="form-control">
                        <button class="my-btn w-100 mt-3">Confirm</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>