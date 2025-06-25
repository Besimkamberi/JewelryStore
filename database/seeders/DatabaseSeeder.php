<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create roles
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        $clientRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'client']);

        // Create admin user
        $admin = \App\Models\User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole($adminRole);

        // Create two client users
        $client1 = \App\Models\User::firstOrCreate(
            ['email' => 'client1@example.com'],
            [
                'name' => 'Client One',
                'password' => bcrypt('password'),
            ]
        );
        $client1->assignRole($clientRole);

        $client2 = \App\Models\User::firstOrCreate(
            ['email' => 'client2@example.com'],
            [
                'name' => 'Client Two',
                'password' => bcrypt('password'),
            ]
        );
        $client2->assignRole($clientRole);

        // Seed 20 jewelry products for admin
        $jewelryProducts = [
            [
                'name' => 'Diamond Engagement Ring',
                'qty' => 5,
                'price' => 2999.99,
                'description' => 'A stunning diamond engagement ring with a 1.5ct center stone set in 18k white gold.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Gold Hoop Earrings',
                'qty' => 10,
                'price' => 249.99,
                'description' => 'Classic 14k gold hoop earrings, perfect for everyday elegance.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Sapphire Pendant Necklace',
                'qty' => 7,
                'price' => 799.00,
                'description' => 'A delicate necklace featuring a deep blue sapphire pendant and diamond accents.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Pearl Stud Earrings',
                'qty' => 12,
                'price' => 159.50,
                'description' => 'Elegant freshwater pearl stud earrings with sterling silver posts.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Emerald Tennis Bracelet',
                'qty' => 3,
                'price' => 1200.00,
                'description' => 'A luxurious tennis bracelet set with vibrant emeralds and white gold.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Ruby Heart Pendant',
                'qty' => 6,
                'price' => 950.00,
                'description' => 'A romantic heart-shaped ruby pendant on a fine gold chain.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Platinum Wedding Band',
                'qty' => 8,
                'price' => 499.99,
                'description' => 'A timeless platinum wedding band with a comfort fit design.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Amethyst Cocktail Ring',
                'qty' => 4,
                'price' => 320.00,
                'description' => 'A bold cocktail ring featuring a large purple amethyst stone.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Diamond Stud Earrings',
                'qty' => 9,
                'price' => 899.99,
                'description' => 'Brilliant round diamond stud earrings in 14k white gold.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Rose Gold Bangle',
                'qty' => 11,
                'price' => 275.00,
                'description' => 'A chic rose gold bangle bracelet with a polished finish.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Citrine Drop Earrings',
                'qty' => 5,
                'price' => 210.00,
                'description' => 'Sunshine yellow citrine drop earrings in sterling silver.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Opal Pendant Necklace',
                'qty' => 6,
                'price' => 340.00,
                'description' => 'A mesmerizing opal pendant necklace with a halo of diamonds.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => "Men's Onyx Signet Ring",
                'qty' => 4,
                'price' => 199.99,
                'description' => "A bold men's signet ring with a polished onyx centerpiece.",
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Turquoise Bead Bracelet',
                'qty' => 10,
                'price' => 89.99,
                'description' => 'A boho-chic bracelet made with genuine turquoise beads.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Garnet Halo Earrings',
                'qty' => 7,
                'price' => 185.00,
                'description' => 'Deep red garnet earrings surrounded by a halo of white sapphires.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Aquamarine Stackable Ring',
                'qty' => 8,
                'price' => 145.00,
                'description' => 'A dainty stackable ring with a sparkling aquamarine stone.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Morganite Cushion Ring',
                'qty' => 3,
                'price' => 670.00,
                'description' => 'A romantic morganite cushion-cut ring in rose gold.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Peridot Stud Earrings',
                'qty' => 9,
                'price' => 120.00,
                'description' => 'Vivid green peridot stud earrings in 14k gold.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Tanzanite Drop Necklace',
                'qty' => 5,
                'price' => 980.00,
                'description' => 'A rare tanzanite drop necklace with a diamond accent.',
                'image' => 'no-image.jpg',
            ],
            [
                'name' => 'Black Diamond Bracelet',
                'qty' => 2,
                'price' => 1500.00,
                'description' => 'A dramatic bracelet featuring black diamonds in a modern setting.',
                'image' => 'no-image.jpg',
            ],
        ];
        foreach ($jewelryProducts as $product) {
            \App\Models\Product::create(array_merge($product, ['user_id' => $admin->id]));
        }
    }
}
