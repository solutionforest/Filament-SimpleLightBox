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

            if (! is_string($url) || empty($url)) {
                $url = null;
            }

            return $url;
        };

        ImageColumn::macro('simpleLightbox', macro: function ($url = null, $defaultDisplayUrl = true) use ($ensureLightBoxUrl) {
            /** @var ImageColumn $this */ // @phpstan-ignore varTag.nativeType (Macroable rebinds $this to the target class at runtime)
            if ($defaultDisplayUrl) {
                $this->defaultImageUrl($url);
            }

            return $this
                ->openUrlInNewTab()
                ->action(fn () => null) // override default action for table row
                ->extraAttributes(fn () => ['x-on:click' => 'SimpleLightBox.open(event, \'' . $ensureLightBoxUrl($url, $this) . '\')'], true)
                ->extraImgAttributes(['class' => 'simple-light-box-img-indicator'], true);
        });

        ImageEntry::macro('simpleLightbox', function ($url = null, $defaultDisplayUrl = true) use ($ensureLightBoxUrl) {
            /** @var ImageEntry $this */ // @phpstan-ignore varTag.nativeType (Macroable rebinds $this to the target class at runtime)
            if ($defaultDisplayUrl) {
                $this->defaultImageUrl($url);
            }

            return $this
                ->openUrlInNewTab()
                ->extraAttributes(fn () => ['x-on:click' => 'SimpleLightBox.open(event, \'' . $ensureLightBoxUrl($url, $this) . '\')'], true)
                ->extraImgAttributes(['class' => 'simple-light-box-img-indicator']);
        });

        TextColumn::macro('simpleLightbox', function ($url = null, $defaultDisplayUrl = true) use ($ensureLightBoxUrl) {
            /** @var TextColumn $this */ // @phpstan-ignore varTag.nativeType (Macroable rebinds $this to the target class at runtime)
            if ($defaultDisplayUrl) {
                $this->default($url);
            }

            return $this
                ->openUrlInNewTab()
                ->url($url)
                ->extraAttributes(fn () => ['x-on:click' => 'SimpleLightBox.open(event, \'' . $ensureLightBoxUrl($url, $this) . '\')'], true);
        });

        TextEntry::macro('simpleLightbox', function ($url = null, $defaultDisplayUrl = true) {
            /** @var TextEntry $this */ // @phpstan-ignore varTag.nativeType (Macroable rebinds $this to the target class at runtime)
            if ($defaultDisplayUrl) {
                $this->default($url);
            }

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
