<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use Illuminate\Support\Str;

class PagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Halisi',
                'slug' => 'about-halisi',
                'hero_title' => 'About Halisi Africa Discoveries',
                'hero_subtext' => 'Authentic African Journeys, Designed to Regenerate',
                'body_content' => '<p>Halisi Africa Discoveries was founded on a simple but powerful belief: travel should regenerate, not just visit.</p><p>We craft authentic African journeys that go beyond the ordinary—experiences that connect travelers with the continent\'s incredible wildlife, diverse cultures, and breathtaking landscapes while actively contributing to conservation and community empowerment.</p>',
                'meta_title' => 'About Halisi Africa Discoveries - Regenerative Travel',
                'meta_description' => 'Learn about Halisi Africa Discoveries and our commitment to regenerative tourism across Africa.',
                'is_published' => true,
            ],
            [
                'title' => 'Work With Us',
                'slug' => 'work-with-us',
                'hero_title' => 'Work With Us',
                'hero_subtext' => 'Partnerships that create positive impact',
                'body_content' => '<p>We partner with lodges, guides, communities, and conservation organizations across Africa to create journeys that benefit everyone.</p>',
                'meta_title' => 'Work With Us - Halisi Africa Discoveries',
                'meta_description' => 'Partner with Halisi Africa Discoveries to create regenerative travel experiences.',
                'is_published' => true,
            ],
            [
                'title' => 'Responsible & Regenerative Travel',
                'slug' => 'responsible-regenerative-travel',
                'hero_title' => 'Responsible & Regenerative Travel',
                'hero_subtext' => 'Our commitment to climate-positive travel and ecosystem restoration',
                'body_content' => '<p>Learn how Halisi Africa creates regenerative travel experiences that restore ecosystems and support communities.</p>',
                'meta_title' => 'Responsible & Regenerative Travel - Halisi Africa',
                'meta_description' => 'Learn how Halisi Africa creates regenerative travel experiences that restore ecosystems, support communities, and address climate change through nature-based solutions.',
                'is_published' => true,
            ],
            [
                'title' => 'The Halisi Trust',
                'slug' => 'halisi-trust',
                'hero_title' => 'The Halisi Trust',
                'hero_subtext' => 'Field reflections, climate dialogue, regenerative thinking. Stories of impact, community voices, and conservation insights from across Africa.',
                'featured_label' => 'Featured Article',
                'latest_articles_title' => 'Latest Articles',
                'latest_articles_description' => 'Explore field stories, community voices, conservation insights, and regenerative tourism reflections.',
                'empty_state_message' => 'Articles are coming soon. Check back for field stories, community voices, and conservation insights.',
                'meta_title' => 'The Halisi Trust - Thought Leadership Hub',
                'meta_description' => 'Field reflections, climate dialogue, and regenerative thinking from the Halisi Trust—stories of impact, community voices, and conservation insights.',
                'is_published' => true,
            ],
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'hero_title' => "Let's Design Your Journey",
                'hero_subtext' => 'Get in touch with our team to discuss your interests, travel style, and how we can create a bespoke experience that aligns with your values.',
                'contact_section_title' => 'Get In Touch',
                'contact_section_intro' => 'We respond quickly and tailor every conversation to your travel goals, pace, and values.',
                'contact_form_title' => 'Send Us a Message',
                'contact_form_intro' => "Tell us what kind of journey you're imagining and we'll start shaping it with you.",
                'contact_form_button_label' => 'Send Message',
                'contact_email_label' => 'Email',
                'contact_phone_label' => 'Phone',
                'contact_address_label' => 'Address',
                'contact_hours_label' => 'Office Hours',
                'contact_social_label' => 'Follow Us',
                'contact_map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8171118.189420204!2d37.908293199999996!3d0.15456044999999977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xe145849f15414bf%3A0x437aa8a42154d!2sHalisi%20Africa%20Discoveries!5e0!3m2!1sen!2ske!4v1771327531896!5m2!1sen!2ske',
                'meta_title' => 'Contact Us - Halisi Africa Discoveries',
                'meta_description' => 'Get in touch with Halisi Africa to design your authentic African journey.',
                'is_published' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
