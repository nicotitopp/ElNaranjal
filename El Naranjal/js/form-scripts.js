$("#reservationForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Please fill all required fields!");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});


function submitForm(){
    // Initiate Variables With Form Content
    var name = $("#rname").val();
    var email = $("#remail").val();
    var phone = $("#rphone").val();
    var party = $("#party").val();
    var datetime = $("#datetimepicker1").val();
    var message = $("#rmessage").val();


    $.ajax({
        type: "POST",
        url: "php/form-process.php",
        data: "name=" + name + "&email=" + email + "&phone=" + phone + "&party=" + party + "&datetime=" + datetime + "&message=" + message,
        dataType: "json",
        success : function(text){
            if (response.status == "success"){
                formSuccess(response.message);
            } else {
                formError();
                submitMSG(false,text);
            }
        }
    });
}

function formSuccess(msg){
    $("#php/form-process.php")[0].reset();
    submitMSG(true, msg);

    var alertContainer = $("#alert-container");
    alertContainer.html(`
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>RESERVACION ENVIADA CON EXITO</strong> ${msg}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
}

function formError(){
    $("#php/form-process.php").removeClass().addClass('animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });


    var alertContainer = $("#alert-container");
    alertContainer.html(`
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong> ¡Algo salió mal! Por favor, inténtelo de nuevo.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center fadeIn animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}

