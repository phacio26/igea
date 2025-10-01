<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'content' => json_encode([
                    'hero' => [
                        'title' => 'Inclusive Green Energy Africa',
                        'subtitle' => 'Empowering Communities Through Sustainable Energy',
                        'description' => 'Providing innovative solar energy solutions to drive economic growth and environmental sustainability across Africa.'
                    ],
                    'why_choose_title' => 'Why Choose Inclusive Green Energy Africa?',
                    'stats' => [
                        'products_sold' => '500+',
                        'products_sold_text' => 'Products Sold',
                        'people_reached' => '10,000+',
                        'people_reached_text' => 'People Reached',
                        'eco_friendly' => '100%',
                        'eco_friendly_text' => 'Eco Friendly'
                    ],
                    'products_title' => 'Our Products & Services',
                    'products' => [
                        [
                            'title' => 'Solar Home Systems',
                            'description' => 'Complete solar solutions for residential use, providing reliable electricity for lighting, charging, and small appliances.',
                            'icon' => 'bi-house-check'
                        ],
                        [
                            'title' => 'Solar Water Pumping',
                            'description' => 'Efficient solar-powered water pumping systems for irrigation and domestic water supply.',
                            'icon' => 'bi-droplet'
                        ],
                        [
                            'title' => 'Energy Consulting',
                            'description' => 'Expert advice and consultation services for sustainable energy projects and implementations.',
                            'icon' => 'bi-lightbulb'
                        ]
                    ],
                    'gallery_title' => 'Our Work in Action',
                    'gallery_description' => 'See how we\'re transforming communities through sustainable energy solutions.'
                ]),
                'meta_title' => 'Inclusive Green Energy Africa - Sustainable Energy Solutions',
                'meta_description' => 'Providing innovative solar energy solutions to drive economic growth and environmental sustainability across Africa.',
                'is_active' => true
            ],
            [
                'title' => 'About',
                'slug' => 'about',
                'content' => json_encode([
                    'hero' => [
                        'title' => 'About Inclusive Green Energy Africa',
                        'subtitle' => 'Driving Sustainable Energy Solutions Across Africa'
                    ],
                    'sections' => [
                        'who_we_are' => [
                            'title' => 'Who We Are',
                            'content' => 'Inclusive Green Energy Africa is a pioneering organization dedicated to providing sustainable energy solutions that empower communities across Africa. We believe in the transformative power of renewable energy to drive economic growth and improve quality of life.'
                        ],
                        'vision' => [
                            'title' => 'Our Vision',
                            'content' => 'To be the leading provider of inclusive and sustainable energy solutions across Africa, empowering communities and driving environmental conservation.'
                        ],
                        'mission' => [
                            'title' => 'Our Mission',
                            'content' => 'To provide accessible, affordable, and sustainable energy solutions that transform lives, empower communities, and protect our environment through innovative solar technologies.'
                        ],
                        'keys' => [
                            'title' => 'Our Key Focus Areas',
                            'items' => [
                                'Solar Home Systems for rural electrification',
                                'Solar water pumping for agriculture and domestic use',
                                'Energy efficiency consulting',
                                'Community empowerment through renewable energy'
                            ]
                        ],
                        'overview' => [
                            'title' => 'Company Overview',
                            'content' => 'Founded with a passion for sustainable development, Inclusive Green Energy Africa combines technical expertise with deep community engagement to deliver energy solutions that make a real difference in people\'s lives.'
                        ]
                    ]
                ]),
                'meta_title' => 'About Us - Inclusive Green Energy Africa',
                'meta_description' => 'Learn about our mission, vision, and commitment to providing sustainable energy solutions across Africa.',
                'is_active' => true
            ],
            [
                'title' => 'Products',
                'slug' => 'products',
                'content' => json_encode([
                    'hero' => [
                        'title' => 'Our Products & Services',
                        'subtitle' => 'Sustainable Energy Solutions for Every Need'
                    ],
                    'sections' => [
                        'solar_home' => [
                            'title' => 'Solar Home Systems',
                            'content' => 'Complete solar solutions designed for residential use, providing reliable electricity for lighting, mobile charging, radio, television, and small appliances. Our systems are perfect for both urban and rural households.',
                            'images' => []
                        ],
                        'solar_water' => [
                            'title' => 'Solar Water Pumping Systems',
                            'content' => 'Efficient solar-powered water pumping solutions for irrigation, livestock watering, and domestic water supply. Reduce your energy costs while ensuring reliable water access.',
                            'images' => []
                        ]
                    ]
                ]),
                'meta_title' => 'Our Products - Solar Energy Solutions',
                'meta_description' => 'Discover our range of solar home systems and solar water pumping solutions for residential and agricultural use.',
                'is_active' => true
            ]
        ];

        foreach ($pages as $pageData) {
            // Use updateOrCreate to avoid duplicates
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }
    }
}