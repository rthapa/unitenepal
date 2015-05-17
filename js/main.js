var index = {
	'sections' : ['section1', 'section2', 'section3', 'section4'],
	'autoSlideSections' : true,
	init : function(){
		$('#navHome').attr('class', 'active');
		index.loadEventListener();
		index.loadBannerText();
	},

	loadEventListener : function(){
		$('#actNowBtn').on('click', function(){
			$('html, body').animate({
				scrollTop: $('.options').offset().top
			}, 1000);
		});

		$('#contact_form').on('submit', function(){
			if(
				$.trim($('#form_name').val()) == '' ||
				$.trim($('#form_email').val()) == '' ||
				$.trim($('#form_message').val()) == '' 
			){
				alert('Please fill in all the require inputs.');
			}else{
				index.sendMail($('#form_name').val(), $('#form_email').val(), $('#form_message').val());
			}
		});

		$('.sectionBtn').on('click', function(){
			index.clearAllBannerTexts();
			index.autoSlideSections = false;
			index.activateBannerSection($(this).data('id'), 0);
		});

	},

	loadBannerText : function(){
		// $.each(index.sections, function(k, v){
			// $('.'+v).css('display', 'block');
			index.activateBannerSection(index.sections[0], 0);
		// });
	},

	clearAllBannerTexts : function(){
		$.each(index.sections, function(i, v){
			console.log(v);
			index.hideSectionContents(v);
			$('.'+v).css('display', 'none');
			if (typeof t1 !== 'undefined') clearTimeout(t1);
			if (typeof t2 !== 'undefined') clearTimeout(t2);
			if (typeof t3 !== 'undefined') clearTimeout(t3);
			if (typeof t4 !== 'undefined') clearTimeout(t4);
		});
	},

	activateBannerSection : function(section, arrIndex){
		if (typeof t4 !== 'undefined') {
			clearTimeout(t4);
		}

		$('.'+section).css('display', 'block');
		$('.sliderDiv ul li').removeClass('activeSlider');
		$('#'+section+'Btn').attr('class', 'activeSlider');
		var t1 = setTimeout(function(){
			$('.'+section+' .hiddenHead').attr('class', 'activeTextHead');
		}, 300);

		var t2 = setTimeout(function(){
			$('.'+section+' .hiddenPara').attr('class', 'activeTextPara');
		}, 1000);

		var t3 = setTimeout(function(){
			$('.'+section+' .hiddenButton').attr('class', 'btn activeTextButton');
		}, 1700);

		var t4 = setTimeout(function(){
			clearTimeout(t1);
			clearTimeout(t2);
			clearTimeout(t3);
			if(index.autoSlideSections){
				$('.'+section).css('display', 'none');
				index.hideSectionContents(section);
				if(arrIndex+1 < index.sections.length){
					index.activateBannerSection(index.sections[arrIndex+1], arrIndex+1);
				}else{
					index.activateBannerSection(index.sections[0], 0);
				}
			}else{
				clearTimeout(t4);
			}
		}, 7700);
	},

	hideSectionContents : function(section){
		$('.'+section+' .activeTextHead').attr('class', 'hiddenHead');
		$('.'+section+' .activeTextPara').attr('class', 'hiddenPara');
		$('.'+section+' .activeTextButton').attr('class', 'btn hiddenButton');
	},

	sendMail : function(username, email, msg){
		$.ajax({
			url : 'ajax/sendMail.php',
			dataType : 'JSON',
			type : 'POST',
			data : {username : username, msg : msg, email : email },
			success : function(data){
				console.log(data);
				if(data.status == 'success'){
					alert('mail sent');
				}
			},
			error: function(){
				alert('error');
			}
		});
	}
}

var explore = {
	feed : '',
	init : function(){
		$('#navExplore').attr('class', 'active');
		explore.initInstaFeed();
		explore.loadEventListener();
	},

	loadEventListener : function(){
		$('body').on('click', '#next', function(){
			$('#next').html('<i style="color:#fff; font-size:18px" class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i>');
			console.log('comon');
			explore.feed.next();
		});
		$(window).scroll(function() {
			if($(window).scrollTop() + $(window).height() == $(document).height()) {
				if(explore.feed.hasNext()){
					$('#next').trigger('click');
				}
			}
		});
	},

	initInstaFeed : function(){
			explore.feed = new Instafeed({
			get: 'tagged',
			tagName: 'prayfornepal',
			limit: 40,
			sortBy: 'most-liked',
			resolution: 'standard_resolution',
			clientId: 'ccae05bec56146c2bef859e491609f6d',
			template: '<div class="imageWrapperGrid">'+
							'<a href="{{link}}" target="_blank">'+
								'<div class="gridLeft"  style="background: url(\'{{image}}\');  background-size: cover;">'+
								'</div>'+
							'</a>'+
							'<div class="gridRight">'+
								'<div class="gridRightHead">'+
									'<img width="50px" height="50px" src="{{model.user.profile_picture}}">'+
									'<div style="float:left; padding:6px;">'+
										'<h4>{{model.user.username}}</h4>'+
										'<span><i class="fa fa-heart"></i> {{likes}}</span>'+
										'<span><i class="fa fa-weixin"></i> {{comments}}</span>'+
									'</div>'+
									'<div style="clear:both;"></div>'+
								'</div>'+
								'<p class="caption">{{caption}}</p>'+
							'</div>'+
							'<span style="clear:both;"></span>'+
							// '<div class="like">'+
							// 	'<a href="{{link}}"  target="_blank">'+
							// 		'<i class="fa fa-heart"></i> {{likes}}'+
							// 	'</a>'+
							// '</div>'+
							// '<div class="comment">'+
							// 	'<a href="{{link}}"  target="_blank">'+
							// 		'<i class="fa fa-weixin"></i> {{comments}}'+
							// 	'</a>'+
							// '</div>'+
						'</div>',
			success: function(){
				$('.fa-spinner').remove();
			},
			after: function() {
				console.log('test');
				if(!$('.imageFloatClear')[0]){
					$('#instafeed').append('<div class="imageFloatClear" style="clear:both;"></div>');
				}else{
					$('.imageFloatClear').remove();
					$('#instafeed').append('<div class="imageFloatClear" style="clear:both;"></div>');
				}
			// disable button if no more results to load
				if (this.hasNext()) {
					$('.moreBtnDiv').html('<button id="next" class="btn">more</button>');
				}else{
					if($('#next')[0]){
						$('#next').remove();
					}
				}
			},
		});
		explore.feed.run();
	}
}

var donatemoney = {
	init : function(){
		$('#navDonateMoney').attr('class', 'active');
		donatemoney.loadEventListener;
	},

	loadEventListener : function(){

	}
}

var campaigns = {
	init : function(){
		$('#navCampaigns').attr('class', 'active');
		campaigns.loadEventListener;
	},

	loadEventListener : function(){

	}
}

var register = {
	init : function(){
		register.loadEventListener();
	},

	loadEventListener : function(){
		$('#signupForm').submit(function(){
			if($.trim($('#email').val()) == '' ||
			$.trim($('#realname').val()) == '' ||
			$.trim($('#realsurname').val()) == '' ||
			$.trim($('#password').val()) == '' ||
			$.trim($('#repassword').val()) == ''){
				//alert('fill form');
				$('#status').html('<i class="fa fa-exclamation"></i> Please fill all the forms').css('display','block');
				return false;
			}

			if(!register.validateEmail($.trim($('#email').val()))){
				$('#status').html('<i class="fa fa-exclamation"></i> Invalid email format').css('display','block');
				return false;
			}

			if($.trim($('#password').val()) != $.trim($('#repassword').val())){
				$('#status').html('<i class="fa fa-exclamation"></i> Password does not match').css('display','block');
				return false;
			}

			$(this).attr('action', "ajax/register.ajax.php");
			$(this).attr('method', "POST");
		});

	},

	validateEmail : function(email){
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}
}

var login = {
	init : function(){
		login.loadEventListener();
	},

	loadEventListener : function(){
		$('#loginform').on('submit',function(){
			if($.trim($('#email').val()) == '' || $.trim($('#password').val()) == '' ){
				$('#status')
				.html("<i class='fa fa-exclamation'></i> Please fill all the forms")
				.css('display', 'block');
				return false;
			}else{
				var email = $('#email').val();
				var password = $('#password').val();
				$.ajax({
					url: "ajax/login.ajax.php",
					data: {email: email, password: password},
					type: "POST",
					dataType: "json",
					success: function(data){
						// console.log(data);
						if(data.status == 'success'){
							window.location.href = 'user.php?id='+data.userid;
						}else if(data.status == 'failed'){
							//failed login
							$('#status').css('display', 'block').html('The email/username or password is incorrect.');
						}
					},
					error: function(){
						//bad request
					}
				});
			}
			return false;
		});
	}
}

var user = {
	init : function(userid){
		user.loadEventListener();
		user.loadArticles(userid);
		user.loadCampaigns(userid);
	},

	loadEventListener : function(){
		$('.dash_nav li').on('click', function(){
			$('.dash_nav li').removeClass('dash_nav_active');
			$(this).addClass('dash_nav_active');

			$('.user_tab').removeClass('tab_show').addClass('tab_hide');
			$('.'+$(this).data('id')).removeClass('tab_hide').addClass('tab_show');
		});

		var time = '';
		$('.tooltip').hover(function(){
			clearTimeout(time);
			$('.tooltip').show();
		}, function(){
			time = setTimeout(function(){ $('.tooltip').fadeOut(); }, 500);
			
		});

		$('body').on('mouseenter', '.emptyFieldNotice', function () {
		clearTimeout(time);
			var xy = $('.emptyFieldNotice').offset();
			$('.tooltip').css({'left': xy.left+50,'top': xy.top}).show();
		}).on('mouseleave', '.emptyFieldNotice', function () {
			time = setTimeout(function(){ $('.tooltip').fadeOut(); }, 500);
		});
	},

	loadArticles : function(userid){
		$.ajax({
			url : 'ajax/userdata.ajax.php',
			dataType : 'JSON',
			type : 'GET',
			data : {type : 'getArticles', userid : userid},
			success : function(data){
				if(data.hasOwnProperty('status') && data.status == 'no articles'){
					$('.user_articles .dynamicContent').html('<p class="tab_status">No articles</p>');
				}else{
					var html = '';
					
					$.each(data, function(k, v){
						html += '<div class="articleWrapper">'
									+'<img class="userImg" src="'+v.userimg+'" >'
									+'<img class="articleCoverImg" src="'+v.coverimg+'">'
									+'<div class="articleContent">'
										+'<h4 class="articleTitle">'+v.title+'</h4>'
										+'<h4 class="articleDate">'+v.date+'</h4>'
										+'<p>'+v.body+'</p>'
										+'<a href="article.php?id='+v.id+'"><button class="btn articleBtn">Read</button></a>'
									+'</div>'
								+'</div>';
					});
					html += '<div style="clear:both;"></div>';
					$('.user_articles .dynamicContent').html(html);
				}
			},
			error: function(){
				alert('error');
			}
		});
	},

	loadCampaigns : function(userid){
		$.ajax({
			url : 'ajax/userdata.ajax.php',
			dataType : 'JSON',
			type : 'GET',
			data : {type : 'getCampaigns', userid : userid},
			success : function(data){
				console.log(data);
				if(data.hasOwnProperty('status') && data.status == 'no campaigns'){
					$('.user_campaigns .dynamicContent').html('<p class="tab_status">No campaigns</p>');
				}else{
					var html = '';
					
					$.each(data, function(k, v){
						html += '<div class="imageWrapperGrid">'
									+'<div class="gridLeft" style="background: url("'+v.img+'");  background-size: cover;">'
									+'</div>'
									+'<div class="gridRight campaignRight">'
										+'<h3>'+v.title+'</h3>'
										+'<h4><i class="fa fa-calendar"></i>'+v.happeningdate+'</h4>'
										+'<h4><i class="fa fa-map-marker"></i>'+v.location+'</h4>'
										+'<p>'+v.description+'</p>'
										+'<button class="btn"><a href="campaign.php?id='+v.id+'">view</a></button>'
									+'</div>'
									+'<div style="clear:both;"></div>'
								+'</div>';
					});
					html += '<div style="clear:both;"></div>';
					$('.user_campaigns .dynamicContent').html(html);
				}
			},
			error: function(){
				alert('error');
			}
		});
	}
}
