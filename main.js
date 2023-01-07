$(document).ready(function(){
    var mainOrder = $('#mainOrder');
    var orderPop = $('#orderPop');
    var totalOfCart = 0;
    var productIds = [];
    var productQuantities = [];
    var globalProductId = 0;
    var productList = $('#productList');
    var searchProductList = $('#searchProductList');
    var searchProductInput = $('#searchProductInput');
    var searchProduct = $('#searchProduct');
    var showProductList = $('#showProductList');
    var productName = $('#productName');
    var productImage = $('#productImage');
    var productDescription = $('#productDescription');
    var productQuantity = $('#productQuantity');
    var productPrice = $('#productPrice');
    var cartPop = $('#cartPop');
    var mainCart = $('#mainCart');
    var myCart = $('.myCart');
    var searchMessageInput = $('#searchMessageInput');
    var myOrderslist = $('#myOrderslist');
    var cartList = $('#cartList');
    var welcomeBlockquote = $('#welcomeCustomers');
    var confirmMyOrder = $('#confirm-my-order');
    var customerName = $('#customerName');
    var customerAddress = $('#CustomerAddr');
    var CustomerContactNumber = $('#CustomerContactNumber');
    var customerOrderType = $('#customerOrderType');
    var mainCarouselImage = $('#mainCarouselImage');
    var slideShowCarousel = $('#slide-show');
    var facebookRedirect = $('.facebookRedirect');
    var instagramRedirect = $('.instagramRedirect');
    var orderNowButton = $('.ONB');
    var main = $('#main');
    var homeNav = $('#homeNav');
    var searchNav = $('#searchNav');
    var sliderA = $('#sliderA');
    var sliderB = $('#sliderB');
    var toastImageTitle = $('#toastImageTitle');
    var toastImageDateAdded = $('#toastImageDateAdded');
    var toastMessage = $('#toastMessage');
    var toastImage = $('#toastImage');
    var customSliderTitle = $('#customSliderTitle');
    var gridGallery = $('#gridGallery');
    var aboutUsNav = $('#aboutUsNav');
    var gridTitle = $('#gridTitle');
    var headerTitle = $('#header-title');
    var headerSubtitle = $('#header-sub-title');
    
    const toastTrigger = $('.liveToastBtn');
    const toastLiveExample = $('#liveToast');
    
    toastTrigger.click(function(){
        const toast = new bootstrap.Toast(toastLiveExample)
        toast.show();
    });

    $('#mainCart,#cartPop,#searchNav,#showProductList,#main,#mainOrder,#orderPop,#homeNav').hide();
    // mainOrder.click(function(){
    //     alert('tester')
    // });
    //myCart Position On Start
    if($(window).width() < 976){
        orderPop.show();
        mainOrder.hide();
    }else{
        mainOrder.show();
        orderPop.hide();
    }
    //myCart Position when window is resized
    $(window).hover(function(){
        if(!orderNowButton.hasClass('onOrder')){
            if($(window).width() < 976){
                orderPop.show('fast');
                mainOrder.hide('fast');
            }else{
                mainOrder.show('fast');
                orderPop.hide('fast');
            }
        }
        else{
            if($(window).width() < 976){
                cartPop.show('fast');
                mainCart.hide('fast');
            }else{
                mainCart.show('fast');
                cartPop.hide('fast');
            }
        }
    });
    homeNav.click(function(){
        $(this).hide('fast');
        orderNowButton.removeClass('onOrder');
        showProductList.hide('fast');
        aboutUsNav.show('fast');
        myCart.hide('fast');
        main.hide('fast');
        searchNav.hide('fast');
        $('#customSliderTitle,#sliderA,#sliderB,#ourHistorySliderTitle,#gridGallery,#welcomeCustomers,#aboutUsSection').slideDown('slow');
        if($(window).width() < 976){
                orderPop.show('fast');
                mainOrder.hide('fast');
            }else{
                mainOrder.show('fast');
                orderPop.hide('fast');
            }
    });
    // orderNowButton.click(function(){
    //     if(searchProduct.hasClass('onSearch')){
    //         showProductList.show('fast');
    //     }
    //     if($(window).width() < 976){
    //             orderPop.show('fast');
    //             mainOrder.hide('fast');
    //         }else{
    //             mainOrder.show('fast');
    //             orderPop.hide('fast');
    //         }
    //     $(orderNowButton).addClass('onOrder');
    //     $('#mainOrder,#orderPop,#aboutUsNav').hide('fast');

    //     $('#customSliderTitle,#sliderA,#sliderB,#ourHistorySliderTitle,#gridGallery,#welcomeCustomers,#aboutUsSection').slideUp('fast');
    //     $('#homeNav').show('fast');
    //     $('#searchNav,main').show('slow');
    // });

    facebookRedirect.hover(function(){
        $(this).css('cursor','pointer');
    });
    facebookRedirect.click(function(){
        location.replace('https://www.facebook.com/lolabertaslechon')
    });
    instagramRedirect.hover(function(){
        $(this).css('cursor','pointer');
    });
    instagramRedirect.click(function(){
        location.replace('https://www.instagram.com/lolabertas')
    });
    $.ajax({
        type: 'POST',
        url: 'admin/php/displayGridImages.php',
        success:function(response){
            var data = JSON.parse(response);
            $(data).each(function(index,value){
                gridGallery.append(`
                    <div class="col">
                        <div class="card containera gridItem shadow sahadow-lg">
                            <img class="card-img-top" src="admin/${value.image_file}" alt="Card image cap" style="height:auto;width: 100%;">
                            <div class="card-body">
                            <h5 class="card-title fw-bold">${value.image_title}</h5>
                            <p class="card-text">${value.image_details}</p>
                            </div>
                        </div>
                    </div>
                `);
            });
        }
    });
    $.ajax({
        type: 'POST',
        url: 'admin/php/displayCustomSliderTitle.php',
        success:function(response){
            var data = JSON.parse(response);
            $(data).each(function(index,value){
                customSliderTitle.append(`
                <div>
                    <center>
                        <h4 class="pt-5" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-size:50px;letter-spacing: 4px;">${value.slider_title}</h4>
                    </center>
                </div>
                `);
                gridTitle.append(`
                    ${value.grid_title}
                `);
                headerTitle.text(`
                    ${value.opening_title}
                `);
                headerSubtitle.text(`
                    ${value.opening_subtitle}
                `);
            });
        }
    });
    $.ajax({
        type: 'POST',
        url: 'admin/php/displaySliderA.php',
        success:function(response){
            var data = JSON.parse(response);
            $(data).each(function(index,value){
                sliderA.append(`
                    <div class="card item mx-5 shadow shadow-md" style="width: 18rem;">
                        <img class="card-img-top" src="admin/${value.image}" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title fw-bold">${value.title}</h5>
                        <p class="card-text">${value.caption}</p>
                        </div>
                    </div>
                `);
            });
            const toastTriggerA = $('.liveToastBtn1');
            const toastLiveExample = $('#liveToast');
            
            toastTriggerA.click(function(){
                globalProductId = $(this).parent().children().eq(1).val();
                toastImage.children().remove();
                toastImageTitle.text(`Loading...`);
                toastImageDateAdded.text(`Loading...`);
                toastMessage.text(`Loading...`);
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show();
                $.ajax({
                    type: 'POST',
                    url: 'admin/php/viewSliderA.php',
                    data:
                    {
                        image_id: globalProductId,
                    },
                    success:function(response){
                        var imgData = JSON.parse(response);
                        $(imgData).each(function(index,value){
                            toastImageTitle.text(`
                                ${value.slider_title}
                            `);
                            toastImageDateAdded.text(`
                                ${value.date_captured}
                            `);
                            toastMessage.text(`
                                ${value.slider_caption}
                            `);
                            toastImage.append(`
                                <img src="admin/${value.slider_image}" style="max-height:300px;max-width:100%;" class="rounded me-2" alt="...">
                            `)
                        });
                    }
                });
            });
        }
    });
    $.ajax({
        type: 'POST',
        url: 'admin/php/displaySliderB.php',
        success:function(response){
            var data = JSON.parse(response);
            $(data).each(function(index,value){
                sliderB.append(`
                <div class="card item mx-5 shadow shadow-md" style="width: 18rem;">
                        <img class="card-img-top" src="admin/${value.image}" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title fw-bold">${value.title}</h5>
                        <p class="card-text">${value.caption}</p>
                        </div>
                    </div>
                `);
            });
            const toastTrigger = $('.liveToastBtn');
            const toastLiveExample = $('#liveToast');
            
            toastTrigger.click(function(){
                globalProductId = $(this).parent().children().eq(1).val();
                
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show();
                $.ajax({
                    type: 'POST',
                    url: 'admin/php/viewSliderB.php',
                    data:
                    {
                        image_id: globalProductId,
                    },
                    success:function(response){
                        var imgBData = JSON.parse(response);
                        toastImage.children().remove();
                        $(imgBData).each(function(index,value){
                            toastImageTitle.text(`
                                ${value.slider_title}
                            `);
                            toastImageDateAdded.text(`
                                ${value.date_captured}
                            `);
                            toastMessage.text(`
                                ${value.slider_caption}
                            `);
                            toastImage.append(`
                                <img src="admin/${value.slider_image}" style="max-height:300px;max-width:100%;" class="rounded me-2" alt="...">
                            `)
                        });
                    }
                });
            });
        }
    });
    
    $.ajax({
        type: 'POST',
        url: 'admin/php/displayMainCarousel.php',
        success:function(response){
            var data = JSON.parse(response);
            $(data).each(function(index,value){
                mainCarouselImage.append(`
                    <img class="carouselImg" src="admin/${value.image}" style="height: auto; width: 100%">
                `);
            });
        }
    });
    $.ajax({
        type: 'POST',
        url: 'admin/php/displayCarousel.php',
        success:function(response){
            var data = JSON.parse(response);
            $(data).each(function(index,value){
                slideShowCarousel.append(`
                <div class="carousel-item">
                    <img class="carouselImg" src="admin/${value.image}" style="height: auto; width: 100%">
                </div>
                `);
            })
        }
    });

    customerName.on('keyup',function(){
        customerName.removeClass('is-invalid');
    })
    customerAddress.on('keyup',function(){
        customerAddress.removeClass('is-invalid');
    })
    CustomerContactNumber.on('keyup',function(){
        CustomerContactNumber.removeClass('is-invalid');
    })
    confirmMyOrder.click(function(){
        productIds = productIds.filter(function(obj){
            return obj != 'del';
        });
        productQuantities = productQuantities.filter(function(obj){
            return obj != 'del';
        });
        if(customerName.val() == ""){
            customerName.addClass('is-invalid');
        }
        if(customerAddress.val() == ""){
            customerAddress.addClass('is-invalid');
        }

        console.log(CustomerContactNumber.val().charAt(1));


        if(CustomerContactNumber.val().length < 11 || CustomerContactNumber.val().length > 11 || CustomerContactNumber.val().charAt(0) != '0' || CustomerContactNumber.val().charAt(1) != '9'){
            CustomerContactNumber.addClass('is-invalid');
        }
        if(customerName.val() != "" && customerAddress.val() != "" && CustomerContactNumber.val() != "" && (CustomerContactNumber.val().charAt(0) == '0' && CustomerContactNumber.val().charAt(1) == '9' && CustomerContactNumber.val().length == 11)){
            if(confirm("Proceed?") == true){
                $.ajax({
                    type: 'POST',
                    url: 'admin/php/order.php',
                    data:
                    {
                        customerName: customerName.val(),
                        customerAddress: customerAddress.val(),
                        CustomerContactNumber: CustomerContactNumber.val(),
                        customerOrderType: customerOrderType.val(),
                        productIds: productIds,
                        productQuantities: productQuantities,
                    },
                    success:function(response){
                        alert("Thank You for Ordering Here at Lola Berta's Lechon.");
                        location.reload();
                    }
                });
            }
        }
    })
    mainCart.click(function(){
        
    });
    cartPop.on('click', function(){
        productIds = productIds.filter(function(obj){
            return obj != 'del';
        })
        productQuantities = productQuantities.filter(function(obj){
            return obj != 'del';
        })
        if(productIds.length == 0 || productQuantities.length == 0){
            alert('Your Cart is currently empty.');
        }else{
            myOrderslist.modal('show');
            cartList.children().remove();
            $.ajax({
                type: 'POST',
                url: 'admin/php/proccessOrders.php',
                data:
                {
                    productIds: productIds,
                    productQuantities: productQuantities,
                },
                success: function(response){
                    var data = JSON.parse(response);
                    totalOfCart = data.total;
                    $(data.products).each(function(index, value){
                        addToCartsList(index,value.id, value.name, value.description, value.image, value.quantity, value.price);
                    })
                }
            });
        }
    });


    function addToCartsList(index,id, name, description, image, quantity, price){
        cartList.append(`<div class="card shadow">
                            <div class="card-body" style="display: flex;">
                                <div style="height: 100px; width: 100px;">
                                    <img class="img-fluid" style="width: 100px; height:100px;" src="admin/${image}">
                                </div>
                                
                                <div style="margin-left: 20px; width: 150px;">
                                    <h5 style="margin-bottom: 0px;">${name}</h5>
                                    <code style="margin-top: 0px;">(${description})</code>
                                </div>
                                <div style="margin-left: 20px;">
                                    <p><strong>Quantity: </strong>${quantity}</p>
                                    <p>
                                        <span>&#8369</span>${price}
                                    </p>
                                    <button value="${index}" class="deleteCartButton btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>`);
        var deleteCartButton = cartList.children().eq(index).find('.deleteCartButton');
        deleteCartButton.click(function(){
            if(confirm('Are You Sure?') == true){
                globalProductId = $(this).val();
                $(this).val('del');
                productIds[globalProductId] = "del";
                productQuantities[globalProductId] = 'del';
                $(this).parent().parent().parent().remove();
                if(cartList.children().length == 0){
                    myOrderslist.modal('hide');
                }
            }
        });
    }
    //page start
    $('#searchMessage').hide();
    searchProductList.hide();
    //Product list button on header navigations
    showProductList.click(function(){
        searchProduct.removeClass('onSearch');
        $(this).hide('fast');
        searchProductList.hide('fast');
        $('#searchMessage').hide('fast');
        productList.show('slow');
        $('#ListMessage').slideDown('fast');
    });
    //search product
    searchProduct.click(function(){
        if(searchProductInput.val() != ""){
            $(this).addClass('onSearch');
            showProductList.show('fast');
            $('#ListMessage').slideUp('fast');
            $('#searchMessage').slideDown('slow');
            searchProductList.children().remove();
            productList.slideUp('fast');
            searchProductList.slideDown('slow');

            $.ajax({
                type: 'POST',
                url: 'admin/php/searchProduct.php',
                data:
                {
                    searchProductInput: searchProductInput.val()
                },
                success: function(response){
                    if (response != '[]'){
                        searchMessageInput.css('color','black');
                        searchMessageInput.text('Results for: ' + searchProductInput.val());
                        var searchData = JSON.parse(response);
                        $(searchData).each(function(index,value){
                            searchProductGrid(index, value.id, value.name, value.image, value.description, value.available, value.price);
                        })
                    }else{
                        searchMessageInput.css('color','red');
                        var noDataMessage = "Sorry, there is no product with such name.";
                        searchMessageInput.text(noDataMessage);
                    }
                }
            });
        }else{
            alert('no input')
        }
    });
    function searchProductGrid(index, id, name, image, description, available, price){
        searchProductList.append(
                    `<div id="item" class="card shadow col-md mx-auto rounded-4" style="width: 300px; margin: 20px;">
                        <div class="card-header rounded-4 rounded-bottom text-light" style="background-color: rgb(41,22,5);border-top: 5px solid rgb(254,104,27);border-bottom: solid 5px rgb(254,104,27);">
                            <center>
                                <h5 class="text-truncate" style="color: rgb(254,254,6);">${name}</h5>
                            </center>
                        </div>
                        <div class="card-body">
                            <center>
                                <img style="border-radius: 5%; border: solid 5px rgb(255,191,8);" src="admin/${image}" alt="" height="200px" width="200px" style="margin: 10px;">
                            </center>
                            <p style="margin-left: 10px;margin-top: 5px;margin-bottom: 5px;" class="text-truncate"><strong>Description: </strong>${description}</p>
                            <p style="margin-left: 10px;margin-bottom: 15px;"><strong>Available: </strong><span class="available">${available}</span></p>
                            <p style="margin-left: 10px;">
                                ${price}
                            </p>
                            <div class="input-group mb-3">
                                <button style="border-radius: 50% 0 0 50%;" class="thisProductDecrease btn btn-success">-</button>
                                <input type="number" class="thisProductQuantity form-control text-center" value="0">
                                <button style="border-radius: 0 50% 50% 0;" class="thisProductIncrease btn btn-success">+</button> 
                            </div>
                            <div class="d-flex justify-content-between">
                                <button value="${id}" class="viewProductButton btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#viewProduct">View Product</button>
                                <button value="${id}" class="add-to-cart btn btn-warning">Add To Cart</button>
                            </div>
                        </div>
                    </div>`
                );

        productFunctions(index, searchProductList)
    }
    //this how we display products
    $.ajax({
        type: 'GET',
        url: 'admin/php/displayMyProduct.php',
        success:function(response){
            var data = JSON.parse(response);
            $(data).each(function(index, value){
                //${value.name} ${value.image} ${value.description} ${value.available} ${value.price} ${value.id}
                addToProductGrid(index, value.id, value.name, value.image, value.description, value.available, value.price);
            })
        }
    });
    //Order Confirm Button
    var customerName = $('#customerName');
    var orderQuantity = $('#orderQuantity');
    var resetOrderFields = $('#resetOrderFields');
    var orderConfirmButton = $('#confirmOrder');


    function addToCartFunc(productId, quantity){
        productIds.push(productId);
        productQuantities.push(quantity);
    }

    function addToProductGrid(index, id, name, image, description, available, price){
        productList.append(
                    `<div class="col">
                        <div class="card shadow col-md mx-auto" style="cursor: pointer">
                            <img class="img-fluid card-img-top" style="height: 300px; width: 100%; object-fit: cover" src="admin/${image}" alt="">
                            <div class="card-footer text-center">
                                <p class="fw-bold text-truncate fs-3 mt-1">${name}</p>
                                <p class="text-truncate">${description}</p>
                        
                                <p class="text-start fs-2 fw-bold text-secondary mt-2">&#8369; ${price}</p>
                                <button class="btn btn-outline-danger w-100 mt-3">View Product</button>
                            </div>
                            
                        </div>
                    </div>`
                    
                );

        productFunctions(index, productList);
    }
    
    function productFunctions(index, paramProductList){
        var viewProductButton = paramProductList.children().eq(index).find('.viewProductButton');
        var thisProductDecrease = paramProductList.children().eq(index).find('.thisProductDecrease');
        var thisProductQuantity = paramProductList.children().eq(index).find('.thisProductQuantity');
        var thisProductIncrease = paramProductList.children().eq(index).find('.thisProductIncrease');
        var addToCart = paramProductList.children().eq(index).find('.add-to-cart');

        addToCart.on('click', function(){
            var thisProductOrderQuantity = $(this).parent().parent().children().eq(4).children().eq(1).val();
            globalProductId = $(this).val();
            if($(this).parent().parent().children().eq(2).children().eq(1).text() == "0"){
                alert('This Product Is Either Reserved or Out of Stock.');
                $(this).parent().parent().children().eq(2).children().eq(1).css('color','red');
            }else{
                if(parseInt(thisProductOrderQuantity) == 0){
                alert('Please Add Quantity');
                }else{
                    addToCartFunc(globalProductId, thisProductOrderQuantity);
                    alert('Product Successfully Added to Cart');
                }
            }
        })
        thisProductDecrease.click(function(){
            var thisquantity = $(this).parent().children().eq(1)
            var currentValue = thisquantity.val();
            if(currentValue > 0){
                currentValue--;
                thisquantity.val(currentValue);
            }
        });
        thisProductIncrease.click(function(){
            var thisquantity = $(this).parent().children().eq(1)
            var currentValue = thisquantity.val();
            var thisAvailable = $(this).parent().parent().children().eq(2).children().eq(1);

            var thisAvailableInt = parseInt(thisAvailable.text());
            if(currentValue < thisAvailableInt){
                currentValue++;
                thisquantity.val(currentValue);
            }
        });
        thisProductQuantity.on('change',function(){
            var thisAvailable = $(this).parent().parent().children().eq(2).children().eq(1);
            var thisInput = $(this).val();
            if(parseInt(thisInput) > parseInt(thisAvailable.text())){
                
                $(this).val(thisAvailable.text());
            }else if(parseInt(thisInput) < 0){
                $(this).val(0);
            }
        });

        thisProductQuantity.on('keyup', function(){
            var thisAvailable = $(this).parent().parent().children().eq(2).children().eq(1);
            var thisInput = $(this).val();
            if(parseInt(thisInput) > parseInt(thisAvailable.text())){
                
                $(this).val(thisAvailable.text());
            }else if(parseInt(thisInput) < 0){
                $(this).val(0);
            }
        })
        viewProductButton.click(function(){
            globalProductId = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'admin/php/viewProduct.php',
                data: {
                    product_id: globalProductId,
                },
                success: function(response){
                    var data = JSON.parse(response);
                    
                    productName.text(data.name);
                    productImage.attr('src',"admin/" + data.image);
                    productDescription.text(data.description);
                    productQuantity.text(data.quantity);
                    productPrice.text(data.price);
                }
            });
        });
    }
    customerName.on('keydown',function(){
        $(this).removeClass('is-invalid');
    });
    customerAddress.on('keydown',function(){
        $(this).removeClass('is-invalid');
    });
    orderQuantity.on('keydown',function(){
        $(this).removeClass('is-invalid');
    })
    resetOrderFields.click(function(){
        if(confirm('Are you sure?') == true){
            customerAddress.val("");
            customerName.val("");
            orderQuantity.val("");
        }
    });
    orderConfirmButton.click(function(){
        if(customerName.val() == ""){
            customerName.addClass('is-invalid');
        }
        if(customerAddress.val() == ""){
            customerAddress.addClass("is-invalid");
        }
        if(orderQuantity.val() == ""){
            orderQuantity.addClass("is-invalid");
        }
        if(customerName.val() && customerAddress.val() && orderQuantity.val() != ""){
            $.ajax({
                type: 'POST',
                url: 'admin/php/orderDuplicate.php',
                data:
                {
                    customerName: customerName.val(),
                    customerAddress: customerAddress.val(),
                },
                success:function(response){
                    
                    if(response == 'may kapareho'){
                        if (confirm('You ALREADY ORDERED this Product! are you sure you want to order it again?') == true){
                                $.ajax({
                                    type: 'POST',
                                    url: 'admin/php/order.php',
                                    data:
                                    {
                                        customerName: customerName.val(),
                                        customerAddress: customerAddress.val(),
                                        orderQuantity: orderQuantity.val()
                                    },
                                    success:function(response){
                                        if(response == 'success'){
                                            alert('You have Successfully Ordered ANOTHER SET of the Product.');
                                            customerName.val("");
                                            customerAddress.val("");
                                            orderQuantity.val("");
                                        }else{
                                            alert('error');
                                        }
                                    }
                                })
                        }
                    }else if(response == 'clear'){
                        if(confirm('Are you sure?') == true){
                            $.ajax({
                                type: 'POST',
                                url: 'admin/php/order.php',
                                data:
                                {
                                    customerName: customerName.val(),
                                    customerAddress: customerAddress.val(),
                                    orderQuantity: orderQuantity.val()
                                },
                                success:function(response){
                                    if(response == 'success'){
                                        alert('You have Successfully Ordered a Product.');
                                        customerName.val("");
                                        customerAddress.val("");
                                        orderQuantity.val("");
                                    }else{
                                        alert('error');
                                    }
                                }
                            })
                        }
                    }
                }
            });
            
        }
    });
});