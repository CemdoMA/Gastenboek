<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
		<title>Gastenboek</title>
	</head>
	<body>
    <h1>Cem den Ouden</h1>
    <h2>MD2A</h2>
		<div class="container">
		  <form id="contact" action="" method="post">
		    <h3>Laat een leuk berichtje achter</h3>
		    <fieldset>
		      <input placeholder="U naam" type="text" tabindex="1" required autofocus name="user_name">
		    </fieldset>
		    <fieldset>
		      <textarea placeholder="Typ hier uw bericht" tabindex="5" required name="user_message"></textarea>
		    </fieldset>
		    <fieldset>
		      <button name="submit" type="submit" id="contact-submit" data-submit="...Verzenden">Verzenden</button>
		    </fieldset>
<!--              <div class="links">-->
              <strong><h4>Ga <a href="comments.php">hier</a> naar de comments!</h4></strong>
              <button onclick="alert('fuck,motherfucker,shit,cunt,lul,sukkel,kut,fack')">Lijst van verboden woorden</button>
<!--              </div>-->
		  </form>
		</div>

	</body>
</html>

<?php
require_once('dbconnectONLINE.php');
$dbc = mysqli_connect(HOST, USER, PASS, DBNAME) or die('Error connect');

if(isset($_POST['submit'])){

    if (preg_match("%[a-zA-Z]%", $_POST["user_name"])) {

        $message_user = strip_tags($_POST['user_message']);
        $badWords = array('/fuck/', '/motherfucker/', '/shit/', '/cunt/', '/lul/', '/sukkel/', '/kut/', '/fack/');
        $hidingWord = '****';
        $cleaned = preg_replace($badWords, $hidingWord, $message_user);

        $username = strip_tags($_POST['user_name']);
        $date = date("d-m-Y/H:m:s");
        $query = "INSERT INTO gastenboek_comments VALUES (0,'$username','$date','$cleaned')";
        $result = mysqli_query($dbc, $query) or die ('Error querying haha.');
        $message = 'You have recived a new message'; //' . $username . "<br/></br/>" . $cleaned . "<br/></br> Date: " . $date
        $to = '22315@ma-web.nl';
        $subject = 'New message';
        $from = 'Gastenboek INC.';
        mail($to, $subject, $message, 'From:' . $from);

        header('location:comments.php');
    }else{
        echo "INVALID NAME";
    }

}
?>

