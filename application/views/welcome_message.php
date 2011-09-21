<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->
		<title>Mate1.com - NFL 2001 Pool</title>
		<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
		<meta content="IE=EmulateIE7" http-equiv="X-UA-Compatible" />
		<!--FIREBUG Lite IF this is kept, colorbox ajax file will not be displayed
		<script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js" type="text/javascript"></script>
		<script src="http://www.mate1.com/nw/js/ref/highway/highway.js" type="text/javascript"></script>
		<script src="http://www.mate1.com/nw/js/jquery.form.js" type="text/javascript"></script>
		<script src="http://www.mate1.com/nw/js/jquery.charcounter.js" type="text/javascript"></script>
		<script src="http://www.mate1.com/nw/js/jquery.jqbrowser-0.2.js" type="text/javascript"></script>
		<script type="text/javascript">
			var SID = "";
			$.ajaxSetup({
				cache : false
			});
			var highway = new Highway();

		</script>
		<script src="http://www.mate1.com/nw/js/swfobject.js" type="text/javascript"></script>
		<link href='http://fonts.googleapis.com/css?family=Marvel:400,700' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="js/jquery.pagination.js"></script>
		<!-- homepage re-design from here-->
		<link href="css/minor.css" type="text/css" rel="stylesheet"/>
		<link href="css/major.css" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="http://media3.mate1.com/nw/css/ref/pluggins/jquery.uniform.css?1233777101" />
		<link type="text/css" rel="stylesheet" href="css/style.css" />
		<script type="text/javascript" src="http://www.mate1.com/nw/js/ref/pluggins/jquery.uniform.js?1233777101"></script>
		<script type="text/javascript" src="http://www.mate1.com/nw/js/ref/leftQuickSearch.js?1233777101"></script>
		<script type="text/javascript" src="js/jquery.xdomainajax.js"></script>
		<script type="text/javascript" src="js/admin.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>
		<!-- stylying the select elements -->
		<script type="text/javascript">
		$(document).ready(function(){
			admin.editMode = '<?= $admin -> admin_state;?>';
			admin.week = '<?= $admin -> admin_week;?>';
			if(admin.editMode == "EDITION") {
				pool.showLeaderboard();
			} else {
				pool.showWeekPool();
			}
		}); // close document.ready

		$(function() {
			$("select.uniform, input.uniform, :checkbox.uniform").uniform();
		});

		</script>
	</head>
	<body>
		<div id="page-wrapper">
			<div id="header">
				<div class="header_left" id="headerLeft">
					<a id="edatelogo" href="http://www.mate1.com"> <img alt="Mate1.com - Find Someone Today" src="http://media3.mate1.com/nw/images/templates/intimateDating/layout/logo/logo_212x36.png?1233776914"> </a>
					<p id="welcomeBack">
						Hi, <a title="Username" href="http://www.mate1.com/nw/profile/view">TheUsername45623</a> | <a title="Log Out" href="http://www.mate1.com/nw/logout">Log Out</a> | <a title="Help" href="http://www.mate1.com/nw/faq">Help</a>
					</p>
				</div>
				<div ref="flash" class="ads728x90">
					<div id="google_ads_div_Header728x90"><img src="img/asdHeader.jpg" />
					</div>
				</div>
			</div><!--#header-->
			<div id="mainNav">
				<div class="cornerL">
					&nbsp;
				</div>
				<div class="subscribe">
					<a href="http://www.mate1.com/nw/join" class="btnSubscribe">Subscribe Now</a>
				</div>
				<div id="mainMenuContainer">
					<ul class="mainMenuLeft">
						<li class="mainMenuLeftBorder"></li>
						<li class="tabMailbox">
							<a id="mainMenuMailbox" href="inbox.php"> Week <span class="counter boxRound2" id="weekCounter"><?= $admin -> admin_week;?></span></a>
						</li>
					</ul>
					<ul class="mainMenu">
						<li class="interested_in_me">
							<a id="menu_interested" href="javascript:pool.showLeaderboard();">Leaderboard</a>
						</li>
						<li class="my_matches">
							<a id="menu_my_matches" href="javascript:pool.showWeekPool();">My Pool</a>
						</li>
						<li class="tabSearch">
							<a id="menu_search" href="javascript:pool.showScores(<?= $admin -> admin_week;?>);">Statistics</a>
						</li>
						<li class="online_now">
							<a id="menu_online_now" href="javascript:void(0);">Points <span id="totalPoints" class="counter boxRound2 hidden">0</span></a>
						</li>
						<li class="mainMenuRightBorder"></li>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="cornerR">
					&nbsp;
				</div>
			</div><!--#mainNav-->
			<div class="clear"></div>
			<div id="content">
				<div id="leftColumn">
					<div id="leftMenu" class="contentBox">
						<div class="viewCount boxRound4">
							<a href="http://www.mate1.com/nw/profile/viewers">nobody</a> viewed me
						</div>
						<ul class="leftMenuContainer" id="adminUl"></ul>
					</div>
					<div class="clear"></div>
					<div id="quickSearchBox">
						<div id="quickSearch" class="boxRound4">
							<h1 id="player_h">Enter <span>your name:</span></h1>
							<div class="contentBox" id="formContentBox">
								<form method="get" action="/nw/ref/search/SearchAction" name="frmQuickSearch" id="frmQuickSearch" onsubmit="admin.showAdminMenu(<?= $admin->admin_week; ?>); return false;">
									<div class="formRow">
										<div>
											<label class="" id="frmQuickSearch_label_qs_genderLooking">Name:</label>
											<input type="text" class="uniform" name="commandname" id="commandname" />
										</div>
									</div>
									<div class="formRow">
										<input type="submit" value="Login" class="searchNow button blue boxRound4 boxShadowButton">
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--#quickSearchBox-->
					<div class="advancedSearchBox"></div>
					<div ref="flash" class="ads160x600">
						<div id="google_ads_div_left_160x600"><img src="img/adsLeft.jpg">
						</div>
					</div>
				</div><!--#leftColumn-->
				<div id="centerColumn"></div><!--#centerColumn-->
				<div id="rightColumn"><img src="img/adsRight.png" />
				</div>
				<div id="footer">
					<div id="footer_bar">
						<ul class="footer">
							<li class="first">
								Mate1 &copy; 2003-2011
							</li>
							<li class="first">
								&nbsp;<!--[if !IE 6]><!--><a title="About Mate1.com" href="http://www.mate1.com/nw/about">About Mate1.com</a><!--<![endif]--><!--[if IE 6]><a href="http://www.mate1.com/nw/about"title="About Mate1.com" >About Mate1.com</a><![endif]-->
								&nbsp;
							</li>
							<li>
								&nbsp;<!--[if !IE 6]><!--><a title="Terms &amp; Conditions" href="http://www.mate1.com/nw/user_agreement">Terms &amp; Conditions</a><!--<![endif]--><!--[if IE 6]><a href="http://www.mate1.com/nw/user_agreement"title="Terms &amp; Conditions" >Terms & Conditions</a><![endif]-->
								&nbsp;
							</li>
							<li>
								&nbsp;<!--[if !IE 6]><!--><a title="Privacy Policy" href="http://www.mate1.com/nw/privacy_policy">Privacy Policy</a><!--<![endif]--><!--[if IE 6]><a href="http://www.mate1.com/nw/privacy_policy"title="Privacy Policy" >Privacy Policy</a><![endif]-->
								&nbsp;
							</li>
							<li>
								&nbsp;<!--[if !IE 6]><!--><a title="Success Stories" href="http://www.mate1.com/nw/success_stories/page_1">Success Stories</a><!--<![endif]--><!--[if IE 6]><a href="http://www.mate1.com/nw/success_stories/page_1"title="Success Stories" >Success Stories</a><![endif]-->
								&nbsp;
							</li>
							<li>
								&nbsp;<!--[if !IE 6]><!--><a title="Advertise" href="http://www.mate1.com/nw/feedback/advertise">Advertise</a><!--<![endif]--><!--[if IE 6]><a href="http://www.mate1.com/nw/feedback/advertise"title="Advertise" >Advertise</a><![endif]-->
								&nbsp;
							</li>
							<li>
								&nbsp;<!--[if !IE 6]><!--><a title="Become An Affiliate" href="http://www.mate1.com/nw/ref/landing/affiliates">Become An Affiliate</a><!--<![endif]--><!--[if IE 6]><a href="http://www.mate1.com/nw/ref/landing/affiliates"title="Become An Affiliate" >Become An Affiliate</a><![endif]-->
								&nbsp;
							</li>
							<li>
								&nbsp;<!--[if !IE 6]><!--><a title="Safety Tips" href="http://www.mate1.com/nw/dating_safety_tips">Safety Tips</a><!--<![endif]--><!--[if IE 6]><a href="http://www.mate1.com/nw/dating_safety_tips"title="Safety Tips" >Safety Tips</a><![endif]-->
								&nbsp;
							</li>
							<li>
								&nbsp;<!--[if !IE 6]><!--><a title="Fraud Protection" href="http://www.mate1.com/nw/fraud_warning">Fraud Protection</a><!--<![endif]--><!--[if IE 6]><a href="http://www.mate1.com/nw/fraud_warning"title="Fraud Protection" >Fraud Protection</a><![endif]-->
								&nbsp;
							</li>
							<li>
								<a title="Help" href="http://www.mate1.com/nw/faq">Help / Contact us&nbsp;</a>
							</li>
						</ul><div class="clear"></div>
						<div id="veriSign">
							<!--[if !IE 6]><!--><a onclick="popUp('https://trustsealinfo.verisign.com/splash?form_file=fdf/splash.fdf&amp;dn=www.mate1.com&amp;lang=en', 600, 600); return false;" href="https://trustsealinfo.verisign.com/splash?form_file=fdf/splash.fdf&amp;dn=www.mate1.com&amp;lang=en"><img src="http://media3.mate1.com/nw/images/verisign.png?1233776916"></a><!--<![endif]--><!--[if IE 6]><a href="https://trustsealinfo.verisign.com/splash?form_file=fdf/splash.fdf&dn=www.mate1.com&lang=en" onclick="popUp('https://trustsealinfo.verisign.com/splash?form_file=fdf/splash.fdf&amp;dn=www.mate1.com&amp;lang=en', 600, 600); return false;"><img src="http://media3.mate1.com/nw/images/verisign.png?1233776916" /></a><![endif]-->
						</div>
					</div><div class="clear"></div>
				</div>
			</div><!--#content-->
		</div><!--#page-wrapper-->
	</body>
</html>