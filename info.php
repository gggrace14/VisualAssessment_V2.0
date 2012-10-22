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
<link rel="stylesheet" type="text/css" href="style.css" />

<script type="text/javascript" src="./js/dojo/dojo.js"
	data-dojo-config="parseOnLoad: true, isDebug:true"></script>

<script type="text/javascript">
dojo.require("dojo.parser");
dojo.require("dijit.form.TextBox");
dojo.require("dijit.form.ValidationTextBox");
dojo.require("dijit.form.Button");
dojo.require("dijit.form.Form");
dojo.require("dijit.form.Select");
dojo.require("dijit.form.CheckBox");

dojo.addOnLoad(function(){
	dijit.byId("nameTextBox").focus();
});

</script>

</head>

<body class="tundra" style="font-size: medium">
	<div class="myLogin">

		<div data-dojo-type="dijit.form.Form"
			data-dojo-props='action: "./group.php", method:"POST"'>

			<script type="dojo/method" data-dojo-event="onSubmit">
				return this.validate();
			</script>

			<p class="myLogin">Profile</p>
			<table class="myLogin">
				<tr>
					<td class="myLoginLabel"><label for="name">Name:</label>
					</td>
					<td class="myLoginText"><input id="nameTextBox"
						data-dojo-type="dijit.form.ValidationTextBox"
						data-dojo-props="name:'name', regExp: '[A-z][A-z\\s]*', required: false, invalidMessage: 'Name is required.', missingMessage: 'Name is required.', propercase: true, trim: true, style:'width: 50%'"
						type="text">
					</td>
				</tr>
				<tr>
					<td class="myLoginLabel"><label for="gender">Gender:*</label>
					</td>
					<td class="myLoginText"><input id="genderFemale"
						data-dojo-type="dijit.form.RadioButton"
						data-dojo-props="name:'gender', value:'female', checked: true, required: true, missingMessage: 'Gender is required.'"
						type="radio" checked /><label for="genderFemale"
						style="margin: 0px 10px 0px 8px">Female</label><input
						id="genderMale" data-dojo-type="dijit.form.RadioButton"
						data-dojo-props="name:'gender', value:'male', required: true, missingMessage: 'Gender is required.'"
						type="radio" /><label for="genderMale"
						style="margin: 0px 10px 0px 8px">Male</label>
					</td>
				</tr>
				<tr>
					<td class="myLoginLabel"><label for="age">Age:*</label>
					</td>
					<td class="myLoginText"><select id="ageSelect"
						data-dojo-type="dijit.form.Select"
						data-dojo-props="name:'age', required: true,  missingMessage: 'Age is required.', style:'width: 50%'">
							<option value="">(select)</option>
							<option value="Under 15">Under 15</option>
							<option value="15-24">15-24</option>
							<option value="25-44">25-44</option>
							<option value="45-64">45-64</option>
							<option value="Over 65">Over 65</option>
					</select>
					</td>
				</tr>
				<tr>
					<td class="myLoginLabel"><label for="livingCity">Current residence:*</label>
					</td>
					<td class="myLoginText">
						<table>
							<tr>
								<td class="myLoginNestedLabel"><label for="livingState">State:</label>
								</td>
								<td class="myLoginNestedText" colspan="3"><select id="livingStateSelect"
									data-dojo-type="dijit.form.Select"
									data-dojo-props="name:'livingState', required: true,  missingMessage: 'Current residence is required.', style:'width: 50%'">
										<option value="">(select)</option>
										<option value="AL">Alabama</option>
										<option value="AK">Alaska</option>
										<option value="AZ">Arizona</option>
										<option value="AR">Arkansas</option>
										<option value="CA">California</option>
										<option value="CO">Colorado</option>
										<option value="CT">Connecticut</option>
										<option value="DE">Delaware</option>
										<option value="DC">District Of Columbia</option>
										<option value="FL">Florida</option>
										<option value="GA">Georgia</option>
										<option value="HI">Hawaii</option>
										<option value="ID">Idaho</option>
										<option value="IL">Illinois</option>
										<option value="IN">Indiana</option>
										<option value="IA">Iowa</option>
										<option value="KS">Kansas</option>
										<option value="KY">Kentucky</option>
										<option value="LA">Louisiana</option>
										<option value="ME">Maine</option>
										<option value="MD">Maryland</option>
										<option value="MA">Massachusetts</option>
										<option value="MI">Michigan</option>
										<option value="MN">Minnesota</option>
										<option value="MS">Mississippi</option>
										<option value="MO">Missouri</option>
										<option value="MT">Montana</option>
										<option value="NE">Nebraska</option>
										<option value="NV">Nevada</option>
										<option value="NH">New Hampshire</option>
										<option value="NJ">New Jersey</option>
										<option value="NM">New Mexico</option>
										<option value="NY">New York</option>
										<option value="NC">North Carolina</option>
										<option value="ND">North Dakota</option>
										<option value="OH">Ohio</option>
										<option value="OK">Oklahoma</option>
										<option value="OR">Oregon</option>
										<option value="PA">Pennsylvania</option>
										<option value="RI">Rhode Island</option>
										<option value="SC">South Carolina</option>
										<option value="SD">South Dakota</option>
										<option value="TN">Tennessee</option>
										<option value="TX">Texas</option>
										<option value="UT">Utah</option>
										<option value="VT">Vermont</option>
										<option value="VA">Virginia</option>
										<option value="WA">Washington</option>
										<option value="WV">West Virginia</option>
										<option value="WI">Wisconsin</option>
										<option value="WY">Wyoming</option>
										<option value="Other">Other</option>

										<script type="dojo/method" data-dojo-event="onChange"
											data-dojo-args="newValue">
											if(newValue=="Other"){
												dojo.style("livingCountryLabelTD", "visibility", "visible");
												dojo.style("livingCountryTextBoxTD", "visibility", "visible");
												dijit.byId("livingCountryTextBox").attr("required", true);
											}else{
												dojo.style("livingCountryLabelTD", "visibility", "hidden");
												dojo.style("livingCountryTextBoxTD", "visibility", "hidden");
												dijit.byId("livingCountryTextBox").attr("required", false);
												dijit.byId("livingCountryTextBox").attr("value", "");
											}
										</script>
								</select>
								</td>
							</tr>
							<tr>
								<td class="myLoginNestedLabel"></td>
								<td class="myLoginInstruction" colspan="3">(If other, please provide city and country)</td>
							</tr>
							<tr>
								<td class="myLoginNestedLabel"><label for="livingCity">City:</label>
								</td>
								<td class="myLoginNestedText"><input id="livingCityTextBox"
									data-dojo-type="dijit.form.ValidationTextBox"
									data-dojo-props="name:'livingCity', regExp: '[A-z][A-z\\s\']*', required: true, invalidMessage: 'Invalid living city.', missingMessage: 'Current residence is required.', propercase: true, trim: true, style:'width: 100%'"
									type="text">
								</td>
								<td id="livingCountryLabelTD" class="myLoginNestedLabel"
									style="visibility: hidden;"><label for="livingCountry">Country:</label>
								</td>
								<td id="livingCountryTextBoxTD" class="myLoginNestedText"
									style="visibility: hidden;"><input id="livingCountryTextBox"
									data-dojo-type="dijit.form.ValidationTextBox"
									data-dojo-props="name:'livingCountry', regExp: '[A-z][A-z\\s\']*', required: false, invalidMessage: 'Invalid place of birth.', missingMessage: 'Current residence is required.', trim: true, style:'width: 100%'"
									type="text">
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="myLoginLabel"><label for="birthCity">Place of Birth:*</label>
					</td>
					<td class="myLoginText">
						<table>
							<tr>
								<td class="myLoginNestedLabel"><label for="birthState">State:</label>
								</td>
								<td class="myLoginNestedText" colspan="3"><select id="birthStateSelect"
									data-dojo-type="dijit.form.Select"
									data-dojo-props="name:'birthState', required: true,  missingMessage: 'Place of birth is required.', style:'width: 50%'">
										<option value="">(select)</option>
										<option value="AL">Alabama</option>
										<option value="AK">Alaska</option>
										<option value="AZ">Arizona</option>
										<option value="AR">Arkansas</option>
										<option value="CA">California</option>
										<option value="CO">Colorado</option>
										<option value="CT">Connecticut</option>
										<option value="DE">Delaware</option>
										<option value="DC">District Of Columbia</option>
										<option value="FL">Florida</option>
										<option value="GA">Georgia</option>
										<option value="HI">Hawaii</option>
										<option value="ID">Idaho</option>
										<option value="IL">Illinois</option>
										<option value="IN">Indiana</option>
										<option value="IA">Iowa</option>
										<option value="KS">Kansas</option>
										<option value="KY">Kentucky</option>
										<option value="LA">Louisiana</option>
										<option value="ME">Maine</option>
										<option value="MD">Maryland</option>
										<option value="MA">Massachusetts</option>
										<option value="MI">Michigan</option>
										<option value="MN">Minnesota</option>
										<option value="MS">Mississippi</option>
										<option value="MO">Missouri</option>
										<option value="MT">Montana</option>
										<option value="NE">Nebraska</option>
										<option value="NV">Nevada</option>
										<option value="NH">New Hampshire</option>
										<option value="NJ">New Jersey</option>
										<option value="NM">New Mexico</option>
										<option value="NY">New York</option>
										<option value="NC">North Carolina</option>
										<option value="ND">North Dakota</option>
										<option value="OH">Ohio</option>
										<option value="OK">Oklahoma</option>
										<option value="OR">Oregon</option>
										<option value="PA">Pennsylvania</option>
										<option value="RI">Rhode Island</option>
										<option value="SC">South Carolina</option>
										<option value="SD">South Dakota</option>
										<option value="TN">Tennessee</option>
										<option value="TX">Texas</option>
										<option value="UT">Utah</option>
										<option value="VT">Vermont</option>
										<option value="VA">Virginia</option>
										<option value="WA">Washington</option>
										<option value="WV">West Virginia</option>
										<option value="WI">Wisconsin</option>
										<option value="WY">Wyoming</option>
										<option value="Other">Other</option>
										<script type="dojo/method" data-dojo-event="onChange"
											data-dojo-args="newValue">
											if(newValue=="Other"){
												dojo.style("birthCountryLabelTD", "visibility", "visible");
												dojo.style("birthCountryTextBoxTD", "visibility", "visible");
												dijit.byId("birthCountryTextBox").attr("required", true);
											}else{
												dojo.style("birthCountryLabelTD", "visibility", "hidden");
												dojo.style("birthCountryTextBoxTD", "visibility", "hidden");
												dijit.byId("birthCountryTextBox").attr("required", false);
												dijit.byId("birthCountryTextBox").attr("value", "");
											}
										</script>
								</select>
								</td>
							</tr>
							<tr>
								<td class="myLoginNestedLabel"></td>
								<td class="myLoginInstruction" colspan="3">(If other, please provide city and country)</td>
							</tr>
							<tr>
								<td class="myLoginNestedLabel"><label for="birthCity">City:</label>
								</td>
								<td class="myLoginNestedText"><input id="birthCityTextBox"
									data-dojo-type="dijit.form.ValidationTextBox"
									data-dojo-props="name:'birthCity', regExp: '[A-z][A-z\\s\']*', required: true, invalidMessage: 'Invalid place of birth.', missingMessage: 'Place of birth is required.', propercase: true, trim: true, style:'width: 100%'"
									type="text">
								</td>
								<td id="birthCountryLabelTD" class="myLoginNestedLabel"
									style="visibility: hidden;"><label for="birthCountry">Country:</label>
								</td>
								<td id="birthCountryTextBoxTD" class="myLoginNestedText"
									style="visibility: hidden;"><input id="birthCountryTextBox"
									data-dojo-type="dijit.form.ValidationTextBox"
									data-dojo-props="name:'birthCountry', regExp: '[A-z][A-z\\s\']*', required: false, invalidMessage: 'Invalid place of birth.', missingMessage: 'Place of birth is required.', trim: true, style:'width: 100%'"
									type="text">
								</td>

							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="myLoginLabel" style="padding-bottom: 0px" colspan="2"><label
						for="placeType">Which best describes the place where you grew up?*</label>
					</td>
				</tr>
				<tr>
					<td><label></label>
					</td>
					<td class="myLoginText" style="padding-top: 0px"><select
						id="placeTypeSelect" data-dojo-type="dijit.form.Select"
						data-dojo-props="name:'placeType', required: true,  missingMessage: 'This field is required.', style:'width: 50%'">
							<option value="">(select)</option>
							<option value="Rural">Rural</option>
							<option value="Urban">Urban</option>
							<option value="Suburban">Suburban</option>
					</select>
					</td>
				</tr>
				<tr>
					<td class="myLoginLabel"><label for="education">Highest Education:*</label>
					</td>
					<td class="myLoginText"><select id="educationSelect"
						data-dojo-type="dijit.form.Select"
						data-dojo-props="name:'education', required: true,  missingMessage: 'Education is required.', style:'width: 50%'">
							<option value="">(select)</option>
							<option value="Less than High School">Less than High School</option>
							<option value="High School">High School</option>
							<option value="Bachelor">Bachelor</option>
							<option value="Master">Master</option>
							<option value="Doctorate">Doctorate</option>
					</select>
					</td>
				</tr>
				<tr>
					<td class="myLoginLabel"><label for="occupation">Occupation:*</label>
					</td>
					<td class="myLoginText"><select id="occupationSelect"
						data-dojo-type="dijit.form.Select"
						data-dojo-props="name:'occupation', required: true,  missingMessage: 'Occupation is required.', style:'width: 50%'">
							<option value="">(select)</option>
							<option value="Building/construction">Building/construction</option>
							<option value="Education">Education</option>
							<option value="Entertainment">Entertainment</option>
							<option value="Executive/managerial">Executive/managerial</option>
							<option value="Health Care">Health Care</option>
							<option value="Law enforcement">Law enforcement</option>
							<option value="Maintenance">Maintenance</option>
							<option value="Manufacturing">Manufacturing</option>
							<option value="Military">Military</option>
							<option value="Public service">Public service</option>
							<option value="Retail/sales">Retail/sales</option>
							<option value="Retired">Retired</option>
							<option value="Science/technical">Science/technical</option>
							<option value="Secretarial/clerical">Secretarial/clerical</option>
							<option value="Student">Student</option>
							<option value="Transportation">Transportation</option>
							<option value="Unemployed">Unemployed</option>
							<option value="Other">Other</option>

							</script>

					</select>
					</td>
				</tr>
				<tr>
					<td class="myLoginLabel"><label for="race">Race:*</label>
					</td>
					<td class="myLoginText"><select id="raceSelect"
						data-dojo-type="dijit.form.Select"
						data-dojo-props="name:'race', required: true,  missingMessage: 'Race is required.', style:'width: 50%'">
							<option value="">(select)</option>
							<option value="American Indian or Alaska Native">American Indian or Alaska Native</option>
							<option value="Asian">Asian</option>
							<option value="Black or African American">Black or African American</option>
							<option value="Hispanic or Latino">Hispanic or Latino</option>
							<option value="White">White</option>
							<option value="Native Hawaiian or Other Pacific Islander">Native Hawaiian or Other Pacific Islander</option>
					</select>
					</td>
				</tr>

				<tr>
					<td class="myLoginButton" colspan="2"><button
							data-dojo-type="dijit.form.Button"
							data-dojo-props='type:"submit", baseClass: "mycss"' type="submit">Submit</button>
					</td>
				</tr>
				<!-- tr>
					<td class="myLoginLabel"><label for="organization">Organization: </label>
					</td>
				</tr>
				<tr>
					<td class="myLoginText"><input id="organizationTextBox"
						data-dojo-type="dijit.form.TextBox"
						data-dojo-props='name: "organization", trim: true' type="text">
					</td>
				</tr-->
			</table>
			<!--p class="myLogin">Settings</p>
			<table class="myLogin">
				<tr>
					<td class="myLoginLabel"><label for="groups">How many tests would
							you like to take? </label>
					</td>
				</tr>
				<tr>
					<td class="myLoginText"><select id="groupSelect"
						data-dojo-type="dijit.form.Select" data-dojo-props="name:'groups'">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3" selected="selected">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
					</select>
					</td>
				</tr>
				
			</table-->
		</div>

	</div>

</body>
</html>
