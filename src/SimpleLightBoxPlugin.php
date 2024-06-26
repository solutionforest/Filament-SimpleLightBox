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
            $extraAttributes = $this->extraAttributes[0] ?? [];
            $extraImgAttributes = $this->extraImgAttributes[0] ?? [];

            /** @phpstan-ignore-next-line */
            return $this
                ->openUrlInNewTab()
                ->extraAttributes(array_merge($extraAttributes, ['x-on:click' => 'SimpleLightBox.open(event, \'' . $url . '\')']))
                ->extraImgAttributes(array_merge($extraImgAttributes, ['class' => 'simple-light-box-img-indicator']));
        });

        ImageEntry::macro('simpleLightbox', function ($url = null) {
            $extraAttributes = $this->extraAttributes[0] ?? [];
            $extraImgAttributes = $this->extraImgAttributes[0] ?? [];

            /** @phpstan-ignore-next-line */
            return $this
                ->openUrlInNewTab()
                ->extraAttributes(array_merge($extraAttributes, ['x-on:click' => 'SimpleLightBox.open(event, \'' . $url . '\')']))
                ->extraImgAttributes(array_merge($extraImgAttributes, ['class' => 'simple-light-box-img-indicator']));
        });

        TextColumn::macro('simpleLightbox', function ($url) {
            $extraAttributes = $this->extraAttributes[0] ?? [];

            /** @phpstan-ignore-next-line */
            return $this
                ->openUrlInNewTab()
                ->extraAttributes(array_merge($extraAttributes, ['x-on:click' => 'SimpleLightBox.open(event, \'' . $url . '\')']));
        });

        TextEntry::macro('simpleLightbox', function ($url) {
            $extraAttributes = $this->extraAttributes[0] ?? [];

            /** @phpstan-ignore-next-line */
            return $this
                ->openUrlInNewTab()
                ->extraAttributes(array_merge($extraAttributes, ['x-on:click' => 'SimpleLightBox.open(event, \'' . $url . '\')']));
        });

    }

    public static function make(): static
    {
        return app(static::class);
    }
}
