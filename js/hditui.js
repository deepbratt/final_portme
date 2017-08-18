$(document).ready(
    function() {
        Initialize();
        ManageTopnav();
        StickMdlNav();
        SetProductPrice();
        SetReleaseNote();
        setInterval(function() { $('#scrolldown').tooltip('toggle'); }, 1000);
    }
);

function SetProductPrice() {

    var dataL = GetQueryStringFieldList();
    var ProductNameL = dataL["P"];
    if (window.location.href.toUpperCase().match("PRICELIST")) {
        if (ProductNameL != "" && ProductNameL != null && ProductNameL != undefined) {
            SelectProductPrice(ProductNameL)
        }
    }
}

function SetReleaseNote() {
    if (window.location.href.toUpperCase().match("RELEASENOTES")) {


        document.getElementById("1").onclick();
    }
}

function StickMdlNav() {
    var MdlMenuL = $("#MdlNavMenu");
    $(window).scroll(function() {
        var OffsetL = 90;
        var DummyImgPostionL = DummyImgTopPosition();

        if (DummyImgPostionL < OffsetL) {
            MdlMenuL.addClass("stick");
            $('#ToggleFeatures').removeClass('shop-type-feature-stick');
            $('#ToggleFeatures').addClass("hide-on-small-display");
        }
        else {
            MdlMenuL.removeClass("stick");
            if (DummyImgPostionL < OffsetL) {
                $('#ToggleFeatures').removeClass('shop-type-feature-stick');
                $('#ToggleFeatures').addClass("hide-on-small-display");
            }
        }
    });
}

function DummyImgTopPosition() {
    if ($('#DummyImg').offset() != undefined) {
        var eTop = $('#DummyImg').offset().top;
        return eTop - $(window).scrollTop();
    }
}
function ToggelMdlNavbar() {
    if ($("#MdlNavMenu").hasClass('stick')) {
        if ($('#ToggleFeatures').hasClass('shop-type-feature-stick')) {
            $('#ToggleFeatures').removeClass('shop-type-feature-stick');
            $('#ToggleFeatures').addClass("hide-on-small-display");
        }
        else {
            $('#ToggleFeatures').removeClass("hide-on-small-display");
            $('#ToggleFeatures').addClass('shop-type-feature-stick');
        }
    }
    else {
        if ($('#ToggleFeatures').hasClass('hide-on-small-display')) {
            $('#ToggleFeatures').removeClass("hide-on-small-display");

        }
        else {
            $('#ToggleFeatures').addClass("hide-on-small-display");
        }
    }

}
function Initialize() {
    InitializePopOvers();
    AdjustSameHeights();
}


function AdjustSameHeights() {

    $('.box').matchHeight();
}

$(window).scroll(ManageTopnav);



var $animation_elements = $('.hd-scroll-animate');
var $window = $(window);
var count = 0;


function InitializePopOvers() {
    $('.thumb-img').on('shown.bs.popover', function() {
        RepositionPopOver(this);
    });

    $('.thumb-img').on('hide.bs.popover', function() {
        var $e = $(this);
        var PopOverL = $("#" + $e.data("popid"));
        $(PopOverL).css("visibility", "hidden");
        $(PopOverL).css("width", "");
    });

    $('.thumb-img').on('click', function() {
        $(this).popover('hide');
        return true;
    });

    $(".thumb-img").popover({
        trigger: 'hover',
        html: true,
        placement: function(context, source) {
            return "top";
        },

        template: "<div class=\"hd-pop col-lg-6 col-xl-4\" style=\"visibility:hidden;\"><div class=\"card\"><div class=\"card-header\"><h3 class=\"card-title popover-title\"></h3></div><div class=\"popover-content\"></div></div>",

        content: function() {
            var element = $(this);
            var HtmlL = "";
            var TitleL = element.attr("title");
            if (TitleL == undefined) {
                TitleL = "billing software";
            }
            var TooltipImageSrcL = element.attr("tooltip-img");
            HtmlL += "<img class=\"card-img-top img-fluid popup-img\" src=\"" + TooltipImageSrcL + "\" alt=\"" + TitleL + "\" onload=\"PopOverImageIsLoaded(this);\">";
            return HtmlL;
        },
        track: true
    });
}
function PopOverImageIsLoaded(obj) {
    //console.log("Pop over image is loaded");
    //console.log(obj);
    //console.log(obj.parentElement);
    //console.log(obj.parentElement.parentElement);
    //console.log(obj.parentElement.parentElement.parentElement);
    //console.log(obj.parentElement.parentElement.parentElement.parentElement);
    var $PopOverL = $(obj.parentElement.parentElement.parentElement);
    var PopOverParentIdL = $PopOverL.data("parentid");
    //console.log("PopOverParentIdL = \"" + PopOverParentIdL + "\"");
    if (PopOverParentIdL != undefined) {
        var AdjustedL = $PopOverL.data("adjusted");
        if (AdjustedL == "1") {
            //console.log("found adjusted to be 1");
            var HdTumbL = $("#" + PopOverParentIdL);
            //console.log(HdTumbL);
            //console.log("*************** calling re position again *************");
            RepositionPopOver(HdTumbL[0])
            $PopOverL.data("adjusted", "0");
            $PopOverL.removeAttr("data-parentid");
            //console.log("setting adusted to 0 and removed parent id");
        }
        //$PopOverL.data("imgloaded", "1");
    }
    //console.log("Setting image loaded to 1");
    $(obj).data("imgloaded", "1");
}

function RepositionPopOver(SourceP) {
    //console.log(" start of RepositionPopOver");
    var WWidthL = $window.width();
    var WHeightL = $window.height();
    var WLeftL = $window.scrollLeft();
    var WTopL = $window.scrollTop();
    var WRightL = (WLeftL + WWidthL);
    var WBottomL = ($window.scrollTop() + WHeightL);

    var $e = $(SourceP);

    var EWidthL = $e.outerWidth();
    var ELeftL = $e.offset().left;
    var ERightL = (ELeftL + EWidthL);
    var ETopL = $e.offset().top;
    var EBottomL = ETopL + $e.outerHeight();

    var XSpaceOnRightL = WRightL - ERightL;
    var XSpaceOnLeftL = ELeftL;

    var YSpaceOnTopL = ETopL - $window.scrollTop();


    var YSpaceOnBottomL = WBottomL - EBottomL;

    var PopOverListL = $('.hd-pop');
    var PopOverL = PopOverListL[PopOverListL.length - 1];

    $e.data("popid", PopOverL.id);

    var $PopOverL = $(PopOverL);
    $(SourceP).attr("id", PopOverL.id + "_parent");
    $PopOverL.data("parentid", SourceP.id);
    $PopUpImageL = $PopOverL.find(".popup-img");
    var ImgLoadedL = $PopUpImageL.data("imgloaded");
    if (ImgLoadedL != "1") {
        //console.log("found image loaded as \""+ImgLoadedL+"\"");    
        $PopOverL.data("adjusted", "1");
        //console.log("Setting adjusted to 1");
    }
    //console.log(SourceP);
    //console.log("parentid id as \""+SourceP.id+"\" set for");
    //console.log(PopOverL);

    var PopOverHeightL = $PopOverL.outerHeight();
    var PopOverWidthL = $PopOverL.outerWidth();
    var RatioL = PopOverWidthL / PopOverHeightL;

    var PlacementL = 'Right';
    var MaxAreaL = 0;
    var AreaL = 0;
    var FinalLeftL = 0;
    var FinalTopL = 0;
    var FinalWidthL = PopOverWidthL;
    var FinalHeightL = PopOverHeightL;

    var MaxWidthL = 600;
    var RWidthL = XSpaceOnRightL;
    if (RWidthL > MaxWidthL) {
        RWidthL = MaxWidthL;
    }
    var RHeightL = RWidthL / RatioL;
    if ((RHeightL + 10) > WHeightL) {
        RHeightL = WHeightL - 10;
        RWidthL = RHeightL * RatioL;
    }
    AreaL = RWidthL * RHeightL;
    if (AreaL > MaxAreaL) {
        MaxAreaL = AreaL;
        PlacementL = "Right";
        FinalWidthL = RWidthL;
        FinalHeightL = RHeightL;
        FinalLeftL = ERightL + 10;
        FinalTopL = ETopL - (FinalHeightL / 2);
    }

    var LWidthL = XSpaceOnLeftL;
    if (LWidthL > MaxWidthL) {
        LWidthL = MaxWidthL;
    }
    var LHeightL = LWidthL / RatioL;
    if ((LHeightL + 10) > WHeightL) {
        LHeightL = WHeightL - 10;
        LWidthL = LHeightL * RatioL;
    }
    AreaL = LWidthL * LHeightL;
    if (AreaL > MaxAreaL) {
        MaxAreaL = AreaL;
        PlacementL = "Left";

        FinalWidthL = LWidthL;
        FinalHeightL = LHeightL;
        FinalLeftL = ELeftL - (FinalWidthL + 10);
        FinalTopL = ETopL - (FinalHeightL / 2);
    }

    var THeightL = YSpaceOnTopL;
    var TWidthL = THeightL * RatioL;
    if (TWidthL > MaxWidthL) {
        TWidthL = MaxWidthL;
        THeightL = TWidthL / RatioL;
    }
    if ((TWidthL + 10) > WWidthL) {
        TWidthL = WWidthL - 10;
        THeightL = TWidthL / RatioL;
    }
    AreaL = TWidthL * THeightL;
    if (AreaL > MaxAreaL) {
        MaxAreaL = AreaL;
        PlacementL = "Top";

        FinalWidthL = TWidthL;
        FinalHeightL = THeightL;
        FinalTopL = ETopL - THeightL - 5;
        FinalLeftL = ELeftL + (EWidthL / 2) - (FinalWidthL / 2);
    }

    var BHeightL = YSpaceOnBottomL;
    var BWidthL = BHeightL * RatioL;
    if (BWidthL > MaxWidthL) {
        BWidthL = MaxWidthL;
        BHeightL = BWidthL / RatioL;
    }
    if ((BWidthL + 10) > WWidthL) {
        BWidthL = WWidthL - 10;
        BHeightL = BWidthL / RatioL;
    }
    AreaL = BWidthL * BHeightL;
    if (AreaL > MaxAreaL) {
        MaxAreaL = AreaL;
        PlacementL = "Bottom";

        FinalWidthL = BWidthL;
        FinalHeightL = BHeightL;
        FinalTopL = EBottomL + 10;
        FinalLeftL = (FinalWidthL / 2) + (EWidthL / 2); ;
    }

    if ((FinalLeftL + FinalWidthL) > WRightL) {
        FinalLeftL = WRightL - FinalWidthL;
    }
    if (FinalLeftL < 0) {
        FinalLeftL = 0;
    }

    if (FinalTopL + FinalHeightL > WBottomL) {
        FinalTopL = WBottomL - FinalHeightL;
    }

    if (FinalTopL < WTopL) {
        FinalTopL = WTopL;
    }
    //console.log(PlacementL);
    $PopOverL.css("transform", "");
    $PopOverL.css("left", FinalLeftL + "px");
    $PopOverL.css("top", FinalTopL + "px");
    $PopOverL.css("width", FinalWidthL + "px");
    $PopOverL.css("visibility", "visible");

    //console.log("end of RepositionPopOver");
}

function animate_if_in_view() {
    var window_height = $window.height();
    var window_top_position = $window.scrollTop();
    var window_bottom_position = (window_top_position + window_height);

    $.each($animation_elements, function() {
        var $element = $(this);

        var MinWidthReqL = $element.data("animation-minwidth");
        if (MinWidthReqL == undefined) {
            MinWidthReqL = "0";
        }
        var MinWidthReqValueL = parseInt(MinWidthReqL, 10);
        if (MinWidthReqValueL > 0) {
            var NumberOfColumnsL = $window.width() / $element.width();
            if (NumberOfColumnsL < MinWidthReqValueL) {
                return;
            }
        }

        var element_height = $element.outerHeight();
        var element_top_position = $element.offset().top;
        var element_bottom_position = (element_top_position + element_height);

        var animationType = $element.data("animation");
        var animationOn = $element.data("animation-on"); // needed to add this when animation causes the edge to fall out of scroll position and it causes the the animation restrart. //maintain the flag that the animation is on during the time do not touch animation classes
        if (animationOn == undefined) {
            animationOn = "0";
        }
        if (animationOn == "1") {
            return;
        }
        //check to see if this current container is within viewport
        if ((element_bottom_position >= window_top_position) && (element_top_position <= window_bottom_position)) {
            if ($element.hasClass('animated')) {
                return;
            }
            $element.data("animation-on", "1");
            $element.addClass('animated');
            $element.addClass(animationType);
            var animationRepeat = $element.data("animation-repeat");
            if (animationRepeat == "1") {
                setTimeout(function() { $element.data("animation-on", "0"); }, 2000);
            }
        }
        else {
            if (!$element.hasClass('animated')) {
                return;
            }
            $element.data("animation-on", "0");
            $element.removeClass('animated');
            $element.removeClass(animationType);
        }
    });
}

function auto_hrz_scroll_if_completely_in_view() {
    var window_height = $window.height();
    var window_top_position = $window.scrollTop();
    var window_bottom_position = (window_top_position + window_height);

    $.each($('.hd-hz-container'), function() {

        var $element = $(this);
        var element_height = $element.outerHeight();
        var element_top_position = $element.offset().top;
        var element_bottom_position = (element_top_position + element_height);

        var AutoScrollFlagL = $element.data("auto-scroll");
        if (AutoScrollFlagL == undefined) {
            AutoScrollFlagL = "1";
        }
        if (AutoScrollFlagL != "1") {
            //console.log("not auto scrolling " + $element.attr('id'));
            return;
        }


        //var ScrollInterval = $element.data("scrollTime");
        var AustoScrollOn = $element.data("scroll-on");
        if (AustoScrollOn == undefined) {
            AustoScrollOn = "0";
        }
        if ((element_bottom_position <= window_bottom_position) && (element_top_position >= window_top_position)) {
            if (AustoScrollOn == "1") {
                return;
            }
            $element.data("scroll-on", "1");
            //console.log("1-First");
            StartAutoScroll($element.attr('id'), true);
            //console.log("2-First");
        }
        else {
            //console.log("1-Second");
            if (AustoScrollOn != "1") {
                return;
            }
            //console.log("2-Second");
            $element.data("scroll-on", "0");
            StopAutoScroll($element.attr('id'));
        }
    });
}

var TimerStackList = {};

function ClearRunningTimersOnAutoScroll(HDivIdP) {
    var CurrentTimerStackL = null;
    CurrentTimerStackL = TimerStackList[HDivIdP];
    if (CurrentTimerStackL != undefined) {
        while (CurrentTimerStackL.length > 0) {
            var TimerL = CurrentTimerStackL.pop();
            clearTimeout(TimerL);
        }
    }
}

function StartAutoScroll(HDivIdP, FirstScrollP) {
    //console.log("auto scrolling " + HDivIdP);
    //debugger;
    var CurrentTimerStackL = null;
    CurrentTimerStackL = TimerStackList[HDivIdP];
    if (CurrentTimerStackL == undefined) {
        CurrentTimerStackL = new Array();
        TimerStackList[HDivIdP] = CurrentTimerStackL;
    }

    var $element = $("#" + HDivIdP);

    var AustoScrollOn = $element.data("scroll-on");
    if (AustoScrollOn == undefined) {
        AustoScrollOn = "0";
    }
    if (AustoScrollOn == "0") {
        return;
    }
    var HorzAutoScrollSpeedL = 0;
    if (!FirstScrollP)//do not wait for scroll time if it is the first scroll.
    {
        HorzAutoScrollSpeedL = GetScrollTime(HDivIdP);
    }

    var AutoScrollWaitTimeL = $element.data("auto-scroll-wait-time-per-100");
    if (AutoScrollWaitTimeL == undefined) {
        AutoScrollWaitTimeL = "400";
    }
    var AutoScrollWaitTimeValL = parseInt(AutoScrollWaitTimeL, 10);
    AutoScrollWaitTimeValL *= ($window.width() / 100);
    AutoScrollWaitTimeValL += HorzAutoScrollSpeedL;

    //console.log(AutoScrollTimeValL);

    // override time-per-100px with fixed time irrespecive of screen width
    var FixedAutoScrollWaitTimeValL = $element.data("auto-scroll-wait-time");
    if (FixedAutoScrollWaitTimeValL != undefined) {
        AutoScrollWaitTimeValL = parseInt(FixedAutoScrollWaitTimeValL, 10);
        AutoScrollWaitTimeValL += HorzAutoScrollSpeedL;
    }

    ClearRunningTimersOnAutoScroll(HDivIdP);

    var NewTimerL = setTimeout(function() {
        if ($("#" + HDivIdP).data("scroll-on") == "1") {
            ScrollHorz("right", HDivIdP, true, false);
            StartAutoScroll(HDivIdP, false);
        }
    }, AutoScrollWaitTimeValL);
    CurrentTimerStackL.push(NewTimerL);
    // console.log(HDivIdP+" timers count : " + CurrentTimerStackL.length);
}

function StopAutoScroll(HDivIdP) {
    $("#" + HDivIdP).data("scroll-on", "0");

    ClearRunningTimersOnAutoScroll(HDivIdP);
}

function HandleAnimationsOnScroll() {
    animate_if_in_view();
    auto_hrz_scroll_if_completely_in_view();
}

var LastWidthG = $(window).width();

$window.on('scroll resize', HandleAnimationsOnScroll);
$window.on('resize', reset_hrz_scroll);
$window.trigger('scroll');


function reset_hrz_scroll() {
    if (LastWidthG == $(window).width()) {
        return;
    }
    LastWidthG = $(window).width();
    $.each($('.hd-hz-col'), function() {
        var $element = $(this);

        $element.css({ left: 0 });
        //console.log($element.position());
        //$element.position().left = 0;
    });
}


function ScrollHorz(DirP, HorzDivIdP, AutoResetP, IsManualScrollP) {
    //console.log("scrolling " + HorzDivIdP + " in " + DirP);
    if (IsManualScrollP) {
        StopAutoScroll(HorzDivIdP);
    }
    var $HorzSectionL = $('#' + HorzDivIdP);
    var HorzSecWidthL = $HorzSectionL.outerWidth(true);

    var $FirstElementL = $('#' + HorzDivIdP + ' .hd-hz-col').first();
    var FirstLeftL = $FirstElementL.position().left;
    //var FirstWidthL = $FirstElementL.outerWidth(true);

    var LeftEdgeOfInterestOnRightL = -1;


    var CurrentCSSLeftL = $FirstElementL.css("left");
    var CurrentCssLeftValueL = parseInt(CurrentCSSLeftL, 10);
    if (CurrentCssLeftValueL == 0) {
        var ResetScollPositionsL = new Array();
        $FirstElementL.data("last-scroll", ResetScollPositionsL);
    }

    $.each($('#' + HorzDivIdP + ' .hd-hz-col'), function(i, obj) {
        var $element = $(this);
        var CurrentElementLeftL = $element.position().left;
        var CurrentElementWidthL = $element.width();

        //console.log("Total Width = " + HorzSecWidthL + " index = " + i + " element left = " + CurrentElementLeftL + " element width = " + CurrentElementWidthL);

        if ((CurrentElementLeftL + CurrentElementWidthL) > HorzSecWidthL) {
            //console.log(CurrentElementLeftL + " could be of interest on right");
            if (LeftEdgeOfInterestOnRightL == -1) {
                //console.log("Setting " + CurrentElementLeftL + " as of interest on right");
                LeftEdgeOfInterestOnRightL = CurrentElementLeftL;
            }
        }
    });


    var ScrollByL = 0;


    if (DirP == "right") {
        if (LeftEdgeOfInterestOnRightL == -1) {
            if (AutoResetP) {
                $.each($('#' + HorzDivIdP + ' .hd-hz-col'), function(i, obj) {
                    var $element = $(this);

                    $element.css({ left: 0 });
                });
            }
            return;
        }
        ScrollByL = FirstLeftL - LeftEdgeOfInterestOnRightL;


        var CSSLeftL = $FirstElementL.css("left");

        var LastScollPositionsL = $FirstElementL.data("last-scroll");
        if (LastScollPositionsL == undefined) {
            LastScollPositionsL = new Array();
        }
        LastScollPositionsL.push(CSSLeftL);
        $FirstElementL.data("last-scroll", LastScollPositionsL);
    }
    else {
        var LastScollPositionsL = $FirstElementL.data("last-scroll");
        if (LastScollPositionsL == undefined) {
            return;
        }
        if (LastScollPositionsL.length == 0) {
            return;
        }
        var LastCSSLeftL = LastScollPositionsL.pop();

        var LastLeftValueL = parseInt(LastCSSLeftL, 10);
        ScrollByL = LastLeftValueL;
    }

    var HorzAutoScrollSpeedL = 1000;
    var ScrollTimeManualValL = -1;

    if (IsManualScrollP) {
        var $element = $("#" + HorzDivIdP);
        var ScrollTimeManualL = $element.data("scroll-time-manual");
        if (ScrollTimeManualL != undefined) {
            ScrollTimeManualValL = parseInt(ScrollTimeManualL, 10);
            HorzAutoScrollSpeedL = ScrollTimeManualValL;
        }
    }
    if (ScrollTimeManualValL == -1) {
        HorzAutoScrollSpeedL = GetScrollTime(HorzDivIdP);
    }


    var ScrollAnimationL = $HorzSectionL.data("scroll-animmation");
    if (ScrollAnimationL == undefined) {
        ScrollAnimationL = "swing";
    }


    //console.log("Setting left as " + ScrollByL);
    $.each($('#' + HorzDivIdP + ' .hd-hz-col'), function(i, obj) {
        var $element = $(this);

        console.log(ScrollByL);
        $element.animate(
                            {
                                left: [ScrollByL, ScrollAnimationL]
                            }, HorzAutoScrollSpeedL);
    });
}

function GetScrollTime(HorzDivIdP) {
    var $element = $("#" + HorzDivIdP);
    var ScrollTime100L = $element.data("scroll-time-per-100");
    if (ScrollTime100L == undefined) {
        ScrollTime100L = "100";
    }
    var ScrollTimeValL = parseInt(ScrollTime100L, 10);
    ScrollTimeValL *= ($window.width() / 100);


    var ScrollTimeMinL = $element.data("scroll-time-min");
    if (ScrollTimeMinL != undefined) {
        var ScrollTimeMinValL = parseInt(ScrollTimeMinL, 10);
        if (ScrollTimeValL < ScrollTimeMinValL) {
            ScrollTimeValL = ScrollTimeMinValL;
        }
    }
    var ScrollTimeMaxL = $element.data("scroll-time-max");
    if (ScrollTimeMaxL != undefined) {
        var ScrollTimeMaxValL = parseInt(ScrollTimeMaxL, 10);
        if (ScrollTimeValL > ScrollTimeMaxValL) {
            ScrollTimeValL = ScrollTimeMaxValL;
        }
    }
    // override time-per-100px with fixed time irrespecive of screen width
    var ScrollTimeL = $element.data("scroll-time");
    if (ScrollTimeL != undefined) {
        ScrollTimeValL = parseInt(ScrollTimeL, 10);
    }
    return ScrollTimeValL;
}
function ScrollToAnchor(AnchorP) {
    var topoffsetL = 80;
    if (screen.width < 992) {
        topoffsetL = 170;
    }
    if ($("#" + AnchorP).length > 0) {
        $('html, body').animate(
                            {
                                scrollTop: [($("#" + AnchorP).offset().top - topoffsetL), "swing"]
                            }, 1250);
    }

}

function ScrollToAnchorPriceList(AnchorP) {
    var topoffsetL = 80;
    if (screen.width < 992) {
      topoffsetL = 0;
    }
    if ($("#" + AnchorP).length > 0) {
        $('html, body').animate(
                            {
                                scrollTop: [($("#" + AnchorP).offset().top - topoffsetL), "swing"]
                            }, 1250);
    }

}



function ScrollToAnchorNoAnimate(AnchorP) {

    var topoffsetL = 80;
    if (screen.width < 992) {
        topoffsetL = 170;
    }

    window.scrollTo(0, ($("#" + AnchorP).offset().top - topoffsetL));

}



function SToAInShopType(AnchorP) {

    $('#ToggleFeatures').removeClass('shop-type-feature-stick');
    $('#ToggleFeatures').addClass("hide-on-small-display");
    $('html, body').animate(
                            {
                                scrollTop: [($("#" + AnchorP).offset().top - 140), "swing"]
                            }, 1250);
}


function ManageTopnav() {

    var height = $(window).scrollTop();
    if (height > 50) {
        MakeTopNavDark();
    }
    else {
        MakeTopNavTranparent();
    }

    var ShowScrollUpBtnL = false;
    var $ScrollLimitL = $("#ScrollLimit");

    if (height > ($ScrollLimitL.offset().top - 110)) {
        ShowScrollUpBtnL = true;
    }
    if (ShowScrollUpBtnL) {
        document.getElementById('ScrollUpBtn').style.display = "block";
    }
    else {
        document.getElementById('ScrollUpBtn').style.display = "none";
    }
}
function MakeTopNavDark() {
    $('.top-nav').addClass("bk-solid");
}
function MakeTopNavTranparent() {
    $('.top-nav').removeClass("bk-solid");
}

function ToggelNavbar(navbarid) {
    var ClassListL = document.getElementById(navbarid).classList;
    if (ClassListL.contains("hide-on-small-display")) {
        ClassListL.remove("hide-on-small-display");
    }
    else {
        ClassListL.add("hide-on-small-display");
    }
}

function LockOn() {
    $("#shadow").css("display", "block");
    $('#shadow').removeClass('LockOff');
    $('#shadow').addClass('LockOn');
}
function LockOff() {
    $("#shadow").css("display", "none");
    $('#shadow').removeClass('LockOn');
    $('#shadow').addClass('LockOff');
}
////////// Demo Request Validation///////////////////
function ValidateRequestForDemo() {
    if (!($('#DemoModal').hasClass('in'))) {
        return;
    }

    var NameValueL = DemoRequesterNameL.value;
    var ValueL = NameValueL.replace(/^\s*/, "").replace(/\s*$/, ""); //trim
    if (ValueL == "") {
        HDMessageBox.ShowSimpleMessage("Please enter your name.");
        return false;
    }
    PhoneValueL = DemoRequesterPhoneNumberL.value;
    ValueL = PhoneValueL.replace(/^\s*/, "").replace(/\s*$/, ""); //trim
    if (ValueL == "") {
        HDMessageBox.ShowSimpleMessage("Please enter your phone number.");
        return false;
    }

    CityValueL = DemoRequesterCityL.value;
    ValueL = CityValueL.replace(/^\s*/, "").replace(/\s*$/, ""); //trim
    if (ValueL == "") {
        HDMessageBox.ShowSimpleMessage("Please enter your city name.");
        return false;
    }
    return true;
}

function ValidateCallBackRequest() {
    if (!($('#CallBackModal').hasClass('in'))) {
        return;
    }

    var NameValueL = CallBackRequesterNameL.value;
    ValueL = NameValueL.replace(/^\s*/, "").replace(/\s*$/, ""); //trim
    if (ValueL == "") {
        HDMessageBox.ShowSimpleMessage("Please enter your name.");
        return false;
    }
    PhoneValueL = CallBackRequestPhoneNumberL.value;
    ValueL = PhoneValueL.replace(/^\s*/, "").replace(/\s*$/, ""); //trim
    if (ValueL == "") {
        HDMessageBox.ShowSimpleMessage("Please enter your phone number.");
        return false;
    }

    CityValueL = CallBackRequestCityL.value;
    ValueL = CityValueL.replace(/^\s*/, "").replace(/\s*$/, ""); //trim
    if (ValueL == "") {
        HDMessageBox.ShowSimpleMessage("Please enter your city name.");
        return false;
    }
    return true;
}

function GetQueryStringFieldList() {
    var query = window.location.search.substring(1);
    var args = new Object();
    var QueryStringL = query.split("&");
    for (var i = 0; i < QueryStringL.length; i++) {
        var pos = QueryStringL[i].indexOf('=');
        if (pos > 0) {
            var key = QueryStringL[i].substring(0, pos);

            var val = QueryStringL[i].substring(pos + 1);
            key = key.toUpperCase();
            args[key] = unescape(val);
        }
    }
    return args;
}

function CopyLink() {
    $('#txtShareLink').select();
}

function ValidateDealerShipForm() {
   
    if (!($('#DealerShipModal').hasClass('in'))) {
        return;
    }
    var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
    var DealerShipRequesterNameL = DealerNameL.value.replace(/^\s*/, "").replace(/\s*$/, "");
    var DealerShipRequesterEmailL = DealerEmailL.value.replace(/^\s*/, "").replace(/\s*$/, "");
    var DealerShipRequesterPhNoL = DealerPhoneNumberL.value.replace(/^\s*/, "").replace(/\s*$/, "");
    var DealerShipRequesterCityL = DealerCityL.value.replace(/^\s*/, "").replace(/\s*$/, "");
    var DealerShipRequesterAddressL = DealerAddressL.value.replace(/^\s*/, "").replace(/\s*$/, "");
    var DealerShipRequesterCountryL = DealerCountryL.value.replace(/^\s*/, "").replace(/\s*$/, "");

    if (DealerShipRequesterNameL == "") {
        HDMessageBox.ShowSimpleMessage("Enter Name !");
        return false;
    }
    else if (DealerShipRequesterEmailL == "") {
        HDMessageBox.ShowSimpleMessage("Enter Email Id !");
        return false;
    }
    else if (pattern.test(DealerShipRequesterEmailL)) {
    }
    else {
        HDMessageBox.ShowSimpleMessage("Email Address is not in Standard format.");
        return false;
    }
    if (DealerShipRequesterPhNoL == "") {
        HDMessageBox.ShowSimpleMessage("Enter Phone Number !");
        return false;
    }
    else if (DealerShipRequesterAddressL == "") {
        HDMessageBox.ShowSimpleMessage("Enter Address !");
        return false;
    }
    else if (DealerShipRequesterCityL == "") {
        HDMessageBox.ShowSimpleMessage("Enter City !");
        return false;
    }
    else if (DealerShipRequesterCountryL == "") {
        HDMessageBox.ShowSimpleMessage("Enter Country !");
        return false;
    }
    else {
        return true;
    }
}
