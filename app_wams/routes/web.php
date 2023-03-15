<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DepartemenController;
use App\Http\Controllers\Admin\DistiController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Admin\sales\AmSalesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\Corporate\ACDCController;
use App\Http\Controllers\Corporate\CMMController;
use App\Http\Controllers\Corporate\CorporateController;
use App\Http\Controllers\Corporate\DCLController;
use App\Http\Controllers\Corporate\ReimbursementController;
use App\Http\Controllers\Corporate\ReportController as CorporateReportController;
use App\Http\Controllers\Corporate\RevCost\SaldoAwalController;
use App\Http\Controllers\Corporate\RevenueCostController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\SALES\DashboardAmSalesController;
use App\Http\Controllers\Technical\DashboardController;
use App\Http\Controllers\PM\DashboardPmController;
use App\Http\Controllers\PM\ProfileController;
use App\Http\Controllers\DashboardViewController;
use App\Http\Controllers\Finance\FakturPembelianController;
use App\Http\Controllers\Finance\BarangController;
use App\Http\Controllers\Finance\FakturPenjualanController;
use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\Finance\PembelianController;
use App\Http\Controllers\Finance\PenawaranController;
use App\Http\Controllers\Hrd\HrdController;
use App\Http\Controllers\Technical\ElearningController;
use App\Http\Controllers\ListProjectTechController;
use App\Http\Controllers\SALES\ListPAController;
use App\Http\Controllers\SALES\SalesOptyController;
use App\Http\Controllers\SALES\SalesOrderController;
use App\Http\Controllers\SALES\SElearningController;
use App\Http\Controllers\SALES\ProfileSalesController;
use App\Http\Controllers\PM\TaskController;
use App\Http\Controllers\PM\TimeLineController;
use App\Http\Controllers\UM\InputwoController;
use App\Http\Controllers\UM\ListdController;
use App\Http\Controllers\UM\ApprovalController;
use App\Http\Controllers\UM\ReportpController;
use App\Http\Controllers\UM\UmDashboardController;
use App\Http\Controllers\viewControlerrSuperAdmin\AuthControllerM;
use App\Http\Controllers\viewControlerrSuperAdmin\PermisiionControlerr;
use App\Http\Controllers\viewControlerrSuperAdmin\RoleControllerM;
use App\Http\Controllers\viewControlerrSuperAdmin\SalesControllerM;
use App\Http\Controllers\viewControlerrSuperAdmin\SalesOrderControllerM;
use App\Http\Controllers\PM\ListProjectController;
use App\Http\Controllers\SALES\ProductSolutionController;
use App\Http\Controllers\PM\StatusPekerjaanController;
use App\Http\Controllers\SALES\LTOController;
use App\Http\Controllers\Technical\ProfileTechnicalController;
use App\Http\Controllers\Technical\WeeklyReportController;
use App\Http\Controllers\UM\ProfileManagementController;
use App\Http\Controllers\viewControlerrSuperAdmin\ProfileSuperAdminController;
use App\Http\Controllers\PM\ProjectController;
use App\Http\Controllers\PM\ReportController;
use App\Http\Controllers\ProfileController as ControllersProfileController;
use App\Http\Controllers\UM\ProjectAllController;
use App\Models\FakturPenjualan;
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
route::get("/", function () {
  return view("auth.login");
});
Route::post('logout', [LoginController::class, 'logout']);

Route::get('/contoh', [ContohController::class, 'index']);
Route::get('/contoh/export_excel', [ContohController::class, 'export_excel']);
Route::get('/sales/export_excel', [AmSalesController::class, 'export_excelAmSales']);


// ! Routing dashboard Super Admin
Route::group(['middleware'], function () {
  Route::get('/dashboardSuperAdmin', [DashboardAdminController::class, 'index'])->name('/dashboardSuperAdmin');
  Route::get('/superAdminAllMenu', [DashboardAdminController::class, 'menu'])->name('/superAdminAllMenu');


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
  Route::get('/filter', [SalesControllerM::class, 'filter'])->name('salesoptyadmin.filter');
  Route::get('/Mdetail/{id}', [SalesControllerM::class, 'show'])->name('Mdetail');
  Route::get('/Mdelete/{id}', [SalesControllerM::class, 'destroy'])->name('Mdelete');
  Route::get('/exportsalesopty', [SalesControllerM::class, 'export'])->name('exportsalesopty');
  Route::get('/Medit/{id}', [SalesControllerM::class, 'edit'])->name('Medit');
  Route::post('/Msimpan/{id}', [SalesControllerM::class, 'update'])->name('Msimpan');
  Route::get('/elearning', [ElearningController::class, 'index'])->name('adminelearning');
  Route::get('/Mcetak', [SalesControllerM::class, 'cetak'])->name('cetak');
  Route::get('/home', [DashboardViewController::class, 'index'])->name('home');


  // sales order
  Route::get('/dashboard/salesOrder', [SalesOrderControllerM::class, 'index'])->name('/dashboard/salesOrder');
  Route::get('/dashboard/addSalesOrder', [SalesOrderControllerM::class, 'create'])->name('/dashboard/addSalesOrder');
  route::post('/saOrder/saveData', [SalesOrderControllerM::class, 'store'])->name('saOrder/saveData');
  route::post('/update-data/{id}', [SalesOrderControllerM::class, 'update'])->name('update-data');
  route::get('/edit/{id}', [SalesOrderControllerM::class, 'edit'])->name('edit');
  route::get('/del/{id}', [SalesOrderControllerM::class, 'destroy'])->name('delS');

});


//! Routing dashboard AM/Sales
Route::group(['middleware'], function () {
  Route::get('/dashboardAmSales', [DashboardAmSalesController::class, 'index'])->name('/dashboardAmSales')->middleware(['permission:read data AM/Sales']);

  Route::get('/selearning', [SElearningController::class, 'index'])->middleware(['permission:read data AM/Sales']);
  Route::get('/slistpa', [ListPAController::class, 'index'])->middleware(['permission:read data AM/Sales']);
  Route::get('/reportPTech', [ProductSolutionController::class, 'index'])->middleware(['permission:read data AM/Sales']);
  // route::get('/Sshow/sopdf/{id}', [SalesOrderController::class, 'salesorder_pdf'])->name('Sshowpdf');

  // sales order
  Route::get('/slsorder', [SalesOrderController::class, 'index'])->name('slsorder')->middleware(['permission:read data AM/Sales']);
  Route::get('/createodr', [SalesOrderController::class, 'create'])->name('createodr')->middleware(['permission:create data AM/Sales']);
  route::post('/Ssimpan-data', [SalesOrderController::class, 'store'])->name('Ssimpan-data')->middleware(['permission:create data AM/Sales']);
  route::put('/update-dataS/{id}', [SalesOrderController::class, 'update'])->name('update-dataS')->middleware(['permission:update data AM/Sales']);
  route::get('/Sedit/{id}', [SalesOrderController::class, 'edit'])->name('Sedit')->middleware(['permission:update data AM/Sales']);
  route::get('/Sshow/{id}', [SalesOrderController::class, 'show'])->name('Sshow')->middleware(['permission:update data AM/Sales']);
  route::DELETE('/del/{id}', [SalesOrderController::class, 'destroy'])->name('del')->middleware(['permission:delete data AM/Sales']);
  Route::get('/order-export', [SalesOrderController::class, 'export'])->name('order-export')->middleware(['permission:read data AM/Sales']);
  Route::post('/add_so', [SalesOrderController::class, 'addso']);
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
  // LTO DONE
  Route::get('/Project', [LTOController::class, 'index'])->name('VIEWLTODONE');
  Route::get('/Project/{id}/show', [LTOController::class, 'show'])->name('VIEWLTOEDIT');
  // product solusi
  Route::get('/produksolusi', [ProductSolutionController::class, 'index'])->name('produksolusi');
  Route::get('/pscreate', [ProductSolutionController::class, 'create'])->name('pscreate');
  Route::post('/pssimpan', [ProductSolutionController::class, 'store'])->name('pssimpan');
  Route::get('/psedit/{id}', [ProductSolutionController::class, 'edit'])->name('psedit');
  Route::put('/psupdate/{id}', [ProductSolutionController::class, 'update'])->name('psupdate');
  Route::get('/psdelete/{id}', [ProductSolutionController::class, 'destroy'])->name('psdelete');

});

//!teknikal
Route::group(['middleware'], function () {

  Route::get('/dashboardTeknikal', [DashboardController::class, 'index'])->name('dashboard')->middleware(['permission:read data Technikal']);
  Route::get('/telearning', [ElearningController::class, 'index'])->name('elearning')->middleware(['permission:read data Technikal']);
  Route::get('/create-elearning', [ElearningController::class, 'create'])->name('create-elearning')->middleware(['permission:create data Technikal']);
  Route::post('/Esimpan-data', [ElearningController::class, 'store'])->name('Esimpan-data')->middleware(['permission:create data Technikal']);
  Route::get('/Eedit/{id}', [ElearningController::class, 'edit'])->name('edit')->middleware(['permission:detail data Technikal']);
  Route::get('/delete/{id}', [ElearningController::class, 'destroy'])->middleware(['permission:read data Technikal']);
  Route::post('/update-data/{id}', [ElearningController::class, 'update'])->name('update-data')->middleware(['permission:update data Technikal']);

  Route::get('/report', [WeeklyReportController::class, 'index'])->middleware(['permission:create data Technikal']);
  Route::get('/create', [WeeklyReportController::class, 'create'])->name('create')->middleware(['permission:create data Technikal']);
  Route::post('/save-data', [WeeklyReportController::class, 'store'])->name('save-data')->middleware(['permission:create data Technikal']);
  Route::get('/viewproject', [WeeklyReportController::class, 'view'])->name('viewproject')->middleware(['permission:read data Technikal']);
  Route::get('/viewtime', [WeeklyReportController::class, 'viewPT'])->name('viewtime')->middleware(['permission:read data Technikal']);
  Route::get('/detail/{id}', [WeeklyReportController::class, 'detail'])->name('detailT')->middleware(['permission:detail data Technikal']);
  Route::get('/detailtime/{id}', [WeeklyReportController::class, 'detailpt'])->name('detailtime')->middleware(['permission:detail data Technikal']);
  Route::get('/sales_order', [WeeklyReportController::class, 'viewSO'])->name('sales_order')->middleware(['permission:detail data Technikal']);
  Route::get('/detailso/{id}', [WeeklyReportController::class, 'detailso'])->name('detailso')->middleware(['permission:detail data Technikal']);

  Route::get('/edit/{id}', [WeeklyReportController::class, 'edit'])->name('editT')->middleware(['permission:detail data Technikal']);
  Route::get('/edit_list/{id}', [WeeklyReportController::class, 'lists'])->name('edit_list')->middleware(['permission:detail data Technikal']);
  Route::get('/edit_listpipe/{id}', [WeeklyReportController::class, 'listspipe'])->name('edit_listpipe')->middleware(['permission:detail data Technikal']);
  Route::post('/updateadmin/{id}', [WeeklyReportController::class, 'updateadmin'])->name('updateadmin')->middleware(['permission:detail data Technikal']);
  Route::post('/updatepipe/{id}', [WeeklyReportController::class, 'updatepipe'])->name('updatepipe')->middleware(['permission:detail data Technikal']);
  Route::post('/update/{id}', [WeeklyReportController::class, 'update'])->name('updateT')->middleware(['permission:update data Technikal']);
  Route::get('/destroy/{id}', [WeeklyReportController::class, 'destroy'])->name('destroy')->middleware(['permission:delete data Technikal']);
  Route::get('/change-status/{id}', [WeeklyReportController::class, 'changestatus'])->middleware(['permission:read data Technikal']);
  Route::post('/get_one_pm', [WeeklyReportController::class, 'getOnePm'])->middleware(['permission:create data Technikal']);
  Route::post('/get_one_pt', [WeeklyReportController::class, 'getOnePt'])->middleware(['permission:create data Technikal']);
  Route::get('/cetak_data', [WeeklyReportController::class, 'cetak_data'])->middleware(['permission:create data Technikal']);
  Route::get('/sales_pipeline', [WeeklyReportController::class, 'pipeline'])->name('sales_pipeline')->middleware(['permission:create data Technikal']);


  Route::get('/projectsT', [WeeklyReportController::class, 'projects'])->name('projectsT')->middleware(['permission:read data Technikal']);
  Route::get('/projectsT/view/{id}',[WeeklyReportController::class,'ViewP'])->name('projectsT.view');
  Route::post('/update-items', array('as'=> 'update.items', 'uses' => '\App\Http\Controllers\Technical\WeeklyReportController@updateItems'));
  Route::get('/show/{id}',[WeeklyReportController::class,'showtask']);
  Route::post('/show-simpanT/{id}', [\App\Http\Controllers\Technical\WeeklyReportController::class, 'storetask']);
  Route::post('/update-des/{id}',[WeeklyReportController::class,'updateDes'])->name('update.des')->middleware(['permission:update data Technikal']);
});

//! Routing dashboard Management
Route::group(['middleware'], function () {
  Route::get('/umdashboard', [UmDashboardController::class, 'index'])->middleware(['permission:read data Management'])->name('umdashboard');
  Route::get('/approval', [ApprovalController::class, 'index'])->name('approval')->middleware(['permission:read data Management']);
  Route::get('/detailapproval/{id}', [ApprovalController::class, 'show'])->middleware(['permission:detail data Management']);
  // !
  Route::get('/inputWorkOrder/{id}', [ApprovalController::class, 'inputWo'])->middleware(['permission:detail data Management']);
  Route::post('/input_wo', [InputwoController::class, 'iwo'])->middleware(['permission:create data Management']);
  //
  route::post('/updateStatusApproval/{id}', [ApprovalController::class, 'update'])->name('updateStatusApproval')->middleware(['permission:update data Management']);;
  Route::get('/inputTwo', [InputwoController::class, 'index'])->name('inputTwo')->middleware(['permission:read data Management']);
  Route::post('/inputWo/sendPmLead', [InputwoController::class, 'store'])->name('/inputWo/sendPmLead')->middleware(['permission:create data Management']);

  Route::get('/listd', [ListdController::class, 'index'])->middleware(['permission:read data Management']);


  Route::get('/projects-all',[ProjectAllController::class,'index'])->name('projects-all')->middleware(['permission:read data Management']);
  Route::get('/showP/{id}', [ProjectAllController::class, 'showP'])->middleware(['permission:read data Management']);


  // report indexPiplane
  Route::get('/reportp', [ReportpController::class, 'index'])->middleware(['permission:read data Management']);
  Route::get('/umViewTechnikal/{id}', [ReportpController::class, 'showTechnikal'])->middleware(['permission:read data Management'])->name('umViewTechnikal');

  Route::get('/umViewPiplane', [ReportpController::class, 'indexPiplane'])->middleware(['permission:read data Management'])->name('umViewPiplane');
  Route::get('/umShowPiplane/{id}', [ReportpController::class, 'showPiplane'])->middleware(['permission:read data Management']);

  // report admin
  Route::get('/umViewAdmin', [ReportpController::class, 'indexAdmin'])->name('umViewAdmin')->middleware(['permission:read data Management']);
  Route::get('/umShowAdmin/{id}', [ReportpController::class, 'showAdmin'])->middleware(['permission:read data Management']);

  // report PM
  Route::get('/umViewPm', [ReportpController::class, 'indexPm'])->name('umViewPm')->middleware(['permission:read data Management']);
  Route::get('/umShowpm/{id}', [ReportpController::class, 'showPm'])->middleware(['permission:read data Management']);

  // project menang
  Route::get('/ProjectsAll', [UmDashboardController::class, 'projects'])->name('ProjectsAll')->middleware(['permission:read data Management']);
  Route::get('/ProjectMenang', [UmDashboardController::class, 'ProjectMenang'])->name('ProjectMenang')->middleware(['permission:read data Management']);
  Route::get('/ProjectKalah', [UmDashboardController::class, 'ProjectKalah'])->name('ProjectKalah')->middleware(['permission:read data Management']);
  Route::get('/ProjectBastOven', [UmDashboardController::class, 'ProjectBastOven'])->name('ProjectBastOven')->middleware(['permission:read data Management']);
  Route::get('/projectBastHold', [UmDashboardController::class, 'projectBastHold'])->name('projectBastHold')->middleware(['permission:read data Management']);
  Route::get('/projectBastCompleted', [UmDashboardController::class, 'projectBastCompleted'])->name('projectBastCompleted')->middleware(['permission:read data Management']);


  //
});

//! Routing dashboard Finance
// Route::group(['middleware' => ['role:Finance']], function()
// {}


//! Route PM
Route::group(['middleware'], function () {

  Route::get('/dashboardpm', [DashboardPmController::class, 'index'])->name('dashboardpm')->middleware(['permission:read data PM']);


  Route::get('/timeline/{id}', [TimeLineController::class, 'index'])->name('timeline')->middleware(['permission:read data PM']);
  Route::get('/input/{id}', [TimeLineController::class, 'create'])->name('input')->middleware(['permission:read data PM']);
  Route::post('/simpan-data', [TimeLineController::class, 'store'])->name('simpan-data');
  Route::get('/edittml/{id}', [TimeLineController::class, 'edit'])->name('edittml')->middleware(['permission:read data PM']);
  Route::post('/addtimeline/{id}', [ProjectController::class, 'addnewtimeline'])->name('addtimeline')->middleware(['permission:create data PM']);
  Route::post('/updatetml/{id}', [TimeLineController::class, 'update'])->name('updatetml')->middleware(['permission:create data PM']);
  Route::post('/list-project', [TimeLineController::class, 'list'])->name('list');
  Route::post('/list-sp', [TimeLineController::class, 'list_sp'])->name('list-sp');
  Route::get('/detail_timeline/{id}', [TimeLineController::class, 'show'])->name('detail_timeline')->middleware(['permission:read data PM']);

  Route::get('/list_project', [ListProjectController::class, 'index'])->name('list_project')->middleware(['permission:read data PM']);
  Route::get('/detail_pa/{id}', [ListProjectController::class, 'DetailPA'])->name('detail_pa')->middleware(['permission:read data PM']);
  Route::get('/list_so', [ListProjectController::class, 'ViewSO'])->name('list_so')->middleware(['permission:read data PM']);
  Route::get('/detail_so/{id}', [ListProjectController::class, 'DetailSO'])->name('detail_so')->middleware(['permission:read data PM']);
  Route::get('/list_sp', [ListProjectController::class, 'ViewSP'])->name('list_sp')->middleware(['permission:read data PM']);
  Route::get('/detail_sp/{id}', [ListProjectController::class, 'DetailSP'])->name('detail_sp')->middleware(['permission:read data PM']);

  Route::get('/delete-timeline/{id}', [TimeLineController::class, 'destroy'])->name('delete-timeline')->middleware(['permission:delete data PM']);
  Route::get('/task/{id}', [TaskController::class, 'index'])->name('task');

  Route::get('/report-timeline', [TimeLineController::class, 'ReportTimeline'])->name('report-timeline')->middleware(['permission:read data PM']);
  Route::get('/detail_report/{id}', [TimeLineController::class, 'ShowTimeline'])->name('detail_report')->middleware(['permission:read data PM']);

  // route::get('/Sshow/sopdf/{id}', [SalesOrderController::class, 'salesorder_pdf'])->name('Sedit');

  Route::get('/on_progress', [StatusPekerjaanController::class, 'index'])->name('on_progress')->middleware(['permission:read data PM']);

  Route::get('/projects',[ProjectController::class,'index'])->name('projects')->middleware(['permission:read data PM']);
  Route::post('/projects/update/{id}',[ProjectController::class,'updateP'])->name('update.project')->middleware(['permission:update data PM']);
  Route::get('/issue', [StatusPekerjaanController::class, 'indexIS'])->name('issue')->middleware(['permission:read data PM']);

  Route::get('/done', [StatusPekerjaanController::class, 'indexDN'])->name('done')->middleware(['permission:read data PM']);
  Route::get('/bast/{id}',[ProjectController::class,'Bast'])->name('bast')->middleware(['permission:read data PM']);
  Route::post('/simpan-bast',[ProjectController::class,'storebast'])->name('simpan-bast')->middleware(['permission:create data PM']);
  Route::post('/update-bast/{id}',[ProjectController::class,'updatebast'])->name('update-bast')->middleware(['permission:update data PM']);
  Route::get('detail_project/{id}',[ProjectController::class,'DetailProject'])->name('detail_project')->middleware(['permission:read data PM']);
  Route::get('/newtimeline/{id}', [ProjectController::class, 'createnewtimeline'])->name('newtimeline');
  Route::get('/show-task/{id}',[ProjectController::class,'show']);
  Route::post('/show-simpan/{id}', [\App\Http\Controllers\PM\ProjectController::class, 'store']);
  Route::get('dokumen/{id}',[ProjectController::class,'Dokumen'])->name('dokumen')->middleware(['permission:read data PM']);
  Route::post('/simpan-dp',[ProjectController::class,'storeDP'])->name('simpan-dp')->middleware(['permission:create data PM']);
  Route::get('/data_report',[ReportController::class,'index'])->name('data_report')->middleware(['permission:read data PM']);

  Route::post('/pm/media', [TimeLineController::class, 'storeMedia'])->name('storeMediaPm');
});

//! Routing dashboard Admin
Route::group(['middleware'  => ['auth']], function () {
  Route::get('/dashboardAdmin', [AdminController::class, 'dashboard'])->name('/dashboardAdmin')->middleware(['permission:read data Project Admins']);
  Route::get('/adminproject', [AdminController::class, 'index'])->name('/adminproject')->middleware(['permission:read data Project Admins']);
  Route::get('/adminproject/create', [AdminController::class, 'create'])->name('/adminproject/create')->middleware(['permission:read data Project Admins']);
  Route::post('/adminproject/store', [AdminController::class, 'store'])->name('/adminproject/store')->middleware(['permission:create data Project Admins']);
  Route::get('/adminprojectShow/{id}', [AdminController::class, 'show'])->name('/adminprojectShow')->middleware(['permission:detail data Project Admins']);
  Route::get('/adminprojecDelete/{id}', [AdminController::class, 'destroy'])->name('/adminprojecDelete')->middleware(['permission:delete data Project Admins']);;
  Route::get('/adminprojectShowEdit/{id}', [AdminController::class, 'edit'])->name('/adminprojectShowEdit')->middleware(['permission:detail data Project Admins']);
  Route::post('/adminprojecsUpdates/{id}', [AdminController::class, 'update'])->name('/adminprojecsUpdates')->middleware(['permission:update data Project Admins']);

  Route::post('/admin/media', [AdminController::class, 'storeMedia'])->name('storeMediaAdmin');
  Route::post('/adminPiplane/media', [AmSalesController::class, 'storeMedia'])->name('storeMediaAdminPiplane');

  Route::get('zip-download', [AdminController::class, 'downZip'])->name('zip-download');

  // sales
  Route::get('/adminproject/sales', [AmSalesController::class, 'index'])->name('/adminproject/sales')->middleware(['permission:read data Project Admins']);;
  Route::get('/adminprojectSalesEdits/{id}', [AmSalesController::class, 'edit'])->name('adminprojectSalesEdits');
  Route::get('/adminShowSales/{id}', [AmSalesController::class, 'show'])->name('/adminShowSales');
  Route::post('/adminShowSalesUpdate/{id}', [AmSalesController::class, 'update'])->name('/adminShowSalesUpdate')->middleware(['permission:update data Project Admins']);
  Route::post('/adminShowSalesUpdates/{id}', [AmSalesController::class, 'updateDatas'])->name('/adminShowSalesUpdates')->middleware(['permission:update data Project Admins']);


  Route::get('/disti', [DistiController::class, 'index'])->name('/disti')->middleware(['permission:read data Project Admins']);
  Route::get('/distiShow/{id}', [DistiController::class, 'show'])->name('/distiShow')->middleware(['permission:read data Project Admins']);
  Route::post('/storeDiste', [DistiController::class, 'store'])->name('/storeDiste')->middleware(['permission:create data Project Admins']);
  Route::get('/deleteDiste/{id}', [DistiController::class, 'destroy'])->name('/deleteDiste')->middleware(['permission:create data Project Admins']);
  Route::get('/editDisti/{id}', [DistiController::class, 'edit'])->name('/editDisti');
  Route::post('/updateDisti/{id}', [DistiController::class, 'update'])->name('/updateDisti');


  Route::get('/customer', [CustomerController::class, 'index'])->name('/customer')->middleware(['permission:read data Project Admins']);
  Route::get('/customer/show/{id}', [CustomerController::class, 'show'])->name('/customer/show')->middleware(['permission:read data Project Admins']);
  Route::post('/customer/store', [CustomerController::class, 'store'])->name('/customer/store')->middleware(['permission:create data Project Admins']);
  Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('/customer/edit');
  Route::post('/customer/update/{id}', [CustomerController::class, 'update'])->name('/customer/update');
  Route::get('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('/customer/delete')->middleware(['permission:create data Project Admins']);

  Route::get('/departemen', [DepartemenController::class, 'index'])->name('departemen')->middleware(['permission:read data Project Admins']);
  Route::post('/departemen/store', [DepartemenController::class, 'store'])->name('departemen-store')->middleware(['permission:create data Project Admins']);
  Route::get('/departemen/edit/{id}', [DepartemenController::class, 'edit'])->name('departemen-edit');
  Route::post('/departemen/update/{id}', [DepartemenController::class, 'update'])->name('departemen-update');
  Route::get('/departemen/delete/{id}', [DepartemenController::class, 'destroy'])->name('departemen-delete')->middleware(['permission:create data Project Admins']);

  Route::get('/profile-all',[ControllersProfileController::class,'index'])->name('profile-all');
  Route::post('/update-all/{id}',[ControllersProfileController::class,'update'])->name('update-all');

  Route::post('/sales/media', [SalesOrderController::class, 'storeMedia'])->name('storeMediaSales');


});


// ! Routing Finance
Route::group(['middleware'  => ['auth']], function () {
  Route::get('/dashboardFinance', [FinanceController::class, 'index'])->name('/dashboard');
  Route::get('/projectF', [FinanceController::class, 'indexproject'])->name('projectF');
  Route::get('/projectF/view/{id}', [FinanceController::class, 'Projectdetail'])->name('viewprojectF');
  Route::get('/Penjualan/view/{id}', [FinanceController::class, 'penjualandetail'])->name('viewpenjualanD');
  Route::put('/update-note/{id}',[LTOController::class,'Addnote'])->name('update-note');

  Route::get('/data-penawaran', [FinanceController::class, 'datapenjualan'])->name('data-penjualan');
  Route::get('/data-pesanan', [FinanceController::class, 'datapesanan'])->name('data-pesanan');
  Route::get('/data-faktur', [FinanceController::class, 'datafaktur'])->name('data-faktur');

  Route::get('/data-pembelian', [FinanceController::class, 'datapembelian'])->name('data-pembelian');
  Route::get('/data-pesanan-pembelian', [FinanceController::class, 'datapesananpembelian'])->name('data-pesanan-pembelian');
  Route::get('/data-faktur-pembelian', [FinanceController::class, 'datafakturpembelian'])->name('data-faktur-pembelian');

  Route::get('/Penagihan-Penjualan', [PenawaranController::class, 'index'])->name('Penagihan-Penjualan');
  Route::get('/penawaran-Penjualan/{id}', [PenawaranController::class, 'indexpenawaran'])->name('penawaran-Penjualan');
  Route::get('/Penawaran/{id}', [PenawaranController::class, 'showpenawaran'])->name('penawaran');
  Route::get('/Pesanan/{id}', [PenawaranController::class, 'showpenawaranpesanan'])->name('penawaranpesanan');
  Route::get('/Penawaran/create/{id}',[PenawaranController::class,'create'])->name('penawaran.create');
  Route::post('/Penawaram/store/{id}',[PenawaranController::class,'store'])->name('penawaran.store');
  Route::get('/Penawaran/edit/{id}',[PenawaranController::class,'edit'])->name('penawaran.edit');
  Route::get('/Pesanan/edit/{id}',[PenawaranController::class,'editpesanan'])->name('pesanan.edit');
  Route::put('/Penawaran/update/{id}',[PenawaranController::class,'update'])->name('penawaran.update');
  Route::put('/Pesanan/update/{id}',[PenawaranController::class,'updatepesanan'])->name('pesanan.update');
  Route::post('/addbarang/{id}', [PenawaranController::class, 'addbrng'])->name('add.barang');
  Route::post('/Penawaran/update/status/{id}',[PenawaranController::class,'updateST'])->name('penawaran.status');
  Route::get('/edit-status/{id}',[PenawaranController::class,'editST'])->name('edit.status');


  Route::get('/Pesanan-Penjualan/{id}', [PenawaranController::class, 'showpesanan'])->name('pesananpenjualan');
  Route::get('/Faktur/{id}', [FakturPenjualanController::class, 'showfaktur'])->name('faktur');
  Route::post('/addbarangfaktur/{id}', [FakturPenjualanController::class, 'addbrng'])->name('add.barangfaktur');
  Route::get('/Faktur/edit/{id}',[FakturPenjualanController::class,'edit'])->name('faktur.edit');
  Route::put('/Faktur/update/{id}',[FakturPenjualanController::class,'update'])->name('faktur.update');
  Route::get('/Faktur-Penjualan/{id}', [FakturPenjualanController::class, 'index'])->name('fakturpenjualan');
  Route::get('/Faktur-Penjualan/create/{id}', [FakturPenjualanController::class, 'create'])->name('faktur-create');
  Route::post('/Faktur-Penjualan/store/{id}', [FakturPenjualanController::class, 'store'])->name('faktur-store');
  Route::get('/detailFaktur-Penjualan/{id}', [FakturPenjualanController::class, 'detailfaktur'])->name('detailfakturpenjualan');
  route::DELETE('/del-p/{id}', [PenawaranController::class, 'destroy'])->name('del-p');
  Route::get('/Penerimaan-Penjualan/{id}', [FakturPenjualanController::class, 'indexpenerimaan'])->name('penerimaanpenjualan');
  Route::get('/Pembayaran/{id}', [FakturPenjualanController::class, 'showpembayaran'])->name('pembayaran');
  Route::post('/penerimaan-pembayaran/{id}', [FakturPenjualanController::class, 'addpenerimaan'])->name('penerimaanpembayaran');
  route::get('/faktur/pdf/{id}', [FakturPenjualanController::class, 'faktur_pdf'])->name('faktur-penjualan-pdf');
  Route::get('/pesanan/pdf/{id}', [PenawaranController::class, 'pesanan_penjualan_pdf'])->name('pesanan-penjualan-pdf');

  // Pembelian
  Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian');
  Route::get('/pesananPembelian/{id}', [PembelianController::class, 'indexPesananPembelian'])->name('pesananPembelian');
  Route::get('/createPesananPembelian/{id}', [PembelianController::class, 'create'])->name('createPesananPembelian');
  Route::post('/createPesananPembelian/store/{id}',[PembelianController::class,'store'])->name('createPesananPembelian/store');
  Route::get('/showPembelian/{id}', [PembelianController::class, 'showPembelian'])->name('showPembelian');
  Route::get('/pembelian/edit/{id}',[PembelianController::class,'edit'])->name('pembelian/edit');
  Route::put('/pembelian/update/{id}',[PembelianController::class,'update'])->name('pembelian/update');
  route::DELETE('/delete/pembelian/{id}', [PembelianController::class, 'destroy'])->name('delete/pembelian');
  Route::post('/addBarangPembelian/{id}', [PembelianController::class, 'addBarangPembelian'])->name('addBarangPembelian');
  Route::get('/editStatus/{id}',[PembelianController::class,'editStatus'])->name('editStatus');
  Route::post('/update/status/{id}',[PembelianController::class,'updateStatus'])->name('update/status');
  Route::get('/ShowFakturPembelians/{id}', [PembelianController::class, 'showFakturPembelians'])->name('showfakturpembelians');

  Route::get('/fakturPembelian/{id}', [FakturPembelianController::class, 'index'])->name('fakturPembelian');
  Route::get('/fakturPembelian/create/{id}', [FakturPembelianController::class, 'create'])->name('fakturPembelian/create');
  Route::post('/fakturPembelian/store/{id}', [FakturPembelianController::class, 'store'])->name('fakturPembelian/store');
  Route::get('/detailFaktur/{id}', [FakturPembelianController::class, 'show'])->name('detailFaktur');
  Route::get('/detailSyaratFaktur/{id}', [FakturPembelianController::class, 'showFakturPembelianSyarat'])->name('detailSyaratFaktur');
  Route::post('/detailSyaratFaktur/update/{id}',[FakturPembelianController::class,'update'])->name('detailSyaratFaktur/update');
  Route::get('/pembayaranPembeli/{id}', [FakturPembelianController::class, 'indexPembayaran'])->name('pembayaranPembeli');
  Route::get('/PembeliShow/{id}', [FakturPembelianController::class, 'showPembayaranPembelian'])->name('PembeliShow');
  Route::post('/pembayarranPembeli/{id}', [FakturPembelianController::class, 'addPembayaranPembelian'])->name('pembayarranPembeli');
  route::get('/faktur-pembelian/pdf/{id}', [FakturPembelianController::class, 'faktur_pdf'])->name('faktur-pembelian-pdf');
  Route::get('/pesanan-pembelian/pdf/{id}', [PembelianController::class, 'pesanan_pembelian_pdf'])->name('pesanan-pembelian-pdf');

  // route::get('pembelian/faktur/pdf/{id}', [FakturPembelianController::class, 'fakturPembelian_pdf'])->name('pembelian/faktur/pdf');
  route::get('/testing', [FakturPembelianController::class, 'fakturPembelian_pdf'])->name('/testing');

  Route::get('/PembelianFaktur/{id}', [FakturPembelianController::class, 'showfakturPembelian'])->name('fakturpembelian');

  Route::get('/PembelianFaktur/edit/{id}',[FakturPembelianController::class,'edit'])->name('faktur.editP');
  Route::post('/addbarangfakturpembelian/{id}', [FakturPembelianController::class, 'addbrngFP'])->name('add.barangfakturP');
  Route::put('/FakturPembelian/update/{id}',[FakturPembelianController::class,'updateFP'])->name('faktur.updateFP');

  // bank
  Route::get('/bank', [BankController::class, 'index'])->name('/bank');
  Route::get('/bank/show/{id}', [BankController::class, 'show'])->name('/bank/show');
  Route::post('/bank/store', [BankController::class, 'store'])->name('/bank/store');
  Route::get('/bank/edit/{id}', [BankController::class, 'edit'])->name('/bank/edit');
  Route::post('/bank/update/{id}', [BankController::class, 'update'])->name('/bank/update');
  Route::get('/bank/delete/{id}', [BankController::class, 'destroy'])->name('/bank/delete');

  //Barang
  Route::get('/Barang',[BarangController::class,'index'])->name('barang');
  Route::post('/Barang/Simpan',[BarangController::class,'store'])->name('barang.simpan');
  Route::get('/Barang/edit/{id}',[BarangController::class,'edit'])->name('edit.barang');
  Route::post('/Barang/update/{id}',[BarangController::class,'update'])->name('update.barang');
  Route::get('/Barang/delete/{id}',[BarangController::class,'destroy'])->name('delete.barang');
});

// ! Routing Corporate
Route::group(['middleware'  => ['auth']], function () {
  Route::get('/dashboardCorporate', [CorporateController::class, 'index'])->name('dashboardCorporate');
  Route::get('/Report-Transaction-Maker/RevenuevsCost', [RevenueCostController::class, 'index'])->name('TMakerRevCost');

  // Reimbursement
  Route::get('/PersonelTeam', [ReimbursementController::class, 'indexPersonelteam'])->name('personelindex');
  Route::post('/PersonelTeam', [ReimbursementController::class, 'storePersonelteam'])->name('personelstore');
  Route::get('/PersonelTeam/{id}', [ReimbursementController::class, 'destroyPersonel'])->name('personeldelete');

  Route::get('/Client-Reimbursement', [ReimbursementController::class, 'indexClient'])->name('clientindex');
  Route::get('/Client-Reimbursement/create', [ReimbursementController::class, 'createClient'])->name('clientcreate');
  Route::post('/Client-Reimbursement/create', [ReimbursementController::class, 'storeClient'])->name('clientstore');
  Route::get('/Client-Reimbursement/{id}', [ReimbursementController::class, 'destroyClient'])->name('clientdelete');

  Route::get('/OpptyProject', [ReimbursementController::class, 'indexOpptyproject'])->name('opptyprojectindex');
  Route::get('/OpptyProject/create', [ReimbursementController::class, 'createOpptyproject'])->name('opptyprojectcreate');
  Route::post('/OpptyProject/create', [ReimbursementController::class, 'storeOpptyproject'])->name('opptyprojectstore');
  Route::delete('/OpptyProject/{id}', [ReimbursementController::class, 'destroyOpptyproject'])->name('opdelete');

  Route::get('/createTMReim/{id}',[ReimbursementController::class,'CreateTMReim'])->name('createTMReim');
  // Route::get('/Transaction-Maker/Reimbursement', [ReimbursementController::class, 'indexTmakerreimburs'])->name('TMReimbursement');
  // Route::get('/Transaction-Maker/Reimbursement/create', [ReimbursementController::class, 'createTmakerreimburs'])->name('create-TMReimbursement');
  Route::get('/Transaction-Maker/Reimbursement/edit/{id}',[ReimbursementController::class,'editTmReim'])->name('edit-TMReimbursement');
  Route::post('/Transaction-Maker/Reimbursement/update/{id}',[ReimbursementController::class,'updateTmakerreimburs'])->name('update-TMReimbursement');
  Route::get('/Transaction-Maker/Reimbursement/show/{id}',[ReimbursementController::class,'showTMReim'])->name('show-TMReimbursement');
  Route::post('/Transaction-Maker/Reimbursement/create', [ReimbursementController::class, 'storeTmakerreimburs'])->name('store-TMReimbursement');
  Route::get('/Transaction-Maker/Reimbursement/viewEditTreimburs/{id}', [ReimbursementController::class, 'viewEditTreimburs'])->name("viewEditTreimburs.edit");
  Route::get('/reimursment/edit/{id}', function () {
      return view('corporate.reimbursement.opptyproject.edit');
  })->name("reibursment.edit");
  Route::put('/updateOppty/{id}', [ReimbursementController::class, 'updateOpptyProject'])->name('updateOppty.update');
  // Revenue vs Cost
  Route::get('/SaldoAwal', [RevenueCostController::class, 'indexSaldo'])->name('index-saldo');
  Route::get('/SaldoAwal/{id}', [RevenueCostController::class, 'destroySaldo'])->name('deletesaldo');
  Route::get('/saldo-create', function() {
      return view("corporate.revcost.create-saldo");
  });
  Route::post('/SaldoAwal/create', [RevenueCostController::class, 'storeSaldo'])->name('store-saldo');
  Route::get('/Transaction-Maker/RevenuevsCost/{id}', [RevenueCostController::class, 'detailTmaker'])->name('detail-TMRevCost');
  // Route::get('/Transaction-Maker/RevenuevsCost', [RevenueCostController::class, 'indexTmaker'])->name('TMRevCost');
  Route::get('/Create/RevenuevsCost/{id}', [RevenueCostController::class, 'createTmaker'])->name('create-TMRevCost');
  Route::post('/Transaction-Maker/RevenuevsCost', [RevenueCostController::class, 'storeTmaker'])->name('store-TMRevCost');
  Route::get('/Delete-all/RevenuevsCost', [RevenueCostController::class, 'deleteAll'])->name('delete-TMRevCost');

  // DCL
  Route::get('/DCL-DISTRIBUTOR', [DCLController::class, 'indexdisti'])->name('dcldistiindex');
  Route::post('/DCL-DISTRIBUTOR', [DCLController::class, 'storedisti'])->name('dcldististore');
  Route::get('/DCL-DISTRIBUTOR/{id}', [DCLController::class, 'destroydisti'])->name('dcldistidelete');
  route::get("/edit/sbu/{id}", [DCLController::class, 'editSbu'])->name("edit-sbu");
  route::post("/update/sbu/{id}", [DCLController::class, 'updateSbu'])->name("upte-sbu");

  Route::get('/DCL-SBU', [DCLController::class, 'indexsbu'])->name('dclsbuindex');
  Route::post('/DCL-SBU', [DCLController::class, 'storesbu'])->name('dclsbustore');
  Route::get('/DCL-SBU/{id}', [DCLController::class, 'destroysbu'])->name('dclsbudelete');

  Route::get('/PIC-Distributor', [DCLController::class, 'indexPic'])->name('picdistiindex');
  Route::get('/PIC-Distributor/create', [DCLController::class, 'createPic'])->name('picdisticreate');
  Route::post('/PIC-Distributor/create', [DCLController::class, 'storePic'])->name('picdististore');
  Route::get('/PIC-Distributor/{id}', [DCLController::class, 'destroypicdisti'])->name('picdistidelete');

  Route::get('/Transaction-Maker/DCL/{id}', [DCLController::class, 'indexTmakerdcl'])->name('TMDLCindex');
  Route::get('/Transaction-Maker/DCL/show/{id}', [DCLController::class, 'showTmakerdcl'])->name('TMDLshow');
  Route::post('/Transaction-Maker/DCL/create', [DCLController::class, 'storeTmakerdcl'])->name('TMDLstore');

  //ACDC Create Principal
  Route::get('/index-createprincipal',[ACDCController::class,'indexCP'])->name('/indexCP');
  Route::post('/CreatePrincipal',[ACDCController::class,'saveCP'])->name('cp');
  Route::get('/deleteCP/{id}',[ACDCController::class,'deleteCP'])->name('deleteCP');


  //ACDC Create Client
  Route::get('/index-createclient',[ACDCController::class,'indexCC'])->name('/indexCC');
  Route::post('/CreateClient',[ACDCController::class,'saveCC'])->name('cc');
  Route::get('/deleteCC/{id}',[ACDCController::class,'deleteCC'])->name('deleteCC');

  //ACDC Create Project
  Route::get('datalist-cpt',[ACDCController::class,'getDataList'])->name('dataList-cpt');
  Route::get('/index-createproject',[ACDCController::class,'indexCPT'])->name('indexCPT');
  Route::get('/CreateProject',[ACDCController::class,'createCPT'])->name('/cpt');
  Route::post('/saveCPT',[ACDCController::class,'saveCPT'])->name('svcpt');
  Route::get('/showCPT/{id}',[ACDCController::class,'showCPT'])->name('showcpt');
  Route::get('/editCP/{id}',[ACDCController::class,'editCP'])->name('editcp');
  Route::get('/editTransactionMaker/{id}',[ACDCController::class,'editTransactionMaker'])->name('editTransactionMaker.edit');
  Route::put('/updateAcdcP/{id}', [ACDCController::class, 'updateProjectAcdc'])->name('updateAcdcP');
  Route::delete('/deletecpt/{id}',[ACDCController::class,'deletecpt'])->name('deletecpt');
  Route::get('/getByClient',[ACDCController::class,'getByClient'])->name('getbyclient');
  Route::post('/getProjectByClient',[ACDCController::class,'getPojectByClient'])->name('getProjectByClient');

  //ACDC Transaction Maker
  Route::get('/index-transactionmakerACDC',[ACDCController::class,'indexTM'])->name('/indexTM');
  Route::post('/createTM',[ACDCController::class,'saveTM'])->name('saveTM');

  //CMM Create Bank
  Route::get('/index-createbank',[CMMController::class,'indexCB'])->name('indexCB');
  Route::post('/saveCB',[CMMController::class,'saveCB'])->name('saveCB');
  Route::get('/deleteCB/{id}',[CMMController::class,'deleteCB'])->name('deleteCB');

  //CMM Create PRK
  Route::get('/index-PRK',[CMMController::class,'indexCPRK'])->name('indexPRK');
  Route::post('/saveCPRK',[CMMController::class,'saveCPRK'])->name('saveCPRK');

  //CMM Transaction Maker
  Route::get('/index-TransactionMakerCMM',[CMMController::class,'indexTMCMM'])->name('indexTMCMM');
  Route::post('/saveTMCMM/{id}',[CMMController::class,'saveTMCMM'])->name('saveTMCMM');

  Route::get('/createTM/{id}',[ACDCController::class,'CreateTM'])->name('createTM');
  Route::post('/saveTMAC/{id}',[ACDCController::class,'saveTMAC'])->name('saveTMAC');

  Route::get('/editTM/{id}',[ACDCController::class,'editTM'])->name('editTM');
  Route::post('/Transaction-Maker/ACDC/update/{id}',[ACDCController::class,'updateTMACDC'])->name('update-TMACDC');

  Route::post('/cpt', [ACDCController::class, 'cpt'])->name('cpt');

  Route::get('/createTMCMM/{id}',[CMMController::class,'CreateTMCMM'])->name('createTMCMM');
  Route::get('/detailTMCMM/{id}',[CMMController::class,'detailTMCMM'])->name('detailTMCMM');

  Route::get('/deletePRK/{id}',[CMMController::class,'deletePRK'])->name('deletePRK');

});


//report
Route::get('/report-acdc', function() {
  return view('report.corporate.acdc.index');
});

Route::get('/report-dcl', function() {
  return view('report.corporate.dcl.index');
});


Route::get('/report-reimbursement', function() {
  return view('report.corporate.reimbursement.index');
});

Route::get('/report-cmm', function() {
  return view('report.corporate.cmm.index');
});

Route::post('/report-acdc', [CorporateReportController::class, 'AcdcReport'])->name('reportAcdc');
Route::post('/report-reimbursement', [CorporateReportController::class, 'ReimbursementReport'])->name('reportreimbursment');
Route::post('/report-dcl', [CorporateReportController::class, 'DclReport'])->name('DclReport');
Route::post('/report-cmm', [CorporateReportController::class, 'CmmReport'])->name('CmmReport');

Route::group(['middleware'  => ['auth']], function () {
  Route::get('dashboard-hrd', function() {
    return view('DashboardHrd');
  });
  Route::resource('hrd', HrdController::class);
});
