<?php
    $hasActiveSession = false;
    include('admin/php/connection.php');
    $con = connect();
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])){
        session_unset();
        session_destroy();
        $hasActiveSession = false;
    }
    if(isset($_SESSION['client_user_id'])){
        $hasActiveSession = true;
        $userId = $_SESSION['client_user_id'];
        $query = $con->prepare('SELECT * FROM users WHERE id = ?');
        $query->bind_param('i', $userId);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_assoc();
        if($data['user_type'] == 'admin'){
            session_destroy();
            header('Location: ' . $_SERVER['PHP_SELF']);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D' Original Lola Berta's Lechon Haus</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="jquery.js"></script>
    <script src="js/toast.js"></script>
    <script src="main.js"></script>
        
    </script>
    <style>
        
    </style>
</head>
<body style="margin-bottom: 0px;background-color: black;">
    <header class="sticky-top shadow" style="-webkit-user-select: none; background-color: #fe6917;">
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="padding: 0px;">
            <div class="container">
                <div class="navbar-brand" style="margin: 0;">
                    <img style="margin: 0px;pointer-events: none;" id="logo-ni-lola" src="admin/Branding/received_727156111882599 page logo.png" height="70px" width="70px" alt="" srcset="">
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
                            <div class="input-group col-8 shadow">
                                <input type="text" class="form-control mt-0 mb-0" id="searchProductInput" placeholder="Search...">
                                <button class="btn btn-warning mt-0" id="searchProduct"><a href="#" style="text-decoration: none;color:black;">Search</a></button>
                            </div>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="myCart btn btn-warning shadow" id="mainCart" href="cart/">My Cart</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="#" class="nav-link" id="showProductList" style="color: white;">All Products</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="#" class="nav-link text-light" id="homeNav" style="color: white;">Home</a>
                        </li>
                       
                        <li class="nav-item mx-1">
                            <a href="#aboutUs" class="nav-link text-light" style="color: white;" id="aboutUsNav">About Us</a>
                        </li>
                        <?php if($hasActiveSession){
                        ?>
                            <li class="nav-item mx-1">
                                <div class="dropdown">
                                    <a href="#" class="active nav-link dropdown-toggle" data-bs-toggle="dropdown">Account</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                                <button name="logout" value="logout" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                                </svg><span class="ms-3">Log Out</span></button>
                                            </form>
                                            
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    
    <div style="display: flex;flex-direction: row-reverse;">
        <a id="cartPop" class=" myCart btn btn-warning shadow" style="position: fixed;margin-top: 0px;width: 100px;z-index: 100; margin-left: 10px;border-radius: 0 0 50% 50%;margin-right: 5%;border-top: 0px;border-bottom:thin black;border-left: ridge black;border-right:ridge black;" href="#" class="nav-link">
            <h6>My Cart</h6>
        </a>
        <a id="orderPop" class="ONB btn btn-danger shadow" style="position: fixed;margin-top: 0px;width: 100px;z-index: 100; margin-left: 10px;border-radius: 0 0 50% 50%;margin-right: 5%;border-top: 0px;border-bottom:thin black;border-left: ridge black;border-right:ridge black;" href="#" class="nav-link">
            <h6>Order Now</h6>
        </a>
    </div>
    <section id="welcomeCustomers" class="text-center mb-0">
        <div>
            <div id="headerImage">
                <div class="container">
                    <h1 id="header-title" class="fw-bold" style="text-shadow: 10px 10px rgb(255, 124, 36);"></h1>
                    <br>
                    <p id="header-sub-title" class="container"></p>
                    <br>
                    <a href="products/" class="my-btn rounded rounded-pill fs-3 px-5 fw-bold ONB" id="mainOrder">Order Now</a>

                    <?php
                        if(!$hasActiveSession){
                    ?>
                        <a href="login/" class="ms-3 my-btn-outline rounded-pill fs-3 px-5 fw-bold">Log In Now</a>
                    <?php
                        }
                    ?>
                    
                        
                </div>
            </div>
        </div>
        <div style="background-color: white;" class="pb-5">
            <div id="customSliderTitle">
            </div>
            <div id="sliderA" class="wrapper container pt-3 pb-3 mb-5">
            </div>
            <h4 id="gridTitle" class="pt-5 mb-0" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-size:50px;letter-spacing: 4px;"></h4>
            <div style="display: flex;align-items: center;justify-content: center;">
                <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-2 g-5 m-0 container" id="gridGallery" style="width: 100%;border-left: solid 10px rgba(0, 0, 255, 0);border-bottom: solid 2.5px rgba(0, 0, 255, 0);"></div>
            </div>
            <div class="m-0" id="ourHistorySliderTitle">
                <center>
                    <h4 class="pt-5 mb-5" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-size:50px;letter-spacing: 4px;">OUR HISTORY</h4>
                </center>
            </div>
            <div id="sliderB" class="wrapper container pt-3 pb-3">
            </div>
        </div>
    </section>
    <main id="main" class="pt-50" style="background-color: white;">
        <section>
            <div id="ListMessage" style="display: flex; justify-content:space-between">
                <hr style="width: 40%;height: 1px;background-color: aliceblue; border: none;padding-right: 10px;">
                <center>
                    <h5> 
                        <span class="text-light" style="margin-right:10px;">All Products</span>
                    </h5>
                </center>
                <hr style="width: 40%;margin-left: 10px;height: 1px;background-color: aliceblue; border: none;">
            </div>
            <div class="container">
                <div id="productList" class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3"></div>
            </div>
        </section>
        <!--searchBar Results-->
        <section style="padding-top: 25px;">
            <div id="searchMessage" style="display: flex;justify-content: space-between;">
                <hr style="width: 40%;margin-right: 10px;height: 1px;">
                <center>
                    <h6> 
                        <span id="searchMessageInput" style="margin-right:10px;"></span>
                    </h6>
                </center>
                <hr style="width: 40%;margin-left: 10px;height: 1px;">
            </div>
            <div id="searchProductList" style="display: grid; grid-template-columns:  repeat(auto-fill,minmax(320px,1fr));"></div>
        </section>
    </main>
    <div class="modal fade" id="viewProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(254,105,23);">
                    <div class="modal-title">
                        <h4 id="productName" class="text-light"></h4>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center my-3">
                        <img class="img-fluid" id="productImage" style="width:300px; height:auto;border: solid 5px rgb(255,191,8);border-radius: 10%;" src="" alt="">
                    </div>
                    <p>
                        <strong>Description: </strong>
                        <span id="productDescription"></span>
                    </p>
                    <p>
                        <strong>Quantity: </strong>
                        <span id="productQuantity"></span>
                    </p>
                    <p>
                        <strong>Price: </strong>
                        <span>&#8369</span><span id="productPrice"></span>
                    </p>
                    <div class="d-flex justify-content-between">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myOrderslist">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(254,105,23);">
                    <div class="modal-title">
                        <h4 class="text-light">My Cart</h4>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div style="display: flex;flex-direction:column;" class="modal-body">
                    <div id="cartList" style="margin-bottom: 20px;">

                    </div>
                    <div class="mt-4 shadow" style="background-color: rgb(41,22,5);border-top: 5px solid rgb(254,104,27);border-bottom: solid 5px rgb(254,104,27);">
                        <center>
                            <h4 style="margin-top: 5px;color: rgb(254,254,6);">Customer Information</h4>
                        </center>
                    </div>
                    <div class="shadow" style="padding: 10px;">
                        <div>
                            <input class="form-control mt-3" type="text" id="customerName" placeholder="Customer Name">
                            <div class="invalid-feedback">Please Fill Up This Field</div>
                        </div>
                        <div>
                            <input class="form-control mt-3" type="text" id="CustomerAddr" placeholder="Customer Address">
                            <div class="invalid-feedback">Please Fill Up This Field</div>
                        </div>
                        <div>
                            <input class="form-control mt-3" type="number" id="CustomerContactNumber" placeholder="Contact Number">
                            <div class="invalid-feedback">Invalid Contact Number</div>
                        </div>
                        <div>
                            <select class="form-select mt-3" id="customerOrderType">
                                <option value="Delivery">Delivery</option>
                                <option value="Pick-up">Pick-up</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-outline-success mt-3" id="confirm-my-order">Confirm Order</button>
                </div>
            </div>
        </div>
    </div>
    
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
                                        <img id="footerImage" src="footer.png" height="100%" width="100%" style="-webkit-user-select: none;min-height: 100px;min-width: 270px;">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                </svg> Contact Us
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
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="height: fit-content;width: fit-content;">
        <div style="width: 500px;" id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header text-light" style="background-color: rgb(254,105,23);">
            <strong id="toastImageTitle" class="h5 me-auto">Loading...</strong>
            <code class="text-dark">Date: <span id="toastImageDateAdded">Loading...</span></code>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            <div id="toastMessage">Loading...</div>
            <br>
            <center>
                <div id="toastImage" style="height: fit-content;width:fit-content">
                    <img src="footer.png" height="100px" width="200px" class="rounded me-2" alt="...">
                </div>
            </center>
          </div>
        </div>
    </div>
</body>
</html>