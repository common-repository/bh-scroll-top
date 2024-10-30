<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// Settings Page: BH Scroll Top
class BHST_Settings_Page  {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'bhst_create_settings' ) );
		add_action( 'admin_init', array( $this, 'bhst_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'bhst_setup_fields' ) );
	}

	public function bhst_create_settings() {
		$page_title = esc_html__('BH Scroll Top' , 'bh-scroll-top');
		$menu_title = esc_html__('BH Scroll Top' , 'bh-scroll-top');
		$capability = 'manage_options';
		$slug = 'bhscrolltop';
		$callback = array($this, 'bhst_settings_content');
		$icon = 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="20" height="20"><path fill="white" d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/></svg>');
		$position = 75;
		add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);
	}

	public function bhst_settings_content() { ?>
		<div class="bhst_settings_form">
			<h1><?php esc_html_e('BH Scroll Top' , 'bh-scroll-top');?></h1>
			<h3><?php esc_html_e('SVG Icons and SVG File Generator Tools' , 'bh-scroll-top');?></h3>
			<p><?php esc_html_e('Download Icons' , 'bh-scroll-top');?> <a href="https://www.flaticon.com/" target="_blank"><?php esc_html_e('Click Here' , 'bh-scroll-top');?></a></p>
			<p><?php esc_html_e('SVG Icon Generator (png to svg)' , 'bh-scroll-top');?> <a href="https://png2svg.com/" target="_blank"><?php esc_html_e('Click Here' , 'bh-scroll-top');?></a></p>
			<?php settings_errors(); ?>
			<form method="POST" action="options.php">
				<?php
					settings_fields( 'bhscrolltop' );
					do_settings_sections( 'bhscrolltop' );
					submit_button();
				?>
			</form>
		</div> <?php
	}

	public function bhst_setup_sections() {
		add_settings_section( 'bhscrolltop_section', '', array(), 'bhscrolltop' );
	}

	public function bhst_setup_fields() {
		$fields = array(
			array(
				'label' => esc_html__('SVG Code' , 'bh-scroll-top'),
				'id' => 'bh_svg_code',
				'type' => 'textarea',
				'placeholder' => 'enter svg code here . ',
				'section' => 'bhscrolltop_section',
			),
			
			array(
				'label' => esc_html__('Background Color' , 'bh-scroll-top'),
				'id' => 'bh_bg_color',
				'type' => 'text',
				'section' => 'bhscrolltop_section',
			),			
			
			array(
				'label' => esc_html__('Border Color' , 'bh-scroll-top'),
				'id' => 'bh_border_color',
				'type' => 'text',
				'section' => 'bhscrolltop_section',
			),
			
			array(
				'label' => esc_html__('Icon Color' , 'bh-scroll-top'),
				'id' => 'bh_icon_color',
				'type' => 'text',
				'section' => 'bhscrolltop_section',
			),			
			
			array(
				'label' => esc_html__('Hover BG Color' , 'bh-scroll-top'),
				'id' => 'bh_hbg_color',
				'type' => 'text',
				'section' => 'bhscrolltop_section',
			),			
			
			array(
				'label' => esc_html__('HoverBorder Color' , 'bh-scroll-top'),
				'id' => 'bh_hborder_color',
				'type' => 'text',
				'section' => 'bhscrolltop_section',
			),
			
			array(
				'label' => esc_html__('Hover Icon Color' , 'bh-scroll-top'),
				'id' => 'bh_hicon_color',
				'type' => 'text',
				'section' => 'bhscrolltop_section',
			),
			array(
				'label' => esc_html__('Position' , 'bh-scroll-top'),
				'id' => 'bhs_position',
				'type' => 'radio',
				'section' => 'bhscrolltop_section',
				'options' => array(
					'left' => 'Left',
					'right' => 'Right',
				),
			),

			array(
				'label' => esc_html__('Right / Left' , 'bh-scroll-top'),
				'id' => 'bh_rleft',
				'type' => 'text',
				'placeholder' => '50px',
				'desc' => 'Scroll Position Right / Left ',
				'section' => 'bhscrolltop_section',
			),

			array(
				'label' => esc_html__('Bottom' , 'bh-scroll-top'),
				'id' => 'bh_pbtm',
				'type' => 'text',
				'placeholder' => '200px',
				'desc' => 'Scroll Position Bottom',
				'section' => 'bhscrolltop_section',
			),	
			
			array(
				'label' => esc_html__('Border Radius' , 'bh-scroll-top'),
				'id' => 'bh_border_radius',
				'placeholder' => '5px',
				'type' => 'text',
				'section' => 'bhscrolltop_section',
			),			
			
			array(
				'label' => esc_html__('Icon Size' , 'bh-scroll-top'),
				'id' => 'bh_icon_size',
				'type' => 'text',
				'placeholder' => '12px',
				'section' => 'bhscrolltop_section',
			),			
			
			array(
				'label' => esc_html__('Width' , 'bh-scroll-top'),
				'id' => 'bh_scroll_width',
				'type' => 'text',
				'placeholder' => '45px',
				'section' => 'bhscrolltop_section',
			),
			array(
				'label' => esc_html__('Height' , 'bh-scroll-top'),
				'id' => 'bh_scroll_height',
				'type' => 'text',
				'placeholder' => '45px',
				'section' => 'bhscrolltop_section',
			),	
			
			array(
				'label' => esc_html__('Line Height' , 'bh-scroll-top'),
				'id' => 'bh_scroll_line_height',
				'type' => 'text',
				'placeholder' => '40px',
				'section' => 'bhscrolltop_section',
			),	

		);
		
		
		
		foreach( $fields as $field ){
			
			$id= $field['id'];
			$label= $field['label'];
			
			$label_field = '<label for="'.esc_attr($id).'">'.esc_html($label).'</label>';
			
			add_settings_field( $field['id'], $label_field , array( $this, 'bhst_field_callback' ), 'bhscrolltop', $field['section'], $field );
			register_setting( 'bhscrolltop', $field['id'] );
		}
	}
	

	public function bhst_field_callback( $field ) {
		$value = get_option( $field['id'] );
		$placeholder = '';
		if ( isset($field['placeholder']) ) {
			$placeholder = $field['placeholder'];
		}
		switch ( $field['type'] ) {	
				case 'textarea':
					printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="4" cols="50">%3$s</textarea>',
						esc_attr($field['id']),
						esc_attr($placeholder),
						esc_html($value)
						
						);
				break;	
				
				case 'radio':
					if( ! empty ( $field['options'] ) && is_array( $field['options'] ) ) {
						$options_markup = '';
						$iterator = 0;
						foreach( $field['options'] as $key => $label ) {
							$iterator++;
							$options_markup.= sprintf('<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s" type="%2$s" value="%3$s" %4$s /> %5$s</label>',
							esc_attr($field['id']),
							$field['type'],
							$key,
							checked($value, $key, false),
							$label,
							$iterator
							);
							}
							printf( '<span class="ratio_opt">%s</span>',
								bhst_wp_kses($options_markup)
							);
					}
					break;
			default:
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
					esc_attr($field['id']),
					$field['type'],
					esc_attr($placeholder),
					esc_html($value),
				);
		}
		
		if( isset($field['desc']) ) {
			if( $desc = $field['desc'] ) {
				printf( '<p class="description">%s </p>', esc_html($desc) );
			}
		}
	}


}

new BHST_Settings_Page();