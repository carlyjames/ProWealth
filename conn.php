<?php
$link = mysqli_connect("localhost","root","","masterfx_coinwebdb2");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to Database:". mysqli_connect_error();
  }
?>