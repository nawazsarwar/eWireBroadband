<?php

Route::view('/', 'welcome');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Expense Report
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Subscribers
    Route::delete('subscribers/destroy', 'SubscribersController@massDestroy')->name('subscribers.massDestroy');
    Route::post('subscribers/media', 'SubscribersController@storeMedia')->name('subscribers.storeMedia');
    Route::post('subscribers/ckmedia', 'SubscribersController@storeCKEditorImages')->name('subscribers.storeCKEditorImages');
    Route::post('subscribers/parse-csv-import', 'SubscribersController@parseCsvImport')->name('subscribers.parseCsvImport');
    Route::post('subscribers/process-csv-import', 'SubscribersController@processCsvImport')->name('subscribers.processCsvImport');
    Route::resource('subscribers', 'SubscribersController');

    // Receivables
    Route::delete('receivables/destroy', 'ReceivablesController@massDestroy')->name('receivables.massDestroy');
    Route::post('receivables/parse-csv-import', 'ReceivablesController@parseCsvImport')->name('receivables.parseCsvImport');
    Route::post('receivables/process-csv-import', 'ReceivablesController@processCsvImport')->name('receivables.processCsvImport');
    Route::resource('receivables', 'ReceivablesController');

    // Support Statuses
    Route::delete('support-statuses/destroy', 'SupportStatusesController@massDestroy')->name('support-statuses.massDestroy');
    Route::resource('support-statuses', 'SupportStatusesController');

    // Support Priorities
    Route::delete('support-priorities/destroy', 'SupportPrioritiesController@massDestroy')->name('support-priorities.massDestroy');
    Route::resource('support-priorities', 'SupportPrioritiesController');

    // Support Categories
    Route::delete('support-categories/destroy', 'SupportCategoriesController@massDestroy')->name('support-categories.massDestroy');
    Route::resource('support-categories', 'SupportCategoriesController');

    // Support Tickets
    Route::delete('support-tickets/destroy', 'SupportTicketsController@massDestroy')->name('support-tickets.massDestroy');
    Route::resource('support-tickets', 'SupportTicketsController');

    // Support Comments
    Route::delete('support-comments/destroy', 'SupportCommentsController@massDestroy')->name('support-comments.massDestroy');
    Route::resource('support-comments', 'SupportCommentsController');

    // Order
    Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
    Route::resource('orders', 'OrderController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Subscribers
    Route::delete('subscribers/destroy', 'SubscribersController@massDestroy')->name('subscribers.massDestroy');
    Route::post('subscribers/media', 'SubscribersController@storeMedia')->name('subscribers.storeMedia');
    Route::post('subscribers/ckmedia', 'SubscribersController@storeCKEditorImages')->name('subscribers.storeCKEditorImages');
    Route::resource('subscribers', 'SubscribersController');

    // Receivables
    Route::delete('receivables/destroy', 'ReceivablesController@massDestroy')->name('receivables.massDestroy');
    Route::resource('receivables', 'ReceivablesController');

    // Support Statuses
    Route::delete('support-statuses/destroy', 'SupportStatusesController@massDestroy')->name('support-statuses.massDestroy');
    Route::resource('support-statuses', 'SupportStatusesController');

    // Support Priorities
    Route::delete('support-priorities/destroy', 'SupportPrioritiesController@massDestroy')->name('support-priorities.massDestroy');
    Route::resource('support-priorities', 'SupportPrioritiesController');

    // Support Categories
    Route::delete('support-categories/destroy', 'SupportCategoriesController@massDestroy')->name('support-categories.massDestroy');
    Route::resource('support-categories', 'SupportCategoriesController');

    // Support Tickets
    Route::delete('support-tickets/destroy', 'SupportTicketsController@massDestroy')->name('support-tickets.massDestroy');
    Route::resource('support-tickets', 'SupportTicketsController');

    // Support Comments
    Route::delete('support-comments/destroy', 'SupportCommentsController@massDestroy')->name('support-comments.massDestroy');
    Route::resource('support-comments', 'SupportCommentsController');

    // Order
    Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
    Route::resource('orders', 'OrderController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
