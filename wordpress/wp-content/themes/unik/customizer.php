<?php 
/*
customize setup
*/
add_action( 'customize_register', 'unik_customizer' );
function unik_customizer( $wp_customize ) {
//General Section
$wp_customize->add_section(
        'general_section',
        array(
            'title' => __( 'General Options','unik' ),
            'description' => __( 'Here you can customize Your theme\'s general Settings','unik' ),
			'capability'=>'edit_theme_options',
            'priority' => 20,
        )
    );
	$wp_customize->add_setting(
		'unik_options[site_color]',
		array(
			'default'=>'#0098ff',
			'sanitize_callback'=>'sanitize_hex_color',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_color', array(
		'label'        => __( 'Site Color', 'unik' ),
		'description' => __( 'Choose your theme color here.', 'unik' ),
		'section'    => 'general_section',
		'settings'   => 'unik_options[site_color]',
	) ) );
	
	$wp_customize->add_setting(
		'unik_options[breadcrump_bg]',
		array(
			'default'=> get_template_directory_uri().'/images/bread_pg.png',
			'sanitize_callback'=>'esc_url_raw',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'breadcrump_bg',
           array(
               'label'      => __( 'Upload a Breadcrumps Background Image', 'unik' ),
               'section'    => 'general_section',
               'settings'   => 'unik_options[breadcrump_bg]'
           )
       )
   );
   
   $wp_customize->add_setting(
		'unik_options[site_bg]',
		array(
			'default'=> get_template_directory_uri().'/images/school.png',
			'sanitize_callback'=>'esc_url_raw',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'site_bg',
           array(
               'label'      => __( 'Upload a Theme Background Image', 'unik' ),
               'section'    => 'general_section',
               'settings'   => 'unik_options[site_bg]'
           )
       )
   );
//Social Settings
$wp_customize->add_section(
        'social_section',
        array(
            'title' => __( 'Social Settings','unik' ),
            'description' => 'Here you can customize Social Icon Settings',
			'capability'=>'edit_theme_options',
            'priority' => 25,
        )
    );
	$wp_customize->add_setting(
		'unik_options[footer_social]',
		array(
			'default'=> 'off',
			'sanitize_callback'=>'unik_checkbox_sanitize',
			'capability' => 'edit_theme_options',
		)
	);
		$wp_customize->add_control( 'footer_social', array(
		'label'        => __( 'Show Social Icons On Footer', 'unik' ),
		'description' => __( 'Checked to enable social icon on footer.', 'unik' ),
		'type'=>'checkbox',
		'section'    => 'social_section',
		'settings'   => 'unik_options[footer_social]',
	) );
	for($i=1; $i<=5; $i++){
		$wp_customize->add_setting(
		'unik_options[social_icon_'.$i.']',
		array(
			'default'=> '',
			'sanitize_callback'=>'unik_text_sanitize',
			'capability' => 'edit_theme_options',
		)
	);
		$wp_customize->add_control( 'social_icon_'.$i, array(
		'label'        => __( 'Social Icon ', 'unik' ).$i,
		'description' => __( 'Please add <strong>FontAwesome</strong> Class of respective social. Like  <strong>fa fa-facebook</strong>', 'unik' ),
		'section'    => 'social_section',
		'settings'   => 'unik_options[social_icon_'.$i.']',
	) );
	$wp_customize->add_setting(
		'unik_options[social_icon_link_'.$i.']',
		array(
			'default'=> '',
			'sanitize_callback'=>'esc_url_raw',
			'capability' => 'edit_theme_options',
		)
	);
		$wp_customize->add_control( 'social_link_'.$i, array(
		'label'        => __( 'Social Link ', 'unik' ).$i,
		'description' => __( 'Provide Social link here.', 'unik' ),
		'section'    => 'social_section',
		'settings'   => 'unik_options[social_icon_link_'.$i.']',
	) );
	$wp_customize->add_setting(
		'unik_options[icon_color_'.$i.']',
		array(
			'default'=> '',
			'sanitize_callback'=>'unik_text_sanitize',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icon_color_'.$i, array(
		'label'        => __( 'Social Icon Color ', 'unik' ).$i,
		'description' => __( 'Choose your social icon`s color here.', 'unik' ),
		'section'    => 'social_section',
		'settings'   => 'unik_options[icon_color_'.$i.']',
	) ) );
	}
	$wp_customize->add_section(
        'footer_section',
        array(
            'title' => __( 'Footer Settings','unik' ),
            'description' => __( 'Here you can customize Footer Settings','unik'),
			'capability'=>'edit_theme_options',
            'priority' => 30,
        )
    );
	$wp_customize->add_setting(
		'unik_options[footer_credit]',
		array(
			'default'=> '',
			'sanitize_callback'=>'unik_text_sanitize',
			'capability' => 'edit_theme_options',
		)
	);
		$wp_customize->add_control( 'footer_credit', array(
		'label'        => __( 'Footer Credit ', 'unik' ),
		'description' => __( 'Add your footer Credit text here.','unik'),
		'section'    => 'footer_section',
		'settings'   => 'unik_options[footer_credit]',
	) );
	$wp_customize->add_setting(
		'unik_options[footer_company]',
		array(
			'default'=> '',
			'sanitize_callback'=>'unik_text_sanitize',
			'capability' => 'edit_theme_options',
		)
	);
		$wp_customize->add_control( 'footer_company', array(
		'label'        => __( 'Footer Credit Name ', 'unik' ),
		'description' => __( 'Add your company name here.','unik'),
		'section'    => 'footer_section',
		'settings'   => 'unik_options[footer_company]',
	) );
	$wp_customize->add_setting(
		'unik_options[footer_company_link]',
		array(
			'default'=> '',
			'sanitize_callback'=>'esc_url_raw',
			'capability' => 'edit_theme_options',
		)
	);
		$wp_customize->add_control( 'footer_company_link', array(
		'label'        => __( 'Footer Credit Link ', 'unik' ),
		'description' => __( 'Add your company link here.','unik'),
		'section'    => 'footer_section',
		'settings'   => 'unik_options[footer_company_link]',
	) );
}
function unik_text_sanitize( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function unik_checkbox_sanitize( $input ) {
	if($input==1){
		return 'on';
	}else{
    return 'off';
	}
}
function unik_integer_sanitize( $input ) {
    return (int)($input);
}