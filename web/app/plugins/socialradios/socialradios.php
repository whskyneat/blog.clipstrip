<?php
/*  Copyright 2013 -2014 SocialRadios  (email : info@socialradios.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/*
Plugin Name: SocialRadios.net
Plugin URI: http://socialradios.net
Description: HTML5 Radio stations player with Social Media by SocialRadios.net
Author: Roberto Gomez
Version: 1.22
Proudly done in Palo Alto, California and Madrid.
*/


// We're putting the plugin's functions inside the init function to ensure the
// required Sidebar Widget functions are available.

// 46 countries. Contact info@socialradios.net to be listed, unlisted in this plugin.

if ( get_option('socialradios_ajax') == 1 ) {
	include('config.php');
}
 	

  $COUNTRIES = Array ( 
	'dz'=> 'algeria', 
	'ar' => 'argentina',
	'au' => 'australia',
	'be' => 'belgium',
	'bd'=> 'bangladesh',
	'br' => 'brazil',
	'cl' => 'chile', 
	'ca' => 'canada',
	'cat' => 'catalonia',
	'cn' => 'china',
	'co' => 'colombia', 
	'eg' => 'egypt', 
	'ec' => 'ecuador', 
	'fi' => 'finland',
	'fr' => 'france', 
	'de' => 'germany',
	'gr' => 'greece',
	'ib' => 'ibiza',
	'il' => 'israel',
	'in' => 'india', 
	'id' => 'indonesia', 
	'it' => 'italy', 
	'jp' => 'japan', 
	'kr' => 'korea republic of',
	'lb' => 'lebanon', 
	'lu' => 'luxembourg',
	'mx' => 'mexico',
	'ma' => 'morocco', 
	'no' => 'norway', 
	'py'=> 'paraguay', 
	'pt' => 'portugal', 
	'pl' => 'poland',
	'ro' => 'romania', 
	'ru' => 'russian federation', 
	'es' => 'spain', 
	'se' => 'sweden', 
	'ch' => 'switzerland',
	'za' => 'south africa',
	'sy' => 'syria',
	'tr' => 'turkey',
	'ua' => 'ukraine', 
	'uk' => 'united kingdom', 
	'usa' => 'usa',
	'usa-es' => 'usa latino', 
	'ae' => 'united arab emirates', 
	've' => 'venezuela');




				

  $LANGUAGES = Array ( 
  	'en' => 'English',
  	'pt' => 'Portuguese',
  	'es' => 'Spanish',
  	'cat' => 'Catalan',
  	'ar' => 'Arabic',
  	'cn' => 'Chinese',
  	'fr' => 'France',
  	'de' => 'German',
  	'gr' => 'Greek',
  	'it' => 'Italian',
  	'id' => 'Indonesian',
  	'in' => 'Hindi',
  	'no' => 'Norwegian',
  	'ru' => 'Russian',
  	'fi' => 'Suomi',
  	'tr' => 'Turkish',
  	'jp' => 'Japanese',
  	'kr' => 'Korean',
  	'ro' => 'Romanian',
  	'ua' => 'Ukrainian',
  	'pl' => 'Polish',
  	'bn' => 'Bengali'
  	

  	);

  function widget_socialradios_init() 
	  {
	  /* Your custom code starts here */
	  /* ---------------------------- */
	  
	  function unique_id($l = 8) {
		    return substr(md5(uniqid(mt_rand(), true)), 0, $l);
	  }

	  /* Your Function */
	  function socialradios($theme,$country,$size,$language,$links,$volume,$stations)
	  {
		$country_param = '';
	  	$size_param = "&size=normal";
	  	$theme_param = '&theme=light';
	  	
	  	if($country != ''){
	  		$country_param = "&country=" . $country;
	  	}

	  	if($language != ''){
	  		$language_param = "&language=" . $language;
	  	}

	  	if($size != ''){
	  		$size_param = "&size=" . $size;	
		}

	  	if($theme != ''){
	  		$theme_param = "&theme=" . $theme;	
		}
		$new_api = '&api_folder=backend/api_for_sticky.php';
		
		
		$position_fixed = get_option ('socialradios_fixed');
		if ( $position_fixed == 1) {
			$height = 34;
			$position_param = '&pos=sticky';
		} else if ($links!=1 && $volume!=1) {
			$height = 34;
			$position_param = '&pos=widget';
		} else {
			$height = 68;
			$position_param = '&pos=widget';
		}
		// if (get_option('socialradios_ajax') == 1) {
			
			
		// } else {
			// $height = 26;
		// }

		if (get_option('socialradios_autoplay') == 1) {
			$autoplay = '?autoplay=true';
		} else {
			$autoplay = '?autoplay=false';
		}

		if ($links == 1) {
			$links_param = '&social=true';
		} else {
			$links_param = '&social=false';
		}
		
		if ($volume == 1) {
			$volume_param = '&volume=true';
		} else {
			$volume_param = '&volume=false';
		}
		
		$position_fixed = get_option ('socialradios_fixed');
		if ( $position_fixed == 1) {
			$width='80%';
		} else {
			$width='100%';
		}
		
		//$stations = get_option ('socialradios_stations');
		if ( $stations == 1) {
			$stations_param='&stations=true';
		} else {
			$stations_param='&stations=false';
		}
		//echo 'st='.get_option ('socialradios_stations');
		
	  	$uniqid = "&id=" . unique_id();
		
		
		
		  /* Your Code ----------------- */ 
		  echo ' <iframe id="player_iframe" scrolling="no" src="http://socialradios.com/widget/'.$autoplay.$language_param.$new_api.$country_param.$theme_param.$size_param.$uniqid.$links_param.$volume_param.$position_param.$stations_param.'" frameborder="0" width="'.$width.'" height="'.$height.'"></iframe>';
		  

			if ( get_option('socialradios_ajax') == 1 ) {
			

			global $wp_scripts;
			//$scripts = [];
			$scripts = array();
			foreach ($wp_scripts->registered as $script_name => $script_details) {
				
				foreach ($script_details as $key => $value) {
					if ($key=='src') {
						//echo 'src='.$value.'<br/>';
						//echo wp_get_theme();
						$pos = strpos($value, '/wp-content/themes/');
						$pos1 = strpos($value, '/wp-content/plugins/');
						if($pos || $pos1) {
							echo '<script>scriptc("'.$value.'")</script>';
							$scripts[] = $value;
						}
					}
					//var_dump($value);
				}
			}
			$comma_separated = implode(",", $scripts);
			//var_dump($scripts);

			  echo "<script>
					var $ = jQuery;
			  		$(document).ready(function() {
						var $ = jQuery;
						var hash = window.location.hash.substring(1);
						var  src = $('#player_iframe').attr('src');
						if (hash)
						$('#player_iframe').attr('src', src+'#'+hash);
			  			$(document).on('click', 'a', function(event) {
							var handler = $(this);
							
							if ( $(this).attr('href') != '#' )  prevent_event_handler(handler, event, '".$comma_separated."');
							//alert('test event='+event);
							event.preventDefault();
						});

							if ($('#socialradios').data('position') == 'top') {
								var padding = $('body').css('padding-top');
								if (padding=='0px') {
									var padding = $('html').css('margin-top');
								}
								
								$('#socialradios').css('top', padding);
								
								//console.log($('#socialradios').data('position'));
								
								padding = parseInt(padding)+34;
								$('body').css('padding-top', padding+'px');
							} else {
								$('body').css('padding-bottom', '34px');
							}



					});
					</script>"; 
			}


			
		    //echo file_get_contents('http://socialradios.com/widget/?autoplay=false'.$country_param.$theme_param.$size_param.$uniqid);




		  /* End of Your Code ---------- */
		  
	  }
	  
	  /* -------------------------- */
	  /* Your custom code ends here */
	  
	  function widget_socialradios($args) 
	  {
	  

	  	  // Collect our widget's options, or define their defaults.
		  $options = get_option('widget_socialradios');
		  $title = empty($options['title']) ? __('SocialRadios') : $options['title'];
		  $country = empty($options['country']) ? '' : $options['country'];
		  $language = empty($options['language']) ? '' : $options['language'];
		  $theme = empty($options['theme']) ? '' : $options['theme'];
		  $size = empty($options['size']) ? '' : $options['size'];
		  $social = empty ($options['links']) ? 'false' : $options['links'];
		  $volume = empty ($options['volume']) ? 'false' : $options['volume'];
		  $stations = empty ($options['stations']) ? 'false' : $options['stations'];

		  extract($args);
		  echo $before_widget;
		  echo $before_title;
		  echo $title;
		  echo $after_title;
		  socialradios($theme,$country,$size,$language,$social,$volume, $stations);
		  echo $after_widget;
	  }  
	  
	  // This is the function that outputs the form to let users edit
	  // the widget's title. It's an optional feature, but were're doing 
	  // it all for you so why not!
	  
	  function widget_socialradios_control()
	  {

		global  $COUNTRIES;
		global  $LANGUAGES;
     	

		// Collect our widget options.
		$options = $newoptions = get_option('widget_socialradios');
		
		// This is for handing the control form submission.
		if ( $_POST['widget_socialradios-submit'] ) 
		{
			// Clean up control form submission options
			$newoptions['title'] = strip_tags(stripslashes($_POST['widget_socialradios-title']));
			$newoptions['country'] = strip_tags(stripslashes($_POST['widget_socialradios-country']));
			$newoptions['language'] = strip_tags(stripslashes($_POST['widget_socialradios-language']));
			$newoptions['theme'] = strip_tags(stripslashes($_POST['widget_socialradios-theme']));
			$newoptions['size'] = strip_tags(stripslashes($_POST['widget_socialradios-size']));
			$newoptions['links'] = strip_tags(stripslashes($_POST['widget_socialradios-links']));
			$newoptions['volume'] = strip_tags(stripslashes($_POST['widget_socialradios-volume']));
			$newoptions['stations'] = strip_tags(stripslashes($_POST['widget_socialradios-stations']));
		}


				
		// If original widget options do not match control form
		// submission options, update them.
		if ( $options != $newoptions ) 
		{
			$options = $newoptions;
			update_option('widget_socialradios', $options);
		}
						
		$title = attribute_escape($options['title']);
		$country = attribute_escape($options['country']);
		$language = attribute_escape($options['language']);
		$theme = attribute_escape($options['theme']);
		$size = attribute_escape($options['size']);
		$links = attribute_escape($options['links']);
		$volume = attribute_escape($options['volume']);
		$stations = attribute_escape($options['stations']);
		if ($language!='') {
			$attr_disabled="disabled:'disabled'";
		}

		echo '<p><label for="socialradios-title">';
		echo 'Title: <input style="width: 200px;" id="widget_socialradios-title" name="widget_socialradios-title" type="text" value="';
		echo $title;
		echo '" />';
		echo '</label></p>';




		echo '<p><label for="socialradios-language">';
		echo 'Language radio: <br/>'; 

		echo '<select style="width: 200px;" name="widget_socialradios-language" id="widget_socialradios-language">';
		echo '<option value="">--- not set ---</option>';
		foreach ($LANGUAGES as $key => $value) {
			echo '<option value="'.$key.'" '.(($key == $language) ? "selected=''":"").'>'.ucfirst($value).'</option>';
		}
		echo '</select>';
		echo '</label></p>';	




		
		echo '<p><label for="socialradios-country">';
		echo 'Country radio: <br/>'; 
		
		echo '<select style="width: 200px;" name="widget_socialradios-country" id="widget_socialradios-country" '.$attr_disabled.'>';
		foreach ($COUNTRIES as $key => $value) {
			echo '<option value="'.$key.'" '.(($key == $country) ? "selected=''":"").'>'.ucfirst($value).'</option>';
		}
		echo '</select>';
		echo '</label></p>';






		echo '<p><label for="socialradios-theme">';
		echo 'Player theme: <br/>'; 
		
		echo '<select style="width: 200px;" name="widget_socialradios-theme" id="widget_socialradios-theme">';
		echo '<option value="light" '.(('light' == $theme) ? "selected=''":"").'>Light</option>';
		echo '<option value="dark" '.(('dark' == $theme) ? "selected=''":"").'>Dark</option>';
		echo '</select>';

		echo '</label></p>';

		
		
		echo '<p><label for="socialradios-links">';
		echo 'Enable social links: <br/>'; 
		?><input type="checkbox" style="width: 200px;" name="widget_socialradios-links" id="widget_socialradios-links" value="1" <?=checked($links, 1)?> /><?php

		echo '</label></p>';
		
		echo '<p><label for="socialradios-volume">';
		echo 'Enable volume controller: <br/>'; 
		?><input type="checkbox" style="width: 200px;" name="widget_socialradios-volume" id="widget_socialradios-volume" value="1" <?=checked($volume, 1)?> /><?php

		echo '</label></p>';
		
		echo '<p><label for="socialradios-stations">';
		echo 'Enable stations controller: <br/>'; 
		?><input type="checkbox" style="width: 200px;" name="widget_socialradios-stations" id="widget_socialradios-stations" value="1" <?=checked($stations, 1)?> /><?php

		echo '</label></p>';
		
		// echo '<p><label for="socialradios-size">';
		// echo 'Size: <br/>'; 
		
		// echo '<select style="width: 200px;" name="widget_socialradios-size" id="widget_socialradios-size">';
		// echo '<option value="normal" '.(('normal' == $size) ? "selected=''":"").'>Normal</option>';
		// echo '<option value="large" '.(('large' == $size) ? "selected=''":"").'>Large</option>';
		// echo '<option value="26px" '.(('26px' == $size) ? "selected=''":"").'>26px</option>';
		// echo '</select>';

		// echo '</label></p>';		
		echo '<input type="hidden" id="widget_socialradios-submit" name="widget_socialradios-submit" value="1" />';


		?>
		<script>

			jQuery(document).ready(function() {
				// console.log('test');

				// jQuery("#widget_socialradios_language").change( function() {
				// 	selected_option = jQuery("#widget_socialradios_language option:selected");
				// 	console.log(selected_option);
				// });


				jQuery(document).on("change", "#widget_socialradios-language", function() {
					//var selected_option = jQuery('#widget_socialradios-language option:selected');
					//console.log( jQuery(this).val() );
					if ( jQuery(this).val()=='' || !jQuery(this).val()) {
						//console.log('disabled');
						jQuery("#sticky-footer #widget_socialradios-country").prop('disabled', false);
					} else {
						//console.log('Enable');
						jQuery("#sticky-footer #widget_socialradios-country").prop('disabled', 'disabled');
					}
				});
			});



		</script>
		<?php	
	  }
	  
	  
	// This registers the widget.
    register_sidebar_widget('SocialRadios', 'widget_socialradios');
	
	// This registers the (optional!) widget control form.
    register_widget_control('SocialRadios', 'widget_socialradios_control');
	
  }
    
  add_action('plugins_loaded', 'widget_socialradios_init');








  // create custom plugin settings menu
add_action('admin_menu', 'socialradios_create_menu');

function socialradios_create_menu() {

	//create new top-level menu
	add_menu_page('Socialradios Plugin Settings', 'SocialRadios', 'administrator', __FILE__, 'socialradios_settings_page');

	//call register settings function
	add_action( 'admin_init', 'register_socialradios_settings' );
}


function register_socialradios_settings() {
	//register our settings
	register_setting( 'socialradios-settings-group', 'footer_div' );
	register_setting( 'socialradios-settings-group', 'header_div' );
	register_setting( 'socialradios-settings-group', 'main_container_id' );
	register_setting( 'socialradios-settings-group', 'socialradios_ajax' );
	register_setting( 'socialradios-settings-group', 'socialradios_fixed' );
	register_setting( 'socialradios-settings-group', 'socialradios_fixed_position' );
	register_setting( 'socialradios-settings-group', 'socialradios_autoplay' );
	register_setting( 'socialradios-settings-group', 'socialradios_volume' );
	register_setting( 'socialradios-settings-group', 'socialradios_stations' );

}

function socialradios_settings_page() {

	if (isset($_POST['submit'])) {
		update_option( 'footer_div', '1' );
		update_option( 'header_div', '1' );
		update_option( 'main_container_id', '1' );
		update_option( 'socialradios_ajax', '1' );
		update_option( 'socialradios_fixed', $_POST['socialradios_fixed'] );
		update_option( 'socialradios_fixed_position', $_POST['socialradios_fixed_position'] );
		update_option( 'socialradios_autoplay', $_POST['socialradios_autoplay'] );
		update_option( 'socialradios_volume', $_POST['socialradios_volume'] );
		update_option( 'socialradios_stations', $_POST['socialradios_stations'] );
	}

?>
<div class="wrap">
<h2>Socialradios</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'socialradios-settings-group' ); ?>
    <?php do_settings_sections( 'socialradios-settings-group' ); ?>



    <table class="form-table">
    	<tr valign="top">
        <th scope="row" >Enable ajax-refresh</th>
        <td ><input type="checkbox" name="socialradios_ajax" id="socialradios_ajax" value="1" <?php checked(get_option('socialradios_ajax'), 1); ?> /></td>
        </tr>

		<?php if (get_option('socialradios_ajax')!=1) { $display="style='display:none'"; } ?>
		<?php if (get_option('socialradios_fixed')!=1) { $display_pos="style='display:none'"; } ?>

		       <!--  <tr valign="top" <?=$display?> class="socialradios_ajax_options">
		        <th scope="row">Your footer id</th>
		        <td style="width:100px"><input type="text" id="footer_div" name="footer_div" value="<?php echo get_option('footer_div'); ?>" /></td>
		        <td>
		        	<a id="footer_div_autodetect">Autodetect</a>
		        	<img src="<?= plugins_url() ?>/socialradios/loading.gif" id="loading-image_footer_div'" style='display:none; margin-bottom: -12px;'/>
		        </td>
		        </tr>
		         
		        <tr valign="top" <?=$display?> class="socialradios_ajax_options">
		        <th scope="row">Your header id</th>
		        <td style="width:100px"><input type="text" name="header_div" value="<?php echo get_option('header_div'); ?>" /></td>
		        <td ><a id="header_div_autodetect">Autodetect</a>
		        <img src="<?= plugins_url() ?>/socialradios/loading.gif" id="loading-image_header_div'"  style='display:none; margin-bottom: -12px;'/></td>
		        </tr>
		        
		        <tr valign="top" <?=$display?> class="socialradios_ajax_options">
		        <th scope="row">Main Container id</th>
		        <td style="width:100px"><input type="text" name="main_container_id" value="<?php echo get_option('main_container_id'); ?>" /></td>
		        <td ><a id="main_container_id_autodetect">Autodetect</a>
		        <img src="<?= plugins_url() ?>/socialradios/loading.gif" id="loading-image_main_container_id'" style='display:none; margin-bottom: -12px;'/></td>
		        </tr> -->


		        <tr valign="top">
		        <th scope="row" >Fixed position of plugin</th>
		        <td ><input type="checkbox" name="socialradios_fixed" id="socialradios_fixed" value="1" <?php checked(get_option('socialradios_fixed'), 1); ?> /></td>
		        </tr>

		        <tr valign="top" class="fixed_position" <?=$display_pos?>>
		        <th scope="row" >Fixed to top</th>
		        <td ><input type="radio" name="socialradios_fixed_position" id="socialradios_fixed_top" value="top" <?php checked(get_option('socialradios_fixed_position'), 'top'); ?> /></td>
		        </tr>

		        <tr valign="top"  class="fixed_position" <?=$display_pos?>>
		        <th scope="row" >Fixed to bottom</th>
		        <td ><input type="radio" name="socialradios_fixed_position" id="socialradios_fixed_bottom" value="bottom" <?php checked(get_option('socialradios_fixed_position'), 'bottom'); ?> /></td>
		        </tr>

		        <tr valign="top">
		        <th scope="row" >Autoplay</th>
		        <td ><input type="checkbox" name="socialradios_autoplay" id="socialradios_autoplay" value="1" <?php checked(get_option('socialradios_autoplay'), 1); ?> /></td>
		        </tr>

		<script>

			jQuery(document).ready(function() {
				var footer = "<?php echo get_option('footer_div') ?>";
				var header = "<?php echo get_option('header_div') ?>";
				var main_container_id = "<?php echo get_option('main_container_id') ?>";
				var url = "<?php echo get_site_url() ?>";
				
				jQuery(document).on('click', '#footer_div_autodetect, #header_div_autodetect, #main_container_id_autodetect', function() {
					var detect = jQuery(this).attr('id');
					jQuery(this).closest('td').find('img').show();
					var td = jQuery(this).closest('td');
					jQuery.ajax({
						url: url,
						type: 'get',
						data: {
							 pll_ajax_backend: '1'
							
						},
						dataType: 'html',

						success: function (resp) {
							if (resp.error) {
								return;
							}
							
							if (detect == 'header_div_autodetect') {
								var value = jQuery(resp).find('header:first').attr('id');
								if (!value) {
									var value = jQuery(resp).find('#header').attr('id');
								}
							} else if (detect == 'footer_div_autodetect') {
								
								var value = jQuery(resp).find('footer:last').attr('id');
								if (!value) {
									var value = jQuery(resp).find('#footer').attr('id');
								}
							} else if (detect == 'main_container_id_autodetect') {
								var value = jQuery(resp).find('header:first').next().attr('id');
							}
							td.prepend('Try "' + value + '" as id you need ');
							jQuery('.form-table img').hide();
						}	
					});		

				});

				jQuery('#socialradios_ajax').change(function() {
					jQuery('.socialradios_ajax_options').toggle();
					
				});

				jQuery('#socialradios_fixed').change(function() {
					jQuery('.fixed_position').toggle();
					
				});
			});

		</script>
		

    </table>
    
    <?php submit_button(); ?>
</form>
</div>
<?php } 



function socialradios_widgets_init() {
$style='style="';
$position_fixed = get_option ('socialradios_fixed');
if ( $position_fixed == 1) {
	$position_fixed = get_option ('socialradios_fixed_position');
	if ($position_fixed == 'top') {
		$style = $style.'position: fixed;';
	} else {
		
		$style = $style.'bottom: -1px; position: fixed;';
	
	}
}

$options = get_option('widget_socialradios');
$theme = empty($options['theme']) ? '' : $options['theme'];
if ($theme == 'dark') {
	$style = $style.'background: none repeat scroll 0 0 #2A2A2A; color: #FFFFFF;';
}


$style=$style.'height:34px;  z-index=99999;"';

	register_sidebar( array(
		'name' => __( 'SocialRadios Sticky' ),
		'id' => 'sticky-footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s" '.$style.' data-position="'. get_option ('socialradios_fixed_position').'" >',
		'after_widget' => "</aside>",
		'before_title' => '<div class="footer-title">',
		'after_title' => '</div>',
	) );

	}

add_action( 'widgets_init', 'socialradios_widgets_init' );
function sticky_footer() {
     dynamic_sidebar( 'sticky-footer' ); 
}
add_action('wp_footer', 'sticky_footer');


