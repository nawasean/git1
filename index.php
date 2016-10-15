<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "../inc_connect.php";
require 'facebook.php';

$facebook = new Facebook(array(
  'appId'  => '697510530389819',
  'secret' => '08d486a3dc597cb876a69f280b1998fe',
));

// Get User ID
$user = $facebook->getUser();

if ($user) {
  try {
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

// Save to mysql
if ($user) {
	if(isset($_GET["code"]) and $_GET["code"] != "")
	{
		$strSQL ="  INSERT INTO  tb_facebook (FACEBOOK_ID,NAME,LINK,CREATE_DATE) 
					VALUES 
					('".trim($user_profile["id"])."',
					'".trim($user_profile["name"])."',
					'".trim($user_profile["link"])."',
					'".trim(date("Y-m-d H:i:s"))."')";
		$objQuery  = mysqli_query($conn,$strSQL);
		mysqli_close($conn);
		header("location:fb1.php");
		exit();
	}
}

// Logout
if(isset($_GET["Action"]) and $_GET["Action"] == "Logout")
{
	$facebook->destroySession();
	header("location:fb1.php");
	exit();
}

?>
<!doctype html>
<html>
  <head>
    <title>ทดสอบ Facebook</title>
  </head>
  <body>
    <h1>php-sdk</h1>

    <?php if ($user): ?>
      <a href="fb2.php">หน้า 2</a> | 
	  <a href="fblist.php">สมาชิก</a> | 
	  <a href="?Action=Logout">Logout</a>
    <?php else: ?>
      <div>
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>

    <h3>PHP Session</h3>
    <pre><?php print_r($_SESSION); ?></pre>

    <?php if ($user): ?>
      <h3>You</h3>
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

      <h3>Your User Object (/me)</h3>
      <pre><?php print_r($user_profile); ?></pre>
    <?php else: ?>
      <strong><em>You are not Connected.</em></strong>
    <?php endif ?>

  </body>
</html>
