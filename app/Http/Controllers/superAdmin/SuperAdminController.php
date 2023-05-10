<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\Permission;

class SuperAdminController extends Controller
{
    private $data;
    private $datas;
    public function dashboard()
    {
        $sidebar = [
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
                'enabled' => "0",
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
        // $sidebar = json_encode($sidebar);
        //  $data =  new Permission();
        //  $data->user_id = 1;
        //  $data->sidebar = $sidebar;
        //  $data->save();
        // $sidebar = json_decode($sidebar, "1");
        return view('superAdmin.dashboard.dashboard');
    }


}
