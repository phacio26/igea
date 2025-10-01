<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display homepage
     */
    public function index()
    {
        $page = Page::where('slug', 'home')->first();
        $gallery = Gallery::where('is_active', true)->orderBy('order')->take(8)->get();
        
        // Define default content
        $defaultContent = [
            'hero' => [
                'title' => 'WELCOME TO',
                'subtitle' => 'Inclusive Green Energy Africa',
                'description' => 'Eco-friendly for a better planet'
            ],
            'why_choose_title' => 'Why Choose Us?',
            'stats' => [
                'products_sold' => '1,286+',
                'products_sold_text' => 'Affordable products sold',
                'people_reached' => '5000+',
                'people_reached_text' => 'People reached',
                'eco_friendly' => '100%',
                'eco_friendly_text' => 'Eco-friendly products'
            ],
            'products_title' => 'Why Go For Our Products and Services?',
            'products' => [
                [
                    'title' => 'Accessibility',
                    'description' => 'Solar lanterns, portable panels, community microgrids provide affordable and sustainable energy access in remote areas.',
                    'icon' => 'bi-universal-access-circle'
                ],
                [
                    'title' => 'Affordability',
                    'description' => 'Economical solar panels harnessing sunlight for sustainable energy, lowering costs and promoting renewable power adoption.',
                    'icon' => 'bi-cash-coin'
                ],
                [
                    'title' => 'Inclusivity',
                    'description' => 'Equitable solar tech: Affordable, accessible, culturally sensitive, empowering all communities for sustainable energy transition.',
                    'icon' => 'bi-people-fill'
                ]
            ],
            'gallery_title' => 'Our Work in Action',
            'gallery_description' => 'See examples of our projects and the impact we\'re making.'
        ];

        return view('pages.home', compact('page', 'gallery', 'defaultContent'));
    }
}