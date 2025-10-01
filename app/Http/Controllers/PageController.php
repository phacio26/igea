<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\TeamMember;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    /**
     * Display about page
     */
    public function about()
    {
        $page = Page::where('slug', 'about')->first();
        
        $defaultContent = [
            'hero' => [
                'title' => 'About Inclusive Green Energy Africa',
                'subtitle' => 'Learn about our mission, vision, and commitment to sustainable energy solutions for all.'
            ],
            'sections' => [
                'who_we_are' => [
                    'title' => 'Who We Are',
                    'content' => 'INCLUSIVE GREEN ENERGY AFRICA is a Malawian enterprise providing electrical and renewable energy systems solutions for homes, trade, and industry. Depending on customer needs, the enterprise offers energy systems sizing, installation, end-user training, system warranty agreements, and comprehensive after-sales services.'
                ],
                'vision' => [
                    'title' => 'Our Vision',
                    'content' => 'To inspire for a Malawi where all people have access to renewable energy technologies that enable them to lead dignified lives, while protecting the environment for current and future generations.'
                ],
                'mission' => [
                    'title' => 'Our Mission',
                    'content' => 'To become the number one leading renewable energy company in Malawi and rank among the top 10 renewable energy companies in sub-Saharan Africa. We aim to distribute quality renewable energy technologies, targeting both rural and urban areas to eradicate energy poverty.'
                ],
                'keys' => [
                    'title' => 'Our Keys for Development',
                    'items' => [
                        'Desire for Excellence',
                        'Trust and Confidence Build-up',
                        'Innovation',
                        'Transparency',
                        'Teamwork'
                    ]
                ],
                'overview' => [
                    'title' => 'Company Overview',
                    'content' => 'Inclusive Green Energy Africa (IGEA), founded in 2022, is a renewable energy enterprise dedicated to providing affordable and sustainable energy solutions to underserved communities across sub-Saharan Africa. The company specializes in clean energy technologies such as solar home systems, biogas solutions, and solar water pumps, targeting households, schools, businesses, and agricultural communities.'
                ]
            ]
        ];

        return view('pages.about', compact('page', 'defaultContent'));
    }

    /**
     * Display products page
     */
    public function products()
    {
        $page = Page::where('slug', 'products')->first();
        
        $defaultContent = [
            'hero' => [
                'title' => 'Empowering Africa with Sustainable Energy',
                'subtitle' => 'Discover our innovative and affordable solar, and irrigation solutions designed for homes, farms, and communities.'
            ],
            'sections' => [
                'solar_home' => [
                    'title' => 'Solar Home Systems',
                    'content' => 'IGEA offers high-quality, affordable home solar systems providing reliable electricity to off-grid communities. Systems include panels, batteries, LED lighting, and USB charging ports, available in various capacities. Durable and easy to install, they reduce reliance on harmful fuels like kerosene, improving health and productivity. Flexible payment plans, including Pay-As-You-Go, ensure accessibility.'
                ],
                'solar_water' => [
                    'title' => 'Solar Water Pumps',
                    'content' => 'Driving agricultural transformation with solar water pumps for irrigation, enabling year-round farming. Our PAYG model provides affordable access, allowing farmers in groups of five to cultivate crops multiple times annually. Training in good farming practices maximizes yields. This sustainable model empowers farmers, enhances income, reduces dependency on rain, and promotes climate resilience.'
                ]
            ]
        ];

        return view('pages.products', compact('page', 'defaultContent'));
    }

    /**
     * Display team page
     */
    public function team()
    {
        $page = Page::where('slug', 'team')->first();
        $teamMembers = TeamMember::orderBy('order')->get();
        
        $defaultContent = [
            'hero' => [
                'title' => 'Meet Our Passionate Team',
                'subtitle' => 'The dedicated individuals driving sustainable energy solutions and community empowerment across Africa.'
            ]
        ];

        return view('pages.team', compact('page', 'teamMembers', 'defaultContent'));
    }

    /**
     * Display gallery page
     */
    public function gallery()
    {
        $page = Page::where('slug', 'gallery')->first();
        $gallery = Gallery::where('is_active', true)->orderBy('order')->get();
        
        $defaultContent = [
            'hero' => [
                'title' => 'Our Gallery',
                'subtitle' => 'Explore our projects and see the impact we\'re making across Africa.'
            ]
        ];

        return view('pages.gallery', compact('page', 'gallery', 'defaultContent'));
    }

    /**
     * Handle contact form submission
     */
    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Here you can save to database or send email
        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}