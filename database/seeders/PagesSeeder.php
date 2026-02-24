<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Halisi',
                'slug' => 'about-halisi',
                'hero_title' => 'About Halisi Africa',
                'hero_subtext' => 'Crafting regenerative luxury travel experiences across Africa',
                'meta_title' => 'About Halisi Africa - Our Story & Philosophy',
                'meta_description' => 'Learn about Halisi Africa Discoveries, our regenerative travel philosophy, and why we create journeys that leave more than footprints.',
                'is_published' => true,
            ],
            [
                'title' => 'Work With Us',
                'slug' => 'work-with-us',
                'hero_title' => 'Work With Us',
                'hero_subtext' => 'Partnerships that create positive impact',
                'meta_title' => 'Work With Us - Halisi Africa Discoveries',
                'meta_description' => 'Partner with Halisi Africa Discoveries to create regenerative travel experiences.',
                'is_published' => true,
            ],
            [
                'title' => 'Responsible & Regenerative Travel',
                'slug' => 'responsible-regenerative-travel',
                'hero_title' => 'Responsible & Regenerative Travel',
                'hero_subtext' => 'Our commitment to climate-positive travel and ecosystem restoration',
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
            [
                'title' => 'Media Credits',
                'slug' => 'media-credits',
                'hero_title' => 'Media Credits',
                'hero_subtext' => 'Acknowledge photographers, filmmakers, creators, and companies whose media appears on this website.',
                'body_content' => '<h2>Photography Credits</h2>
<ul>
  <li><strong>Individual / Company Name</strong> - Photo collection used on Homepage and Country pages</li>
  <li><strong>Individual / Company Name</strong> - Wildlife portfolio used on Journey pages</li>
</ul>
<h2>Video Credits</h2>
<ul>
  <li><strong>Individual / Company Name</strong> - Hero background footage</li>
</ul>
<h2>How to Use This Section</h2>
<p>Add one line per person or company and specify where their media appears.</p>',
                'meta_title' => 'Media Credits - Halisi Africa Discoveries',
                'meta_description' => 'Media and asset credits for Halisi Africa Discoveries website.',
                'is_published' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
