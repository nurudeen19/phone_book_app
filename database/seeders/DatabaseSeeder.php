<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PhoneBook;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $contacts=[
            [
                'fname' => 'Steve',
                'lname' => 'Jobs',
                'phone' => '222-555-6575'
            ],
            [
                'fname' => 'Eric',
                'lname' => 'Elliot',
                'phone' => '220-454-6754'
            ],
            [
                'fname' => 'Fred',
                'lname' => 'Allen',
                'phone' => '210-657-9886'
            ],
            [
                'fname' => 'Steve',
                'lname' => 'Wozniak',
                'phone' => '343-675-8786'
            ],
            [
                'fname' => 'Bill',
                'lname' => 'Gates',
                'phone' => '343-645-9688'
            ],
        ];

        foreach($contacts as $c){
            PhoneBook::create($c);
        }
    }
}
