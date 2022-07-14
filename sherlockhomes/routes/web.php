<?php
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Main::class, 'index']);
Auth::routes();
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/favorites', [App\Http\Controllers\PropertieController::class, 'favs']);

Route::get('/prop/{propertie}', [App\Http\Controllers\Main::class, 'show']
//  function () {
//     return view('single-propertie');
// }
);
Route::get('/results', [App\Http\Controllers\Main::class, 'search']);
Route::group(['middleware'=>['auth']], function(){
    Route::post('favorite/{prop}/add', [App\Http\Controllers\FavoriteController::class, 'add'])->name('prop.favorite');
});

//? Rotas necessárias para a recuperação de password.
Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');

Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 

Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');

Route::post('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
//?================================================================================================================================

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/properties', [App\Http\Controllers\PropertieController::class, 'index'])->name('properties');
Route::post('/properties', [App\Http\Controllers\PropertieController::class, 'store']);

Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
Route::put('/user/{user}/addRole', [App\Http\Controllers\HomeController::class, 'addAdmin']);
Route::put('/user/{user}/removeRole', [App\Http\Controllers\HomeController::class, 'removeAdmin']);
Route::delete('/user/{user}', [App\Http\Controllers\HomeController::class, 'deleteUser']);

Route::get('/propertie/create', [App\Http\Controllers\PropertieController::class, 'create'])->name('propertie.create');

Route::get('/propertie/{propertie}/edit', [App\Http\Controllers\PropertieController::class, 'edit']);
Route::put('/propertie/{propertie}', [App\Http\Controllers\PropertieController::class, 'update']);

Route::delete('/propertie/{propertie}', [App\Http\Controllers\PropertieController::class, 'destroy']);






// use App\Http\Controllers\Auth\ForgotPasswordController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\Main;
// use App\Models\Properties;

//Route::get('/properties', [App\Http\Controllers\HomeController::class, 'properties'])->name('properties');//!Confusão aqui reparar