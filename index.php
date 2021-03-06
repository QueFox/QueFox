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

        <script src="js/ConsumerLayout.js" type="text/javascript"></script>
		
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
						source: categories,
                        select: function(event, ui) { categorySelectedFromAutoCompleteList(event, ui); }
					}).focusin(function() {
						focusInEnterCategory();
					});
			});
		
			$(function() {				
				$("#enterConsumerLocation") 
					.focusin(function() {
						focusInEnterConsumerLocation();
					});
			});

            $(function() {
                $("#enterShortDescription")
                    .focusin(function() {
                        focusInEnterShortDescription();
                    }).focusout(function() {
                        processConfirmOnShortJobDescription();
                    }).keypress(function(e) {
                        if(e.which == 13)
                        {
                            processConfirmOnShortJobDescription();
                        }
                    })
            });

            function processConfirmOnShortJobDescription()
            {
                var shortDescriptionText = $("#enterShortDescription").val();
                $("div#progress div#jobDescription").text(shortDescriptionText);

                if(shortDescriptionText.length > 0)
                {
                    $("#enterJobLocation").focus();
                    $("div#progress div#jobDescriptionTick").css({visibility : "visible"});
                    isJobDescriptionValid = true;
                }
                else
                {
                    $("div#progress div#jobDescriptionTick").css({visibility : "hidden"});
                    isJobDescriptionValid = false;
                }
            }

            function categorySelectedFromAutoCompleteList(event, ui)
            {
                validateEnterCategory(ui.item.value);
                $("#enterConsumerLocation").focus();
            }

            function consumerLocationChosenFromAutoCompleteList()
            {
                validateEnterConsumerLocation();
            }

			function focusInEnterCategory()
			{
				showEnterCategoryTip();
			}
					
			function showEnterCategoryTip()
			{
				$("#enterCategoryTip").css({opacity: 0, visibility: "visible"}).animate({opacity: 1},3000);
			}
			
			function validateEnterCategory(selectedCategoryText)
			{
				isCategoryValid = ($.inArray(selectedCategoryText, categories) != -1);
				if (! isCategoryValid)
				{
					handleInvalidCategory(selectedCategoryText);
				}
				else
				{
					$("div#progress div#category").text(selectedCategoryText);
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

            function focusInEnterShortDescription()
            {
                showEnterShortDescriptionTip();
            }

            function showEnterShortDescriptionTip()
            {
                $("#enterShortDescriptionTip").css({opacity: 0, visibility: "visible"}).animate({opacity: 1},3000);
            }

            $(function() {
                $("#enterJobLocation")
                    .focusin(function() {
                        focusInEnterJobLocation();
                    });
            });

            function focusInEnterJobLocation()
            {
                showEnterJobLocationTip();
            }

            function showEnterJobLocationTip()
            {
                $("#enterJobLocationTip").css({opacity: 0, visibility: "visible"}).animate({opacity: 1},3000);
            }

            function jobLocationChosenFromAutoCompleteList()
            {
                validateEnterJobLocation();
            }

            function validateEnterJobLocation()
            {
                if($isJobLocationValid)
                {
                    var jobLocationText =  $("#enterJobLocation").val();
                    $("div#progress div#jobLocation").text(jobLocationText);
                }
                updateJobLocationTick();
                updatePage2DownArrow();
            }

            function updateJobLocationTick()
            {
                if ( $isJobLocationValid )
                {
                    $("div#progress div#jobLocationTick").css({visibility : "visible"});
                }
                else
                {
                    $("div#progress div#jobLocationTick").css({visibility : "hidden"});
                }
            }

            function updatePage2DownArrow()
            {
                if ( isJobDescriptionValid && $isJobLocationValid)
                {
                    $("#page2DownArrow").css({visibility : "visible"});
                }
                else
                {
                    $("#page2DownArrow").css({visibility : "hidden"});
                }
            }

            $(function() {
                $("#button500")
                    .click(function() {
                        button500Pressed();
                    })
            });

            $(function() {
                $("#button500To2000")
                    .click(function() {
                        button500To2000Pressed();
                    })
            });

            $(function() {
                $("#button2000")
                    .click(function() {
                        button2000Pressed();
                    })
            });


            function button500Pressed()
            {
                isBudgetValid = true;
                $("#button500").css({'background-image' : 'url("images/prices-500-down.png")'});
                $("#button500To2000").css({'background-image' : 'url("images/prices-500to2000-up.png")'});
                $("#button2000").css({'background-image' : 'url("images/prices-2000-up.png")'});
                $("div#progress div#budget").text("<€500");
                $("div#progress div#budgetTick").css({visibility : "visible"});
                updatePage3DownArrow();
            }

            function button500To2000Pressed()
            {
                isBudgetValid = true;
                $("#button500").css({'background-image' : 'url("images/prices-500-up.png")'});
                $("#button500To2000").css({'background-image' : 'url("images/prices-500to2000-down.png")'});
                $("#button2000").css({'background-image' : 'url("images/prices-2000-up.png")'});
                $("div#progress div#budget").text("€500-€2,000");
                $("div#progress div#budgetTick").css({visibility : "visible"});
                updatePage3DownArrow();
            }

            function button2000Pressed()
            {
                isBudgetValid = true;
                $("#button500").css({'background-image' : 'url("images/prices-500-up.png")'});
                $("#button500To2000").css({'background-image' : 'url("images/prices-500to2000-up.png")'});
                $("#button2000").css({'background-image' : 'url("images/prices-2000-down.png")'});
                $("div#progress div#budget").text("€2,000+");
                $("div#progress div#budgetTick").css({visibility : "visible"});
                updatePage3DownArrow();
            }

            $(function() {
                $("#enterLongDescription")
                    .focusin(function() {
                        focusInEnterLongDescription();
                    }).focusout(function() {
                        processConfirmOnLongDescription();
                    }).keypress(function(e) {
                        if(e.which == 13)
                        {
                            processConfirmOnLongDescription();
                        }
                    });
            });


            function focusInEnterLongDescription()
            {
                $("#enterLongDescriptionTip").css({opacity: 0, visibility: "visible"}).animate({opacity: 1},3000);
                $("#budgetTip").css({opacity: 0, visibility: "visible"}).animate({opacity: 1},3000);
            }

            function processConfirmOnLongDescription()
            {
                var longDescriptionText = $("#enterLongDescription").val();
                $("div#progress div#jobInDetail").text(longDescriptionText);

                if(longDescriptionText.trim().length > 0)
                {
                    //$("#enterJobLocation").focus();
                    $("div#progress div#jobInDetailTick").css({visibility : "visible"});
                    isLongDescriptionValid = true;
                }
                else
                {
                    $("div#progress div#jobInDetailTick").css({visibility : "hidden"});
                    isLongDescriptionValid = false;
                }

                updatePage3DownArrow();
            }


            function updatePage3DownArrow()
            {
                if ( isLongDescriptionValid && isBudgetValid)
                {
                    $("#page3DownArrow").css({visibility : "visible"});
                }
                else
                {
                    $("#page3DownArrow").css({visibility : "hidden"});
                }
            }

            $(function() {
                $("#buttonNewUser")
                    .click(function() {
                        buttonNewUserPressed();
                    })
            });

            $(function() {
                $("#buttonReturnVisitor")
                    .click(function() {
                        buttonReturnVisitorPressed();
                    })
            });

            function buttonNewUserPressed()
            {
                isUserTypeValid = true;
                $("#buttonNewUser").css({'background-image' : 'url("images/newUserButtonDown.png")'});
                $("#buttonReturnVisitor").css({'background-image' : 'url("images/returnVisitorButtonUp.png")'});
                $("#progress #newUser").css({'background-image' : 'url("images/tiny-tick.png")'});
                $("#progress #returnVisit").css({'background-image' : 'None'});
                $("#firstName").css({visibility : "visible"});
                $("#lastName").css({visibility : "visible"});
                $("#mobileNumber").css({visibility : "visible"});
                $("#emailAddress").css({top : emailAddressTop, visibility : "visible"});
                $("#password").css({top : passwordTop, visibility : "visible"});
                $("#nameTip").css({visibility : "hidden"});
                $("#mobileNumberTip").css({visibility : "hidden"});
                $("#emailAddressTip").css({visibility : "hidden"});
                $("#passwordTip").css({visibility : "hidden"});
            }

            function buttonReturnVisitorPressed()
            {
                isUserTypeValid = true;
                $("#buttonNewUser").css({'background-image' : 'url("images/newUserButtonUp.png")'});
                $("#buttonReturnVisitor").css({'background-image' : 'url("images/returnVisitorButtonDown.png")'});
                $("#progress #returnVisit").css({'background-image' : 'url("images/tiny-tick.png")'});
                $("#progress #newUser").css({'background-image' : 'None'});
                $("#firstName").css({visibility : "hidden"});
                $("#lastName").css({visibility : "hidden"});
                $("#mobileNumber").css({visibility : "hidden"});
                $("#nameTip").css({visibility : "hidden"});
                $("#mobileNumberTip").css({visibility : "hidden"});
                $("#emailAddressTip").css({visibility : "hidden"});
                $("#passwordTip").css({visibility : "hidden"});
                $("#emailAddress").css({top: emailAddressTop}).animate({top: nameTop},500);
                $("#password").css({top: passwordTop}).animate({top: mobileNumberTop},750);
            }

            $(function() {
                $("#firstName")
                    .focusin(function() {
                        focusInFirstName();
                    }).focusout(function() {
                        processConfirmOnFirstName();
                    }).keypress(function(e) {
                        if(e.which == 13)
                        {
                            processConfirmOnFirstName();
                        }
                    })
            });

            $(function() {
                $("#lastName")
                    .focusin(function() {
                        focusInLastName();
                    }).focusout(function() {
                        processConfirmOnLastName();
                    }).keypress(function(e) {
                        if(e.which == 13)
                        {
                            processConfirmOnLastName();
                        }
                    })
            });

            $(function() {
                $("#mobileNumber")
                    .focusin(function() {
                        focusInMobileNumber();
                    }).focusout(function() {
                        processConfirmOnMobileNumber();
                    }).keypress(function(e) {
                        if(e.which == 13)
                        {
                            processConfirmOnMobileNumber();
                        }
                    })
            });

            $(function() {
                $("#emailAddress")
                    .focusin(function() {
                        focusInEmailAddress();
                    }).focusout(function() {
                        processConfirmOnEmailAddress();
                    }).keypress(function(e) {
                        if(e.which == 13)
                        {
                            processConfirmOnEmailAddress();
                        }
                    })
            });

            $(function() {
                $("#password")
                    .focusin(function() {
                        focusInPassword();
                    }).focusout(function() {
                        processConfirmOnPassword();
                    }).keypress(function(e) {
                        if(e.which == 13)
                        {
                            processConfirmOnPassword();
                        }
                    })
            });

            function focusInFirstName()
            {
                showNameTip();
            }

            function focusInLastName()
            {
                showNameTip();
            }
            function focusInMobileNumber()
            {
                showMobileNumberTip();
            }

            function focusInEmailAddress()
            {
                showEmailAddressTip();
            }

            function focusInPassword()
            {
                showPasswordTip();
            }
            function showNameTip()
            {
                $("#nameTip").css({opacity: 0, visibility: "visible"}).animate({opacity: 1},3000);
            }

            function showMobileNumberTip()
            {
                $("#mobileNumberTip").css({opacity: 0, visibility: "visible"}).animate({opacity: 1},3000);
            }

            function showEmailAddressTip()
            {
                $("#emailAddressTip").css({opacity: 0, visibility: "visible"}).animate({opacity: 1},3000);
            }

            function showPasswordTip()
            {
                $("#passwordTip").css({opacity: 0, visibility: "visible"}).animate({opacity: 1},3000);
            }

            function processConfirmOnFirstName()
            {
                var firstNameText = $("#firstName").val().trim();
                var lastNameText = $("#lastName").val().trim();
                $("div#progress div#consumerName").text(firstNameText + ' ' + lastNameText);

                if(firstNameText.length > 0)
                {
                    $("#lastName").focus();
                    isFirstNameValid = true;

                    if(isLastNameValid)
                    {
                        $("div#progress div#consumerNameTick").css({visibility : "visible"});
                    }
                }
                else
                {
                    $("div#progress div#consumerNameTick").css({visibility : "hidden"});
                    isFirstNameValid = false;
                }

                updatePage4Arrow();
            }

            function processConfirmOnLastName()
            {
                var firstNameText = $("#firstName").val().trim();
                var lastNameText = $("#lastName").val().trim();
                $("div#progress div#consumerName").text(firstNameText + ' ' + lastNameText);

                if(lastNameText.length > 0)
                {
                    $("#mobileNumber").focus();
                    isLastNameValid = true;

                    if(isFirstNameValid)
                    {
                        $("div#progress div#consumerNameTick").css({visibility : "visible"});
                    }
                }
                else
                {
                    $("div#progress div#consumerNameTick").css({visibility : "hidden"});
                    isLastNameValid = false;
                }

                updatePage4Arrow();
            }

            function processConfirmOnMobileNumber()
            {
                var mobileNumberText = $("#mobileNumber").val().trim();

                if(mobileNumberText.length > 0 && isValidMobileNumber(mobileNumberText))
                {
                    mobileNumberText = formatMobileNumber(mobileNumberText);
                    $("#mobileNumber").val(mobileNumberText);
                    $("div#progress div#consumerMobileNumber").text(mobileNumberText);
                    $("div#progress div#consumerMobileNumberTick").css({visibility : "visible"});
                    $("#emailAddress").focus();
                    isMobileNumberValid = true;
                }
                else
                {
                    $("div#progress div#consumerMobileNumberTick").css({visibility : "hidden"});
                    isMobileNumberValid = false;
                }

                updatePage4Arrow();
            }

            function processConfirmOnEmailAddress()
            {
                var emailAddressText = $("#emailAddress").val().trim();

                if(emailAddressText.length > 0 && isValidEmailAddress(emailAddressText))
                {
                    $("div#progress div#consumerEmail").text(emailAddressText);
                    $("div#progress div#consumerEmailTick").css({visibility : "visible"});
                    $("#password").focus();
                    isEmailAddressValid = true;
                }
                else
                {
                    $("div#progress div#consumerEmailTick").css({visibility : "hidden"});
                    isEmailAddressValid = false;
                }

                updatePage4Arrow();
            }

            function processConfirmOnPassword()
            {
                var passwordText = $("#password").val().trim();

                if(passwordText.length > 6)
                {
                    $("div#progress div#consumerPassword").text(passwordText);
                    $("div#progress div#consumerPasswordTick").css({visibility : "visible"});
                    $("#page4DownArrow").focus();
                    isPasswordValid = true;
                }
                else
                {
                    $("div#progress div#consumerPasswordTick").css({visibility : "hidden"});
                    isPasswordValid = false;
                }

                updatePage4Arrow();
            }

            function isValidMobileNumber(mobileNumber)
            {
                var mobileNumberRegExp= new RegExp("08[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]");
                var pureMobileNumber = mobileNumber.replace("(","").replace(")","").replace(" ","");
                return mobileNumberRegExp.test(pureMobileNumber);
            }

            function isValidEmailAddress(emailAddress)
            {
                var emailAddressRegExp= new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
                return emailAddressRegExp.test(emailAddress);
            }

            function formatMobileNumber(mobileNumber)
            {
                return "(" + mobileNumber.substring(0,3) + ") " + mobileNumber.substring(3,6) + " " + mobileNumber.substring(6,10);
            }

            function isPage4Valid()
            {
                return isFirstNameValid && isLastNameValid && isMobileNumberValid && isEmailAddressValid && isPasswordValid;
            }

            function updatePage4Arrow()
            {
                if(isPage4Valid())
                {
                    $("#page4DownArrow").css({opacity: 0, visibility: "visible"}).animate({opacity: 1},3000);
                }
                else
                {
                    $("#page4DownArrow").css({visibility: "hidden"});
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
					<a href="#page1Marker"><div id="category"></div></a><div id="categoryTick" class="progressTick"></div>
                    <a href="#page1Marker"><div id="consumerLocation"></div></a><div id="consumerLocationTick" class="progressTick"></div>
                    <a href="#page2Marker"><div id="jobDescription"></div></a><div id="jobDescriptionTick" class="progressTick"></div>
                    <a href="#page2Marker"><div id="jobLocation"></div></a><div id="jobLocationTick" class="progressTick"></div>
                    <a href="#page3Marker"><div id="jobInDetail"></div></a><div id="jobInDetailTick" class="progressTick"></div>
                    <a href="#page3Marker"><div id="budget"></div></a><div id="budgetTick" class="progressTick"></div>
					<div id="visitType">
                        <a href="#page4Marker"><div id="newUser"></div></a>
                        <a href="#page4Marker"><div id="returnVisit"></div></a>
					</div>
                    <a href="#page4Marker"><div id="consumerName"></div></a><div id="consumerNameTick" class="progressTick"></div>
                    <a href="#page4Marker"><div id="consumerMobileNumber"></div></a><div id="consumerMobileNumberTick" class="progressTick"></div>
                    <a href="#page4Marker"><div id="consumerEmail"></div></a><div id="consumerEmailTick" class="progressTick"></div>
                    <a href="#page4Marker"><div id="consumerPassword"></div></a><div id="consumerPasswordTick" class="progressTick"></div>

                    <a href="#page5Marker"><div id="tick"></div></a>
				</div>
				<div id="mainForm">
					<div id="slidingCanvas">
					
						<div id="page1Marker"></div>
						
						<div class="ui-widget">
							<input type="text" id="enterCategory" class="quotefishSingleLineField jq_watermark" name="enterCategory" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;What are you looking for?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"/>
						</div>
						<div id="enterCategoryTip"><div id="categoryTipText">For example: Cleaner, Solicitor, Plumber, Caterer, Florist, Tailor, Fencing, Tutor, Wedding, Roofing, Disc Jockey, Graphic Designer, Computer Repairs...</div></div>
						
						<input type="text" id="enterConsumerLocation" class="quotefishSingleLineField jq_watermark" name="enterConsumerLocation" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Where are you located?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"/>
						<div id="enterConsumerLocationTip">
							<div id="consumerLocationMapTitle">You are here:</div>
							<div id="consumerLocationMap"></div>
						</div>

						<a href="#page2Marker"><div id="page1Arrow"></div></a>

						<div id="page2Marker"></div>


						<input	type="text" id="enterShortDescription" class="quotefishSingleLineField jq_watermark" 
								name="enterShortDescription" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Describe your job in a few short words&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"/>
                        <div id="enterShortDescriptionTip"><div id="shortDescriptionTipText">For example: I need someone to tile my bathroom...</div></div>
						<input	type="text" id="enterJobLocation" class="quotefishSingleLineField jq_watermark" 
								name="enterJobLocation" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Where is your job located?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"/>
                        <div id="enterJobLocationTip">
                            <div id="jobLocationMapTitle">Your job is here:</div>
                            <div id="jobLocationMap"></div>
                        </div>

                        <a href="#page3Marker"><div id="page2DownArrow"></div></a>

                        <div id="page3Marker"></div>

                        <textarea id="enterLongDescription" class="quotefishMultiLineField jq_watermark" name="enterLongDescription" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Describe your job in detail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"></textarea>
                        <div id="enterLongDescriptionTip"><div id="longDescriptionTipText">Please supply all the information you can so businesses can give you their best quote. The more information you provide, the more quotes you'll receive.</div></div>

                        <div id="budgetButtons">
                            <div id="button500"></div>
                            <div id="button500To2000"></div>
                            <div id="button2000"></div>
                        </div>
                        <div id="budgetTip"><div id="budgetTipText">This is where you select your budget for your job. Your selection here dictates how much the quoting business pay to quote on your job. Up to €500 costs them €2, €500-€2,000 costs €5 and €2,000+ costs €10.</div></div>

                        <a href="#page4Marker"><div id="page3DownArrow"></div></a>

                        <div id="page4Marker"></div>

                        <div id="userTypeButtons">
                            <div id="buttonNewUser"></div>
                            <div id="buttonReturnVisitor"></div>
                        </div>

                        <input type="text" id="firstName" class="quotefishSingleLineField jq_watermark" name="firstName" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;First Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"/>
                        <input type="text" id="lastName" class="quotefishSingleLineField jq_watermark" name="lastName" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"/>
                        <div id="nameTip"><div id="nameTipText">First and last<br/>name, please.</div></div>

                        <input type="text" id="mobileNumber" class="quotefishSingleLineField jq_watermark" name="mobileNumber" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your mobile number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"/>
                        <div id="mobileNumberTip"><div id="mobileNumberTipText">Please enter a valid<br/>mobile phone number.</div></div>

                        <input type="text" id="emailAddress" class="quotefishSingleLineField jq_watermark" name="emailAddress" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your email address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"/>
                        <div id="emailAddressTip"><div id="emailAddressTipText">In case we need<br/>to contact you.</div></div>

                        <input type="password" id="password" class="quotefishSingleLineField jq_watermark" name="password" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"/>
                        <div id="passwordTip"><div id="passwordTipText">You'll need this next time you're here.</div></div>

                        <a href="#page5Marker"><div id="page4DownArrow"></div></a>

                        <div id="page5Marker"></div>

                        <!--<div id="completion">
                            <div id="postAnotherJob"></div>
                            <div id="success"></div>
                            <div id="goToDashboard"></div>
                        </div>
                        -->
                    </div>
				</div>
			</div>
			<div id="footer">
                <a href="" id="consumersAnchor"><img src="images/Consumers_Icon.png" id="consumersIcon"><br/>Consumers</a>
                <a href="" id="businessesAnchor"><img src="images/Businesses_Icon.png" id="businessesIcon"><br/>Businesses</a>
                <a href="" id="termsAnchor"><img src="images/Terms_Icon.png" id="termsIcon"><br/>Terms</a>
                <a href="" id="contactAnchor"><img src="images/Contact_Icon.png" id="contactIcon"><br/>Contact</a>
                <a href="" id="blogAnchor"><img src="images/Blog_Icon.png" id="blogIcon"><br/>Blog</a>
			</div>
		</div>
	</body>
</html>
