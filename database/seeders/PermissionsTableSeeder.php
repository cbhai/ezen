<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'auth_profile_edit',
            ],
            [
                'id'    => 2,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 3,
                'title' => 'permission_create',
            ],
            [
                'id'    => 4,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 5,
                'title' => 'permission_show',
            ],
            [
                'id'    => 6,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 7,
                'title' => 'permission_access',
            ],
            [
                'id'    => 8,
                'title' => 'role_create',
            ],
            [
                'id'    => 9,
                'title' => 'role_edit',
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
            ],
            [
                'id'    => 11,
                'title' => 'role_delete',
            ],
            [
                'id'    => 12,
                'title' => 'role_access',
            ],
            [
                'id'    => 13,
                'title' => 'user_create',
            ],
            [
                'id'    => 14,
                'title' => 'user_edit',
            ],
            [
                'id'    => 15,
                'title' => 'user_show',
            ],
            [
                'id'    => 16,
                'title' => 'user_delete',
            ],
            [
                'id'    => 17,
                'title' => 'user_access',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 19,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_edit',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 23,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 24,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 25,
                'title' => 'master_room_create',
            ],
            [
                'id'    => 26,
                'title' => 'master_room_edit',
            ],
            [
                'id'    => 27,
                'title' => 'master_room_show',
            ],
            [
                'id'    => 28,
                'title' => 'master_room_delete',
            ],
            [
                'id'    => 29,
                'title' => 'master_room_access',
            ],
            [
                'id'    => 30,
                'title' => 'master_workitem_create',
            ],
            [
                'id'    => 31,
                'title' => 'master_workitem_edit',
            ],
            [
                'id'    => 32,
                'title' => 'master_workitem_show',
            ],
            [
                'id'    => 33,
                'title' => 'master_workitem_delete',
            ],
            [
                'id'    => 34,
                'title' => 'master_workitem_access',
            ],
            [
                'id'    => 35,
                'title' => 'my_business_access',
            ],
            [
                'id'    => 36,
                'title' => 'business_profile_create',
            ],
            [
                'id'    => 37,
                'title' => 'business_profile_edit',
            ],
            [
                'id'    => 38,
                'title' => 'business_profile_show',
            ],
            [
                'id'    => 39,
                'title' => 'business_profile_delete',
            ],
            [
                'id'    => 40,
                'title' => 'business_profile_access',
            ],
            [
                'id'    => 41,
                'title' => 'branding_create',
            ],
            [
                'id'    => 42,
                'title' => 'branding_edit',
            ],
            [
                'id'    => 43,
                'title' => 'branding_show',
            ],
            [
                'id'    => 44,
                'title' => 'branding_delete',
            ],
            [
                'id'    => 45,
                'title' => 'branding_access',
            ],
            [
                'id'    => 46,
                'title' => 'term_create',
            ],
            [
                'id'    => 47,
                'title' => 'term_edit',
            ],
            [
                'id'    => 48,
                'title' => 'term_show',
            ],
            [
                'id'    => 49,
                'title' => 'term_delete',
            ],
            [
                'id'    => 50,
                'title' => 'term_access',
            ],
            [
                'id'    => 51,
                'title' => 'customer_create',
            ],
            [
                'id'    => 52,
                'title' => 'customer_edit',
            ],
            [
                'id'    => 53,
                'title' => 'customer_show',
            ],
            [
                'id'    => 54,
                'title' => 'customer_delete',
            ],
            [
                'id'    => 55,
                'title' => 'customer_access',
            ],
            [
                'id'    => 56,
                'title' => 'estimate_create',
            ],
            [
                'id'    => 57,
                'title' => 'estimate_edit',
            ],
            [
                'id'    => 58,
                'title' => 'estimate_show',
            ],
            [
                'id'    => 59,
                'title' => 'estimate_delete',
            ],
            [
                'id'    => 60,
                'title' => 'estimate_access',
            ],
            [
                'id'    => 61,
                'title' => 'room_create',
            ],
            [
                'id'    => 62,
                'title' => 'room_edit',
            ],
            [
                'id'    => 63,
                'title' => 'room_show',
            ],
            [
                'id'    => 64,
                'title' => 'room_delete',
            ],
            [
                'id'    => 65,
                'title' => 'room_access',
            ],
            [
                'id'    => 66,
                'title' => 'workitem_create',
            ],
            [
                'id'    => 67,
                'title' => 'workitem_edit',
            ],
            [
                'id'    => 68,
                'title' => 'workitem_show',
            ],
            [
                'id'    => 69,
                'title' => 'workitem_delete',
            ],
            [
                'id'    => 70,
                'title' => 'workitem_access',
            ],
            [
                'id'    => 71,
                'title' => 'estimate_detail_create',
            ],
            [
                'id'    => 72,
                'title' => 'estimate_detail_edit',
            ],
            [
                'id'    => 73,
                'title' => 'estimate_detail_show',
            ],
            [
                'id'    => 74,
                'title' => 'estimate_detail_delete',
            ],
            [
                'id'    => 75,
                'title' => 'estimate_detail_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
