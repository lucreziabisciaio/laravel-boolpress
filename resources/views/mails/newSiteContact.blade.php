<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Nuovo messaggio ricevuto dal form Contatti!</h1>

    <ul>
        <li><strong>Nome Utente:</strong> {{$newContactInfo->name}}</li>
        <li><strong>Email:</strong> {{$newContactInfo->email}}</li>
        <li><strong>Message:</strong> {{$newContactInfo->message}}</li>
    </ul>
</body>

</html>