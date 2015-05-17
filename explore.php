<?php
include_once("check_login_status.php");

$html = new Html();
$html->title = 'Explore Nepal';
// $html->faviconUrl = 'favicon.ico';
$html->css[] = '<link rel="stylesheet" type="text/css" href="styles/style.css">';
$html->js[] = '<script src="js/main.js"></script>';
$html->js[] = '<script type="text/javascript" src="js/instafeed.js"></script>';
// $html->meta[] = '<meta name="Description" content="">';
$html->meta[] = '<meta name="Keywords" content="nepal, earthquake, save, pray, information, donate, official">';
echo $html->injectHeader();
?>
<div class="bodyWrapper" style="background-color:#fff">
	<?php include_once('includes/nav.php'); ?>
	<div class="explore_title">
		<div class="explore_title_inner">
			<h4>Explore</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam iusto, temporibus a nihil labore incidunt illum aspernatur cupiditate quasi asperiores, quis voluptatibus placeat quod optio? Aut accusantium harum autem, fugiat?</p>
		</div>
	</div>
	<div class="feedWrapper">
		<div class="innerFeedWrapper">
			<div id="instafeed"><i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i><br></div>
			<div class="moreBtnDiv">
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	explore.init();
	// var feed = new Instafeed({
	// 	get: 'tagged',
	// 	tagName: 'prayfornepal',
	// 	limit: 40,
	// 	sortBy: 'most-liked',
	// 	resolution: 'standard_resolution',
	// 	clientId: 'ccae05bec56146c2bef859e491609f6d',
	// 	template: '<div class="imageWrapperGrid">'+
	// 					'<a href="{{link}}" target="_blank">'+
	// 						'<div class="gridLeft"  style="background: url(\'{{image}}\');  background-size: cover;">'+
	// 						'</div>'+
	// 					'</a>'+
	// 					'<div class="gridRight">'+
	// 						'<p class="caption">{{caption}}</p>'+
	// 					'</div>'+
	// 					'<span style="clear:both;"></span>'+
	// 					'<div class="like">'+
	// 						'<a href="{{link}}"  target="_blank">'+
	// 							'<i class="fa fa-heart"></i> {{likes}}'+
	// 						'</a>'+
	// 					'</div>'+
	// 					'<div class="comment">'+
	// 						'<a href="{{link}}"  target="_blank">'+
	// 							'<i class="fa fa-weixin"></i> {{comments}}'+
	// 						'</a>'+
	// 					'</div>'+
	// 				'</div>',
	// 	success: function(){
	// 		$('.fa-spinner').remove();
	// 	},
	// 	after: function() {
	// 		console.log('test');
	// 		if(!$('.imageFloatClear')[0]){
	// 			$('#instafeed').append('<div class="imageFloatClear" style="clear:both;"></div>');
	// 		}else{
	// 			$('.imageFloatClear').remove();
	// 			$('#instafeed').append('<div class="imageFloatClear" style="clear:both;"></div>');
	// 		}
	// 	// disable button if no more results to load
	// 		if (this.hasNext()) {
	// 			$('.moreBtnDiv').html('<button id="next" class="btn">more</button>');
	// 		}else{
	// 			if($('#next')[0]){
	// 				$('#next').remove();
	// 			}
	// 		}
	// 	},
	// });
	// feed.run();
	// $('body').on('click', '#next', function(){
	// 	$('#next').html('<i style="color:#fff; font-size:18px" class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i>');
	// 	console.log('comon');
	// 	feed.next();
	// });
	// $(window).scroll(function() {
	// 	if($(window).scrollTop() + $(window).height() == $(document).height()) {
	// 		$('#next').trigger('click');
	// 	}
	// });
</script>
<!-- <script type="text/javascript">
	var feed = new Instafeed({
		get: 'tagged',
		tagName: 'nepalearthquake',
		limit: 1,
		sortBy: 'most-liked',
		resolution: 'standard_resolution',
		clientId: 'ccae05bec56146c2bef859e491609f6d',
		template: '<div class="item">'+
					'<a href="{{link}}" target="_blank">'+
						'<img src="{{image}}" />'+
					'</a>'+
					'<div class="like">'+
						'<i class="fa fa-heart"></i> {{likes}}'+
					'</div>'+
					'<div class="comment">'+
						'<i class="fa fa-weixin"></i> {{comments}}'+
					'</div>'+
					'<div class="caption">{{caption}}</div>'+
				'</div>',
		after: function() {
			console.log('test');
			$('#instafeed').append('<div style="clear:both;"></div>');
		// disable button if no more results to load
			if (!this.hasNext()) {
				$('#next').css('display','none');
			}
		},
	});
	feed.run();
	$('#next').on('click', function(){
		console.log('comon');
		feed.next();
	});
</script> -->
