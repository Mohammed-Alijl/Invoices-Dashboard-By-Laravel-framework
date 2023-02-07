<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        $permissions = [
            //sidebar links
            'invoices',
            'invoices-list',
            'paid-invoices-list',
            'partially-paid-invoices-list',
            'unpaid-invoices-list',
            'deleted-invoices-list',
            'reports',
            'invoices-reports',
            'customer-reports',
            'users',
            'users-list',
            'users-permissions',
            'settings',
            'products',
            'sections',

            //invoices
            'add-invoice',
            'invoice-details',
            'payment-change-status',
            'edit-invoice',
            'soft-delete-invoice',
            'print-invoice',
            'display-payment-status',

            //attachments
            'add-attachment',
            'delete-attachment',
            'display-attachments',

            //deleted invoices
            'recover-invoice',
            'delete-invoice',

            //users
            'add-user',
            'edit-user',
            'delete-user',

            //permissions
            'display-permission',
            'add-permission',
            'edit-permission',
            'delete-permission',

            //products
            'add-product',
            'edit-product',
            'delete-product',

            //sections
            'add-section',
            'edit-section',
            'delete-section',
            'notifications',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
