<?php

use App\Http\Controllers\Backend\Fees\FeesController;
use App\Http\Controllers\Backend\Fees\FundAccountsController;
use App\Http\Controllers\Backend\Fees\InvoicesController;
use App\Http\Controllers\Backend\Fees\ReceiptStudentsController;
use App\Http\Controllers\Backend\Grade\ClassRoomsController;
use App\Http\Controllers\Backend\Grade\GradeController;
use App\Http\Controllers\Backend\Sections\SectionController;
use App\Http\Controllers\Backend\Student\GraduatedController;
use App\Http\Controllers\Backend\Student\ParentsController;
use App\Http\Controllers\Backend\Student\PromotionController;
use App\Http\Controllers\Backend\Student\StudentController;
use App\Http\Controllers\Backend\Teacher\TeacherController;
use App\Http\Controllers\Backend\UserController;
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
    Route::get('/', function () {
        return Inertia::render('Home');
    })->name('dashboard');
});



Route::middleware('auth')->group(function () {


    /// User Routes
    Route::get('/', function () {
        return Inertia::render('Home');
    })->name('home');
    Route::get('/profile', function () {
        return Inertia::render('Auth/Profile');
    });

    Route::post('profile/update', [UserController::class,'userLogin']);
    Route::post('update/backcover', [UserController::class,'backCover']);


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

    /// Students Routes
    Route::prefix('students')->group(function(){
        Route::prefix('parent')->group(function(){
            Route::get('/show',[ParentsController::class,'show'])->name('parent.show');
            Route::get('/add',[ParentsController::class,'Add'])->name('parent.add');
            Route::post('/store',[ParentsController::class,'store'])->name('parent.store');
            Route::get('/edit/{id}',[ParentsController::class,'edit'])->name('parent.edit');
            Route::post('/update/{id}',[ParentsController::class,'update'])->name('parent.update');
            Route::delete('/delete/{id}',[ParentsController::class,'destroy'])->name('parent.delete');
        });
    });


    /// Teacher Routes
    Route::resource('teacher', TeacherController::class);

    /// Students Routes
    Route::resource('student', StudentController::class);
    Route::post('/student/upload', [StudentController::class,'upload_new'])->name('upload_new_att');
    Route::get('Std/{stdName}/{file}', [StudentController::class,'downloadAtt'])->name('downloadStudAtt');
    Route::delete('/delete/{id}', [StudentController::class,'deleteAtt'])->name('deleteStudAtt');
    Route::get("search/{name}",[StudentController::class,"search"])->name('search');


    /// Promotion Students Routes
    Route::resource('promotion', PromotionController::class);
    Route::get('prostd/return/{id}', [PromotionController::class,'stdReturn'])->name('stdReturn');


    /// Graduated Students Routes
    Route::resource('graduated', GraduatedController::class);

    /// Fees Routes
    Route::resource('fees', FeesController::class);
    Route::resource('invoices', InvoicesController::class);
    Route::resource('receipt', ReceiptStudentsController::class);
    Route::resource('fund_account', FundAccountsController::class);




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


