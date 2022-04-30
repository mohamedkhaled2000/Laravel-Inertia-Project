<?php

use App\Http\Controllers\Backend\Grade\ClassRoomsController;
use App\Http\Controllers\Backend\Grade\GradeController;
use App\Http\Controllers\Backend\Sections\SectionController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Controller;
use App\Models\ClassRooms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {


    /// User Routes
    Route::get('/', function () {
        return Inertia::render('Home');
    });
    Route::get('/profile', function () {
        return Inertia::render('Auth/Profile');
    });
    Route::post('profile/update', [UserController::class,'userLogin']);


    /// Grade Routes
    Route::prefix('grade')->group(function(){
        Route::get('/view',[GradeController::class,'index'])->name('grade.index');
        Route::get('/add',[GradeController::class,'add'])->name('garde.add');
        Route::post('/store',[GradeController::class,'store'])->name('grade.store');
        Route::delete('/delete/{id}',[GradeController::class,'destroy'])->name('garde.delete');
        Route::get('/edit/{id}',[GradeController::class,'edit'])->name('grade.edit');
        Route::post('/update/{id}',[GradeController::class,'update'])->name('grade.update');
    });

    /// ClassRooms Routes
    Route::prefix('classes')->group(function(){
        Route::get('/view',[ClassRoomsController::class,'index'])->name('class.index');
        Route::post('/store',[ClassRoomsController::class,'store'])->name('class.store');
        Route::delete('/delete/{id}',[ClassRoomsController::class,'destroy'])->name('class.delete');
        Route::get('/edit/{id}',[ClassRoomsController::class,'edit'])->name('class.edit');
        Route::post('/update/{id}',[ClassRoomsController::class,'update'])->name('class.update');
        Route::post('delete_all/{slug}',[ClassRoomsController::class,'delete_all'])->name('delete_all');
    });

    /// Sections Routes
    Route::prefix('sections')->group(function(){
        Route::get('/view',[SectionController::class,'index'])->name('section.index');
        Route::post('/store',[SectionController::class,'store'])->name('section.store');
        Route::delete('/delete/{id}',[SectionController::class,'destroy'])->name('section.delete');
        Route::get('/edit/{id}',[SectionController::class,'edit'])->name('section.edit');
        Route::post('/update/{id}',[SectionController::class,'update'])->name('section.update');
    });




    // Route::get('/user', function () {
    //     return Inertia::render('User/index', [
    //         'users' => User::when(Request::input('search'), function ($quary, $search) {
    //             $quary->where('name', 'LIKE', '%' . $search . '%');
    //         })
    //             ->select('id', 'name')
    //             ->paginate(3)
    //             ->withQueryString(),

    //         'filter' => Request::only(['search'])
    //     ]);
    // });

    // Route::get('/user/create', function () {
    //     return Inertia::render('User/create');
    // });
    // Route::post('/user/store', function () {
    //     $validate = Request::validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);

    //     User::create($validate);

    //     return redirect('/user');
    // });
});


