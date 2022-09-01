<?php

namespace Astrogoat\Locations\Models;

use Helix\Fabrick\Icon;
use Helix\Lego\Models\Contracts\Indexable;
use Helix\Lego\Models\Contracts\Metafieldable;
use Helix\Lego\Models\Contracts\Publishable;
use Helix\Lego\Models\Contracts\Searchable;
use Helix\Lego\Models\Contracts\Sectionable;
use Helix\Lego\Models\Model as LegoModel;
use Helix\Lego\Models\Traits\CanBePublished;
use Helix\Lego\Models\Traits\HasFooter;
use Helix\Lego\Models\Traits\HasMetafields;
use Helix\Lego\Models\Traits\HasSections;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Location extends LegoModel implements Sectionable, Metafieldable, Publishable, Searchable, Indexable
{
    use HasSections;
    use HasSlug;
    use HasMetafields;
    use CanBePublished;
    use HasFooter;


    public $casts = [
        'indexable' => 'boolean',
    ];

    protected $dates = [
        'published_at',
    ];

    public static function icon(): string
    {
        return Icon::EYE;
    }

    public static function getStoreKeyName(): string
    {
        return 'name';
    }

    public static function getAddressKeyName(): string
    {
        return 'address';
    }

    public function editorShowViewRoute(string $layout = null): string
    {
        return route('lego.locations.editor', [
            'location' => $this,
            'editor_view' => 'show',
            'layout' => $layout,
        ]);
    }

    public static function getDisplayKeyName(): string
    {
        return 'name';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom($this->getDisplayKeyName())
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public static function searchableIcon(): string
    {
        return Icon::LOCATION_MARKER;
    }

    public static function searchableIndexRoute(): string
    {
        return route('lego.locations.index');
    }

    public function scopeGlobalSearch($query, $value)
    {
        return $query->where('name', 'LIKE', '%' . $value . '%');
    }

    public function searchableName(): string
    {
        return $this->name;
    }

    public function searchableDescription(): string
    {
        return $this->address ?: '';
    }

    public function searchableRoute(): string
    {
        return route('lego.locations.edit', $this);
    }

    public function getPublishedRoute(): string
    {
        return route('locations.show', $this);
    }

    public function shouldIndex(): bool
    {
        return $this->indexable;
    }

    public function getIndexedRoute(): string
    {
        return $this->getPublishedRoute();
    }

    public function getPublishedAtKey(): string
    {
        return 'published_at';
    }
}
