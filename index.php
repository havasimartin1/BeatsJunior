<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beats Junior</title>
    <link href="style.css" type="text/css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Armata&display=swap" rel="stylesheet">
    <nav>
        <div class="logo">
            <img src="images/trap%20nation%20logo.jpg" width="100px">
        </div>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a onclick="showLoginModal()">Login</a></li>
        </ul>
    </nav>
</head>
<body>
    <div id="overlay"></div>
<main>
    <div class ="text">
        <h1>Willkommen bei Beats Junior</h1>
        <p>hier werden beats verkauft amk</p>
    </div>

    
    <div class="login modal" id="login-modal" data-active="0">
        <form id="register" action="/" method="post">
            <p>Username:</p>
            <input type="text" name="username" required>
            <p>Password:</p>
            <input type="password" name="password" required>
            </br>
            <input type="submit" name="submit-register" value="Register">
            <button type="button" data-value="login" onclick="changeLogin(this)">Login</button>
        </form>
        <form id="login" action="/" method="post">
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
if(isset($_POST["submit-login"]) || isset($_POST["submit-register"])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
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
            echo "Registration successfully...";
            $stmt->close();
            $conn->close();
        }else if(isset($_POST["submit-login"])){
            $stmt=$con->prepare("select * from register where username = ?");
            $stmt->bind_param("s",$username);
            $stmt->execute();
            $stmt_result=$stmt->get_result();
            if($stmt_result->num_rows>0){
            $data=$stmt_result->fetch_assoc();
            if($data['password']===$password){
                echo "succesful";
                redirect("./index.php");
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
    console.log(modal.dataset.active)
    if(!modal.classList.contains("active") && modal.dataset.active === "0"){
       modal.style.display = "block";
       setTimeout(() => {
            modal.classList.add("active");
            document.getElementById("overlay").style.display = block;
            document.getElementById("overlay").classList.add("active");
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
            document.getElementById("overlay").style.display = none;
            document.getElementById("overlay").classList.remove("active");
        }
    })
    
}

</script>


</body>
<style>
    main{
        background-image: url(images/polygon.jpg);
    }
</style>
</html>
