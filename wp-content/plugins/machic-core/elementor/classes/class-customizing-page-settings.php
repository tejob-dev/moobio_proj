<?phpfunction machic_add_elementor_page_settings_controls( $page ) {	$page->add_control( 'machic_elementor_enable_sidebar_collapse',		[			'label'          => esc_html__( 'Sidebar Collapse', 'machic' ),            'type'           => \Elementor\Controls_Manager::SWITCHER,			'label_on'       => esc_html__( 'Yes', 'machic' ),			'label_off'      => esc_html__( 'No', 'machic' ),			'return_value'   => 'yes',			'default'        => 'no',		]	);	$page->add_control( 'machic_elementor_hide_page_header',		[			'label'          => esc_html__( 'Hide Header', 'machic' ),            'type'           => \Elementor\Controls_Manager::SWITCHER,			'label_on'       => esc_html__( 'Yes', 'machic' ),			'label_off'      => esc_html__( 'No', 'machic' ),			'return_value'   => 'yes',			'default'        => 'no',		]	);		$page->add_control( 'machic_elementor_page_header_type',		[			'label' => esc_html__( 'Header Type', 'machic' ),			'type' => \Elementor\Controls_Manager::SELECT,			'default' => '',			'options' => [				'' => esc_html__( 'Select a type', 'machic' ),				'type1' 	  => esc_html__( 'Type 1', 'machic' ),				'type2'		  => esc_html__( 'Type 2', 'machic' ),				'type3'		  => esc_html__( 'Type 3', 'machic' ),				'type4'		  => esc_html__( 'Type 4', 'machic' ),			],		]	);		$page->add_control( 'machic_elementor_hide_page_footer',		[			'label'          => esc_html__( 'Hide Footer', 'machic-core' ),			'type'           => \Elementor\Controls_Manager::SWITCHER,			'label_on'       => esc_html__( 'Yes', 'machic' ),			'label_off'      => esc_html__( 'No', 'machic' ),			'return_value'   => 'yes',			'default'        => 'no',		]	);		$page->add_control( 'machic_elementor_logo',		[			'label'          => esc_html__( 'Set Logo', 'machic-core' ),            'type' 			 => \Elementor\Controls_Manager::MEDIA,		]	);		$page->add_control(		'page_width',		[			'label' => __( 'Width', 'machic-core' ),			'type' => \Elementor\Controls_Manager::SLIDER,			'devices' => [ 'desktop' ],			'size_units' => [ 'px'],			'range' => [				'px' => [					'min' => 1100,					'max' => 1650,					'step' => 5,				],			],			'default' => [				'unit' => 'px',				'size' => 1290,			],			'selectors' => [				'{{WRAPPER}} .container' => 'max-width: {{SIZE}}{{UNIT}};',				'{{WRAPPER}} .elementor-section.elementor-section-boxed>.elementor-container' => 'max-width: {{SIZE}}{{UNIT}};',			],		]	);}add_action( 'elementor/element/wp-page/document_settings/before_section_end', 'machic_add_elementor_page_settings_controls' );