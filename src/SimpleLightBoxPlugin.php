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

    public function register(Panel $panel): void {}

    public function boot(Panel $panel): void
    {
        $ensureLightBoxUrl = function ($url, $livewire) {

            if ($url instanceof \Closure) {
                $url = $livewire->evaluate($url);
            }

            if (! is_string($url) || is_null($url) || empty($url)) {
                $url = null;
            }

            return $url;
        };

        ImageColumn::macro('simpleLightbox', macro: function ($url = null, $defaultDisplayUrl = true) use ($ensureLightBoxUrl) {

            if ($defaultDisplayUrl) {
                $this->defaultImageUrl($url);
            }

            /** @phpstan-ignore-next-line */
            return $this
                ->openUrlInNewTab()
                ->action(fn () => null) // override default action for table row
                ->extraAttributes(fn () => ['x-on:click' => 'SimpleLightBox.open(event, \'' . $ensureLightBoxUrl($url, $this) . '\')'], true)
                ->extraImgAttributes(['class' => 'simple-light-box-img-indicator'], true);
        });

        ImageEntry::macro('simpleLightbox', function ($url = null, $defaultDisplayUrl = true) use ($ensureLightBoxUrl) {

            if ($defaultDisplayUrl) {
                $this->defaultImageUrl($url);
            }

            /** @phpstan-ignore-next-line */
            return $this
                ->openUrlInNewTab()
                ->extraAttributes(fn () => ['x-on:click' => 'SimpleLightBox.open(event, \'' . $ensureLightBoxUrl($url, $this) . '\')'], true)
                ->extraImgAttributes(['class' => 'simple-light-box-img-indicator'], true);
        });

        TextColumn::macro('simpleLightbox', function ($url = null, $defaultDisplayUrl = true) use ($ensureLightBoxUrl) {

            if ($defaultDisplayUrl) {
                $this->default($url);
            }

            /** @phpstan-ignore-next-line */
            return $this
                ->openUrlInNewTab()
                ->url($url)
                ->extraAttributes(fn () => ['x-on:click' => 'SimpleLightBox.open(event, \'' . $ensureLightBoxUrl($url, $this) . '\')'], true);
        });

        TextEntry::macro('simpleLightbox', function ($url = null, $defaultDisplayUrl = true) {

            if ($defaultDisplayUrl) {
                $this->default($url);
            }

            /** @phpstan-ignore-next-line */
            return $this
                ->openUrlInNewTab()
                // ->extraAttributes(array_merge($extraAttributes, ['x-on:click' => 'SimpleLightBox.open(event, \'' . $url . '\')']));
                // Special case for text entry, open lightbox for text entry as cannot evaluate url at this point
                ->url($url)
                ->extraAttributes([
                    'x-on:click' => 'SimpleLightBox.openForTextEntry(event, \'a\', \'href\')',
                    'class' => 'fi-in-text-with-lightbox',
                ], true)
                ->extraEntryWrapperAttributes([
                    'class' => 'fi-in-text-with-lightbox-wrapper',
                ], true);
        });

    }

    public static function make(): static
    {
        return app(static::class);
    }
}
