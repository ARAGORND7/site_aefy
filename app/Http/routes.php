<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/******************************************/
/************ ADMIN ROUTES ****************/
/******************************************/

Route::group(['middleware' => ['web', 'admin']], function () {
    // Move Topic
    Route::get('/forum/topic/move/{topic_id}', ['as' => 'forum.topic.move', 'uses' => 'Admin\ForumTopicController@move']);

    // Moderate- Unmoderate Forum Messages
    Route::get('/forum/message/moderate/{message_id}', ['as' => 'forum.message.moderate', 'uses' => 'Admin\ForumMessageController@moderate']);
    Route::get('/forum/message/unmoderate/{message_id}', ['as' => 'forum.message.unmoderate', 'uses' => 'Admin\ForumMessageController@unmoderate']);

    // Delete forum topic
    Route::get('/forum/topic/{topic_id}/delete', ['as' => 'forum.topic.delete', 'uses' => 'Admin\ForumTopicController@delete']);

    // Stick forum topics
    Route::get('/forum/topic/{topic_id}/stick', ['as' => 'forum.topic.stick', 'uses' => 'Admin\ForumTopicController@stick']);
    Route::get('/forum/topic/{topic_id}/unstick', ['as' => 'forum.topic.unstick', 'uses' => 'Admin\ForumTopicController@unstick']);

    // Admin Pages
    Route::get('/admin/index', ['as' => 'admin.index', 'uses' => 'Admin\AdminController@index']);
    Route::get('/admin/news', ['as' => 'admin.news', 'uses' => 'Admin\AdminController@news']);
    Route::get('/admin/permissions', ['as' => 'admin.permissions', 'uses' => 'Admin\AdminController@permissions']);
    Route::post('/admin/permissions/edit', ['as' => 'admin.permissions.edit', 'uses' => 'Admin\AdminController@permissionsEdit']);
    Route::get('/admin/sponsor', ['as' => 'admin.sponsor', 'uses' => 'Admin\AdminController@sponsor']);
    Route::get('/admin/pages', ['as' => 'admin.pages', 'uses' => 'Admin\AdminController@pages']);
    Route::get('/admin/members', ['as' => 'admin.members', 'uses' => 'Admin\AdminController@members']);
    Route::get('/admin/gallery', ['as' => 'admin.gallery', 'uses' => 'Admin\AdminController@gallery']);

    // Edit basic pages
    Route::get('/pages/edit/{id}', ['as' => 'pages.edit', 'uses' => 'PageController@edit']);
    Route::put('/pages/update/{id}', ['as' => 'pages.update', 'uses' => 'PageController@update']);

    // Edit user
    Route::get('/user/edit/{userId}', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
    Route::post('/user/edit/{userId}', ['as' => 'users.update', 'uses' => 'UsersController@update']);

    // Ban User
    Route::get('/admin/ban', ['as' => 'admin.ban.index', 'uses' => 'Admin\UserBanController@index']);
    Route::get('/admin/ban/create/{id}', ['as' => 'admin.ban.create', 'uses' => 'Admin\UserBanController@create']);
    Route::post('/admin/ban/store', ['as' => 'admin.ban.store', 'uses' => 'Admin\UserBanController@store']);
    Route::get('/admin/ban/edit/{id}', ['as' => 'admin.ban.edit', 'uses' => 'Admin\UserBanController@edit']);
    Route::post('/admin/ban/update/{id}', ['as' => 'admin.ban.update', 'uses' => 'Admin\UserBanController@update']);
    Route::get('/admin/ban/delete/{id}', ['as' => 'admin.ban.delete', 'uses' => 'Admin\UserBanController@delete']);

});

/******************************************/
/********* ROUTES FOR GUEST ONLY  *********/
/******************************************/
Route::group(['middleware' => ['guest', 'web']], function () {
    Route::get('/register', ['as' => 'users.register', 'uses' => 'UsersController@register']);
    Route::post('/register', ['as' => 'users.store', 'uses' => 'UsersController@store']);
    Route::get('/confirm/{userId}/{token}', ['as' => 'users.confirm', 'uses' => 'UsersController@confirm']);
    Route::get('/login', ['as' => 'users.login', 'uses' => 'UsersController@login']);
    Route::post('/login', ['as' => 'users.postLogin', 'uses' => 'UsersController@postLogin']);
    Route::get('/password/reset/form', ['as' => 'users.showEmailFormForPasswordReset', 'uses' => 'UsersController@showEmailFormForPasswordReset']);
    Route::post('/password/reset/store', ['as' => 'users.storeEmailFormForPasswordReset', 'uses' => 'UsersController@storeEmailFormForPasswordReset']);
    Route::get('/password/reset/{token}/{email}', ['as' => 'users.confirmPasswordReset', 'uses' => 'UsersController@confirmPasswordReset']);
    Route::post('/password/reset/{token}/{email}', ['as' => 'users.storePasswordReset', 'uses' => 'UsersController@storePasswordReset']);
});

Route::group(['middleware' => ['auth']], function () {

    // Forum
    Route::post('/forum/message/store', ['as' => 'forum.message.store', 'uses' => 'Forum\ForumMessageController@store']);

    //
});

/******************************************/
/********* ROUTES WITH PERMISSION *********/
/******************************************/

// Manage forum categories and subcategories
Route::group(['middleware' => ['web', 'permission:Gérer les catégories et sous catégories du forum']], function () {
    Route::get('/forum/order', ['as' => 'forum.order', 'uses' => 'Forum\ForumController@order']);


    Route::get('/forum/categories/order', ['as' => 'forum.categories.order', 'uses' => 'Admin\ForumCategoriesController@order']);
    Route::post('/forum/categories/order', ['as' => 'forum.categories.storeOrder', 'uses' => 'Admin\ForumCategoriesController@storeOrder']);
    Route::get('/forum/categories/add', ['as' => 'forum.categories.add', 'uses' => 'Admin\ForumCategoriesController@create']);
    Route::post('/forum/categories/store', ['as' => 'forum.categories.store', 'uses' => 'Admin\ForumCategoriesController@store']);
    Route::get('/forum/categories/edit/{id}', ['as' => 'forum.categories.edit', 'uses' => 'Admin\ForumCategoriesController@edit']);
    Route::post('/forum/categories/edit/{id}', ['as' => 'forum.categories.update', 'uses' => 'Admin\ForumCategoriesController@update']);
    Route::get('/forum/categories/delete/{id}', ['as' => 'forum.categories.delete', 'uses' => 'Admin\ForumCategoriesController@destroy']);

    //Forum Sub Categories
    Route::get('/forum/subcategories/add', ['as' => 'forum.subcategories.add', 'uses' => 'Admin\ForumSubCategoriesController@create']);
    Route::post('/forum/subcategories/store', ['as' => 'forum.subcategories.store', 'uses' => 'Admin\ForumSubCategoriesController@store']);
    Route::get('/forum/subcategories/edit/{id}', ['as' => 'forum.subcategories.edit', 'uses' => 'Admin\ForumSubCategoriesController@edit']);
    Route::post('/forum/subcategories/edit/{id}', ['as' => 'forum.subcategories.update', 'uses' => 'Admin\ForumSubCategoriesController@update']);
    Route::get('/forum/subcategories/delete/{id}', ['as' => 'forum.subcategories.delete', 'uses' => 'Admin\ForumSubCategoriesController@destroy']);

    Route::get('/forum/subcategories/order/{id}', ['as' => 'forum.subcategories.order', 'uses' => 'Admin\ForumSubCategoriesController@order']);
    Route::post('/forum/subcategories/order/{id}', ['as' => 'forum.subcategories.storeOrder', 'uses' => 'Admin\ForumSubCategoriesController@storeOrder']);

});

// Open-Close Forum Topic
Route::group(['middleware' => ['web', 'permission:Modérer les messages du forum']], function () {
    Route::get('/forum/topic/open/{topic_id}', ['as' => 'forum.topic.open', 'uses' => 'Admin\ForumTopicController@open']);
    Route::get('forum/topic/close/{topic_id}', ['as' => 'forum.topic.close', 'uses' => 'Admin\ForumTopicController@close']);

});

// Sponsor routes
Route::group(['middleware' => ['web', 'permission:Gérer les sponsors']], function () {
    Route::get('/sponsor/add', ['as' => 'sponsor.add', 'uses' => 'SponsorController@add']);
    Route::post('/sponsor/add', ['as' => 'sponsor.store', 'uses' => 'SponsorController@store']);
    Route::get('/sponsor/edit/{id}', ['as' => 'sponsor.edit', 'uses' => 'SponsorController@edit']);
    Route::post('/sponsor/edit/{id}', ['as' => 'sponsor.update', 'uses' => 'SponsorController@update']);
    Route::get('/sponsor/delete/{id}', ['as' => 'sponsor.delete', 'uses' => 'SponsorController@delete']);
});

// Gallery routes
Route::group(['middleware' => ['web', 'permission:Gérer la gallerie']], function () {
    Route::get('/album/add', ['as' => 'gallery.album.create', 'uses' => 'Gallery\AlbumController@add']);
    Route::post('/album/add', ['as' => 'gallery.album.store', 'uses' => 'Gallery\AlbumController@store']);
    Route::get('/album/edit/{id}', ['as' => 'gallery.album.edit', 'uses' => 'Gallery\AlbumController@edit']);
    Route::post('/album/edit/{id}', ['as' => 'gallery.album.update', 'uses' => 'Gallery\AlbumController@update']);
    Route::get('/album/delete/{id}', ['as' => 'gallery.album.delete', 'uses' => 'Gallery\AlbumController@delete']);
    Route::get('/picture/delete/{picture_name}/{album_id}', ['as' => 'gallery.picture.delete', 'uses' => 'Gallery\AlbumController@pictureDelete']);
});

// News routes
Route::group(['middleware' => ['web', 'permission:Gérer les news']], function () {
    Route::get('/news/category/', 'NewsCategoriesController@index');
    Route::get('/news/category/create', 'NewsCategoriesController@create');
    Route::post('news/category/store', 'NewsCategoriesController@store');

    Route::resource('news', 'NewsController');
});

Route::group(['middleware' => ['web', 'permission:Gérer le planning']], function () {
    Route::get('/admin/planning', ['as' => 'admin.planning', 'uses' => 'Admin\AdminController@planning']);
    Route::post('/admin/planning/store', ['as' => 'admin.planning.store', 'uses' => 'Admin\AdminController@planningStore']);
});

Route::group(['middleware' => ['web']], function () {

    // User Route
    Route::get('/user/edit/{userId}', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
    Route::post('/user/edit/{userId}', ['as' => 'users.update', 'uses' => 'UsersController@update']);
    Route::get('/logout', ['as' => 'users.logout', 'uses' => 'UsersController@logout']);

    // Forum routes
    Route::get('/forum', ['as' => 'forum.index', 'uses' => 'Forum\ForumController@index']);
    Route::get('/forum/{forumId}/topic/add', ['as' => 'forum.topic.add', 'uses' => 'Forum\ForumTopicController@add']);
    Route::post('/forum/{forumId}/topic/store', ['as' => 'forum.topic.store', 'uses' => 'Forum\ForumTopicController@store']);
    Route::get('/forum/topic/{topic_id}', ['as' => 'forum.topic.show', 'uses' => 'Forum\ForumTopicController@show']);
    Route::get('/forum/topic/signal/{message_id}', ['as' => 'forum.message.signal', 'uses' => 'Forum\ForumMessageController@storeSignaledMessage']);
    Route::get('/forum/{subcategory}', ['as' => 'forum.subcategory.index', 'uses' => 'Forum\ForumController@subcategory']);
    // Gallery
    Route::get('/gallery', ['as' => 'gallery.index', 'uses' => 'Gallery\AlbumController@index']);
    Route::get('/album/{id}', ['as' => 'gallery.album.show', 'uses' => 'Gallery\AlbumController@show']);

    // Home Page
    Route::get('/', function () {
        $page_title = 'Accueil';
        return view('welcome', compact('page_title'));
    });


    // Sponsor
    Route::get('/sponsor/index', ['as' => 'sponsor.index', 'uses' => 'SponsorController@index']);

    // Planning
    Route::get('/planning', ['as' => 'planning.show', 'uses' => 'PageController@planning']);


    Route::get('/contact', ['as' => 'contact', 'uses' => 'PageController@contact']);
    Route::post('/contact/store', ['as' => 'contact.store', 'uses' => 'PageController@contactStore']);
    Route::get('/{keyword}', ['as' => 'pages.show', 'uses' => 'PageController@show']);

});


