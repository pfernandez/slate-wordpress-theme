<?php

// ------------- Theme Customizer  ------------- //

add_action( 'customize_register', 'okay_theme_customizer_register' );

function okay_theme_customizer_register( $wp_customize ) {
	
	//Add Textarea 
	class Okay_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}
	
	//Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ( $options_categories_obj as $category ) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ( $options_pages_obj as $page ) {
		$options_pages[$page->ID] = $page->post_title;
	}
    
    
	//-----------------  // Style Options //-----------------//


	$wp_customize->add_section( 'okay_theme_customizer_basic', array(
		'title' 	=> __( 'Slate Style Settings', 'okay_theme_customizer' ),
		'priority' 	=> 100
	) );
	
	//Logo Image
	$wp_customize->add_setting( 'okay_theme_customizer_logo', array(
		'type' 		=> 'option'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'theme_logo', array(
		'label' 	=> __( 'Logo Upload', 'okay' ),
		'section' 	=> 'okay_theme_customizer_basic',
		'settings' 	=> 'okay_theme_customizer_logo'
	) ) );
	
	//Color Scheme
	$wp_customize->add_setting('okay_theme_customizer_color_scheme', array(
        'default'   => 'light',
        'capability'=> 'edit_theme_options',
        'type'		=> 'option',
    ));
    
    $wp_customize->add_control( 'color_scheme_select_box', array(
        'settings'	=> 'okay_theme_customizer_color_scheme',
        'label'		=> __( 'Color Scheme', 'okay' ),
        'section'	=> 'okay_theme_customizer_basic',
        'type'		=> 'select',
        'choices'	=> array(
            'light'	=> __( 'Light', 'okay' ),
            'dark'	=> __( 'Dark', 'okay' )
        ),
    ));
	
	//Link Color
	$wp_customize->add_setting( 'okay_theme_customizer_link', array(
		'default'	=> '#60BDDB',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'okay_theme_customizer_link', array(
		'label'		=> __( 'Link Color', 'okay' ),
		'section'	=> 'okay_theme_customizer_basic',
		'settings'	=> 'okay_theme_customizer_link'
	) ) );
	
	//Custom CSS
	$wp_customize->add_setting( 'okay_theme_customizer_css', array(
        'default'	=> '',
    ) );
    
    $wp_customize->add_control( new Okay_Customize_Textarea_Control( $wp_customize, 'okay_theme_customizer_css', array(
	    'label'		=> __( 'Custom CSS', 'okay' ),
	    'section'	=> 'okay_theme_customizer_basic',
	    'settings'	=> 'okay_theme_customizer_css',
	) ) );
	
	//Slider Autoplay
	$wp_customize->add_setting('okay_theme_customizer_slider_auto', array(
        'default'	=> 'disabled',
        'capability'=> 'edit_theme_options',
        'type'		=> 'option',
    ));
    
    $wp_customize->add_control( 'slider_auto_select_box', array(
        'settings'	=> 'okay_theme_customizer_slider_auto',
        'label'		=> __( 'Enable Slider Autoplay', 'okay' ),
        'section'	=> 'okay_theme_customizer_basic',
        'type'		=> 'select',
        'choices'	=> array(
            'enabled'	=> __( 'Enabled', 'okay' ),
            'disabled'	=> __( 'Disabled', 'okay' ),
        ),
    ));
	

	//-----------------  // Header Section //-----------------//


	$wp_customize->add_section( 'okay_theme_customizer_header', array(
		'title'		=> __( 'Slate Header Settings', 'okay_theme_customizer' ),
		'priority'	=> 110
	) );
	
	//Hidden Header Text
	$wp_customize->add_setting( 'okay_theme_customizer_hidden_text', array(
		'default'	=> '',
		'type'		=> 'option'
	) );

	$wp_customize->add_control( 'okay_theme_customizer_hidden_text', array(
		'label'		=> __( 'Header Hidden Text', 'okay' ),
		'section'	=> 'okay_theme_customizer_header',
		'settings'	=> 'okay_theme_customizer_hidden_text',
		'type'		=> 'text'
	) );
	
	//Header Title
	$wp_customize->add_setting( 'okay_theme_customizer_main_title', array(
		'default'	=> '',
		'type'		=> 'option'
	) );

	$wp_customize->add_control( 'okay_theme_customizer_main_title', array(
		'label'		=> __( 'Header Main Title', 'okay' ),
		'section'	=> 'okay_theme_customizer_header',
		'settings'	=> 'okay_theme_customizer_main_title',
		'type'		=> 'text'
	) );
	
	//Header Subtitle
	$wp_customize->add_setting( 'okay_theme_customizer_sub_title', array(
		'default'	=> '',
		'type'		=> 'option'
		
	) );

	$wp_customize->add_control( 'okay_theme_customizer_sub_title', array(
		'label'		=> __( 'Header Subtitle', 'okay' ),
		'section'	=> 'okay_theme_customizer_header',
		'settings'	=> 'okay_theme_customizer_sub_title',
		'type'		=> 'text'
	) );
	
	
	//-----------------  // Homepage Sections //-----------------//
	
	
	$wp_customize->add_section( 'okay_theme_customizer_homepage', array(
		'title'		=> __( 'Slate Homepage Settings', 'okay_theme_customizer' ),
		'priority'	=> 111
	) );
	
	//Enable Slider Section
	$wp_customize->add_setting('okay_theme_customizer_enable_slider', array(
        'default'	=> 'enabled',
        'capability'=> 'edit_theme_options',
        'type'		=> 'option',
    ));
    
    $wp_customize->add_control( 'enable_slider_select_box', array(
        'settings'	=> 'okay_theme_customizer_enable_slider',
        'label'		=> __( 'Enable Slider Section', 'okay' ),
        'section'	=> 'okay_theme_customizer_homepage',
        'type'		=> 'select',
        'choices'	=> array(
            'enabled'	=> __( 'Enabled', 'okay' ),
            'disabled'	=> __( 'Disabled', 'okay' ),
        ),
        'priority' => 1
    ));
    
    //Enable Services Section
	$wp_customize->add_setting('okay_theme_customizer_enable_services', array(
        'default'	=> 'enabled',
        'capability'=> 'edit_theme_options',
        'type'		=> 'option',
    ));
    
    $wp_customize->add_control( 'enable_services_select_box', array(
        'settings'	=> 'okay_theme_customizer_enable_services',
        'label'		=> __( 'Enable Services Section', 'okay' ),
        'section'	=> 'okay_theme_customizer_homepage',
        'type'		=> 'select',
        'choices'	=> array(
            'enabled'	=> __( 'Enabled', 'okay' ),
            'disabled'	=> __( 'Disabled', 'okay' ),
        ),
        'priority'	=> 2
    ));
    
    //Services Title
	$wp_customize->add_setting( 'okay_theme_customizer_services_title', array(
		'default'	=> '',
		'type'		=> 'option'
	) );

	$wp_customize->add_control( 'okay_theme_customizer_services_title', array(
		'label'		=> __( 'Services Section Title', 'okay' ),
		'section'	=> 'okay_theme_customizer_homepage',
		'settings'	=> 'okay_theme_customizer_services_title',
		'type'		=> 'text',
		'priority'	=> 3
	) );
    
    //Enable Portfolio Section
	$wp_customize->add_setting('okay_theme_customizer_enable_portfolio', array(
        'default'	=> 'enabled',
        'capability'=> 'edit_theme_options',
        'type'		=> 'option',
    ));
    
    $wp_customize->add_control( 'enable_portfolio_select_box', array(
        'settings'	=> 'okay_theme_customizer_enable_portfolio',
        'label'		=> __( 'Enable Portfolio Section', 'okay' ),
        'section'	=> 'okay_theme_customizer_homepage',
        'type'		=> 'select',
        'choices'	=> array(
            'enabled'	=> __( 'Enabled', 'okay' ),
            'disabled'	=> __( 'Disabled', 'okay' ),
        ),
        'priority'	=> 4
    ));
    
    //Portfolio Title
	$wp_customize->add_setting( 'okay_theme_customizer_portfolio_title_home', array(
		'default'	=> '',
		'type'		=> 'option'
	) );

	$wp_customize->add_control( 'okay_theme_customizer_portfolio_title_home', array(
		'label'		=> __( 'Portfolio Section Title', 'okay' ),
		'section'	=> 'okay_theme_customizer_homepage',
		'settings'	=> 'okay_theme_customizer_portfolio_title_home',
		'type'		=> 'text',
		'priority'	=> 5
	) );
    
    //Enable Blog Section
	$wp_customize->add_setting('okay_theme_customizer_enable_blog', array(
        'default'	=> 'enabled',
        'capability'=> 'edit_theme_options',
        'type'		=> 'option',
    ));
    
    $wp_customize->add_control( 'enable_blog_select_box', array(
        'settings'	=> 'okay_theme_customizer_enable_blog',
        'label'		=> __( 'Enable Blog Section', 'okay' ),
        'section'	=> 'okay_theme_customizer_homepage',
        'type'		=> 'select',
        'choices'	=> array(
            'enabled'	=> __( 'Enabled', 'okay' ),
            'disabled'	=> __( 'Disabled', 'okay' ),
        ),
        'priority'	=> 6
    ));
    
    //Blog Title
	$wp_customize->add_setting( 'okay_theme_customizer_blog_title', array(
		'default'	=> '',
		'type'		=> 'option'
	) );

	$wp_customize->add_control( 'okay_theme_customizer_blog_title', array(
		'label'		=> __( 'Blog Section Title', 'okay' ),
		'section'	=> 'okay_theme_customizer_homepage',
		'settings'	=> 'okay_theme_customizer_blog_title',
		'type'		=> 'text',
		'priority'	=> 7
	) );
    
    //Enable Testimonials Section
	$wp_customize->add_setting('okay_theme_customizer_enable_testimonials', array(
        'default'	=> 'enabled',
        'capability'=> 'edit_theme_options',
        'type'		=> 'option',
    ));
    
    $wp_customize->add_control( 'enable_testimonials_select_box', array(
        'settings'	=> 'okay_theme_customizer_enable_testimonials',
        'label'		=> __( 'Enable Testimonials Section', 'okay' ),
        'section'	=> 'okay_theme_customizer_homepage',
        'type'		=> 'select',
        'choices'	=> array(
            'enabled'	=> __( 'Enabled', 'okay' ),
            'disabled'	=> __( 'Disabled', 'okay' ),
        ),
        'priority'	=> 8
    ));
    
    //Testimonial Title
	$wp_customize->add_setting( 'okay_theme_customizer_testimonial_title', array(
		'default'	=> '',
		'type'		=> 'option'
	) );

	$wp_customize->add_control( 'okay_theme_customizer_testimonial_title', array(
		'label'		=> __( 'Testimonial Section Title', 'okay' ),
		'section'	=> 'okay_theme_customizer_homepage',
		'settings'	=> 'okay_theme_customizer_testimonial_title',
		'type'		=> 'text',
		'priority'	=> 9
	) );
	
	//Portfolio Page
	$wp_customize->add_section( 'okay_theme_customizer_portfolio_page', array(
		'title'		=> __( 'Slate Portfolio Settings', 'okay_theme_customizer' ),
		'priority'	=> 112
	) );
	
	//Portfolio Title
	$wp_customize->add_setting( 'okay_theme_customizer_portfolio_page_title', array(
		'default'	=> '',
		'type'		=> 'option'
	) );

	$wp_customize->add_control( 'okay_theme_customizer_portfolio_page_title', array(
		'label'		=> __( 'Portfolio Page Title', 'okay' ),
		'section'	=> 'okay_theme_customizer_portfolio_page',
		'settings'	=> 'okay_theme_customizer_portfolio_page_title',
		'type'		=> 'text'
	) );
	
	//Portfolio Subtitle
	$wp_customize->add_setting( 'okay_theme_customizer_portfolio_page_sub_title', array(
		'default'	=> '',
		'type'		=> 'option'
		
	) );

	$wp_customize->add_control( 'okay_theme_customizer_portfolio_page_sub_title', array(
		'label'		=> __( 'Portfolio Page Subtitle', 'okay' ),
		'section'	=> 'okay_theme_customizer_portfolio_page',
		'settings'	=> 'okay_theme_customizer_portfolio_page_sub_title',
		'type'		=> 'text'
	) );
	
}