<?php

/**
 * This configuration controls image sizes and other things related to that.
 */

return [
	// Controls which of WordPress's default sizes are enabled or disabled.
	"disable-wp-sizes" => [
		//    "medium",
		//    "small",
		//    "large"
	],

	// Defines the image sizes you'll use in this app.
	"sizes" => [
		"hero" => [
			"name" => "Hero Image (Primary)",
			"width" => 688,
			"height" => 688,
			"crop" => true
		],
		"hero-fit" => [
			"name" => "Hero Image (Primary)",
			"width" => 688,
			"height" => 688,
			"crop" => false
		],
		"table-landscape" => [
			"name" => "Table (Landscape)",
			"width" => 360,
			"height" => 198,
			"crop" => true
		],
		"table-portrait" => [
			"name" => "Table (Portrait)",
			"width" => 207,
			"height" => 320,
			"crop" => true
		],
		"stats-large" => [
			"name" => "Stats (Large)",
			"width" => 810,
			"height" => 504,
			"crop" => true
		],
		"stats-medium" => [
			"name" => "Stats (Medium)",
			"width" => 495,
			"height" => 365,
			"crop" => true
		],
		"stats-small" => [
			"name" => "Stats (Small)",
			"width" => 302,
			"height" => 187,
			"crop" => true
		],
		"bio" => [
			"name" => "Bio",
			"width" => 245,
			"height" => 245,
			"crop" => true
		],
		"multi-page" => [
			"name" => "Multi-Page",
			"width" => 796,
			"height" => 456,
			"crop" => true
		]
//        "hero-simple" => [
//            "name" => "Hero Image (Simple)",
//            "width" => 1560,
//            "height" => 550,
//            "crop" => true
//        ],
//        'small-square' => [
//            'name' => "Small Square",
//            "width" => 640,
//            "height" => 640,
//            "crop" => true
//        ],
//        'top-left' => [
//            'name' => 'Top Left',
//            'width' => 640,
//            'height' => 670,
//            'crop' => [
//                'left',
//                'top'
//            ]
//        ],
//        'entropy' => [
//            'name' => 'Top Left',
//            'width' => 640,
//            'height' => 670,
//            'imgix' => [
//                'crop' => 'faces,edges'
//            ]
//        ],
//        'gray' => [
//            'name' => 'Gray',
//            'width' => 640,
//            'height' => 640,
//            'crop' => true,
//            'imgix' => [
//                'auto' => 'enhance',
//                'mono' => 'A3FF7A00'
//            ]
//        ]
	],

	// Allows you to define alternate sizes for the srcset attribute for images using a particular
	// size in your theme
	"srcset" => [
		"full" => [
			"srcset" => [
				"1024" => [
					"width" => 1024,
					"height" => 15000,
					"crop" => false
				],
				"768" => [
					"width" => 768,
					"height" => 15000,
					"crop" => false
				],
				"320" => [
					"width" => 320,
					"height" => 15000,
					"crop" => false
				]
			]
		]
	]
];