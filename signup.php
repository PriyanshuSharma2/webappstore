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
                ?>
                <script>
                    alert("Email already exists");
                </script>
                <?php
            }
            else{
                if($password === $Cpassword){
                    $insert_query = " insert into usersignup(firstname,lastname,email,password,confirmpassword)values('$Fname','$Lname','$email','$pass','$Cpass') ";
                    mysqli_query($con,$insert_query);
                    ?>
                    <script>
                        alert("Singup successfully");
                    </script>
                    <?php
                }
                else{
                    alert("Password doesnot match");
                }
            }
            
          }   
    ?>