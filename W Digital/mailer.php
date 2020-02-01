<?php

    // Get the form fields, removes html tags and whitespace.
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["mensaje"]);
    $tel = trim($_POST["tel"]);

    // Check the data.
    if (empty($name) OR empty($message) OR empty ($tel) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: http://www.wdigital.com.ar/index.php?success=-1#form");
        exit;
    }

    // Set the recipient email address. Update this to YOUR desired email address.
    $recipient = "wdigitalar@gmail.com";

    // Set the email subject.
    $subject = "Nuevo mensaje de $name";

    // Build the email content.
    $email_content = "Nombre: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Mensaje:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    mail($recipient, $subject, $email_content, $email_headers);
    
    // Redirect to the index.html page with success code.
    header("Location: http://www.wdigital.com.ar/index.php?success=1#form");

?>