
<?php 

require_once('appvars.php');

session_start();

if (!isset($_SESSION['group_id_max'])) {

	$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
	or die('Error connecting to MySQL server.'. mysql_error());

	mysql_select_db(DB_NAME)
	or die('Error selecting MySQL database.'. mysql_error());

	$name = mysql_real_escape_string(trim($_POST['name']));
	$gender = mysql_real_escape_string(trim($_POST['gender']));
	$age = mysql_real_escape_string(trim($_POST['age']));
	$livingState = mysql_real_escape_string(trim($_POST['livingState']));
	$livingCity = mysql_real_escape_string(trim($_POST['livingCity']));
	$livingCountry = mysql_real_escape_string(trim($_POST['livingCountry']));
	$birthState = mysql_real_escape_string(trim($_POST['birthState']));
	$birthCity = mysql_real_escape_string(trim($_POST['birthCity']));
	$birthCountry = mysql_real_escape_string(trim($_POST['birthCountry']));
	$placeType = mysql_real_escape_string(trim($_POST['placeType']));
	$education = mysql_real_escape_string(trim($_POST['education']));
	$occupation = mysql_real_escape_string(trim($_POST['occupation']));
	$race = mysql_real_escape_string(trim($_POST['race']));


	$query = "INSERT INTO users (id, name, gender, age, livingState, livingCity, livingCountry, birthState, birthCity, birthCountry, placeType, education, occupation, race) VALUES (0, '$name', '$gender', '$age', '$livingState', '$livingCity', '$livingCountry', '$birthState', '$birthCity', '$birthCountry', '$placeType', '$education', '$occupation', '$race')";
	$result=mysql_query($query);
	if($result===FALSE)
		die('Error querying MySQL server.'. $query);

	$query = "INSERT INTO sessions (id, user_id, time) VALUES ('". session_id(). "', LAST_INSERT_ID(), NOW())";
	$result=mysql_query($query);
	if($result===FALSE)
		die('Error querying MySQL server.'. $query);

	mysql_close($dbc);

	//	$_SESSION['group_num']=$_POST['groups'];
	//	$_SESSION['image_num_per_group']=$_POST['images'];

	$_SESSION['group_id_max']=-1;
	$_SESSION['group_id']=0;

	$files=scandir(IMAGE_DIR);
	$files=array_diff($files, array('.', '..', '.DS_Store'));
	// 	foreach (scandir(IMAGE_DIR) as $file){
	// 		if(is_file(IMAGE_DIR.$file))
	// 			$files[]=$file;
	// 	}
	shuffle($files);
	if(APP_GROUP_NUM*APP_IMAGE_NUM_PER_GROUP<=count($files)){
		$_SESSION['image_sequence']=array_slice($files, 0, APP_GROUP_NUM*APP_IMAGE_NUM_PER_GROUP);
	}else{
		die("Error exceeding the number of images in database!");
	}

}else{

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
	}


	//order matters
	if($_SERVER['REQUEST_METHOD']=='GET'){
		//		if ($_SESSION['group_id_max']<0)
		//			$_SESSION['group_id']++;
		//		else
		$_SESSION['group_id']--;

	}else{
		if($_SESSION['group_id_max']<$_SESSION['group_id']){
			$_SESSION['group_id_max']=$_SESSION['group_id'];
		}
		$_SESSION['group_id']++;
	}

	if($_SESSION['group_id']<=$_SESSION['group_id_max']){
		//read database
		$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
		or die('Error connecting to MySQL server.'. mysql_error());

		mysql_select_db(DB_NAME)
		or die('Error selecting MySQL database.'. mysql_error());

		$session=session_id();
		$group=$_SESSION['group_id'];

		$query = "SELECT * FROM ratings WHERE session_id='$session' AND group_id=$group ORDER BY rating";
		$data=mysql_query($query);

		if($data===FALSE)
			die('Error querying MySQL server.'. mysql_error());

		while ($row = mysql_fetch_array($data)) {
			$_SESSION['image_sequence'][$group*APP_IMAGE_NUM_PER_GROUP+$row['rating']]=$row['image'];
		}

		mysql_close($dbc);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Visual Assessment</title>

<!-- load Dojo -->
<link rel="stylesheet" type="text/css"
	href="./js/dojo/resources/dojo.css" />
<link rel="stylesheet" type="text/css"
	href="./js/dijit/themes/tundra/tundra.css" />
<link rel="stylesheet" type="text/css" href="./style.css" />
<script type="text/javascript" src="./js/dojo/dojo.js"
	data-dojo-config="parseOnLoad: true, isDebug:true"></script>

<script type="text/javascript">
dojo.require("dojo.parser");
dojo.require("dojox.image.LightboxNano");
dojo.require("dijit.form.Button");
dojo.require("dijit.form.Form");
dojo.require("dijit.ProgressBar");
dojo.require("dojo.dnd.Source");
dojo.require("dojo.dnd.Container");

dojo.addOnLoad(function(){
	dojo.subscribe("/dnd/start", function(source, nodes, copy){
		dojo.query(".dojoDndAvatar .dojoDndItem").style("width", "200px");
	});
});

</script>

</head>

<body class="tundra" style="background-color: white; font-size: medium;">
	<div class="myRating">
		Please rank the photos in order of visual preference, with #1 being
		your favorite. <br> Click on the image to see a larger version. <br>
		Photos can also be rearranged once they are in the box below. <br>
		Once you are satisfied with the order, click submit to go to the next
		group.
	</div>
	<div id="imageTable" data-dojo-id="imageTable"
		data-dojo-type="dojo.dnd.Source"
		data-dojo-props="horizontal: true, accept: []"
		class="myRatingImageTable">
		<?php 
		for ($i=0; $i<APP_IMAGE_NUM_PER_GROUP; $i++){
	?>

		<div class="dojoDndItem"
				style="border: 1px solid black; padding: 8px; margin: 0.6%; box-shadow: 5px 5px 5px #888888; width: <?php echo 80/APP_IMAGE_NUM_PER_GROUP. '%'?>; background: white; float: left;">
			<img data-dojo-type="dojox.image.LightboxNano"
				data-dojo-props="<?php echo 'href: \''. IMAGE_DIR. $_SESSION['image_sequence'][APP_IMAGE_NUM_PER_GROUP*$_SESSION['group_id']+$i]. '\'';?>"
				href="<?php echo IMAGE_DIR. $_SESSION['image_sequence'][APP_IMAGE_NUM_PER_GROUP*$_SESSION['group_id']+$i];?>"
				src="<?php echo IMAGE_DIR. $_SESSION['image_sequence'][APP_IMAGE_NUM_PER_GROUP*$_SESSION['group_id']+$i];?>"
				style="width: 100%;">
		</div>

		<?php
		}
		?>
	</div>

	<div id="alert" class="myRatingAlert">You have images left!</div>

	<div id="resultTable" data-dojo-id="resultTable"
		data-dojo-type="dojo.dnd.Source" data-dojo-props="horizontal: true"
		class="myRatingResultTable">
		<p style="margin: 5px auto">Drag and drop images here in sorted order</p>
	</div>


	<div class="myRatingNumber">

		<?php 
		for ($i=0; $i<APP_IMAGE_NUM_PER_GROUP; $i++){
	?>

		<div style="padding: 8px; margin: 0px 0.6%; width: <?php echo 80/APP_IMAGE_NUM_PER_GROUP. '%'?>; text-align: center; font: large bold; color: lightgray; float: left">
			<?php echo $i+1;?>
		</div>

		<?php
		}
		?>
	</div>

	<table class="myRatingButtonTable">
		<tr>
			<!--td class="myRatingButtonBack" style="visibility: <?php if ($_SESSION['group_id']==0) echo 'hidden'; else echo 'visible';?>">
				<div id="backForm" data-dojo-id="backForm"
					data-dojo-type="dijit.form.Form"
					data-dojo-props='action: "<?php echo $_SERVER['PHP_SELF'] ?>", method:"GET"'>
					<button data-dojo-type="dijit.form.Button"
						data-dojo-props='type:"submit", baseClass: "mycss"' type="submit">Back</button>
				</div>
			</td-->
			<td class="myRatingButtonSubmit">
				<div id="submitForm" data-dojo-id="submitForm"
					data-dojo-type="dijit.form.Form"
					data-dojo-props='action: "<?php if($_SESSION['group_id']<(APP_GROUP_NUM-1)) echo $_SERVER['PHP_SELF']; else echo './end.php'; ?>", method:"POST"'>

					<script type="dojo/method" data-dojo-event="onSubmit"
						data-dojo-args="evt">
							if(imageTable.getAllNodes().length>0){
								dojo.style("alert", "visibility", "visible");
								dojo.style("imageTable", "border", "1px solid red");
								return false;
							}
							resultTable.getAllNodes().forEach(function(dndNode, index, list){
								dojo.query("img", dndNode).forEach(function(imageNode){
									var imageFile=dojo.attr(imageNode, "src");
									dojo.create("input", {"type": "hidden", "name": ""+index, "value": imageFile}, dojo.byId("submitForm"));	
								});
							});
							dojo.style("alert", "visibility", "hidden");
							dojo.style("imageTable", "border", "");

							return true;
					</script>
					<button data-dojo-type="dijit.form.Button"
						data-dojo-props='type:"submit", baseClass: "mycss"' type="submit">Submit
					</button>

				</div>
			</td>
			<!--td class="myRatingButtonExit">
				<div id="exitForm" data-dojo-id="exitForm"
					data-dojo-type="dijit.form.Form"
					data-dojo-props='action: "<?php echo './end.php'; ?>", method:"GET"'>
					<button data-dojo-type="dijit.form.Button"
						data-dojo-props='type:"submit", baseClass: "mycss"' type="submit">Exit</button>
				</div>
			</td-->
		</tr>
	</table>




</body>
</html>
