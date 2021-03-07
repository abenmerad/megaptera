<!DOCTYPE html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META http-equiv="Content-Language" CONTENT="fr">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta http-equiv="Content-Style-Type"  content="text/css" />
        <meta name="description" content="Observation, conservation et protection des mammifères marins et du requin baleine.">
        <title>Megaptera</title>
        <link rel="stylesheet" href="style/normalize.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="style/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css"/>
        <link rel="shortcut icon" type="image/x-icon" href="img/img-logo.png"/>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    </head>
    <body>
         <div class="container" id="entete">
             <div class="row">
                <div class="col-md-3 col-sm-3">
                    <a href="index.php"><img src = "img/img-logo.png"></a>
                </div>
             </div>
         </div>
     <div id="page">
         <?php if(isset($_SESSION['poste'])): ?>
            <div class="d-flex justify-content-end" style="font-size=5px;">
                Vous êtes connecté en tant que : <b><?=$_SESSION['poste'] ?></b>
            </div>
         <?php endif; ?>