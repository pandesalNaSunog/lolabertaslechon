
$(document).ready(function(){
    //default menu
    $('#ordersNav').css('color','dimgrey');
    $('#ordersNav').css('-webkit-text-fill-color','transparent');
    $('#ordersNav').css('-webkit-text-stroke-width','1px');
    $.ajax({
        type: 'GET',
        url: 'php/sessioncheck.php',
        success:function(response){
            if( response == 'index.html'){
                window.location.replace(response);
                
            }
        }
    });

    
    function getMonthlySales(year, instructions){

        $.ajax({
            type: 'POST',
            url: 'php/getMonthlySales.php',
            data:{
                year: year,
            },
            success: function(response){
                instructions.hide();
                salesChart.show();
                var data = JSON.parse(response);

                var xValues = [];
                var yValues = [];
                $(data.months).each(function(index, value){
                    xValues.push(value)
                })
                $(data.sales).each(function(index, value){
                    yValues.push(value)
                })

                var maximum = data.maximum;

                new Chart("sales-chart", {
                    type: "line",
                    data: {
                        labels: xValues,
                        datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,0,255,1.0)",
                        borderColor: "rgba(0,0,255,0.1)",
                        data: yValues
                        }]
                    },
                    options: {
                        legend: {display: false},
                        scales: {
                        yAxes: [{ticks: {min: 1, max:maximum}}],
                        }
                    }
                });
            }
        })
    }

    
    //Jquery Nav Animation
    $('#myProductsSection,#customerPageCustomizationSection,#editCarouselSection,#addSliderASection,#addSliderBSection,#editImageGridSection,#salesReportSection').hide();
    var globalProductId = 0;
    var globalOrderId = 0;
    var ordersTable = $('#ordersTable');
    var productsTable = $('#productsTable');
    var myProductsNav = $('#myProductsNav');
    var pageCustomizationNav = $('#pageCustomizationNav');
    var ordersNav = $('#ordersNav');
    var myProductSection = $('#myProductsSection');
    var ordersSection = $('#ordersSection');
    var salesReportSection = $('#salesReportSection');
    var customerPageCustomizationSection = $('#customerPageCustomizationSection');
    var welcomeSection = $('#welcomeSection');
    var editButton = $('#editButton');
    var editCarouselButton = $('#editCarouselButton');
    var editCarouselSection = $('#editCarouselSection');
    var CPCbtn = $('.CPCbtn');
    var addCarouselImageButton = $('#addCarouselImageButton');
    var additionalCarouselFile = $('#additionalCarouselFile');
    var addedCarouselList = $('#addedCarouselList');
    var mainCarousel = $('#mainCarousel');
    var editMainCarouselFile = $('#editMainCarouselFile');
    var editMainCarouselImageButton = $('#editMainCarouselImageButton');
    var ordersDataName = $('#ordersDataName');
    var ordersDataAddress = $('#ordersDataAddress');
    var ordersDataContactNumber = $('#ordersDataContactNumber');
    var ordersDataOrderType = $('#ordersDataOrderType');
    var ordersDataDateOrdered = $('#ordersDataDateOrdered');
    var ordersDataCartList = $('#ordersDataCartList');
    var ordersTotalPrice = $('#ordersTotalPrice');
    var confirmAmount = $('#confirm-amount');
    var amountRenderred = $('#amount-renderred');
    var yearSales = $('#year-sales');
    var generateSalesReport = $('#generate-sales-report');
    var instructions = $('#instructions');
    var salesChart = $('#sales-chart');
    let viewOrderModal = $('#view-order-modal');
    salesChart.hide();

    generateSalesReport.on('click', function(){
        if(yearSales.val() == "" || parseInt(yearSales.val()) < 2022 || yearSales.val().length > 4){
            yearSales.addClass('is-invalid');
        }else{
            getMonthlySales(yearSales.val(), instructions)
        }
        
    })

    confirmAmount.on('click', function(){
        if(amountRenderred.val() == ""){
            amountRenderred.addClass('is-invalid');
        }else{
            $.ajax({
                type: 'POST',
                url: 'php/insertSales.php',
                data:{
                    order_id: globalOrderId,
                    amount: amountRenderred.val(),
                },
                success: function(response){
                    if(response == 'ok'){
                        alert('Transaction Successful.');
                        amountRenderred.val('');
                        location.reload();
                    }else if(response == 'insufficient funds'){
                        alert('Insufficient Funds');
                    }else{
                        alert('Something Went Wrong')
                    }
                }
            })
        }
    })

    
    var editSliderAButton = $('#editSliderAButton');
    var addSliderASection = $('#addSliderASection');
    var addSliderAButton = $('#addSliderAButton');
    var additionalSliderAButton = $('#additionalSliderAButton');
    var additionalSliderATitle = $('#additionalSliderATitle');
    var additionalSliderAFile = $('#additionalSliderAFile');
    var additionalSliderACaption = $('#additionalSliderACaption');
    var day, month , year;
    var sliderAdateInput = $('#slider-a-date-input');
    var addedSliderAList = $('#addedSliderAList');
    var toastImageTitle = $('#toastImageTitle');
    var toastImageDateAdded = $('#toastImageDateAdded');
    var toastMessage = $('#toastMessage');
    var toastImage = $('#toastImage');
    var editSliderBButton = $('#editSliderBButton');
    var addSliderBSection = $('#addSliderBSection');
    var addSliderBButton = $('#addSliderBButton');
    const toastTrigger = $('.liveToastBtn');
    const toastLiveExample = $('#liveToast');
    var additionalSliderBButton = $('#additionalSliderBButton');
    var additionalSliderBTitle = $('#additionalSliderBTitle');
    var additionalSliderBFile = $('#additionalSliderBFile');
    var additionalSliderBCaption = $('#additionalSliderBCaption');
    var sliderBdateInput = $('#slider-b-date-input');
    var addedSliderBList = $('#addedSliderBList');
    var addedSliderATitleList = $('#addedSliderATitleList');
    var editSliderATitleInput = $('#editSliderATitleInput');
    var editSliderATitleButton = $('#editSliderATitleButton');
    var editImageGridButton = $('#editImageGridButton');
    var editImageGridSection = $('#editImageGridSection');
    var addImageGridButton = $('#addImageGridButton');
    var imageGridTitleInput = $('#imageGridTitleInput');
    var imageGridFileInput = $('#imageGridFileInput');
    var imageGridDetailsInput = $('#imageGridDetailsInput');
    var salesReportNav = $('#salesReportNav');
    var editGridTitleButton = $('#editGridTitleButton');
    var editGridTitleInput = $('#editGridTitleInput');
    var imageGridTitle = $('#imageGridTitle');
    var editMainTitleInput = $('#editMainTitleInput');
    var editMainTitleButton = $('#editMainTitleButton');
    var mainTitle = $('#mainTitle');
    var subtitle = $('#subtitle');
    var editSubtitleInput = $('#editSubtitleInput');
    var editSubtitleButton = $('#editSubtitleButton');
    let numberOfItems = $('#number-of-items');
    let orderProductsList = $('#order-products-list');
    let orderStatuses = $('#order-statuses');

    editSubtitleInput.on('keydown', function(){
        $(this).removeClass('is-invalid');
    });
    editSubtitleButton.click(function(){
        if(editSubtitleInput.val() == ""){
            editSubtitleInput.addClass('is-invalid');
        }else{
            if(confirm('Update Subtitle?') == true){
                $.ajax({
                    type: 'POST',
                    url: 'php/updateSubtitle.php',
                    data:{
                        editSubtitleInput: editSubtitleInput.val(),
                    },
                    success:function(response){
                        alert('Main Title Updated.');
                        subtitle.text(editSubtitleInput.val());
                    }
                });
            }
        }
    });
    editMainTitleInput.on('keydown', function(){
        $(this).removeClass('is-invalid');
    });
    editMainTitleButton.click(function(){
        if(editMainTitleInput.val() == ""){
            editMainTitleInput.addClass('is-invalid');
        }else{
            if(confirm('Update Main Title?') == true){
                $.ajax({
                    type: 'POST',
                    url: 'php/updateMainTitle.php',
                    data:{
                        editMainTitleInput: editMainTitleInput.val(),
                    },
                    success:function(response){
                        alert('Main Title Updated.');
                        mainTitle.text(editMainTitleInput.val());
                    }
                });
            }
        }
    });
    editGridTitleInput.on('keydown',function(){
        $(this).removeClass('is-invalid');
    });
    editGridTitleButton.click(function(){
        if(editGridTitleInput.val() == ""){
            editGridTitleInput.addClass('is-invalid');
        }else{
            if(confirm('Update Grid title?') == true){
                $.ajax({
                    type: 'POST',
                    url: 'php/updateGridTitle.php',
                    data:{
                        editGridTitleInput: editGridTitleInput.val(),
                    },
                    success:function(response){
                        alert('Grid Title Updated.');
                        imageGridTitle.text(editGridTitleInput.val());
                    }
                });
            }
        }
    });

    var addedImageGridList = $('#addedImageGridList');

    imageGridTitleInput.on('keydown',function(){
        $(this).removeClass('is-invalid');
    });
    imageGridFileInput.click(function(){
        $(this).removeClass('is-invalid');
    });
    imageGridDetailsInput.on('keydown',function(){
        $(this).removeClass('is-invalid');
    });
    addImageGridButton.click(function(){
        if(imageGridTitleInput.val() == ""){
            imageGridTitleInput.addClass('is-invalid');
        }
        if(imageGridFileInput.val() == ""){
            imageGridFileInput.addClass('is-invalid');
        }
        if(imageGridDetailsInput.val() == ""){
            imageGridDetailsInput.addClass('is-invalid');
        }
        if(imageGridTitleInput.val() && imageGridFileInput.val() && imageGridDetailsInput.val() != ""){
            if(confirm('Add Image?') == true){
                var formData = new FormData();
                    formData.append("title", imageGridTitleInput.val());
                    formData.append("file", imageGridFileInput[0].files[0]);
                    formData.append("details", imageGridDetailsInput.val());
                $.ajax({
                    type: 'POST',
                    url: 'php/addImageGrid.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        alert('Image Successfully Added to the Grid.');
                        imageGridTitleInput.val("");
                        imageGridFileInput.val("");
                        imageGridDetailsInput.val("");
                        var data = JSON.parse(response);
                        $(data).each(function(index,value){
                            addedImageGridList.append(`
                                <div style="background-color: grey;padding: 10px;fit-content;margin:5px;heigth:fit-content;border-radius:10px;">
                                    <div class="containera gridItem m-0" style="width: fit-content;margin: 0px;">
                                        <img src="${value.image_file}" alt="Grid-Image" width="100%" style="align-self:center;">
                                        <div class="td" style="display: table;">
                                            <div class="text-block overflow-auto pt-2" style="max-height: 25%;">
                                                <button class="liveToastBtnC1 btn btn-success m-1" value="${value.id}">View Image</button>
                                                <button class="deleteNewGridImageButton btn btn-danger m-1" value="${value.id}">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                            const toastTriggerC1 = $('.liveToastBtnC1');
                            const toastLiveExample = $('#liveToast');
                            toastTriggerC1.click(function(){
                                                globalProductId = $(this).val();
                                                const toast = new bootstrap.Toast(toastLiveExample)
                                                toast.show();
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'php/viewGridImage.php',
                                                    data:
                                                    {
                                                        image_id: globalProductId,
                                                    },
                                                    success:function(response){
                                                        var imgData = JSON.parse(response);
                                                        toastImage.children().remove();
                                                        $(imgData).each(function(index,value){
                                                            toastImageTitle.text(`
                                                                ${value.image_title}
                                                            `);
                                                            toastImageDateAdded.text(`
                                                                ${value.created_at}
                                                            `);
                                                            toastMessage.text(`
                                                                ${value.image_details}
                                                            `);
                                                            toastImage.append(`
                                                                <img src="${value.image_file}" style="max-height:300px;max-width:100%;" class="rounded me-2" alt="...">
                                                            `)
                                                        });
                                                    }
                                                });
                                            });
                        var deleteNewGridImageButton = $('.deleteNewGridImageButton');
                        deleteNewGridImageButton.click(function(){
                                var thisNewGridDeleteButton = $(this);
                                globalProductId = $(this).val();
                                $.ajax({
                                    type: 'POST',
                                    url: 'php/deleteGridImage.php',
                                    data:
                                    {
                                        image_id: globalProductId,
                                    },
                                    success:function(response){
                                        thisNewGridDeleteButton.parent().parent().parent().parent().remove();
                                    }
                                });
                        })
                        });
                    }
                });
            }
        }
        
    });
    editSliderATitleInput.on('keydown',function(){
        $(this).removeClass('is-invalid');
    });
    editSliderATitleButton.click(function(){
        if(editSliderATitleInput.val() == ""){
            editSliderATitleInput.addClass('is-invalid');
        }
        if(editSliderATitleInput.val() != ""){
            if(confirm('Update Slider Title?') == true){
                $.ajax({
                    type: 'POST',
                    url: 'php/updateCustomSliderTitle.php',
                    data:
                    {
                        sliderTitle: editSliderATitleInput.val(),
                    },
                    success:function(response){
                        alert('Custom Slider Title Updated.');
                        editSliderATitleInput.val("");
                        $('#editSliderATitleModal').modal('hide');
                        addedSliderATitleList.children().remove();
                        var data = JSON.parse(response);
                        $(data).each(function(index,value){
                            showCustomSliderTitle(value.id,value.slider_title,value.updated_at);
                        });
                        var deleteCustomSliderTitleBtn = $('.deleteCustomSliderTitleBtn');
                        deleteCustomSliderTitleBtn.click(function(){
                            if(confirm('Are You Sure?') == true){
                                $.ajax({
                                    type: 'POST',
                                    url: 'php/deleteCustomSliderTitle.php',
                                    success:function(response){
                                        alert('Custom Slider Deleted.');
                                        var thisDeletedTitle = deleteCustomSliderTitleBtn.parent().parent();
                                        thisDeletedTitle.remove();
                                    }
                                });
                            }
                        });
                    }
                });
            }
        }
    });
    
    additionalSliderBTitle.on('keydown',function(){
        $(this).removeClass('is-invalid');
    })
    additionalSliderBFile.click(function(){
        $(this).removeClass('is-invalid');
    })
    additionalSliderBCaption.on('keydown',function(){
        $(this).removeClass('is-invalid');
    })
    sliderBdateInput.click(function(){
        $(this).removeClass('is-invalid');
    })
    
    additionalSliderBButton.click(function(){
        var date = $('#slider-b-date-input').val().split("-");
            day = date[2];
            month = date[1];
            year = date[0];
            if(month == 1){
                var lmonth = "January";
            }else if(month == 2){
                var lmonth = "February";
            }else if(month == 3){
                var lmonth = "March";
            }else if(month == 4){
                var lmonth = "April";
            }else if(month == 5){
                var lmonth = "May";
            }else if(month == 6){
                var lmonth = "June";
            }else if(month == 7){
                var lmonth = "July";
            }else if(month == 8){
                var lmonth = "August";
            }else if(month == 9){
                var lmonth = "September";
            }else if(month == 10){
                var lmonth = "October";
            }else if(month == 11){
                var lmonth = "November";
            }else if(month == 12){
                var lmonth = "December";
            }
            dateCreated = lmonth + "-" + day + "-" + year;
        if(additionalSliderBTitle.val() == ""){
            additionalSliderBTitle.addClass('is-invalid');
        }
        if(additionalSliderBFile.val() == ""){
            additionalSliderBFile.addClass('is-invalid');
        }
        if(additionalSliderBCaption.val() == ""){
            additionalSliderBCaption.addClass('is-invalid');
        }
        if(sliderBdateInput.val() == ""){
            sliderBdateInput.addClass('is-invalid');
        }
        if(additionalSliderBTitle.val() && additionalSliderBFile.val() && additionalSliderBCaption.val() && sliderBdateInput.val() != ""){
            if(confirm('Add This Image') == true){
                var formData = new FormData();        
                    formData.append("additionalSliderBTitle", additionalSliderBTitle.val());
                    formData.append("additionalSliderBFile", additionalSliderBFile[0].files[0]);
                    formData.append("additionalSliderBCaption", additionalSliderBCaption.val());
                    formData.append("sliderBdateInput", dateCreated);
                $.ajax({
                    type: 'POST',
                    url: 'php/addSliderB.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        alert('The New Slider Image Is Inserted Successfully');
                        additionalSliderBTitle.val("");
                        additionalSliderBFile.val("");
                        additionalSliderBCaption.val("");
                        sliderBdateInput.val("");
                        var data = JSON.parse(response);
                        $(data).each(function(index,value){
                            addedSliderBList.append(`
                            <div class="p-2 m-1" style="height:fit-content;width:fit-content;border-radius:10px;background-color:grey;">
                                <div>
                                    <center>
                                        <h5>${value.slider_title}</h5>
                                        <img src="${value.slider_image}" height="200px" width="100%" alt="Slider Img">
                                    </center>
                                    <code style="color: black;">Date Added: </code><code class="text-warning">${value.created_at}</code>
                                    <br>
                                </div>
                                <div class="justify-content-between">
                                    <button class="liveToastBtnB1 btn btn-success" value="${value.id}">View</button>
                                    <button class="deleteNewSliderB btn btn-danger" value="${value.id}">Delete</button>
                                </div>
                            </div>
                            `);
                            const toastTriggerB1 = $('.liveToastBtnB1');
                            const toastLiveExample = $('#liveToast');
                            
                            toastTriggerB1.click(function(){
                                globalProductId = $(this).val();
                                const toast = new bootstrap.Toast(toastLiveExample)
                                toast.show();
                                $.ajax({
                                    type: 'POST',
                                    url: 'php/viewSliderB.php',
                                    data:
                                    {
                                        image_id: globalProductId,
                                    },
                                    success:function(response){
                                        var imgData = JSON.parse(response);
                                        toastImage.children().remove();
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
                                                <img src="${value.slider_image}" style="max-height:300px;max-width:100%;" class="rounded me-2" alt="...">
                                            `)
                                        });
                                    }
                                });
                            });
                            var deleThisNewSliderB = $('.deleteNewSliderB');
                            deleThisNewSliderB.click(function(){
                                var thisNewestSliderB = $(this).parent().parent();
                                globalProductId = $(this).val();
                                $.ajax({
                                    type: 'POST',
                                    url: 'php/deleteSliderB.php',
                                    data:
                                    {
                                        image_id: globalProductId,
                                    },
                                    success:function(response){
                                        thisNewestSliderB.remove();
                                    }
                                });
                            });
                        });
                    }
                });
            }
        }
    });

    toastTrigger.click(function(){
        const toast = new bootstrap.Toast(toastLiveExample)
        toast.show();
    });

    additionalSliderATitle.on('keydown',function(){
        $(this).removeClass('is-invalid');
    });
    additionalSliderAFile.click(function(){
        $(this).removeClass('is-invalid');
    });
    additionalSliderACaption.on('keydown',function(){
        $(this).removeClass('is-invalid');
    });
    sliderAdateInput.click(function(){
        $(this).removeClass('is-invalid');
    });
    additionalSliderAButton.click(function(){
        var date = $('#slider-a-date-input').val().split("-");
        day = date[2];
        month = date[1];
        year = date[0];
        if(month == 1){
            var lmonth = "January";
        }else if(month == 2){
            var lmonth = "February";
        }else if(month == 3){
            var lmonth = "March";
        }else if(month == 4){
            var lmonth = "April";
        }else if(month == 5){
            var lmonth = "May";
        }else if(month == 6){
            var lmonth = "June";
        }else if(month == 7){
            var lmonth = "July";
        }else if(month == 8){
            var lmonth = "August";
        }else if(month == 9){
            var lmonth = "September";
        }else if(month == 10){
            var lmonth = "October";
        }else if(month == 11){
            var lmonth = "November";
        }else if(month == 12){
            var lmonth = "December";
        }
        dateCreated = lmonth + "-" + day + "-" + year;
        if(additionalSliderATitle.val() == ""){
            additionalSliderATitle.addClass('is-invalid');
        }
        if(additionalSliderAFile.val() == ""){
            additionalSliderAFile.addClass('is-invalid');
        }
        if(additionalSliderACaption.val() == ""){
            additionalSliderACaption.addClass('is-invalid');
        }
        if(sliderAdateInput.val() == ""){
            dateInput.addClass('is-invalid');
        }
        if(additionalSliderATitle.val() && additionalSliderAFile.val() && additionalSliderACaption.val() && sliderAdateInput.val() != ""){
            if(confirm("Add This Image?") == true){
                var formData = new FormData();        
                    formData.append("additionalSliderATitle", additionalSliderATitle.val());
                    formData.append("additionalSliderAFile", additionalSliderAFile[0].files[0]);
                    formData.append("additionalSliderACaption", additionalSliderACaption.val());
                    formData.append("sliderAdateInput", dateCreated);
                $.ajax({
                    type: 'POST',
                    url: 'php/addSliderA.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        alert('The New Slider Image Is Inserted Successfully');
                        additionalSliderATitle.val("");
                        additionalSliderAFile.val("");
                        additionalSliderACaption.val("");
                        sliderAdateInput.val("");
                        var data = JSON.parse(response);
                        $(data).each(function(index,value){
                            addedSliderAList.append(`
                            <div class="p-2 m-1" style="height:fit-content;width:fit-content;border-radius:10px;background-color:grey;">
                                <div>
                                    <center>
                                        <h5>${value.slider_title}</h5>
                                        <img src="${value.slider_image}" height="200px" width="100%" alt="Slider Img">
                                    </center>
                                    <code style="color: black;">Date Added: </code><code class="text-warning">${value.created_at}</code>
                                    <br>
                                </div>
                                <div class="justify-content-between">
                                    <button class="liveToastBtnA1 btn btn-success" value="${value.id}">View</button>
                                    <button class="deleteNewSliderA btn btn-danger" value="${value.id}">Delete</button>
                                </div>
                            </div>
                            `);
                            const toastTriggerA1 = $('.liveToastBtnA1');
                            const toastLiveExample = $('#liveToast');
                            
                            toastTriggerA1.click(function(){
                                globalProductId = $(this).val();
                                const toast = new bootstrap.Toast(toastLiveExample)
                                toast.show();
                                $.ajax({
                                    type: 'POST',
                                    url: 'php/viewSliderA.php',
                                    data:
                                    {
                                        image_id: globalProductId,
                                    },
                                    success:function(response){
                                        var imgData = JSON.parse(response);
                                        toastImage.children().remove();
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
                                                <img src="${value.slider_image}" style="max-height:300px;max-width:100%;" class="rounded me-2" alt="...">
                                            `)
                                        });
                                    }
                                });
                            });
                            var deleThisNewSliderA = $('.deleteNewSliderA');
                            deleThisNewSliderA.click(function(){
                                var thisNewestSliderA = $(this).parent().parent();
                                globalProductId = $(this).val();
                                $.ajax({
                                    type: 'POST',
                                    url: 'php/deleteSliderA.php',
                                    data:
                                    {
                                        image_id: globalProductId,
                                    },
                                    success:function(response){
                                        thisNewestSliderA.remove();
                                    }
                                });
                            });
                        });
                    }
                });
            }
        }
    });
    
    editMainCarouselFile.click(function(){
        $(this).removeClass('is-invalid');
    });
    editMainCarouselImageButton.click(function(){
        if(editMainCarouselFile.val() == ""){
            editMainCarouselFile.addClass('is-invalid');
        }
        if(editMainCarouselFile.val() != ""){
            if(confirm('Are You Sure?') == true){
                var form = new FormData();
                form.append('carouselFile', editMainCarouselFile[0].files[0]);
                $.ajax({
                    type: 'POST',
                    url: 'php/updateMainCarousel.php',
                    data:form,
                    contentType:false,
                    processData:false,
                    success:function(response){

                        var data = JSON.parse(response);
                        alert('Main Image Updated.');

                        mainCarousel.children().remove();
                        showMainCarousel(data.main_image,data.created_at)
                    }
                });
            }
        }
    });
    $.ajax({
        type: 'POST',
        url: 'php/displayMainCarousel.php',
        success:function(response){
            var data = JSON.parse(response);
            $(data).each(function(index,value){
                showMainCarousel(value.image,value.created_at)
            })
        }
    });
    function showMainCarousel(image,created_at){
        mainCarousel.append(`
            <img src="${image}" height="300px" width="480px">
            <br>
            <code style="color: black;">Date Updated: </code>
            <code>${created_at}</code>
        `);
    }
    $.ajax({
        type: 'POST',
        url: 'php/displayCustomSliderTitle.php',
        success:function(response){
            var data = JSON.parse(response);
            $(data).each(function(index,value){
                showCustomSliderTitle(value.id,value.slider_title,value.opening_title,value.grid_title,value.opening_subtitle,value.updated_at);
            });
            var deleteCustomSliderTitleBtn = $('.deleteCustomSliderTitleBtn');
            deleteCustomSliderTitleBtn.click(function(){
                if(confirm('Are You Sure?') == true){
                    $.ajax({
                        type: 'POST',
                        url: 'php/deleteCustomSliderTitle.php',
                        success:function(response){
                            alert('Custom Slider Deleted.');
                            var thisDeletedTitle = deleteCustomSliderTitleBtn.parent().parent();
                            thisDeletedTitle.remove();
                        }
                    });
                }
            });
        }
    });
    $.ajax({
        type: 'POST',
        url: 'php/displayGridImages.php',
        success:function(response){
            var data = JSON.parse(response);
            $(data).each(function(index,value){
                addedImageGridList.append(`
                    <div style="background-color: white;padding: 10px;fit-content;margin:5px;heigth:fit-content;border-radius:10px;">
                        <div class="containera gridItem m-0" style="width: fit-content;margin: 0px;">
                            <img src="${value.image_file}" alt="Grid-Image" width="100%" style="align-self:center;">
                            <div class="td" style="display: table;">
                                <div class="text-block overflow-auto pt-2" style="max-height: 25%;">
                                    <button class="liveToastBtnC btn btn-success m-1" value="${value.id}">View Image</button>
                                    <button class="deleteGridImageButton btn btn-outline-danger m-1" value="${value.id}">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            });
            const toastTriggerC = $('.liveToastBtnC');
            const toastLiveExample = $('#liveToast');
            toastTriggerC.click(function(){
                                globalProductId = $(this).val();
                                const toast = new bootstrap.Toast(toastLiveExample)
                                toast.show();
                                $.ajax({
                                    type: 'POST',
                                    url: 'php/viewGridImage.php',
                                    data:
                                    {
                                        image_id: globalProductId,
                                    },
                                    success:function(response){
                                        var imgData = JSON.parse(response);
                                        toastImage.children().remove();
                                        $(imgData).each(function(index,value){
                                            toastImageTitle.text(`
                                                ${value.image_title}
                                            `);
                                            toastImageDateAdded.text(`
                                                ${value.created_at}
                                            `);
                                            toastMessage.text(`
                                                ${value.image_details}
                                            `);
                                            toastImage.append(`
                                                <img src="${value.image_file}" style="max-height:300px;max-width:100%;" class="rounded me-2" alt="...">
                                            `)
                                        });
                                    }
                                });
                            });
            var deleteGridImageButton = $('.deleteGridImageButton');
            deleteGridImageButton.click(function(){
                if(confirm('Delete This Grid Image?') == true){
                    var thisGridDeleteButton = $(this);
                    globalProductId = $(this).val();
                    $.ajax({
                        type: 'POST',
                        url: 'php/deleteGridImage.php',
                        data:
                        {
                            image_id: globalProductId,
                        },
                        success:function(response){
                            thisGridDeleteButton.parent().parent().parent().parent().remove();
                            alert('Grid Image Deleted.');
                        }
                    });
                }
            })
        }
    });
    $.ajax({
        type: 'POST',
        url: 'php/displaySliderA.php',
        success:function(response){
            var data = JSON.parse(response);
            $(data).each(function(index,value){
                showSliderA(value.id,value.title,value.image,value.caption,value.created_at,value.updated_at,value.date_captured);
            });
            const toastTriggerA = $('.liveToastBtnA');
            const toastLiveExample = $('#liveToast');
            
            toastTriggerA.click(function(){
                globalProductId = $(this).val();
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show();
                $.ajax({
                    type: 'POST',
                    url: 'php/viewSliderA.php',
                    data:
                    {
                        image_id: globalProductId,
                    },
                    success:function(response){
                        var imgData = JSON.parse(response);
                        toastImage.children().remove();
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
                                <img src="${value.slider_image}" style="max-height:300px;max-width:100%;" class="rounded me-2" alt="...">
                            `)
                        });
                    }
                });
            });
            var deleteSliderAButton = $('.deleteSliderA');
            deleteSliderAButton.click(function(){
                if(confirm('Are you sure?') == true){
                    var thisSliderADelete = $(this);
                    globalProductId = $(this).val();
                    $.ajax({
                        type: 'POST',
                        url: 'php/deleteSliderA.php',
                        data:
                        {
                            image_id: globalProductId,
                        },
                        success:function(response){
                            alert('Slider Image Deleted');
                            thisSliderADelete.parent().parent().remove();
                        }
                    });
                }
            });
        }
    });
    $.ajax({
        type: 'POST',
        url: 'php/displaySliderB.php',
        success:function(response){
            var data = JSON.parse(response);
            $(data).each(function(index,value){
                showSliderB(value.id,value.title,value.image,value.caption,value.created_at,value.updated_at,value.date_captured);
            });
            const toastTriggerB = $('.liveToastBtnB');
            const toastLiveExample = $('#liveToast');
            
            toastTriggerB.click(function(){
                globalProductId = $(this).val();
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show();
                $.ajax({
                    type: 'POST',
                    url: 'php/viewSliderB.php',
                    data:
                    {
                        image_id: globalProductId,
                    },
                    success:function(response){
                        var imgData = JSON.parse(response);
                        toastImage.children().remove();
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
                                <img src="${value.slider_image}" style="max-height:300px;max-width:100%;" class="rounded me-2" alt="...">
                            `)
                        });
                    }
                });
            });
            var deleteSliderBButton = $('.deleteSliderB');
            deleteSliderBButton.click(function(){
                if(confirm('Are you sure?') == true){
                    var thisSliderBDelete = $(this);
                    globalProductId = $(this).val();
                    $.ajax({
                        type: 'POST',
                        url: 'php/deleteSliderB.php',
                        data:
                        {
                            image_id: globalProductId,
                        },
                        success:function(response){
                            alert('Slider Image Deleted');
                            thisSliderBDelete.parent().parent().remove();
                        }
                    });
                }
            });
        }
    });
    function showCustomSliderTitle(id,slider_title,opening_title,grid_title,opening_subtitle,updated_at){
        addedSliderATitleList.append(`
        <div>
                <center>
                    <h4 class="m-0 p-2" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">${slider_title}</h4>
                </center>
        </div>
        `);
        imageGridTitle.text(`
            ${grid_title}
        `);
        mainTitle.text(`
            ${opening_title}
        `);
        subtitle.text(`
            ${opening_subtitle}
        `);
    }
    function showSliderA(id,title,image,caption,created_at,updated_at,date_captured){
        addedSliderAList.append(`
        <div class="bg-light p-2 m-1" style="height:fit-content;width:fit-content;border-radius:10px;">
            <div>
                <center>
                    <h5>${title}</h5>
                    <img src="${image}" height="200px" width="100%" alt="Slider Img">
                </center>
                <code style="color: black;">Date Added: </code><code>${created_at}</code>
                <br>
            </div>
            <div class="justify-content-between">
                <button class="liveToastBtnA btn btn-success" value="${id}">View</button>
                <button class="deleteSliderA btn btn-outline-danger" value="${id}">Delete</button>
            </div>
        </div>
        `);

    }
    function showSliderB(id,title,image,caption,created_at,updated_at,date_captured){
        addedSliderBList.append(`
        <div class="bg-light p-2 m-1" style="height:fit-content;width:fit-content;border-radius:10px;">
            <div>
                <center>
                    <h5>${title}</h5>
                    <img src="${image}" height="200px" width="100%" alt="Slider Img">
                </center>
                <code style="color: black;">Date Added: </code><code>${created_at}</code>
                <br>
            </div>
            <div class="justify-content-between">
                <button class="liveToastBtnB btn btn-success" value="${id}">View</button>
                <button class="deleteSliderB btn btn-outline-danger" value="${id}">Delete</button>
            </div>
        </div>
        `);

    }
    $.ajax({
        type: 'POST',
        url: 'php/displayCarousel.php',
        success:function(response){
            var data = JSON.parse(response);
            
            $(data).each(function(index,value){
                addToCarouselGrid(value.id, value.image, value.created_at);
            });
            var deleteAddedCarouselBtn = $('.deleteAddedCarouselBtn');
            deleteAddedCarouselBtn.click(function(){
                globalProductId = $(this).val();
                var thisDeleteCarouselButton = $(this);
                if(confirm('Are You Sure?') == true){
                    $.ajax({
                        type: 'POST',
                        url: 'php/deleteCarousel.php',
                        data:
                        {
                            globalProductId: globalProductId,
                        },
                        success:function(response){
                            alert('Slide-show Image Deleted.');
                            thisDeleteCarouselButton.parent().parent().remove();
                            console.log(response);
                        }
                    });
                }
            });
        }
    });
    function addToCarouselGrid(id,image,created_at){
        addedCarouselList.append(`
            <div class="mb-3" style="display: flex;flex-direction:column; height: fit-content; width: fit-content;background-color: white;padding: 8px;border-radius: 10px;">
                <center>
                    <div>
                        <img src="${image}" height="150px" width="240px">
                    </div>
                </center>
                <div>
                    <code style="color: black">Date Added: </code><code>${created_at}</code>
                </div>
                <div>
                    <button class="deleteAddedCarouselBtn btn btn-outline-danger" value="${id}">Delete</button>
                </div>
            </div>
        `);
    }
    additionalCarouselFile.click(function(){
        $(this).removeClass('is-invalid');
    });
    addCarouselImageButton.click(function(){
        if(additionalCarouselFile.val() == ""){
            additionalCarouselFile.addClass('is-invalid');
        }
        if(additionalCarouselFile.val() != ""){
            if(confirm('Proceed?') == true){
                var form = new FormData();
                form.append('carouselFile', additionalCarouselFile[0].files[0]);
                $.ajax({
                    type: 'POST',
                    url: 'php/addCarousel.php',
                    data: form,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        alert('Additional Carousel Inserted.');
                        var data = JSON.parse(response);
                        console.log('triggered');
                        addedCarouselList.append(`
                        <div class="mb-3" style="display: flex;flex-direction:column; height: fit-content; width: fit-content;background-color: grey;padding: 8px;border-radius: 10px;">
                            <center>
                                <div>
                                    <img src="${data.image}" height="150px" width="240px">
                                </div>
                            </center>
                            <div>
                                <code style="color: black">Date Added: </code><code class="text-warning">${data.created_at}</code>
                            </div>
                            <div>
                                <button class="deleteAddedCarousel btn btn-danger" value="${data.id}">Delete</button>
                            </div>
                        </div>
                        `);
                        var deleteAddedCarousel = $('.deleteAddedCarousel');
                        deleteAddedCarousel.click(function(){
                            globalProductId = $(this).val();
                            var thisNewDeleteCarouselButton = $(this);
                                $.ajax({
                                    type: 'POST',
                                    url: 'php/deleteCarousel.php',
                                    data:
                                    {
                                        globalProductId: globalProductId,
                                    },
                                    success:function(response){
                                        thisNewDeleteCarouselButton.parent().parent().remove();
                                        console.log(response);
                                    }
                                });
                        });
                    }
                });
            }
        }
    });
    editCarouselButton.click(function(){
        $(this).hide('fast');
        editSliderAButton.show('fast');
        editCarouselSection.slideDown('slow');
        editSliderAButton.show('fast');
        addSliderASection.slideUp('fast');
        addSliderBSection.slideUp('fast');
        editSliderBButton.show('slow');
        editImageGridSection.slideUp('fast');
        editImageGridButton.show('fast');
    });
    editSliderAButton.click(function(){
        addSliderASection.slideDown('slow');
        $(this).hide('fast');
        editSliderBButton.show('slow');
        $('#editCarouselButton').show('slow');
        editCarouselSection.slideUp('fast');
        addSliderBSection.slideUp('fast');
        editImageGridSection.slideUp('fast');
        editImageGridButton.show('fast');
    });
    editImageGridButton.click(function(){
        $(this).hide('fast');
        editImageGridSection.slideDown('slow');
        editSliderBButton.show('slow');
        editSliderAButton.show('slow');
        editCarouselButton.show('slow');
        addSliderBSection.slideUp('fast');
        addSliderASection.slideUp('fast');
        editCarouselSection.slideUp('fast');
    });

    editSliderBButton.click(function(){
        $(this).hide('fast');
        addSliderBSection.slideDown('slow');
        addSliderASection.slideUp('fast');
        editCarouselSection.slideUp('fast');
        editSliderAButton.show('slow');
        editCarouselButton.show('slow');
        editImageGridSection.slideUp('fast');
        editImageGridButton.show('fast');
    });
    //navigational Buttons
    pageCustomizationNav.click(function(){
        $(this).css('color','dimgrey');
        $(this).css('-webkit-text-fill-color','transparent');
        $(this).css('-webkit-text-stroke-width','1px');
        ordersNav.css('color','white');
        ordersNav.css('-webkit-text-stroke-width','0px');
        ordersNav.css('-webkit-text-fill-color','white');
        myProductsNav.css('color','white');
        myProductsNav.css('-webkit-text-stroke-width','0px');
        myProductsNav.css('-webkit-text-fill-color','white');
        salesReportNav.css('color','white');
        salesReportNav.css('-webkit-text-stroke-width','0px');
        salesReportNav.css('-webkit-text-fill-color','white');
        salesReportSection.slideUp('fast');
        myProductSection.slideUp('fast');
        ordersSection.slideUp('fast');
        customerPageCustomizationSection.slideDown('slow');
    });
    myProductsNav.click(function(){
        $(this).css('color','dimgrey');
        $(this).css('-webkit-text-fill-color','transparent');
        $(this).css('-webkit-text-stroke-width','1px');
        pageCustomizationNav.css('color','white');
        pageCustomizationNav.css('-webkit-text-stroke-width','0px');
        pageCustomizationNav.css('-webkit-text-fill-color','white');
        ordersNav.css('color','white');
        ordersNav.css('-webkit-text-stroke-width','0px');
        ordersNav.css('-webkit-text-fill-color','white');
        salesReportNav.css('color','white');
        salesReportNav.css('-webkit-text-stroke-width','0px');
        salesReportNav.css('-webkit-text-fill-color','white');
        myProductSection.slideDown('slow');
        ordersSection.slideUp('fast');
        customerPageCustomizationSection.slideUp('fast');
        salesReportSection.slideUp('fast');
    });
    ordersNav.click(function(){
        $(this).css('color','dimgrey');
        $(this).css('-webkit-text-fill-color','transparent');
        $(this).css('-webkit-text-stroke-width','1px');
        myProductsNav.css('color','white');
        myProductsNav.css('-webkit-text-stroke-width','0px');
        myProductsNav.css('-webkit-text-fill-color','white');
        pageCustomizationNav.css('color','white');
        pageCustomizationNav.css('-webkit-text-stroke-width','0px');
        pageCustomizationNav.css('-webkit-text-fill-color','white');
        salesReportNav.css('color','white');
        salesReportNav.css('-webkit-text-stroke-width','0px');
        salesReportNav.css('-webkit-text-fill-color','white');
        ordersSection.slideDown('slow');
        myProductSection.slideUp('fast');
        customerPageCustomizationSection.slideUp('fast');
        salesReportSection.slideUp('fast');
    });
    salesReportNav.click(function(){
        $(this).css('color','dimgrey');
        $(this).css('-webkit-text-fill-color','transparent');
        $(this).css('-webkit-text-stroke-width','1px');
        myProductsNav.css('color','white');
        myProductsNav.css('-webkit-text-stroke-width','0px');
        myProductsNav.css('-webkit-text-fill-color','white');
        pageCustomizationNav.css('color','white');
        pageCustomizationNav.css('-webkit-text-stroke-width','0px');
        pageCustomizationNav.css('-webkit-text-fill-color','white');
        ordersNav.css('color','white');
        ordersNav.css('-webkit-text-stroke-width','0px');
        ordersNav.css('-webkit-text-fill-color','white');
        ordersSection.slideUp('fast');
        myProductSection.slideUp('fast');
        customerPageCustomizationSection.slideUp('fast');
        salesReportSection.slideDown('slow');
    });
    
    //view Certain product variables
    var certainProductName = $('#certainProductName');
    var certainProductImage = $('#certainProductImage');
    var certainProductDescription = $('#certainProductDescription');
    var certainProductQuantity = $('#certainProductQuantity');
    var certainProductPrice = $('#certainProductPrice');
    //SHOW MyProducts
    $.ajax({
        type: 'GET',
        url: 'php/displayMyProduct.php',
        success:function(response){
            var data = JSON.parse(response);
            $(data).each(function(index, value){
                productsTable.append(`<tr>
                                        <td id="name">${value.name}</td>
                                        <td>
                                            <div style="display: flex; margin: 0px;">
                                                <img src="${value.image}" style="height: 50px; width: 50px;">
                                                <button id="imgLarge" data-bs-toggle="modal" data-bs-target="#viewProductImage" class="viewProductImageButton btn btn-success" value="${value.id}">View</button>
                                            </div>
                                        </td>
                                        <td>${value.description}</td>
                                        <td>${value.available}</td>
                                        <td><span>&#8369<span>${value.price}</td>
                                        <td>
                                            <button class="edit-product btn btn-outline-danger" id="editButton" data-bs-toggle="modal" data-bs-target="#selectEditMethod" value="${value.id}">Edit</button>
                                            <button class="delete-product btn btn-outline-warning" id="deleteButton" value="${value.id}">Delete</button>
                                        </td>
                                    </tr>
                                    `);
            })
            var name = $('#name');
            var btnEdit = $('.edit-product');
            var btnDelete = $('.delete-product');
            var viewProductImageButton = $('.viewProductImageButton');
            viewProductImageButton.click(function(){
                globalProductId = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'php/AVI.php',
                    data:
                    {
                        globalProductId: globalProductId
                    },
                    success:function(response){
                        var data = JSON.parse(response);
                        console.log(data);
                        certainProductName.text(data.name);
                        certainProductImage.attr('src', data.image);
                        certainProductDescription.text(data.description);
                        certainProductQuantity.text(data.quantity);
                        certainProductPrice.text(data.price);
                    }
                });
            });
            btnEdit.click(function(){
                globalProductId = $(this).val();
            });
            btnDelete.click(function(){
                var thisDelete = $(this);
                globalProductId = $(this).val();
                if(confirm('Are you sure you want to DELETE this product?') == true){
                    $.ajax({
                        type: 'POST',
                        url: 'php/deleteProduct.php',
                        data:
                        {
                            globalProductId: globalProductId,
                        },
                        success:function(response){
                            thisDelete.parent().parent().remove();
                            if(response == 'success'){
                                alert('Data Deleted');
                            }
                        }
                    })
                }
            });
        }
    });

    var logOut = $('#logOut');

    logOut.click(function(){
        if(confirm('Are you sure?') == true){
            $.ajax({
                type: 'GET',
                url: 'php/logout.php',
                success:function(response){
                    if( response == "index.html"){
                        window.location.replace(response);
                    }
                }
            })
        }
    });
    //this is all the variables on Edit button on each tablerow
    var editName = $('#editName');
    var editFile = $('#editFile');
    var editDescription = $('#editDescription');
    var editQuantity = $('#editQuantity');
    var editPrice = $('#editPrice');
    var editButton = $('#confirmEditProduct');
    var resetAllEditFields = $('#resetAllEditFields');

    //remove Edit invalid feedback on keydown/click
    editName.on('keydown',function(){
        $(this).removeClass('is-invalid');
    });
    editFile.on('click',function(){
        $(this).removeClass('is-invalid');
    });
    editDescription.on('keydown',function(){
        $(this).removeClass('is-invalid');
    });
    editQuantity.on('keydown',function(){
        $(this).removeClass('is-invalid');
    });
    editPrice.on('keydown',function(){
        $(this).removeClass('is-invalid');
    });
    editButton.click(function(){
        // if a specific Edit input has no data
        if(editName.val() == ""){
            editName.addClass('is-invalid');
        }
        if(editFile.val() == ""){
            editFile.addClass("is-invalid");
        }
        if(editDescription.val() == ""){
            editDescription.addClass('is-invalid');
        }
        if(editQuantity.val() == ""){
            editQuantity.addClass('is-invalid');
        }
        if(editPrice.val() == ""){
            editPrice.addClass('is-invalid');
        }
        if(editName.val() || editFile.val() || editDescription.val() || editQuantity.val() || editPrice.val() != ""){
            var form = new FormData();
            form.append('productId', globalProductId);
            form.append('editName',editName.val());
            form.append('editPrice',editPrice.val());
            form.append('editfile', editFile[0].files[0]);
            form.append('editDescription', editDescription.val());
            form.append('editQuantity', editQuantity.val());

            $.ajax({
                type: 'POST',
                url: 'php/editProduct.php',
                data: form,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 'success'){
                        alert('Data Editted.')
                    }
                }
            })
        }
        resetAllEditFields.click(function(){
            if(confirm('Are you sure you want to RESET?') == true){
                editName.val("");
                editFile.val("");
                editDescription.val("");
                editQuantity.val("");
                editPrice.val("");
            }
        });
    });
    //Manual Product Data Edit
    //manual edit inputs and buttons
    var manualNameEdit = $('#manualNameEdit');
    var manualFileEdit = $('#manualFileEdit');
    var manualDescriptionEdit = $('#manualDescriptionEdit');
    var manualQuantityEdit = $('#manualQuantityEdit');
    var manualPriceEdit = $('#manualPriceEdit');
    var manualNameEditButton = $('#manualNameEditButton');
    var manualFileEditButton = $('#manualFileEditButton');
    var manualDescriptionEditButton = $('#manualDescriptionEditButton');
    var manualQuantityEditButton = $('#manualQuantityEditButton');
    var manualPriceEditButton = $('#manualPriceEditButton');
    //keydown removeClass
    manualNameEdit.on('keydown', function(){
        $(this).removeClass('is-invalid')
    });
    manualFileEdit.click(function(){
        $(this).removeClass('is-invalid');
    });
    manualDescriptionEdit.on('keydown', function(){
        $(this).removeClass('is-invalid');
    });
    manualQuantityEdit.on('keydown', function(){
        $(this).removeClass('is-invalid');
    });
    manualPriceEdit.on('keydown', function(){
        $(this).removeClass('is-invalid');
    });
    //manual edit button functions
    //manual name edit
    manualNameEditButton.click(function(){
        if(manualNameEdit.val() == ""){
            manualNameEdit.addClass('is-invalid');
        }else if(confirm("Are you sure you want to Edit Product's Name?") == true){
            var form = new FormData();
            form.append('productId', globalProductId);
            form.append('manualNameEdit', manualNameEdit.val());
            $.ajax({
                type: 'POST',
                url: 'php/manualNameEdit.php',
                data: form,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 'success'){
                        alert("You successfully edited the Product's Name");
                    }
                }
            })
        }
    });
    manualFileEditButton.click(function(){
        if(manualFileEdit.val() == ""){
            manualFileEdit.addClass('is-invalid');
        }else if(confirm("Are you sure you want to Edit Product Image?") == true){
            var form = new FormData();
            form.append('productId', globalProductId);
            form.append('editfile', manualFileEdit[0].files[0]);
            $.ajax({
                type: 'POST',
                url: 'php/manualFileEdit.php',
                data: form,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 'success'){
                        alert("You successfully edited the Product's Image");
                    }
                }
            });
        }
    });
    manualDescriptionEditButton.click(function(){
        if(manualDescriptionEdit.val() == ""){
            manualDescriptionEdit.addClass('is-invalid');
        }else if(confirm("Are you sure you want to Edit Product's Description?") == true){
            var form = new FormData();
            form.append('productId', globalProductId);
            form.append('manualDescriptionEdit', manualDescriptionEdit.val());
            $.ajax({
                type: 'POST',
                url: 'php/manualDescriptionEdit.php',
                data: form,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response == 'success'){
                        alert("You successfully edited the Product's Description?");
                    }
                }
            })
        }
    });
    manualQuantityEditButton.click(function(){
        if(manualQuantityEdit.val() == ""){
            manualQuantityEdit.addClass('is-invalid');
        }else if(confirm("Are you sure you want to Edit Product's Quantity?") == true){
            var form = new FormData();
            form.append('productId', globalProductId);
            form.append('manualQuantityEdit', manualQuantityEdit.val());
            $.ajax({
                type: 'POST',
                url: 'php/manualQuantityEdit.php',
                data: form,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 'success'){
                        alert("You successfully edited the Product's Quantity");
                    }
                }
            })
        }
    });
    manualPriceEditButton.click(function(){
        if(manualPriceEdit.val() == ""){
            manualPriceEdit.addClass('is-invalid');
        }else if(confirm("Are you sure you want to Edit Product's Price?") == true){
            var form = new FormData();
            form.append('productId', globalProductId);
            form.append('manualPriceEdit', manualPriceEdit.val());
            $.ajax({
                type: 'POST',
                url: 'php/manualPriceEdit.php',
                data: form,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 'success'){
                        alert("You have successfully edited the Product's Price");
                    }
                }
            })
        }
    });
    //this is the Add Product button function
    var productName = $('#productName');
    var productFile = $('#productFile');
    var productDescription = $('#productDescription');
    var productQuantity = $('#productQuantity');
    var productPrice = $('#productPrice');
    var addProductButton = $('#confirmNewProduct');
    var resetAllFields = $('#resetAllFields');

    //remove invalid feedback on keydown/click
    productName.on('keydown',function(){
        productName.removeClass('is-invalid');
    });
    productFile.on('click',function(){
        productFile.removeClass('is-invalid');
    });
    productDescription.on('keydown',function(){
        productDescription.removeClass('is-invalid');
    });
    productQuantity.on('keydown',function(){
        productQuantity.removeClass('is-invalid');
    });
    productPrice.on('keydown',function(){
        productPrice.removeClass('is-invalid');
    });
    //confirm button
    addProductButton.click(function(){
        //if a specific input has no data
        if(productName.val() == ""){
            productName.addClass('is-invalid');
        }
        if(productFile.val() == ""){
            productFile.addClass("is-invalid");
        }
        if(productDescription.val() == ""){
            productDescription.addClass('is-invalid');
        }
        if(productQuantity.val() == ""){
            productQuantity.addClass('is-invalid');
        }
        if(productPrice.val() == ""){
            productPrice.addClass('is-invalid');
        }
        //if the New Product has a Duplicate on "My Products"
        if(productName.val() && productFile.val() && productDescription.val() && productQuantity.val() && productPrice.val() != ""){
            $.ajax({
                type: 'POST',
                url: 'php/productDuplicate.php',
                data:
                {
                    productName: productName.val(),
                    productDescription: productDescription.val(),
                    productQuantity: productQuantity.val(),
                    productPrice: productPrice.val()
                },
                success:function(response){
                    //IF a Duplicate has Detected
                    if(response == "may kapareho"){
                        //if user still want to insert Duplicated data
                        if(confirm("This NEW ITEM has a Duplicate inside your PRODUCTS LIST.   do you still want to proceed?") == true){
                                var formData = new FormData();
                            
                                formData.append("productName", productName.val());
                                formData.append("productFile", productFile[0].files[0]);
                                formData.append("productDescription", productDescription.val());
                                formData.append("productQuantity", productQuantity.val());
                                formData.append("productPrice", productPrice.val());


                                $.ajax({
                                    type: 'POST',
                                    url: 'php/addProduct.php',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function(response){
                                        var data = JSON.parse(response);
                                    $(data).each(function(index,value){
                                        productsTable.append(
                                        `<tr>
                                            <td>${data.name}</td>
                                            <td>
                                                <img src="${data.image}" style="height: 50px; width: 50px;">
                                                <button id="imgLarge" class="imgLarge btn btn-success" value="${value.id}" data-bs-toggle="modal" data-bs-target="#viewProductImage">View</button>
                                            </td>
                                            <td>${data.description}</td>
                                            <td>${data.quantity}</td>
                                            <td><span>&#8369</span>${data.price}</td>
                                            <td>
                                                <button class="edit-product btn btn-outline-danger" id="editButton" data-bs-toggle="modal" data-bs-target="#selectEditMethod" value="${data.id}">Edit</button>
                                                <button class="delete-product btn btn-outline-warning" id="deleteButton" value="${data.id}">Delete</button>
                                            </td>
                                        </tr>`
                                    );
                                    });
                                    var imgLarge = $('.imgLarge');
                                    imgLarge.click(function(){
                                        globalProductId = $(this).val();
                                            $.ajax({
                                                type: 'POST',
                                                url: 'php/AVI.php',
                                                data:
                                                {
                                                    globalProductId: globalProductId
                                                },
                                                success:function(response){
                                                    var data = JSON.parse(response);
                                                    certainProductName.text(data.name);
                                                    certainProductImage.attr('src', data.image);
                                                    certainProductDescription.text(data.description);
                                                    certainProductQuantity.text(data.quantity);
                                                    certainProductPrice.text(data.price);
                                                }
                                            });
                                    });
                                                        
                                    var btnEdit = $('.edit-product');
                                    var btnDelete = $('.delete-product');
                                    btnEdit.click(function(){
                                        globalProductId = $(this).val();
                                    });
                                    btnDelete.click(function(){
                                        var thisDelete = $(this);
                                        globalProductId = $(this).val();
                                        if(confirm('Are you sure you want to DELETE this product?') == true){
                                            $.ajax({
                                                type: 'POST',
                                                url: 'php/deleteProduct.php',
                                                data:
                                                {
                                                    globalProductId: globalProductId,
                                                },
                                                success:function(response){
                                                    thisDelete.parent().parent().remove();
                                                    if(response == 'success'){
                                                        alert('Data Deleted');
                                                    }
                                                }
                                            })
                                        }
                                    });

                                            alert('The New Product Is Inserted Successfully');
                                            productName.val("");
                                            productFile.val("");
                                            productDescription.val("");
                                            productQuantity.val("");
                                            productPrice.val("");
                                        }
                                })
                        //cancel the New Product Input Due to a Duplicate
                        }else{
                            alert('Item Cancelled');
                        }
                    //if there are no duplicates
                    }else{
                        if(confirm("add this NEW PRODUCT to the LIST?") == true){

                            var formData = new FormData();
                            
                            formData.append("productName", productName.val());
                            formData.append("productFile", productFile[0].files[0]);
                            formData.append("productDescription", productDescription.val());
                            formData.append("productQuantity", productQuantity.val());
                            formData.append("productPrice", productPrice.val());


                            $.ajax({
                                type: 'POST',
                                url: 'php/addProduct.php',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response){
                                    var data = JSON.parse(response);
                                    $(data).each(function(index,value){
                                        productsTable.append(
                                        `<tr>
                                            <td>${data.name}</td>
                                            <td>
                                                <img src="${data.image}" style="height: 50px; width: 50px;">
                                                <button id="imgLarge" class="imgLarge btn btn-success" value="${value.id}" data-bs-toggle="modal" data-bs-target="#viewProductImage">View</button>
                                            </td>
                                            <td>${data.description}</td>
                                            <td>${data.quantity}</td>
                                            <td><span>&#8369</span>${data.price}</td>
                                            <td>
                                                <button class="edit-product btn btn-outline-danger" id="editButton" data-bs-toggle="modal" data-bs-target="#selectEditMethod" value="${data.id}">Edit</button>
                                                <button class="delete-product btn btn-outline-warning" id="deleteButton" value="${data.id}">Delete</button>
                                            </td>
                                        </tr>`
                                    );
                                    });
                                    var imgLarge = $('.imgLarge');
                                    imgLarge.click(function(){
                                        globalProductId = $(this).val();
                                            $.ajax({
                                                type: 'POST',
                                                url: 'php/AVI.php',
                                                data:
                                                {
                                                    globalProductId: globalProductId
                                                },
                                                success:function(response){
                                                    var data = JSON.parse(response);
                                                    certainProductName.text(data.name);
                                                    certainProductImage.attr('src', data.image);
                                                    certainProductDescription.text(data.description);
                                                    certainProductQuantity.text(data.quantity);
                                                    certainProductPrice.text(data.price);
                                                }
                                            });
                                    });
                                                        
                                    var btnEdit = $('.edit-product');
                                    var btnDelete = $('.delete-product');
                                    btnEdit.click(function(){
                                        globalProductId = $(this).val();
                                    });
                                    btnDelete.click(function(){
                                        var thisDelete = $(this);
                                        globalProductId = $(this).val();
                                        if(confirm('Are you sure you want to DELETE this product?') == true){
                                            $.ajax({
                                                type: 'POST',
                                                url: 'php/deleteProduct.php',
                                                data:
                                                {
                                                    globalProductId: globalProductId,
                                                },
                                                success:function(response){
                                                    thisDelete.parent().parent().remove();
                                                    if(response == 'success'){
                                                        alert('Data Deleted');
                                                    }
                                                }
                                            })
                                        }
                                    });

                                    alert('The New Product Is Inserted Successfully');
                                    productName.val("");
                                    productFile.val("");
                                    productDescription.val("");
                                    productQuantity.val("");
                                    productPrice.val("");
                                }
                            })
                        }
                    }
                }
            });
        }
    });

        //reset button
    resetAllFields.click(function(){
        if(productName.val() || productFile.val() || productDescription.val() || productQuantity.val() || productPrice.val() != ""){
            if(confirm('Reset all Fields?') == true){
            productName.val("");
            productFile.val("");
            productDescription.val("");
            productQuantity.val("");
            productPrice.val("");
        }
        };
    });
    //dispay Orders
    displayOrders();
    function displayOrders(){
        $.ajax({
            type: 'GET',
            url: 'php/displayOrder.php',
            success: function(response){
                let data = JSON.parse(response);

                $(data).each(function(index, value){
                    addToOrdersTable(index, value.customer_name, value.date, value.id, value.order_type);
                })
            }
        })
    }

    function addToOrdersTable(index,name, date, id, orderType){
        ordersTable.append(`<tr>
                                <td>
                                    ${name}
                                </td>
                                <td>${orderType}</td>
                                <td>${date}</td>
                                <td>
                                    <button value="${id}" class="view btn btn-danger">View Order</button>
                                    <button value="${id}" class="delete btn btn-outline-danger">Delete</button>
                                </td>
                            </tr>`)

        let view = ordersTable.children().eq(index).find('.view');

        view.click(function(){
            viewOrderModal.modal('show');
            orderProductsList.children().remove();
            orderStatuses.children().remove();
            let thisView = $(this);
            $.ajax({
                type: 'POST',
                url: 'php/viewOrder.php',
                data:{
                    order_id: thisView.val()
                },
                success: function(response){
                    let data = JSON.parse(response);

                    let item = '';
                    if(data.items == 1){
                        item = ' item'
                    }else{
                        item = ' items'
                    }
                    numberOfItems.text(data.items + item);
                    $(data.orders).each(function(index, value){
                        addToOrderProductsList(value.image, value.name, value.price, value.quantity, value.total);
                    })
                    $(data.order_statuses).each(function(index, value){
                        addToOrderStatuses(index, value.status, value.date)
                    })
                }
            })
        })
    }

    function addToOrderStatuses(index, status, date){
        orderStatuses.append(`<li class="lh-sm">
                                    ${status}<br>
                                    <span style="font-size: 10px">${date}</span>
                                </li>`)
    }

    function addToOrderProductsList(image, name, price, quantity, total){
        
        orderProductsList.append(`<div class="card shadow mt-3">
                                    <div class="card-body d-flex">
                                        <img src="${image}" class="img-fluid" style="height: 100px; width: 100px; object-fit: cover">
                                        <div class="ms-3">
                                            <h4 class="fw-bold text-secondary">${name}</h4>
                                            <i>Quantity: ${quantity}</i>
                                            <p class="text-danger">&#8369; ${price}</p>
                                        </div>
                                        <p class="ms-auto text-danger fw-bold align-self-center">Total: &#8369; ${total}</p>
                                    </div>
                                </div>`)
    }
});