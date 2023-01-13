<?php
    session_start();
    $hasActiveSession = false;
    include('../admin/php/connection.php');
    $con = connect();
    $today = today();
    if(isset($_SESSION['user_id'])){
        $hasActiveSession = true;
        $userId = $_SESSION['user_id'];
        $userquery = $con->prepare('SELECT * FROM users WHERE id = ?');
        $userquery->bind_param('i', $userId);
        $userquery->execute();
        $userresult = $userquery->get_result();
        $userdata = $userresult->fetch_assoc();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $orderType = htmlspecialchars($_POST['order_type']);
            $cartQuery = $con->prepare('SELECT * FROM carts WHERE user_id = ?');
            $cartQuery->bind_param('i', $userId);
            $cartQuery->execute();
            $cartResult = $cartQuery->get_result();
            $productIds = array();
            $quantities = array();
            $productIdsString = "";
            $quantityString = "";
            while($cartData = $cartResult->fetch_assoc()){
                $productid = $cartData['product_id'];
                $quantity = $cartData['quantity'];

                $productIds[] = $productid;
                $quantities[] = $quantity;
            }

            $query = $con->prepare('DELETE FROM carts WHERE user_id = ?');
            $query->bind_param('i', $userId);
            $query->execute();

            foreach($productIds as $key => $productid){
                if($key + 1 == count($productIds)){
                    $productIdsString .= $productid;
                    $quantityString .= $quantities[$key];
                }else{
                    $productIdsString .= $productid . "*";
                    $quantityString .= $quantities[$key] . "*";
                }

            }

            $query = $con->prepare('INSERT INTO orders(user_id,order_type, product_ids, quantities, order_status,date_and_time, created_at, updated_at)VALUES(?,?,?,?,?,?,?,?)');
            $orderStatus = 'Preparing';
            $query->bind_param('isssssss', $userId, $orderType, $productIdsString, $quantityString, $orderStatus, $today, $today, $today);
            $query->execute();
        }

        $orderquery = $con->prepare('SELECT * FROM orders WHERE user_id = ?');
        $orderquery->bind_param('i', $userId);
        $orderquery->execute();
        $orderresult = $orderquery->get_result();


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
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="jquery.js"></script>
    <title>Products | D' Original Lola Berta's Lechon Haus</title>
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
                    <li class="nav-item mx-2">
                        <a href="../" class="nav-link text-light" id="homeNav" style="color: white;">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="mt-5">
        <div class="container">
            <h2 class="fw-bold">My Orders</h2>
            <hr>
            <?php
                $productIds = array();
                while($orderData = $orderresult->fetch_assoc()){
                    $productIds = explode('*', $orderData['product_ids']);

                    
            ?>
                <div class="card shadow mt-3">
                    <div class="card-body">
                        <?php 
                            foreach($productIds as $productid){
                                $productQuery = $con->prepare('SELECT * FROM products WHERE id = ?');
                                $productQuery->bind_param('i', $productid);
                                $productQuery->execute();
                                $productResult = $productQuery->get_result();
                                $productData = $productResult->fetch_assoc();
                        ?>
                                <div class="card shadow mt-3">
                                    <div class="card-body d-flex">
                                        <img src="../admin/<?php echo $productData['image'] ?>" style="height: 100px; width: 100px; object-fit: cover" alt="">
                                        <div class="ms-3">
                                            <h4 class="fw-bold text-secondary"><?php echo $productData['name']; ?></h4>
                                        </div>
                                        
                                    </div>
                                </div>
                        <?php
                            } 
                        ?>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </section>
</body>
</html>