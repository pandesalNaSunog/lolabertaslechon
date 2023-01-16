<?php
    $hasActiveSession = false;
    session_start();
    include('../admin/php/connection.php');
    $con = connect();
    if(isset($_SESSION['client_user_id'])){
        $hasActiveSession = true;
        $userId = $_SESSION['client_user_id'];
        $query = $con->prepare('SELECT * FROM users WHERE id = ?');
        $query->bind_param('i', $userId);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_assoc();

        $cartQuery = $con->prepare('SELECT * FROM carts WHERE user_id = ?');
        $cartQuery->bind_param('i', $userId);
        $cartQuery->execute();
        $cartResult = $cartQuery->get_result();
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
    <link rel="stylesheet" href="../style.css">
    <script src="../jquery.js"></script>
    <script src="js/cart-item.js"></script>
    <script src="../js/buttonstate.js"></script>
    <script src="js/order-summary.js"></script>
    <script src="js/main.js"></script>
    <title>Cart | D' Original Lola Berta's Lechon Haus</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="padding: 0px; -webkit-user-select: none; background-color: #fe6917;">
        <div class="container">
            <div class="navbar-brand" style="margin: 0;">
                <a href="<?php echo $_SERVER['PHP_SELF'] ?>"><img style="cursor: pointer margin: 0px;pointer-events: none;" id="logo-ni-lola" src="../admin/Branding/received_727156111882599 page logo.png" height="70px" width="70px" alt="" srcset=""></a>
                <?php 
                        if($hasActiveSession){
                        ?>
                        
                            <span class="ms-3 fw-bold text-light me-5">Welcome, <?php echo $data['name'];?></span>
                            
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
                        <a class="myCart btn btn-warning shadow" id="mainCart" href="<?php echo $_SERVER['PHP_SELF']?>">My Cart</a>
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

    <section id="cart-list">
        <div class="container">
            <div class="card shadow mt-5">
                <div class="card-body p-4">
                    <h1 class="fw-bold"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                    </svg><span class="ms-5">Shopping Cart</span></h1>
                    <hr>
                    <div class="row row-cols-1 row-cols-xl-2 g-3">
                    <?php
                        $hasCartItems = false;
                        while($cartData = $cartResult->fetch_assoc()){
                            $hasCartItems = true;
                            $productId = $cartData['product_id'];
                            $productquery = $con->prepare('SELECT * FROM products WHERE id = ?');
                            $productquery->bind_param('i', $productId);
                            $productquery->execute();
                            $productResult = $productquery->get_result();
                            $productData = $productResult->fetch_assoc();
                    ?>  <div class="col" id="cart-card-<?php echo $cartData['id']; ?>">
                            <div class="card shadow mt-3 mt-xl-0">
                                <div class="card-body d-md-flex justify-content-between">
                                    
                                    <div class="d-flex">
                                        <img src="../admin/<?php echo $productData['image'] ?>" style="height: 100px; width: 100px; object-fit: cover" class="img-fluid">
                                        <div class="ms-3">
                                            <h3 class="fw-bold text-secondary"><?php echo $productData['name'] ?></h3>
                                            <i>Available: <?php echo $productData['quantity'] ?></i>
                                            <h6 class="fw-bold text-danger">&#8369; <?php echo $productData['price']; ?></h6>
                                        </div>
                                    </div>
                                    
                                    <div class="align-self-center">
                                        <button value="<?php echo $cartData['id']; ?>" id="remove-cart-<?php echo $cartData['id']; ?>" class="my-btn mt-3 mb-3 mt-md-0 mb-md-0 w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg><span class="ms-3" id="remove-text-<?php echo $cartData['id']; ?>">Remove</span></button>
                                        
                                        <p class="mt-2">Quantity:</p>
                                        <input id="cart-text-quantity-<?php echo $cartData['id']; ?>" value='<?php echo $cartData['quantity']; ?>' type="number" class="text-center form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            
                            $(document).ready(function(){
                                let cartId = <?php echo $cartData['id']; ?>;
                                let removeCart = $('#remove-cart-<?php echo $cartData['id']; ?>');
                                let cartCard = $('#cart-card-<?php echo $cartData['id']; ?>');
                                let quantity = $('#cart-text-quantity-<?php echo $cartData['id']; ?>');
                                let removeText = $('#remove-text-<?php echo $cartData['id']; ?>');
                                let available = <?php echo $productData['quantity']; ?>;
                                let cartItemObject = new Item(cartCard, removeCart, quantity, removeText, available, cartId);
                                cartItemObject.removeItem();
                                cartItemObject.changeQuantity();
                            })
                        </script>
                        <?php
                        }
                    ?>
                    </div>
                    <?php
                        if(!$hasCartItems){
                    ?>
                        <h4 class="w-100 p-5 text-center text-secondary">Your Cart is Empty</h4>
                    <?php
                        }
                    ?>
                </div>
                <div class="card-footer p-4">
                    <a href="../products/" class="btn btn-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>  Continue Shopping</a>
                    <?php
                        if($hasCartItems){
                    ?>
                        <button id="check-out-button" class="my-btn">Check Out</button>
                    <?php
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="order-summary-modal" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title d-flex">
                        <img src="../footer.png" style="object-fit: cover; height: 16px; width: 16px;" alt="" class="img-fluid">
                        <div class="ms-3">
                            <h5 class="fw-bold">
                                Order Summary
                            </h5>
                        </div>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="order-summary-table">

                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <h4 class="fw-bold">Total</h4>
                        <h4 class="fw-bold">&#8369; <span id="grand-total"></span></h4>
                        
                        
                    </div>
                    <form class="w-100" action="../orders/" method="POST">
                        <label for="">Delivery Mode: </label>
                        <select class="form-select" name="order_type">
                            <option value="Pickup">Pickup</option>
                            <option value="Delivery">Delivery</option>
                        </select>
                        <button class="my-btn w-100 mt-3">Confirm Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>