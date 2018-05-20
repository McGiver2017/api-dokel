<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Account;
use App\Enterprise;
use App\Identification;
use App\Office;
use App\Serie;
use App\type_affectation_igv;
use App\Invoice;
use App\detail_invoice;
use App\motive_note;
use App\note;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        /*Account::truncate();
        Enterprise::truncate();
        Identification::truncate();
        Office::truncate();
        Serie::truncate();
        Invoice::truncate();
        detail_invoice::truncate();
        motive_note::truncate();
        note::truncate();-*/

        $countUsers = 20;
        $countAccount = 20;
        $countEnterprise = 100;
        $countIdentification = 3;
        $countTypeDocuemnt = 3;
        $countOffice = 100;
        $countSerie = 3;
        $countInvoice = 500;
        $countDetInvoice = 1500;

        factory(User::class, $countUsers)->create();
        /*factory(Serie::class, $countSerie)->create();
        factory(Identification::class, $countIdentification)->create();
        factory(type_affectation_igv::class, $countTypeDocuemnt)->create();
        factory(Enterprise::class, $countEnterprise)->create();
        factory(Account::class, $countAccount)->create();
        factory(Office::class, $countOffice)->create();
        factory(Invoice::class, $countInvoice)->create();
        factory(detail_invoice::class, $countInvoice)->create();
        factory(motive_note::class, $countSerie)->create();
        factory(note::class, 100)->create();*/
    }
}
