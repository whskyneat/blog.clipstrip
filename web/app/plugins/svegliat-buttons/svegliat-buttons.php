<?php
/*
Plugin Name: SvegliaT Buttons
Plugin URI: http://www.svegliatemplate.com/wordpress-svegliat-buttons/
Description: Add a shortcode in your wordpress to visualize nice and colored buttons.
Version: 1.2.0
Author: Mario Di Pasquale
Author URI: http://www.svegliadesign.com
*/

// Admin page
function stb_control_page()
{
    ?>
    <h1><a href="http://www.svegliatemplate.com/wordpress-buttons-svegliat-buttons/">SvegliaT buttons</a></h1>
    <script type="text/javascript">
            window.onload = function() {
			     document.getElementById("myButton").onclick = function() {
				 var testoButton = document.getElementById("testo").value; 
				 var testoTitolo = document.getElementById("titolo").value;
				 var testoLink = document.getElementById("link").value;
				 var color = document.getElementById("normalButton").value;   							
				 var colorCode = ('[button-' + color + ' text="' + testoButton + '" title="' + testoTitolo + '" url="' + testoLink + '"]');
				 document.getElementById('mostraCodice').innerHTML= colorCode;
				 document.getElementById("svegliaCode").reset();	 
				 }
				 
				 
				
            }
        </script>
        <p>WordPress buttons – SvegliaT buttons - SvegliaT buttons is a simple plug in for WordPress thanks to it you’ll be able to insert in your text, posts, or site’s pages, colored buttons using shortcode.</p>

<p>WordPress Buttons created with CSS3 can automatically adapt to every text length. At the moment is possible to use two kind of buttons, normal and big, every of them is available in eight different colors: orange, yellow, gray, green, blue, black, pink, purple and red.</p>
<?php
echo '<img src="' . plugins_url( 'admin-images/wordpress-st-buttons.png' , __FILE__ ) . '" > ';
?>
<p>All WordPress buttons have three different colors meaning their three different possible states, stand by, hover, hit.</p>

<p><strong>Once installed the plug in is very easy to add the button using following code:</strong></p>
<p><code>[button-orange text="Download plugin" title="Sveglia template" url="http://www.svegliatemplate.com/"]</code></p>
<ul>
<li><strong>Colour – </strong>you can change the orange colour with: red, blue, pink, black, yellow, green, purple e gray.</li>

<li><strong>Text – </strong>Instead of text Download plugin you can write what you want, but be careful to do not forget the quotation marks, such text will be displayed in the button.</li>

<li><strong>Title – </strong>This tag is similar to ALT tag of images, the text you’ll insert here won’t be visualized, but it’s useful for SEO scope.</li>

<li><strong>url – </strong>Obviously this is the destination link.</li>
</ul>

<p>It is possible to add a sample shortcode using directly the text editor button. Once pushed the button you just need to change actual parameters with your one.</p>
<?php
echo '<img src="' . plugins_url( 'admin-images/button-editor.jpg' , __FILE__ ) . '" > ';
?>

<p>Alternatively, you can use the code generator.</p> 

<h2>Code generator</h2>

<form name="svegliaCode" id="svegliaCode"> 
  Enter the text to display on the button: <input type="text" name="testo" id="testo" /><br /><br />
Enter link title (TAG title): <input type="text" name="titolo" id="titolo" /><br /><br />
Enter the link (URL): <input name="link" type="text" id="link" value="http//:" /><br /><br />
Select color:<select name="normal-button" id="normalButton">
    <option value="green">green</option>
    <option value="blu">blu</option>
    <option value="red">red</option>
    <option value="orange">orange</option>
    <option value="gray">gray</option>
    <option value="yellow">yellow</option>
    <option value="black">black</option>
    <option value="pink">pink</option>
    <option value="purple">purple</option>
  </select>

  
  <br /><br />
<input id="myButton" type="button" class="button button-primary" value="Generate shortcode"/>
 <br /><br />
<textarea id="mostraCodice" name="codiceMostrato" cols="70" rows="5"></textarea>
 <br /><br />

 </form> 
    <?php
}
function stb_add_option_page()
{
    add_menu_page('SvegliaT Buttons', 'SvegliaT Buttons', 'administrator', 'svegliatbuttons-options-page', 'stb_control_page', plugins_url( 'svegliat-buttons/admin-images/menu_icon.png' ));
}

add_action('admin_menu', 'stb_add_option_page');
// End Admin page
add_action( 'wp_enqueue_scripts', 'svegliat_add_my_stylesheet' );

   
function svegliat_add_my_stylesheet() {
       
        wp_register_style( 'svegliat-buttons', plugins_url('stylebuttons.css', __FILE__) );
        wp_enqueue_style( 'svegliat-buttons' );
    }

 
// PURPLE BUTTON

function buttonpurple_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_purple" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('button-purple', 'buttonpurple_func');

// ORANGE BUTTON

function buttonorange_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_orange" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('button-orange', 'buttonorange_func');

// GREEN BUTTON
 
function buttongreen_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_green" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('button-green', 'buttongreen_func');

// BLU BUTTON
 
function buttonblu_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_blu" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('button-blu', 'buttonblu_func');

// GRAY BUTTON
 
function buttongray_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_gray" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('button-gray', 'buttongray_func');

// BLACK BUTTON
 
function buttonblack_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_black" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('button-black', 'buttonblack_func');

// RED BUTTON
 
function buttonred_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_red" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('button-red', 'buttonred_func');

// PINK BUTTON
 
function buttonpink_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_pink" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('button-pink', 'buttonpink_func');

// YELLOW BUTTON
 
function buttonyellow_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_yellow" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('button-yellow', 'buttonyellow_func');


// ORANGE BIG BUTTON

function buttonorangbig_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_orangebig" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('bigbutton-orange', 'buttonorangbig_func');

// GREEN BIG BUTTON
 
function buttongreenbig_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_greenbig" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('bigbutton-green', 'buttongreenbig_func');

// YELLOW BIG BUTTON
 
function buttonyellowbig_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_yellowbig" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('bigbutton-yellow', 'buttonyellowbig_func');

// PINK BIG BUTTON
 
function buttonpinkbig_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_pinkbig" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('bigbutton-pink', 'buttonpinkbig_func');

// BLACK BIG BUTTON
 
function buttonblackbig_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_blackbig" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('bigbutton-black', 'buttonblackbig_func');

// RED BIG BUTTON
 
function buttonredbig_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_redbig" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('bigbutton-red', 'buttonredbig_func');

// BLU BIG BUTTON
 
function buttonblubig_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_blubig" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('bigbutton-blu', 'buttonblubig_func');

// GRAY BIG BUTTON
 
function buttongraybig_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_graybig" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('bigbutton-gray', 'buttongraybig_func');

// PURPLE BIG BUTTON
 
function buttonpurplebig_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Bottone', 'st-buttons'),
	    'title' => '',
	    'url' => '#',
    ), $atts));
    
    $html = '
		<div class="st-buttons"><a class="stbutton_purplebig" href="'.$url.'" title="'.$title.'">'.do_shortcode($text).'</a></div>';
    return $html;
}
add_shortcode('bigbutton-purple', 'buttonpurplebig_func');

// BUTTON ON EDITOR ----------------------------------

add_action('init', 'mylink_button');

function mylink_button() {

if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {

return;

}

if ( get_user_option('rich_editing') == 'true' ) {

add_filter( 'mce_external_plugins', 'add_plugin' );

add_filter( 'mce_buttons', 'register_button' );

}

}

function register_button( $buttons ) {

array_push( $buttons, "|", "tinymcebut" );

return $buttons;

}

function add_plugin( $plugin_array ) {

$plugin_array['tinymcebut'] = get_bloginfo( 'url' ) . '/wp-content/plugins/svegliat-buttons/js/tinymcebut.js';

return $plugin_array;

}
?>