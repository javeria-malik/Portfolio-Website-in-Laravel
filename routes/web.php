<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EducationsController;
use App\Http\Controllers\ExperiencesController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\ProjectsController;

/*
|-------------------------------------------------------------------------- 
| Web Routes
|-------------------------------------------------------------------------- 
|
| Here is where you can register web routes for your application. These 
| routes are loaded by the RouteServiceProvider and all of them will 
| be assigned to the "web" middleware group. Make something great!
|
*/

//--------------Home page routes----------
Route::get('/', [HomeController::class, 'homepage']);

//----------Authentication routes-----------
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Education Routes
    Route::resource('educations', EducationsController::class)->except(['show']);
    //Route::get('/educations/{id}/edit', [EducationsController::class, 'edit'])->name('educations.edit');
    Route::patch('/educations/{id}/toggle-status', [EducationsController::class, 'toggleStatus'])->name('educations.toggleStatus');
    //Route::patch('/educations/{id}', [EducationsController::class, 'update'])->name('educations.update');
    Route::post('/educations/{id}/restore', [EducationsController::class, 'restore'])->name('educations.restore');
    Route::delete('/educations/{id}/force-delete', [EducationsController::class, 'forceDelete'])->name('educations.force-delete');
    //Route::get('educations/index', [EducationsController::class, 'index'])->name('educations.index');


    // Experience Routes
    Route::resource('experiences', ExperiencesController::class);
    //Route::get('/experiences/{id}/edit', [ExperiencesController::class, 'edit'])->name('experiences.edit');
    Route::patch('/experiences/{experience}/toggle-status', [ExperiencesController::class, 'toggleStatus'])->name('experiences.toggleStatus');
    Route::post('/experiences/{id}/restore', [ExperiencesController::class, 'restore'])->name('experiences.restore');
    Route::delete('/experiences/{id}/force-delete', [ExperiencesController::class, 'forceDelete'])->name('experiences.force-delete');
    
    // Skills Routes
    Route::resource('skills', SkillsController::class);
   // Route::get('/skills/{skill}/edit', [SkillsController::class, 'edit'])->name('skills.edit');
    Route::patch('/skills/{skill}/toggle-status', [SkillsController::class, 'toggleStatus'])->name('skills.toggleStatus');
    Route::post('/skills/{id}/restore', [SkillsController::class, 'restore'])->name('skills.restore');
    Route::delete('/skills/{id}/force-delete', [SkillsController::class, 'forceDelete'])->name('skills.force-delete');
    
    // Services Routes
    Route::resource('services', ServiceController::class)->except(['show']);; // Default resource route for services
    Route::patch('/services/{id}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggleStatus'); // Toggle status for services
    //Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    //Route::patch('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::post('/services/{id}/restore', [ServiceController::class, 'restore'])->name('services.restore'); // Restore deleted service
    Route::delete('/services/{id}/force-delete', [ServiceController::class, 'forceDelete'])->name('services.force-delete');
    
    // projects routes
    Route::resource('projects', ProjectsController::class);
    Route::patch('/projects/{id}/toggle-status', [ProjectsController::class, 'toggleStatus'])->name('projects.toggleStatus'); // Toggle status for services
    Route::get('/projects/{id}/edit', [ProjectsController::class, 'edit'])->name('Projects.edit');
    Route::patch('/projects/{id}', [ProjectsController::class, 'update'])->name('Projects.update');
    Route::post('/projects/{id}/restore', [ProjectsController::class, 'restore'])->name('projects.restore'); // Restore deleted service
    Route::delete('/projects/{id}/force-delete', [ProjectsController::class, 'forceDelete'])->name('projects.force-delete');
    
});
