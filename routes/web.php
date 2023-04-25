<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AssignsController;
use App\Http\Controllers\Backend\ClassroomsController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\FeeTypesController;
use App\Http\Controllers\Backend\GenerationController;
use App\Http\Controllers\Backend\MajorController;
use App\Http\Controllers\Backend\SemisterController;
use App\Http\Controllers\Backend\StudentFeesController;
use App\Http\Controllers\Backend\StudentGradeIndividualController;
use App\Http\Controllers\Backend\StudentGradesController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\StudentsController;
use App\Http\Controllers\Backend\SubjectsController;
use App\Http\Controllers\Backend\TeachersController;
use App\Http\Controllers\Backend\ThesesController;
use App\Http\Controllers\Backend\ThesisPresentationController;
use App\Http\Controllers\Backend\TutitionInstallmentsController;
use App\Http\Controllers\Backend\TutitionsController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\HeadUnitController;
use App\Http\Controllers\HeadDeptController;
use App\Http\Controllers\Reports\AssignsReportController;
use App\Http\Controllers\Reports\FeesReportController;
use App\Http\Controllers\Reports\GradesReportController;
use App\Http\Controllers\Reports\StudentsReportController;
use App\Http\Controllers\Reports\TeachersReportController;
use App\Http\Controllers\Reports\ThesesReportController;
use App\Http\Controllers\Reports\TutitionsReportController;
use App\Http\Controllers\Reports\UsersReportController;
use App\Http\Controllers\StudentController;
use App\Models\Assign;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/student_grades', [StudentGradesController::class, 'index'])->name('student_grades');
Route::get('/subject2', [SubjectsController::class, 'SubjectFilter']);
Route::get('/subjectList/{majorId}', function ($majorId) {
    // Retrieve all Assign records where major_id matches $majorId
    $subjects = Assign::where('major_id', $majorId)->get();
    return response()->json($subjects);
});

Route::get('/studentgrades/filter', [StudentGradesController::class, 'filterStudents'])->name('studentgrades.filter');

//admin Routes
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'ProfileDetail'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminController::class, 'ProfileEdit'])->name('admin.profileEdit');
    Route::post('/admin/profile/update', [AdminController::class, 'ProfileUpdate'])->name('admin.profileUpdate');
    Route::post('/admin/update_pwd', [AdminController::class, 'UpdatePwd'])->name('admin.updatePwd');
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashbard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/test', [AdminController::class, 'test']);
    Route::get('/users/trash', [UsersController::class, 'UsersTrash'])->name('users.trash');
    Route::get('/users/restore/{id}', [UsersController::class, 'UsersRestore'])->name('users.restore');
    Route::get('/students/trash', [StudentsController::class, 'StudentsTrash'])->name('students.trash');
    Route::get('/students/restore/{id}', [StudentsController::class, 'StudentRestore'])->name('student.restore');
    Route::get('/teachers/trash', [TeachersController::class, 'TeachersTrash'])->name('teachers.trash');
    Route::get('/teachers/restore/{id}', [TeachersController::class, 'TeacherRestore'])->name('teacher.restore');
    Route::get('/gen/trash', [GenerationController::class, 'GenTrash'])->name('gen.trash');
    Route::get('/gen/restore/{id}', [GenerationController::class, 'GenRestore'])->name('gen.restore');
    Route::get('/major/trash', [MajorController::class, 'MajorTrash'])->name('majors.trash');
    Route::get('/major/restore/{id}', [MajorController::class, 'MajorRestore'])->name('major.restore');
    Route::get('/semister/trash', [SemisterController::class, 'SemistersTrash'])->name('semisters.trash');
    Route::get('/semister/restore/{id}', [SemisterController::class, 'SemisterRestore'])->name('semister.restore');
    Route::get('/classroom/trash', [ClassroomsController::class, 'ClassTrash'])->name('classroom.trash');
    Route::get('/classroom/restore/{id}', [ClassroomsController::class, 'ClassRestore'])->name('classroom.restore');
    Route::get('/subject/trash', [SubjectsController::class, 'SubjectsTrash'])->name('subjects.trash');
    Route::get('/subject/restore/{id}', [SubjectsController::class, 'SubjectRestore'])->name('subject.restore');
    Route::get('/assign/trash', [AssignsController::class, 'AssignsTrash'])->name('assigns.trash');
    Route::get('/assign/restore/{id}', [AssignsController::class, 'AssignRestore'])->name('assign.restore');
    Route::get('/fees/type/trash', [FeeTypesController::class, 'FeeTypeTrash'])->name('feeType.trash');
    Route::get('/fees/type/restore/{id}', [FeeTypesController::class, 'FeeTypeRestore'])->name('feeType.restore');
});

//student Routes
Route::middleware(['auth', 'user-access:student'])->group(function () {
    Route::get('/student/dashbard', [StudentController::class, 'index'])->name('student.dashboard');
    Route::get('/student/profile/edit', [StudentController::class, 'ProfileEdit'])->name('studentProfile.edit');
    Route::post('/student/profile/update', [StudentController::class, 'ProfileUpdate'])->name('studentProfile.update');
    Route::get('/student/change_pwd', [StudentController::class, 'ChangePwd'])->name('student.changePwd');
    Route::post('/student/update_pwd', [StudentController::class, 'UpdatePwd'])->name('student.updatePwd');
});

//teacher Routes
Route::middleware(['auth', 'user-access:teacher'])->group(function () {
    Route::get('/teacher/profile', [TeacherController::class, 'ProfileDetail'])->name('teacher.profile');
    Route::get('/teacher/profile/edit', [TeacherController::class, 'ProfileEdit'])->name('teacher.profileEdit');
    Route::post('/teacher/profile/update', [TeacherController::class, 'ProfileUpdate'])->name('teacher.profileUpdate');
    Route::post('/teacher/update_pwd', [TeacherController::class, 'UpdatePwd'])->name('teacher.updatePwd');
    Route::get('/teacher/dashbard', [TeacherController::class, 'index'])->name('teacher.dashboard');
    //Assigns
    Route::get('/teacher/assigns/view', [TeacherController::class, 'AssignsView'])->name('teacher.assigns.view');
    Route::get('/teacher/assign/detail/{id}', [TeacherController::class, 'AssignDetail'])->name('teacher.assign.detail');
    //Grades
    Route::get('/teacher/grades/getSubjects', [TeacherController::class, 'GetSubjects'])->name('teacher.grades.getsubjects');
    Route::get('/teacher/grades/getStudents', [TeacherController::class, 'GetStudents'])->name('teacher.grades.getStudents');
    Route::get('/teacher/grades/filterResults', [TeacherController::class, 'filterResults'])->name('teacher.grades.filterResults');
    Route::get('/teacher/grades/detail/{id}', [TeacherController::class, 'StudentGradeDetail'])->name('teacher.grade.detail');
    Route::get('/teacher/grades/view', [TeacherController::class, 'GradesView'])->name('teacher.grades.view');
    Route::get('/teacher/grades/add', [TeacherController::class, 'GradesAdd'])->name('teacher.grades.add');
    Route::post('/teacher/grades/store', [TeacherController::class, 'GradesStore'])->name('teacher.grades.store');
    Route::get('/teacher/grades/edit/{id}', [TeacherController::class, 'GradeEdit'])->name('teacher.grade.edit');
    Route::post('/teacher/grades/update/{id}', [TeacherController::class, 'GradeUpdate'])->name('teacher.grade.update');
    //Report
    Route::get('/tc_reports/assigns', [AssignsReportController::class, 'TeacherAssignsReport'])->name('teacher.assigns.report');
    Route::get('/tc_reports/assigns/export', [AssignsReportController::class, 'TeacherExportFilteredAssigns'])->name('teacher.assigns.export');
    Route::get('/tc_reports/grades', [GradesReportController::class, 'TeacherGradesReport'])->name('teacher.grades.report');
    Route::get('/tc_reports/grades/export', [GradesReportController::class, 'TeacherExportFilteredGrades'])->name('teacher.grades.export');
});

//coordinator Routes
Route::middleware(['auth', 'user-access:coordinator'])->group(function () {
    Route::get('/coordinator/dashboard', [CoordinatorController::class, 'index'])->name('coordinator.dashboard');
    Route::get('/coordinator/profile', [CoordinatorController::class, 'ProfileDetail'])->name('coordinator.profile');
    Route::get('/coordinator/profile/edit', [CoordinatorController::class, 'ProfileEdit'])->name('coordinator.profileEdit');
    Route::post('/coordinator/profile/update', [CoordinatorController::class, 'ProfileUpdate'])->name('coordinator.profileUpdate');
    Route::post('/coordinator/update_pwd', [CoordinatorController::class, 'UpdatePwd'])->name('coordinator.updatePwd');
});

//headUnit Routes
Route::middleware(['auth', 'user-access:headUnit'])->group(function () {
    Route::get('/headUnit/dashbard', [HeadUnitController::class, 'index'])->name('headUnit.dashboard');
    Route::get('/headUnit/profile', [HeadUnitController::class, 'ProfileDetail'])->name('headUnit.profile');
    Route::get('/headUnit/profile/edit', [HeadUnitController::class, 'ProfileEdit'])->name('headUnit.profileEdit');
    Route::post('/headUnit/profile/update', [HeadUnitController::class, 'ProfileUpdate'])->name('headUnit.profileUpdate');
    Route::post('/headUnit/update_pwd', [HeadUnitController::class, 'UpdatePwd'])->name('headUnit.updatePwd');
});

//headDept Routes
Route::middleware(['auth', 'user-access:headDept'])->group(function () {
    Route::get('/headDept/dashbard', [HeadDeptController::class, 'index'])->name('headDept.dashboard');
    Route::get('/headDept/profile', [HeadDeptController::class, 'ProfileDetail'])->name('headDept.profile');
    Route::get('/headDept/profile/edit', [HeadDeptController::class, 'ProfileEdit'])->name('headDept.profileEdit');
    Route::post('/headDept/profile/update', [HeadDeptController::class, 'ProfileUpdate'])->name('headDept.profileUpdate');
    Route::post('/headDept/update_pwd', [HeadDeptController::class, 'UpdatePwd'])->name('headDept.updatePwd');
});

// Users Mangement All Routes
Route::prefix('users')->middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/view', [UsersController::class, 'UsersView'])->name('users.view');
    Route::get('/add', [UsersController::class, 'UsersAdd'])->name('users.add');
    Route::post('/store', [UsersController::class, 'UserStore'])->name('users.store');
    Route::get('/detail/{id}', [UsersController::class, 'UsersDetail'])->name('users.detail');
    Route::get('/edit/{id}', [UsersController::class, 'UsersEdit'])->name('users.edit');
    Route::post('/update/{id}', [UsersController::class, 'UsersUpdate'])->name('users.update');
    Route::get('/remove/{id}', [UsersController::class, 'UsersRemove'])->name('users.remove');
});

// Students Mangement All Routes
Route::prefix('students')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::get('/importPage', [StudentsController::class, 'StudentsImport'])->name('students.importPage');
    Route::post('/import', [StudentsController::class, 'import'])->name('students.import');
    Route::get('/detail/{id}', [StudentsController::class, 'StudentDetail'])->name('student.detail');
    Route::get('/view', [StudentsController::class, 'StudentsView'])->name('students.view');
    Route::get('/add', [StudentsController::class, 'StudentsAdd'])->name('students.add');
    Route::post('/store', [StudentsController::class, 'StudentStore'])->name('students.store');
    Route::get('/edit/{id}', [StudentsController::class, 'StudentEdit'])->name('student.edit');
    Route::post('/update/{id}', [StudentsController::class, 'StudentUpdate'])->name('student.update');
    Route::get('/remove/{id}', [StudentsController::class, 'StudentRemove'])->name('student.remove');
    Route::post('/resetPwd/{id}', [StudentsController::class, 'ResetPwd'])->name('student.resetPwd');
});

// Teachers Mangement All Routes
Route::prefix('teachers')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::get('/detail/{id}', [TeachersController::class, 'TeacherDetail'])->name('teacher.detail');
    Route::get('/view', [TeachersController::class, 'TeachersView'])->name('teachers.view');
    Route::get('/add', [TeachersController::class, 'TeachersAdd'])->name('teachers.add');
    Route::post('/store', [TeachersController::class, 'TeacherStore'])->name('teachers.store');
    Route::get('/edit/{id}', [TeachersController::class, 'TeacherEdit'])->name('teacher.edit');
    Route::post('/update/{id}', [TeachersController::class, 'TeacherUpdate'])->name('teacher.update');
    Route::get('/remove/{id}', [TeachersController::class, 'TeacherRemove'])->name('teacher.remove');
    Route::post('/resetPwd/{id}', [TeachersController::class, 'ResetPwd'])->name('teacher.resetPwd');
});

// Generations Mangement All Routes
Route::prefix('generation')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::get('/view', [GenerationController::class, 'GenView'])->name('gen.view');
    Route::post('/add', [GenerationController::class, 'GenAdd'])->name('gen.add');
    Route::post('/update/{id}', [GenerationController::class, 'GenUpdate'])->name('gen.update');
    Route::get('/remove/{id}', [GenerationController::class, 'GenRemove'])->name('gen.remove');
});

// Majors Mangement All Routes
Route::prefix('major')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::get('/view', [MajorController::class, 'MajorsView'])->name('majors.view');
    Route::post('/add', [MajorController::class, 'MajorAdd'])->name('major.add');
    Route::post('/update/{id}', [MajorController::class, 'MajorUpdate'])->name('major.update');
    Route::get('/remove/{id}', [MajorController::class, 'MajorRemove'])->name('major.remove');
});

// Semister Mangement All Routes
Route::prefix('semister')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::get('/view', [SemisterController::class, 'SemistersView'])->name('semisters.view');
    Route::post('/add', [SemisterController::class, 'SemisterAdd'])->name('semister.add');
    Route::post('/update/{id}', [SemisterController::class, 'SemisterUpdate'])->name('semister.update');
    Route::get('/remove/{id}', [SemisterController::class, 'SemisterRemove'])->name('semister.remove');
});

// Classrooms Mangement All Routes
Route::prefix('classroom')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::get('/view', [ClassroomsController::class, 'ClassView'])->name('classroom.view');
    Route::post('/add', [ClassroomsController::class, 'ClassAdd'])->name('classroom.add');
    Route::post('/update/{id}', [ClassroomsController::class, 'ClassUpdate'])->name('classroom.update');
    Route::get('/remove/{id}', [ClassroomsController::class, 'classRemove'])->name('classroom.remove');
});

// Subjects Mangement All Routes
Route::prefix('subject')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::get('/view', [SubjectsController::class, 'SubjectsView'])->name('subjects.view');
    Route::post('/add', [SubjectsController::class, 'SubjectAdd'])->name('subject.add');
    Route::get('/edit/{id}', [SubjectsController::class, 'SubjectEdit'])->name('subject.edit');
    Route::post('/update/{id}', [SubjectsController::class, 'SubjectUpdate'])->name('subject.update');
    Route::get('/remove/{id}', [SubjectsController::class, 'SubjectRemove'])->name('subject.remove');
});

// Assigns Mangement All Routes
Route::prefix('assign')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::get('/getSubjects', [AssignsController::class, 'GetSubjects'])->name('assign.getSubjects');
    Route::get('/view', [AssignsController::class, 'AssignsView'])->name('assigns.view');
    Route::get('/detail/{id}', [AssignsController::class, 'AssignDetail'])->name('assign.detail');
    Route::get('/add', [AssignsController::class, 'AssignAdd'])->name('assign.add');
    Route::post('/store', [AssignsController::class, 'AssignStore'])->name('assign.store');
    Route::get('/edit/{id}', [AssignsController::class, 'AssignEdit'])->name('assign.edit');
    Route::post('/update/{id}', [AssignsController::class, 'AssignUpdate'])->name('assign.update');
    Route::get('/remove/{id}', [AssignsController::class, 'AssignRemove'])->name('assign.remove');
});

// Grades Mangement All Routes
Route::prefix('grade')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::get('/getSubjects', [StudentGradesController::class, 'GetSubjects'])->name('grades.getsubjects');
    Route::get('/getStudents', [StudentGradesController::class, 'GetStudents'])->name('grades.getStudents');
    // Route::get('/filterResult', [StudentGradesController::class, 'filterResult'])->name('grades.filterResult');
    Route::get('/filterResults', [StudentGradesController::class, 'filterResults'])->name('grades.filterResults');
    Route::get('/detail/{id}', [StudentGradesController::class, 'StudentGradeDetail'])->name('grade.detail');
    Route::get('/view', [StudentGradesController::class, 'GradesView'])->name('grades.view');
    Route::get('/add', [StudentGradesController::class, 'GradesAdd'])->name('grades.add');
    Route::post('/store', [StudentGradesController::class, 'GradesStore'])->name('grades.store');
    Route::get('/edit/{id}', [StudentGradesController::class, 'GradeEdit'])->name('grade.edit');
    Route::post('/update/{id}', [StudentGradesController::class, 'GradeUpdate'])->name('grade.update');
});

// Theses Mangement All Routes
Route::prefix('theses')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::get('/view', [ThesesController::class, 'ThesesView'])->name('theses.view');
    Route::get('/getStudents', [ThesesController::class, 'getStudents'])->name('thesis.getStudents');
    Route::get('/add', [ThesesController::class, 'ThesisAdd'])->name('thesis.add');
    Route::post('/store', [ThesesController::class, 'ThesisStore'])->name('thesis.store');
    Route::get('/detail/{id}', [ThesesController::class, 'ThesisDetail'])->name('thesis.detail');
    Route::get('/edit/{id}', [ThesesController::class, 'ThesisEdit'])->name('thesis.edit');
    Route::post('/store', [ThesesController::class, 'ThesisStore'])->name('thesis.store');
    Route::post('/update/{id}', [ThesesController::class, 'ThesisUpdate'])->name('thesis.update');
});

// Theses presentation Mangement All Routes
Route::prefix('theses/presentation')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::post('/store', [ThesisPresentationController::class, 'PresentLogStore'])->name('log.store');
    Route::get('/detail/{id}', [ThesisPresentationController::class, 'PresentLogDetail'])->name('log.detail');
});

// Fees Mangement All Routes
Route::prefix('fees')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::get('/type/view', [FeeTypesController::class, 'FeeTypesView'])->name('feeTypes.view');
    Route::post('/type/store', [FeeTypesController::class, 'FeeTypeStore'])->name('feeType.store');
    Route::post('/type/update/{id}', [FeeTypesController::class, 'FeeTypeUpdate'])->name('feeType.update');
    Route::get('/type/remove/{id}', [FeeTypesController::class, 'FeeTypeRemove'])->name('feeType.remove');
    Route::get('/view', [StudentFeesController::class, 'StudentFeesView'])->name('fees.view');
    Route::get('/filterResult', [StudentFeesController::class, 'filterResult'])->name('fee.filterResult');
    Route::get('/getStudents', [StudentFeesController::class, 'getStudents'])->name('fee.getStudents');
    Route::get('/add', [StudentFeesController::class, 'StudentFeesAdd'])->name('fees.add');
    Route::post('/store', [StudentFeesController::class, 'FeesStore'])->name('fees.store');
    Route::get('/detail/{id}', [StudentFeesController::class, 'FeeDetail'])->name('fee.detail');
    Route::get('/edit/{id}', [StudentFeesController::class, 'FeeEdit'])->name('fee.edit');
    Route::post('/update/{id}', [StudentFeesController::class, 'FeeUpdate'])->name('fee.update');
});

// Reports Mangement All Routes
Route::prefix('reports')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::get('/students', [StudentsReportController::class, 'StudentsReport'])->name('students.report');
    Route::get('/students/export', [StudentsReportController::class, 'exportFilteredStudents'])->name('students.export');
    Route::get('/teachers', [TeachersReportController::class, 'TeachersReport'])->name('teachers.report');
    Route::get('/teachers/export', [TeachersReportController::class, 'exportFilteredTeachers'])->name('teachers.export');
    Route::get('/users', [UsersReportController::class, 'UsersReport'])->name('users.report');
    Route::get('/users/export', [UsersReportController::class, 'exportFilteredUsers'])->name('users.export');
    Route::get('/assigns', [AssignsReportController::class, 'AssignsReport'])->name('assigns.report');
    Route::get('/assigns/export', [AssignsReportController::class, 'exportFilteredAssigns'])->name('assigns.export');
    Route::get('/grades', [GradesReportController::class, 'GradesReport'])->name('grades.report');
    Route::get('/grades/export', [GradesReportController::class, 'exportFilteredGrades'])->name('grades.export');
    Route::get('/theses', [ThesesReportController::class, 'ThesesReport'])->name('theses.report');
    Route::get('/theses/export', [ThesesReportController::class, 'exportFilteredTheses'])->name('theses.export');
    Route::get('/fees', [FeesReportController::class, 'FeesReport'])->name('fees.report');
    Route::get('/fees/export', [FeesReportController::class, 'exportFilteredFees'])->name('fees.export');
    Route::get('/tutitions', [TutitionsReportController::class, 'TutitionsReport'])->name('tutitions.report');
    Route::get('/tutitions/export', [TutitionsReportController::class, 'exportFilteredTutitions'])->name('tutitions.export');
});


Route::prefix('tutitions')->middleware(['auth', 'user-access:admin,headUnit,coordinator,teacher,headDept'])->group(function () {
    Route::get('/view', [TutitionsController::class, 'TutitionsView'])->name('tutitions.view');
    Route::get('/add', [TutitionsController::class, 'TutitionsAdd'])->name('tutitions.add');
    Route::get('/filterResult', [TutitionsController::class, 'filterResult'])->name('tutitions.filterResult');
    Route::get('/getStudents', [TutitionsController::class, 'getStudents'])->name('tutitions.getStudents');
    Route::post('/store', [TutitionsController::class, 'TutitionsStore'])->name('tutitions.store');
    Route::get('/detail/{id}', [TutitionsController::class, 'TutitionDetail'])->name('tutition.detail');
    Route::get('/edit/{id}', [TutitionsController::class, 'TutitionEdit'])->name('tutition.edit');
    Route::post('/update/{id}', [TutitionsController::class, 'TutitionUpdate'])->name('tutition.update');
    Route::post('/installment/store', [TutitionInstallmentsController::class, 'InstallmentStore'])->name('installment.store');
});
