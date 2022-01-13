

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beats Junior</title>
    <link href="./style.css" type="text/css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Armata&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="images/favicon-32x32.png">
    <script type="text/javascript" src="/script.js"></script>
</head>
<body>
    <?php include "./navigation.php"?>
    <?php 
        $setCookie = isset($_COOKIE["sid"]);
        $conn = new mysqli('localhost','beatsjunior','Beatsjunior1234','beatsjunior_root');
        if($conn->connect_error){
            echo "$conn->connect_error";
            die("Connection Failed : ". $conn->connect_error);
        } else {
            $stmt=$conn->prepare("select * from Beat");
            $stmt->execute();
            $beats=$stmt->get_result();
            $stmt->close();
            $conn->close();
        }
    ?>
    <div id="overlay"></div>
<main>
    <h1>Willkommen bei Beats Junior</h1>
    <p>hier werden beats verkauft amk</p>
    <hr>
    <div class="audiotable">
        <table>
            <?php if($beats->num_rows>0): ?>
                <?php while($row = $beats->fetch_assoc()): ?>
                    <div class="beat-item">
                        <div><?php echo htmlspecialchars($row["titel"]) ?></div>
                        <div><audio controls controlsList="nodownload noplaybackrate" preload='auto'><source src='<?php echo htmlspecialchars($row["media_url"]) ?>' type='audio/wav'></audio></div>
                        <?php if(!$setCookie): ?> 
                            <div><button onclick="addCart(this)" data-titel='<?php echo htmlspecialchars($row["titel"]) ?>' data-product_id='<?php echo htmlspecialchars($row["id"]) ?>' name='Warenkorb' type='button'>In den Warenkorb</button></div>
                        <?php endif;?>
                    </div>

                <?php endwhile;?>
            <?php endif;?>
        </table>
    </div>
</main>


<div class="modal" id="warenkorb" data-active="0">
    <h2>Warenkorb</h2>
    <form action="/" method="post">
        <div id="cart">
            
        </div>

        <input type="submit" value="jetzt kaufen!"/>
    </form>
</div>







    <div class="login modal" id="login-modal" data-active="0">
        <form id="register" action="/login.php" method="post">
            <p>Username:</p>
            <input type="text" name="username" required>
            <p>Password:</p>
            <input oninput="passwordChecker(this)" type="password" name="password" required>
            </br>
            <input type="submit" name="submit-register" value="Register">
            <button type="button" data-value="login" onclick="changeLogin(this)">Login</button>
        </form>
        <form id="login" action="/login.php" method="post">
            <p>Username:</p>
            <input type="text" name="username" required>
            <p>Password:</p>
            <input type="password" name="password" required>
            </br>
            <input type="submit" name="submit-login" value="Login">
            </br>
            <button type="button" data-value="register" onclick="changeLogin(this)">Register</button>
        </form>
    </div>
</div>
</main>
<?php include "/users/beatsjunior/www/footer.php"?>

</body>
</html>
