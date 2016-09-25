<?php
/**
 * Photolite Theme Customizer
 *
 * @package Photolite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photolite_customize_register( $wp_customize ) {

function photolite_format_for_editor( $text, $default_editor = null ) {
    if ( $text ) {
        $text = htmlspecialchars( $text, ENT_NOQUOTES, get_option( 'blog_charset' ) );
    }
 
    /**
     * Filter the text after it is formatted for the editor.
     *
     * @since 4.3.0
     *
     * @param string $text The formatted text.
     */
    return apply_filters( 'photolite_format_for_editor', $text, $default_editor );
}

//Add a class for titles
    class Photolite_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	$wp_customize->remove_control('header_textcolor');
	
	$wp_customize->add_setting('color_scheme', array(
		'default' => '#ed5501',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => esc_html__('Color Scheme','photolite'),
			'description'	=> esc_html__('Select color from here','photolite'),
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);

	$wp_customize->add_section('slider_section',array(
		'title'	=> esc_html__('Slider Settings','photolite'),
		'description'	=> esc_html__('Add slider images here.','photolite'),
		'priority'		=> null
	));
	
	// Slide Image 1
	$wp_customize->add_setting('slide_image1',array(
		'default'	=> get_template_directory_uri().'/images/slides/slider1.jpg',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'slide_image1',
        array(
            'label' => esc_html__('Slide Image 1 (1440x700)','photolite'),
            'section' => 'slider_section',
            'settings' => 'slide_image1'
        )
    )
);

	$wp_customize->add_setting('slide_title1',array(
		'default'	=> esc_html__('Responsive Design','photolite'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('slide_title1',array(
		'label'	=> esc_html__('Slide Title 1','photolite'),
		'section'	=> 'slider_section',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('slide_desc1',array(
		'default'	=> esc_html__('This is description for slider one.','photolite'),
		'sanitize_callback'	=> 'photolite_format_for_editor',
	));
	
	$wp_customize->add_control('slide_desc1',array(
				'label' => esc_html__('Slide Description 1','photolite'),
				'section' => 'slider_section',
				'setting'	=> 'slide_desc1',
				'type'	=> 'textarea'
		)
	);
	
	$wp_customize->add_setting('slide_link1',array(
		'default'	=> '#link1',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control('slide_link1',array(
		'label'	=> esc_html__('Slide Link 1','photolite'),
		'section'	=> 'slider_section',
		'type'		=> 'text'
	));
	
	// Slide Image 2
	$wp_customize->add_setting('slide_image2',array(
		'default'	=> get_template_directory_uri().'/images/slides/slider2.jpg',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'slide_image2',
        array(
            'label' => esc_html__('Slide Image 2 (1440x700)','photolite'),
            'section' => 'slider_section',
            'settings' => 'slide_image2'
        )
    )
);

	$wp_customize->add_setting('slide_title2',array(
		'default'	=> esc_html__('Flexible Design','photolite'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('slide_title2',array(
		'label'	=> esc_html__('Slide Title 2','photolite'),
		'section'	=> 'slider_section',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('slide_desc2',array(
		'default'	=> esc_html__('This is description for slide two','photolite'),
		'sanitize_callback'	=> 'photolite_format_for_editor',
	));
	
	$wp_customize->add_control('slide_desc2',array(
				'label' => esc_html__('Slide Description 2','photolite'),
				'section' => 'slider_section',
				'setting'	=> 'slide_desc2',
				'type'		=> 'textarea'
		)
	);
	
	$wp_customize->add_setting('slide_link2',array(
		'default'	=> '#link2',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control('slide_link2',array(
		'label'	=> esc_html__('Slide Link 2','photolite'),
		'section'	=> 'slider_section',
		'type'		=> 'text'
	));
	
	// Slide Image 3
	$wp_customize->add_setting('slide_image3',array(
		'default'	=> get_template_directory_uri().'/images/slides/slider3.jpg',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'slide_image3',
        array(
            'label' => esc_html__('Slide Image 3 (1440x700)','photolite'),
            'section' => 'slider_section',
            'settings' => 'slide_image3'
        )
    )
);

	$wp_customize->add_setting('slide_title3',array(
		'default'	=> esc_html__('Awesome Features','photolite'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('slide_title3',array(
		'label'	=> esc_html__('Slide Title 3','photolite'),
		'section'	=> 'slider_section',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('slide_desc3',array(
		'default'	=> esc_html__('This is description for slide three','photolite'),
		'sanitize_callback'	=> 'photolite_format_for_editor',
	));
	
	$wp_customize->add_control('slide_desc3',array(
				'label' => esc_html__('Slide Description 3','photolite'),
				'section' => 'slider_section',
				'setting'	=> 'slide_desc3',
				'type'		=> 'textarea'
		)
	);
	
	$wp_customize->add_setting('slide_link3',array(
		'default'	=> '#link3',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control('slide_link3',array(
		'label'	=> esc_html__('Slide Link 3','photolite'),
		'section'	=> 'slider_section',
		'type'		=> 'text'
	));
	
	// Page settings 
	$wp_customize->add_section('page_boxes',array(
		'title'	=> esc_html__('Homepage Boxes','photolite'),
		'description'	=> esc_html__('Select Pages from the dropdown','photolite'),
		'priority'	=> null
	));
	
	$wp_customize->add_setting(
    'page-setting1',
		array(
			'sanitize_callback' => 'photolite_sanitize_integer',
		)
	);
 
	$wp_customize->add_control(
		'page-setting1',
		array(
			'type' => 'dropdown-pages',
			'label' => esc_html__('Choose a page for box one:','photolite'),
			'section' => 'page_boxes',
		)
	);
	
	$wp_customize->add_setting(
    'page-setting2',
		array(
			'sanitize_callback' => 'photolite_sanitize_integer',
		)
	);
	
	$wp_customize->add_control(
		'page-setting2',
		array(
			'type' => 'dropdown-pages',
			'label' => esc_html__('Choose a page for box Two:','photolite'),
			'section' => 'page_boxes',
		)
	);
	
	$wp_customize->add_setting(
    'page-setting3',
		array(
			'sanitize_callback' => 'photolite_sanitize_integer',
		)
	);
	
	$wp_customize->add_control(
		'page-setting3',
		array(
			'type' => 'dropdown-pages',
			'label' => esc_html__('Choose a page for box Three:','photolite'),
			'section' => 'page_boxes',
		)
	);
	
	$wp_customize->add_setting(
    'page-setting4',
		array(
			'sanitize_callback' => 'photolite_sanitize_integer',
		)
	);
	
	$wp_customize->add_control(
		'page-setting4',
		array(
			'type' => 'dropdown-pages',
			'label' => esc_html__('Choose a page for box Four:','photolite'),
			'section' => 'page_boxes',
		)
	);
	
	$wp_customize->add_section('footer_section',array(
		'title'	=> esc_html__('Footer Text','photolite'),
		'description'	=> esc_html__('Add some text for footer like copyright etc.','photolite'),
		'priority'	=> null
	));
	
	$wp_customize->add_setting('footer_copy',array(
		'default'	=> esc_html__('Photolite 2016 |','photolite'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('footer_copy',array(
		'label'	=> esc_html__('Copyright Text','photolite'),
		'section'	=> 'footer_section',
		'type'		=> 'text'
	));
	
	
}
add_action( 'customize_register', 'photolite_customize_register' );

//Integer
function photolite_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}	

function photolite_css(){
		?>
        <style>
				.social_icons h5,
				.social_icons a,
				a, 
				.tm_client strong,
				#footer a,
				#footer ul li:hover a, 
				#footer ul li.current_page_item a,
				.postmeta a:hover,
				#sidebar ul li a:hover,
				.blog-post h3.entry-title,
				.woocommerce ul.products li.product .price,
				.header .header-inner .nav ul li a:hover{
					color:<?php echo esc_html(get_theme_mod('color_scheme','#ed5501')); ?>;
				}
				a.read-more, a.blog-more,
				.nav-links .page-numbers.current, 
				.nav-links .page-numbers:hover,
				#commentform input#submit,
				input.search-submit{
					background-color:<?php echo esc_html(get_theme_mod('color_scheme','#ed5501')); ?>;
				}
		</style>
	<?php }
add_action('wp_head','photolite_css');

function photolite_custom_customize_enqueue() {
	wp_enqueue_script( 'photolite-custom-customize', get_template_directory_uri() . '/js/custom.customize.js', array( 'jquery', 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'photolite_custom_customize_enqueue' );