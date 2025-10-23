<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserApprovalController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitTypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\AcademicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('\welcome');
});

// Authenticated, Jetstream, verified routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Classes module (hybrid: available for all authenticated users)
    Route::resource('classes', ClassController::class)->except(['show']);

    /** Admin-only routes */
    Route::middleware('role:admin')->group(function () {
        // User Management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/approval', [UserApprovalController::class, 'index'])->name('users.approval');
        Route::post('/users/{user}/approve', [UserApprovalController::class, 'approve'])->name('users.approve');
        Route::post('/users/{user}/disapprove', [UserApprovalController::class, 'disapprove'])->name('users.disapprove');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/add', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/add', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

        // Settings: Units, Unit Types, Categories
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::resource('units', UnitController::class)->except(['show']);
            Route::resource('unit_types', UnitTypeController::class)->except(['show']);
            Route::resource('categories', CategoryController::class)->except(['show']);
        });

        // Academic Sessions & Semesters (Settings)
        Route::prefix('settings/academic')->name('settings.academic.')->group(function () {
            // Academic Session routes
            Route::get('/', [AcademicController::class, 'index'])->name('index');
            Route::get('/session/create', [AcademicController::class, 'createSession'])->name('session.create');
            Route::post('/session', [AcademicController::class, 'storeSession'])->name('session.store');
            Route::get('/session/{session}/edit', [AcademicController::class, 'editSession'])->name('session.edit');
            Route::put('/session/{session}', [AcademicController::class, 'updateSession'])->name('session.update');
            // Semester routes (nested under session)
            Route::get('/session/{session}/semester/create', [AcademicController::class, 'createSemester'])->name('semester.create');
            Route::post('/session/{session}/semester', [AcademicController::class, 'storeSemester'])->name('semester.store');
            Route::get('/semester/{semester}/edit', [AcademicController::class, 'editSemester'])->name('semester.edit');
            Route::put('/semester/{semester}', [AcademicController::class, 'updateSemester'])->name('semester.update');
        });
    });

    /** Lecturer-only routes (optional custom page) */
    Route::middleware('role:lecturer')->group(function () {
        Route::get('/lecturer/classes', function() {
            return view('lecturer.classes');
        })->name('lecturer.classes');
    });

    /** Student-only routes (optional custom page) */
    Route::middleware('role:student')->group(function () {
        Route::get('/student/classes', function() {
            return view('student.classes');
        })->name('student.classes');
    });

    /** Admin + Lecturer shared routes */
    Route::middleware(['role:admin,lecturer'])->group(function () {
        // Ingredients
        Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');
        Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create');
        Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
        Route::get('/ingredients/{ingredient}', [IngredientController::class, 'show'])->name('ingredients.show');
        Route::get('/ingredients/{ingredient}/edit', [IngredientController::class, 'edit'])->name('ingredients.edit');
        Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('ingredients.update');
        Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');

        // Stock
        Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
        Route::get('/stock/central-store', [StockController::class, 'centralStore'])->name('stock.central');
        Route::get('/stock/central-store/filter', [StockController::class, 'centralStore'])->name('stock.central.filter');
        Route::get('/stock/class-storage', [StockController::class, 'classStorage'])->name('stock.class');
        Route::get('/stock/class-storage/{class}', [StockController::class, 'classStorageView'])->name('stock.class.view');

        // Edit and update stock
        Route::get('/stock/{stock}/edit', [StockController::class, 'edit'])->name('stock.edit');
        Route::put('/stock/{stock}', [StockController::class, 'update'])->name('stock.update');

        // Transfer stock form and action
        Route::get('/stock/{stock}/transfer', [StockController::class, 'transferForm'])->name('stock.transfer.form');
        Route::post('/stock/{stock}/transfer', [StockController::class, 'transfer'])->name('stock.transfer');
    });
});