
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script> -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <script src="jquery.js"></script>
    <script src="main.js"></script>
</head>
<style>
    #logo-ni-lola{
            display: none;
        }

        @media (min-width: 768px){
            #logo-ni-lola{
                display:inline;
            }
        }
    #imgLarge{
        height: 20px; 
        width: 50px; 
        font-size: 10px;
        font-style:initial;
        padding: 2px;
        
    }
    /*add product button*/
    #addProduct{
        background-color: rgb(254,105,23);
        transition-duration: .3s;
    }
    #addProduct:hover{
        background-color: rgb(255, 128, 60);
    }
    .customizedButton{
        background-color: rgb(254,105,23);
        transition-duration: .3s;
    }
    .customizedButton:hover{
        background-color: rgb(255, 128, 60);
    }
    #imgLarge{
        margin: 10px;
    }
</style>
<body>
    <header class="sticky-top" style="background-color: rgb(254,105,23);">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <div class="navbar-brand m-0">
                    <img id="logo-ni-lola" src="Branding/received_727156111882599 page logo.png" height="60px" width="60px" alt="">
                </div>
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="nav-menu" class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link px-2" id="pageCustomizationNav" style="color: white;">Page Customization</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link px-2" id="myProductsNav" style="color: white;">My Products</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link px-2" id="salesReportNav" style="color:white;">Sales Report</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link px-2" id="ordersNav" style="color:white;">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link btn btn-warning text-dark rounded-pill mx-5 px-3 shadow" id="logOut">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section id="customerPageCustomizationSection">
            <div class="container">
                <div class="card mt-5 shadow">
                    <div class="card-header text-center" style="background-color: rgb(41,22,5); border-top:solid 10px rgb(254,105,23);border-bottom: solid 10px rgb(254,105,23);">
                        <center>
                            <h4 class="mt-2" style="color: rgb(253,255,5);font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">CUSTOMER PAGE CUSTOMIZATION</h4>
                        </center>
                    </div>
                    <div class="card-body" style="background-color: rgb(255,191,8);">
                        <div class="shadow text-center pt-3 pb-3 rounded-5" style="background-color: rgb(41,22,5);">
                            <button class="CPCbtn btn btn-danger text-light shadow mt-1" id="editCarouselButton">Title</button>
                            <button class="CPCbtn btn btn-danger text-light shadow mt-1" id="editSliderAButton">Custom Slider</button>
                            <button class="CPCbtn btn btn-danger text-light shadow mt-1" id="editImageGridButton">Image Grid</button>
                            <button class="CPCbtn btn btn-danger text-light shadow mt-1" id="editSliderBButton">Our History Slider</button>
                        </div>
                        <section id="editCarouselSection">
                            <div class="container">
                                <div class="card mt-3 rounded-5 shadow">
                                    <div class="card-header d-flex">
                                        <h4 class="fw-bold my-3 mx-5">Title:</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <th scope="col">Main Title <button data-bs-toggle="modal" data-bs-target="#editMainTitleModal" class="customizedButton btn mx-3" style="background-color: rgb(254,103,23);">Update Main Title</button></th>
                                            </thead>
                                            <tbody>
                                                <td class="m-3">
                                                    <div>
                                                        <div>
                                                            <center>
                                                                <h4 id="mainTitle" class="m-0 p-2" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;"></h4>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped">
                                            <thead>
                                                <th scope="col">Subtitle <button data-bs-toggle="modal" data-bs-target="#editSubtitleModal" class="customizedButton btn mx-3" style="background-color: rgb(254,103,23);">Update Subtitle</button></th>
                                            </thead>
                                            <tbody>
                                                <td class="m-3">
                                                    <div>
                                                        <div>
                                                            <center>
                                                                <h4 id="subtitle" class="m-0 p-2" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;"></h4>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tbody>
                                        </table>
                                        <!-- <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <th scope="col">Main Image <button class="customizedButton btn mx-3" style="background-color: rgb(254,103,23);" data-bs-toggle="modal" data-bs-target="#editMainCarouselModal">Update Main Image</button></th>
                                                </thead>
                                                <tbody>
                                                    <td class="m-3">
                                                        <center>
                                                            <div id="mainCarousel">
                                                            </div>
                                                        </center>
                                                    </td>
                                                </tbody>
                                            </table>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="addSliderASection">
                            <div class="container">
                                <div class="card mt-3 rounded-5 shadow">
                                    <div class="card-header d-flex text-center">
                                        <h4 class="fw-bold my-3 mx-5">Custom Slider: </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <th scope="col">Slider Title <button data-bs-toggle="modal" data-bs-target="#editSliderATitleModal" class="customizedButton btn mx-3" style="background-color: rgb(254,103,23);">Update Slider Title</button></th>
                                                </thead>
                                                <tbody>
                                                    <td class="m-3">
                                                        <div id="addedSliderATitleList">
                                                        </div>
                                                    </td>
                                                </tbody>
                                            </table>
                                            <table class="table table-striped">
                                                <thead>
                                                    <th scope="col">Added Images <button data-bs-toggle="modal" data-bs-target="#addSliderAModal" class="customizedButton btn mx-3" style="background-color: rgb(254,103,23);" id="addSliderAButton">Add Image</button></th>
                                                </thead>
                                                <tbody>
                                                    <td class="m-3">
                                                        <div id="addedSliderAList" style="display: grid; grid-template-columns:  repeat(auto-fill,minmax(250px,1fr));">
                                                        </div>
                                                    </td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="addSliderBSection">
                            <div class="container">
                                <div class="card mt-3 rounded-5 shadow">
                                    <div class="card-header d-flex text-center">
                                        <h4 class="fw-bold my-3 mx-5">History Images: </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <th scope="col">Added Images <button data-bs-toggle="modal" data-bs-target="#addSliderBModal" class="customizedButton btn mx-3" style="background-color: rgb(254,103,23);" id="addSliderBButton">Add Image</button></th>
                                                </thead>
                                                <tbody>
                                                    <td class="m-3">
                                                        <div id="addedSliderBList" style="display: grid; grid-template-columns:  repeat(auto-fill,minmax(250px,1fr));">
                                                        </div>
                                                    </td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="editImageGridSection">
                            <div class="container">
                                <div class="card mt-3 rounded-5 shadow">
                                    <div class="card-header d-flex text-center">
                                        <h4 class="fw-bold my-3 mx-5">Image Grid</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <th scope="col">Grid Title <button data-bs-toggle="modal" data-bs-target="#editGridTitleModal" class="customizedButton btn mx-3" style="background-color: rgb(254,103,23);">Update Grid Title</button></th>
                                                </thead>
                                                <tbody>
                                                    <td class="m-3">
                                                        <div>
                                                            <div>
                                                                <center>
                                                                    <h4 id="imageGridTitle" class="m-0 p-2" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;"></h4>
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tbody>
                                            </table>
                                            <table class="table table-striped">
                                                <thead>
                                                    <th scope="col">Images <button data-bs-toggle="modal" data-bs-target="#editImageGridModal" class="customizedButton btn mx-3" style="background-color: rgb(254,103,23);">Add Image Grid</button></th>
                                                </thead>
                                                <tbody>
                                                    <td class="m-3">
                                                        <div id="addedImageGridList" style="display: grid; grid-template-columns:  repeat(auto-fill,minmax(500px,1fr));">
                                                        </div>
                                                    </td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
        <section id="myProductsSection">
            <div class="container">
                <div class="card mt-5 rounded-5 shadow">
                    <div class="card-header d-lg-flex">
                        <h4 class="fw-bold m-3 mx-lg-5">My Products:</h4>
                        <button id="addProduct" data-bs-toggle="modal" data-bs-target="#addProductModal" class="btn px-4 m-2 shadow">Add Product</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Product Description</th>
                                    <th scope="col">Available</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Operations</th>
                                </thead>
                                <tbody id="productsTable">
                                    <!--Example only-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--view Product Image-->
                <div class="modal fade" id="viewProductImage">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(254,105,23);">
                                <div class="modal-title">
                                    <h4 id="certainProductName"></h4>
                                </div>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center my-3">
                                    <img id="certainProductImage" src="" alt="" height="300px" width="300px">
                                </div>
                                <p>
                                    <strong>Description: </strong><span id="certainProductDescription"></span>
                                </p>
                                <p>
                                    <strong>Available: </strong><span id="certainProductQuantity"></span>
                                </p>
                                <p>
                                    <strong>Price: </strong><span>&#8369</span><span id="certainProductPrice"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!--edit select edit method modal-->
                <div class="modal fade" id="edit-product-modal" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title d-flex">
                                    <img src="../footer.png" style="height: 50px; width: 50px; object-fit:cover" alt="">
                                    <h4 class="ms-3 align-self-center">Edit Product</h4>
                                </div>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <input type="text" class="form-control" id="edit-product-name" placeholder="Product Name">
                                    <div class="invalid-feedback" id="edit-product-name-error"></div>
                                </div>
                                <div class="w-100 text-center">
                                    <img id="edit-product-image" src="" class="img-fluid mx-auto" style="height: 100px; width: 100px; object-fit: cover" alt="">
                                </div>
                                <div>
                                    <input style="display: none" type="file" class="form-control" id="edit-product-image">
                                    <label style="cursor: pointer; background-color: lightgray" class="w-100 text-center mt-3 px-5 py-2 rounded-2" for="edit-product-image">Select Image</label>
                                    <div class="invalid-feedback" id="edit-product-image-error"></div>
                                </div>
                                <div>
                                    <input type="text" placeholder="Product Description" class="form-control mt-3" id="edit-product-description">
                                    <div class="invalid-feedback" id="edit-product-description-error"></div>
                                </div>
                                <div>
                                    <input type="number" placeholder="Available" class="form-control mt-3" id="edit-product-available">
                                    <div class="invalid-feedback" id="edit-product-available-error"></div>
                                </div>
                                <div>
                                    <input type="number" placeholder="Price" class="form-control mt-3" id="edit-product-price">
                                    <div class="invalid-feedback" id="edit-product-price-error"></div>
                                </div>
                                <button id="confirm-edit-product" class="btn btn-danger w-100 mt-3">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--edit Certain product data modal-->
                <div class="modal fade" id="editCertainProductDataModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(254,105,23);">
                                <div class="modal-title justify-content-between">
                                    <h4>Manual Data Edit</h4>
                                </div>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <input type="text" class="form-control mt-3" id="manualNameEdit" placeholder="Product Name">
                                    <div class="invalid-feedback">Please Fill up this field</div>
                                    <button id="manualNameEditButton" class="btn btn-success rounded-pill mt-2">Update Name</button>
                                </div>
                                <hr>
                                <div>
                                    <input type="file" class="form-control mt-3" id="manualFileEdit" placeholder="Product File">
                                    <div class="invalid-feedback">Please Fill up this field</div>
                                    <button id="manualFileEditButton" class="btn btn-success rounded-pill mt-2">Update Image</button>
                                </div>
                                <hr>
                                <div>
                                    <input type="text" class="form-control mt-3" id="manualDescriptionEdit" placeholder="Product Description">
                                    <div class="invalid-feedback">Please Fill up this field</div>
                                    <button id="manualDescriptionEditButton" class="btn btn-success rounded-pill mt-2">Update Description</button>
                                </div>
                                <hr>
                                <div>
                                    <input type="number" class="form-control mt-3" id="manualQuantityEdit" placeholder="Product Quantity">
                                    <div class="invalid-feedback">Please Fill up this field</div>
                                    <button id="manualQuantityEditButton" class="btn btn-success rounded-pill mt-2">Update Quantity</button>
                                </div>
                                <hr>
                                <div>
                                    <input type="number" class="form-control mt-3" id="manualPriceEdit" placeholder="Product Price">
                                    <div class="invalid-feedback">Please Fill up this field</div>
                                    <button id="manualPriceEditButton" class="btn btn-success rounded-pill mt-2">Update Price</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--edit all product data modal-->
                <div class="modal fade" id="editProductModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header"  style="background-color: rgb(254,105,23);">
                                <div class="modal-title">
                                    <h4>Edit Product</h4>
                                </div>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <input class="form-control mt-3" id="editName" type="text" placeholder="Product Name">
                                    <div class="invalid-feedback">Please Fill up this feild</div>
                                </div>
                                <div>
                                    <input class="form-control mt-3" id="editFile" type="file">
                                    <div class="invalid-feedback">Please Fill up this field</div>
                                </div>
                                <div>
                                    <input class="form-control mt-3" id="editDescription" type="text" placeholder="Product Description">
                                    <div class="invalid-feedback">Please Fill up this field</div>
                                </div>
                                <div>
                                    <input class="form-control mt-3" id="editQuantity" type="number" placeholder="Quantity">
                                    <div class="invalid-feedback">Please Fill up this field</div>
                                </div>
                                <div>
                                    <input class="form-control mt-3" id="editPrice" type="number" placeholder="Price">
                                    <div class="invalid-feedback">Please Fill up this field</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button id="confirmEditProduct" class="btn btn-outline-success col-3 rounded-pill mt-2">Update</button>
                                    <button id="resetAllEditFields" class="btn btn-outline-danger col-3 rounded-pill mt-2">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--add product modal-->
                <div class="modal fade" id="addProductModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(254,105,23);">
                                <div class="modal-title">
                                    <h4>New Product</h4>
                                </div>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <input class="form-control mt-3" id="productName" type="text" placeholder="Product Name">
                                    <div class="invalid-feedback">Please Fill up this feild</div>
                                </div>
                                <div>
                                    <input class="form-control mt-3" id="productFile" type="file">
                                    <div class="invalid-feedback">Please Fill up this field</div>
                                </div>
                                <div>
                                    <input class="form-control mt-3" id="productDescription" type="text" placeholder="Product Description">
                                    <div class="invalid-feedback">Please Fill up this field</div>
                                </div>
                                <div>
                                    <input class="form-control mt-3" id="productQuantity" type="number" placeholder="Quantity">
                                    <div class="invalid-feedback">Please Fill up this field</div>
                                </div>
                                <div>
                                    <input class="form-control mt-3" id="productPrice" type="number" placeholder="Price">
                                    <div class="invalid-feedback">Please Fill up this field</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button id="confirmNewProduct" class="btn btn-outline-success col-3 rounded-pill mt-2">Add Product</button>
                                    <button id="resetAllFields" class="btn btn-outline-danger col-3 rounded-pill mt-2">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="ordersSection">
            <div class="container">
                <div class="card mt-5 rounded-5 shadow">
                    <div class="card-header">
                        <h4 class="fw-bold my-3 mx-5">Orders:</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Order Type</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Delivery Address</th>
                                    <th scope="col">Actions</th>
                                </thead>
                                <tbody id="ordersTable">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="salesReportSection">
            <div class="container">
                <div class="card mt-5 rounded-5 shadow">
                    <div class="card-header">
                        <h4 class="fw-bold my-3 mx-5">Sales Report:</h4>
                    </div>
                    <div class="card-body">

                        
                        <input id="year-sales" type="number" class="mb-4 form-control" placeholder="Specify Year">

                        <div id="instructions" class="text-center" style="padding: 20%">
                            <p class="text-secondary">
                                Specify the year then click "Generate Sales Report" to view sales chart
                            </p>
                        </div>
                        <canvas id="sales-chart" style="width:100%;"></canvas>
                    </div>
                    <div class="card-footer">
                        <button id="generate-sales-report" class="btn btn-success rounded-pill px-5">Generate Sales Report</button>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer></footer>
</body>
    <!--add carousel-->
    <div class="modal fade" id="addCarouselModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(254,105,23);">
                    <div class="modal-title">
                        <h4 class="text-light">Add Slide-show Image</h4>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control" id="additionalCarouselFile" type="file">
                    <div class="invalid-feedback">Please Select Image</div>
                </div>
                <div>
                    <button id="addCarouselImageButton" class="btn btn-success m-2 mt-1 my-3 mx-3">Add Image</button>
                </div>
            </div>
        </div>
    </div>
    <!--add sliderA modal-->
    <div class="modal fade" id="addSliderAModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(254,105,23);">
                    <div class="modal-title">
                        <h4 class="text-light">Add First Slider Image</h4>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <input class="form-control mt-3" type="text" id="additionalSliderATitle" placeholder="Image Title">
                        <div class="invalid-feedback">Please Fill Up this Field</div>
                    </div>
                    <div>
                        <input class="form-control mt-3" id="additionalSliderAFile" type="file">
                        <div class="invalid-feedback">Please Select Image</div>
                    </div>
                    <div>
                        <input class="form-control mt-3" type="text" id="additionalSliderACaption" placeholder="Image Caption">
                        <div class="invalid-feedback">Please Fill Up this Field</div>
                    </div>
                    <div>
                        <input id="slider-a-date-input" class="form-control mt-3" type="date">
                        <div class="invalid-feedback">Please Select Date</div>
                    </div>
                </div>
                <div>
                    <button id="additionalSliderAButton" class="btn btn-success m-2 mt-1 my-3 mx-3">Add Image</button>
                </div>
            </div>
        </div>
    </div>
    <!--add sliderB modal-->
    <div class="modal fade" id="addSliderBModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(254,105,23);">
                    <div class="modal-title">
                        <h4 class="text-light">Add Second Slider Image</h4>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <input class="form-control mt-3" type="text" id="additionalSliderBTitle" placeholder="Image Title">
                        <div class="invalid-feedback">Please Fill Up this Field</div>
                    </div>
                    <div>
                        <input class="form-control mt-3" id="additionalSliderBFile" type="file">
                        <div class="invalid-feedback">Please Select Image</div>
                    </div>
                    <div>
                        <input class="form-control mt-3" type="text" id="additionalSliderBCaption" placeholder="Image Caption">
                        <div class="invalid-feedback">Please Fill Up this Field</div>
                    </div>
                    <div>
                        <input id="slider-b-date-input" class="form-control mt-3" type="date">
                        <div class="invalid-feedback">Please Select Date</div>
                    </div>
                </div>
                <div>
                    <button id="additionalSliderBButton" class="btn btn-success m-2 mt-1 my-3 mx-3">Add Image</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--view order modal-->
    <div class="modal fade" id="view-order-modal" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title d-flex">
                        <img src="../footer.png" class="img-fluid" style="height:30px; width: 30px; object-fit: cover;" alt="">
                        <div class="ms-3">
                            <h5 class="fw-bold">
                                Order Information
                                
                            </h5>
                            <p class="lh-sm" id="number-of-items">10 items</p>
                        </div>
                        
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="order-placeholder" class="placeholder-glow w-100">
                        <span class="placeholder col-12"></span>
                        <span class="placeholder col-12"></span>   
                        <span class="placeholder col-12"></span>   
                    </p>
                    <div id="order-products-list">

                    </div>
                    
                </div>
                <div class="modal-footer d-flex flex-column">
                    
                    <ul class="me-auto" id="order-statuses">

                    </ul>
                    
                    
                    
                    <div class="w-100">
                        <hr>
                        
                        <p>Add Status:</p>
                        <select id="order-status" class="form-select">
                            <option value="Preparing">Preparing</option>
                            <option value="For Delivery">For Delivery</option>
                            <option value="Claimed">Claimed</option>
                        </select>
                        <button id="update-order-status" class="btn btn-danger mt-3 w-100">Update Order Status</button>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
    <!--dit main carousel-->
    <div class="modal fade" id="editMainCarouselModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(254,105,23);">
                    <div class="modal-title">
                        <h4 class="text-light">Edit Main Image</h4>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control" id="editMainCarouselFile" type="file">
                    <div class="invalid-feedback">Please Select Image</div>
                </div>
                <div>
                    <button id="editMainCarouselImageButton" class="btn btn-success m-2 mt-1 my-3 mx-3">Update Image</button>
                </div>
            </div>
        </div>
    </div>
    <!--sliderA Title-->
    <div class="modal fade" id="editSliderATitleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(254,105,23);">
                    <div class="modal-title">
                        <h4 class="text-light">Update Slider Title</h4>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control" id="editSliderATitleInput" type="text" placeholder="Slider Title">
                    <div class="invalid-feedback">Please Fill Up This Field</div>
                </div>
                <div>
                    <button id="editSliderATitleButton" class="btn btn-success m-2 mt-1 my-3 mx-3">Update Title</button>
                </div>
            </div>
        </div>
    </div>
    <!---grid title-->
    <div class="modal fade" id="editGridTitleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(254,105,23);">
                    <div class="modal-title">
                        <h4 class="text-light">Update Grid Title</h4>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control" id="editGridTitleInput" type="text" placeholder="Grid Title">
                    <div class="invalid-feedback">Please Fill Up This Field</div>
                </div>
                <div>
                    <button id="editGridTitleButton" class="btn btn-success m-2 mt-1 my-3 mx-3">Update Title</button>
                </div>
            </div>
        </div>
    </div>
    <!---main title-->
    <div class="modal fade" id="editMainTitleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(254,105,23);">
                    <div class="modal-title">
                        <h4 class="text-light">Update Main Title</h4>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control" id="editMainTitleInput" type="text" placeholder="Grid Title">
                    <div class="invalid-feedback">Please Fill Up This Field</div>
                </div>
                <div>
                    <button id="editMainTitleButton" class="btn btn-success m-2 mt-1 my-3 mx-3">Update Title</button>
                </div>
            </div>
        </div>
    </div>
    <!---sub title-->
    <div class="modal fade" id="editSubtitleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(254,105,23);">
                    <div class="modal-title">
                        <h4 class="text-light">Update Subtitle</h4>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" id="editSubtitleInput" type="text" placeholder="Grid Title"></textarea>
                    <div class="invalid-feedback">Please Fill Up This Field</div>
                </div>
                <div>
                    <button id="editSubtitleButton" class="btn btn-success m-2 mt-1 my-3 mx-3">Update Title</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editImageGridModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(254,105,23);">
                    <div class="modal-title">
                        <h4 class="text-light">Add Image Grid</h4>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <input class="form-control mt-3" id="imageGridTitleInput" maxlength="30" type="text" placeholder="Image Grid Title">
                        <div class="invalid-feedback">Please Fill Up This Field</div>
                    </div>
                    <div>
                        <input class="form-control mt-3" id="imageGridFileInput" type="file">
                        <div class="invalid-feedback">Please Fill Up This Field</div>
                    </div>
                    <div>
                        <textarea class="form-control mt-3" id="imageGridDetailsInput" type="text" placeholder="Image Grid Details" style="height: fit-content;"></textarea>
                        <div class="invalid-feedback">Please Fill Up This Field</div>
                    </div>
                </div>
                <div>
                    <button id="addImageGridButton" class="btn btn-success m-2 mt-1 my-3 mx-3">Add Image</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="height: fit-content;width: fit-content;">
        <div style="width: 500px;" id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header text-light" style="background-color: rgb(254,105,23);">
            <strong id="toastImageTitle" class="h5 me-auto">Loading...</strong>
            <code class="text-dark">Date Captured: <span id="toastImageDateAdded">Loading...</span></code>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            <div id="toastMessage">Loading...</div>
            <br>
            <center>
                <div id="toastImage" style="height: fit-content;width:fit-content">
                    <img src="../footer.png" height="100px" width="200px" class="rounded me-2" alt="...">
                </div>
            </center>
          </div>
        </div>
    </div>
</html>