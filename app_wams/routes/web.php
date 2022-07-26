<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardAmSalesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardViewController;
use App\Http\Controllers\ElearningController as ControllersElearningController;
use App\Http\Controllers\SALES\ElearningController;
use App\Http\Controllers\SALES\SalesOptyController;
use App\Http\Controllers\SALES\SalesOrderController;
use App\Http\Controllers\UM\InputwoController;
use App\Http\Controllers\UM\ListdController;
use App\Http\Controllers\UM\ApprovalController;
use App\Http\Controllers\UM\ReportpController;
use App\Http\Controllers\UM\UmDashboardController;
use App\Http\Controllers\viewControlerrSuperAdmin\AuthControllerM;
use App\Http\Controllers\viewControlerrSuperAdmin\PermisiionControlerr;
use App\Http\Controllers\viewControlerrSuperAdmin\ProjectTimelineControllerM;
use App\Http\Controllers\viewControlerrSuperAdmin\RoleControllerM;
use App\Http\Controllers\viewControlerrSuperAdmin\SalesControllerM;
use App\Http\Controllers\viewControlerrSuperAdmin\SalesOrderControllerM;
use App\Http\Middleware\IsAdmin;
use App\Models\SalesOpty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group Awhich
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


// ! Routing dashboard Super Admin
Route::group(['middleware' ] , function() 
{
  Route::get('/dashboardSuperAdmin', [DashboardAdminController::class,'index'])->name('/dashboardSuperAdmin');
  
  //! route role
  Route::get('/dashboard/role', [RoleControllerM::class,'index'])->name('/dashboard/role');
  Route::get('/dashboard/addRole', [RoleControllerM::class,'create'])->name('/dashboard/addRole');
  Route::post('/dashboard/saveRole', [RoleControllerM::class,'store'])->name('/dashboard/saveRole');
  Route::get('/editRole/{id}', [RoleControllerM::class,'edit']);
  Route::post('/dashboard/updateEdit/{id}', [RoleControllerM::class,'update'])->name('/dashboard/updateEdit');
  Route::get('/dashboard/deleteRole/{id}', [RoleControllerM::class,'destroy']);
  
  // !permision
  Route::get('/dashboardPermision', [PermisiionControlerr::class,'index'])->name('/dashboardPermision');
  Route::get('/dashboard/addPermission', [PermisiionControlerr::class,'create'])->name('/dashboard/addPermission');
  Route::post('/dashboard/savePermission', [PermisiionControlerr::class,'store'])->name('/dashboard/savePermission');
  Route::get('/editPermission/{id}', [PermisiionControlerr::class,'edit']);
  Route::post('/dashboard/updatePermission/{id}', [PermisiionControlerr::class,'update'])->name('/dashboard/updatePermission');
  Route::get('/dashboard/deletePermission/{id}', [PermisiionControlerr::class,'destroy']);


  //! route management user
  Route::get('/dashboard/user', [AuthControllerM::class,'index'])->name('/dashboard/user');
  Route::get('/dashboard/addUser', [AuthControllerM::class,'create'])->name('/dashboard/addUser');
  Route::post('/dashboard/saveUser', [AuthControllerM::class,'store'])->name('/dashboard/saveUser');
  Route::get('/editUser/{id}', [AuthControllerM::class,'edit']);
  Route::post('/dashboard/updateUser/{id}', [AuthControllerM::class,'update'])->name('/dashboard/updateUser');
  Route::get('/dashboard/deleteUser/{id}', [AuthControllerM::class,'destroy']);

  //! Route Sales opty & order
  // sales opty
  
  Route::get('/index-sales',[SalesViewController::class,'index'])->name('index-sales');
  Route::get('/inputsales',[SalesViewController::class,'create'])->name('inputsales');
  Route::post('/simpan-data',[SalesViewController::class,'store'])->name('simpan-data');
  Route::get('/filter',[SalesViewController::class,'filter'])->name('salesopty.filter');
  Route::get('/detail/{id}',[SalesViewController::class,'show'])->name('detail');
  Route::get('/delete/{id}', [SalesViewController::class, 'destroy'])->name('delete');
  Route::get('/exportsalesopty', [SalesViewController::class, 'export'])->name('exportsalesopty');
  Route::get('/edit/{id}', [SalesViewController::class,'edit'])->name('edit');
  Route::post('/simpan/{id}', [SalesViewController::class,'update'])->name('simpan');
  Route::get('/elearning',[ElearningController::class,'index'])->name('elearning');
  Route::get('/cetak', [SalesViewController::class,'cetak'])->name('cetak');
  Route::get('/home',[DashboardViewController::class,'index'])->name('home');
  

  // sales order
  Route::get('/dashboard/salesOrder', [SalesOrderControllerM  ::class,'index'])->name('/dashboard/salesOrder');
  Route::get('/dashboard/addSalesOrder', [SalesOrderControllerM::class,'create'])->name('/dashboard/addSalesOrder');
  route::post('/saOrder/saveData', [SalesOrderController::class, 'store'])->name('saOrder/saveData');
  route::post('/update-data/{id}', [SalesOrderController::class, 'update'])->name('update-data');
  route::get('/edit/{id}', [SalesOrderController::class, 'edit'])->name('edit');
  route::get('/del/{id}', [SalesOrderController::class, 'destroy'])->name('del');

  //! Route Project Timline
  Route::get('/dashboard/projectTimeline', [ProjectTimelineControllerM  ::class,'index'])->name('/dashboard/projectTimeline');
  Route::get('/dashboard/ProjectTimeline', [ProjectTimelineControllerM::class,'create'])->name('/dashboard/ProjectTimeline');
  Route::post('/dashboard/addProjectTimeline', [ProjectTimelineControllerM::class,'store'])->name('/dashboard/addProjectTimeline');
});

//! Routing dashboard AM/Sales
Route::group(['middleware'], function() 
{
  Route::get('/dashboardAmSales', [DashboardAmSalesController::class,'index'])->name('/dashboardAmSales');

  Route::get('/elearning', [ElearningController::class,'index']);

  Route::get('/slsorder', [SalesOrderController::class,'index'])->name('slsorder');
  Route::get('/createodr', [SalesOrderController::class,'create'])->name('createodr');
  route::post('/Ssimpan-data', [SalesOrderController::class, 'store'])->name('Ssimpan-data');
  route::put('/update-data/{id}', [SalesOrderController::class, 'update'])->name('update-data');
  route::get('/Sedit/{id}', [SalesOrderController::class, 'edit'])->name('Sedit');
  route::get('/del/{id}', [SalesOrderController::class, 'destroy'])->name('del');
  Route::get('/order-export', [SalesOrderController::class,'export'])->name('order-export');
  // sales opty
  Route::get('/index-sales',[SalesOptyController::class,'index'])->name('index-sales');
  Route::get('/inputsales',[SalesOptyController::class,'create'])->name('inputsales');
  Route::post('/Ysimpan-data',[SalesOptyController::class,'store'])->name('Ysimpan-data');
  Route::get('/Yfilter',[SalesOptyController::class,'filter'])->name('salesopty.filter');
  Route::get('/Ydetail/{id}',[SalesOptyController::class,'show'])->name('Ydetail');
  Route::get('/Ydelete/{id}', [SalesOptyController::class, 'destroy'])->name('Ydelete');
  Route::get('/exportsalesopty', [SalesOptyController::class, 'export'])->name('exportsalesopty');
  Route::get('/Yedit/{id}', [SalesOptyController::class,'edit'])->name('Yedit');
  Route::post('/Ysimpan/{id}', [SalesOptyController::class,'update'])->name('Ysimpan');
  Route::get('/Ycetak', [SalesOptyController::class,'cetak'])->name('Ycetak');
});

//teknikal
Route::group(['middleware'], function() 
{

  Route::get('/dashboardTeknikal',[DashboardController::class, 'index'])->name('dashboard');
  Route::get('/telearning',[ControllersElearningController::class,'index'])->name('elearning');
  Route::get('/create-elearning',[ControllersElearningController::class,'create'])->name('create-elearning');
  Route::post('/simpan-data',[ControllersElearningController::class,'store'])->name('simpan-data');
  Route::get('/edit/{id}',[ControllersElearningController::class,'edit'])->name('edit');
  Route::get('/delete/{id}',[ControllersElearningController::class,'destroy']);
  Route::post('/update-data/{id}',[ControllersElearningController::class,'update'])->name('update-data');
});


//! Routing dashboard Management
Route::group(['middleware'  => ['role:Management']], function() 
{
  Route::get('/um/dashboard', [UmDashboardController::class,'index']);
  Route::get('/approval', [ApprovalController::class,'index']);
  Route::get('/detailapproval/{id}', [ApprovalController::class,'show']);
  Route::get('/reportp', [ReportpController::class,'index']);
  Route::get('/inputwo', [InputwoController::class,'index']);
  Route::get('/listd', [ListdController::class,'index']);
});

//! Routing dashboard Finance
// Route::group(['middleware' => ['role:Finance']], function() 
// {

// });


// });









Route::post('logout', [LoginController::class, 'logout']);

