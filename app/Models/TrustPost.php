<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TrustPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolvedFeaturedImageUrl(): ?string
    {
        $image = $this->featured_image;
        if (! filled($image)) {
            return null;
        }
        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }
        if (str_starts_with($image, '/storage/')) {
            return asset(ltrim($image, '/'));
        }
        if (str_starts_with($image, 'storage/')) {
            return asset($image);
        }

        return asset('storage/' . ltrim($image, '/'));
    }

    /**
     * HTML for article body: decodes stored entities, renders real HTML when present,
     * otherwise plain text with line breaks (admin-authored content).
     */
    public function htmlBody(): string
    {
        $decoded = self::decodeHtmlEntitiesRepeatedly((string) $this->content);
        $trimmed = trim($decoded);
        if ($trimmed === '') {
            return '';
        }
        if (preg_match('/<[a-z][\s\S]*>/i', $trimmed)) {
            return $decoded;
        }

        return nl2br(e($decoded));
    }

    public function plainSummaryForMeta(int $limit = 160): string
    {
        $raw = filled($this->excerpt) ? $this->excerpt : (string) $this->content;
        $decoded = self::decodeHtmlEntitiesRepeatedly($raw);
        $text = trim(preg_replace('/\s+/', ' ', strip_tags($decoded)));

        return Str::limit($text, $limit, '…');
    }

    /** Plain-text excerpt for on-page display (strips tags / decodes entities). */
    public function displayExcerptPlain(int $limit = 320): ?string
    {
        if (! filled($this->excerpt)) {
            return null;
        }
        $decoded = self::decodeHtmlEntitiesRepeatedly($this->excerpt);
        $text = trim(preg_replace('/\s+/', ' ', strip_tags($decoded)));
        if ($text === '') {
            return null;
        }

        return Str::limit($text, $limit, '…');
    }

    public function estimatedMinutesToRead(): int
    {
        $text = trim(preg_replace('/\s+/', ' ', strip_tags(self::decodeHtmlEntitiesRepeatedly((string) $this->content))));
        $words = str_word_count($text);

        return max(1, (int) ceil($words / 200));
    }

    private static function decodeHtmlEntitiesRepeatedly(string $value): string
    {
        $decoded = $value;
        for ($i = 0; $i < 4; $i++) {
            $next = html_entity_decode($decoded, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            if ($next === $decoded) {
                break;
            }
            $decoded = $next;
        }

        return $decoded;
    }
}
