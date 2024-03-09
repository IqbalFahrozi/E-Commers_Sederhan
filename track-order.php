<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include_once 'includes/config.php';
$oid = intval($_GET['oid']);

// Handling file upload
if(isset($_FILES['proofOfTransfer'])) {
  $file_name = $_FILES['proofOfTransfer']['name'];
  $file_tmp = $_FILES['proofOfTransfer']['tmp_name'];
  $file_type = $_FILES['proofOfTransfer']['type'];
  $file_size = $_FILES['proofOfTransfer']['size'];
  
  // Generate unique file name to prevent duplication
  $unique_file_name = uniqid() . '_' . $file_name;
  
  // Move uploaded file to a designated directory
  // Mengambil konten file
$file_content = file_get_contents($file_tmp);
// Melakukan escape terhadap konten file untuk mencegah SQL injection
$file_content = mysqli_real_escape_string($con, $file_content);

// Simpan konten file ke dalam tabel 'bukti' di database
$query = "INSERT INTO bukti (order_id, bukti) VALUES ('$oid', '$file_content')";
if(mysqli_query($con, $query)) {
    echo "File berhasil diunggah dan data berhasil disimpan.";
} else {
    echo "Gagal menyimpan data ke database.";
}

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order Tracking Details</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="anuj.css" rel="stylesheet" type="text/css">
</head>
<body>

<div style="margin-left:50px;">
 <form name="updateticket" id="updateticket" method="post" enctype="multipart/form-data"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr height="50">
      <td colspan="2" class="fontkink2" style="padding-left:0px;"><div class="fontpink2"> <b>Order Tracking Details !</b></div></td>
      
    </tr>
    <tr height="30">
      <td  class="fontkink1"><b>order Id:</b></td>
      <td  class="fontkink"><?php echo $oid;?></td>
    </tr>
    <!-- File upload field -->
    <tr height="30">
        <td class="fontkink1"><b>Upload Bukti Transfer:</b></td>
        <td class="fontkink"><input type="file" name="proofOfTransfer"></td>
    </tr>
    
    <?php 
    $ret = mysqli_query($con,"SELECT * FROM ordertrackhistory WHERE orderId='$oid'");
    $num = mysqli_num_rows($ret);
    if($num > 0) {
        while($row = mysqli_fetch_array($ret)) {
    ?>
    <tr height="20">
      <td class="fontkink1" ><b>At Date:</b></td>
      <td class="fontkink"><?php echo $row['postingDate'];?></td>
    </tr>
     <tr height="20">
      <td class="fontkink1"><b>Status:</b></td>
      <td class="fontkink"><?php echo $row['status'];?></td>
    </tr>
     <tr height="20">
      <td class="fontkink1"><b>Remark:</b></td>
      <td class="fontkink"><?php echo $row['remark'];?></td>
    </tr>
    <tr>
      <td colspan="2"><hr /></td>
    </tr>
   <?php } }
else{
   ?>
   <tr>
   <td colspan="2">Order Not Processed Yet</td>
   </tr>
   <?php  }
$st = 'Delivered';
$rt = mysqli_query($con,"SELECT * FROM orders WHERE id='$oid'");
while($num = mysqli_fetch_array($rt)) {
    $currrentSt = $num['orderStatus'];
}
if($st == $currrentSt) { ?>
   <tr>
       <td colspan="2"><b>Product Delivered successfully </b></td>
   <?php } ?>
</table>
<input type="submit" value="Upload Proof of Transfer"> <!-- Add a submit button for the form -->
 </form>
</div>

</body>
</html>
