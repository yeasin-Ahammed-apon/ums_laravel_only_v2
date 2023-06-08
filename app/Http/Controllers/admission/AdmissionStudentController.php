<?php

namespace App\Http\Controllers\admission;

use App\Http\Controllers\Controller;
use App\Models\TemporaryStudent;
use Illuminate\Http\Request;

class AdmissionStudentController extends Controller
{
    public function create(TemporaryStudent $temporaryStudent)
    {
        return view('admission.student.create',[
            'data'=> $temporaryStudent
        ]);
    }
}
