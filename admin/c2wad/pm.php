
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

   
    $member_id = $_POST['member_id'];
     
     
      $passphrase = $_POST['passphrase'];
      $paye_acc = $_POST['paye_acc'];
      $paye_name = $_POST['paye_name'];
      $password = $_POST['password'];
     
       
   
      $sql = "UPDATE settings SET  member_id='$member_id', password='$password', paye_name='$paye_name', paye_acc='$paye_acc', passphrase='$passphrase' ";
     
      
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

          <h4 align="center"><i class="fa fa-plus"></i> PERFECT MONEY SETTINGS</h4>
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
       
                  $paye_name  = $row['paye_name'];
                  $paye_acc  = $row['paye_acc'];

                  $upassphrase  = $row['passphrase'];
                  $umember_id  = $row['member_id'];
                  $pft_password  = $row['password'];
       
      
      }
          ?>

     <form class="form-horizontal" method="POST" >

           <legend>Update Perfect Money Details</legend>
		   
		   
		 
     <div class="form-group">
         <label>Member ID</label>
        <input type="text" name="member_id" value="<?php echo $umember_id ;?>" placeholder="Member ID"  class="form-control">
        </div>
        <div class="form-group">
         <label>Password</label>
        <input type="text" name="password" value="<?php echo $pft_password ;?>" placeholder="Password"  class="form-control">
        </div>
        <div class="form-group">
         <label>Payee Account</label>
        <input type="text" name="paye_acc" value="<?php echo $paye_acc;?>" placeholder="Payee Account"  class="form-control">
        </div>
        <div class="form-group">
         <label>Payee Name</label>
        <input type="text" name="paye_name" value="<?php echo $paye_name ;?>" placeholder="Payee Name"  class="form-control">
        </div>
        <div class="form-group">
         <label>PassPhrase</label>
        <input type="text" name="passphrase" value="<?php echo $upassphrase ;?>" placeholder="PassPhrase"  class="form-control">
        </div>

      
      

     
   
	  
	  <button style="" type="submit" class="btn btn-primary" name="uset" >Update Details </button>
	  


    </form>
    </div>
   </div>

   </div>
  </div>
  </section>
</div>

