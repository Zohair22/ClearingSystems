<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Modules\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentController extends Controller
{
 private StudentRepository $studentRepository;

 public function __construct()
 {
  $this->studentRepository = new StudentRepository();
 }

 public function index(Student $student)
 {
  return new StudentResource($this->studentRepository->all($student));
 }



}
