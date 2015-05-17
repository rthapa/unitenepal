
<!-- <div class="upperNav">
	<div class="upperInnerNav">
		<ul>
			<li>Register</li>
			<li>Login</li>
		</ul>
	</div>
</div> -->
<nav>
	<div class="navInner">
		<a href="index.php">
			<div class="navLeftSide">
				<img src="images/logo3.png" width="180" style="margin-top: 13px;">
				<img src="images/flaggif3.gif" width="33" style="position:absolute; left:77px; top: 0px;">
			</div>
		</a>
		 <ul class="userUl">
				<!-- <li class="navDonate"><a href="index.php#options">Act Now</a></li> -->
				<?php
					if($user_ok){
						$user = User::getFromId($log_id, $db);
						echo '<li id="navLogin" class="navList userNav">
								<img src="'.$user->getImg().'">
								<div class="userDropdown">
									<span>
										<div style="float:left;">
											<a style="padding: 0;" href="user.php?id='.$user->getId().'"><i style="color:inherit !important" class="fa fa-user"></i> '.$user->getRealName().' '.$user->getRealSurname().'</a>
										</div>
										<div style="float:right;">
											<a style="padding: 0;" href="logout.php"><i style="color:inherit !important" class="fa fa-power-off"></i> Log out</a>
											</div>
										<div style="clear:both;"></div>
									</span>
									<span>
										<div><i class="fa fa-bell"></i> Notifications</div>
										<p>You have no new Notifications.</p>
									</span>
								</div>
							</li>';
					}else{
						echo '<li id="navLogin"><a href="login.php">Login/Register</a></li>';
					}
				?>
				<!-- <li id="navLogin"><a href="login.php">Login/Register</a></li> -->
				<li id="navExplore" class="navList"><a href="explore.php">Explore</a></li>
				<li id="navDonations" class="navList"><a href="donate.php">Donations</a></li>
				<li id="navCampaigns" class="navList"><a href="campaigns.php">Campaigns</a></li>
				<li id="navOrganisations" class="navList"><a href="#">Articles</a></li>
				<li id-"navVoluteers" class="navList"><a href="#">Volunteers</a></li>
				<li id="navHome" class="navList"><a href="index.php">Home</a></li>
		 </ul>
		 <div style="clear:both;"></div>
	</div>
</nav>
<script>
	// var dropDownTime = '';
	// $('.userDropdown').hover(function(){
	// 	clearTimeout(dropDownTime);
	// 	$('.userDropdown').show();
	// }, function(){
	// 	dropDownTime = setTimeout(function(){ $('.userDropdown').fadeOut(); }, 500);
	// });

	// $('body').on('mouseenter', '#navLogin', function () {
	// clearTimeout(dropDownTime);
	// 	$('.userDropdown').show();
	// }).on('mouseleave', '#navLogin', function () {
	// 	dropDownTime = setTimeout(function(){ $('.userDropdown').fadeOut(); }, 500);
	//});

	var dt = '';
	$('.userDropdown').hover(function(){
		clearTimeout(dt);
		$('.userDropdown').show();
	}, function(){
		dt = setTimeout(function(){ $('.userDropdown').fadeOut(); }, 500);
		
	});

	$('body').on('mouseenter', '#navLogin', function () {
		clearTimeout(dt);
		$('.userDropdown').show();
	}).on('mouseleave', '#navLogin', function () {
		dt = setTimeout(function(){ $('.userDropdown').fadeOut(); }, 500);
	});
</script>
