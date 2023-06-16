<?php

namespace App\Http\Controllers\admission;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\EducationInfo;
use App\Models\Role;
use App\Models\Student;
use App\Models\StudentAdmitInfo;
use App\Models\StudentAdvanceAmount;
use App\Models\StudentInfo;
use App\Models\TemporaryStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdmissionStudentController extends Controller
{
    public function create(TemporaryStudent $temporaryStudent)
    {
        if ($temporaryStudent->status) {
            return view('admission.student.create', [
                'data' => $temporaryStudent
            ]);
        }
        fmassage('Warning', "this student is Already Created", 'warning');
        return redirect()->back();
    }
    public function list(Request $request)
    {
        $this->pageData = pageDataCheck($request);
        $role_id = Role::where('name', 'student')->first()->id;
        $datas = User::where('role_id', $role_id)->where('status', 1)->orderBy('created_at', 'desc')->paginate($this->pageData);
        return view('admission.student.list', [
            'datas' => $datas,
            'pageData' => $this->pageData
        ]);
    }
    public function store(Request $request, TemporaryStudent $temporaryStudent)
    {
        $validatedData = $request->validate([
            'father_name' => 'required|string',
            'mother_name' => 'required|string',
            // 'present_address' => 'string',
            // 'permanent_address' => 'string',
            'email' => 'email|max:255',
            'phone' => 'required|max:20|min:8',
            'emergency_phone' => 'max:20|min:8',
            // 'emergency_phone_name' => 'string',
            'gender_id' => 'required',
            // 'blood_group_id'=>'required',
            'role' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        // dd($request->all());
        $father_name = $request->father_name;
        $mother_name = $request->mother_name;
        $present_address = $request->present_address;
        $permanent_address = $request->permanent_address;
        $email = $request->email;
        $phone = $request->phone;
        $emergency_phone = $request->emergency_phone;
        $emergency_phone_name = $request->emergency_phone_name;
        $role = $request->role;
        $role_id = Role::where('name', $role)->first()->id;
        $image = $request->image;
        $gender_id = $request->gender_id;
        $blood_group_id = $request->blood_group_id;
        // datas from temoporary table
        $name = $temporaryStudent->name;
        $advance_payment = $temporaryStudent->advance_payment;
        $temporary_id = $temporaryStudent->temporary_id;

        $password = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT); // password genarate
        $department_id = str_pad($temporaryStudent->batch->department_id, 2, '0', STR_PAD_LEFT);
        $batch_number = str_pad($temporaryStudent->batch->batch_number, 3, '0', STR_PAD_LEFT);
        $student_number = $temporaryStudent->batch->total_student + 1;
        $student_number = str_pad($student_number, 3, '0', STR_PAD_LEFT);
        $currentYear = date("y");
        $login_id = $currentYear . $department_id . $batch_number . $student_number;

        $user_id = null;
        $student_id = null;
        $student_info_id = null;
        $student_admit_info_id = null;
        // add user and store the id
        $user = new User();
        $image = storeFile($request, '/users/images');
        if ($image['file']) { // If the image was successfully stored, update the $user model's image property
            $user->name = $name;
            $user->login_id = $login_id;
            $user->password = Hash::make($password);
            $user->gender_id = $gender_id;
            $user->blood_group_id = $blood_group_id;
            $user->image = $image['fileName'];
            $user->role_id = $role_id;
            $user->department_id = $department_id;
            $user->permission_id = 0;
            // $user->status = 1; // not active , it will be active after adding education info
            $user->created_by = Auth::user()->id;
            $user->save();
            if ($user) {
                $user_id = $user->id; // storing user id
                // add student and store the id
                $student = new Student();
                $student->user_id = $user_id;
                $student->admit_batch_id = $temporaryStudent->batch->id;
                $student->active_batch_id = $temporaryStudent->batch->id;
                $student->temporary_id = $temporary_id;
                $student->save();
                if ($student) {
                    $student_id = $student->id; // storing student id
                    // add student info and store the id
                    $student_info = new StudentInfo();
                    $student_info->student_id = $student_id;
                    $student_info->father_name = $father_name;
                    $student_info->mother_name = $mother_name;
                    $student_info->present_address = $present_address;
                    $student_info->permanent_address = $permanent_address;
                    $student_info->email = $email;
                    $student_info->phone = $phone;
                    $student_info->emergency_phone = $emergency_phone;
                    $student_info->emergency_phone_name = $emergency_phone_name;
                    $student_info->save();
                    if ($student_info) {
                        $student_info_id = $student_info->id; // storing student_info id
                        // add student_admit_info and store the id
                        $batch_payment_info = $temporaryStudent->batch->batchPaymentInfo;
                        $student_admit_info = new StudentAdmitInfo();
                        $student_admit_info->student_id = $student_id;
                        $student_admit_info->duration_year = $batch_payment_info->duration_year;
                        $student_admit_info->duration_semester = $batch_payment_info->duration_semester;
                        $student_admit_info->credit = $batch_payment_info->credit;
                        $student_admit_info->admission_fee = $batch_payment_info->admission_fee;
                        $student_admit_info->session_fee = $batch_payment_info->session_fee;
                        $student_admit_info->per_credit_fee = $batch_payment_info->per_credit_fee;
                        $student_admit_info->total_fee = $batch_payment_info->total_fee;
                        $student_admit_info->save();
                        if ($student_admit_info) {
                            $student_admit_info_id = $student_admit_info->id; // storing student_admit_info id
                            // add student_advance_amount and store the id
                            $student_advance_amount = new StudentAdvanceAmount();
                            $student_advance_amount->student_id = $student_id;
                            $student_advance_amount->amount = $advance_payment;
                            $student_advance_amount->save();
                            if ($student_advance_amount) {
                                // increase batch total student
                                $batch = Batch::find($temporaryStudent->batch->id);
                                $batch->total_student = $batch->total_student + 1;
                                $batch->save();
                                $temporaryStudent->status = 0;
                                $temporaryStudent->save();
                                fmassage('Success', 'Student created Successfully', 'success');
                                return redirect()->route('admission.student.list');
                            } else {
                                $user = User::find($user_id);
                                $user->delete();
                                $student = Student::find($student_id);
                                $student->delete();
                                $student_info = StudentInfo::find($student_info_id);
                                $student_info->delete();
                                $student_admit_info = StudentAdmitInfo::find($student_admit_info_id);
                                $student_admit_info->delete();
                                deleteFile($image, '/users/images');
                                fmassage('Fail', "Student created Fail,Something went wrong with 'student_advance_amount'", 'error');
                                return redirect()->back();
                            }
                        } else {
                            $user = User::find($user_id);
                            $user->delete();
                            $student = Student::find($student_id);
                            $student->delete();
                            $student_info = StudentInfo::find($student_info_id);
                            $student_info->delete();
                            deleteFile($image, '/users/images');
                            fmassage('Fail', "Student created Fail,Something went wrong with 'student_admit_info'", 'error');
                            return redirect()->back();
                        }
                    } else {
                        $user = User::find($user_id);
                        $user->delete();
                        $student = Student::find($student_id);
                        $student->delete();
                        deleteFile($image, '/users/images');
                        fmassage('Fail', "Student created Fail,Something went wrong with 'student_info'", 'error');
                        return redirect()->back();
                    }
                } else {
                    $user = User::find($user_id);
                    $user->delete();
                    deleteFile($image, '/users/images');
                    fmassage('Fail', "Student created Fail,Something went wrong with 'student'", 'error');
                    return redirect()->back();
                }
            } else {
                deleteFile($image, '/users/images');
                fmassage('Fail', "Student created Fail,Something went wrong with 'user'", 'error');
                return redirect()->back();
            }
        }
    }
    public function education_create(User $user)
    {
        return view("admission.student.education", [
            'data' => $user
        ]);
    }
    public function education_store(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'board_id' => 'required',
            'result' => 'required',
            'year' => 'required',
            'session' => 'required',
            'pdf' => 'required|mimes:pdf|max:2048',
        ]);
        $education_info = new EducationInfo();
        $education_info->user_id = $user->id;
        $education_info->title = $request->title;
        $education_info->board_id = $request->board_id;
        $education_info->result = $request->result;
        $education_info->year = $request->year;
        $education_info->session = $request->session;
        $file = storeFile($request, '/users/education');
        if ($file) {
            $education_info->pdf = $file['fileName'];
            $education_info->save();
            $user->education = true;
            $user->save();
            fmassage('success', 'Education info saved', 'success');
            return redirect()->back();
        }
        fmassage('Fail', 'Education info not saved', 'error');
        return redirect()->back();
    }
}
