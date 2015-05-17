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
			<h4>Donation</h4>
			<p>Following the recent earthquake in Nepal if you are looking to donate here are some recommended international, national, regional and individual donation pages. It is completely under the donators discretion who they donate to. So here you can find links to the donation pages and their approach to the relief work.</p>
		</div>
	</div>
	<div class="donation_body_main">
		<div class="donation_body_main_inner">
			<div class="individual">
				<img src="images/oxfam.png" width="140px">
				<p>Oxfam is in Nepal. We urgently need your help to provide clean water, sanitation and emergency food support. Please give what you can today.</p>
				<br>
				<a href="https://donate.oxfam.org.uk/emergency/nepal?intcmp=hp_hero_nepal_2015-04-25"><button class="btn2">Donate</button></a>
			</div>
			<div class="orCircle">OR</div>
		</div>
	</div>
	<div class="donation_body_secondary">
		<div class="donation_body_secondary_inner">
			<h4>Individual fund raiser</h4>
			<?php
				$funds = $db->query('SELECT * FROM gofundme');
				$count = 1;
				foreach($funds as $fund){
					?>
					<div class="fundDiv">
						<div class="fundHeading">
							<img src="<?=$fund['image']?>">
							<div class="fundInfo">
								<h4><?=$fund['person']?></h4>
								<h5>Goal <?=$fund['goalraw']?></h5>
								<h5>Raised <?=$fund['raisedraw']?></h5>
								<a href="<?=$fund['url']?>"><button class="btn2">Donate</button></a>
								<canvas id="fund<?=$count?>Chart" class="fundChart" style="width: 140px; height: 140px;"></canvas>
								<script>
									var remaining = <?=$fund['goal']?> - <?=$fund['raised']?>;
									if(remaining < 1){
										remaining = 0;
									}
									var fund<?=$count?> = [{
											value: <?=$fund['raised']?>,
											color: "#434753"
										}, {
											value: remaining,
											color: "#F25F43"
										}
									]

									var options = {
										animation: true,
										percentageInnerCutout: 85,
										showTooltips: false
									};

									var c1 = $('#fund<?=$count?>Chart');
									var ct1 = c1.get(0).getContext('2d');

									// var ctx = document.getElementById("skill1Chart").getContext("2d");
									// var ctx = document.getElementById("skill2Chart").getContext("2d");
									/*************************************************************************/
									myNewChart = new Chart(ct1).Doughnut(fund<?=$count?>, options);
								</script>
							</div>
							<div style="clear:both;"></div>
						</div>
						<div class="fundMessage">
							<p><?=$fund['message']?></p>
						</div>
					</div>
					<?php
					$count++;
				}
			?>
			<div style="clear:both;"></div>
		</div>
	</div>
</div>
<script>
	$(function() {
		donatemoney.init();
	});
</script>
