<?php

return [
/**
 * Demonstrates a route that is an inline function, versus routing to a controller
 *
 * Uncomment to test
 */
//    "/view/image/{id}" => [
//        "early" => true,
//        "requirements" => [
//            "id" => "\\d+"
//        ],
//        "methods" => [ "get" ],
//        "function" => function(\Symfony\Component\HttpFoundation\Request $request, $id) {
//            $image = \Stem\Core\Context::current()->modelForPostID($id);
//            if ($image && ($image instanceof \Stem\Models\Attachment)) {
//                // This is obviously not ideal, but demonstration purposes only
//                return \Symfony\Component\HttpFoundation\Response::create(file_get_contents($image->src()), 200, ['Content-Type' => 'image/jpeg']);
//            } else {
//                return \Stem\Core\Response::create('Invalid ID', 500);
//            }
//        }
//    ],

/**
 * Demonstrates routing to a controller
 */
//    "/notes/" => [
//        "controller" => "\\stem\\Controllers\\NotesController@getIndex",
//        "methods" => ['get']
//    ]
//    "/notes/add" => [
//
//    ],
//    "/notes/delete" => [
//
//    ]
];