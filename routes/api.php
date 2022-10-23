<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Assets History
    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Subscribers
    Route::post('subscribers/media', 'SubscribersApiController@storeMedia')->name('subscribers.storeMedia');
    Route::apiResource('subscribers', 'SubscribersApiController');

    // Receivables
    Route::apiResource('receivables', 'ReceivablesApiController');

    // Support Statuses
    Route::apiResource('support-statuses', 'SupportStatusesApiController');

    // Support Priorities
    Route::apiResource('support-priorities', 'SupportPrioritiesApiController');

    // Support Categories
    Route::apiResource('support-categories', 'SupportCategoriesApiController');

    // Support Tickets
    Route::apiResource('support-tickets', 'SupportTicketsApiController');

    // Support Comments
    Route::apiResource('support-comments', 'SupportCommentsApiController');

    // Order
    Route::apiResource('orders', 'OrderApiController');
});
