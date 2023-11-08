<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\AdmissionController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\LiveclassController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\ParentsController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\AssignController;


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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();


Route::get('impersonate/user/{id}',[ImpersonateController::class,'index'])->name('impersonate');



Route::get('/dashboard', [DashboardController::class,'card'])->middleware(['auth', 'verified'])->name('dashboard');


Route::get('user',[UserController::class,'addUser'])->middleware(['auth', 'verified'])->name('user');
Route::post('/save-user', [UserController::class, 'save'])->middleware(['auth', 'verified'])->name('save-user');
Route::get('/user-list', [UserController::class, 'userList'])->middleware(['auth', 'verified'])->name('user-list');
Route::get('/get-user-count', [UserController::class, 'getUserCount'])->middleware(['auth', 'verified'])->name('get-user-count');


 // school routes
Route::get('/add-school', [SchoolController::class, 'addSch'])->middleware(['auth', 'verified'])->name('add-school');
Route::post('/save-school', [SchoolController::class, 'save'])->middleware(['auth', 'verified'])->name('save-school');
Route::get('/school-list', [SchoolController::class, 'schoolList'])->middleware(['auth', 'verified'])->name('school-list');
Route::get('/update-school', [SchoolController::class, 'update'])->middleware(['auth', 'verified'])->name('update-school');
Route::post('/update-school', [SchoolController::class, 'updateSchool'])->middleware(['auth', 'verified'])->name('update-school');
Route::delete('/delete-school/{user_id}', [SchoolController::class, 'deleteSchool'])->middleware(['auth', 'verified'])->name('delete-school');
Route::get('/getBranches/{school}', [SchoolController::class,'getBranches'])->middleware(['auth', 'verified'])->name('getBranches');



 // admission routes
// Route::get('/admission-create', [AdmissionController::class, 'studentAdmission'])->middleware(['auth', 'verified'])->name('create-admission');
Route::post('/save-admission', [AdmissionController::class, 'save'])->middleware(['auth', 'verified'])->name('save-admission');
Route::get('/admission-list', [AdmissionController::class, 'admissionList'])->middleware(['auth', 'verified'])->name('admission-list');
Route::get('/admission-create', [StudentController::class, 'fetchBranch'])->middleware(['auth', 'verified'])->name('create-admission');

 // branch routes
Route::get('/add-branch', [BranchController::class, 'addBranch'])->middleware(['auth', 'verified'])->name('add-branch');
Route::post('/save-branch', [BranchController::class, 'save'])->middleware(['auth', 'verified'])->name('save-branch');
Route::get('/branch-list', [BranchController::class,'branchList'])->middleware(['auth', 'verified'])->name('branch-list');
Route::get('/update-branch', [BranchController::class, 'update'])->middleware(['auth', 'verified'])->name('update-branch');
Route::post('/update-branch', [BranchController::class, 'updateBranch'])->middleware(['auth', 'verified'])->name('update-branch');
Route::delete('/delete-branch/{user_id}', [BranchController::class, 'deleteBranch'])->middleware(['auth', 'verified'])->name('delete-branch');

/**Drop Down Start**/
Route::get('/get-branches/{schoolId}', [BranchController::class,'getBranches'])->middleware(['auth', 'verified'])->name('get-branches');
Route::get('/get-teachers/{branchId}', [TeacherController::class,'getTeachers'])->middleware(['auth', 'verified'])->name('get-teachers');
Route::get('/get-classes/{teacherId}', [ClassController::class,'getClasses'])->middleware(['auth', 'verified'])->name('get-classes');
Route::get('/get-sections/{classId}', [SectionController::class,'getSections'])->middleware(['auth', 'verified'])->name('get-sections');
Route::get('/get-students/{sectionId}', [StudentController::class,'getStudents'])->middleware(['auth', 'verified'])->name('get-students');
/**Drop Down End***/

 // department routes
Route::get('/create-department', [DepartmentController::class, 'employeeDepartment'])->middleware(['auth', 'verified'])->name('create-department');
Route::post('/save-department', [DepartmentController::class, 'save'])->middleware(['auth', 'verified'])->name('save-department');
Route::get('/department-list', [DepartmentController::class, 'departmentList'])->middleware(['auth', 'verified'])->name('department-list');
Route::get('/create-department', [DepartmentController::class, 'fetchBranch'])->middleware(['auth', 'verified'])->name('create-department');
Route::get('/edit_department', [DepartmentController::class, 'editDepartment'])->middleware(['auth', 'verified'])->name('edit_department');
Route::post('/update-department', [DepartmentController::class, 'updateDepartment'])->middleware(['auth', 'verified'])->name('update-department');
Route::get('/department-list/{id}', [DepartmentController::class, 'destroy'])->name('department-list.destroy');

 // subject routes
Route::get('/add-subject', [SubjectController::class, 'addSubject'])->middleware(['auth', 'verified'])->name('add-subject');
Route::get('/save-subject', [SubjectController::class, 'save'])->middleware(['auth', 'verified'])->name('save-subject');
Route::get('/subject-list', [SubjectController::class, 'subjectList'])->middleware(['auth', 'verified'])->name('subject-list');
Route::get('/get-task-count', [SubjectController::class, 'getTaskCount'])->middleware(['auth', 'verified'])->name('get-task-count');
Route::get('/edit_subject', [SubjectController::class, 'editSubject'])->middleware(['auth', 'verified'])->name('edit_subject');
Route::post('/update-subject', [SubjectController::class, 'updateSubject'])->middleware(['auth', 'verified'])->name('update-subject');
Route::get('/subject-list/{id}', [SubjectController::class, 'destroy'])->name('subject-list.destroy');

 // employee routes
Route::get('/new-employee', [EmployeeController::class, 'addEmployee'])->middleware(['auth', 'verified'])->name('new-employee');
Route::post('/save-emp', [EmployeeController::class, 'save'])->middleware(['auth', 'verified'])->name('save-emp');
Route::get('/employee-list', [EmployeeController::class, 'employeeList'])->middleware(['auth', 'verified'])->name('employee-list');
Route::get('/edit_employee', [EmployeeController::class, 'editEmployee'])->middleware(['auth', 'verified'])->name('edit_employee');
Route::get('/new-employee', [EmployeeController::class, 'fetchEmployee'])->middleware(['auth', 'verified'])->name('new-employee');
Route::post('/update-employee', [EmployeeController::class, 'updateEmployee'])->middleware(['auth', 'verified'])->name('update-employee');
Route::get('/employee-list/{id}', [EmployeeController::class, 'destroy'])->name('employee-list.destroy');

 // student routes
Route::get('/add-student', [StudentController::class, 'registerForm'])->middleware(['auth', 'verified'])->name('add-student');
Route::post('/save-student', [StudentController::class, 'save'])->middleware(['auth', 'verified'])->name('save-student');
Route::get('/add-student', [StudentController::class, 'fetchBranch'])->middleware(['auth', 'verified'])->name('add-student');
Route::get('/student-list', [StudentController::class, 'studentList'])->middleware(['auth', 'verified'])->name('student-list');
Route::get('/edit_student', [StudentController::class, 'editStudent'])->middleware(['auth', 'verified'])->name('edit_student');
Route::post('/update-student', [StudentController::class, 'updateStudent'])->middleware(['auth', 'verified'])->name('update-student');
Route::delete('/delete-student/{id}', [StudentController::class, 'deleteStudent'])->middleware(['auth', 'verified'])->name('delete-student');
// Route::get('/add-student', [StudentController::class,'showRegistrationForm'])->middleware(['auth', 'verified'])->name('register');

 // teacher routes
 Route::get('/add-teacher', [TeacherController::class, 'create'])->middleware(['auth', 'verified'])->name('add-teacher');
 Route::post('/create-teacher', [TeacherController::class, 'addTeacher'])->middleware(['auth', 'verified'])->name('create-teacher');
 Route::get('/teacher-list', [TeacherController::class, 'teacherList'])->middleware(['auth', 'verified'])->name('teacher-list');
 Route::get('/edit-teacher', [TeacherController::class, 'editTeacher'])->middleware(['auth', 'verified'])->name('edit-teacher');

 Route::post('/update-teacher', [TeacherController::class, 'updateTeacher'])->middleware(['auth', 'verified'])->name('update-teacher');
 Route::post('/destroy-teacher', [TeacherController::class, 'destroy'])->middleware(['auth', 'verified'])->name('destroy-teacher');
 Route::get('/teacherdashboard', [TeacherController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('teacherdashboard');
Route::get('/teachers', [TeacherController::class, 'index'])->middleware(['auth', 'verified'])->name('teachers.index');

 Route::get('attendance-form', [AttendanceController::class, 'attendance'])->middleware(['auth', 'verified'])->name('attendance-form');
 Route::get('attendance-form/{id}', [AttendanceController::class, 'show'])->name('att.show');
// Route::get('attendance-form',[AttendanceController::class, 'searchAttendance'])->name('attendance-list');
// Route::get('attendance-list',[AttendanceController::class, 'searchAttendance'])->name('attendance-list');
Route::post('/attendance/update-status', [AttendanceController::class, 'updateStatus'])->name('attendance.update-status');
Route::post('/attendance/fetch', [AttendanceController::class,'fetchAttendance'])->name('attendance.fetch');
Route::put('/update-present/{id}', [AttendanceController::class,'updatePresent'])->name('update-present');
Route::put('/update-absent/{id}', [AttendanceController::class, 'updateAbsent'])->name('updateAbsent');

// Route::get('users', [UserController::class, 'index']);





 Route::get('teachers-details/{id}', [TeacherController::class, 'details'])->name('teachers-details');

 Route::get('/fee-manager', [PaymentController::class, 'feeManager'])->middleware(['auth', 'verified'])->name('fee-manager');
Route::get('/offline-payment', [PaymentController::class, 'storeOfflinePayment'])->middleware(['auth', 'verified'])->name('offline-payment');
Route::post('/offline-payment', [PaymentController::class, 'addOfflinePayment'])->middleware(['auth', 'verified'])->name('offline-payment');
Route::get('/get-payment-count', [PaymentController::class, 'getPaymentCount'])->middleware(['auth', 'verified'])->name('get-payment-count');
Route::post('/expense-save', [ExpenseController::class, 'save'])->middleware(['auth', 'verified'])->name('expense-save');
Route::get('/accounting/expenses', [ExpenseController::class, 'expenseManager'])->middleware(['auth', 'verified'])->name('expense-manager');
Route::get('/expense-category', [ExpenseController::class, 'expenseCat'])->middleware(['auth', 'verified'])->name('expense-category');

Route::post('/accounting/student-fees', [PaymentController::class, 'save'])->name('fee-manager.save');

Route::get('/accounting/expenses', [ExpenseController::class,'store'])->name('expense-manager');

//Class Routes
    Route::get('academic/class', [ClassController::class, 'classIndex'])->middleware(['auth', 'verified'])->name('academic.class');
    Route::post('academic/class', [ClassController::class, 'classIndex'])->middleware(['auth', 'verified'])->name('academic.class_destroy');
    Route::get('academic/class/create', [ClassController::class, 'addClass'])->middleware(['auth', 'verified'])->name('class_create');
    Route::post('academic/class/store', [ClassController::class, 'saveClass'])->middleware(['auth', 'verified'])->name('class_store');
    Route::get('academic/class/edit/{id}', [ClassController::class, 'update'])->middleware(['auth', 'verified'])->name('academic.class_edit');
    Route::post('academic/class/update', [ClassController::class, 'updateClass'])->middleware(['auth', 'verified'])->name('academic.class_update');
    Route::post('academic/class/status/{id}', [ClassController::class, 'Status'])->name('academic.class_status');
    Route::post('/academic.class_destroy', [ClassController::class, 'destroy'])->middleware(['auth', 'verified'])->name('academic.class_destroy');


 // academic routes
    // section
    Route::get('academic/section', [SectionController::class, 'sectionIndex'])->middleware(['auth', 'verified'])->name('academic.section');
    Route::post('academic/section', [SectionController::class, 'sectionIndex'])->middleware(['auth', 'verified'])->name('academic.section_destroy');
    Route::get('academic/section/create', [SectionController::class, 'sectionCru'])->middleware(['auth', 'verified'])->name('academic.section_create');
    Route::post('academic/section/create', [SectionController::class,'sectionCru'])->middleware(['auth', 'verified'])->name('academic.section_store');
    Route::get('academic/section/edit/{id}', [SectionController::class, 'sectionCru'])->middleware(['auth', 'verified'])->name('academic.section_edit');
    Route::post('academic/section/update/{id}', [SectionController::class, 'sectionCru'])->middleware(['auth', 'verified'])->name('academic.section_update');
    Route::post('academic/section/status/{id}', [SectionController::class,'sectionStatus'])->name('academic.section_status');
    
    
Route::get('academic/live-class', [LiveclassController::class, 'createLiveClass'])->middleware(['auth', 'verified'])->name('live-class');
Route::post('academic/live-class', [LiveclassController::class, 'storeLiveClass'])->middleware(['auth', 'verified'])->name('live-class');
Route::get('liveclass-list', [LiveclassController::class, 'liveclassList'])->middleware(['auth', 'verified'])->name('liveclass-list');
Route::get('notification', [LiveclassController::class, 'sendMail'])->name('send.mail');
Route::get('academic/live-class/edit-live-class/{id}', [LiveclassController::class, 'editLiveClass'])->middleware(['auth', 'verified'])->name('edit-live-class');
Route::get('academic/live-class/getBranchName/{id}', [LiveclassController::class, 'getBranchName'])->middleware(['auth', 'verified']);
Route::put('/update-live-class', [LiveclassController::class, 'updateLiveClass'])->name('update-live-class');
Route::post('liveclass-delete/{id}', [LiveclassController::class, 'deleteLiveClass'])->middleware(['auth', 'verified'])->name('liveclass-delete');

Route::put('/update-status/{id}', [SchoolController::class, 'updateStatus'])->name('update-status');
Route::put('/inactive-update-status/{id}', [SchoolController::class, 'inactiveUpdateStatus'])->name('inactive-update-status');
Route::put('/status/{id}', [BranchController::class, 'status'])->name('status');
Route::put('/inactive-status/{id}', [BranchController::class, 'inactiveStatus'])->name('inactive-status');
Route::put('/active/{id}', [UserController::class, 'active'])->name('active');
Route::put('/inactive/{id}', [UserController::class, 'inactive'])->name('inactive');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/admin/settings', [SettingsController::class, 'adminSettings'])->name('admin.settings');
Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
Route::get('/admin/profile', [SettingsController::class, 'adminProfile'])->name('admin.profile');
Route::post('/admin/profile/store', [SettingsController::class, 'adminProfileStore'])->name('admin.profile.store');
Route::get('/admin/activity', [SettingsController::class, 'adminActivity'])->name('admin.activity');
Route::get('/accounting', [AccountingEntryController::class, 'index'])->name('accounting');

Route::get('/admin/impersonate/destroy',[ImpersonateController::class,'destroy'])->name('admin.impersonate.destroy');

// Parent Routes
Route::get('/parent-list', [ParentsController::class, 'index'])->middleware(['auth', 'verified'])->name('parent-list');

Route::get('/parent/login/{id}', [ParentsController::class, 'login'])->name('parent.login');
Route::get('/parent/delete/{id}', [ParentsController::class, 'delete'])->name('parent.delete');
Route::get('/parent/revert', [ParentsController::class, 'revertToAdmin'])->name('parent.revert');

Route::get('/add-parent', [ParentsController::class, 'addParent'])->middleware(['auth', 'verified'])->name('add-parent');

Route::post('/add-parent', [ParentsController::class, 'storeParent'])->middleware(['auth', 'verified'])->name('store-parent');

Route::get('/word-form', [WordController::class,'index'])->middleware(['auth', 'verified'])->name('word-form');
Route::post('/word-form', [WordController::class,'store'])->middleware(['auth', 'verified'])->name('word-form');

Route::get('/assignments', [AssignController::class,'index'])->middleware(['auth', 'verified'])->name('assignments.index');
Route::get('/assignments/create', [AssignController::class,'create'])->middleware(['auth', 'verified'])->name('assignments.create');
Route::post('/assignments', [AssignController::class,'store'])->middleware(['auth', 'verified'])->name('assignments.store');
Route::get('/assignments/{assignment}/edit', [AssignController::class,'edit'])->middleware(['auth', 'verified'])->name('assignments.edit');
Route::put('/assignments/{assignment}', [AssignController::class,'update'])->middleware(['auth', 'verified'])->name('assignments.update');
Route::delete('/assignments/{assignment}', [AssignController::class,'destroy'])->middleware(['auth', 'verified'])->name('assignments.destroy');