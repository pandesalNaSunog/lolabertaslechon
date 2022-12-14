<?php
    $hasActiveSession = false;
    session_start();
    include('../admin/php/connection.php');
    $con = connect();
    if(isset($_SESSION['user_id'])){
        $hasActiveSession = true;
        $userId = $_SESSION['user_id'];
        $query = $con->prepare('SELECT * FROM users WHERE id = ?');
        $query->bind_param('i', $userId);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_assoc();

        $cartQuery = $con->prepare('SELECT * FROM carts WHERE user_id = ?');
        $cartQuery->bind_param('i', $userId);
        $cartQuery->execute();
        $cartResult = $cartQuery->get_result();
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
                    <li class="nav-item mx-2">
                        <a href="../" class="nav-link text-light" id="homeNav" style="color: white;">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="cart-list">
        <div class="container">
            <div class="row row-cols-1 row-cols-xl-2 mt-5">
            <?php
                while($cartData = $cartResult->fetch_assoc()){
                    $productId = $cartData['product_id'];
                    $productquery = $con->prepare('SELECT * FROM products WHERE id = ?');
                    $productquery->bind_param('i', $productId);
                    $productquery->execute();
                    $productResult = $productquery->get_result();
                    $productData = $productResult->fetch_assoc();
            ?>  <div class="col" id="cart-card-<?php echo $productData['id']; ?>">
                    <div class="card shadow mt-3 mt-xl-0">
                        <div class="card-body d-md-flex justify-content-between">
                            
                            <div class="d-flex">
                                <img src="../admin/<?php echo $productData['image'] ?>" style="height: 100px; width: 100px; object-fit: cover" class="img-fluid">
                                <div class="ms-3">
                                    <h3 class="fw-bold"><?php echo $productData['name'] ?></h3>
                                    <i>Available: <?php echo $productData['quantity'] ?></i>
                                </div>
                            </div>
                            
                            <div class="align-self-center">
                                <button id="remove-cart-<?php echo $productData['id']; ?>" class="my-btn mt-3 mb-3 mt-md-0 mb-md-0 w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg><span class="ms-3">Remove</span></button>
                                
                                <p class="mt-2">Quantity:</p>
                                <input id="cart-text-quantity-<?php echo $productData['id']; ?>" value=1 type="number" class="text-center form-control">


                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    
                    $(document).ready(function(){
                        
                        let removeCart = $('#remove-cart-<?php echo $productData['id']; ?>');
                        let cartCard = $('#cart-card-<?php echo $productData['id']; ?>');
                        let quantity = $('#cart-text-quantity-<?php echo $productData['id']; ?>');
                        let cartItemObject = new Item(cartCard, removeCart, quantity);
                        cartItemObject.removeItem();
                    })
                </script>
            <?php
                }
            ?>
            </div>
            
        </div>
    </section>
</body>
</html>