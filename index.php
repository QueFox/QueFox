<?php include 'include/categories.php';?>

<!DOCTYPE html>

    <!-- Quick test of versioning -->

<html>
	<head>
		<title>Quotefish&trade;</title>
		<link rel="Stylesheet" href="css/quotefish.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="css/jquery-ui-themes-1.8.20/themes/quotefish/jquery-ui-1.8.20.custom.css" type="text/css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAqCKnvVvjuoqdJu9_BosVcUkvKAo0iSBs&libraries=places&sensor=true"></script>
		<script src="js/dw_scroll_c.js" type="text/javascript"></script>
		<script src="js/GoogleMaps.js" type="text/javascript"></script>
		<!--<script type="text/javascript" src="js/jquery.watermark.js"></script>-->
		
		<script src="js/globals.index.php.js" type="text/javascript"></script>
		
		<script>
		
			function init_dw_Scroll() 
			{
				var wndo = new dw_scrollObj('mainForm', 'slidingCanvas');
			}

			if ( dw_scrollObj.isSupported() ) 
			{
				dw_Event.add( window, 'load', init_dw_Scroll);
			}

			categories= <?php GetCategoriesAsJson() ?>
			
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
							//e.preventDefault();
							//validateEnterConsumerLocation();
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
				isCategoryValid = ($.inArray($selectedCategoryText, categories) != -1);
				if (! isCategoryValid)
				{
					handleInvalidCategory($selectedCategoryText);
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
				if ( isCategoryValid && $isConsumerLocationValid)
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
				if ( isCategoryValid )
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

			function updateTips( t ) {
				tips
					.text( t )
					.addClass( "ui-state-highlight" );
				setTimeout(function() {
					tips.removeClass( "ui-state-highlight", 1500 );
				}, 500 );
			}

			function checkLength( o, n, min, max ) {
				if ( o.val().length > max || o.val().length < min ) {
					o.addClass( "ui-state-error" );
					updateTips( "Length of " + n + " must be between " +
						min + " and " + max + "." );
					return false;
				} else {
					return true;
				}
			}

			function checkRegexp( o, regexp, n ) {
				if ( !( regexp.test( o.val() ) ) ) {
					o.addClass( "ui-state-error" );
					updateTips( n );
					return false;
				} else {
					return true;
				}
			}

			function handleInvalidCategory(categoryText)
			{
				var narrativeText = 'We don\'t have the category \'' + categoryText +'\' yet.';
				narrativeText += '<p/>Enter your email address below and click \'Notify Me\' ';
				narrativeText += 'if you would like us to send you an email when we have added this, or a similar category.';
				narrativeText += '<p/>Otherwise click \'Cancel\' to enter a different category.';
				 
				var narrativeDivHtml = '<div id="narrative">' + narrativeText + '</div>';
				var emailDivHtml = '<div id="email"><input type="text" name="email" placeholder="Your email address"/></div>';
				var dialogHtml = narrativeDivHtml + emailDivHtml;
				
				var $dialog = 
					$('<div id="badCategoryDialog"></div>')
					.html(dialogHtml)
					.dialog(
							{
								autoOpen: false,
								title: 'Oops!',
								modal: true,
								buttons:
								{
									'Notify Me' : function() { return; },
									'Cancel' : function() { $(this).dialog("close"); }
								}
							});
					
				/*
					var name = $( "#name" ),
						email = $( "#email" ),
						password = $( "#password" ),
						allFields = $( [] ).add( name ).add( email ).add( password ),
						tips = $( ".validateTips" );

					
					$( "#badCategorydialog" ).dialog({
						autoOpen: false,
						height: 300,
						width: 350,
						modal: true,
						buttons: {
							"Create an account": function() {
								var bValid = true;
								allFields.removeClass( "ui-state-error" );

								bValid = bValid && checkLength( name, "username", 3, 16 );
								bValid = bValid && checkLength( email, "email", 6, 80 );
								bValid = bValid && checkLength( password, "password", 5, 16 );

								//bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );

								if ( bValid ) {
									$( "#users tbody" ).append( "<tr>" +
										"<td>" + name.val() + "</td>" + 
										"<td>" + email.val() + "</td>" + 
										"<td>" + password.val() + "</td>" +
									"</tr>" ); 
									$( this ).dialog( "close" );
								}
							},
							Cancel: function() {
								$( this ).dialog( "close" );
							}
						},
						close: function() {
							allFields.val( "" ).removeClass( "ui-state-error" );
						}
					});
*/
					$dialog.dialog( 'open' );
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
				<img id="footerButtons" src="images/footerbuttons.png" />
			</div>
		</div>
	</body>
</html>
