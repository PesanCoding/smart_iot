<?php
use App\Http\Controllers\{
    ModeController,
    DevicesController,
    ControlController,
    MonitoringController,
    UserController,
    CetakController,
    DashboardController,
    VolairController
};
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::group([
    'middleware' => ['auth','role:admin,user_p']
], function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('dashboard', DashboardController::class);
    Route::resource('devices', DevicesController::class);
    Route::resource('cetak', CetakController::class);
    Route::post('monitoring/delete', [MonitoringController::class, 'deleteall'])->name('deleteall');
    Route::resource('monitoring', MonitoringController::class);
    Route::get('ph', [MonitoringController::class, 'ph']);
    Route::get('sensorPdf/{tanggal}', [CetakController::class, 'cetakPDF'])->name('PDF');
    Route::resource('user', UserController::class);

});
Route::group([
    'middleware' => 'role:admin'
], function(){
    Route::get('/data-detail/{id}/{name}/{date}',[CetakController::class,'detaildata'])->name('datadetail');
    Route::get('/devices-publish/{id}',[DevicesController::class,'publish_device'])->name('publish_device');
    Route::post('/deleteUser',[UserController::class,'deleteUser'])->name('delete.user');
    Route::get('id_devices/{id}', [MonitoringController::class, 'Id_device'])->name('id_devices');
    Route::get('cetak/data/{id}/{name}/{date}',[CetakController::class,'cetakData'])->name('cetakData');
});
Route::group([
    'middleware' => 'role:user_p'
], function(){
    route::delete('/hapus-auto', [MonitoringController::class,'deleteAuto']);
    Route::get('/data', [MonitoringController::class, 'dataloger']);
    Route::get('/dataIndikator', [MonitoringController::class, 'dataStatus']);
    Route::get('volume', [VolairController::class, 'volume']);
    Route::get('rekapData', [VolairController::class, 'rekapData']);
    Route::resource('mode', ModeController::class);
    Route::resource('volair', VolairController::class);
    Route::resource('control', ControlController::class);
    Route::get('changeStatus', [ModeController::class, 'changeStatus']);
    Route::get('changeState', [ControlController::class, 'changeState']);
    Route::get('ph', [MonitoringController::class, 'ph']);
    Route::post('/deleteSelectSensor',[MonitoringController::class,'deleteSelected'])->name('delete.selected');
    Route::post('/deleteCountry',[MonitoringController::class,'deleteSensor'])->name('delete.sensor');
});

Route::get('/modestatus', [ModeController::class, 'modestatus']);
Route::get('/waktu', [MonitoringController::class, 'waktu']);

