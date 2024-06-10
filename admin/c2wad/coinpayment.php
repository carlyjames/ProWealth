
<?php

session_start();


include "../../conn.php";

$msg = "";
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_SESSION['uid'])){
	



}
else{


	header("location:../c2wadmin/signin.php");
}





if(isset($_POST['uset'])){

   
    $private_key = $_POST['private_key'];
     
     
      $public_key = $_POST['public_key'];
     
       
   
      $sql = "UPDATE settings SET  public_key='$public_key', private_key='$private_key' ";
     
      
      if(mysqli_query($link, $sql)){
 
         $msg = "Settings Updated!";
       }else{
         
         $msg = "Settings Not Updated!";
       }

   }




include "header.php";


    ?>





 <div class="content-wrapper">
  


  <!-- Main content -->
  <section class="content">



   




<div class="col-md-12 col-sm-12 col-sx-12">
          <div class="box box-default">
            <div class="box-header with-border">

          <h4 align="center"><i class="fa fa-plus"></i> COINPAYMENT SETTINGS</h4>
</br>


        
         

 
          <hr></hr>
          
        
          
            <div class="box-header with-border">
            
            <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
          </br>
          
          
            <?php   
         $sql1= "SELECT * FROM settings";
         $result1 = mysqli_query($link,$sql1);
         if(mysqli_num_rows($result1) > 0){
         $row = mysqli_fetch_assoc($result1);
       
                  $private_key  = $row['private_key'];
                  $public_key  = $row['public_key'];

       
      
      }
          ?>

     <form class="form-horizontal" method="POST" >

           <legend>Update Coinpayment Details</legend>
		   
		   
		 
     <div class="form-group">
         <label>Public Key</label>
        <input type="text" name="public_key" value="<?php echo $public_key ;?>" placeholder="Public Key"  class="form-control">
        </div>
        <div class="form-group">
         <label>Private Key</label>
        <input type="text" name="private_key" value="<?php echo $private_key ;?>" placeholder="Private Key"  class="form-control">
        </div>
 
	  <button style="" type="submit" class="btn btn-primary" name="uset" >Update Details </button>
	  


    </form>
    </div>
   </div>

   </div>
  </div>
  </section>
</div>

