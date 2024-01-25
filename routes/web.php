<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\BreakageMaintenanceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckListController;
use App\Http\Controllers\ChecklistTaskController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryCountController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MainCheckListController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportTypeController;
use App\Http\Controllers\SendReportController;
use App\Http\Controllers\SpoilageMaintenanceController;
use App\Http\Controllers\SubChecklistController;
use App\Http\Controllers\SupervisionDashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\ItemCategory;
use App\Models\MainCheckList;
use App\Models\ReportType;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use function Termwind\render;

// use Inertia\Inertia;


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
});


Route::middleware([
    'Admin',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::get('/Dashboard', function () {
        return Inertia::render('Admin/Pages/Dashboard');
    })->name('dashboard');

    Route::GET('/user-list', [UserController::class, 'userlist'])->name('user.list');
    Route::POST('/adduser', [UserController::class, 'adduser'])->name('add.user');
    Route::DELETE('/user_list/{id}', [UserController::class, 'deleteUser'])->name('delete.user');

    Route::GET('/branch', [BranchController::class, 'index'])->name('branch.index');
    Route::POST('/branch', [BranchController::class, 'store'])->name('branch.store');
    Route::Delete('/branch/{id}', [BranchController::class, 'deleteBranch'])->name('branch.delete');

    Route::GET('/item-category', [CategoryController::class, 'index'])->name('item.index');
    Route::DELETE('/item-category/{id}', [CategoryController::class, 'deleteItemCategory'])->name('item.delete');
    Route::POST('/item-category', [CategoryController::class, 'store'])->name('item.store');


    Route::GET('/item', [ItemController::class, 'index'])->name('item');
    Route::DELETE('/item/{id}', [ItemController::class, 'deleteHandler'])->name('delete.item');
    Route::POST('/item', [ItemController::class, 'store'])->name('item.store');


    Route::GET('/department', [DepartmentController::class, 'index'])->name('department.index');
    Route::POST('/department', [DepartmentController::class, 'store'])->name('department.store');
    Route::DELETe('/department/{id}', [DepartmentController::class, 'deleteDepartment'])->name('department.delete');


    Route::GET('/spoilage', [SpoilageMaintenanceController::class, 'index'])->name('spoilage.index');
    Route::POST('/spoilage', [SpoilageMaintenanceController::class, 'store'])->name('spoilage.store');

    Route::GET('/breakage', [BreakageMaintenanceController::class, 'index'])->name('breakage.index');
    Route::POSt('/breakage', [BreakageMaintenanceController::class, 'store'])->name('breakage.store');

    Route::GET('/task', [TaskController::class, 'index'])->name('task.index');
    Route::POST('/task', [TaskController::class, 'store'])->name('task.store');

    Route::GET('/main_checklist', [MainCheckListController::class, 'index'])->name('mainchecklist.index');
    Route::DELETE('/main_checklist/{id}', [MainCheckListController::class, 'deleteMainchecklist'])->name('mainchecklist.delete');
    Route::POST('/main_checklist_store', [MainCheckListController::class, 'store'])->name('mainchecklist.store');

    Route::GET('/sub_checklist', [SubChecklistController::class, 'index'])->name('subchecklist.index');
    Route::DELETE('/sub_checklist/{id}', [SubChecklistController::class, 'deleteSubChecklist'])->name('subchecklist.delete');
    Route::POST('/sub_checklist', [SubChecklistController::class, 'store'])->name('subchecklist.store');

    Route::GET('/checklist_task', [ChecklistTaskController::class, 'index'])->name('checklist.task.index');
    Route::DELETE('/checklist_task/{id}', [ChecklistTaskController::class, 'deleteSubChecklist'])->name('checklist.task.delete');
    Route::POST('/checklist_task', [ChecklistTaskController::class, 'store'])->name('checklist.task.store');


    Route::GET('/report_type', [ReportTypeController::class, 'index'])->name('report.type.index');
    Route::POST('/report_type', [ReportTypeController::class, 'store'])->name('report.type.store');

    Route::GET('/checklist_report', [ReportController::class, 'checklistIndex'])->name('checklist.report.index');
    Route::GET('/checklist_report_branch/{id}', [ReportController::class, 'checklistByBranch'])->name('checklist.report.branch');

    Route::GET('/breakage_report', [ReportController::class, 'breakageIndex'])->name('breakage.report.index');
    Route::GET('/breakage_report_branch/{id}', [ReportController::class, 'breakageByBranch'])->name('breakage.report.branch');
    Route::GET('/spoilage_report', [ReportController::class, 'spoilageIndex'])->name('spoilage.report.index');
    Route::GET('/spoilage_report_branch/{id}', [ReportController::class, 'spoilageByBranch'])->name('spoilage.report.branch');
    Route::GET('/inventory_count_report', [ReportController::class, 'inventoryCountIndex'])->name('inventory.count.report.index');
    Route::GET('/inventory_count_By_branch/{id}', [ReportController::class, 'inventoryCountByBranch'])->name('inventory.count.by_branch');
});

Route::middleware([
    'Supervisor',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::GET("/Dashboard", [HomeController::class, 'index'])->name('supervisor.dashboard');
    Route::GET('/breakage-supervisor', [BreakageMaintenanceController::class, 'indexsupervisor'])->name('breakage.supervisor.index');
    Route::POST('/breakage', [BreakageMaintenanceController::class, 'storesupervisor'])->name('breakage.supervisor.store');

    Route::GET('/spoilage-supervisor-index', [SpoilageMaintenanceController::class, 'indexsupervisor'])->name('spoilage.supervisor.index');
    Route::POST('/spoilage-supervisor-store', [SpoilageMaintenanceController::class, 'storesupervisor'])->name('spoilage.supervisor.store');


    Route::GET('/assigned_task', [TaskController::class, 'AssignedTask'])->name('assigned.task');
    Route::GET('/assign_task', [TaskController::class, 'AssignTask'])->name('assign.task');

    Route::POST('/assign_task_supervisor', [TaskController::class, 'AssignTaskStore'])->name('task.supervisor.store');
    Route::PATCH('/task-change-status', [SupervisionDashboardController::class, 'changeStatus'])->name('task.change.status');



    Route::GET('/send_report', [SendReportController::class, 'sendReport'])->name('send.report');
    Route::POST('/send_report', [SendReportController::class, 'store'])->name('send.report.store');
    Route::GET('/incoming_report', [SendReportController::class, 'incomingReport'])->name('send.report.incoming');

    Route::GET('/inventory_count', [InventoryCountController::class, 'index'])->name('index');
    Route::GET('/inventory_count_add', [InventoryCountController::class, 'indexAdd'])->name('index.add');
    Route::POST('/inventory_count_add', [InventoryCountController::class, 'store'])->name('inventory.count.store');

    Route::GET('/supervisor_checklist', [CheckListController::class, 'index'])->name('supervisor.checklist');
    Route::GET('/supervisor_checklist_add', [CheckListController::class, 'indexAdd'])->name('supervisor.checklist.add');
    Route::POST('/supervisor_checklist_store', [CheckListController::class, 'store'])->name('supervisor.checklist.store');
});
