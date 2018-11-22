<?php

if( function_exists('acf_add_local_field_group') )
{
	acf_add_local_field_group(array(
		'key' => 'group_5be1fa177cbe3',
		'title' => 'CitatCF',
		'fields' => array(
			array(
				'key' => 'field_5b3f542a4581e',
				'label' => 'Vem yppade?',
				'name' => 'user',
				'type' => 'user',
				'instructions' => 'Lämna fältet tomt för okänd upphovsperson eller om personen lämnat föreningen. Fältet är inte obligatoriskt.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'role' => array(
					0 => 'author',
					1 => 'contributor',
					2 => 'editor',
				),
				'allow_null' => 1,
				'multiple' => 0,
				'return_format' => 'array',
			),
			array(
				'key' => 'field_5b3f547a4581f',
				'label' => 'Vid vilket prov lämnades citatet?',
				'name' => 'event',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'kopparpannan-event',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'object',
				'ui' => 1,
			),
			array(
				'key' => 'field_5b3f54aa45820',
				'label' => 'Om vilken whisky sades detta?',
				'name' => 'whisky',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'kopparpannan-whisky',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'object',
				'ui' => 1,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'citat',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'the_content',
			1 => 'excerpt',
			2 => 'custom_fields',
			3 => 'discussion',
			4 => 'comments',
			5 => 'revisions',
			6 => 'author',
			7 => 'format',
			8 => 'featured_image',
			9 => 'categories',
			10 => 'tags',
			11 => 'send-trackbacks',
		),
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5be1fa181f82e',
		'title' => 'EventCF',
		'fields' => array(
			array(
				'key' => 'field_5ae9bbdb6b67b',
				'label' => 'Tid',
				'name' => 'tid',
				'type' => 'date_time_picker',
				'instructions' => 'Anges förslagsvis med: hh:mm',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'show_date' => 'true',
				'show_week_number' => 'true',
				'picker' => 'select',
				'save_as_timestamp' => 'true',
				'display_format' => 'Y-m-d H:i',
				'return_format' => 'Y-m-d H:i',
				'first_day' => 1,
			),
			array(
				'key' => 'field_5b00057ec9ed3',
				'label' => 'Kan man anmäla sig till eventet?',
				'name' => 'signup_enabled',
				'type' => 'true_false',
				'instructions' => 'Är eventet något som medlemmar/gäster kan anmäla sig till?',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5b0005d7c9ed4',
				'label' => 'Är eventet ett prov?',
				'name' => 'is_event_a_tasting',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5b00057ec9ed3',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 1,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5af04f51ff367',
				'label' => 'Provningens tema',
				'name' => 'tema',
				'type' => 'text',
				'instructions' => 'Anges endast för pröv. Lämna tom annars.',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5b0005d7c9ed4',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5af04f80ff368',
				'label' => 'Provledare',
				'name' => 'provledare',
				'type' => 'text',
				'instructions' => 'Anges endast för pröv. Lämna blank annars.',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5b0005d7c9ed4',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5b218a2d9a186',
				'label' => 'Summering',
				'name' => 'summering',
				'type' => 'textarea',
				'instructions' => 'Här läggs eventuell summering/sammanfattning efter att provet är genomfört.',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5b0005d7c9ed4',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => 'br',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'kopparpannan-event',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
		),
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5be1fa18e345a',
		'title' => 'GästanmälanCF',
		'fields' => array(
			array(
				'key' => 'field_5b3c87c335bae',
				'label' => 'Evenemang',
				'name' => 'event',
				'type' => 'post_object',
				'instructions' => 'Vilket evenemang är gästen inbjuden till.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'kopparpannan-event',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'object',
				'ui' => 1,
			),
			array(
				'key' => 'field_5b3c870854576',
				'label' => 'Inbjuden av',
				'name' => 'inbjuden_av',
				'type' => 'user',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'role' => array(
					0 => 'author',
					1 => 'contributor',
					2 => 'editor',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'array',
			),
			array(
				'key' => 'field_5b3c872954577',
				'label' => 'Inbjuden',
				'name' => 'inbjuden',
				'type' => 'text',
				'instructions' => 'Namnet på gästen',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5b3c874f54578',
				'label' => 'Telefon',
				'name' => 'telefon',
				'type' => 'text',
				'instructions' => 'Telefonnummer till gästen',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5b3c876d54579',
				'label' => 'Epost',
				'name' => 'epost',
				'type' => 'text',
				'instructions' => 'Epostadress till gästen',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'gastanmalning',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
		),
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5be1fa1981f63',
		'title' => 'MedlemsanmälningCF',
		'fields' => array(
			array(
				'key' => 'field_5b3c84bc65155',
				'label' => 'event',
				'name' => 'event',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'kopparpannan-event',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'object',
				'ui' => 1,
			),
			array(
				'key' => 'field_5b3c852d65156',
				'label' => 'user',
				'name' => 'user',
				'type' => 'user',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'role' => array(
					0 => 'author',
					1 => 'contributor',
					2 => 'editor',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'array',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'medlemsanmalning',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
		),
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5be1fa19c332f',
		'title' => 'MedlemskandidatCF',
		'fields' => array(
			array(
				'key' => 'field_5b3729565bad6',
				'label' => 'Telefonnummer',
				'name' => 'telefonnummer',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5b3729da5bad9',
				'label' => 'Epostadress',
				'name' => 'epostadress',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5b37296d5bad7',
				'label' => 'Nomineringsdatum',
				'name' => 'nomineringsdatum',
				'type' => 'date_picker',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'Y-m-d',
				'first_day' => 1,
				'return_format' => 'd/m/Y',
				'save_format' => 'yymmdd',
			),
			array(
				'key' => 'field_5b3729a35bad8',
				'label' => 'Nominator',
				'name' => 'nominator',
				'type' => 'user',
				'instructions' => 'Vem nominerade kandidaten',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'role' => '',
				'allow_null' => 1,
				'multiple' => 0,
				'return_format' => 'array',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'kp-medlemskandidat',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
		),
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5be1fa1a82c2b',
		'title' => 'WhiskyBetygCF',
		'fields' => array(
			array(
				'key' => 'field_5b27cc03a7210',
				'label' => 'Prov',
				'name' => 'prov',
				'type' => 'post_object',
				'instructions' => 'Vid vilket prov testades whiskyn',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'kopparpannan-event',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'object',
				'ui' => 1,
			),
			array(
				'key' => 'field_5b27cba4a720f',
				'label' => 'Whisky',
				'name' => 'whisky',
				'type' => 'post_object',
				'instructions' => 'Ange Whisky.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'kopparpannan-whisky',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'object',
				'ui' => 1,
			),
			array(
				'key' => 'field_5b27cb57a720e',
				'label' => 'Snittbetyg',
				'name' => 'betyg',
				'type' => 'text',
				'instructions' => 'Betyg. Använd decimalpunkt',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'Ex. 5.52',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => 5,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'kp-whiskybetyg',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
		),
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5be1fa1b37356',
		'title' => 'WhiskyCF',
		'fields' => array(
			array(
				'key' => 'field_5a1e98fe045a8',
				'label' => 'Ålder',
				'name' => 'age',
				'type' => 'text',
				'instructions' => 'Angiven ålder eller NAS.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'Angiven ålder eller NAS.',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5a1e9939045a9',
				'label' => 'Område',
				'name' => 'omrade',
				'type' => 'taxonomy',
				'instructions' => 'Vilket land, eller distrikt drycken kommer från',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'omrde',
				'field_type' => 'select',
				'allow_null' => 0,
				'return_format' => 'object',
				'multiple' => 0,
				'add_term' => 1,
				'load_terms' => 0,
				'save_terms' => 1,
			),
			array(
				'key' => 'field_5a1e9964045aa',
				'label' => 'Alkoholhalt',
				'name' => 'alkoholhalt',
				'type' => 'number',
				'instructions' => 'Styrkan angiven i %. Endast det numeriska värdet ska anges.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'Styrkan angiven i %. Endast det numeriska värdet ska anges.',
				'prepend' => '',
				'append' => '',
				'min' => '40.0',
				'max' => '99.9',
				'step' => '0.1',
			),
			array(
				'key' => 'field_5a1e99a5045ab',
				'label' => 'Pris',
				'name' => 'pris',
				'type' => 'text',
				'instructions' => 'Kostnaden. Text, så valutatecken eller valutakod anges som man vill.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '469 SEK',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5b000496d826f',
				'label' => 'Volym',
				'name' => 'volym',
				'type' => 'text',
				'instructions' => 'Storlek i milliliter (ml). Om det är normalstor flaska om 700 ml behöver inget anges. Ange inte enheten.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 700,
				'placeholder' => 700,
				'prepend' => '',
				'append' => 'ml',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'kopparpannan-whisky',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
		),
		'active' => 1,
		'description' => '',
	));
}

?>