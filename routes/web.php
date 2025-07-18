<?php

use App\Http\Controllers\ResidentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::fallback(function () {
    return redirect('/');
});

Route::get('/', function () {
    return view('pages.landing');
});


Route::get('/login' , [AuthController::class, 'login'])->name('login');
Route::post('/login' , [AuthController::class, 'authenticate']);
Route::post('/logout' , [AuthController::class, 'logout']);
Route::get('/register' , [AuthController::class, 'registerView'])->name('register');
Route::post('/register' , [AuthController::class, 'register']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    });

});



Route::get('/notifications' , function () {
    return view('pages.notifications.index');
})->middleware('role:User');

Route::post('notification/{id}/read', function ($id) {
    $notification = DB::table('notifications')->where('id', $id);
    $notification->update([
        'read_at' => DB::raw('CURRENT_TIMESTAMP'),
    ]);

    $dataArray = json_decode($notification->firstOrFail()->data, true);


  if(isset($dataArray['complaint_id'])) {
    return redirect()->route('complaint.index');
  }
    return redirect()->back();
})->middleware('role:User');



Route::get('/resident' , [ResidentController::class , 'index'])->middleware('role:Admin');


Route::get('/account-list' , [UserController::class, 'account_list_view'])->middleware('role:Admin');

Route::delete('/users/{id}', [UserController::class, 'destroy_user'])->name('users.destroy')->middleware('role:Admin');

Route::get('/account-request', [UserController::class , 'account_request_view'])->middleware('role:Admin');
Route::post('/account-request/approval/{id}', [UserController::class , 'account_approval'])->middleware('role:Admin');

Route::get('/profile', [UserController::class , 'profile_view'])->middleware('role:Admin,User');
Route::post('profile/{id}', [UserController::class , 'update_profile'])->middleware('role:Admin,User');
Route::get('/change-password', [UserController::class , 'change_password_view'])->middleware('role:Admin,User');
Route::post('/change-password/{id}', [UserController::class , 'change_password'])->middleware('role:Admin,User');


Route::get('/complaint' , [ComplaintController::class , 'index'])->middleware('role:User,Admin')->name('complaint.index');;
Route::get('/complaint/create' , [ComplaintController::class , 'create'])->middleware('role:User');
Route::get('/complaint/{id}' , [ComplaintController::class , 'edit'])->middleware('role:User');
Route::post('/complaint' , [ComplaintController::class , 'store'])->middleware('role:User');
Route::put('/complaint/{complaint}', [ComplaintController::class, 'update'])->name('complaint.update');
Route::delete('/complaint/{id}', [ComplaintController::class, 'destroy'])->middleware('role:User')->name('complaint.destroy');
Route::post('/complaint/update-status/{id}', [ComplaintController::class, 'updateStatus'])->middleware('role:Admin');

// Route::resource('complaint' , [ComplaintController::class])->only([
//     'index' , 'create' , 'edit' , 'store' , 'update' , 'destroy'
// ]);

Route::get('/about-me', function () {
    return view('pages.about-me');
});
