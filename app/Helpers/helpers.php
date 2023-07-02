<?php
//flash massage

use App\Models\EmployeesNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


if (!function_exists('queryAppend')) {
    // this query is appending to pagination mainly
    function queryAppend($request,$datas,$querys)
    {
        foreach ($querys as  $value) {
            $datas =  $datas->appends([
                $value => $request->query($value),
            ]);
        }
        return $datas;
    }
}
if (!function_exists('storeFile')) {
    function storeFile($request,$path)
    {
        if ($request->file('image')) $file = $request->file('image');
        if ($request->file('pdf')) $file = $request->file('pdf');
        $uuid = Str::uuid()->toString();
        $fileName = time() .$uuid.'-'.$file->getClientOriginalName();
        $filePath = public_path($path);
        $file->move($filePath, $fileName);
        return ["file" => $file, "fileName" => $fileName];
    }
}
if (!function_exists('deleteFile')) {
    function deleteFile($file,$path){
        $filePath = public_path($path);
        unlink($filePath . $file['imageName']);
    }
}
if (!function_exists('ordinalFormat')) {
    function ordinalFormat($number) {
        $suffix = 'th';
        if (($number % 100 < 11) || ($number % 100 > 13)) {
            switch ($number % 10) {
                case 1:
                    $suffix = 'st';
                    break;
                case 2:
                    $suffix = 'nd';
                    break;
                case 3:
                    $suffix = 'rd';
                    break;
            }
        }
        return $number . $suffix;
    }

}
if (!function_exists('dateFormat')) {
    function dateFormat($date)
    {
        return Carbon::parse($date)->format('M d, Y');
    }
}
if (!function_exists('dateTimeFormat')) {
    function dateTimeFormat($dateTime)
    {
        return Carbon::parse($dateTime)->format('M d, Y \a\t h\h:i\m:s\s A');
    }
}
if (!function_exists('random_rgb_color')) {
    function random_rgb_color()
    {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
        return "rgb($r, $g, $b)";
    }
}
if (!function_exists('fmassage')) {
    function fmassage($title = '', $text = '', $icon = '')
    {
        return session()->flash('alert', [
            'title' => $title,
            'text' => $text,
            'icon' => $icon,
        ]);
    }
}
// blade form validation error message showing
if (!function_exists('validationError')) {
    function validationError($name, $message)
    {
        if ($message->has($name)) {
            return '
            <div class="text-danger">' . $message->first($name) . '</div>';
        }
        return '';
    }
}
//employees notifications notification
if (!function_exists('Enotifications')) {
    // dd(Auth::user()->role->name);
    function Enotifications($action, $description)
    {
        $notification = new EmployeesNotification();
        $notification->user_id = Auth::user()->id;
        $notification->role = Auth::user()->role->name;
        $notification->action = $action;
        $notification->description = $description;
        $notification->save();
    }
}
if (!function_exists('dataEncode')) {
    function dataEncode($data)
    {
        return json_encode($data);
    }
}
if (!function_exists('dataDecode')) {
    function dataDecode($data)
    {
        return json_decode($data, true);
    }
}
if (!function_exists('pageDataCheck')) {
    function pageDataCheck($request)
    {
        // dd($request->all());
        if ($request->pageData) return $pageData = intval($request->pageData);
        else return $pageData = 10;
    }
}
if (!function_exists('LogError')) {
    function LogError($ex)
    {
        return Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
    }
}
if (!function_exists('footerOption')) {
    function footerOption($role){
            return $options = [
                [
                    'label' => 'Home',
                    'route' => $role.'.dashboard',
                    'icon' => 'fas fa-home', // Font Awesome icon class
                ],
                [
                    'label' => 'Profile',
                    'route' => $role.'.profile',
                    'icon' => 'fas fa-info-circle', // Font Awesome icon class
                ],
                [
                    'label' => 'Messages',
                    'route' => 'message',
                    'icon' => 'fas fa-star', // Font Awesome icon class
                ],
                // Add more options as needed
            ];
    }
}

if (!function_exists('superAdminSidebarOption')) {
    function superAdminSidebarOption()
    {
        $superAdminSidebarOption = [
            [
                'title' => 'Inventory',
                'icon' => 'fas fa-user',
                'sub_active_route' => 'superAdmin.inventory*',
                'sub_menu' => [
                    [
                        'title' => ' Categories list',
                        'route' => 'superAdmin.inventory.categorie.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => ' Categories with Item list',
                        'route' => 'superAdmin.inventory.categorie.item',
                        'enabled' => "1",
                    ],
                    [
                        'title' => ' Categories Create',
                        'route' => 'superAdmin.inventory.categorie.create',
                        'enabled' => "1",
                    ],
                    [
                        'title' => ' Item list',
                        'route' => 'superAdmin.inventory.item.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => ' Item Create',
                        'route' => 'superAdmin.inventory.item.create',
                        'enabled' => "1",
                    ],
                    [
                        'title' => ' Stock In',
                        'route' => 'superAdmin.inventory.item.stock_in',
                        'enabled' => "1",
                    ],
                    [
                        'title' => ' Stock In History',
                        'route' => 'superAdmin.inventory.item.stock_in_history',
                        'enabled' => "1",
                    ],
                    [
                        'title' => ' Stock Out',
                        'route' => 'superAdmin.inventory.item.stock_out_user',
                        'enabled' => "1",
                    ],
                    [
                        'title' => ' Stock Out History',
                        'route' => 'superAdmin.inventory.item.stock_out_history',
                        'enabled' => "1",
                    ],
                    [
                        'title' => ' Stock Return',
                        'route' => 'superAdmin.inventory.item.stock_return_user',
                        'enabled' => "1",
                    ],
                    [
                        'title' => ' Stock Return History',
                        'route' => 'superAdmin.inventory.item.stock_return_history',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'User Stock in info',
                        'route' => 'superAdmin.inventory.item.user_stock_in',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'User Stock out info',
                        'route' => 'superAdmin.inventory.item.user_stock_out',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'User Stock Return info',
                        'route' => 'superAdmin.inventory.item.user_stock_return',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Hod Department Assign',
                'icon' => 'fas fa-tachometer-alt',
                'sub_active_route' => 'hod.department.assign*',
                'sub_menu' => [
                    [
                        'title' => 'Hod Department List',
                        'route' => 'hod.department.assign.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Assign Hod > Department',
                        'route' => 'hod.department.assign.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Dashboard',
                'icon' => 'fas fa-th',
                'route' => 'superAdmin.dashboard',
                'enabled' => "1",
            ],
            [
                'title' => 'Profile',
                'icon' => 'fas fa-address-card',
                'route' => 'superAdmin.profile',
                'enabled' => "1",
            ],
            [
                'title' => 'Notification',
                'icon' => 'fas fa-envelope-open-text',
                'sub_active_route' => 'superAdmin.notification*',
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
                'icon' => 'fas fa-user',
                'sub_active_route' => 'superAdmin.admin*',
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
                'icon' => 'fas fa-chalkboard-teacher',
                'sub_active_route' => 'superAdmin.teacher*',
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
                'icon' => 'fas fa-user',
                'sub_active_route' => 'superAdmin.hod*',
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
                'icon' => 'fas fa-handshake',
                'sub_active_route' => 'superAdmin.cod*',
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
                'icon' => 'fas fa-user',
                'sub_active_route' => 'superAdmin.account*',
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
                'icon' => 'fas fa-user',
                'sub_active_route' => 'superAdmin.admission*',
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
                'title' => 'Faculty',
                'icon' => 'fas fa-tachometer-alt',
                'sub_active_route' => 'faculty*',
                'sub_menu' => [
                    [
                        'title' => 'Faculty List',
                        'route' => 'faculty.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Faculty',
                        'route' => 'faculty.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'program',
                'icon' => 'fas fa-tachometer-alt',
                'sub_active_route' => 'program*',
                'sub_menu' => [
                    [
                        'title' => 'program List',
                        'route' => 'program.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add program',
                        'route' => 'program.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'department',
                'icon' => 'far fa-building',
                'sub_active_route' => 'department*',
                'sub_menu' => [
                    [
                        'title' => 'department List',
                        'route' => 'department.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add department',
                        'route' => 'department.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Student',
                'icon' => 'fas fa-tachometer-alt',
                'sub_active_route' => 'superAdmin.student',
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
if (!function_exists('adminSidebarOption')) {
    function adminSidebarOption()
    {
        $adminSidebarOption = [
            [
                'title' => 'Hod Department Assign',
                'icon' => 'fas fa-tachometer-alt',
                'sub_active_route' => 'hod.department.assign*',
                'sub_menu' => [
                    [
                        'title' => 'Hod Department List',
                        'route' => 'hod.department.assign.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Assign Hod > Department',
                        'route' => 'hod.department.assign.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Dashboard',
                'icon' => 'fas fa-th',
                'route' => 'admin.dashboard',
                'enabled' => "1",
            ],
            [
                'title' => 'Profile',
                'icon' => 'fas fa-address-card',
                'route' => 'admin.profile',
                'enabled' => "1",
            ],
            [
                'title' => 'Notification',
                'icon' => 'fas fa-envelope-open-text',
                'sub_active_route' => 'admin.notification*',
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
                'icon' => 'fas fa-chalkboard-teacher',
                'sub_active_route' => 'admin.teacher*',
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
                'icon' => 'fas fa-user',
                'sub_active_route' => 'admin.hod*',
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
                'icon' => 'fas fa-handshake',
                'sub_active_route' => 'admin.cod*',
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
                'icon' => 'fas fa-user',
                'sub_active_route' => 'admin.account*',
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
                'icon' => 'fas fa-user',
                'sub_active_route' => 'admin.admission*',
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
                'title' => 'Faculty',
                'icon' => 'fas fa-tachometer-alt',
                'sub_active_route' => 'faculty*',
                'sub_menu' => [
                    [
                        'title' => 'Faculty List',
                        'route' => 'faculty.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Faculty',
                        'route' => 'faculty.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'program',
                'icon' => 'fas fa-tachometer-alt',
                'sub_active_route' => 'program*',
                'sub_menu' => [
                    [
                        'title' => 'program List',
                        'route' => 'program.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add program',
                        'route' => 'program.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'department',
                'icon' => 'far fa-building',
                'sub_active_route' => 'department*',
                'sub_menu' => [
                    [
                        'title' => 'department List',
                        'route' => 'department.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add department',
                        'route' => 'department.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Student',
                'icon' => 'fas fa-tachometer-alt',
                'sub_active_route' => 'admin.student*',
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
if (!function_exists('hrSidebarOption')) {
    function hrSidebarOption()
    {
        $hrSidebarOption = [
            [
                'title' => 'Dashboard',
                'icon' => 'fas fa-th',
                'route' => 'hr.dashboard',
                'enabled' => "1",
            ],
            [
                'title' => 'Profile',
                'icon' => 'fas fa-address-card',
                'route' => 'hr.profile',
                'enabled' => "1",
            ],
            [
                'title' => 'Teacher',
                'icon' => 'fas fa-chalkboard-teacher',
                'sub_active_route' => 'hr.teacher*',
                'sub_menu' => [
                    [
                        'title' => 'Teacher List',
                        'route' => 'hr.teacher.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Teacher',
                        'route' => 'hr.teacher.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Hod',
                'icon' => 'fas fa-user',
                'sub_active_route' => 'hr.hod*',
                'sub_menu' => [
                    [
                        'title' => 'Hod List',
                        'route' => 'hr.hod.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Hod',
                        'route' => 'hr.hod.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Cod',
                'icon' => 'fas fa-handshake',
                'sub_active_route' => 'hr.cod*',
                'sub_menu' => [
                    [
                        'title' => 'Cod List',
                        'route' => 'hr.cod.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Cod',
                        'route' => 'hr.cod.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Account',
                'icon' => 'fas fa-user',
                'sub_active_route' => 'hr.account*',
                'sub_menu' => [
                    [
                        'title' => 'Account List',
                        'route' => 'hr.account.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Account',
                        'route' => 'hr.account.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Admission',
                'icon' => 'fas fa-user',
                'sub_active_route' => 'hr.admission*',
                'sub_menu' => [
                    [
                        'title' => 'Admission List',
                        'route' => 'hr.admission.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Admission',
                        'route' => 'hr.admission.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],

        ];
        return json_encode($hrSidebarOption);
    }
}
if (!function_exists('hodSidebarOption')) {
    function hodSidebarOption()
    {
        $hodSidebarOption = [
            [
                'title' => 'Dashboard',
                'icon' => 'fas fa-th',
                'route' => 'hod.dashboard',
                'enabled' => "1",
            ],
            [
                'title' => 'Profile',
                'icon' => 'fas fa-address-card',
                'route' => 'hod.profile',
                'enabled' => "1",
            ],
            [
                'title' => 'Departments',
                'icon' => 'far fa-building',
                'sub_active_route' => 'hod.department*',
                'sub_menu' => [
                    [
                        'title' => 'Departments List',
                        'route' => 'hod.department',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Teacher',
                        'route' => 'hod.teacher.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Notification',
                'icon' => 'fas fa-envelope-open-text',
                'sub_active_route' => 'hod.notification*',
                'sub_menu' => [
                    [
                        'title' => 'hod',
                        'route' => 'hod.notification.hod',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'cod',
                        'route' => 'hod.notification.cod',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'teacher',
                        'route' => 'hod.notification.teacher',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Teacher',
                'icon' => 'fas fa-chalkboard-teacher',
                'sub_active_route' => 'hod.teacher*',
                'sub_menu' => [
                    [
                        'title' => 'Teacher List',
                        'route' => 'hod.teacher.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Teacher',
                        'route' => 'hod.teacher.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],
            [
                'title' => 'Cod',
                'icon' => 'fas fa-handshake',
                'sub_active_route' => 'hod.cod*',
                'sub_menu' => [
                    [
                        'title' => 'Cod List',
                        'route' => 'hod.cod.index',
                        'enabled' => "1",
                    ],
                    [
                        'title' => 'Add Cod',
                        'route' => 'hod.cod.create',
                        'enabled' => "1",
                    ],
                ],
                'enabled' => "1",
            ],

        ];
        return json_encode($hodSidebarOption);
    }
}

if (!function_exists('accountSidebarOption')) {
    function accountSidebarOption()
    {
        $accountSidebarOption = [
            [
                'title' => 'Dashboard',
                'icon' => 'fas fa-th',
                'route' => 'account.dashboard',
                'enabled' => "1",
            ],
            [
                'title' => 'Profile',
                'icon' => 'fas fa-address-card',
                'route' => 'account.profile',
                'enabled' => "1",
            ],
            [
                'title' => 'Temporary Student list',
                'icon' => 'fas fa-address-card',
                'route' => 'account.temporary.payment.list',
                'enabled' => "1",
            ],
            [
                'title' => 'Temporary payment History',
                'icon' => 'fas fa-address-card',
                'route' => 'account.temporary.payment.history',
                'enabled' => "1",
            ],
        ];
        return json_encode($accountSidebarOption);
    }
}
if (!function_exists('admissionSidebarOption')) {
    function admissionSidebarOption()
    {
        $admissionSidebarOption = [
            [
                'title' => 'Dashboard',
                'icon' => 'fas fa-th',
                'route' => 'admission.dashboard',
                'enabled' => "1",
            ],
            [
                'title' => 'Profile',
                'icon' => 'fas fa-address-card',
                'route' => 'admission.profile',
                'enabled' => "1",
            ],
            [
                'title' => 'Temporary Student List.',
                'icon' => 'fas fa-th-list',
                'route' => 'admission.temporaryStudent.list',
                'enabled' => "1",
            ],
            [
                'title' => 'Temporary Payment History.',
                'icon' => 'fas fa-th-list',
                'route' => 'admission.temporaryStudent.history',
                'enabled' => "1",
            ],
            [
                'title' => 'Admission Open list',
                'icon' => 'fas fa-th-list',
                'route' => 'admission.batch.list',
                'enabled' => "1",
            ],
        ];
        return json_encode($admissionSidebarOption);
    }
}
