<?php

/**
 * This configuration is for aspects of the front end and UI.
 */

return [
	"options" => [
		// Turns on relative permalinks
		"relative-links" => false,
		// Forces any absolute urls in the output to this, if in production.
		"force-domain" => false,
		// Configure the view engine
		"views" => [
			// Which engine to use, either "twig" or "blade"
			"engine" => "blade",

			// directory within your theme to cache views
			"cache" => "cache/views",

			// register your custom blade directives
			"directives" => [
				"remeshNav" => "\\Remesh\\Directives\\RemeshNavDirective",
				"remeshSocialNav" => "\\Remesh\\Directives\\RemeshSocialMenuDirective",
				"remeshMenuTemplate" => "\\Remesh\\Directives\\RemeshMenuTemplateDirective"
			]
		]
	],

	// Scripts and CSS to enqueue
	"enqueue" => [
		// The public path to serve assets from, relative to the theme's root path
		"public-path" => "/public/",
		// Adds the `defer` attribute to all script tags.  Increases page speed.
		"defer-all" => true,
		// Controls whether a manifest is used for enqueueing assets like scripts and css
		"use-manifest" => false,
		// The manifest to use
		"manifest" => "assets/manifest.json",
		// list the js files you want to enqueue
		"js" => [
			"remesh.js"
		],
		// list the css files you want to enqueue
		"css" => [
			"remesh.css"
		]
	],

	// WordPress theme options
	"support" => [
		"automatic-feed-links" => true,
		"title-tag" => true,
		"post-thumbnails" => [
			"width" => 288,
			"height" => 323,
			"crop" => true
		],
		"html5" => [
			"search-form",
			"comment-form",
			"comment-list",
			"gallery",
			"caption"
		]
	],

	// Menu options
	"menu" => [
		"primary" => "Primary",
		"social" => "Social",
		"footer" => "Footer"
	],

	// For creating blocks in the gutenberg editor, requires ACF Pro 5.8
//    "blocks" => [
//        // Specify a class based block
//        "\\stem\\Blocks\\SampleBlock",
//        // Specify a class based block
//        "\\stem\\Blocks\\SampleBlockWithFields",
//        // For simple blocks, just define the props
//        [
//            "title" => "Another Sample Block",
//            "description" => "Cool stuff",
//            "template" => "blocks/another-sample",
//            "category" => "Cool",
//            "icon" => "author-link",
//            "keywords" => ['sample']
//        ],
//        // For class based blocks, you can override properties
//        [
//            "class" => "\\stem\\Blocks\\SampleBlock",
//            "title" => "Sample Block Variation",
//            "description" => "More cool stuff",
//            "template" => "blocks/sampleblock-alternate",
//        ]
//    ],

	// Sidebar Areas
//	"sidebars" => [
//        'main' => [
//            'name'          => 'Main Sidebar',
//            'description'   => 'Add widgets here to appear in your sidebar on blog posts and archive pages.',
//            'before_widget' => '<section id="%1$s" class="widget %2$s">',
//            'after_widget'  => '</section>',
//            'before_title'  => '<h2 class="widget-title">',
//            'after_title'   => '</h2>',
//        ]
//	],

	// Sidebar Widgets
//    "widgets" => [
//        "\\stem\\Widgets\\LatestPostsWidget"
//    ],

	// Editor Shortcodes
//    "shortcodes" => [
//        'code-block' => "\\StemContent\\Models\\ShortCodes\\CodeBlockShortCode"
//    ],

	// Configure the WordPress content editor
	"editor" => [
		// Additional editor styles to load
		"styles" => [
		],
		// List of plugins to add
		"plugins" => [
		]
	],

	// Configure the customizer
	"customizer" => [
		// Use kirki for customization or not.  You should use it though.
		"use_kirki" => true,

	    // Customizer Panels
//	    "panels" => [
//		    "remesh-base-options" => [
//			    "title" => "Remesh Options",
//			    "priority" => 100
//		    ]
//	    ],

	    // Customizer sections
//	    "sections" => [
//		    "remesh-theme-content" => [
//			    "title" => "Content",
//			    "panel" => "remesh-base-options",
//			    "priority" => 100
//		    ]
//	    ],

	    // Theme settings
//	    "settings" => [
//		    "footer_text" => [
//			    "default" => 'Remesh revolutionizes the way groups give and receive feedback by using artificial intelligence to eliminate the limitations of traditional forms of research.',
//			    "control" => [
//				    "label" => "Footer Text",
//				    "section" => "remesh-theme-content",
//				    "type" => "textarea"
//			    ]
//		    ],
//		    "newsletter_form_portal_id" => [
//			    "default" => '',
//			    "control" => [
//				    "label" => "Newsletter Form Portal ID",
//				    "section" => "remesh-theme-content",
//				    "type" => "text"
//			    ]
//		    ],
//		    "newsletter_form_id" => [
//			    "default" => '',
//			    "control" => [
//				    "label" => "Newsletter Form ID",
//				    "section" => "remesh-theme-content",
//				    "type" => "text"
//			    ]
//		    ]
//	    ]
	],

	// Clean up generated HTML options
	"clean" => [
		// Removes the following text and regexes from the final output
		"remove" => [
			"text" => [
				"<!-- /all in one seo pack -->",
				"<link rel='stylesheet' id='kirki-styles-global-css'  href='/app/plugins/kirki/assets/css/kirki-styles.css' type='text/css' media='all' />"
			],
			"regex" => [
				"#<!-- All in One (.*) -->#",
				"#<!-- (.*)The Seo Framework(.*) -->#"
			]
		],

		// Replaces the following text and regexes from the final output
		"replace" => [
			"text" => [
			],
			"regex" => [
			]
		],

		// Unsets these actions
		"wp_head" => [
			"rsd_link",
			"wlwmanifest_link",
			"wp_generator",
			"start_post_rel_link",
			"index_rel_link",
			"parent_post_rel_link",
			"adjacent_posts_rel_link_wp_head",
			"wp_shortlink_wp_head"
		],

		// Removes these headers
		"headers" => [
			"X-Pingback"
		]
	],

	// This is for the experimental content features in Stem.  Requires ACF Pro and Stem Content plugins.
	"content" => [
		// Import fields from stem-content plugin
		"import_fields" => false,

		// Available CSS classes for a given content type.
		"styles" => [
//			// Available to all content types
//			"*" => [
//				'first-block' => 'First Block in New Section',
//				'last-block' => 'Last Block in Section'
//			],
		],

		// Specify alternative template choices for content blocks
		"templates" => [
		],

		// Mapping content types to classes
		"map" => [
			"hero" =>  "\\Remesh\\Content\\Hero",
			"information_panel" =>  "\\Remesh\\Content\\InformationPanel",
			"client_list" =>  "\\Remesh\\Content\\ClientList",
			"information_table" =>  "\\Remesh\\Content\\InformationTable",
			"testimonials" =>  "\\Remesh\\Content\\Testimonials",
			"informational_video" =>  "\\Remesh\\Content\\InformationalVideo",
			"multi_page_panel" =>  "\\Remesh\\Content\\MultiPagePanel",
			"multi_button_panel" =>  "\\Remesh\\Content\\MultiButtonPanel",
			"steps_panel" =>  "\\Remesh\\Content\\StepsPanel",
			"demo_request_form" =>  "\\Remesh\\Content\\DemoFormPanel",
			"comparison_grid" =>  "\\Remesh\\Content\\ComparisonGrid",
			"stats_panel" =>  "\\Remesh\\Content\\StatsPanel",
			"bios_list" =>  "\\Remesh\\Content\\BiosList",
		],

		// Custom ACF Fields
		"fields" => [
			"\\Remesh\\Fields\\SanitizedTextField",
			"\\Remesh\\Fields\\TemplateSelectField",
			"\\Remesh\\Fields\\BackgroundSelectField",
		]
	]
];