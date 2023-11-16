<?php

namespace SolutionForest\FilamentSimpleLightBox;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Filament\Tables\Columns\ImageColumn;

class SimpleLightBoxPlugin implements Plugin
{
    use EvaluatesClosures;

    public function getId(): string
    {
        return FilamentSimpleLightBoxServiceProvider::$name;
    }

    public function register(Panel $panel): void
    {

    }

    public function boot(Panel $panel): void
    {
        ImageColumn::macro('simpleLightbox', function () {
            return $this->extraImgAttributes(['onclick' => 'SimpleImageLightBox.open(event)']);
        });
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        return filament(app(static::class)->getId());
    }
}
