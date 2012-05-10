<?php include 'include/categories.php';?>

<!DOCTYPE html>
<html>
	<head>
		<title>Quotefish&trade;</title>
		<link rel="Stylesheet" href="quotefish.css" type="text/css" media="screen"/>
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="stylesheet" type="text/css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAqCKnvVvjuoqdJu9_BosVcUkvKAo0iSBs&libraries=places&sensor=true"></script>
		<script src="js/dw_scroll_c.js" type="text/javascript"></script>
		<script src="js/GoogleMaps.js" type="text/javascript"></script>
		<!--<script type="text/javascript" src="js/jquery.watermark.js"></script>-->
		<script>
		
			function init_dw_Scroll() 
			{
				var wndo = new dw_scrollObj('mainForm', 'slidingCanvas');
			}

			if ( dw_scrollObj.isSupported() ) 
			{
				dw_Event.add( window, 'load', init_dw_Scroll);
			}

			var $isCategoryValid = false;
			var $isConsumerLocationValid = false;
			var $selectedCategoryText = "";
			var categories= <?php GetCategoriesAsJson() ?>
			
			$(function() {
				$("#enterCategory")
					.autocomplete({
						source: categories
					}).focusin(function() {
						focusInEnterCategory();
					}).focusout(function() {
						validateEnterCategory();
					}).keypress(function(e) {
						var code = null;
						code = (e.keyCode ? e.keyCode : e.which);
						if (code == 13 || code == 9)
						{
							validateEnterCategory();
							$("#enterConsumerLocation").focus();
						}
					});
			});
		
			$(function() {				
				$("#enterConsumerLocation") 
					.focusin(function() {
						focusInEnterConsumerLocation();
					}).focusout(function() {
						validateEnterConsumerLocation();
					}).keypress(function(e) {
						var code = null;
						code = (e.keyCode ? e.keyCode : e.which);
						if (code == 13 || code == 9)
						{
							validateEnterConsumerLocation();
							$("#page1Arrow").focus();
						}
					});
			});

		function focusInEnterCategory()
		{
			showEnterCategoryTip();
		}
				
		function showEnterCategoryTip()
		{
			$("#enterCategoryTip").css({opacity: 0, visibility: "visible"}).animate({opacity: 1},3000);
		}
		
		function validateEnterCategory()
		{
			$selectedCategoryText =  $("#enterCategory").val();
			$isCategoryValid = ($.inArray($selectedCategoryText, categories) != -1);
			if (! $isCategoryValid)
			{
				//$("#categoryTipText").html("");
				//$("#enterCategoryTip").animate({left:"100px", top:"100px", width:"360px", height:"320px"}, 500); 
			}
			else
			{				
				$("div#progress div#category").text($selectedCategoryText);
				// Set the tool tip to 'You are looking for'
			}
			updateCategoryTick();
			updatePage1Arrow();
		}
		
		function focusInEnterConsumerLocation()
		{
			showEnterConsumerLocationTip();
		}
		
		function showEnterConsumerLocationTip()
		{
			$("#enterConsumerLocationTip").css({opacity: 0, visibility: "visible"}).animate({opacity: 1},3000);
		}

		function validateEnterConsumerLocation()
		{
			if($isConsumerLocationValid)
			{
				var consumerLocationText =  $("#enterConsumerLocation").val();
				$("div#progress div#consumerLocation").text(consumerLocationText);
			}
			updateConsumerLocationTick();
			updatePage1Arrow();
		}
		
		function updatePage1Arrow()
		{
			if ( $isCategoryValid && $isConsumerLocationValid)
			{
				$("#page1Arrow").css({visibility : "visible"});
			}
			else
			{
				$("#page1Arrow").css({visibility : "hidden"});
			}
		}
		
		function updateCategoryTick()
		{
			if ( $isCategoryValid )
			{
				$("div#progress div#categoryTick").css({visibility : "visible"});
			}
			else
			{
				$("div#progress div#categoryTick").css({visibility : "hidden"});
			}
		}
		
		function updateConsumerLocationTick()
		{
			if ( $isConsumerLocationValid )
			{
				$("div#progress div#consumerLocationTick").css({visibility : "visible"});
			}
			else
			{
				$("div#progress div#consumerLocationTick").css({visibility : "hidden"});
			}
		}
		
		</script>
	</head>
	<body>
		<div id="container">
			<div id="banner">
				<img id="bannerLogo" src="images/quotefishbannerlogo.png"/>
				<div id="logIn">
					<span id="logInText"><br/>Log In</span>
				</div>
				<div id="businessSignUp">
					<span id="businessSignUpText"><br/>Sign your<br/>Business<br/>in here!</span>
				</div>
			</div>
			<div id="main">
				<div id="progress">
					<div id="category"></div><div id="categoryTick" class="progressTick"></div>
					<div id="consumerLocation"></div><div id="consumerLocationTick" class="progressTick"></div>
					<div id="jobDescription"></div><div id="jobDescriptionTick" class="progressTick"></div>
					<div id="jobLocation"></div><div id="jobLocationTick" class="progressTick"></div>
					<div id="jobInDetail"></div>
					<div id="budget">
						<div id="budgetSmall"></div>
						<div id="budgetMedium"></div>
						<div id="budgetLarge"></div>
					</div>
					<div id="visitType">
						<div id="newUser"></div>
						<div id="returnVisit"></div>
					</div>
					<div id="consumerName"></div>
					<div id="consumerMobileNumber"></div>
					<div id="consumerEmail"></div>
					<div id="consumerPassword"></div>
					<div id="tick"></div>
				</div>
				<div id="mainForm">
					<div id="slidingCanvas">
					
						<div id="page1Marker"></div>
						
						<div class="ui-widget">
							<input type="text" id="enterCategory" class="quotefishSingleLineField jq_watermark" name="enterCategory" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;What are you looking for?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"/>
						</div>
						<div id="enterCategoryTip"><div id="categoryTipText">For example: Cleaning, Lawyer, Mechanic, Disc Jockey...</div></div>
						
						<input type="text" id="enterConsumerLocation" class="quotefishSingleLineField jq_watermark" name="enterConsumerLocation" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Where are you located?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"/>
						<div id="enterConsumerLocationTip">
							<div id="consumerLocationMapTitle">You are here:</div>
							<div id="consumerLocationMap"></div>
						</div>

						<a href="#page2Marker"><div id="page1Arrow"></div></a>

						<div id="page2Marker"></div>
						
						<input	type="text" id="enterShortDescription" class="quotefishSingleLineField jq_watermark" 
								name="enterShortDescription" placeholder="Describe your job in a few short words?"/>
						<input	type="text" id="enterJobLocation" class="quotefishSingleLineField jq_watermark" 
								name="enterJobLocation" placeholder="Where is your job located?"/>

					</div>
				</div>
			</div>
			<div id="footer">
				<img id="footerButtons" src="images/footerbuttons.png"/>
			</div>
		</div>
	</body>
</html>
