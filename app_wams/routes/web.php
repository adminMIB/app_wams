<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\sales\AmSalesController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\TimelineController as APITimelineController;
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
use App\Http\Controllers\SALES\ListPAController;
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
use App\Http\Controllers\ListProjectController;
use App\Http\Controllers\LpadminPmLeadController;
use App\Http\Controllers\TechnikalLeadController\TechnikalLeadController;
use App\Http\Controllers\TechnikalLeadController\WeeklyReportControllerLead;
use App\Http\Controllers\WeeklyReportController;
use App\Http\Middleware\IsAdmin;
use App\Models\SalesOpty;
use Illuminate\Routing\Route as RoutingRoute;
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

Route::post('logout', [LoginController::class, 'logout']);


// ! Routing dashboard Super Admin
Route::group(['middleware'], function () {
  Route::get('/dashboardSuperAdmin', [DashboardAdminController::class, 'index'])->name('/dashboardSuperAdmin');

  //! route role
  Route::get('/dashboard/role', [RoleControllerM::class, 'index'])->name('/dashboard/role');
  Route::get('/dashboard/addRole', [RoleControllerM::class, 'create'])->name('/dashboard/addRole');
  Route::post('/dashboard/saveRole', [RoleControllerM::class, 'store'])->name('/dashboard/saveRole');
  Route::get('/editRole/{id}', [RoleControllerM::class, 'edit']);
  Route::post('/dashboard/updateEdit/{id}', [RoleControllerM::class, 'update'])->name('/dashboard/updateEdit');
  Route::get('/dashboard/deleteRole/{id}', [RoleControllerM::class, 'destroy']);

  // !permision
  Route::get('/dashboardPermision', [PermisiionControlerr::class, 'index'])->name('/dashboardPermision');
  Route::get('/dashboard/addPermission', [PermisiionControlerr::class, 'create'])->name('/dashboard/addPermission');
  Route::post('/dashboard/savePermission', [PermisiionControlerr::class, 'store'])->name('/dashboard/savePermission');
  Route::get('/editPermission/{id}', [PermisiionControlerr::class, 'edit']);
  Route::post('/dashboard/updatePermission/{id}', [PermisiionControlerr::class, 'update'])->name('/dashboard/updatePermission');
  Route::get('/dashboard/deletePermission/{id}', [PermisiionControlerr::class, 'destroy']);


  //! route management user
  Route::get('/dashboard/user', [AuthControllerM::class, 'index'])->name('/dashboard/user');
  Route::get('/dashboard/addUser', [AuthControllerM::class, 'create'])->name('/dashboard/addUser');
  Route::post('/dashboard/saveUser', [AuthControllerM::class, 'store'])->name('/dashboard/saveUser');
  Route::get('/editUser/{id}', [AuthControllerM::class, 'edit']);
  Route::post('/dashboard/updateUser/{id}', [AuthControllerM::class, 'update'])->name('/dashboard/updateUser');
  Route::get('/dashboard/deleteUser/{id}', [AuthControllerM::class, 'destroy']);

  //! Route Sales opty & order
  // sales opty

  Route::get('/dashboard/salesOpty', [SalesControllerM::class, 'index'])->name('/dashboard/salesOpty');
  Route::get('/Minputsales', [SalesControllerM::class, 'create'])->name('Minputsales');
  Route::post('/Msimpan-data', [SalesControllerM::class, 'store'])->name('Msimpan-data');
  Route::get('/filter', [SalesControllerM::class, 'filter'])->name('salesopty.filter');
  Route::get('/Mdetail/{id}', [SalesControllerM::class, 'show'])->name('Mdetail');
  Route::get('/Mdelete/{id}', [SalesControllerM::class, 'destroy'])->name('Mdelete');
  Route::get('/exportsalesopty', [SalesControllerM::class, 'export'])->name('exportsalesopty');
  Route::get('/Medit/{id}', [SalesControllerM::class, 'edit'])->name('Medit');
  Route::post('/Msimpan/{id}', [SalesControllerM::class, 'update'])->name('Msimpan');
  Route::get('/elearning', [ElearningController::class, 'index'])->name('elearning');
  Route::get('/Mcetak', [SalesControllerM::class, 'cetak'])->name('cetak');
  Route::get('/home', [DashboardViewController::class, 'index'])->name('home');


  // sales order
  Route::get('/dashboard/salesOrder', [SalesOrderControllerM::class, 'index'])->name('/dashboard/salesOrder');
  Route::get('/dashboard/addSalesOrder', [SalesOrderControllerM::class, 'create'])->name('/dashboard/addSalesOrder');
  route::post('/saOrder/saveData', [SalesOrderControllerM::class, 'store'])->name('saOrder/saveData');
  route::post('/update-data/{id}', [SalesOrderControllerM::class, 'update'])->name('update-data');
  route::get('/edit/{id}', [SalesOrderControllerM::class, 'edit'])->name('edit');
  route::get('/del/{id}', [SalesOrderControllerM::class, 'destroy'])->name('del');
});


//! Routing dashboard AM/Sales
Route::group(['middleware'], function () {
  Route::get('/dashboardAmSales', [DashboardAmSalesController::class, 'index'])->name('/dashboardAmSales')->middleware(['permission:read data AM/Sales']);

  Route::get('/selearning', [SElearningController::class, 'index'])->middleware(['permission:read data AM/Sales']);
  Route::get('/slistpa', [ListPAController::class, 'index'])->middleware(['permission:read data AM/Sales']);

  Route::get('/slsorder', [SalesOrderController::class, 'index'])->name('slsorder')->middleware(['permission:read data AM/Sales']);
  Route::get('/createodr', [SalesOrderController::class, 'create'])->name('createodr')->middleware(['permission:create data AM/Sales']);
  route::post('/Ssimpan-data', [SalesOrderController::class, 'store'])->name('Ssimpan-data')->middleware(['permission:create data AM/Sales']);
  route::put('/update-data/{id}', [SalesOrderController::class, 'update'])->name('update-data')->middleware(['permission:update data AM/Sales']);
  route::get('/Sedit/{id}', [SalesOrderController::class, 'edit'])->name('Sedit')->middleware(['permission:update data AM/Sales']);
  route::DELETE('/del/{id}', [SalesOrderController::class, 'destroy'])->name('del')->middleware(['permission:delete data AM/Sales']);
  Route::get('/order-export', [SalesOrderController::class, 'export'])->name('order-export')->middleware(['permission:read data AM/Sales']);
  Route::post('/add_so', [SalesOrderController::class, 'addso'])->middleware(['permission:create data AM/Sales']);
  Route::post('/store/media', [SalesOrderController::class, 'storeMedia'])->name('storeMedia');
  // sales opty
  Route::get('/index-sales', [SalesOptyController::class, 'index'])->name('index-sales')->middleware(['permission:read data AM/Sales']);
  Route::get('/inputsales', [SalesOptyController::class, 'create'])->name('inputsales')->middleware(['permission:read data AM/Sales']);
  Route::post('/Ysimpan-data', [SalesOptyController::class, 'store'])->name('Ysimpan-data')->middleware(['permission:create data AM/Sales']);
  Route::get('/Yfilter', [SalesOptyController::class, 'filter'])->name('salesopty.filter')->middleware(['permission:read data AM/Sales']);
  Route::get('/Ydetail/{id}', [SalesOptyController::class, 'show'])->name('Ydetail')->middleware(['permission:read data AM/Sales']);
  Route::get('/Ydelete/{id}', [SalesOptyController::class, 'destroy'])->name('Ydelete')->middleware(['permission:read data AM/Sales']);
  Route::get('/exportsalesopty', [SalesOptyController::class, 'export'])->name('exportsalesopty')->middleware(['permission:read data AM/Sales']);
  Route::get('/Yedit/{id}', [SalesOptyController::class, 'edit'])->name('Yedit')->middleware(['permission:read data AM/Sales']);
  Route::post('/Ysimpan/{id}', [SalesOptyController::class, 'update'])->name('Ysimpan')->middleware(['permission:create data AM/Sales']);
  Route::get('/Ycetak', [SalesOptyController::class, 'cetak'])->name('Ycetak')->middleware(['permission:read data AM/Sales']);
});

//!teknikal
Route::group(['middleware'], function () {


  Route::get('/dashboardTeknikal', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('/telearning', [ElearningController::class, 'index'])->name('elearning');
  Route::get('/search', [ElearningController::class, 'search'])->name('search');
  Route::get('/create-elearning', [ElearningController::class, 'create'])->name('create-elearning');
  Route::post('/Esimpan-data', [ElearningController::class, 'store'])->name('Esimpan-data');
  Route::get('/edite/{id}', [ElearningController::class, 'edit'])->name('edite');
  Route::get('/delete/{id}', [ElearningController::class, 'destroy']);
  Route::put('/update-data/{id}', [ElearningController::class, 'update'])->name('update-data');

  Route::get('/dashboardTeknikal', [DashboardController::class, 'index'])->name('dashboard')->middleware(['permission:read data Technikal']);
  Route::get('/telearning', [ElearningController::class, 'index'])->name('elearning')->middleware(['permission:read data Technikal']);
  Route::get('/create-elearning', [ElearningController::class, 'create'])->name('create-elearning')->middleware(['permission:create data Technikal']);
  Route::post('/Esimpan-data', [ElearningController::class, 'store'])->name('Esimpan-data')->middleware(['permission:create data Technikal']);
  Route::get('/edit/{id}', [ElearningController::class, 'edit'])->name('edit')->middleware(['permission:detail data Technikal']);
  Route::get('/delete/{id}', [ElearningController::class, 'destroy'])->middleware(['permission:read data Technikal']);
  Route::post('/update-data/{id}', [ElearningController::class, 'update'])->name('update-data')->middleware(['permission:update data Technikal']);


  Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['permission:create data Technikal']);
  Route::get('/report', [WeeklyReportController::class, 'index'])->middleware(['permission:create data Technikal']);
  Route::get('/create', [WeeklyReportController::class, 'create'])->name('create')->middleware(['permission:create data Technikal']);
  Route::post('/save-data', [WeeklyReportController::class, 'store'])->name('save-data')->middleware(['permission:create data Technikal']);
  Route::get('/viewproject', [WeeklyReportController::class, 'view'])->name('viewproject')->middleware(['permission:read data Technikal']);
  Route::get('/edit/{id}', [WeeklyReportController::class, 'edit'])->name('edit')->middleware(['permission:detail data Technikal']);
  Route::post('/update/{id}', [WeeklyReportController::class, 'update'])->name('update')->middleware(['permission:update data Technikal']);
  Route::get('/destroy/{id}', [WeeklyReportController::class, 'destroy'])->name('destroy')->middleware(['permission:delete data Technikal']);
  Route::get('/change-status/{id}', [WeeklyReportController::class, 'changestatus'])->middleware(['permission:read data Technikal']);
  Route::post('/get_one_pm', [WeeklyReportController::class, 'getOnePm'])->middleware(['permission:create data Technikal']);
});

//! Routing dashboard Management
Route::group(['middleware'], function () {
  Route::get('/um/dashboard', [UmDashboardController::class, 'index'])->middleware(['permission:read data Management']);
  // Route::get('/um', [NotifManagementController::class,'index']);
  Route::get('/approval', [ApprovalController::class, 'index'])->middleware(['permission:read data Management']);
  Route::get('/detailapproval/{id}', [ApprovalController::class, 'show'])->middleware(['permission:detail data Management']);
  // !
  Route::get('/inputWorkOrder/{id}', [ApprovalController::class, 'inputWo'])->middleware(['permission:detail data Management']);
  Route::post('/input_wo', [InputwoController::class, 'iwo'])->middleware(['permission:create data Management']);
  // 
  route::put('/updateStatusApproval/{id}', [ApprovalController::class, 'update'])->name('updateStatusApproval')->middleware(['permission:update data Management']);
  Route::get('/reportp', [ReportpController::class, 'index'])->middleware(['permission:read data Management']);
  // Route::get('/inputWorkOrder/{id}', [InputwoController::class,'show'])->name('inputWorkOrder');
  Route::get('/inputTwo', [InputwoController::class, 'index'])->middleware(['permission:read data Management']);
  Route::post('/inputWo/sendPmLead', [InputwoController::class, 'store'])->name('/inputWo/sendPmLead')->middleware(['permission:create data Management']);

  Route::get('/listd', [ListdController::class, 'index'])->middleware(['permission:read data Management']);
});

//! Routing dashboard Finance
// Route::group(['middleware' => ['role:Finance']], function() 
// {

  //! Routing Pm Lead
Route::group(['middleware'], function () {

  Route::get('/task', [TaskController::class, 'index'])->name('task')->middleware(['permission:read data PM Lead']);
  Route::get('/exporttask', [TaskController::class, 'export'])->name('exporttask')->middleware(['permission:read data PM Lead']);
  // Route::post('/task',[TaskController::class,'index'])->name('task');
  Route::get('/lpadminpmlead', [LpadminPmLeadController::class, 'index'])->name('lpadminpmlead');

  Route::post('/listprojectpm', [ListProjectPmController::class, 'listprojectpm'])->middleware(['permission:create data PM Lead']);

  Route::get('/listprojectpm', [ListProjectPmController::class, 'index'])->name('listprojectpm')->middleware(['permission:read data PM Lead']);
  Route::post('/simpan-dok', [ListProjectPmController::class, 'store'])->name('simpan-dok')->middleware(['permission:create data PM Lead']);

  Route::get('/list', [ListController::class, 'index'])->name('list')->middleware(['permission:read data PM Lead']);
  Auth::routes();
  Route::get('/dashboardlead', [DashboardleadController::class, 'index'])->name('dashboardlead')->middleware(['permission:read data PM Lead']);
});


  //! Route PM
Route::group(['middleware'], function () {

  Route::get('/index-list',[ListProjectTechController::class,'index'])->name('index-list')->middleware(['permission:read data PM']);
  Route::get('/listproject', [ListProjectTechController::class, 'create'])->name('listproject')->middleware(['permission:create data PM']);
  Route::post('/simpan-list', [ListProjectTechController::class, 'store'])->name('simpan-list')->middleware(['permission:create data PM']);
  Route::get('/list-delete/{id}',[ListProjectTechController::class,'destroy'])->name('list-delete')->middleware(['permission:delete data PM']);
  Route::post('/work_order', [ListProjectTechController::class, 'work'])->middleware(['permission:create data PM']);


  Route::get('/timeline', [TimeLineController::class, 'index'])->name('timeline')->middleware(['permission:read data PM']);
  Route::get('/input', [TimeLineController::class, 'create'])->name('input')->middleware(['permission:read data PM']);
  Route::post('/simpan-data', [TimeLineController::class, 'store'])->name('simpan-data')->middleware(['permission:create data PM']);
  Route::get('/edittml/{id}', [TimeLineController::class, 'edit'])->name('edittml')->middleware(['permission:read data PM']);
  Route::post('/updatetml/{id}',[TimeLineController::class,'update'])->name('updatetml')->middleware(['permission:create data PM']);
  Route::post('/list-project', [TimeLineController::class, 'list'])->name('list')->middleware(['permission:create data PM']);
  Route::get('/detail_timeline/{id}', [TimeLineController::class, 'show'])->name('detail_timeline')->middleware(['permission:read data PM']);

  Route::get('/list_project', [ListProjectController::class, 'index'])->name('list_project')->middleware(['permission:read data PM']);



});

//! Routing dashboard Admin
Route::group(['middleware'], function () {
  Route::get('/adminproject', [AdminController::class, 'index'])->name('/adminproject')->middleware(['permission:read data Project Admins']);
  Route::get('/adminproject/create', [AdminController::class, 'create'])->name('/adminproject/create')->middleware(['permission:read data Project Admins']);
  Route::post('/adminproject/store', [AdminController::class, 'store'])->name('/adminproject/store')->middleware(['permission:create data Project Admins']);
  Route::get('/adminprojectShow/{id}', [AdminController::class, 'show'])->name('/adminprojectShow')->middleware(['permission:detail data Project Admins']);
  Route::get('/adminprojecDelete/{id}', [AdminController::class, 'destroy'])->name('/adminprojecDelete')->middleware(['permission:delete data Project Admins']);;


  Route::post('/admin/media', [AdminController::class, 'storeMedia'])->name('admin/media');
  // Route::get('/admin/donwload', [AdminController::class, 'download_local'])->name('/admin/donwload');


  Route::get('zip-download', [AdminController::class, 'downZip'])->name('zip-download');


  // Route::get('/um', [NotifManagementController::class,'index']);
  // sales
  Route::get('/adminproject/sales', [AmSalesController::class, 'index'])->name('/adminproject/sales')->middleware(['permission:read data Project Admins']);;
  Route::get('/adminproject/salesCreate', [AmSalesController::class, 'create'])->name('/adminproject/salesCreate')->middleware(['permission:read data Project Admins']);;
  Route::get('/adminShowSales/{id}', [AmSalesController::class, 'show'])->name('/adminShowSales')->middleware(['permission:read data Project Admins']);;
  Route::put('/adminShowSalesUpdate/{id}', [AmSalesController::class, 'update'])->name('/adminShowSalesUpdate')->middleware(['permission:update data Project Admins']);;
});


//! Routing dashboard Technikallead
Route::group(['middleware'], function () {
  Route::get('/TechnikalLead', [TechnikalLeadController::class, 'index'])->name('/TechnikalLead')->middleware(['permission:read data Technikal Lead']);

  Route::get('/inputTwos', [TechnikalLeadController::class, 'indexViewWo'])->name('/inputTwos')->middleware(['permission:read data Technikal Lead']);;
  Route::get('/leadViewsDetailapproval/{id}', [TechnikalLeadController::class, 'showViwWo'])->name('/leadViewsDetailapproval')->middleware(['permission:read data Technikal Lead']);;

  Route::get('/leadListSalesOpty', [TechnikalLeadController::class, 'indexSalesOpty'])->name('/leadListSalesOpty')->middleware(['permission:read data Technikal Lead']);;
  Route::get('/leadViewsDetailOpty/{id}', [TechnikalLeadController::class, 'showSalesOpty'])->name('/leadViewsDetailOpty')->middleware(['permission:read data Technikal Lead']);;

  // weekly
  Route::get('/tlWeeklyReport', [WeeklyReportControllerLead::class, 'index'])->name('/tlWeeklyReport')->middleware(['permission:read data Technikal Lead']);;
  Route::get('/tlCretae', [WeeklyReportControllerLead::class, 'create'])->name('/tlCretae')->middleware(['permission:read data Technikal Lead']);;
  Route::post('/tlStore', [WeeklyReportControllerLead::class, 'store'])->name('/tlStore')->middleware(['permission:create data Technikal Lead']);;


});







