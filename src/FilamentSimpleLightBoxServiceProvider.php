<?php

namespace SolutionForest\FilamentSimpleLightBox;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use SolutionForest\FilamentSimpleLightBox\Commands\FilamentSimpleLightBoxCommand;
use SolutionForest\FilamentSimpleLightBox\Testing\TestsFilamentSimpleLightBox;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentSimpleLightBoxServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-simplelightbox';

    public static string $viewNamespace = 'filament-simplelightbox';


    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Testing
        Testable::mixin(new TestsFilamentSimpleLightBox());
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
            // AlpineComponent::make('filament-simplelightbox', __DIR__ . '/../resources/dist/components/filament-simplelightbox.js'),
            Css::make('filament-simplelightbox-styles', __DIR__ . '/../resources/dist/filament-simplelightbox.css'),
            Js::make('filament-simplelightbox-scripts', __DIR__ . '/../resources/dist/filament-simplelightbox.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            FilamentSimpleLightBoxCommand::class,
        ];
    }

    public function configurePackage(Package $package): void
    {
    }
}
