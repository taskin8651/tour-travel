<?php



Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
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

    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('sub-categories', \App\Http\Controllers\Admin\SubCategoryController::class);
    Route::resource('listings', \App\Http\Controllers\Admin\ListingController::class);
    Route::resource('enquiries', App\Http\Controllers\Admin\EnquiryController::class);
    Route::resource('hero-sections',App\Http\Controllers\Admin\HeroSectionController::class);
    Route::resource('galleries',App\Http\Controllers\Admin\GalleryController::class);
    Route::resource('testimonials',App\Http\Controllers\Admin\TestimonialController::class);
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class,'index'])->name('settings.index');

Route::post('settings', [App\Http\Controllers\Admin\SettingController::class,'update'])->name('settings.update');

Route::resource('blog-categories', App\Http\Controllers\Admin\BlogCategoryController::class);
Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);
 Route::resource('brands', App\Http\Controllers\Admin\BrandController::class);

  Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
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

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('/get-listings/{category}', function($categoryId){
    return \App\Models\Listing::where('category_id',$categoryId)
        ->where('status',1)
        ->select('id','title')
        ->get();
});

Route::post('/enquiry-store',
    [\App\Http\Controllers\Frontend\EnquiryController::class,'store']
)->name('frontend.enquiry.store');


Route::get('/enquiry/{slug}', [\App\Http\Controllers\Frontend\EnquiryController::class, 'create'])
    ->name('enquiry.create');


    Route::get('/category/{slug}', [\App\Http\Controllers\Frontend\CategoryPageController::class, 'index'])
    ->name('category.page');

    Route::get('/listing/{id}', [\App\Http\Controllers\Frontend\CategoryPageController::class, 'show'])
    ->name('listing.detail');


Route::get('/gallery', [\App\Http\Controllers\Frontend\GalleryController::class, 'index'])->name('gallery.index');

Route::get('/gallery/{id}', [\App\Http\Controllers\Frontend\GalleryController::class, 'show'])->name('gallery.detail');

Route::get('/contact', [\App\Http\Controllers\Frontend\ContactController::class, 'index'])->name('contact.page');
Route::post('/contact', [\App\Http\Controllers\Frontend\ContactController::class, 'store'])->name('contact.store');

Route::get('/service', [\App\Http\Controllers\Frontend\ServiceController::class, 'index'])->name('service.index');
Route::get('/service/{slug}', [\App\Http\Controllers\Frontend\ServiceController::class, 'show'])->name('service.detail');

Route::view('/', 'custom.error');