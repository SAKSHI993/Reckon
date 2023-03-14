<?php
include_once("includes/functions.php");
?>
<?php
  	// verification email and password with Database

        $ch =@mysqli_connect("localhost","root","","olx") or die("connection failure");
        $Email =$_POST['usernamelogin'];
        $Password =$_POST['passwordlogin'];
        //Validate for data 
        $errorsLogin = [];
        
        if($Email == '' || $Password == '' ){
            $errorsLogin[] = 'Please fill in all data';
        }
        $result = mysqli_query($ch, 'SELECT UserID,UserName,Email,Password,Status,type FROM users where Email="'.$Email.'" and Password="'.$Password.'"  ')  or die(mysqli_error($ch)); 
        $row = mysqli_fetch_assoc($result);
        if ($Email == "admin@olx.com" && $Password == "123456" ){
            $_SESSION['admin'] ='YES';
            header('location:index.php');
        }else if (mysqli_num_rows($result)>0 && $row['Status'] == 1 && $row['type']==2){
            $_SESSION['LOGGEDIN'] ='YES';
            
                //Add user id to session -> may be I will need it later specially with the orders,edit preofile,change passe...
            $_SESSION['usernamelogin'] =$row['UserName'];
            $_SESSION['loggedInUserId'] = $row['UserID'];
            header('Location:donator.php'.$url);
        }else if (mysqli_num_rows($result)>0 && $row['Status'] == 1 && $row['type']==1){
            $_SESSION['LOGGEDIN'] ='YES';
            
                //Add user id to session -> may be I will need it later specially with the orders,edit preofile,change passe...
            $_SESSION['usernamelogin'] =$row['UserName'];
            $_SESSION['loggedInUserId'] = $row['UserID'];
            header('Location:manufacturer.php'.$url);
        }else{  
            $errorsLogin[] = 'Username or password Wrong, Please try a different one';
        }


	?>