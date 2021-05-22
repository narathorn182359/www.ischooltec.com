<?php

namespace App\Http\Controllers\Masteradmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class ManageRoleUserController extends Controller
{


        public function index(){


            

            Role::create(['name' => 'masteradmin']);
            Role::create(['name' => 'adminschool']);
            Role::create(['name' => 'parent']);
            Role::create(['name' => 'teacher']);
            $user = User::find(1);
            $user->assignRole('masteradmin');
        }

        


}
