<?php

namespace Database\Seeders;

use App\Models\TrustPost;
use Illuminate\Database\Seeder;

class TrustPostsSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Regeneration in Practice: Lessons from the Field',
                'slug' => 'regeneration-in-practice-lessons-from-the-field',
                'excerpt' => 'How local partnerships in East Africa are transforming conservation outcomes through collaborative travel.',
                'content' => '<p>Regenerative travel works when local communities, guides, and conservation teams share ownership of outcomes.</p><p>This reflection explores practical lessons from the field and why long-term partnerships matter.</p>',
                'category' => 'Regenerative Tourism Reflections',
                'is_published' => true,
                'published_at' => now()->subDays(14),
            ],
            [
                'title' => 'Women-Led Mangrove Restoration Along the Coast',
                'slug' => 'women-led-mangrove-restoration-along-the-coast',
                'excerpt' => 'Community cooperatives are restoring mangroves while strengthening livelihoods and climate resilience.',
                'content' => '<p>Mangrove restoration is one of the most impactful nature-based solutions in our portfolio.</p><p>We highlight women-led groups who are shaping climate action from the ground up.</p>',
                'category' => 'Conservation & Climate',
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Community Voices from Northern Kenya',
                'slug' => 'community-voices-from-northern-kenya',
                'excerpt' => 'Local leaders share how regenerative tourism supports education, conservation, and dignified livelihoods.',
                'content' => '<p>Tourism can be a force for social resilience when communities lead design and decision-making.</p>',
                'category' => 'Community Voices',
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Field Notes: Following Wildlife Corridors',
                'slug' => 'field-notes-following-wildlife-corridors',
                'excerpt' => 'A field perspective on why connected habitats are essential for biodiversity and climate adaptation.',
                'content' => '<p>Wildlife corridors are not abstract policy concepts; they are lived landscapes with real community stakes.</p>',
                'category' => 'Field Stories',
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
        ];

        foreach ($posts as $post) {
            TrustPost::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }
    }
}
