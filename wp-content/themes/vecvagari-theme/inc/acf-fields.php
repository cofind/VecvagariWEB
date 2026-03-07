<?php
/**
 * LRM-130: ACF local field group registration for homepage editable content.
 *
 * Registers 5 field groups visible on the homepage edit screen in WP Admin:
 *   - Hero section (background image, eyebrow, H1, subheading, CTA buttons)
 *   - Stats row (repeater: number + label, up to 6 items)
 *   - About section (label, heading, body WYSIWYG, link, side image)
 *   - Service cards (repeater: icon, title, body, link, up to 6 items)
 *   - CTA banner (heading, body, button, phone)
 *
 * Location rules cover all 3 language homepage pages so each language's
 * homepage has its own independent field values in WP Admin:
 *   LV homepage: page ID 10   (slug: home)
 *   EN homepage: page ID 899  (slug: home-en)
 *   SV homepage: page ID 900  (slug: hem)
 *
 * @package VecvagariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail early if ACF is not active (safety guard).
if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

// All 3 language homepage page IDs. Each array element is a separate OR rule
// group so the fields show when editing any of the 3 pages.
$homepage_location = [
	[ [ 'param' => 'post', 'operator' => '==', 'value' => '10' ] ],
	[ [ 'param' => 'post', 'operator' => '==', 'value' => '899' ] ],
	[ [ 'param' => 'post', 'operator' => '==', 'value' => '900' ] ],
];

// ── Hero section ──────────────────────────────────────────────────────────────
acf_add_local_field_group( [
	'key'        => 'group_homepage_hero',
	'title'      => 'Homepage — Hero',
	'location'   => $homepage_location,
	'menu_order' => 10,
	'fields'     => [

		[
			'key'           => 'field_hero_bg_image',
			'label'         => 'Hero background image',
			'name'          => 'hero_bg_image',
			'type'          => 'image',
			'return_format' => 'url',
			'preview_size'  => 'medium',
			'instructions'  => 'Upload the hero section background image. Recommended: wide landscape photo, min 1920×1080 px. Leave blank to use the default background.',
		],

		[
			'key'           => 'field_hero_eyebrow',
			'label'         => 'Eyebrow text',
			'name'          => 'hero_eyebrow',
			'type'          => 'text',
			'placeholder'   => 'Mežizstrāde • Latvija kopš 2005',
			'instructions'  => 'Small text shown above the main heading.',
		],

		[
			'key'          => 'field_hero_heading',
			'label'        => 'Hero heading (H1)',
			'name'         => 'hero_heading',
			'type'         => 'text',
			'placeholder'  => 'Meža īpašuma vērtību pārvēršam rezultātos',
			'instructions' => 'Main page heading. You may use &lt;br&gt; for a forced line break.',
		],

		[
			'key'         => 'field_hero_subheading',
			'label'       => 'Hero subheading',
			'name'        => 'hero_subheading',
			'type'        => 'textarea',
			'rows'        => 2,
			'placeholder' => 'Pērkam meža īpašumus un cirsmas. Sniedzam mežizstrādes pakalpojumus. Kurzeme un Zemgale.',
		],

		[
			'key'         => 'field_hero_cta_primary_text',
			'label'       => 'CTA primary — button text',
			'name'        => 'hero_cta_primary_text',
			'type'        => 'text',
			'placeholder' => 'PIETEIKT PAKALPOJUMU →',
		],

		[
			'key'  => 'field_hero_cta_primary_url',
			'label' => 'CTA primary — URL',
			'name' => 'hero_cta_primary_url',
			'type' => 'url',
		],

		[
			'key'         => 'field_hero_cta_secondary_text',
			'label'       => 'CTA secondary — button text',
			'name'        => 'hero_cta_secondary_text',
			'type'        => 'text',
			'placeholder' => 'UZZINĀT VAIRĀK ↓',
		],

		[
			'key'          => 'field_hero_cta_secondary_url',
			'label'        => 'CTA secondary — URL (anchor or path)',
			'name'         => 'hero_cta_secondary_url',
			'type'         => 'text',
			'placeholder'  => '#par-mums',
			'instructions' => 'Can be an anchor link like #par-mums or a full path like /par-mums/',
		],

	],
] );

// ── Stats row ─────────────────────────────────────────────────────────────────
acf_add_local_field_group( [
	'key'        => 'group_homepage_stats',
	'title'      => 'Homepage — Stats row',
	'location'   => $homepage_location,
	'menu_order' => 20,
	'fields'     => [

		[
			'key'          => 'field_stats',
			'label'        => 'Stats',
			'name'         => 'stats',
			'type'         => 'repeater',
			'min'          => 0,
			'max'          => 6,
			'layout'       => 'table',
			'button_label' => 'Add stat',
			'instructions' => 'Leave completely empty to show the default hardcoded stats. Add at least one row to take full control.',
			'sub_fields'   => [

				[
					'key'         => 'field_stat_number',
					'label'       => 'Number / Value',
					'name'        => 'stat_number',
					'type'        => 'text',
					'placeholder' => '20+',
					'wrapper'     => [ 'width' => '30' ],
				],

				[
					'key'         => 'field_stat_label',
					'label'       => 'Label',
					'name'        => 'stat_label',
					'type'        => 'text',
					'placeholder' => 'gadi pieredzē',
					'wrapper'     => [ 'width' => '70' ],
				],

			],
		],

	],
] );

// ── About section ─────────────────────────────────────────────────────────────
acf_add_local_field_group( [
	'key'        => 'group_homepage_about',
	'title'      => 'Homepage — About section',
	'location'   => $homepage_location,
	'menu_order' => 30,
	'fields'     => [

		[
			'key'         => 'field_about_label',
			'label'       => 'Section label',
			'name'        => 'about_label',
			'type'        => 'text',
			'placeholder' => 'PAR MUMS',
		],

		[
			'key'         => 'field_about_heading',
			'label'       => 'Heading',
			'name'        => 'about_heading',
			'type'        => 'text',
			'placeholder' => 'Uzticams partneris mežā kopš 2005. gada',
		],

		[
			'key'          => 'field_about_body',
			'label'        => 'Body text',
			'name'         => 'about_body',
			'type'         => 'wysiwyg',
			'toolbar'      => 'basic',
			'media_upload' => 0,
			'instructions' => 'Leave blank to show default text. Supports basic formatting (bold, italic, links).',
		],

		[
			'key'         => 'field_about_cta_text',
			'label'       => 'Link text',
			'name'        => 'about_cta_text',
			'type'        => 'text',
			'placeholder' => 'LASĪT VAIRĀK →',
		],

		[
			'key'  => 'field_about_cta_url',
			'label' => 'Link URL',
			'name' => 'about_cta_url',
			'type' => 'url',
		],

		[
			'key'           => 'field_about_image',
			'label'         => 'Side image',
			'name'          => 'about_image',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'instructions'  => 'Image displayed beside the about text. Leave blank to use the default image.',
		],

	],
] );

// ── Service cards ─────────────────────────────────────────────────────────────
acf_add_local_field_group( [
	'key'        => 'group_homepage_services',
	'title'      => 'Homepage — Service cards',
	'location'   => $homepage_location,
	'menu_order' => 40,
	'fields'     => [

		[
			'key'         => 'field_services_label',
			'label'       => 'Section label',
			'name'        => 'services_label',
			'type'        => 'text',
			'placeholder' => 'PAKALPOJUMI',
		],

		[
			'key'         => 'field_services_heading',
			'label'       => 'Section heading',
			'name'        => 'services_heading',
			'type'        => 'text',
			'placeholder' => 'Mūsu pakalpojumi',
		],

		[
			'key'          => 'field_services',
			'label'        => 'Service cards',
			'name'         => 'services',
			'type'         => 'repeater',
			'min'          => 0,
			'max'          => 6,
			'layout'       => 'block',
			'button_label' => 'Add service card',
			'instructions' => 'Leave completely empty to show the default hardcoded service cards. Add at least one card to take full control.',
			'sub_fields'   => [

				[
					'key'          => 'field_service_icon',
					'label'        => 'Icon (emoji)',
					'name'         => 'service_icon',
					'type'         => 'text',
					'placeholder'  => '🌲',
					'instructions' => 'Paste an emoji character, e.g. 🌲 🪵 🚛',
					'wrapper'      => [ 'width' => '20' ],
				],

				[
					'key'     => 'field_service_title',
					'label'   => 'Title',
					'name'    => 'service_title',
					'type'    => 'text',
					'wrapper' => [ 'width' => '80' ],
				],

				[
					'key'  => 'field_service_body',
					'label' => 'Description',
					'name' => 'service_body',
					'type' => 'textarea',
					'rows' => 3,
				],

				[
					'key'         => 'field_service_link_text',
					'label'       => 'Link text',
					'name'        => 'service_link_text',
					'type'        => 'text',
					'placeholder' => 'Uzzināt vairāk →',
					'wrapper'     => [ 'width' => '50' ],
				],

				[
					'key'     => 'field_service_link_url',
					'label'   => 'Link URL',
					'name'    => 'service_link_url',
					'type'    => 'url',
					'wrapper' => [ 'width' => '50' ],
				],

			],
		],

	],
] );

// ── CTA banner (shown in footer.php on front page) ────────────────────────────
acf_add_local_field_group( [
	'key'        => 'group_homepage_cta',
	'title'      => 'Homepage — CTA banner',
	'location'   => $homepage_location,
	'menu_order' => 50,
	'fields'     => [

		[
			'key'         => 'field_cta_heading',
			'label'       => 'Heading',
			'name'        => 'cta_heading',
			'type'        => 'text',
			'placeholder' => 'Interesē meža īpašumu pārdošana vai mežizstrādes pakalpojums?',
		],

		[
			'key'         => 'field_cta_body',
			'label'       => 'Body text',
			'name'        => 'cta_body',
			'type'        => 'text',
			'placeholder' => 'Sazinieties ar mums — novērtēšana un konsultācija bez maksas.',
		],

		[
			'key'         => 'field_cta_btn_text',
			'label'       => 'Button text',
			'name'        => 'cta_btn_text',
			'type'        => 'text',
			'placeholder' => 'PIETEIKT PAKALPOJUMU →',
		],

		[
			'key'  => 'field_cta_btn_url',
			'label' => 'Button URL',
			'name' => 'cta_btn_url',
			'type' => 'url',
		],

		[
			'key'          => 'field_cta_phone',
			'label'        => 'Phone number (shown on second button)',
			'name'         => 'cta_phone',
			'type'         => 'text',
			'placeholder'  => '+371 25590827',
			'instructions' => 'Include country code, e.g. +371 25590827. Digits only for the tel: link, display text is this value.',
		],

	],
] );
