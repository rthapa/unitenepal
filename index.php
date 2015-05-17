<?php
include_once("check_login_status.php");

$html = new Html();
$html->title = 'Unite Nepal';
// $html->faviconUrl = 'favicon.ico';
$html->css[] = '<link rel="stylesheet" type="text/css" href="styles/style.css">';
$html->js[] = '<script src="js/main.js"></script>';
// $html->meta[] = '<meta name="Description" content="">';
$html->meta[] = '<meta name="Keywords" content="nepal, earthquake, save, pray, information, donate, official">';
echo $html->injectHeader();
?>

<div class="bodywrapper">
	<?php include_once('includes/nav.php'); ?>
	<div class="videoBanner">
		<video autoplay="autoplay" poster="images/poster.jpg" muted loop>
			<source src="http://beta.unitenepal.org/images/eq.mp4" type="video/mp4">
			<p>Your browser does not support the</p>
		</video>
	</div>
	<div class="banner">
		<div class="innerBanner">
			<div class="bannerText">
				<div class="section1" style="display:none;">
					<h2 class="hiddenHead">Essential medical and food supplies required for victims</h2>
					<p class="hiddenPara">Links to recommended reliable Global, National, grass-root and individual donation pages.</p>
					<button class="btn hiddenButton" id="actNowBtn">ACT NOW</button>
				</div>
				<div class="section2" style="display:none;">
					<h2 class="hiddenHead">Donations required to fund international and regional relief work</h2>
					<p class="hiddenPara">Information on how to send relief materials. Links to cargo and collection points.</p>
					<a href="donate.php"><button class="btn hiddenButton">Donate NOW</button></a>
				</div>
				<div class="section3" style="display:none;">
					<h2 class="hiddenHead">Volunteers needed to assist with relief work in rural areas</h2>
					<p class="hiddenPara">Any level of expertise welcome to volunteer. Collaborating and networking to tackle issues.</p>
					<a href="register.php"><button class="btn hiddenButton" id="actNowBtn">Register</button></a>
				</div>
				<div class="section4" style="display:none;">
					<h2 class="hiddenHead">Events happening right now</h2>
					<p class="hiddenPara">Register to get real time updates on events and campaigns related to current issues.</p>
					<button class="btn hiddenButton" id="actNowBtn">Launch</button>
				</div>
				<div class="sliderDiv">
					<ul>
						<li id="section1Btn" class="sectionBtn" data-id="section1"></li>
						<li id="section2Btn" class="sectionBtn" data-id="section2"></li>
						<li id="section3Btn" class="sectionBtn" data-id="section3"></li>
						<li id="section4Btn" class="sectionBtn" data-id="section4"></li>
						<div style="clear:both;"></div>
					</ul>
				</div>
			</div>
			<div class="bannerNews">
				<!-- <h2>Register</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis magnam, eveniet atque voluptates odit sunt tempora non itaque, alias architecto quia, excepturi commodi animi! Assum.</p>
			 -->
			 </div>
			<div style="clear:both"></div>
		</div>
	</div>

	<div class="options" id="options">
		<div class="sectionTitle">
			<h4>How can you help?</h4>
		</div>
		<div class="box ">
			<div class="box_icon"><i class="fa fa-credit-card"></i></div>
			<h3 class="box_title">Donate</h3>
			<div class="box_content">Links to recommended reliable Global, National, grass-root and individual donation pages.</div>
			<a href="donate.php"><button class="btn2">Donate</button></a>
		</div>
		<div class="box ">
			<div class="box_icon"><i class="fa fa-cubes"></i></div>
			<h3 class="box_title">Supplies</h3>
			<div class="box_content">Information on how to send relief materials. Links to cargo and collection points.</div>
			<button class="btn2 clothes">Supply</button>
		</div>
		<div class="box ">
			<div class="box_icon"><i class="fa fa-users"></i></div>
			<h3 class="box_title">Volunteer</h3>
			<div class="box_content">Any level of expertise welcome to volunteer. Collaborating and networking to tackle issues.</div>
			<button class="btn2 group">Volunteer</button>
		</div>
		<div class="box ">
			<div class="box_icon"><i class="fa fa-flag"></i></div>
			<h3 class="box_title">Campaign</h3>
			<div class="box_content">Register to get real time updates on events and campaigns related to current issues.</div>
			<a href="campaigns.php"><button class="btn2 campaign">Campaign</button></a>
		</div>
		<div style="clear:both;"></div>
	</div>
	
	<div class="priorities">
		<div class="innnerPriorities">
			<div class="sectionTitle">
				<h4>Our Priorities</h4>
			</div>
			<div class="box priority_box">
				<div style="width: 246px;height:200px; overflow:hidden;">
					<img src="images/childwelfare.jpg">
				</div>
				<h4 class="priority_title">Childcare Welfare</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis error veritatis illum deleniti natus iusto veniam, consequuntur, atque pariatur.</p>
			</div>
			<div class="box priority_box">
				<div style="width: 246px;height:200px; overflow:hidden;">
					<img src="images/rehabilitation.jpg">
				</div>
				<h4 class="priority_title">Rehabilitation </h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis error veritatis illum deleniti natus iusto veniam, consequuntur, atque pariatur.</p>
			</div>
			<div class="box priority_box">
				<div style="width: 246px;height:200px; overflow:hidden;">
					<img src="images/supplies.jpg">
				</div>
				<h4 class="priority_title">Supplies Deployment</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis error veritatis illum deleniti natus iusto veniam, consequuntur, atque pariatur.</p>
			</div>
			<div class="box priority_box">
				<div style="width: 246px;height:200px; overflow:hidden;">
					<img src="images/blooddonation.jpg">
				</div>
				<h4 class="priority_title">Blood Donations</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis error veritatis illum deleniti natus iusto veniam, consequuntur, atque pariatur.</p>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	<div class="footer">
		<div class="innerFooter">
			<div class="footerbox about">
				<h4>ABOUT US</h4>
				<p>We are members of the Nepalese community residing in the UK sharing a similar vision. Our vision is to ‘Unite’ all the Nepalese people around the globe to help develop Nepal. This is an open source platform welcoming anyone with expertise in relevant infrastructural fields. Our objectives include tackling issues in Nepal with a sustainable approach through collaboration among the global Nepalese community.</p>
			</div>
			<div class="footerbox contact">
				<form onsubmit="return false;" id="contact_form">
					<h4>LEAVE US A MESSAGE </h4>
					<div class="contactDiv">
						<input placeholder="Name" id="form_name">
						<input placeholder="Email" id="form_email">
						<textarea placeholder="Message" id="form_message"></textarea>
						<button class="btn2 btn3 mail" id="form_submit">Submit</button>
					</div>
				</form>
			</div>
			<div class="footerbox contactInfoDiv">
				<h4>CONTACT US</h4>
				<span><i class="fa fa-user"></i> Resham Gurung</span>
				<span><i class="fa fa-phone"></i> 07455 404002</span>
				<br>
				<span><i class="fa fa-user"></i> Jonas Subba</span>
				<span><i class="fa fa-phone"></i> 07850 179231</span>
			</div>
		</div>
	</div>
</div>

<script>
	$(function() {
		index.init();
	});
</script>
