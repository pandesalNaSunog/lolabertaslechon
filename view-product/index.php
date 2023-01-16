

<?php
    session_start();
    if(isset($_GET['product_id'])){
        include('../admin/php/connection.php');
        $con = connect();
        $id = $_GET['product_id'];
        $query = $con->prepare('SELECT * FROM products WHERE id = ?');
        $query->bind_param('i', $id);

        $query->execute();
        $result = $query->get_result();
        if(!($data = $result->fetch_assoc())){
            header('Location: ../');
        }
        $canViewCart = false;
        $hasActiveSession = false;
        if(isset($_SESSION['client_user_id'])){
            $userId = $_SESSION['client_user_id'];
            $canViewCart = true;
            
            $hasActiveSession = true;
            $userquery = $con->prepare('SELECT * FROM users WHERE id = ?');
            $userquery->bind_param('i', $userId);
            $userquery->execute();
            $userresult = $userquery->get_result();
            $userdata = $userresult->fetch_assoc();
        
        }
                    
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
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../jquery.js"></script>
    <script src="js/main.js"></script>
    <script src="js/cart.js"></script>
    <script src="../js/buttonstate.js"></script>
    <script src="../js/toast.js"></script>
    <title>View Product | D Original Lola Berta's Lechon Haus</title>
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

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img style="object-fit: cover" src="../footer.png" height="16" width="16" class="rounded me-2" alt="...">
                <strong class="me-auto" id="toast-title"></strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toast-message">
                
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-2 g-3">
            <div class="col">
                <img src="../admin/<?php echo $data['image']; ?>" style="object-fit: cover; width: 100%" class="img-fluid" alt="">
            </div>
            <div class="col">
                <h2 class="fw-bold fs-1"><?php echo $data['name']; ?></h2>
                <p class="fs-2 text-secondary fw-bold">&#8369; <?php echo $data['price'] ?></p>
                <i>Available: <?php echo $data['quantity']; ?></i>
                <hr>
                <p class="lead fs-6"><?php echo $data['description'];?></p>

                <div class="d-flex">

                    
                    <button value="<?php echo $data['id']; ?>" class="my-btn" id="add-to-cart"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                    </svg><span class="ms-3" id="add-to-cart-text">Add to Cart</span></button>

                    <?php if($canViewCart){

                    ?>
                        <a href="../cart/" style="text-decoration: none" class="my-btn ms-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16"> 
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                        </svg><span class="ms-3" id="add-to-cart-text">View Cart</span></a>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>