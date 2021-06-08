<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GradingSystemController;
use App\Http\Controllers\MobilityController;
use App\Http\Controllers\CollageController;
use App\Http\Controllers\OurSubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectMobilityController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [AdminController::class, 'index'])->name('home');


    //////// Admin /////////
Route::middleware('admin')->group( function ()
{
    Route::get('new/user', [AdminController::class,'create'])->name('addNewUserForm');
    Route::post('new/user/store', [AdminController::class,'store'])->name('addNewUser');
});



    //////// Doctor /////////
Route::middleware('doctor')->group( function () {
    Route::patch('student/subject/{id}/approve', [MobilityController::class, 'approve'])->name('approveMobility');
    Route::patch('student/subject/{id}/disapprove', [MobilityController::class, 'disapprove'])->name('disapproveMobility');
    Route::get('all/mobilities', [MobilityController::class, 'all'])->name('allMobilities');

});


    //////// Teacher /////////
Route::middleware('teacher')->group( function () {

/// //    OUR SUBJECTS
    Route::get('ourSubject', [OurSubjectController::class,'all'])->name('showOurSubjects');
    Route::post('ourSubject/store', [OurSubjectController::class,'store'])->name('addNewOurSubject');
    Route::get('ourSubject/{id}/edit/', [OurSubjectController::class,'edit'])->name('editOurSubject');
    Route::patch('ourSubject/{id}/update', [OurSubjectController::class,'update'])->name('updateOurSubject');
    Route::delete('ourSubject/{id}/delete', [OurSubjectController::class,'destroy'])->name('deleteOurSubject');


//Collages
    Route::post('collage/store', [CollageController::class,'store'])->name('addNewCollage');
    Route::get('Grading/collage/{id}', [GradingSystemController::class,'index'])->name('gradingSystem');
    Route::post('Grading/collage/store', [GradingSystemController::class,'store'])->name('addNewCollageGrade');
    Route::get('Grading/collage/grade/{id}', [GradingSystemController::class,'edit'])->name('editCollageGrade');
    Route::patch('Grading/collage/grade/{id}/update', [GradingSystemController::class,'update'])->name('updateCollageGrade');


///// Students
    Route::post('student/store', [StudentController::class,'store'])->name('addNewStudent');
    Route::get('students', [StudentController::class,'index'])->name('showStudent');
    Route::get('student/edit/{id}', [StudentController::class,'edit'])->name('editStudent');
    Route::patch('student/update/{id}', [StudentController::class,'update'])->name('updateStudent');
    Route::delete('student/delete/{id}', [StudentController::class,'destroy'])->name('removeStudent');

    Route::get('student/mobility/{id}', [SubjectMobilityController::class,'show'])->name('studentMobility');
    Route::post('student/mobility/store', [SubjectMobilityController::class,'store'])->name('addStudentSubjects');

    Route::post('student/addMobility/{id}', [SubjectMobilityController::class,'update'])->name('addStudentMobility');

    Route::delete('student/mobility/{id}/delete', [SubjectMobilityController::class,'destroy'])->name('deleteStudentMobility');


    Route::get('student/subjects/{id}', [SubjectController::class,'all'])->name('addSubjects');
    Route::post('student/subjects/store', [SubjectController::class,'store'])->name('addNewSubjectsss');

});
