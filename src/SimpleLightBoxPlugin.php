<?php

namespace SolutionForest\FilamentSimpleLightBox;

use Filament\Contracts\Plugin;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

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
        ImageColumn::macro('simpleLightbox', macro: function ($url = null) {
            /** @phpstan-ignore-next-line */
            return $this
                ->extraAttributes(['x-on:click' => 'SimpleLightBox.open(event, \'' . $url . '\')'])
                ->extraImgAttributes(['class' => 'simple-light-box-img-indicator']);
        });

        ImageEntry::macro('simpleLightbox', function ($url = null) {
            /** @phpstan-ignore-next-line */
            return $this
                ->extraAttributes(['x-on:click' => 'SimpleLightBox.open(event, \'' . $url . '\')'])
                ->extraImgAttributes(['class' => 'simple-light-box-img-indicator']);
        });

        TextColumn::macro('simpleLightbox', function ($url) {
            /** @phpstan-ignore-next-line */
            return $this->extraAttributes(['x-on:click' => 'SimpleLightBox.open(event, \'' . $url . '\')']);
        });

        TextEntry::macro('simpleLightbox', function ($url) {
            /** @phpstan-ignore-next-line */
            return $this->extraAttributes(['x-on:click' => 'SimpleLightBox.open(event, \'' . $url . '\')']);
        });

    }

    public static function make(): static
    {
        return app(static::class);
    }
}
