<?php
include_once("check_login_status.php");
if(!$user_ok){
	header("location: index.php");
	exit();
}

$fieldsEmpty = false;
$thisUser = User::getFromId($log_id, $db);
if(!$thisUser->getId()){
	header("location: error.php?msg=Invalid user action.");
	exit();
}

$html = new Html();
$html->title = 'Unite Nepal';
// $html->faviconUrl = 'favicon.ico';
$html->css[] = '<link rel="stylesheet" type="text/css" href="styles/style.css">';
$html->js[] = '<script src="js/main.js"></script>';
// $html->meta[] = '<meta name="Description" content="">';
$html->meta[] = '<meta name="Keywords" content="nepal, earthquake, save, pray, information, donate, official">';
echo $html->injectHeader();
?>
<style>
body{
	background: #e1e1e1 !important;
}
</style>
<div class="bodywrapper" style="background-color:#e1e1e1">
	<?php include_once('includes/nav.php'); ?>
	<div class="editWrapper">
		<div class="editHeader">
			<img src="<?=$thisUser->getImg()?>">
		</div>
		<form style="padding: 40px 80px;" id="signupForm"><!-- action="signup.php" method="post"-->
			<div class="formLeft">
				<span class="inputWrapper">
					<span><i class="fa fa-user"></i></span>
					<input class="formIn" id="realname" name="realname" type="text" maxlength="88" placeholder="First name" value="<?=$thisUser->getRealName()?>">
				</span>
				<br>
				<span class="inputWrapper">
					<span><i class="fa fa-user"></i></span>
					<input class="formIn" id="realsurname" name="realsurname" type="text" maxlength="88" placeholder="Surname" value="<?=$thisUser->getRealSurname()?>">
				</span>
				<br>
				<span class="inputWrapper">
					<span><i class="fa fa-envelope"></i></span>
					<input class="formIn" id="email" name="email" type="text" maxlength="88" placeholder="Email" value="<?=$thisUser->getEmail()?>">
					<i id="usernameavailable" style="right: 16px; display: none;" class="fa fa-check-circle availableicon"></i>
					<i id="usernametaken" style="right: 16px; display: none;" class="fa fa-times-circle takenicon"></i>
				</span>
				<div style="clear:both"></div>
			</div>
			<div class="formRight">
				<!-- <span class="inputWrapper">
					<span><i class="fa fa-map-marker"></i></span>
					<input class="formIn" type="text" name="location" id="location" maxlength="100" placeholder="locaion" value="<?=$thisUser->getLocation()?>"> 
					<i id="emailavailable" style="right: 11px; display:none;" class="fa fa-check-circle availableicon"></i>
					<i id="emailtaken" style="right: 11px; display:none;" class="fa fa-times-circle takenicon"></i>
				</span> -->
				<div style="clear:both"></div>
				<span class="inputWrapper">
					<span><i class="fa fa-lock"></i></span>
					<input class="formIn" type="password" id="password" name="password" maxlength="100" placeholder="Password" value="default"> 
				</span>
				<br>
				<span class="inputWrapper">
					<span><i class="fa fa-lock"></i></span>
					<input class="formIn" type="password" id="repassword" name="repassword" maxlength="100" placeholder="Confirm Password" value="default"> 
				</span>
				<div style="clear:both"></div>
				<select class="countrySelect" style="width: 253px;">
					<option value="" disabled selected>Current location</option>
					<option <?=($thisUser->getLocation()=="Afghanistan"?'selected':'')?> value="Afghanistan">Afghanistan</value>
					<option <?=($thisUser->getLocation()=="Albania"?'selected':'')?> value="Albania">Albania</value>
					<option <?=($thisUser->getLocation()=="Algeria"?'selected':'')?> value="Algeria">Algeria</value>
					<option <?=($thisUser->getLocation()=="American Samoa"?'selected':'')?> value="American Samoa">American Samoa</value>
					<option <?=($thisUser->getLocation()=="Andorra"?'selected':'')?> value="Andorra">Andorra</value>
					<option <?=($thisUser->getLocation()=="Angola"?'selected':'')?> value="Angola">Angola</value>
					<option <?=($thisUser->getLocation()=="Anguilla"?'selected':'')?> value="Anguilla">Anguilla</value>
					<option <?=($thisUser->getLocation()=="Antarctica"?'selected':'')?> value="Antarctica">Antarctica</value>
					<option <?=($thisUser->getLocation()=="Antigua and Barbuda"?'selected':'')?> value="Antigua and Barbuda">Antigua and Barbuda</value>
					<option <?=($thisUser->getLocation()=="Argentina"?'selected':'')?> value="Argentina">Argentina</value>
					<option <?=($thisUser->getLocation()=="Armenia"?'selected':'')?> value="Armenia">Armenia</value>
					<option <?=($thisUser->getLocation()=="Aruba"?'selected':'')?> value="Aruba">Aruba</value>
					<option <?=($thisUser->getLocation()=="Australia"?'selected':'')?> value="Australia">Australia</value>
					<option <?=($thisUser->getLocation()=="Austria"?'selected':'')?> value="Austria">Austria</value>
					<option <?=($thisUser->getLocation()=="Azerbaijan"?'selected':'')?> value="Azerbaijan">Azerbaijan</value>
					<option <?=($thisUser->getLocation()=="Bahamas"?'selected':'')?> value="Bahamas">Bahamas</value>
					<option <?=($thisUser->getLocation()=="Bahrain"?'selected':'')?> value="Bahrain">Bahrain</value>
					<option <?=($thisUser->getLocation()=="Bangladesh"?'selected':'')?> value="Bangladesh">Bangladesh</value>
					<option <?=($thisUser->getLocation()=="Barbados"?'selected':'')?> value="Barbados">Barbados</value>
					<option <?=($thisUser->getLocation()=="Belarus"?'selected':'')?> value="Belarus">Belarus</value>
					<option <?=($thisUser->getLocation()=="Belgium"?'selected':'')?> value="Belgium">Belgium</value>
					<option <?=($thisUser->getLocation()=="Belize"?'selected':'')?> value="Belize">Belize</value>
					<option <?=($thisUser->getLocation()=="Benin"?'selected':'')?> value="Benin">Benin</value>
					<option <?=($thisUser->getLocation()=="Bermuda"?'selected':'')?> value="Bermuda">Bermuda</value>
					<option <?=($thisUser->getLocation()=="Bhutan"?'selected':'')?> value="Bhutan">Bhutan</value>
					<option <?=($thisUser->getLocation()=="Bolivia"?'selected':'')?> value="Bolivia">Bolivia</value>
					<option <?=($thisUser->getLocation()=="Bosnia and Herzegovina"?'selected':'')?> value="Bosnia and Herzegovina">Bosnia and Herzegovina</value>
					<option <?=($thisUser->getLocation()=="Botswana"?'selected':'')?> value="Botswana">Botswana</value>
					<option <?=($thisUser->getLocation()=="Bouvet Island"?'selected':'')?> value="Bouvet Island">Bouvet Island</value>
					<option <?=($thisUser->getLocation()=="Brazil"?'selected':'')?> value="Brazil">Brazil</value>
					<option <?=($thisUser->getLocation()=="British Indian Ocean Territory"?'selected':'')?> value="British Indian Ocean Territory">British Indian Ocean Territory</value>
					<option <?=($thisUser->getLocation()=="Brunei Darussalam"?'selected':'')?> value="Brunei Darussalam">Brunei Darussalam</value>
					<option <?=($thisUser->getLocation()=="Bulgaria"?'selected':'')?> value="Bulgaria">Bulgaria</value>
					<option <?=($thisUser->getLocation()=="Burkina Faso"?'selected':'')?> value="Burkina Faso">Burkina Faso</value>
					<option <?=($thisUser->getLocation()=="Burundi"?'selected':'')?> value="Burundi">Burundi</value>
					<option <?=($thisUser->getLocation()=="Cambodia"?'selected':'')?> value="Cambodia">Cambodia</value>
					<option <?=($thisUser->getLocation()=="Cameroon"?'selected':'')?> value="Cameroon">Cameroon</value>
					<option <?=($thisUser->getLocation()=="Canada"?'selected':'')?> value="Canada">Canada</value>
					<option <?=($thisUser->getLocation()=="Cape Verde"?'selected':'')?> value="Cape Verde">Cape Verde</value>
					<option <?=($thisUser->getLocation()=="Cayman Islands"?'selected':'')?> value="Cayman Islands">Cayman Islands</value>
					<option <?=($thisUser->getLocation()=="Central African Republic"?'selected':'')?> value="Central African Republic">Central African Republic</value>
					<option <?=($thisUser->getLocation()=="Chad"?'selected':'')?> value="Chad">Chad</value>
					<option <?=($thisUser->getLocation()=="Chile"?'selected':'')?> value="Chile">Chile</value>
					<option <?=($thisUser->getLocation()=="China"?'selected':'')?> value="China">China</value>
					<option <?=($thisUser->getLocation()=="Christmas Island"?'selected':'')?> value="Christmas Island">Christmas Island</value>
					<option <?=($thisUser->getLocation()=="Cocos Islands"?'selected':'')?> value="Cocos Islands">Cocos Islands</value>
					<option <?=($thisUser->getLocation()=="Colombia"?'selected':'')?> value="Colombia">Colombia</value>
					<option <?=($thisUser->getLocation()=="Comoros"?'selected':'')?> value="Comoros">Comoros</value>
					<option <?=($thisUser->getLocation()=="Congo"?'selected':'')?> value="Congo">Congo</value>
					<option <?=($thisUser->getLocation()=="Congo, Democratic Republic of the"?'selected':'')?> value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</value>
					<option <?=($thisUser->getLocation()=="Cook Islands"?'selected':'')?> value="Cook Islands">Cook Islands</value>
					<option <?=($thisUser->getLocation()=="Costa Rica"?'selected':'')?> value="Costa Rica">Costa Rica</value>
					<option <?=($thisUser->getLocation()=="Cote d'Ivoire"?'selected':'')?> value="Cote d'Ivoire">Cote d'Ivoire</value>
					<option <?=($thisUser->getLocation()=="Croatia"?'selected':'')?> value="Croatia">Croatia</value>
					<option <?=($thisUser->getLocation()=="Cuba"?'selected':'')?> value="Cuba">Cuba</value>
					<option <?=($thisUser->getLocation()=="Cyprus"?'selected':'')?> value="Cyprus">Cyprus</value>
					<option <?=($thisUser->getLocation()=="Czech Republic"?'selected':'')?> value="Czech Republic">Czech Republic</value>
					<option <?=($thisUser->getLocation()=="Denmark"?'selected':'')?> value="Denmark">Denmark</value>
					<option <?=($thisUser->getLocation()=="Djibouti"?'selected':'')?> value="Djibouti">Djibouti</value>
					<option <?=($thisUser->getLocation()=="Dominica"?'selected':'')?> value="Dominica">Dominica</value>
					<option <?=($thisUser->getLocation()=="Dominican Republic"?'selected':'')?> value="Dominican Republic">Dominican Republic</value>
					<option <?=($thisUser->getLocation()=="Ecuador"?'selected':'')?> value="Ecuador">Ecuador</value>
					<option <?=($thisUser->getLocation()=="Egypt"?'selected':'')?> value="Egypt">Egypt</value>
					<option <?=($thisUser->getLocation()=="El Salvador"?'selected':'')?> value="El Salvador">El Salvador</value>
					<option <?=($thisUser->getLocation()=="Equatorial Guinea"?'selected':'')?> value="Equatorial Guinea">Equatorial Guinea</value>
					<option <?=($thisUser->getLocation()=="Eritrea"?'selected':'')?> value="Eritrea">Eritrea</value>
					<option <?=($thisUser->getLocation()=="Estonia"?'selected':'')?> value="Estonia">Estonia</value>
					<option <?=($thisUser->getLocation()=="Ethiopia"?'selected':'')?> value="Ethiopia">Ethiopia</value>
					<option <?=($thisUser->getLocation()=="Falkland Islands"?'selected':'')?> value="Falkland Islands">Falkland Islands</value>
					<option <?=($thisUser->getLocation()=="Faroe Islands"?'selected':'')?> value="Faroe Islands">Faroe Islands</value>
					<option <?=($thisUser->getLocation()=="Fiji"?'selected':'')?> value="Fiji">Fiji</value>
					<option <?=($thisUser->getLocation()=="Finland"?'selected':'')?> value="Finland">Finland</value>
					<option <?=($thisUser->getLocation()=="France"?'selected':'')?> value="France">France</value>
					<option <?=($thisUser->getLocation()=="French Guiana"?'selected':'')?> value="French Guiana">French Guiana</value>
					<option <?=($thisUser->getLocation()=="French Polynesia"?'selected':'')?> value="French Polynesia">French Polynesia</value>
					<option <?=($thisUser->getLocation()=="Gabon"?'selected':'')?> value="Gabon">Gabon</value>
					<option <?=($thisUser->getLocation()=="Gambia"?'selected':'')?> value="Gambia">Gambia</value>
					<option <?=($thisUser->getLocation()=="Georgia"?'selected':'')?> value="Georgia">Georgia</value>
					<option <?=($thisUser->getLocation()=="Germany"?'selected':'')?> value="Germany">Germany</value>
					<option <?=($thisUser->getLocation()=="Ghana"?'selected':'')?> value="Ghana">Ghana</value>
					<option <?=($thisUser->getLocation()=="Gibraltar"?'selected':'')?> value="Gibraltar">Gibraltar</value>
					<option <?=($thisUser->getLocation()=="Greece"?'selected':'')?> value="Greece">Greece</value>
					<option <?=($thisUser->getLocation()=="Greenland"?'selected':'')?> value="Greenland">Greenland</value>
					<option <?=($thisUser->getLocation()=="Grenada"?'selected':'')?> value="Grenada">Grenada</value>
					<option <?=($thisUser->getLocation()=="Guadeloupe"?'selected':'')?> value="Guadeloupe">Guadeloupe</value>
					<option <?=($thisUser->getLocation()=="Guam"?'selected':'')?> value="Guam">Guam</value>
					<option <?=($thisUser->getLocation()=="Guatemala"?'selected':'')?> value="Guatemala">Guatemala</value>
					<option <?=($thisUser->getLocation()=="Guinea"?'selected':'')?> value="Guinea">Guinea</value>
					<option <?=($thisUser->getLocation()=="Guinea-Bissau"?'selected':'')?> value="Guinea-Bissau">Guinea-Bissau</value>
					<option <?=($thisUser->getLocation()=="Guyana"?'selected':'')?> value="Guyana">Guyana</value>
					<option <?=($thisUser->getLocation()=="Haiti"?'selected':'')?> value="Haiti">Haiti</value>
					<option <?=($thisUser->getLocation()=="Heard Island and McDonald Islands"?'selected':'')?> value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</value>
					<option <?=($thisUser->getLocation()=="Honduras"?'selected':'')?> value="Honduras">Honduras</value>
					<option <?=($thisUser->getLocation()=="Hong Kong"?'selected':'')?> value="Hong Kong">Hong Kong</value>
					<option <?=($thisUser->getLocation()=="Hungary"?'selected':'')?> value="Hungary">Hungary</value>
					<option <?=($thisUser->getLocation()=="Iceland"?'selected':'')?> value="Iceland">Iceland</value>
					<option <?=($thisUser->getLocation()=="India"?'selected':'')?> value="India">India</value>
					<option <?=($thisUser->getLocation()=="Indonesia"?'selected':'')?> value="Indonesia">Indonesia</value>
					<option <?=($thisUser->getLocation()=="Iran"?'selected':'')?> value="Iran">Iran</value>
					<option <?=($thisUser->getLocation()=="Iraq"?'selected':'')?> value="Iraq">Iraq</value>
					<option <?=($thisUser->getLocation()=="Ireland"?'selected':'')?> value="Ireland">Ireland</value>
					<option <?=($thisUser->getLocation()=="Israel"?'selected':'')?> value="Israel">Israel</value>
					<option <?=($thisUser->getLocation()=="Italy"?'selected':'')?> value="Italy">Italy</value>
					<option <?=($thisUser->getLocation()=="Jamaica"?'selected':'')?> value="Jamaica">Jamaica</value>
					<option <?=($thisUser->getLocation()=="Japan"?'selected':'')?> value="Japan">Japan</value>
					<option <?=($thisUser->getLocation()=="Jordan"?'selected':'')?> value="Jordan">Jordan</value>
					<option <?=($thisUser->getLocation()=="Kazakhstan"?'selected':'')?> value="Kazakhstan">Kazakhstan</value>
					<option <?=($thisUser->getLocation()=="Kenya"?'selected':'')?> value="Kenya">Kenya</value>
					<option <?=($thisUser->getLocation()=="Kiribati"?'selected':'')?> value="Kiribati">Kiribati</value>
					<option <?=($thisUser->getLocation()=="Kuwait"?'selected':'')?> value="Kuwait">Kuwait</value>
					<option <?=($thisUser->getLocation()=="Kyrgyzstan"?'selected':'')?> value="Kyrgyzstan">Kyrgyzstan</value>
					<option <?=($thisUser->getLocation()=="Laos"?'selected':'')?> value="Laos">Laos</value>
					<option <?=($thisUser->getLocation()=="Latvia"?'selected':'')?> value="Latvia">Latvia</value>
					<option <?=($thisUser->getLocation()=="Lebanon"?'selected':'')?> value="Lebanon">Lebanon</value>
					<option <?=($thisUser->getLocation()=="Lesotho"?'selected':'')?> value="Lesotho">Lesotho</value>
					<option <?=($thisUser->getLocation()=="Liberia"?'selected':'')?> value="Liberia">Liberia</value>
					<option <?=($thisUser->getLocation()=="Libya"?'selected':'')?> value="Libya">Libya</value>
					<option <?=($thisUser->getLocation()=="Liechtenstein"?'selected':'')?> value="Liechtenstein">Liechtenstein</value>
					<option <?=($thisUser->getLocation()=="Lithuania"?'selected':'')?> value="Lithuania">Lithuania</value>
					<option <?=($thisUser->getLocation()=="Luxembourg"?'selected':'')?> value="Luxembourg">Luxembourg</value>
					<option <?=($thisUser->getLocation()=="Macao"?'selected':'')?> value="Macao">Macao</value>
					<option <?=($thisUser->getLocation()=="Madagascar"?'selected':'')?> value="Madagascar">Madagascar</value>
					<option <?=($thisUser->getLocation()=="Malawi"?'selected':'')?> value="Malawi">Malawi</value>
					<option <?=($thisUser->getLocation()=="Malaysia"?'selected':'')?> value="Malaysia">Malaysia</value>
					<option <?=($thisUser->getLocation()=="Maldives"?'selected':'')?> value="Maldives">Maldives</value>
					<option <?=($thisUser->getLocation()=="Mali"?'selected':'')?> value="Mali">Mali</value>
					<option <?=($thisUser->getLocation()=="Malta"?'selected':'')?> value="Malta">Malta</value>
					<option <?=($thisUser->getLocation()=="Marshall Islands"?'selected':'')?> value="Marshall Islands">Marshall Islands</value>
					<option <?=($thisUser->getLocation()=="Martinique"?'selected':'')?> value="Martinique">Martinique</value>
					<option <?=($thisUser->getLocation()=="Mauritania"?'selected':'')?> value="Mauritania">Mauritania</value>
					<option <?=($thisUser->getLocation()=="Mauritius"?'selected':'')?> value="Mauritius">Mauritius</value>
					<option <?=($thisUser->getLocation()=="Mayotte"?'selected':'')?> value="Mayotte">Mayotte</value>
					<option <?=($thisUser->getLocation()=="Mexico"?'selected':'')?> value="Mexico">Mexico</value>
					<option <?=($thisUser->getLocation()=="Micronesia"?'selected':'')?> value="Micronesia">Micronesia</value>
					<option <?=($thisUser->getLocation()=="Moldova"?'selected':'')?> value="Moldova">Moldova</value>
					<option <?=($thisUser->getLocation()=="Monaco"?'selected':'')?> value="Monaco">Monaco</value>
					<option <?=($thisUser->getLocation()=="Mongolia"?'selected':'')?> value="Mongolia">Mongolia</value>
					<option <?=($thisUser->getLocation()=="Montenegro"?'selected':'')?> value="Montenegro">Montenegro</value>
					<option <?=($thisUser->getLocation()=="Montserrat"?'selected':'')?> value="Montserrat">Montserrat</value>
					<option <?=($thisUser->getLocation()=="Morocco"?'selected':'')?> value="Morocco">Morocco</value>
					<option <?=($thisUser->getLocation()=="Mozambique"?'selected':'')?> value="Mozambique">Mozambique</value>
					<option <?=($thisUser->getLocation()=="Myanmar"?'selected':'')?> value="Myanmar">Myanmar</value>
					<option <?=($thisUser->getLocation()=="Namibia"?'selected':'')?> value="Namibia">Namibia</value>
					<option <?=($thisUser->getLocation()=="Nauru"?'selected':'')?> value="Nauru">Nauru</value>
					<option <?=($thisUser->getLocation()=="Nepal"?'selected':'')?> value="Nepal">Nepal</value>
					<option <?=($thisUser->getLocation()=="Netherlands"?'selected':'')?> value="Netherlands">Netherlands</value>
					<option <?=($thisUser->getLocation()=="Netherlands Antilles"?'selected':'')?> value="Netherlands Antilles">Netherlands Antilles</value>
					<option <?=($thisUser->getLocation()=="New Caledonia"?'selected':'')?> value="New Caledonia">New Caledonia</value>
					<option <?=($thisUser->getLocation()=="New Zealand"?'selected':'')?> value="New Zealand">New Zealand</value>
					<option <?=($thisUser->getLocation()=="Nicaragua"?'selected':'')?> value="Nicaragua">Nicaragua</value>
					<option <?=($thisUser->getLocation()=="Niger"?'selected':'')?> value="Niger">Niger</value>
					<option <?=($thisUser->getLocation()=="Nigeria"?'selected':'')?> value="Nigeria">Nigeria</value>
					<option <?=($thisUser->getLocation()=="Norfolk Island"?'selected':'')?> value="Norfolk Island">Norfolk Island</value>
					<option <?=($thisUser->getLocation()=="North Korea"?'selected':'')?> value="North Korea">North Korea</value>
					<option <?=($thisUser->getLocation()=="Norway"?'selected':'')?> value="Norway">Norway</value>
					<option <?=($thisUser->getLocation()=="Oman"?'selected':'')?> value="Oman">Oman</value>
					<option <?=($thisUser->getLocation()=="Pakistan"?'selected':'')?> value="Pakistan">Pakistan</value>
					<option <?=($thisUser->getLocation()=="Palau"?'selected':'')?> value="Palau">Palau</value>
					<option <?=($thisUser->getLocation()=="Palestinian Territory"?'selected':'')?> value="Palestinian Territory">Palestinian Territory</value>
					<option <?=($thisUser->getLocation()=="Panama"?'selected':'')?> value="Panama">Panama</value>
					<option <?=($thisUser->getLocation()=="Papua New Guinea"?'selected':'')?> value="Papua New Guinea">Papua New Guinea</value>
					<option <?=($thisUser->getLocation()=="Paraguay"?'selected':'')?> value="Paraguay">Paraguay</value>
					<option <?=($thisUser->getLocation()=="Peru"?'selected':'')?> value="Peru">Peru</value>
					<option <?=($thisUser->getLocation()=="Philippines"?'selected':'')?> value="Philippines">Philippines</value>
					<option <?=($thisUser->getLocation()=="Pitcairn"?'selected':'')?> value="Pitcairn">Pitcairn</value>
					<option <?=($thisUser->getLocation()=="Poland"?'selected':'')?> value="Poland">Poland</value>
					<option <?=($thisUser->getLocation()=="Portugal"?'selected':'')?> value="Portugal">Portugal</value>
					<option <?=($thisUser->getLocation()=="Puerto Rico"?'selected':'')?> value="Puerto Rico">Puerto Rico</value>
					<option <?=($thisUser->getLocation()=="Qatar"?'selected':'')?> value="Qatar">Qatar</value>
					<option <?=($thisUser->getLocation()=="Romania"?'selected':'')?> value="Romania">Romania</value>
					<option <?=($thisUser->getLocation()=="Russian Federation"?'selected':'')?> value="Russian Federation">Russian Federation</value>
					<option <?=($thisUser->getLocation()=="Rwanda"?'selected':'')?> value="Rwanda">Rwanda</value>
					<option <?=($thisUser->getLocation()=="Saint Helena"?'selected':'')?> value="Saint Helena">Saint Helena</value>
					<option <?=($thisUser->getLocation()=="Saint Kitts and Nevis"?'selected':'')?> value="Saint Kitts and Nevis">Saint Kitts and Nevis</value>
					<option <?=($thisUser->getLocation()=="Saint Lucia"?'selected':'')?> value="Saint Lucia">Saint Lucia</value>
					<option <?=($thisUser->getLocation()=="Saint Pierre and Miquelon"?'selected':'')?> value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</value>
					<option <?=($thisUser->getLocation()=="Saint Vincent and the Grenadines"?'selected':'')?> value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</value>
					<option <?=($thisUser->getLocation()=="Samoa"?'selected':'')?> value="Samoa">Samoa</value>
					<option <?=($thisUser->getLocation()=="San Marino"?'selected':'')?> value="San Marino">San Marino</value>
					<option <?=($thisUser->getLocation()=="Sao Tome and Principe"?'selected':'')?> value="Sao Tome and Principe">Sao Tome and Principe</value>
					<option <?=($thisUser->getLocation()=="Saudi Arabia"?'selected':'')?> value="Saudi Arabia">Saudi Arabia</value>
					<option <?=($thisUser->getLocation()=="Senegal"?'selected':'')?> value="Senegal">Senegal</value>
					<option <?=($thisUser->getLocation()=="Serbia"?'selected':'')?> value="Serbia">Serbia</value>
					<option <?=($thisUser->getLocation()=="Seychelles"?'selected':'')?> value="Seychelles">Seychelles</value>
					<option <?=($thisUser->getLocation()=="Sierra Leone"?'selected':'')?> value="Sierra Leone">Sierra Leone</value>
					<option <?=($thisUser->getLocation()=="Singapore"?'selected':'')?> value="Singapore">Singapore</value>
					<option <?=($thisUser->getLocation()=="Slovakia"?'selected':'')?> value="Slovakia">Slovakia</value>
					<option <?=($thisUser->getLocation()=="Slovenia"?'selected':'')?> value="Slovenia">Slovenia</value>
					<option <?=($thisUser->getLocation()=="Solomon Islands"?'selected':'')?> value="Solomon Islands">Solomon Islands</value>
					<option <?=($thisUser->getLocation()=="Somalia"?'selected':'')?> value="Somalia">Somalia</value>
					<option <?=($thisUser->getLocation()=="South Africa"?'selected':'')?> value="South Africa">South Africa</value>
					<option <?=($thisUser->getLocation()=="South Georgia"?'selected':'')?> value="South Georgia">South Georgia</value>
					<option <?=($thisUser->getLocation()=="South Korea"?'selected':'')?> value="South Korea">South Korea</value>
					<option <?=($thisUser->getLocation()=="Spain"?'selected':'')?> value="Spain">Spain</value>
					<option <?=($thisUser->getLocation()=="Sri Lanka"?'selected':'')?> value="Sri Lanka">Sri Lanka</value>
					<option <?=($thisUser->getLocation()=="Sudan"?'selected':'')?> value="Sudan">Sudan</value>
					<option <?=($thisUser->getLocation()=="Suriname"?'selected':'')?> value="Suriname">Suriname</value>
					<option <?=($thisUser->getLocation()=="Svalbard and Jan Mayen"?'selected':'')?> value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</value>
					<option <?=($thisUser->getLocation()=="Swaziland"?'selected':'')?> value="Swaziland">Swaziland</value>
					<option <?=($thisUser->getLocation()=="Sweden"?'selected':'')?> value="Sweden">Sweden</value>
					<option <?=($thisUser->getLocation()=="Switzerland"?'selected':'')?> value="Switzerland">Switzerland</value>
					<option <?=($thisUser->getLocation()=="Syrian Arab Republic"?'selected':'')?> value="Syrian Arab Republic">Syrian Arab Republic</value>
					<option <?=($thisUser->getLocation()=="Taiwan"?'selected':'')?> value="Taiwan">Taiwan</value>
					<option <?=($thisUser->getLocation()=="Tajikistan"?'selected':'')?> value="Tajikistan">Tajikistan</value>
					<option <?=($thisUser->getLocation()=="Tanzania"?'selected':'')?> value="Tanzania">Tanzania</value>
					<option <?=($thisUser->getLocation()=="Thailand"?'selected':'')?> value="Thailand">Thailand</value>
					<option <?=($thisUser->getLocation()=="The Former Yugoslav Republic of Macedonia"?'selected':'')?> value="The Former Yugoslav Republic of Macedonia">The Former Yugoslav Republic of Macedonia</value>
					<option <?=($thisUser->getLocation()=="Timor-Leste"?'selected':'')?> value="Timor-Leste">Timor-Leste</value>
					<option <?=($thisUser->getLocation()=="Togo"?'selected':'')?> value="Togo">Togo</value>
					<option <?=($thisUser->getLocation()=="Tokelau"?'selected':'')?> value="Tokelau">Tokelau</value>
					<option <?=($thisUser->getLocation()=="Tonga"?'selected':'')?> value="Tonga">Tonga</value>
					<option <?=($thisUser->getLocation()=="Trinidad and Tobago"?'selected':'')?> value="Trinidad and Tobago">Trinidad and Tobago</value>
					<option <?=($thisUser->getLocation()=="Tunisia"?'selected':'')?> value="Tunisia">Tunisia</value>
					<option <?=($thisUser->getLocation()=="Turkey"?'selected':'')?> value="Turkey">Turkey</value>
					<option <?=($thisUser->getLocation()=="Turkmenistan"?'selected':'')?> value="Turkmenistan">Turkmenistan</value>
					<option <?=($thisUser->getLocation()=="Tuvalu"?'selected':'')?> value="Tuvalu">Tuvalu</value>
					<option <?=($thisUser->getLocation()=="Uganda"?'selected':'')?> value="Uganda">Uganda</value>
					<option <?=($thisUser->getLocation()=="Ukraine"?'selected':'')?> value="Ukraine">Ukraine</value>
					<option <?=($thisUser->getLocation()=="United Arab Emirates"?'selected':'')?> value="United Arab Emirates">United Arab Emirates</value>
					<option <?=($thisUser->getLocation()=="United Kingdom"?'selected':'')?> value="United Kingdom">United Kingdom</value>
					<option <?=($thisUser->getLocation()=="United States"?'selected':'')?> value="United States">United States</value>
					<option <?=($thisUser->getLocation()=="United States Minor Outlying Islands"?'selected':'')?> value="United States Minor Outlying Islands">United States Minor Outlying Islands</value>
					<option <?=($thisUser->getLocation()=="Uruguay"?'selected':'')?> value="Uruguay">Uruguay</value>
					<option <?=($thisUser->getLocation()=="Uzbekistan"?'selected':'')?> value="Uzbekistan">Uzbekistan</value>
					<option <?=($thisUser->getLocation()=="Vanuatu"?'selected':'')?> value="Vanuatu">Vanuatu</value>
					<option <?=($thisUser->getLocation()=="Vatican City"?'selected':'')?> value="Vatican City">Vatican City</value>
					<option <?=($thisUser->getLocation()=="Venezuela"?'selected':'')?> value="Venezuela">Venezuela</value>
					<option <?=($thisUser->getLocation()=="Vietnam"?'selected':'')?> value="Vietnam">Vietnam</value>
					<option <?=($thisUser->getLocation()=="Virgin Islands, British"?'selected':'')?> value="Virgin Islands, British">Virgin Islands, British</value>
					<option <?=($thisUser->getLocation()=="Virgin Islands, U.S."?'selected':'')?> value="Virgin Islands, U.S.">Virgin Islands, U.S.</value>
					<option <?=($thisUser->getLocation()=="Wallis and Futuna"?'selected':'')?> value="Wallis and Futuna">Wallis and Futuna</value>
					<option <?=($thisUser->getLocation()=="Western Sahara"?'selected':'')?> value="Western Sahara">Western Sahara</value>
					<option <?=($thisUser->getLocation()=="Yemen"?'selected':'')?> value="Yemen">Yemen</value>
					<option <?=($thisUser->getLocation()=="Zambia"?'selected':'')?> value="Zambia">Zambia</value>
					<option <?=($thisUser->getLocation()=="Zimbabwe"?'selected':'')?> value="Zimbabwe">Zimbabwe</value>
				</select>
			</div>
			<div style="clear:both"></div>
			<select class="selectExpertise" multiple="" tabindex="-1" aria-hidden="true" style="width:540px">
				<?php
					$expertise = Expertise::getExpertiseFromUserId($thisUser->getId(), $db);
					foreach($expertise as $exp){
						?>
						<option selected><?=$exp->getExpertise()?></option>
						<?php
					}
				?>
			</select>
			<span class="inputWrapper">
				<textarea placeholder="Brief bio ..." style="margin-top: 15px;"><?=$thisUser->getBio()?></textarea>
			</span>
			<p id="status"></p>
			
			<button style="width: 250px; margin-top:15px" class="btn" type="submit">Save</button>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(".selectExpertise").select2({
		tags: "true",
		placeholder: "type your expertise with enter"
	});
	$(".countrySelect").select2();
</script>
