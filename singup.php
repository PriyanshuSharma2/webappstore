<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0px;
            padding:0px;
        }
        .container{
            background: linear-gradient(-45deg, #00d5fc, #046af6);
            margin:0px;
            padding:0px;
            width:100px;
            height:auto;
        }
        .input{
            margin:30px;
            position: relative;
        }
        .input input:focus-within{
            border-bottom-color: #1f80e0;
        }
        .input .icon{
            position:absolute;
            left:0px;
            top:15px;
            font-size:1.3rem;
        }
        .input input{
            width:300px;
            height:40px;
            font-size:1.3rem;
            padding: 0px 0px 0px 30px;
            border:none;
            outline:none;
            border-bottom:1px solid #ccc;
        }
        .span{
            color:red;
            font-size:1.3rem;
            margin:5px;
        }
        .container{
            border:1px solid black;
            width:100vw;
            height:100vh;
            display:flex;
            justify-content: center;
            align-items: center;
        }
        body{
            overflow-x: hidden;
            font-family: "Roboto","HelveticaNeue-Light",sans-serif ;
        }
        .form-div{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding:10px 12px;
            background-color:white;
            transition: transform 0.5s;
            border-radius:10px;
        }
        .form-div:hover{
            box-shadow:8px 8px 8px black;
            transform: translateY(-5px);
        }
        .signup{
            margin:5px 0px;
        }
        #submit{
            width:345px;
            border-radius:5px;
            padding:5px 0px;
            background-color:#046af6;
            color:white;
        }
        #submit:hover{
            background-color: #00d5fc;
            box-shadow:2px 2px 5px #00d5fc;
            outline:none;
            border:none;
        }
        .checkbox-text{
            margin:30px;
            text-align:center;
        }
        .checkbox-text a{
            color: #046af6; 
        }
    </style>
</head>
<body>
    
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <?php

$host = "localhost";
$user = "root";
$password = "";
$database = "userregistration";
$con = mysqli_connect($host,$user,$password,$database);
            $error=$error2 = " ";
          if(isset($_POST['submit'])){
            $Fname = mysqli_real_escape_string($con, $_POST['firstname']);
            $Lname = mysqli_real_escape_string($con, $_POST['lastname']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $Cpassword = mysqli_real_escape_string($con, $_POST['confirmpassword']);

            $pass = password_hash($password, PASSWORD_BCRYPT);
            $Cpass = password_hash($Cpassword, PASSWORD_BCRYPT);

            $sql = " select * from usersignup where email = '$email' ";
            $query = mysqli_query($con,$sql);
            $email_count = mysqli_num_rows($query);
            if($email_count>0){
                $error = "Email already exists";
            }
            else{
                if($password === $Cpassword){
                    $insert_query = " insert into usersignup(firstname,lastname,email,password,confirmpassword)values('$Fname','$Lname','$email','$pass','$Cpass') ";
                    mysqli_query($con,$insert_query);
                    header("location:index.html");
                }
                else{
                    $error2 = "password doesnot match";
                }
            }
            
          }   
    ?>
    <div class="container">
        <div class="form-div">
            <div class="signup"><h1>SignUp<h1></div>
            <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> " method = "POST">
                <div class="input">
                    <input type="text" name="firstname"  placeholder="First Name" required>
                    <span><ion-icon name="person-outline" class="icon"></ion-icon></span>
                </div>
                <div class="input">
                    <input type="text" name="lastname"  placeholder="Last Name" required>
                    <span><ion-icon name="person-outline" class="icon"></ion-icon></span>
                </div>
                <div class="input">
                    <input type="email" name="email"  placeholder="Email@abc.xy" required>
                    <span><ion-icon name="mail-outline" class="icon"></ion-icon></span>
                    <div class="span"><?php echo $error; ?></div>
                </div>
                <div class="input">
                    <input type="password" name="password"  placeholder="Password" required>
                    <span><ion-icon name="lock-closed-outline" class="icon"></ion-icon></span>
                    <div class="span"><?php echo $error2; ?></div>
                </div>
                <div class="input">
                    <input type="password" name="confirmpassword"  placeholder="Confirm Password" required>
                    <span><ion-icon name="lock-closed-outline" class="icon"></ion-icon></span>
                </div>
                <div class="input">
                    <input type="submit"  name="submit" value = "Submit" id="submit">
                </div>
                <div class="checkbox-text">
                    <p>Already have an account?<a href="./login.php" target="_self">Login here</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
