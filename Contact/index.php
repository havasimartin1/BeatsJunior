<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beats Junior</title>
    <link href="/style.css" type="text/css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Armata&display=swap" rel="stylesheet">
    <script type="text/javascript" src="/script.js"></script>
</head>
<body>
    
<?php include "./navigation.php"?>
<main>
    <form action="" method="post">
        <div class ="text">
            <p>Message</p>
            <textarea required id="message" name="message" rows="5" cols="33" placeholder="Schreibe uns eine Nachricht"></textarea>
            <input type="submit" value="Nachricht senden"/>
        </div>
    </form>
</main>
<?php include "./footer.php"?>
</body>
</html>
