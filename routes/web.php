<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\GradingSystemController;
use App\Http\Controllers\MobilityController;
use App\Http\Controllers\CollageController;
use App\Http\Controllers\OurGradeController;
use App\Http\Controllers\OurSubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectMobilityController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/', [AdminController::class, 'index'])->name('home');

    //////// Admin /////////
Route::middleware('admin')->group( function () {
    Route::get('new/user', [AdminController::class,'create'])->name('addNewUserForm');
    Route::post('new/user/store', [AdminController::class,'store'])->name('addNewUser');
    Route::patch('mobility/confirmation/{id}', [ConfirmationController::class, 'update'])->name('confirmation');
    Route::get('student/{id}/subjectAccepted', [ConfirmationController::class, 'subjectAccepted'])->name('subjectAccepted');
    Route::get('student/{id}/subjectRejected', [ConfirmationController::class, 'subjectRejected'])->name('subjectRejected');
});

    //////// Doctor /////////
Route::middleware('doctor')->group( function () {
    Route::get('all/mobilities', [MobilityController::class, 'all'])->name('allMobilities');
});

Route::middleware(['auth'])->group( function (){
    Route::get('student/mobility/{id}', [SubjectMobilityController::class,'edit'])->name('studentMobility');
    Route::patch('student/subject/{id}/approve', [MobilityController::class, 'approve'])->name('approveMobility');
    Route::patch('student/subject/{id}/disapprove', [MobilityController::class, 'disapprove'])->name('disapproveMobility');
});


    //////// Teacher /////////
Route::middleware('teacher')->group( function () {
/// //    OUR SUBJECTS
    Route::get('ourSubject', [OurSubjectController::class,'all'])->name('showOurSubjects');
    Route::post('ourSubject/store', [OurSubjectController::class,'store'])->name('addNewOurSubject');
    Route::get('ourSubject/{id}/edit/', [OurSubjectController::class,'edit'])->name('editOurSubject');
    Route::patch('ourSubject/{id}/update', [OurSubjectController::class,'update'])->name('updateOurSubject');
    Route::delete('ourSubject/{id}/delete', [OurSubjectController::class,'destroy'])->name('deleteOurSubject');

//    Subjects
    Route::post('student/subjects/store', [SubjectController::class,'store'])->name('addNewSubject');
    Route::get('subject/{id}/edit/', [SubjectController::class,'edit'])->name('editSubject');
    Route::patch('subject/{id}/update', [SubjectController::class,'update'])->name('updateSubject');
    Route::delete('subject/{id}/delete', [SubjectController::class,'destroy'])->name('deleteSubject');


//Collages
    Route::post('collage/store', [CollageController::class,'store'])->name('addNewCollage');

///// Students
    Route::post('student/store', [StudentController::class,'store'])->name('addNewStudent');
    Route::get('students', [StudentController::class,'index'])->name('showStudent');
    Route::get('student/edit/{id}', [StudentController::class,'edit'])->name('editStudent');
    Route::patch('student/update/{id}', [StudentController::class,'update'])->name('updateStudent');
    Route::delete('student/delete/{id}', [StudentController::class,'destroy'])->name('removeStudent');

    Route::get('Grading/collage/{id}', [GradingSystemController::class,'index'])->name('gradingSystem');
    Route::post('Grading/collage/store', [GradingSystemController::class,'store'])->name('addNewCollageGrade');
    Route::get('Grading/collage/grade/{id}', [GradingSystemController::class,'edit'])->name('editCollageGrade');
    Route::patch('Grading/collage/grade/{id}/update', [GradingSystemController::class,'update'])->name('updateCollageGrade');

    Route::get('ourGrades/', [OurGradeController::class,'index'])->name('OurGrade');
    Route::post('ourGrade/store', [OurGradeController::class,'store'])->name('addGrade');
    Route::get('ourGrade/{id}/edit', [OurGradeController::class,'edit'])->name('editGrade');
    Route::patch('ourGrade/{id}/update', [OurGradeController::class,'update'])->name('updateGrade');

    Route::get('collage/subject/{id}', [SubjectMobilityController::class,'all'])->name('addSubjects');
    Route::post('student/mobility/store', [SubjectMobilityController::class,'store'])->name('addStudentSubjects');
    Route::post('student/addMobility/{id}', [SubjectMobilityController::class,'update'])->name('addStudentMobility');
    Route::delete('student/mobility/{id}/delete', [SubjectMobilityController::class,'destroy'])->name('deleteStudentMobility');
});
