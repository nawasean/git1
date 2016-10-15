<?php
require 'facebook.php';

$facebook = new Facebook(array(
  'appId'  => '697510530389819',
  'secret' => '08d486a3dc597cb876a69f280b1998fe',
));

// Get User ID
$user = $facebook->getUser();

if (!$user) {
	header("location:fb1.php");
}
else
{
  try {
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}


?>
<!doctype html>
<html>
  <head>
    <title>ทดสอบ Facebook</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <h1>Page 2</h1>
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
