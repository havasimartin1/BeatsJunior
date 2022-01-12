<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beats Junior</title>
    <link href="style.css" type="text/css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Armata&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="images/favicon-32x32.png">
    <nav>
        <div class="logo">
            <img src="images/logo.png" width="90px">
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php if(!isset($_COOKIE["sid"])): ?>
                <li><a onclick="showLoginModal()">Login</a></li>
            <?php endif; ?>
            <li><a onclick="showCartModal()"><img src="images/warenkorb.png" width="60"></a></li>
        </ul>
    </nav>
</head>
<body>
    <?php 
        $conn = new mysqli('localhost','root','','beatsjunior');
        $beats = [];
        if($conn->connect_error){
            echo "$conn->connect_error";
            die("Connection Failed : ". $conn->connect_error);
        } else {
            $stmt=$conn->prepare("select * from beats");
            $stmt->execute();
            $beats=$stmt->get_result();
            $stmt->close();
            $conn->close();
        }
    ?>
    <div id="overlay"></div>
<div class="main2">
    <h1>Willkommen bei Beats Junior</h1>
    <p>hier werden beats verkauft amk</p>
    <hr>
    <div class="audiotable">
        <table>
            <?php if($beats->num_rows>0): ?>
                <?php while($row = $beats->fetch_assoc()): ?>
                    <tr><td><?php echo htmlspecialchars($row["titel"]) ?></td><td><audio controls preload='auto'><source src='<?php echo htmlspecialchars($row["media_url"]) ?>' type='audio/wav'></audio><br></td><?php if(isset($_COOKIE["sid"])): ?> <button data-product_id='<?php echo htmlspecialchars($row["id"]) ?>' name='Warenkorb' type='button'>In den Warenkorb</button><?php endif;?></tr>

                <?php endwhile;?>
            <?php endif;?>
            <tr><td>Again</td><td><audio controls preload="auto"><source src="beats/Again.wav" type="audio/wav"></audio><br></td></tr>
            <tr><td>America</td><td><audio controls preload="auto"><source src="beats/America.wav" type="audio/wav"></audio><br></td></tr>
        </table>
    </div>
</div>


<div class="modal" id="warenkorb">
    <h2>Warenkorb</h2>
    <form action="/" method="post">

        <input type="submit" value="jetzt kaufen!"/>
    </form>
</div>







    <div class="login modal" id="login-modal" data-active="0">
        <form id="register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <p>Username:</p>
            <input type="text" name="username" required>
            <p>Password:</p>
            <input oninput="passwordChecker(this)" type="password" name="password" required>
            </br>
            <input type="submit" name="submit-register" value="Register">
            <button type="button" data-value="login" onclick="changeLogin(this)">Login</button>
        </form>
        <form id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
<footer>
    <ul>
        <li><a href="faq.html">FAQ</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="privacy.html">Privacy</a></li>
    </ul>
</footer>

    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["submit-login"]) || isset($_POST["submit-register"]))){
        #header('Location: localhost/beats/BeatsJunior');
        #redirect("/");
        $username = $_POST['username'];
        $password = $_POST['password'];

        setcookie('siddd',"2323",time() + (86400 * 7));
        // Database connection
        $conn = new mysqli('localhost','root','','beatsjunior');
        if($conn->connect_error){
            echo "$conn->connect_error";
            die("Connection Failed : ". $conn->connect_error);
        } else {
            if(isset($_POST["submit-register"])){
                $stmt = $conn->prepare("insert into register(username, password) values(?, ?)");
                $stmt->bind_param("ss", $username, $password);
                $stmt->execute();
                echo "jhjhj";

                $stmt=$conn->prepare("select * from register where username = ?");
                $stmt->bind_param("s",$username);
                $stmt->execute();
                $stmt_result=$stmt->get_result();
                if($stmt_result->num_rows>0){
                    $data=$stmt_result->fetch_assoc();
                    $id = $data['id'];
                    setcookie('sid',$id,time() + (86400 * 7));
                    redirect("/");
                }
                $stmt->close();
                $conn->close();
            }else if(isset($_POST["submit-login"])){
                $stmt=$conn->prepare("select * from register where username = ?");
                $stmt->bind_param("s",$username);
                $stmt->execute();
                $stmt_result=$stmt->get_result();
                if($stmt_result->num_rows>0){
                    $data=$stmt_result->fetch_assoc();
                    if($data['password']===$password){
                        echo "succesful";
                        redirect("/");
                    }
                }else{
                    echo "invalid";
                }
            }
        }
    }
    ?>
<script> 

function changeLogin(e){
    if(e.dataset.value === "login"){
        document.getElementById("register").style.display = "none";
        document.getElementById("login").style.display = "block";
    }else if(e.dataset.value === "register"){
        document.getElementById("login").style.display = "none";
        document.getElementById("register").style.display = "block";
    }
}

function showLoginModal(){
    const modal = document.getElementById("login-modal");
    if(!modal.classList.contains("active") && modal.dataset.active === "0"){
       modal.style.display = "block";
        document.getElementById("overlay").classList.add("active");
       setTimeout(() => {
            modal.classList.add("active");
            document.getElementById("overlay").style.display = "block";
       },400);
    }else if(modal.dataset.active === "1"){
       modal.classList.remove("active");
       setTimeout(() => {
            modal.style.display = "none";
       },400);
    }

    window.addEventListener("click", (e) => {
        if(modal.classList.contains("active") && !e.target.closest("#login-modal")){
            modal.classList.remove("active");
            document.getElementById("overlay").style.display = "none";
            document.getElementById("overlay").classList.remove("active");
        }
    })
}


function showCartModal(){
    const modal = document.getElementById("warenkorb");
    if(!modal.classList.contains("active") && modal.dataset.active === "0"){
       modal.style.display = "block";
        document.getElementById("overlay").classList.add("active");
       setTimeout(() => {
            modal.classList.add("active");
            document.getElementById("overlay").style.display = "block";
       },400);
    }else if(modal.dataset.active === "1"){
       modal.classList.remove("active");
       setTimeout(() => {
            modal.style.display = "none";
       },400);
    }

    window.addEventListener("click", (e) => {
        if(modal.classList.contains("active") && !e.target.closest("#login-modal")){
            modal.classList.remove("active");
            document.getElementById("overlay").style.display = "none";
            document.getElementById("overlay").classList.remove("active");
        }
    })
}

function passwordChecker(e){
    const value = e.value;
    let spChars = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.\/?]+/;
    if((value.length > 0 && value.length < 6) || (value.length > 0 &&!spChars.test(value))){
        e.classList.add("wrong");
        e.classList.remove("success");
    }else if(value.length >= 6 && spChars.test(value)){
        e.classList.add("success");
        e.classList.remove("wrong");
    }else if(value.length == 0){
        e.classList.remove("success");
        e.classList.remove("wrong");
    }
}
</script>
</body>
<style>
    .main2{
        background-image: url(images/polygon.jpg);
    }
</style>
</html>
