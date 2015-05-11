<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> 
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=10" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action('vantage_before_page_wrapper') ?>

<div id="page-wrapper">


<!-- New Header -->
<div class="header-out-home" id="AutoNumber1">
    <div class="header-home">
        <div class="header-main-home">
            <div class="fl">
                <h1 class="logo-hm"><a href="http://www.elementwheels.com/" title="Custom &amp; Aftermarket Wheels, Wheel Tire Packages, Rims &amp; More! | BMW, Lexani, Mercedes &amp; Other Leading Brands | Element Wheels"></a></h1>
                <div class="clr"></div>
                <form name="tsearch" method="post" action="../vehiclesearch.asp">
                    <div class="srch-box-home">
                        <input type="hidden" name="posted" value="1">
                        
                        <input name="stext" size="13" class="txt-fld01">
                        
                        <a href="javascript: document.tsearch.submit()" class="srch-btn"></a>                        
                    </div>
                </form>
            </div>
            <div class="call">
                
                <div class="phns">
                    <div class="phn01">Call <span>800-242-9883</span><br>
						<a href="javascript:void(0)">
	                        <img src="http://www.elementwheels.com/images/live-chat.png" onclick="window.open('http://a3.websitealive.com/1212/rRouter.asp?groupid=1212&amp;websiteid=0&amp;departmentid=1475&amp;dl='+escape(document.location.href),'','width=400,height=400');" alt="Chat">
                        </a>
					</div>
                    
                    <!-- <div class="phn02">Para Espa&ntilde;ol<span>480-921-3622</span></div> -->
                    <div class="clr"></div>
                </div>
                <div class="cart-txt">
                    FREE SHIPPING ON ORDERS OVER $100<br>
                    In the 48 Contiguous United States
                </div>
            </div>
            <div class="clr"></div>
        </div>
    </div>
</div>
<!-- New nav -->
<div class="nav-out" id="AutoNumber2">
    <div class="nav">
        <ul>
            <li><a href="http://www.elementwheels.com/">Home</a></li>
            <li><a href="http://www.elementwheels.com/about.asp">About Us</a></li>
            <li><a href="http://www.elementwheels.com/categories.asp?cat=2243">Gallery</a></li>
            <li><a href="http://www.elementwheels.com/faq.asp">Tech FAQ's </a></li>
            <li><a href="http://www.elementwheels.com/contact.asp">Contact Us</a></li>
            <li><a target="_blank" href="http://elementwheels.hitsubmit.co/" class="rss">Blog</a></li>
        </ul>

        
        <div class="cart" id="divcartinfo" style="width: 200px !important;">
            <h2><a href="http://www.elementwheels.com/cart.asp" id="acartinfo">My Cart - No Items</a></h2>
        </div>
        
    </div>
    <div class="clr"></div>
</div>
<!-- End New header and nav-->


	<?php //do_action( 'vantage_before_masthead' ); ?>

	<?php //get_template_part( 'parts/masthead', apply_filters( 'vantage_masthead_type', siteorigin_setting( 'layout_masthead' ) ) ); ?>

	<?php //do_action( 'vantage_after_masthead' ); ?>

	<?php vantage_render_slider() ?>

	<?php do_action( 'vantage_before_main_container' ); ?>

	<div id="main" class="site-main">
		<div class="full-container">
			<?php do_action( 'vantage_main_top' ); ?>