<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["submit-login"]) || isset($_POST["submit-register"]))){
        #header('Location: localhost/beats/BeatsJunior');
        #redirect("/");
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Database connection
        $conn = new mysqli('localhost','beatsjunior','Beatsjunior1234','beatsjunior_root');
        if($conn->connect_error){
            echo "$conn->connect_error";
            die("Connection Failed : ". $conn->connect_error);
        } else {
            if(isset($_POST["submit-register"])){
                $stmt = $conn->prepare("insert into User(username, password, admin) values(?, ?, 0)");
                $stmt->bind_param("ss", $username, $password);
                $stmt->execute();

                $stmt=$conn->prepare("select * from User where username = ?");
                $stmt->bind_param("s",$username);
                $stmt->execute();
                $stmt_result=$stmt->get_result();
                if($stmt_result->num_rows>0){
                    $data=$stmt_result->fetch_assoc();
                    $id = $data['id'];
                    setcookie('sid',$id,time() + (86400 * 7));
                }
                $stmt->close();
                $conn->close();
                header('Location: /');
            }else if(isset($_POST["submit-login"])){
                $stmt=$conn->prepare("select * from User where username = ?");
                $stmt->bind_param("s",$username);
                $stmt->execute();
                $stmt_result=$stmt->get_result();
                if($stmt_result->num_rows>0){
                    $data=$stmt_result->fetch_assoc();
                    $id = $data['id'];
                    if($data['password']===$password){
                        $stmt->close();
                        $conn->close();
                        setcookie('sid',$id,time() + (86400 * 7));
                        header('Location: /');
                    }
                }else{
                    header('Location: /');
                }
            }
        }
    }
    ?>