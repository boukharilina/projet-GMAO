<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ModalitesController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\EquipementController;
use App\Http\Controllers\Admin\DepartementController;
use App\Http\Controllers\Admin\SousequipementController;
use App\Http\Controllers\Admin\InterventionController;
use App\Http\Controllers\Admin\EtatController;
use App\Http\Controllers\Admin\ContratController;
use App\Http\Controllers\Admin\SoustraitantController;
use App\Http\Controllers\Admin\SousinterventionController;
use App\Http\Controllers\Admin\TacheController;
use App\Http\Controllers\Admin\PieceController;
use App\Http\Controllers\Admin\GoogleCalendarController;
use App\Http\livewire\Calendar ;
use Spatie\GoogleCalendar\Event;
use Livewire\Livewire;

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
Route::middleware(['auth'])->group(function(){
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('',[DashboardController::class,'Index']);
    Route::get('notification',[NotificationController::class,'markAsRead'])->name('mark-as-read');
    Route::get('notification-read',[NotificationController::class,'read'])->name('read');
    Route::get('profile',[UserController::class,'profile'])->name('profile');
    Route::post('profile/{user}',[UserController::class,'updateProfile'])->name('profile.update');
    Route::put('profile/update-password/{user}',[UserController::class,'updatePassword'])->name('update-password');
    Route::post('logout',[LogoutController::class,'index'])->name('logout');

    Route::resource('users',UserController::class);
    Route::resource('permissions',PermissionController::class)->only(['index','store','destroy']);
    Route::put('permission',[PermissionController::class,'update'])->name('permissions.update');
    Route::resource('roles',RoleController::class);


    Route::get('interventions/reports',[InterventionController::class,'reports'])->name('interventions.report');
    Route::post('interventions/reports',[InterventionController::class,'generateReport']);
    
    /*taches routes*/
    Route::resource('taches',TacheController::class);

   /*equipments routes*/
    Route::get('equipements/reports',[EquipementController::class,'reports'])->name('equipements.report');
    Route::post('equipements/reports',[EquipementController::class,'generateReport']);
    Route::post('/equipements/report/search',[EquipementController::class,'generateReport'])->name('equipements.report.search');
    Route::get('/getEquipements', [EquipementController::class, 'getEquipements']);
    Route::post('/UpdategetEquipements', [EquipementController::class, 'UpdategetEquipements']);


<<<<<<< HEAD
    /*Calendrier routes*/
   Route::get('fullcalendar', [CalendarController::class, 'index']);
   Route::get('/events', [CalendarController::class, 'getEvents']);
   Route::delete('/calendar/{id}', [CalendarController::class, 'deleteEvent']);
   Route::put('/calendar/{id}', [CalendarController::class, 'update']);
   Route::put('/calendar/{id}/resize', [CalendarController::class, 'resize']);
   Route::get('/events/search', [CalendarController::class, 'search']);
   Route::view('add-calendar', 'admin.calendar.add');
   Route::post('create-calendar', [CalendarController::class, 'create']);

   Route::get('/calender', function () {
    return view('home');
    });
=======
    /*Calendrier*/
    Route::get('/calendar', [Calendar::class, 'index']);
    Route::post('/save-event', [Calendar::class, 'saveEvent']);
    Route::get('/google-calendar/connect',[GoogleCalendarController::class, 'connect']);
    Route::post('/google-calendar/connect',[GoogleCalendarController::class, 'store']);
    Route::get('/get-resource',[GoogleCalendarController::class,'getResources']);
    Route::get('/get-events',function(){
        $e = Event:: get();
        dd($e);
    });

    Route::get('backup', [BackupController::class,'index'])->name('backup.index');
    Route::put('backup/create', [BackupController::class,'create'])->name('backup.store');
    Route::get('backup/download/{file_name?}', [BackupController::class,'download'])->name('backup.download');
    Route::delete('backup/delete/{file_name?}', [BackupController::class,'destroy'])->where('file_name', '(.*)')->name('backup.destroy');

    Route::get('settings',[SettingController::class,'index'])->name('settings');
>>>>>>> lina
    /*sous traitants routes*/
    Route::resource('soustraitants',SoustraitantController::class);

    /*clients routes*/
    Route::resource('clients',ClientController::class);



    /*backup routes*/
    Route::get('backup', [BackupController::class,'index'])->name('backup.index');
    Route::put('backup/create', [BackupController::class,'create'])->name('backup.store');
    Route::get('backup/download/{file_name?}', [BackupController::class,'download'])->name('backup.download');
    Route::delete('backup/delete/{file_name?}', [BackupController::class,'destroy'])->where('file_name', '(.*)')->name('backup.destroy');
    Route::get('settings',[SettingController::class,'index'])->name('settings');



    /*modalites routes*/
    Route::resource('modalites',ModalitesController::class);
    Route::put('modalites',[ModalitesController::class,'update'])->name('modalites.update');
    Route::get('modalites/reports',[ModalitesController::class,'reports'])->name('modalites.report');

    /*departements routes*/
    Route::resource('departements',DepartementController::class)->only(['index','store','destroy']);
    Route::put('departements',[DepartementController::class,'update'])->name('departements.update');

    /*equipements routes */
    Route::resource('equipements',EquipementController::class);
    Route::post('/equipements/{id}/addPiece', [EquipementController::class, 'addPiece'])->name('equipements.addPiece');
    

    /*Contrat routes*/
    Route::resource('contrats',ContratController::class)->except('show');
    Route::get('contrats/reports',[ContratController::class,'reports'])->name('contrats.report');
    Route::post('contrats/reports',[ContratController::class,'generateReport']);


    /*Sous Equipements routes*/
    Route::resource('sousequipements',SousequipementController::class)->except('create','store','show');
    Route::get('/equipements/{equipement_id}/sousequipements/create', [SousequipementController::class,'create']);
    Route::post('/equipements/{equipement_id}/store', [SousequipementController::class,'store'])->name('sousequipements.store');
    Route::get('/getSousequipements', [SousequipementController::class, 'getSousequipements']);

    /*etats maintenance routes*/
    Route::resource('etats',EtatController::class)->only(['index','store','destroy']);
    Route::put('etats',[EtatController::class,'update'])->name('etats.update');

    /*Interventions routes*/
    Route::resource('interventions',InterventionController::class);
    Route::get('/getClientName', [InterventionController::class, 'getClientName']);
    Route::get('interventions.archive', [InterventionController::class, 'archive'])->name('interventions.archive');
    Route::get('interventions.unclosed', [InterventionController::class, 'unclosed'])->name('interventions.unclosed');


    /*sous interventions routes*/
    Route::post('sousinterventions/{intervention_id}/store', [SousinterventionController::class,'store'])->name('sousinterventions.store');
    Route::resource('sousinterventions',SousinterventionController::class)->except('create','store','show');

    /*pièces remplacées routes*/
    Route::post('pieces/{intervention_id}/store', [PieceController::class,'store'])->name('pieces.store');
    Route::resource('pieces',PieceController::class)->except('create','store','show');
});

    Route::middleware(['guest'])->group(function () {
    Route::get('',function(){
        return redirect()->route('dashboard');
    });

    Route::get('login',[LoginController::class,'index'])->name('login');
    Route::post('login',[LoginController::class,'login']);

    Route::get('register',[RegisterController::class,'index'])->name('register');
    Route::post('register',[RegisterController::class,'store']);

    Route::get('forgot-password',[ForgotPasswordController::class,'index'])->name('password.request');
    Route::post('forgot-password',[ForgotPasswordController::class,'requestEmail']);
    Route::get('reset-password/{token}',[ResetPasswordController::class,'index'])->name('password.reset');
    Route::post('reset-password',[ResetPasswordController::class,'resetPassword'])->name('password.update');




});
