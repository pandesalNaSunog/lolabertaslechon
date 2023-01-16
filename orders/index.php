<?php
    session_start();
    $hasActiveSession = false;
    include('../admin/php/connection.php');
    $con = connect();
    $today = today();
    if(isset($_SESSION['client_user_id'])){
        $hasActiveSession = true;
        $userId = $_SESSION['client_user_id'];
        $userquery = $con->prepare('SELECT * FROM users WHERE id = ?');
        $userquery->bind_param('i', $userId);
        $userquery->execute();
        $userresult = $userquery->get_result();
        $userdata = $userresult->fetch_assoc();
        if($userdata['user_type'] == 'admin'){
            session_destroy();
            header('Location: ../');
        }
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
                

                $productQuery = $con->prepare('SELECT * FROM products WHERE id = ?');
                $productQuery->bind_param('i', $productid);
                $productQuery->execute();
                $productResult = $productQuery->get_result();
                $productData = $productResult->fetch_assoc();
                $productQuantity = $productData['quantity'];
                $productQuantity -= $quantity;
                
                $productUpdateQuery = $con->prepare('UPDATE products SET quantity = ? WHERE id = ?');
                $productUpdateQuery->bind_param('ii', $productQuantity, $productid);
                $productUpdateQuery->execute();

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

            $query = $con->prepare('INSERT INTO orders(user_id,order_type, product_ids, quantities,date_and_time, created_at, updated_at)VALUES(?,?,?,?,?,?,?)');
            $orderStatus = 'Your order is currently Preparing';
            $query->bind_param('issssss', $userId, $orderType, $productIdsString, $quantityString, $today, $today, $today);
            $query->execute();

            $lastinsertorderquery = "SELECT * FROM orders WHERE id = LAST_INSERT_ID()";
            $lastinsertorderresult = $con->query($lastinsertorderquery);
            $lastinsertorderData = $lastinsertorderresult->fetch_assoc();

            $orderId = $lastinsertorderData['id'];

            $query = $con->prepare('INSERT INTO order_statuses(order_id, status, created_at, updated_at)VALUES(?,?,?,?)');
            $query->bind_param('isss', $orderId, $orderStatus, $today, $today);
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
<body class="mb-5">

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
            <div class="col col-md-6 mx-auto">
                <h2 class="fw-bold">My Orders</h2>
                <hr>
                
            </div>
            
                

                
                    <?php
                        $productIds = array();
                        $hasOrders = false;
                        while($orderData = $orderresult->fetch_assoc()){
                            $hasOrders = true;
                            $productIds = explode('*', $orderData['product_ids']);
                            $quantities = explode('*', $orderData['quantities']);
                            $orderId = $orderData['id'];
                    ?>
                    <div class="col col-md-6 mx-auto">
                    
                        <div class="card shadow mt-3">
                            <div class="card-body">
                                

                                
                                <?php
                                    $grandTotal = 0;
                                    foreach($productIds as $key => $productid){
                                        $productQuery = $con->prepare('SELECT * FROM products WHERE id = ?');
                                        $productQuery->bind_param('i', $productid);
                                        $productQuery->execute();
                                        $productResult = $productQuery->get_result();
                                        $productData = $productResult->fetch_assoc();

                                        $quantity = $quantities[$key];
                                        $grandTotal += $productData['price'] * $quantity;
                                ?>      
                                    
                                        <div class="card shadow mt-3">
                                            <div class="card-body d-flex">
                                                <img src="../admin/<?php echo $productData['image'] ?>" style="height: 100px; width: 100px; object-fit: cover" alt="">
                                                <div class="ms-3">
                                                    <h4 class="fw-bold text-secondary"><?php echo $productData['name']; ?></h4>
                                                    <i>Quantity: <?php echo $quantity; ?></i>
                                                    <p class="text-danger">Price: &#8369; <?php echo $productData['price'] ?></p>
                                                    
                                                </div>
                                                <div class="ms-auto align-self-center">
                                                    <p class="text-danger fw-bold">Total: &#8369; <?php echo $productData['price'] * $quantity; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    } 
                                ?>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <h4 class="fw-bold">Total:</h4>
                                <h4 class="fw-bold">&#8369; <?php echo number_format($grandTotal, 2); ?></h4>
                            </div>
                            </div>
                            <div class="card-footer">
                                <ul>
                                    <?php
                                        $statusQuery = $con->prepare('SELECT * FROM order_statuses WHERE order_id = ?');
                                        $statusQuery->bind_param('i',$orderId);
                                        $statusQuery->execute();
                                        $statusResult = $statusQuery->get_result();

                                        while($statusData = $statusResult->fetch_assoc()){
                                    ?>
                                        <li>
                                            <?php echo $statusData['status'] ?><br>
                                            <p style="font-size: 10px"> <?php echo date_format(date_create($statusData['created_at']), 'M d, Y h:i A') ?></p>
                                        </li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <?php
                        if(!$hasOrders){
                    ?>
                        <h3 class="text-secondary fw-bold text-center w-100 p-5"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg><span class="ms-2">Empty</span></h3>
                    <?php
                        }
                    ?>
                </div>
            
        </div>
    </section>
</body>
</html>