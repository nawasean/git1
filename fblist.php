<?php
include "../inc_connect.php";
?>
<html>
<head>
<title>ทดสอบ Facebook</title>
</head>
<body>
<?php
$strSQL = "SELECT * FROM tb_facebook";
$rst = mysqli_query($conn, $strSQL) or die ("Error Query [".$strSQL."]");
?>
<table width="400" border="1">
  <tr>
    <th><div align="center">Facebook ID </div></th>
    <th><div align="center">Picture </div></th>
    <th><div align="center">Name </div></th>
    <th><div align="center">CreateDate </div></th>
  </tr>
<?php
while($arr = mysqli_fetch_array($rst))
{
?>
  <tr>
    <td><div align="center"><?php echo $arr["FACEBOOK_ID"];?></div></td>
    <td><a href="<?php echo $arr["LINK"];?>"> <img src="https://graph.facebook.com/<?php echo $arr["FACEBOOK_ID"];?>/picture"></a></td>
    <td><?php echo $arr["NAME"];?></td>
    <td><div align="center"><?php echo $arr["CREATE_DATE"];?></div></td>
  </tr>
<?php
}
?>
</table>
<?php
mysqli_close($conn);
?>
</body>
</html>