<?php
/**
 * Lucienne Theme Customizer
 *
 * @package Lucienne
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function Lucienne_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
}
add_action( 'customize_register', 'Lucienne_customize_register' );


// Custom control for carousel category
 
if (class_exists('WP_Customize_Control')) {
    class lucienne_Customize_Category_Control extends WP_Customize_Control {
 
        public function render_content() {
   
            $dropdown = wp_dropdown_categories( 
                array(
                    'name'              => '_customize-dropdown-category-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;',  'lucienne' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                     
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
  
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}
 
// Register slider customizer section 
 
add_action( 'customize_register' , 'Lucienne_carousel_options' );
 
function Lucienne_carousel_options( $wp_customize ) {
 
$wp_customize->add_section(
    'carousel_section',
    array(
        'title'     => __( 'Carousel Settings',  'lucienne' ),
        'priority'  => 202,
        'capability'  => 'edit_theme_options',
    )
);
 
$wp_customize->add_setting(
    'carousel_setting',
     array(
    'default'   => '',
	'sanitize_callback' => 'sanitize_text_field',
  )
);

$wp_customize->add_setting( 'show_main_slider', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'show_main_slider', array(
		'label'    => __( 'Show Post Carousel',  'lucienne' ),
		'settings' => 'show_main_slider',
		'type'     => 'select',
		'section'        => 'carousel_section',
		'choices'  => array( 'yes' => __( 'Yes',  'lucienne' ), 'no' => __( 'No',  'lucienne' ) ),
	) );
 
$wp_customize->add_control(
    new lucienne_Customize_category_Control(
        $wp_customize,
        'carousel_category',
        array(
            'label'    => __( 'Category',  'lucienne' ),
            'settings' => 'carousel_setting',
            'section'  => 'carousel_section'
        )
    )
);
 
$wp_customize->add_setting(
    'count_setting',
     array(
    'default'   => '6',
	'sanitize_callback' => 'sanitize_text_field',
 
  )
);
 
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'carousel_count',
        array(
            'label'          => __( 'Number of posts',  'lucienne' ),
            'section'        => 'carousel_section',
            'settings'       => 'count_setting',
            'type'           => 'text',
        )
    )
);
 
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function Lucienne_customize_preview_js() {
	wp_enqueue_script( 'Lucienne_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'Lucienne_customize_preview_js' );
