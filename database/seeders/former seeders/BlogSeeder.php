<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrustPost;
use Carbon\Carbon;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'The Power of Community-Led Conservation',
                'slug' => 'power-of-community-led-conservation',
                'excerpt' => 'How local communities are becoming the guardians of Africa\'s wildlife and wilderness.',
                'content' => 'In the heart of Africa, a quiet revolution is taking place. Communities that once saw wildlife as a threat to their livelihoods are now becoming their most passionate protectors. This transformation is at the core of regenerative tourism—a model that doesn\'t just visit, but invests in the places and people that make these journeys possible.

Through our partnerships with community conservancies across Kenya, Tanzania, and beyond, we\'ve witnessed firsthand how tourism revenue, when channeled correctly, can transform entire ecosystems. When communities benefit directly from conservation, they become its strongest advocates.

The results speak for themselves: wildlife populations recovering, habitats restored, and communities thriving. This is the future of travel—one where every journey leaves a positive footprint.',
                'category' => 'Conservation & Climate',
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Women Leading Restoration: The Mangrove Story',
                'slug' => 'women-leading-restoration-mangrove-story',
                'excerpt' => 'Meet the women restoring Kenya\'s coastal ecosystems, one mangrove at a time.',
                'content' => 'On Kenya\'s coast, a remarkable story is unfolding. Women from local communities are leading mangrove restoration efforts, planting thousands of trees that protect coastlines, sequester carbon, and provide livelihoods.

Through our One Tourist = One Mangrove initiative, every journey contributes directly to these efforts. But it\'s the women on the ground who are the true heroes of this story. They\'ve transformed degraded coastlines into thriving ecosystems, creating nurseries, organizing planting days, and monitoring growth.

These women aren\'t just planting trees—they\'re planting hope. Hope for their children, their communities, and their planet. Their work demonstrates that when women are empowered, entire ecosystems can be restored.',
                'category' => 'Community Voices',
                'published_at' => Carbon::now()->subDays(12),
            ],
            [
                'title' => 'What Regenerative Tourism Really Means',
                'slug' => 'what-regenerative-tourism-really-means',
                'excerpt' => 'Beyond sustainability: how regenerative tourism creates net-positive impact.',
                'content' => 'Regenerative tourism goes beyond "do no harm." It\'s about creating net-positive impact—leaving places better than we found them. This means not just minimizing our footprint, but actively contributing to ecosystem restoration, community empowerment, and cultural preservation.

At Halisi Africa, regenerative tourism means:
- Every journey directly funds conservation initiatives
- Communities receive fair revenue sharing
- Travelers engage authentically with local cultures
- Ecosystems are actively restored, not just protected

This isn\'t a marketing term—it\'s a commitment. A commitment to travel that transforms, not just transports. A commitment to journeys that regenerate, not just visit.',
                'category' => 'Regenerative Tourism Reflections',
                'published_at' => Carbon::now()->subDays(20),
            ],
        ];

        foreach ($posts as $post) {
            TrustPost::firstOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }
    }
}
