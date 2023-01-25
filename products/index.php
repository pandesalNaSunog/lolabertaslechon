
<?php
    $productsArray = array();
    include('../admin/php/connection.php');
    $con = connect();
    $hasResult = false;
    $hasActiveSession = false;
    session_start();
    if(isset($_GET['search'])){
        
        $search = "%" . $_GET['search'] . "%";
        $query = $con->prepare("SELECT * FROM products WHERE name LIKE ? or description LIKE ?");
        $query->bind_param('ss', $search, $search);
    }else{
        $query = $con->prepare('SELECT * FROM products');
    }
    if(isset($_SESSION['client_user_id'])){
        $hasActiveSession = true;
        $userId = $_SESSION['client_user_id'];
        $userquery = $con->prepare('SELECT * FROM users WHERE id = ?');
        $userquery->bind_param('i', $userId);
        $userquery->execute();
        $userresult = $userquery->get_result();
        $userdata = $userresult->fetch_assoc();
    }

    
    $query->execute();
    $result = $query->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script> -->
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

    <section id="products" class="py-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
                <?php
                    while($data = $result->fetch_assoc()){
                        $hasResult = true;
                        $quantity = $data['quantity'];
                        ?>

                    <div class="col">
                        <div style="position: relative" class="card shadow col-md mx-auto" style="cursor: pointer">
                            <?php
                                if($quantity == 0){
                            ?>
                            
                                <div style="width: 100%; height: 100%; position: absolute; opacity: 30%" class="bg-dark">
                                    
                                </div>
                                <div class="d-flex justify-content-center" style="position: absolute; width: 100%;">
                                    <p class="text-light text-center" style="background-color: orangered; padding: 10px">Sold Out</p>
                                </div>
                            <?php
                                }
                            ?>

                            <img class="img-fluid card-img-top" style="height: 300px; width: 100%; object-fit: cover" src="../admin/<?php echo $data['image']; ?>" alt="">
                            <div class="card-footer text-center">
                                <p class="fw-bold text-truncate fs-3 mt-1"><?php echo $data['name']; ?></p>
                                <p class="text-truncate"><?php echo $data['description']; ?></p>
                        
                                <p class="text-start fs-4 fw-bold text-secondary mt-2">&#8369; <?php echo $data['price'];?></p>
                                <form action="../view-product/" method="GET">
                                    <button name="product_id" value="<?php echo $data['id'] ?>" class="btn btn-outline-danger w-100 mt-3">View Product</button>
                                </form>
                                
                            </div>
                            
                        </div>
                    </div>
                <?php
                    }
                ?>

            </div>
        </div>

        <?php if(!$hasResult && isset($_GET['search'])){ 
            ?>
            <div class="container">
                <div class="card shadow">
                    <div class="card-body">
                        <p>404 Not Found</p>
                    </div>
                </div>
            </div>
        <?php
            }
            ?>
        
    </section>

    <footer id="aboutUs" class="m-0" style="color: white;">
        <div class="pt-5" style="background-color: rgb(226, 99, 16);">
            <div class="container">
                <section id="aboutUsSection"  class="pb-0 text-dark" style="padding-top: 50px;">
                    <div class="mx-5 p-5" style="height: fit-content;align-self: center;border-radius: 25%;">
                        <center>
                            <p style="margin-bottom: 0px;color: white;">The pig is cooked only as the order comes in. The pig is stuffed and roasted the old-fashioned way over a pit of smoldering charcoal in the family's own backyard to assure the lechon's consistency and quality.</p>
                        </center>
                    </div>
                </section>
                <section class="container" style="display: column;justify-content:space-between;margin: 0px;margin-bottom: 0px;padding-bottom: 50px;">
                    <div class="d-md-flex justify-content-between" style="margin-bottom: 0px;">
                        <div class="botLogo mx-3" style="display: column;">
                            <center>
                                <div>
                                    <figure>
                                        <img id="footerImage" src="../footer.png" height="100%" width="100%" style="-webkit-user-select: none;min-height: 100px;min-width: 270px;">
                                        <figcaption>
                                            <p class="text-light">22 F Imson Street, Brgy San Pedro, 1620 Pateros, Philippines</p>
                                        </figcaption>
                                    </figure>
                                </div>
                            </center>
                        </div>
                        <div class="container mb-0 botContacts footerDetails" style="align-items: center;justify-content: center;">
                            <!-- <div>
                                lolabertaslechonhaus@gmail.com
                            </div> -->
                            <div>
                                <h3>
                                    <img src="line.svg" alt=""><u>Contact us:</u>
                                </h3>
                                <div style="margin-left: 2%;">
                                <span>Tel #: 86424762 / 89945210</span>
                                <br>
                                <span>Globe: 09171629196 / 09453015251</span>
                                <br>
                                <span>Smart: 09084851397</span>
                                <br>
                                <span>Sun: 09258019125</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="container botFollow footerDetails">
                            <p>Follow us on: </p>
                            <div class="text-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class=" ms-4 bi bi-instagram" viewBox="0 0 16 16">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </footer>
    
</body>
</html>