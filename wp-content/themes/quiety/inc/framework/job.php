<?php
// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {

	//
	// Set a unique slug-like ID
	$prefix = 'quiety_job_options';

	//
	// Create a metabox
	CSF::createMetabox( $prefix, array(
		'title'     => 'Job Info',
		'post_type' => 'quiety_job',
	) );
	//
	// Create a section
	CSF::createSection( $prefix, array(
		'fields' => array(
			array(
				'id'        => 'company_logo',
				'type'      => 'media',
				'title'     => esc_html__( 'Company Logo', 'quiety' ),
				'add_title' => esc_html__( 'Upload company logo', 'quiety' ),
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Company Name', 'quiety' ),
				'id'      => 'company_name',
				'default' => esc_html__( 'Google', 'quiety' ),
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Location', 'quiety' ),
				'id'      => 'company_location',
				'default' => esc_html__( 'United Kingdom', 'quiety' ),
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Job Type', 'quiety' ),
				'id'      => 'job_type',
				'default' => esc_html__( 'Full Time', 'quiety' ),
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Salary Info Title', 'quiety' ),
				'id'      => 'salary_title',
				'default' => esc_html__( 'Annual Salary', 'quiety' ),
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Salary', 'quiety' ),
				'id'      => 'salary',
				'default' => esc_html__( '$35k - $38k', 'quiety' ),
			),


			array(
				'id'          => 'rating',
				'type'        => 'select',
				'title'       => 'Select',
				'placeholder' => __('Company Rating', 'quiety'),
				'options'     => array(
					'10'  => __('1 Star', 'quiety'),
					'20'  => __('2 Star', 'quiety'),
					'30'  => __('3 Star', 'quiety'),
					'40'  => __('4 Star', 'quiety'),
					'50'  => __('5 Star', 'quiety'),
				),
				'default'     => '50'
			),

			array(
				'type'    => 'textarea',
				'title'   => esc_html__( 'Company Short Info', 'quiety' ),
				'id'      => 'company_short_info',
				'default' => esc_html__( 'About The Company', 'quiety' ),
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Job Info Title', 'quiety' ),
				'id'      => 'job_info_title',
				'default' => esc_html__( 'Job Overviews', 'quiety' ),
			),

			array(
				'id'     => 'company_infos',
				'type'   => 'group',
				'title'  => __('Job Info', 'quiety'),
				'button_title' => esc_html__( 'Add New', 'quiety' ),
				'fields' => array(


					array(
						'id'      => 'info_title',
						'type'    => 'text',
						'title'   => __('Title', 'quiety'),
					),

					array(
						'id'      => 'info',
						'type'    => 'text',
						'title'   => __('Info', 'quiety'),
					),

					array(
						'id'      => 'info_icon',
						'type'    => 'icon',
						'title'   => __('Icon', 'quiety'),
						'default' => 'fa fa-heart'
					),
				),

				'default'   => array(
					array(
						'info_title' => __('Location:', 'quiety'),
						'info_icon' => 'far fa-map-marker-alt',
						'info' => __('United Kingdom', 'quiety'),
					),
					array(
						'info_title' => __('Job Title:', 'quiety'),
						'info_icon' => 'far fa-user',
						'info' => __('Designer', 'quiety'),
					),
					array(
						'info_title' => __('Hours:', 'quiety'),
						'info_icon' => 'far fa-clock',
						'info' => __('50h / week', 'quiety'),
					),
					array(
						'info_title' => __('Rate:', 'quiety'),
						'info_icon' => 'far fa-history',
						'info' => __('$15 - $25 / hour', 'quiety'),
					),
					array(
						'info_title' => __('Salary:', 'quiety'),
						'info_icon' => 'far fa-wallet',
						'info' => __('$35k - $45k', 'quiety'),
					),
				)
			),
		)
	) );

}
