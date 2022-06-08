<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "administrator@mail.test";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = Hash::make("secret");
        $administrator->avatar = "belum-ada-gambar.png";

        $administrator->save();

        $this->command->info("User admin berhasil diinsert");
    }
}
