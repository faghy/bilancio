<?php

return [
    'routes' =>
        [
            'GET' => [
                '' => 'App\Controllers\PostController@getPosts',
                'posts' => 'App\Controllers\PostController@getPosts',
                'post/create' => 'App\Controllers\PostController@create',
                'posts/ieri' => 'App\Controllers\PostController@getPostsYesterday',
                'posts/cercaAnno' => 'App\Controllers\PostController@getPostsYear',
                'posts/cerca' => 'App\Controllers\PostController@cercadata',
                'post/:id' => 'App\Controllers\PostController@show',
                'post/:postid/edit' => 'App\Controllers\PostController@edit',
                'categorie' => 'App\Controllers\PostController@getCategory'
            ],

            'POST' => [
                'post/save' => 'App\Controllers\PostController@save',
                'post/:id/store' => 'App\Controllers\PostController@store',
                'posts/cerca' => 'App\Controllers\PostController@cerca',
                'post/:id/delete' => 'App\Controllers\PostController@delete'
            ]
        ]
]
    ;

