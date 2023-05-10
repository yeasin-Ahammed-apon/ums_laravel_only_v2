<?php
//flash massage

use App\Models\EmployeesNotification;
use Illuminate\Support\Facades\Auth;

if (! function_exists('fmassage')) {
    function fmassage($title = '',$text = '',$icon =''){
        return session()->flash('alert',[
            'title' => $title,
            'text' => $text,
            'icon' => $icon,
        ]);
    }
}
// blade form validation error message showing
if (! function_exists('validationError')) {
    function validationError($name,$message){
        if ($message->has($name)) {
            return '<div class="text-danger">' . $message->first($name) . '</div>';
        }
        return '';
    }
}
//employees notifications notification
if (! function_exists('Enotifications')) {
    // dd(Auth::user()->role->name);
    function Enotifications($action,$description){
        $notification = new EmployeesNotification();
        $notification->user_id = Auth::user()->id;
        $notification->role = Auth::user()->role->name;
        $notification->action = $action;
        $notification->description = $description;
        $notification->save();

    }
}
if (! function_exists('dataEncode')) {
    function dataEncode($data){
        return json_encode($data);
    }
}
if (! function_exists('dataDecode')) {
    function dataDecode($data){
        return json_decode($data , true);
    }
}
if (! function_exists('superAdminSidebarOption')) {
    function superAdminSidebarOption(){
        $superAdminSidebarOption = [
            [
                'title' => 'Dashboard',
                'icon' => 'fas fa-th',
                'route' => 'superAdmin.dashboard',
                'enabled' => "1",
            ],
            [
                'title' => 'Profile',
                'icon' => 'fas fa-th',
                'route' => 'superAdmin.profile',
                'enabled' => "1",
            ],
            [
                'title' => 'Notification',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'superAdmin',
                        'route' => 'superAdmin.notification.superAdmin',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Admin',
                        'route' => 'superAdmin.notification.admin',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'hod',
                        'route' => 'superAdmin.notification.hod',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'cod',
                        'route' => 'superAdmin.notification.cod',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'teacher',
                        'route' => 'superAdmin.notification.teacher',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'account',
                        'route' => 'superAdmin.notification.account',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'admission',
                        'route' => 'superAdmin.notification.admission',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Admin',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'Admin List',
                        'route' => 'superAdmin.admin.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Admin Create',
                        'route' => 'superAdmin.admin.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Teacher',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'Teacher List',
                        'route' => 'superAdmin.teacher.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Teacher',
                        'route' => 'superAdmin.teacher.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Hod',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'Hod List',
                        'route' => 'superAdmin.hod.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Hod',
                        'route' => 'superAdmin.hod.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Cod',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'Cod List',
                        'route' => 'superAdmin.cod.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Cod',
                        'route' => 'superAdmin.cod.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Account',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'Account List',
                        'route' => 'superAdmin.account.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Account',
                        'route' => 'superAdmin.account.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Admission',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'Admission List',
                        'route' => 'superAdmin.admission.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Admission',
                        'route' => 'superAdmin.admission.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Student',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'Student List',
                        'route' => 'superAdmin.student.list',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],

        ];
        return json_encode($superAdminSidebarOption);
    }
}
if (! function_exists('adminSidebarOption')) {
    function adminSidebarOption(){
        $adminSidebarOption = [
            [
                'title' => 'Dashboard',
                'icon' => 'fas fa-th',
                'route' => 'admin.dashboard',
                'enabled' => "1",
            ],
            [
                'title' => 'Profile',
                'icon' => 'fas fa-th',
                'route' => 'admin.profile',
                'enabled' => "1",
            ],
            [
                'title' => 'Notification',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'admin',
                        'route' => 'admin.notification.admin',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'hod',
                        'route' => 'admin.notification.hod',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'cod',
                        'route' => 'admin.notification.cod',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'teacher',
                        'route' => 'admin.notification.teacher',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'account',
                        'route' => 'admin.notification.account',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'admission',
                        'route' => 'admin.notification.admission',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Teacher',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'Teacher List',
                        'route' => 'admin.teacher.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Teacher',
                        'route' => 'admin.teacher.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Hod',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'Hod List',
                        'route' => 'admin.hod.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Hod',
                        'route' => 'admin.hod.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Cod',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'Cod List',
                        'route' => 'admin.cod.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Cod',
                        'route' => 'admin.cod.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Account',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'Account List',
                        'route' => 'admin.account.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Account',
                        'route' => 'admin.account.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Admission',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'Admission List',
                        'route' => 'admin.admission.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Admission',
                        'route' => 'admin.admission.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Student',
                'icon' => 'fas fa-tachometer-alt',
                'sub_menu' => [
                    [
                        'title' => 'Student List',
                        'route' => 'admin.student.list',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],

        ];
        return json_encode($adminSidebarOption);
    }
}


