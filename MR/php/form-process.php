<?php

$errorMSG = "";

// NAME
if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
}

// PHONE
if (empty($_POST["phone"])) {
    $errorMSG .= "Phone is required ";
} else {
    $phone = $_POST["phone"];
}

// PARTY
if (empty($_POST["party"])) {
    $errorMSG .= "Party size is required ";
} else {
    $party = $_POST["party"];
}

// DATE AND TIME
if (empty($_POST["datetime"])) {
    $errorMSG .= "Date and Time are required ";
} else {
    $datetime = $_POST["datetime"];
}
// // MSG SUBJECT
// if (empty($_POST["msg_subject"])) {
//     $errorMSG .= "Subject is required ";
// } else {
//     $msg_subject = $_POST["msg_subject"];
// }


// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "Message is required ";
} else {
    $message = $_POST["message"];
}

//Add your email here
$EmailTo = "restauranteelnaranjal@hotmail.com";
$Subject = "Reservacion Restaurante";

// prepare email body text
$Body = "";
$Body .= "Nombre de la persona: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Correo Electronico: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Telefono: ";
$Body .= $phone;
$Body .= "\n";
$Body .= "Cantidad de personas: ";
$Body .= $party;
$Body .= "\n";
$Body .= "Fecha y hora: ";
$Body .= $datetime;
$Body .= "\n";
$Body .= "Mensaje adicional: ";
$Body .= $message;
$Body .= "\n";

// send email
$success = mail($EmailTo, $Subject, $Body, "From:".$email);

// redirect to success page
if ($success && $errorMSG == "") {
    echo "<script>
            alert('El correo se envió correctamente');
            window.location.href = '../reservations.html'; // Redirige a un nivel arriba, donde está el archivo HTML
        </script>";
} else {
    if ($errorMSG == "") {
        echo "<script>
                alert('Error al enviar correo');
                window.location.href = '../reservations.html'; // Redirige a un nivel arriba, donde está el archivo HTML
            </script>";
    } else {
        echo "<script>
                alert('Error: '+ " . json_encode($errorMSG) . ");
                window.location.href = '../reservations.html'; // Redirige a un nivel arriba, donde está el archivo HTML después de mostrar el error
            </script>";
    }  
}


?>