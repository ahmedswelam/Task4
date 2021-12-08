<h2>Your Input:</h2>

<?php 


session_start();

if(isset($_SESSION['name']) && isset($_SESSION['email']) ){
 echo  $_SESSION['name'].'<br>';
 echo  $_SESSION['email'].'<br>';
 echo  $_SESSION['password'] .'<br>';
 echo  $_SESSION['addres'] .'<br>';
 echo  $_SESSION['linkedin'] .'<br>';
 echo  $_SESSION['image'] .'<br>';
}else{
    ;
}


//  echo $_SESSION['user']['name'];

?>
