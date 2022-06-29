<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

class AmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amenities = [
            [
                'type' => 'Broadband Internet Access',
                'description' => '',
            ],
            [
                'type' => 'Electricity',
                'description' => '',
            ],
            [
                'type' => 'Water Supply',
                'description' => '',
            ],

            [
                'type' => 'Sui Gas',
                'description' => '',
            ],
            [
                'type' => 'Accessible by Road',
                'description' => '',
            ],
            [
                'type' => 'Electricity Backup',
                'description' => '',
            ],
            [
                'type' => 'Satellite or Cable TV Ready',
                'description' => '',
            ],
            [
                'type' => 'Nearby Mosque',
                'description' => '',
            ],
            [
                'type' => 'Lawn or Garden',
                'description' => '',
            ],
            [
                'type' => 'Nearby Schools',
                'description' => '',
            ],
            [
                'type' => 'Nearby Hospitals',
                'description' => '',
            ],
            [
                'type' => 'Nearby Shopping Malls',
                'description' => '',
            ],
            [
                'type' => 'Nearby Restaurants',
                'description' => '',
            ],
            [
                'type' => 'Nearby Public Transport Service',
                'description' => '',
            ],
            [
                'type' => 'Maintenance Staff',
                'description' => '',
            ],
            [
                'type' => 'Security Staff',
                'description' => '',
            ],
            [
                'type' => 'CCTV Security',
                'description' => '',
            ],
            [
                'type' => 'Parking Spaces',
                'description' => '',
            ],
            [
                'type' => 'Floors',
                'description' => '',
            ],
            [
                'type' => 'Dining Room',
                'description' => '',
            ],
            [
                'type' => 'Drawing Room',
                'description' => '',
            ],
            [
                'type' => 'Store Room',
                'description' => '',
            ],
            [
                'type' => 'An Open Floor Plan',
                'description' => 'A top amenity in luxury homes is an open floor plan. This feature gives the interior of the home an expansive feel. Open floor plans also make it easier for families to spend time together.',
            ],
            [
                'type' => 'Gourmet Kitchens',
                'description' => 'Gourmet kitchens with wine cellars and warming drawers are an amenity that you’re sure to enjoy. These features allow you to take entertaining to a new amazing level. Your guests will appreciate the variety of wine that you’ll have on hand. They’ll also love that you’re able to serve them warm food easily.',
            ],
            [
                'type' => 'A Swimming Pool',
                'description' => 'A popular amenity in most luxury homes is a swimming pool. The pools included in luxury homes in Las Vegas are often infinity pools that feature hot tubs and expansive patios.',
            ],
            [
                'type' => 'A Home Gym',
                'description' => 'A top luxury home amenity is a home gym. When you have one of these, you’ll find it easier to stay healthy and fit. The best thing about a home gym is that you can customize it according to your workout routine and preferences.',
            ],
            [
                'type' => 'Tennis Court',
                'description' => 'If you play tennis, then you’ll love having your home court. With a court on your property, you can practice as much as you have time for. Plus, you know your court will stay open even if the local courts are closed.',
            ],
            [
                'type' => 'Walk-In Closet',
                'description' => 'One thing that makes a luxury home so luxurious is the space. This includes huge walk-in closets. You’ll appreciate having room for all of your apparel pieces, including those thick bulky coats and shoes.',
            ],
            [
                'type' => 'Wood Finishes',
                'description' => 'Exotic woods enhance the interior design of a home. However, these kinds of woods are pricier than others, which makes them a luxury amenity.',
            ],
            [
                'type' => 'A Library',
                'description' => 'A great luxury amenity is a library. You’ll love having a place to display your favorite books. Stylish and magical, home libraries are an amenity that will give your home an especially high-end feel.',
            ],
            [
                'type' => 'Home Theater',
                'description' => 'A home theater is an amenity that you’re sure to use frequently. Install a large television or a projection screen to enjoy movies at home as much as you do at the public theater.',
            ],
            [
                'type' => 'Game Room',
                'description' => 'With families spending more time at home in 2020, many people have enhanced their luxury homes with entertainment amenities. A game room will inspire you to embrace your inner child. If you have kids, then invest in a variety of games that will appeal to every age. This can include classic arcade games, modern video games, and even a pool table.',
            ],
        ];

        foreach ($amenities as $amenity) {
            Amenity::create([
                'type' => $amenity['type'],
                'description' => $amenity['description'],
            ]);
        }
    }
}
