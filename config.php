<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "conn.php";

$sql= "SELECT * FROM settings ";
			  $result = mysqli_query($link,$sql);
			  if(mysqli_num_rows($result) > 0){
                  $row = mysqli_fetch_assoc($result);
                  
                  $currency = $row['currency'];
                  $name = $row['bname'];
                  $logo = $row['logo'];
                  $emaila = $row['email'];
                  $mw = $row['mw'];
                  $address = $row['baddress'];
                  $title = $row['title'];
                  $branch = $row['branch'];
                  $bankurl = $row['sname'];
                  $wl = $row['wl'];
                  $rb = $row['rb'];
                  $ids=$row['id'];
  
                  $bwallet = $row['bwallet'];
                  $usdtTRC20 = $row['usdtTRC20'];
                  $ethereum = $row['ethereum'];
		    
		              $cy = $row['cy'];
                  $pbkey  = $row['public_key'];
                   $prikey  = $row['private_key'];
                  $paye_name  = $row['paye_name'];
                  $paye_acc  = $row['paye_acc'];

                  $upassphrase  = $row['passphrase'];
                  $umember_id  = $row['member_id'];
                  $pft_password  = $row['password'];

				  }
        
                  if(isset($row['bname'])  && isset($row['logo']) && isset($row['title']) && isset($row['wl']) && isset($row['baddress']) && isset($row['branch']) && isset($row['bwallet']) && isset($row['usdtTRC20']) && isset($row['ethereum']) ){
                    $currency = $row['currency'];
                    $name = $row['bname'];
                    $logo = $row['logo'];
                    $emaila = $row['email'];
                    $mw = $row['mw'];
                    $address = $row['baddress'];
                    $title = $row['title'];
                    $branch = $row['branch'];
                    $bankurl = $row['sname'];
                    $wl = $row['wl'];
                    $rb = $row['rb'];
                    $ids = $row['id'];
                    $cy = $row['cy'];
       
                    $bwallet = $row['bwallet'];
                    $usdtTRC20 = $row['usdtTRC20'];
                    $ethereum = $row['ethereum'];
     
		    
                    $pbkey  = $row['public_key'];
                    $prikey  = $row['private_key'];
                    $paye_name  = $row['paye_name'];
                    $paye_acc  = $row['paye_acc'];

                      $upassphrase  = $row['passphrase'];
                      $umember_id  = $row['member_id'];
                      $pft_password  = $row['password'];
                }else{
                     $ids = '';
                    $name = '';
                    $logo = '';
                    $emaila = '';
                    $mw = '';
                    $address = '';
                    $title = '';
                    $branch = '';
                    $bankurl = '';
                    $wl = '';
                    $rb = '';
                    $cy = '';
                    $bwallet = '';
                    $usdtTRC20 = '';
                    $ethereum = '';
                    
                   
			   
         $pbkey  = '';
         $prikey  = '';
         $paye_name  = '';
         $paye_acc  = '';

         $upassphrase  = '';
          $umember_id  = '';
          $pft_password  = '';

        
        }

          
        $sql1= "SELECT * FROM admin";
  $result1 = mysqli_query($link,$sql1);
  if(mysqli_num_rows($result1) > 0){
  $row = mysqli_fetch_assoc($result1);

    if(isset($row['bwallet'])){
  $bw = $row['bwallet'];
}else{
  $bw="";
}
 if(isset($row['member'])){
  $memadmin = $row['member'];
}else{
  $memadmin=0;
}
if(isset($row['withdraw'])){
  $wthadmin = $row['withdraw'];
}else{
  $wthadmin=0;
}

if(isset($row['deposit'])){
  $depadmin = $row['deposit'];
}else{
  $depadmin=0;
}


if(isset($row['ewallet'])){
  $ew = $row['ewallet'];
}else{
  $ew="";
}
if(isset($row['doge'])){
  $dgw = $row['doge'];
}else{
  $dgw="";
}

if(isset($row['bitcash'])){
  $btw = $row['bitcash'];
}else{
  $btw="";
}
if(isset($row['litecoin'])){
  $lw = $row['litecoin'];
}else{
  $lw="";
}

if(isset($row['trc20'])){
  $trcw = $row['trc20'];
}else{
  $trcw="";
}
if(isset($row['bep20'])){
  $bepw = $row['bep20'];
}else{
  $bepw="";
}

if(isset($row['tron'])){
  $tronw = $row['tron'];
}else{
  $tronw="";
}
if(isset($row['erc20'])){
  $ercw = $row['erc20'];
}else{
  $ercw="";
}

if(isset($row['binance'])){
  $biw = $row['binance'];
}else{
  $biw="";
}






}
          
?>