<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin Seeder
        $user = new User();
        $user->name = 'Mohammed Alajel';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('123456789');
        $user->image = 'default.jpg';
        $user->status = '1';
        $user->roles_name = ['super admin'];
        $user->save();

        $role = Role::create(['name' => 'super admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
