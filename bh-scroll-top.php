<?php
/**
 * Plugin Name:       BH Scroll Top 
 * Plugin URI:        
 * Description:       Scroll Top Feature will be enable in your website
 * Version:           1.4
 * Requires at least: 5.0
 * Requires PHP:      7.4
 * Author:            Themesvila
 * Author URI:        https://themesvila.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       bh-scroll-top
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class BHST_Scroll_top{
	
	public function __construct(){
		
		add_action('wp_enqueue_scripts' , array($this , 'bhst_enqueue_scripts'));
		add_action('admin_enqueue_scripts' , array($this , 'bhst_add_theme_scripts'));
		add_action('init' , array($this , 'include_files'));		
		add_action('wp_head' , array($this , 'bhst_custom_css'));
		add_action('wp_footer' , array($this , 'bhst_scroll_top_active') , 999);
		add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), array( $this, 'bhst_scroll_top_settings_link' ) );		
	}

	public function bhst_scroll_top_settings_link($links) {
	    $newlink = sprintf("<a href='%s'>%s</a>",'admin.php?page=bhscrolltop',__('Settings','bh-scroll-top'));
	    $links[] = $newlink;
	    return $links;
	}


	public function include_files(){
		
		define( 'BHSTFILDIR', dirname( __FILE__ ) ); 
		// Add files

		include_once(BHSTFILDIR. '/admin/admin.php');		
	
	}
	
	// Including Scripts
	public function bhst_enqueue_scripts(){
		
		// Define 
		define('BHSTFILPATH' , plugins_url('assets/' , __FILE__) );
		
		// Css Files
		wp_enqueue_style('bhst-style', BHSTFILPATH . 'css/scroll-top.css');
		
		// JS Files
		wp_enqueue_script('jquery');
		wp_enqueue_script('bhst-scroll-top', BHSTFILPATH . 'js/scroll-top.js' , array(), '1.0.0', 'true');
		
	}	
	
	/*
	* Admin Scripts
	*/
	public function bhst_add_theme_scripts(){
	
		// Define	
		define('BHSTFILADMINPATH' , plugins_url('admin/' , __FILE__) );	
		
		wp_enqueue_style( 'bhst-admin-style', BHSTFILADMINPATH . 'css/admin-style.css', false, "1.0.0");
		  

		// Color Picker JS
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'active_color_picker', BHSTFILADMINPATH . 'js/active_color_picker.js' , array( 'jquery', 'wp-color-picker' ), '', true  );

	}	

	public function bhst_custom_css(){
		
			$bg_color = get_option('bh_bg_color');
			$border_color = get_option('bh_border_color');
			$icon_color = get_option('bh_icon_color');
			$hover_bg_color = get_option('bh_hbg_color');
			$hover_border_color = get_option('bh_hborder_color');
			$hover_icon_color = get_option('bh_hicon_color');
			$bradius = get_option('bh_border_radius');
			$width = get_option('bh_scroll_width');
			$icon_size = get_option('bh_icon_size');
			$height = get_option('bh_scroll_height');
			$lineheight = get_option('bh_scroll_line_height');
			$bottom = get_option('bh_pbtm');
			$leftright = get_option('bh_rleft');
			$position = get_option('bhs_position');
		
		?>
		
		<style>
			#go-top {
				<?php

					if(isset($bg_color)){
						echo 'background:' . esc_html($bg_color) . ';';
					} 					
					
					if(isset($border_color)){
						echo 'border-color:' . esc_html($border_color) . ';';
					} 	
					
					if(isset($bradius)){
						echo 'border-radius:' . esc_html($bradius) . ';';
					} 					
					
					if(isset($width)){
						echo 'width:' . esc_html($width) . ';';
					} 		

					if(isset($height)){
						echo 'height:' . esc_html($height) . ';';
					} 		

					if(isset($lineheight)){
						echo 'line-height:' . esc_html($lineheight) . ';';
					} 
					
					
					if(isset($bottom)){
						echo 'bottom:' . esc_html($bottom) . ';';
					} 	
					
					if($position == 'right'){
						echo 'right:' . esc_html($leftright) . ';';
					}else{
						echo 'left:' . esc_html($leftright) . ';';
					}
			
				
				?>
			}
			
			#go-top:hover,
			#go-top:focus{
				<?php

					if(isset($hover_bg_color)){
						echo 'background:' . esc_html($hover_bg_color) . ';';
					}					
					
					if(isset($hover_border_color)){
						echo 'border-color:' . esc_html($hover_border_color) . ';';
					}
					
				?>
			}
			
			#go-top svg{
				<?php if($icon_size){
					echo 'height:' . esc_html($icon_size) . ';';
					echo 'width:' . esc_html($icon_size) . ';';
				} ?>
			}	

			#go-top svg path{
				<?php
				
				if(isset($icon_color)){
					echo 'fill:' . esc_html($icon_color) . ';';
				}
				?>
			}	

			#go-top:hover svg path{
				<?php				
					if(isset($hover_icon_color)){
						echo 'fill:' . esc_html($hover_icon_color) . ';';
					}
				?>
			}
			
		</style>
		
		<?php	
	}

	// Active Scroll Top	
	public function bhst_scroll_top_active(){
		$scroll_icon = get_option('bh_svg_code');
	?>

	<div id="go-top">
		<?php if($scroll_icon){
			printf($scroll_icon);
		}else{
			echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="20" height="20"><path fill="black" d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/></svg>';
		}?>
		
	</div>
	 
	<script>
	  jQuery(function () {
		jQuery('#go-top').goTop({
		  scrollTop: 100,
		  scrollSpeed: 1000,
		  fadeInSpeed: 1000,
		  fadeOutSpeed: 500
		})
	  })
	</script>
		
		<?php
	}
}

// bhst wp kses
function bhst_wp_kses($val){
	return wp_kses($val, array(
	
	'p' => array(),
	'span' => array('class' => array(),'id' => array()),
	'div' => array(),
	'strong' => array(),
	'em' => array(),
	'u' => array(),	
	'b' => array(),
	'br' => array(),
	'h1' => array(),
	'h2' => array(),
	'h3' => array(),
	'h4' => array(),
	'h5' => array(),
	'h6' => array(),
	'i'=> array('class' => array(),'id' => array()),
	'svg'=> array('class' => array(),'xmlns' => array(), 'viewBox' => array(), 'width' => array(),'height' => array()),
	'path'=> array('fill' => array(),'d' => array()),
	'div'=> array('class' => array(),'id' => array()),
	'label'=> array('class' => array(),'for' => array()),
	'input'=> array('name' => array(),'type' => array(),'value' => array(),'checked' => array()),
	'ul'=> array('class' => array(),'id' => array()),
	'li'=> array('class' => array(),'id' => array()),
	'a'=> array('href' => array(),'target' => array()),
	'iframe'=> array('src' => array(),'height' => array(),'width' => array()),
	
	), '');
}


new BHST_Scroll_top();
