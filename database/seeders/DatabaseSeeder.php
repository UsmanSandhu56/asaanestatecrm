<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AmenitiesTableSeeder::class);
        $this->call(TransactionTypesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubCategoriesTableSeeder::class);
        $this->call(AreaUnitsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(PropertyDetailsTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(PropertiesTableSeeder::class);
        $this->call(AmenityPropertyTableSeeder::class);
        $this->call(PropertyRequirementDetailsTableSeeder::class);
        $this->call(PropertyRequirementsTableSeeder::class);
        $this->call(AmenityPropertyRequirementTableSeeder::class);
        $this->call(StatusReasonsTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
    }
}
