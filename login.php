 <?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "userregistration";
    $con = mysqli_connect($host,$user,$password,$database);
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $sql = " select * from usersignup where email ='$email' ";
        $query = mysqli_query($con, $sql);
        $count = mysqli_num_rows($query);
        if($count==1){
            $Email_pass = mysqli_fetch_assoc($query);
            $db_pass = $Email_pass['password'];
            $decode = password_verify($password, $db_pass);
        }
        else{
            ?>
            <script>
                alert("Email doesnot Exist ");
            </script>
            <?php
        }
    }
    ?>