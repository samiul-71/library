<?php

use Database\TruncateTable;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncateMultiple([config('access.users_table'), 'social_logins']);

        //Add the master administrator, user id of 1
        $users = [
            [
                'first_name'        => 'Administrator',
                'last_name'         => 'User',
                'mobile'            => '01710123456',
                'email'             => 'admin@admin.com',
                'password'          => bcrypt('@admin.com'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'first_name'        => 'Executive',
                'last_name'         => 'User',
                'mobile'            => '01710123457',
                'email'             => 'executive@executive.com',
                'password'          => bcrypt('@executive.com'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'first_name'        => 'Moderator',
                'last_name'         => 'User',
                'mobile'            => '01710123458',
                'email'             => 'moderator@moderator.com',
                'password'          => bcrypt('@moderator.com'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'first_name'        => 'Editor',
                'last_name'         => 'User',
                'mobile'            => '01710123410',
                'email'             => 'editor@editor.com',
                'password'          => bcrypt('@editor.com'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'first_name'        => 'Operator',
                'last_name'         => 'User',
                'mobile'            => '01710123411',
                'email'             => 'operator@operator.com',
                'password'          => bcrypt('@operator.com'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'first_name'        => 'User',
                'last_name'         => 'Default',
                'mobile'            => '01710123412',
                'email'             => 'user@user.com',
                'password'          => bcrypt('@user.com'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        DB::table(config('access.users_table'))->insert($users);

        $this->enableForeignKeys();
    }
}
