<?php

namespace App\Filament\Resources\RecipeResource\Pages;

use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\RecipeResource;

class ViewRecipe extends Page
{

    use InteractsWithRecord;

    protected static string $resource = RecipeResource::class;
    protected static string $view = 'recipes.view-recipe';

    public $recipe;
    public $media;
    public $preview;

    public function mount($record)
    {
        $this->record = $this->resolveRecord($record);
        $this->recipe = $this->record;
        $this->media = $this->recipe->getMedia() ?? null;
        if ($this->media) {
            $this->preview = $this->media[0]->getFullUrl();
        }
    }

    public function getTitle(): string | Htmlable
    {
        return $this->recipe->title;
    }

    public function getHeading(): string
    {
        return $this->recipe->title;
    }

    public function getSubheading(): string
    {
        return $this->recipe->description;
    }
}
