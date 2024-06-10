<?php
session_start(); 
include "../conn.php";
include "../config.php";
/*

   This script demonstrates getting and validating SCI
   payment confirmation data from Perfect Money server

   !!! WARNING !!!
   This sample PHP-script is provided AS IS and you should
   use it at your own risk.
   The only purpose of this script is to demonstarate main
   principles of SCI-payment validation proccess.
   You MUST modify it before using with your particular
   Perfect Money account.

*/


/* Constant below contains md5-hashed alternate passhrase in upper case.
   You can generate it like this:
   strtoupper(md5('your_passphrase'));
   Where `your_passphrase' is Alternate Passphrase you entered
   in your Perfect Money account.*/
   $pmhash = strtoupper(md5($upassphrase));
define('ALTERNATE_PHRASE_HASH',  $pmhash);

/* Two constants below are required to act additional payment 
	 verification using Perfect Money API interface in purpose of 
	 improving security. Please fill in them with your actual data.
	 Please note that you also need to turn on API for your server's 
	 IP in your Perfect Money account.*/
define('PM_MEMBER_ID',  $umember_id); // Your Perfect Money member ID
define('PM_PASSWORD',  $pft_password); // Password you use to login your account

function additionlPaymentCheckingUsingAPI(){

			$f=fopen('https://perfectmoney.com/acct/historycsv.asp?AccountID='.PM_MEMBER_ID.'&PassPhrase='.PM_PASSWORD.'&startmonth='.date("m", $_POST['TIMESTAMPGMT']).'&startday='.date("d", $_POST['TIMESTAMPGMT']).'&startyear='.date("Y", $_POST['TIMESTAMPGMT']).'&endmonth='.date("m", $_POST['TIMESTAMPGMT']).'&endday='.date("d", $_POST['TIMESTAMPGMT']).'&endyear='.date("Y", $_POST['TIMESTAMPGMT']).'&paymentsreceived=1&batchfilter='.$_POST['PAYMENT_BATCH_NUM'], 'rb');
			if($f===false) return 'error openning url';

			$lines=array();
			while(!feof($f)) array_push($lines, trim(fgets($f)));

			fclose($f);

			if($lines[0]!='Time,Type,Batch,Currency,Amount,Fee,Payer Account,Payee Account,Payment ID,Memo'){
				 return $lines[0];
			}else{

				 $ar=array();
				 $n=count($lines);
				 if($n!=2) return 'payment not found';

				 $item=explode(",", $lines[1], 10);
				 if(count($item)!=10) return 'invalid API output';
				 $item_named['Time']=$item[0];
				 $item_named['Type']=$item[1];
				 $item_named['Batch']=$item[2];
				 $item_named['Currency']=$item[3];
				 $item_named['Amount']=$item[4];
				 $item_named['Fee']=$item[5];
				 $item_named['Payer Account']=$item[6];
				 $item_named['Payee Account']=$item[7];
				 $item_named['Payment ID']=$item[8];
				 $item_named['Memo']=$item[9];

				 if($item_named['Batch']==$_POST['PAYMENT_BATCH_NUM'] && $_POST['PAYMENT_ID']==$item_named['Payment ID'] && $item_named['Type']=='Income' && $_POST['PAYEE_ACCOUNT']==$item_named['Payee Account'] && $_POST['PAYMENT_AMOUNT']==$item_named['Amount'] && $_POST['PAYMENT_UNITS']==$item_named['Currency'] && $_POST['PAYER_ACCOUNT']==$item_named['Payer Account']){
						return 'OK';
				 }else{
						return "Some payment data not match: 
batch:  {$_POST['PAYMENT_BATCH_NUM']} vs. {$item_named['Batch']} = ".(($item_named['Batch']==$_POST['PAYMENT_BATCH_NUM']) ? 'OK' : '!!!NOT MATCH!!!')."
payment_id:  {$_POST['PAYMENT_ID']} vs. {$item_named['Payment ID']} = ".(($item_named['Payment ID']==$_POST['PAYMENT_ID']) ? 'OK' : '!!!NOT MATCH!!!')."
type:  Income vs. {$item_named['Type']} = ".(('Income'==$item_named['Type']) ? 'OK' : '!!!NOT MATCH!!!')."
payee_account:  {$_POST['PAYEE_ACCOUNT']} vs. {$item_named['Payee Account']} = ".(($item_named['Payee Account']==$_POST['PAYEE_ACCOUNT']) ? 'OK' : '!!!NOT MATCH!!!')."
amount:  {$_POST['PAYMENT_AMOUNT']} vs. {$item_named['Amount']} = ".(($item_named['Amount']==$_POST['PAYMENT_AMOUNT']) ? 'OK' : '!!!NOT MATCH!!!')."
currency:  {$_POST['PAYMENT_UNITS']} vs. {$item_named['Currency']} = ".(($item_named['Currency']==$_POST['PAYMENT_UNITS']) ? 'OK' : '!!!NOT MATCH!!!')."
payer account:  {$_POST['PAYER_ACCOUNT']} vs. {$item_named['Payer Account']} = ".(($item_named['Payer Account']==$_POST['PAYER_ACCOUNT']) ? 'OK' : '!!!NOT MATCH!!!');
				 }

			}

}

// Path to directory to save logs. Make sure it has write permissions.
define('PATH_TO_LOG',  '../postback/trans_log');

$usd = $_POST['PAYMENT_AMOUNT'];

$exp_id = explode("_", $_POST['PAYMENT_ID']);
$uid = $exp_id[0];
$pid = $exp_id[1];
$string=
      $_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
      $_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
      $_POST['PAYMENT_BATCH_NUM'].':'.
      $_POST['PAYER_ACCOUNT'].':'.ALTERNATE_PHRASE_HASH.':'.
      $_POST['TIMESTAMPGMT'];

$hash=strtoupper(md5($string));

/* 
   Please use this tool to see how valid hash is genereted: 
   https://perfectmoney.com/acct/md5check.html 
*/
if($hash==$_POST['V2_HASH']){ // proccessing payment if only hash is valid

   /* In section below you must implement comparing of data you recieved
   with data you sent. This means to check if $_POST['PAYMENT_AMOUNT'] is
   particular amount you billed to client and so on. */

   if($_POST['PAYEE_ACCOUNT']==$paye_acc && $_POST['PAYMENT_UNITS']=='USD'){

			$apcua=additionlPaymentCheckingUsingAPI();
			if($apcua=='OK'){

				/* ...insert some code to proccess valid payments here... */
				
				$cdate = date('Y-m-d H:i:s');
				
				 $sql1 = "SELECT * FROM users WHERE id = '$uid' LIMIT 1";
    $result = mysqli_query($link, $sql1);
    if(mysqli_num_rows($result) > 0){

        $row1 = mysqli_fetch_assoc($result);
        $email = $row1['email'];
        $referred = $row1['referred'];
        
    }
    
    $sql12 = "SELECT * FROM package1 WHERE id = '$pid' LIMIT 1";
    $result2 = mysqli_query($link, $sql12);
    if(mysqli_num_rows($result2) > 0){

        $row12 = mysqli_fetch_assoc($result2);
        $uincrease = $row12['increase'];
        $utype = $row12['type'];
        $uduration = $row12['duration'];
        $ufrom = $row12['froms'];
        $uto = $row12['tos'];
        $pname = $row12['pname'];

    }
    
    
    $tnx = uniqid('tnx');
     $sql = "INSERT INTO btc (account,usd,cointype,allamount,email,status,tnxid,type,referred)
            VALUES ('$pname','$usd','Perfect Money','','$email','approved','$tnx','Deposit','$referred')";
            
            mysqli_query($link, $sql);
    
     $sql22 = "INSERT INTO Trading (email,pname,increase,bonus,duration,pdate,froms,activate,usd,payday)
VALUES ('$email','$pname','$uincrease','0','$uduration','$cdate','$ufrom','1','$usd','$cdate')";
		      mysqli_query($link, $sql22);
		      
		      if($referred !=""){

          $refb = ($usd / 100)*5;
          $sql6 = "UPDATE users SET refbonus = refbonus + $refb, balance = balance + $refb  WHERE refcode ='$referred'";
		      mysqli_query($link, $sql6);

          }

				// uncomment code below if you want to log successfull payments
				 $f=fopen(PATH_TO_LOG."good.log", "ab+");
				fwrite($f, date("d.m.Y H:i")."; POST: ".serialize($_POST)."; STRING: $string; HASH: $hash\n");
				fflush($f);
				fclose($f); 
				
			}else{	// you can also save invalid payments for debug purposes

				// uncomment code below if you want to log requests with fake data
				 $f=fopen(PATH_TO_LOG."bad.log", "ab+");
				fwrite($f, date("d.m.Y H:i")."; REASON: additional checking failed with error(s): ".$apcua."; POST: ".serialize($_POST)."; STRING: $string; HASH: $hash\n");
				fflush($f);
				fclose($f); 

			}

   }else{ // you can also save invalid payments for debug purposes

      // uncomment code below if you want to log requests with fake data
       $f=fopen(PATH_TO_LOG."bad.log", "ab+");
      fwrite($f, date("d.m.Y H:i")."; REASON: fake data; POST: ".serialize($_POST)."; STRING: $string; HASH: $hash\n");
			fflush($f);
      fclose($f); 

   }


}else{ // you can also save invalid payments for debug purposes

   // uncomment code below if you want to log requests with bad hash
    $f=fopen(PATH_TO_LOG."bad.log", "ab+");
   fwrite($f, date("d.m.Y H:i")."; REASON: bad hash; POST: ".serialize($_POST)."; STRING: $string; HASH: $hash\n");
	 fflush($f);
   fclose($f); 

}

?>