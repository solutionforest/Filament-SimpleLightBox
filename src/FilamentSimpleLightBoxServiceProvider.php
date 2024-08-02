<?php

namespace SolutionForest\FilamentSimpleLightBox;

use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Livewire\Features\SupportTesting\Testable;
use SolutionForest\FilamentSimpleLightBox\Testing\TestsFilamentSimpleLightBox;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentSimpleLightBoxServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-simplelightbox';

    public static string $viewNamespace = 'filament-simplelightbox';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name);

    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        // Testing
        Testable::mixin(new TestsFilamentSimpleLightBox);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'solutionforest/filament-simplelightbox';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            Js::make('filament-simplelightbox-scripts', __DIR__ . '/../resources/dist/filament-simplelightbox.js'),
        ];
    }
}
