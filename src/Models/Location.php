<?php

namespace Astrogoat\Locations\Models;

use Helix\Fabrick\Icon;
use Helix\Lego\Models\Contracts\Sectionable;
use Helix\Lego\Models\Model as LegoModel;
use Helix\Lego\Models\Traits\HasSections;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Location extends LegoModel implements Sectionable
{
    use HasSections;
    use HasSlug;

//    protected $table = 'locations';

    public static function icon(): string
    {
        return Icon::EYE;
    }

    public static function getStoreKeyName(): string
    {
        return 'store_name';
    }

    public static function getAddressKeyName(): string
    {
        return 'store_address';
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
        return 'store_name';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom($this->getDisplayKeyName())
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
}
