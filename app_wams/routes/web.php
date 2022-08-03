<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\sales\AmSalesController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardAmSalesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardleadController;
use App\Http\Controllers\DashboardPmController;
use App\Http\Controllers\DashboardViewController;
use App\Http\Controllers\ElearningController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\ListProjectPmController;
use App\Http\Controllers\ListProjectTechController;
use App\Http\Controllers\SALES\SalesOptyController;
use App\Http\Controllers\SALES\SalesOrderController;
use App\Http\Controllers\SALES\SElearningController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TimeLineController;
use App\Http\Controllers\UM\InputwoController;
use App\Http\Controllers\UM\ListdController;
use App\Http\Controllers\UM\ApprovalController;
use App\Http\Controllers\UM\NotifManagementController;
use App\Http\Controllers\UM\ReportpController;
use App\Http\Controllers\UM\UmDashboardController;
use App\Http\Controllers\viewControlerrSuperAdmin\AuthControllerM;
use App\Http\Controllers\viewControlerrSuperAdmin\PermisiionControlerr;
use App\Http\Controllers\viewControlerrSuperAdmin\ProjectTimelineControllerM;
use App\Http\Controllers\viewControlerrSuperAdmin\RoleControllerM;
use App\Http\Controllers\viewControlerrSuperAdmin\SalesControllerM;
use App\Http\Controllers\viewControlerrSuperAdmin\SalesOrderControllerM;
use App\Http\Controllers\WeeklyReportController;
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
  
  Route::get('/dashboard/salesOpty',[ SalesControllerM::class,'index'])->name('/dashboard/salesOpty');
  Route::get('/Minputsales',[ SalesControllerM::class,'create'])->name('Minputsales');
  Route::post('/Msimpan-data',[ SalesControllerM::class,'store'])->name('Msimpan-data');
  Route::get('/filter',[ SalesControllerM::class,'filter'])->name('salesopty.filter');
  Route::get('/Mdetail/{id}',[ SalesControllerM::class,'show'])->name('Mdetail');
  Route::get('/Mdelete/{id}', [ SalesControllerM::class, 'destroy'])->name('Mdelete');
  Route::get('/exportsalesopty', [ SalesControllerM::class, 'export'])->name('exportsalesopty');
  Route::get('/Medit/{id}', [ SalesControllerM::class,'edit'])->name('Medit');
  Route::post('/Msimpan/{id}', [ SalesControllerM::class,'update'])->name('Msimpan');
  Route::get('/elearning',[ElearningController::class,'index'])->name('elearning');
  Route::get('/Mcetak', [ SalesControllerM::class,'cetak'])->name('cetak');
  Route::get('/home',[DashboardViewController::class,'index'])->name('home');
  

  // sales order
  Route::get('/dashboard/salesOrder', [SalesOrderControllerM::class,'index'])->name('/dashboard/salesOrder');
  Route::get('/dashboard/addSalesOrder', [SalesOrderControllerM::class,'create'])->name('/dashboard/addSalesOrder');
  route::post('/saOrder/saveData', [SalesOrderControllerM::class, 'store'])->name('saOrder/saveData');
  route::post('/update-data/{id}', [SalesOrderControllerM::class, 'update'])->name('update-data');
  route::get('/edit/{id}', [SalesOrderControllerM::class, 'edit'])->name('edit');
  route::get('/del/{id}', [SalesOrderControllerM::class, 'destroy'])->name('del');

  //! Route PM
  Route::get('/dashboardpm',[DashboardPmController::class,'index'])->name('dasboardpm');

  
  Route::get('/listproject',[ListProjectTechController::class,'index'])->name('listproject');
  Route::post('/simpan-list',[ListProjectTechController::class,'store'])->name('simpan-list');
  Route::post('/work_order',[ListProjectTechController::class,'work']);
  
 
  Route::get('/timeline',[TimeLineController::class,'index'])->name('timeline');
  Route::get('/input',[TimeLineController::class,'create'])->name('input');
  Route::post('/simpan-data',[TimeLineController::class,'store'])->name('simpan-data');
  
  // Route::get('/task',[CobaController::class,'index']);
  // Route::post('/simpan-task',[CobaController::class,'store'])->name('simpan-task');
});


//! Routing dashboard AM/Sales
Route::group(['middleware'], function() 
{
  Route::get('/dashboardAmSales', [DashboardAmSalesController::class,'index'])->name('/dashboardAmSales');

   Route::get('/selearning', [SElearningController::class,'index']);

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
  Route::get('/telearning',[ElearningController::class,'index'])->name('elearning');
  Route::get('/create-elearning',[ElearningController::class,'create'])->name('create-elearning');
  Route::post('/Esimpan-data',[ElearningController::class,'store'])->name('Esimpan-data');
  Route::get('/edit/{id}',[ElearningController::class,'edit'])->name('edit');
  Route::get('/delete/{id}',[ElearningController::class,'destroy']);
  Route::post('/update-data/{id}',[ElearningController::class,'update'])->name('update-data');

  Route::get('/dashboard',[DashboardController::class,'index']);
  Route::get('/report',[WeeklyReportController::class,'index']);
  Route::get('/create',[WeeklyReportController::class,'create'])->name('create');
  Route::post('/save-data',[WeeklyReportController::class,'store'])->name('save-data');
  Route::get('/edit/{id}', [WeeklyReportController::class, 'edit'])->name('edit');
  Route::post('/update/{id}', [WeeklyReportController::class, 'update'])->name('update');
  Route::get('/destroy/{id}', [WeeklyReportController::class, 'destroy'])->name('destroy');
  Route::get('/change-status/{id}',[WeeklyReportController::class,'changestatus']);
});


//! Routing dashboard Management
Route::group(['middleware'], function() 
{
  Route::get('/um/dashboard', [UmDashboardController::class,'index']);
  // Route::get('/um', [NotifManagementController::class,'index']);
  Route::get('/approval', [ApprovalController::class,'index']);
  Route::get('/detailapproval/{id}', [ApprovalController::class,'show']);
  // !
  Route::get('/inputWorkOrder/{id}', [ApprovalController::class,'inputWo']);
  Route::post('/input_wo',[InputwoController::class,'iwo']);
  // 
  route::put('/updateStatusApproval/{id}', [ApprovalController::class, 'update'])->name('updateStatusApproval');
  Route::get('/reportp', [ReportpController::class,'index']);
  // Route::get('/inputWorkOrder/{id}', [InputwoController::class,'show'])->name('inputWorkOrder');
  Route::get('/inputTwo', [InputwoController::class,'index']);
  Route::post('/inputWo/sendPmLead', [InputwoController::class,'store'])->name('/inputWo/sendPmLead');

  Route::get('/listd', [ListdController::class,'index']);
});

//! Routing dashboard Finance
// Route::group(['middleware' => ['role:Finance']], function() 
// {


  Route::group(['middleware' ], function() 
  {
    
  Route::get('/task',[TaskController::class,'index'])->name('task');
  Route::get('/exporttask',[TaskController::class,'export'])->name('exporttask');
  // Route::post('/task',[TaskController::class,'index'])->name('task');
  
  Route::post('/listprojectpm', [ListProjectPmController::class, 'listprojectpm']);
  
  Route::get('/listprojectpm',[ListProjectPmController::class,'index'])->name('listprojectpm');
  Route::post('/simpan-dok',[ListProjectPmController::class,'store'])->name('simpan-dok');
  
  Route::get('/list',[ListController::class,'index'])->name('list');
  Auth::routes();
  Route::get('/dashboardlead',[DashboardleadController::class,'index'])->name('dashboardlead');
  
  });
  


// });


// });

//! Routing dashboard Admin
Route::group(['middleware'], function() 
{
  Route::get('/adminproject', [AdminController::class,'index'])->name('/adminproject');
  Route::get('/adminproject/create', [AdminController::class,'create'])->name('/adminproject/create');
  Route::post('/adminproject/store', [AdminController::class,'store'])->name('/adminproject/store');
  Route::get('/adminprojectShow/{id}', [AdminController::class,'show'])->name('/adminprojectShow');
  Route::get('/adminprojecDelete/{id}', [AdminController::class,'destroy'])->name('/adminprojecDelete');

  // Route::get('/um', [NotifManagementController::class,'index']);
  // sales
  Route::get('/adminproject/sales', [AmSalesController::class,'index'])->name('/adminproject/sales');
  Route::get('/adminproject/salesCreate', [AmSalesController::class,'create'])->name('/adminproject/salesCreate');


});








Route::post('logout', [LoginController::class, 'logout']);

