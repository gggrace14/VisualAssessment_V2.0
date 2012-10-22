<?php
require_once('appvars.php');

session_start();

// order matters
if ($_SERVER['REQUEST_METHOD']=='POST'){

	$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
	or die('Error connecting to MySQL server.'. mysql_error());
	
	mysql_select_db(DB_NAME)
	or die('Error selecting MySQL database.'. mysql_error());

	for ($i=0; $i<count($_POST); $i++){
		$session=session_id();
		$group=$_SESSION['group_id'];
		$image=basename($_POST[$i]);

		if($_SESSION['group_id']>$_SESSION['group_id_max']){
			$query = "INSERT INTO ratings (session_id, group_id, rating, image) VALUES ('$session', $group, $i, '$image')";
		}else{
			$query = "UPDATE ratings SET image='$image' WHERE session_id='$session' AND group_id=$group AND rating=$i";
		}

		$result=mysql_query($query);
		if($result===FALSE)
			die('Error querying MySQL server.'. mysql_error());
	}

	mysql_close($dbc);
	 
	 
	if($_SESSION['group_id_max']<$_SESSION['group_id']){
		$_SESSION['group_id_max']=$_SESSION['group_id'];
	}
	$_SESSION['group_id']++;
}


if (isset($_SESSION['group_id_max'])) {

	$_SESSION = array();

	// Delete the session cookie by setting its expiration to an hour ago (3600)
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), "", time() - 42000, "/");
	}

	// Destroy the session
	session_destroy();
	session_commit();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Visual Assessment</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript">
function close_window(){
	console.log("==========")
	window.self.close();
}

</script>
</head>

<body>


	<p class="myEnd">Thank you for your interest in participating in this assessment! You have completed the assessment. If you would like more information about the Central Virginia Visual Assesment Project, please send an email to [ghuang@virginia.edu].</p>
</body>
</html>
