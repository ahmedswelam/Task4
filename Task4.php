<!-- 
    Create a form with the following inputs (name, email, password, address, , linkedin url,
    profile pic) Validate inputs then return message to user. 
* validation rules ... 
name  = [required , string]
email = [required,email]
password = [required,min = 6]
address = [required,length = 10 chars]
linkedin url = [reuired | url]
Profile pic =[required|image]. 
Note upload image to server. 
Then create a profile page to read data that user inserted.
-->

<?php 
    session_start();
?>

<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body background="bk.jpg">  

<h2 style="color: white; text-align: center;font-size: xx-large;">Register</h2>
    
<p style="color: red; text-align: center;">
<span class="error" >* required field</span>
</p>
    
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data" 
    style="text-align: center;">  
        Name: <br> <input type="text" name="name" value="">
        <span class="error" style="color: red">* </span>
        <br><br>
        E-mail: <br> <input type="text" name="email" value="">
        <span class="error" style="color: red">* </span>
        <br><br>
        Password: <br> <input type="password" name="password" value="">
        <span class="error" style="color: red">* </span>
        <br><br>
        Address: <br> <input type="text" name="address" value="">
        <span class="error" style="color: red">* </span>
        <br><br>
        linkedin URL: <br> <input type="text" name="linkedin" value="">
        <span class="error" style="color: red">* </span>
        <br><br>
        Profile picture :  <br><br>
        <input type="file"  id="image" name="image" >
        <span class="error" style="color: red">* </span>
        <br><br>
        <input type="submit" name="submit" value="Submit">  
    </form>


</body>
</html>

<?php 



$result = '';
$result_str = '';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $linkedin = $_POST['linkedin'];

    $errors =[''];

  if (empty($_POST["name"])) {
       # code...
       echo $errors = "Name is required" .'<br>';
      } else {
       echo $result_str = $name .'<br>';

      }

    
      if (empty($_POST["email"])) {
        # code...
        echo $errors = "Email is required" .'<br>';
    }else{
        echo $result_str = $email .'<br>';
    }

    if (empty($_POST["password"])) {
        # code...
        echo $errors = "password is required" .'<br>';
    }elseif ($_POST["password"] <= "6" ) {
        # code...
        echo $errors = "password less than 6" .'<br>';
    }else{
    echo $result_str = $password .'<br>';  
    }

    if (empty($_POST["address"])) {
        # code...
        echo $errors = "adsress is required" .'<br>';
    }elseif ($_POST["address"] <= "10" ) {
        # code...
        echo $errors = "address not equl 10" .'<br>';  
    }else{
        echo $result_str = $address .'<br>';  
    }

    if (empty($_POST["linkedin"])) {
        # code...
        echo $errors = "linkedin is required" .'<br>';
    }elseif(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$linkedin)) {
        echo $errors = "Linkedin URL not valided" .'<br>';  
        //echo $result_str = $linkedin .'<br>';  
    }else{
        echo $result_str = $linkedin .'<br>';  
    }
}

if(!empty($_FILES['image']['name'])){

    $tmpPath    =  $_FILES['image']['tmp_name'];
    $imageName  =  $_FILES['image']['name'];
    $imageSize  =  $_FILES['image']['size'];
    $imageType  =  $_FILES['image']['type'];

     // name.ex

    $exArray   = explode('.',$imageName);
    $extension = end($exArray);

    $FinalName = rand().time().'.'.$extension;

    $allowedExtension = ["png",'jpg'];

     if(in_array($extension,$allowedExtension)){
         // code .... 

        $desPath = './uploads/'.$FinalName;

         if(move_uploaded_file($tmpPath,$desPath)){
             echo 'Image Uploaded';
         }else{
             echo 'Error In Uploading file';
         }


     }else{
         echo 'Not Allowed Extension .... ';
     }

     
     if(count($errors) > 0){
        foreach ($errors as $key => $value) {
            # code...
            echo '* '.$key.' : '.$value.'<br>';
        }
    }else{
           
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['addres'] = $address;
        $_SESSION['linkedin'] = $linkedin;
        $_SESSION['image'] = $image;

        //header("Location: profile.php");

    }
    header("Location: profile.php");
 }
?>
