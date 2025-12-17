<?php

use App\Keyboard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeyboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keyboards')->insert([
            'name'          => 'Keychron Q1 V2 Special Edition',
            'brand'         => 'Keychron',
            'switch_type'   => 'Gateron Phantom Brown',
            'layout'        => '75%',
            'connection'    => 'wired',
            'hot_swappable' => true,
            'price'         => 3200000,
            'stock'         => 25,
            'release_date'  => '2023-08-15',
            'description'   => 'Keyboard aluminium premium dengan gasket mount, knob volume, dan dukungan VIA untuk kustomisasi.',
            'image_url'     => 'https://example.com/images/q1v2.jpg',
            'buy_link'      => 'https://example.com/buy/q1v2',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        factory(Keyboard::class, 40)->create();
    }
}
