/**
 * Created with JetBrains PhpStorm.
 * User: Mike
 * Date: 20/07/12
 * Time: 13:36
 * To change this template use File | Settings | File Templates.
 */
// Large popup higher Top should be -95px above the Top of its respective input control.
// Large popup lower Top should be at the same position as the Top of its respective input control.

// Small popup Top should be at the same position as the Top of its respective input control.

// Popup Left (in all cases except Budget Buttons) = 575
// Popup Left (Budget Buttons) = 490

var pageMarkerLeft = 0;
var pageArrowLeft = 250;
var standardConsumerFieldLeft = 2;
var standardTipLeft = 575;

// Page 1
var page1MarkerTop = 0;
var consumerCategoryTop = page1MarkerTop + 100;
var consumerCategoryTipTop = consumerCategoryTop - 95;

var consumerLocationTop = page1MarkerTop + 250;
var consumerLocationTipTop = consumerLocationTop;

var page1ArrowTop = page1MarkerTop + 430;


// Page 2
var page2MarkerTop = page1MarkerTop + 600;
var enterShortDescriptionTop = page2MarkerTop + 100;
var enterShortDescriptionTipTop = enterShortDescriptionTop - 95;
var enterJobLocationTop = page2MarkerTop + 250;
var enterJobLocationTipTop = enterJobLocationTop;
var page2ArrowTop = page2MarkerTop + 430;


// Page 3
var page3MarkerTop = page2MarkerTop + 600;
var enterLongDescriptionTop = page3MarkerTop + 25;
var enterLongDescriptionTipTop = enterLongDescriptionTop;
var budgetButtonsLeft = 93;
var budgetButtonsTop = page3MarkerTop + 280;
var budgetButtonsTipLeft = 490;
var budgetButtonsTipTop = budgetButtonsTop - 10;
var page3ArrowTop = page3MarkerTop + 430;

// Page 4
var page4MarkerTop = page3MarkerTop + 600;
var userTypeButtonsLeft = 155;
var userTypeButtonsTop = page4MarkerTop + 10;
var firstNameLeft = standardConsumerFieldLeft;
var lastNameLeft = firstNameLeft + 295;
var nameTop = page4MarkerTop + 70;
var nameTipTop = nameTop;
var mobileNumberTop = page4MarkerTop + 144;
var mobileNumberTipTop = mobileNumberTop;
var emailAddressTop = page4MarkerTop + 218;
var emailAddressTipTop = emailAddressTop;
var passwordTop = page4MarkerTop + 292;
var passwordTipTop = passwordTop;
var page4ArrowTop = page4MarkerTop + 430;

// Page 4
var page5MarkerTop = page4MarkerTop + 600;

$(function()
{
    $("#page1Marker").css({                 left : pageMarkerLeft,              top : page1MarkerTop});
    $("#enterCategory").css({               left : standardConsumerFieldLeft,   top : consumerCategoryTop});
    $("#enterCategoryTip").css({            left : standardTipLeft,             top : consumerCategoryTipTop});
    $("#enterConsumerLocation").css({       left : standardConsumerFieldLeft,   top : consumerLocationTop});
    $("#enterConsumerLocationTip").css({    left : standardTipLeft,             top : consumerLocationTipTop});
    $("#page1Arrow").css({                  left : pageArrowLeft,               top : page1ArrowTop});

    $("#page2Marker").css({                 left : pageMarkerLeft,              top : page2MarkerTop});
    $("#enterShortDescription").css({       left : standardConsumerFieldLeft,   top : enterShortDescriptionTop});
    $("#enterShortDescriptionTip").css({    left : standardTipLeft,             top : enterShortDescriptionTipTop});
    $("#enterJobLocation").css({            left : standardConsumerFieldLeft,   top : enterJobLocationTop});
    $("#enterJobLocationTip").css({         left : standardTipLeft,             top : enterJobLocationTipTop});
    $("#page2DownArrow").css({              left : pageArrowLeft,               top : page2ArrowTop});

    $("#page3Marker").css({                 left : pageMarkerLeft,              top : page3MarkerTop});
    $("#enterLongDescription").css({        left : standardConsumerFieldLeft,   top : enterLongDescriptionTop});
    $("#enterLongDescriptionTip").css({     left : standardTipLeft,             top : enterLongDescriptionTipTop});
    $("#budgetButtons").css({               left : budgetButtonsLeft,           top : budgetButtonsTop});
    $("#budgetTip").css({                   left : budgetButtonsTipLeft,        top : budgetButtonsTipTop});
    $("#page3DownArrow").css({              left : pageArrowLeft,               top : page3ArrowTop});

    $("#page4Marker").css({                 left : pageMarkerLeft,              top : page4MarkerTop});
    $("#userTypeButtons").css({             left : userTypeButtonsLeft,         top : userTypeButtonsTop});
    $("#firstName").css({                   left : firstNameLeft,               top : nameTop});
    $("#lastName").css({                    left : lastNameLeft,                top : nameTop});
    $("#nameTip").css({                     left : standardTipLeft,             top : nameTipTop});
    $("#mobileNumber").css({                left : standardConsumerFieldLeft,   top : mobileNumberTop});
    $("#mobileNumberTip").css({             left : standardTipLeft,             top : mobileNumberTipTop});
    $("#emailAddress").css({                left : standardConsumerFieldLeft,   top : emailAddressTop});
    $("#emailAddressTip").css({             left : standardTipLeft,             top : emailAddressTipTop});
    $("#password").css({                    left : standardConsumerFieldLeft,   top : passwordTop});
    $("#passwordTip").css({                 left : standardTipLeft,             top : passwordTipTop});
    $("#page4DownArrow").css({              left : pageArrowLeft,               top : page4ArrowTop});

    $("#page5Marker").css({                 left : pageMarkerLeft,              top : page5MarkerTop});
});
