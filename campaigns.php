<?php
include_once("check_login_status.php");

$db = new PDOConnect();

$html = new Html();
$html->title = 'Unite Nepal';
// $html->faviconUrl = 'favicon.ico';
$html->css[] = '<link rel="stylesheet" type="text/css" href="styles/style.css">';
$html->js[] = '<script src="js/main.js"></script>';
$html->js[] = '<script src="js/chart.js"></script>';
// $html->meta[] = '<meta name="Description" content="">';
$html->meta[] = '<meta name="Keywords" content="nepal, earthquake, save, pray, information, donate, official">';
echo $html->injectHeader();
?>

<div class="bodywrapper">
	<?php include_once('includes/nav.php'); ?>
	<div class="donation_title">
		<div class="donation_title_inner">
			<h4>Campaigns</h4>
			<p>Here you can find links to various events happening around your area aimed at tackling issues in Nepal. Information on how to get in touch and join some of the events and campaigns.</p>
		</div>
	</div>
	<div class="donation_body_main">
		<div class="donation_body_main_inner">
			<div class="imageWrapperGrid">
				<div class="gridLeft" style="background: url('images/candlevigil.jpg');  background-size: cover;">
				</div>
				<div class="gridRight campaignRight">
					<h3>Volunteers for Candle Light Vigil -Nepal Earthquake</h3>
					<h4><i class="fa fa-calendar"></i> Oct. 12th 2017</h4>
					<h4><i class="fa fa-map-marker"></i> Trafalgar square London</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, nemo. Totam atque perspiciatis impedit, numquam sed nostrum non, consectetur similique veniam nihil.</p>
					<button class="btn">view</button>
				</div>
				<div style="clear:both;"></div>
			</div>
			<div class="imageWrapperGrid">
				<div class="gridLeft" style="background: url('images/runfornepal.jpg');  background-size: cover;">
				</div>
				<div class="gridRight campaignRight">
					<h3>Volunteers for Candle Light Vigil -Nepal Earthquake</h3>
					<h4><i class="fa fa-calendar"></i> To be discussed</h4>
					<h4><i class="fa fa-map-marker"></i> To be discussed</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, nemo. Totam atque perspiciatis impedit, numquam sed nostrum non, consectetur similique veniam nihil.</p>
					<button class="btn">view</button>
				</div>
				<div style="clear:both;"></div>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
</div>
<script>
	$(function() {
		campaigns.init();
	});
</script>
