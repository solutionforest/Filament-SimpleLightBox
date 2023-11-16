<?php

namespace SolutionForest\FilamentSimpleLightBox\Commands;

use Illuminate\Console\Command;

class FilamentSimpleLightBoxCommand extends Command
{
    public $signature = 'filament-simplelightbox';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
