<?php

namespace Database\Seeders;

use App\Models\Tour;
use App\Models\Travel;
use App\Models\User;
use App\Enums\UserRole;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedTravels();
        $this->seedTours();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => UserRole::ADMIN
        ]);

        User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'password' => bcrypt('password'),
            'role' => UserRole::EDITOR
        ]);
    }

    private function seedTravels(): void
    {
        $travels = [
            [
                "id" => "d408be33-aa6a-4c73-a2c8-58a70ab2ba4d",
                "slug" => "jordan-360",
                "name" => "Jordan 360°",
                "description" => "Jordan 360°: the perfect tour to discover the suggestive Wadi Rum desert, the ancient beauty of Petra, and much more.\n\nVisiting Jordan is one of the most fascinating things that everyone has to do once in their life.You are probably wondering \"Why?\". Well, that's easy: because this country keeps several passions! During our tour in Jordan, you can range from well-preserved archaeological masterpieces to trekkings, from natural wonders excursions to ancient historical sites, from camels trek in the desert to some time to relax.\nDo not forget to float in the Dead Sea and enjoy mineral-rich mud baths, it's one of the most peculiar attractions. It will be a tour like no other: this beautiful country leaves a memorable impression on everyone.",
                "numberOfDays" => 8,
                "moods" => [
                    "nature" => 80,
                    "relax" => 20,
                    "history" => 90,
                    "culture" => 30,
                    "party" => 10
                ]
            ],
            [
                "id" => "4f4bd032-e7d4-402a-bdf6-aaf6be240d53",
                "slug" => "iceland-hunting-northern-lights",
                "name" => "Iceland: hunting for the Northern Lights",
                "description" => "Why visit Iceland in winter? Because it is between October and March that this land offers the spectacle of the Northern Lights, one of the most incredible and magical natural phenomena in the world, visible only near the earth's two magnetic poles. Come with us on WeRoad to explore this land of ice and fire, full of contrasts and natural variety, where the energy of waterfalls and geysers meets the peace of the fjords... And when the ribbons of light of the aurora borealis twinkle in the sky before our enchanted eyes, we will know that we have found what we were looking for.",
                "numberOfDays" => 8,
                "moods" => [
                    "nature" => 100,
                    "relax" => 30,
                    "history" => 10,
                    "culture" => 20,
                    "party" => 10
                ]
            ],
            [
                "id" => "cbf304ae-a335-43fa-9e56-811612dcb601",
                "slug" => "united-arab-emirates",
                "name" => "United Arab Emirates: from Dubai to Abu Dhabi",
                "description" => "At Dubai and Abu Dhabi everything is huge and majestic: here futuristic engineering works and modern infrastructures meet historical districts, local souks (typical bazars), desert and the sea. In this tour we’ll discover Dubai, where we’ll get on top of the highest skyscraper ever built, the Burj Khalifa. We’ll then take a walk at the Dubai Mall, the biggest mall on the planet, and we’ll spend a night in the desert, with the sight of the skyline on the horizon keeping us company. Then, it will be Abu Dhabi’s tourn! Sheik Zayed’s Grand Mosque’s white marble awaits for us to remain stoked in front of its wonderfulness, and the sea will invade us with peacefulness. UAE are all to discover, we’ll just get a taste of it, but we guarantee you’ll get quite the idea!",
                "numberOfDays" => 7,
                "moods" => [
                    "nature" => 30,
                    "relax" => 40,
                    "history" => 20,
                    "culture" => 80,
                    "party" => 70
                ]
            ],
            [
                "id" => "e7b49c8c-5260-4e4f-9f9c-fa5ad5cc31d0",
                "slug" => "safari-in-tanzania",
                "name" => "Safari in Tanzania",
                "description" => "Experience the adventure of a lifetime with our Safari in Tanzania tour. Witness the breathtaking wildlife of the Serengeti National Park, explore the majestic Ngorongoro Crater, and immerse yourself in the rich culture of the Maasai tribe. From the vast plains of the Serengeti to the stunning landscapes of Tarangire National Park, this safari will leave you with unforgettable memories.",
                "numberOfDays" => 10,
                "moods" => [
                    "nature" => 90,
                    "relax" => 10,
                    "history" => 20,
                    "culture" => 70,
                    "party" => 5
                ]
            ],
            [
                "id" => "54b7fc63-3fb2-479b-90d4-c2d90af7553c",
                "slug" => "explore-thailand",
                "name" => "Explore Thailand",
                "description" => "Discover the beauty of Thailand on our Explore Thailand tour. Visit the bustling streets of Bangkok, explore the ancient temples of Ayutthaya, and relax on the pristine beaches of Phuket. Experience the vibrant culture, delicious cuisine, and stunning landscapes that make Thailand a must-visit destination for travelers.",
                "numberOfDays" => 12,
                "moods" => [
                    "nature" => 60,
                    "relax" => 80,
                    "history" => 40,
                    "culture" => 90,
                    "party" => 60
                ]
            ],
            [
                "id" => "a8d6c514-37d3-4c02-aab9-b615034da0e7",
                "slug" => "expedition-to-the-amazon-rainforest",
                "name" => "Expedition to the Amazon Rainforest",
                "description" => "Embark on an unforgettable journey with our Expedition to the Amazon Rainforest. Explore the diverse ecosystems of the Amazon, encounter exotic wildlife, and learn about the indigenous cultures that call this region home. From thrilling jungle treks to peaceful river cruises, this expedition offers a unique opportunity to experience the wonders of the world's largest rainforest.",
                "numberOfDays" => 14,
                "moods" => [
                    "nature" => 100,
                    "relax" => 30,
                    "history" => 10,
                    "culture" => 50,
                    "party" => 5
                ]
            ],
            [
                "id" => "f27d9975-9e56-4869-86a1-5e6221b2e4d7",
                "slug" => "trekking-in-the-himalayas",
                "name" => "Trekking in the Himalayas",
                "description" => "Embark on an epic journey with our Trekking in the Himalayas tour. Explore the breathtaking mountain landscapes, witness ancient monasteries nestled in the hills, and challenge yourself with high-altitude trekking adventures. From the majestic peaks of Everest to the serene valleys of Langtang, this trekking expedition offers an unforgettable experience for adventure enthusiasts.",
                "numberOfDays" => 14,
                "moods" => [
                    "nature" => 100,
                    "relax" => 10,
                    "history" => 30,
                    "culture" => 40,
                    "party" => 5
                ]
            ],
            [
                "id" => "3b5afbbe-6703-4c21-b905-bc441a53fd54",
                "slug" => "cultural-immersion-in-japan",
                "name" => "Cultural Immersion in Japan",
                "description" => "Immerse yourself in the rich culture and history of Japan with our Cultural Immersion in Japan tour. Experience traditional tea ceremonies, explore ancient temples and shrines, and indulge in delicious Japanese cuisine. From the bustling streets of Tokyo to the serene landscapes of Kyoto, this cultural journey will leave you with a deep appreciation for the beauty and complexity of Japanese culture.",
                "numberOfDays" => 10,
                "moods" => [
                    "nature" => 20,
                    "relax" => 60,
                    "history" => 90,
                    "culture" => 100,
                    "party" => 20
                ]
            ],
            [
                "id" => "da8b51de-b9f3-4c14-88ff-d319c56fd6e0",
                "slug" => "wine-tasting-in-tuscany",
                "name" => "Wine Tasting in Tuscany",
                "description" => "Discover the beauty of Tuscany and indulge in the finest wines with our Wine Tasting in Tuscany tour. Explore picturesque vineyards, visit historic wineries, and savor the flavors of Chianti, Brunello, and other renowned Tuscan wines. From rolling hills dotted with cypress trees to charming medieval villages, this wine tour offers a perfect blend of culture, history, and gastronomy.",
                "numberOfDays" => 7,
                "moods" => [
                    "nature" => 40,
                    "relax" => 80,
                    "history" => 60,
                    "culture" => 70,
                    "party" => 30
                ]
            ],
            [
                "id" => "9c9927c5-c3f0-4bfc-8ae4-8e863c6d1029",
                "slug" => "adventure-in-new-zealand",
                "name" => "Adventure in New Zealand",
                "description" => "Experience the thrill of adventure with our Adventure in New Zealand tour. Explore the stunning landscapes of Middle-earth, bungee jump off towering cliffs, and kayak through crystal-clear waters. From hiking in the majestic Fiordland National Park to exploring the geothermal wonders of Rotorua, this adventure tour offers an adrenaline-fueled journey through the Land of the Long White Cloud.",
                "numberOfDays" => 10,
                "moods" => [
                    "nature" => 90,
                    "relax" => 20,
                    "history" => 30,
                    "culture" => 40,
                    "party" => 50
                ]
            ],
            [
                "id" => "6279b356-77f6-456d-b0d2-fd68a5b857c7",
                "slug" => "sailing-the-greek-islands",
                "name" => "Sailing the Greek Islands",
                "description" => "Set sail on a magical journey through the Greek Islands with our Sailing the Greek Islands tour. Explore secluded beaches, swim in crystal-clear waters, and immerse yourself in the rich history and mythology of ancient Greece. From the iconic whitewashed buildings of Santorini to the vibrant nightlife of Mykonos, this sailing adventure offers an unforgettable experience in the Aegean Sea.",
                "numberOfDays" => 7,
                "moods" => [
                    "nature" => 70,
                    "relax" => 90,
                    "history" => 80,
                    "culture" => 60,
                    "party" => 70
                ]
            ]
        ];

        foreach ($travels as $travel) {
            $travel['moods'] = json_encode($travel['moods']);
            Travel::create($travel);
        }
    }

    private function seedTours(): void
    {
        $tours = [
            [
                "id" => "2a0edc99-c9fe-4206-8da5-413586667a21",
                "travelId" => "d408be33-aa6a-4c73-a2c8-58a70ab2ba4d",
                "name" => "ITJOR20211101",
                "startingDate" => "2021-11-01",
                "endingDate" => "2021-11-09",
                "price" => 199900
            ],
            [
                "id" => "7f0ff8cc-6b19-407e-9915-279ad76c0b5c",
                "travelId" => "d408be33-aa6a-4c73-a2c8-58a70ab2ba4d",
                "name" => "ITJOR20211112",
                "startingDate" => "2021-11-12",
                "endingDate" => "2021-11-20",
                "price" => 189900
            ],
            [
                "id" => "0be966b8-0a9b-4220-b9b2-e49d2cc0c2ab",
                "travelId" => "d408be33-aa6a-4c73-a2c8-58a70ab2ba4d",
                "name" => "ITJOR20211125",
                "startingDate" => "2021-11-25",
                "endingDate" => "2021-12-03",
                "price" => 214900
            ],
            [
                "id" => "94682e59-cbbd-44f5-861f-fb06c0ce18da",
                "travelId" => "4f4bd032-e7d4-402a-bdf6-aaf6be240d53",
                "name" => "ITICE20211101",
                "startingDate" => "2021-11-01",
                "endingDate" => "2021-11-08",
                "price" => 199900
            ],
            [
                "id" => "90155d92-01e5-4c4b-a5a8-e24011fa8418",
                "travelId" => "cbf304ae-a335-43fa-9e56-811612dcb601",
                "name" => "ITARA20211221",
                "startingDate" => "2021-12-21",
                "endingDate" => "2021-12-28",
                "price" => 189900
            ],
            [
                "id" => "9cefe1bc-eeb7-4d6d-b572-8a7aea2688d1",
                "travelId" => "cbf304ae-a335-43fa-9e56-811612dcb601",
                "name" => "ITARA20211221",
                "startingDate" => "2022-01-03",
                "endingDate" => "2022-01-10",
                "price" => 149900
            ]
        ];

        foreach ($tours as $tour) {
            Tour::create($tour);
        }
    }
}
