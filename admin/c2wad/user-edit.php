<?php
session_start();


include "../../conn.php";
include "header.php";
$msg = "";
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_GET['email'])){
	$email = $_GET['email'];
}else{
	$email = '';
}


if(isset($_SESSION['uid'])){
	



}
else{


	header("location:../c2wadmin/signin.php");
}
 


  $sql= "SELECT * FROM users WHERE email = '$email'";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);

      
          $username =  $row['username'];
          
          

        }
				  if(isset($row['username'])  && isset($row['email']) && isset($row['balance']) ){
                      $username;
                      $email;
				  }else{
           
    
              $username =  '';

                $email =  '';
          }
        
          
				  
        
      
      



    if(isset($_POST['edit'])){
	
	
      $emails =$link->real_escape_string( $_POST['email']);
       $username =$link->real_escape_string( $_POST['username']);
        $password =$link->real_escape_string( $_POST['password']);
      $balance =$link->real_escape_string( $_POST['balance']);
      $refbonus =$link->real_escape_string( $_POST['refbonus']);
      $refcode =$link->real_escape_string( $_POST['refcode']);
      $profit =$link->real_escape_string( $_POST['profit']);
      $fname =$link->real_escape_string( $_POST['fname']);
      $emailVerify =$link->real_escape_string( $_POST['emailVerify']);
      

         

      
          
        
      $sql1 = "UPDATE users SET username='$username', fname='$fname', email='$emails',password='$password', balance='$balance', refbonus='$refbonus', refcode='$refcode', profit='$profit', emailVerify='$emailVerify' WHERE email='$email'";
      
      if (mysqli_query($link, $sql1)) {
          $msg = "Account Details Edited Successfully!";
      } else {
          $msg = "Cannot Edit Account! ";
      }
      }



 $sql= "SELECT * FROM users WHERE email = '$email'";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);

      
          $username =  $row['username'];
          
          

        }
				  if(isset($row['username'])  && isset($row['email']) && isset($row['balance']) ){
                      $username;
                      $email;
				  }else{
           
    
              $username =  '';

                $email =  '';
          }

 




?>



<div class="content-wrapper">



  <!-- Main content -->
  <section class="content">


    <div style="width:100%">
      <div class="box box-default">
        <div class="box-header">

          <div class="row">


            <h2 class="text-center">INVESTORS MANAGEMENT</h2>
            </br>

            </br>

          </div>

          <div class="section-body">

            <?php if($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" ."</br></br>";  ?>
            <div class="col-lg-12">

              </br>

              </br>

              <div class="">
                <div class="">
                  <div class="row">
                    <form action="user-edit.php?email=<?php echo $email ;?>" method="POST">

                      <div style="margin-top:-300px;" class="">
                        <div class="col-md-12">

                          <div class="table-responsive">

                            <table class="table table-striped table-hover table-md">

                              <tr>

                                <th>Full Name</th>
                                <th>Username</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Password</th>
                              </tr>


                          </div>
                          <div class="form-group row mb-4">
                            <td> <input type="text" name="fname" class="form-control"
                                value="<?php echo  $row['fname'] ;?>"> </td>
                          </div>

                          <div class="form-group row mb-4">
                            <td> <input type="text" name="username" class="form-control"
                                value="<?php echo  $row['username'] ;?>"> </td>
                          </div>

                          <div class="form-group row mb-4">
                            <td> <input type="text" name="email" class="form-control"
                                value="<?php echo $row['email'] ;?>"></td>
                          </div>


                        </div>
                        <div class="form-group row mb-4">
                          <td> <input type="text" name="password" class="form-control"
                              value="<?php echo $row['password'] ;?>"></td>

                        </div>
                        </tr>
                        <tr>

                          <th>Balance</th>
                          <th class="text-center">Deposit Balance</th>
                          <th class="text-center">Refcode</th>
                          <th class="text-right">Profit</th>
                        </tr>
                        <tr>


                      </div>
                      <div class="form-group row mb-4">
                        <td> <input type="text" name="balance" class="form-control"
                            value="<?php echo $row['balance'] ;?>"> </td>
                      </div>

                      <div class="form-group row mb-4">
                        <td> <input type="text" name="refbonus" class="form-control"
                            value="<?php echo $row['refbonus'] ;?>"></td>
                      </div>

                  </div>
                  <div class="form-group row mb-4">
                    <td> <input type="text" name="refcode" class="form-control" value="<?php echo $row['refcode'] ;?>">
                    </td>
                  </div>

                </div>
                <div class="form-group row mb-4">
                  <td> <input type="text" name="profit" class="form-control" value="<?php echo $row['profit'] ;?>"></td>

                </div>
                </tr>



                <tr>

                  <th>Referred By</th>
                  <th>Email Verification</th>

                </tr>
                <tr>


              </div>
              <div class="form-group row mb-4">
                <td> <input type="text" name="referred" class="form-control" value="<?php echo $row['referred'] ;?>">
                <td> <input type="text" name="emailVerify" class="form-control" value="<?php echo $row['emailVerify'] ;?>">
                </td>
              </div>

            </div>

          </div>
          </tr>


          <tr>


        </div>
        <div class="form-group row mb-4">


      </div>


    </div>
    </tr>
    <tr>
</div>


</div>
</tr>

<tr>



</tr>
<tr>


  </div>

  </div>

  </div>
</tr>





</br></br>







</br></br>



<tr>
  <td>
    <button type="submit" name="edit" class="btn btn-success btn-icon icon-left"><i class="fa fa-check"></i> Edit User
      Details</button>
  </td>
</tr>

</form>

</table>
</div>

<hr>

</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>

</div>
</section>
</div>

</div>
</div>