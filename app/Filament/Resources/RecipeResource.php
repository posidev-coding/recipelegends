<?php

namespace App\Filament\Resources;

use App\Models\Recipe;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;

// Form Components
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Builder\Block;
use Filament\Tables\Actions\BulkActionGroup;

// Table Components
use Filament\Forms\Components\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use App\Filament\Resources\RecipeResource\Pages\EditRecipe;
use App\Filament\Resources\RecipeResource\Pages\ViewRecipe;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\RecipeResource\Pages\ListRecipes;
use App\Filament\Resources\RecipeResource\Pages\CreateRecipe;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('About')
                    ->description('Start with a title and share the story behind your recipe!')
                    ->schema([
                        Grid::make([
                            'default' => 1,
                        ])
                            ->schema([
                                TextInput::make('title')
                                    ->placeholder('Give your recipe a title')
                                    ->required()
                                    ->maxLength(100)
                                    ->columnSpan(1),
                                Textarea::make('description')
                                    ->placeholder('Tell us about this recipe. Where did it come from? What makes it special?')
                                    ->rows(3)
                                    ->columnSpan(1),
                            ])->columnSpan(3),
                        Grid::make([
                            'default' => 1,
                        ])
                            ->schema([
                                TextInput::make('servings')
                                    ->placeholder('e.g. 4')
                                    ->integer()
                                    ->required()
                                    ->columnSpan(2),
                                TextInput::make('yield')
                                    ->placeholder('e.g. 8-10 pancakes')
                                    ->columnSpan(1)
                            ])->columnSpan(2),
                    ])->columns(5)->columnSpan(2),
                Section::make('Ingredients')
                    ->description('Enter one ingredient per line. Include the quantity (i.e. cups, tablespoons) and any special preparation (i.e. sifted, softened, chopped). Use optional headers to organize the different parts of the recipe (i.e. Cake, Frosting, Dressing).')
                    ->schema([
                        Builder::make('ingredients')
                            ->label('')
                            ->blocks([
                                Block::make('ingredient')
                                    ->icon('heroicon-m-plus-circle')
                                    ->schema([
                                        TextInput::make('content')
                                            ->live(onBlur: true)
                                            ->label('Ingredient')
                                            ->placeholder('e.g. 2 tablespoons butter, softened')
                                            ->required(),
                                    ])
                                    ->label(function (?array $state): string {
                                        if ($state === null) {
                                            return 'Ingredient';
                                        }
                                        return $state['content'] ? Str::limit($state['content'], 40) : 'Untitled ingredient';
                                    })
                                    ->columns(1),
                                Block::make('heading')
                                    ->icon('heroicon-c-h2')
                                    ->schema([
                                        TextInput::make('content')
                                            ->live(onBlur: true)
                                            ->label('Heading')
                                            ->placeholder('e.g. Marinade')
                                            ->required(),
                                    ])
                                    ->label(function (?array $state): string {
                                        if ($state === null) {
                                            return 'Heading';
                                        }
                                        return $state['content'] ? Str::limit($state['content'], 40) : 'Untitled heading';
                                    })
                                    ->columns(1),
                            ])
                            ->addActionLabel('Add ingredient or heading')
                            ->blockNumbers(false)
                            ->blockIcons()
                            ->collapsible()
                            ->collapsed()
                            ->collapseAllAction(
                                fn(Action $action) => $action->label('Collapse all'),
                            )
                            ->minItems(1)
                    ])->columns(1)->columnSpan(2),
                Section::make('Directions')
                    ->description('Explain how to make your recipe, including oven temperatures, baking or cooking times, and pan sizes, etc. Use optional headers to organize the different parts of the recipe (i.e. Prep, Bake, Decorate).')
                    ->schema([
                        Builder::make('directions')
                            ->label('')
                            ->blocks([
                                Block::make('step')
                                    ->icon('heroicon-m-plus-circle')
                                    ->schema([
                                        TextArea::make('content')
                                            ->label('Step')
                                            ->placeholder('e.g. Combine ingredients in a large mixing bowl, add salt & pepper to taste')
                                            ->rows(2)
                                            ->required(),
                                    ])
                                    ->label(function (?array $state): string {
                                        if ($state === null) {
                                            return 'Step';
                                        }
                                        return $state['content'] ? Str::limit($state['content'], 40) : 'Untitled step';
                                    })
                                    ->columns(1),
                                Block::make('heading')
                                    ->icon('heroicon-c-h2')
                                    ->schema([
                                        TextInput::make('content')
                                            ->live(onBlur: true)
                                            ->label('Heading')
                                            ->placeholder('e.g. Grill Prep')
                                            ->required(),
                                    ])
                                    ->label(function (?array $state): string {
                                        if ($state === null) {
                                            return 'Heading';
                                        }
                                        return $state['content'] ? Str::limit($state['content'], 40) : 'Untitled heading';
                                    })
                                    ->columns(1),
                            ])
                            ->addActionLabel('Add step or heading')
                            ->blockIcons()
                            ->blockNumbers(false)
                            ->collapsible()
                            ->collapsed()
                            ->collapseAllAction(
                                fn(Action $action) => $action->label('Collapse all'),
                            )
                            ->minItems(1)
                    ])->columns(1)->columnSpan(2),
                Section::make('Media')
                    ->description('Add any documents you have related this recipe, such as a scan of the original handwritten version, a typed word document, a family photo, or a picture of the plated dish showing the final result. You can always add these later.')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('media')
                            ->disk('media')
                            ->multiple()
                            ->panelLayout('grid')
                            ->reorderable()
                            ->columnSpan(2),
                    ])->columns(2)->columnSpan(2),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('title'),
                TextColumn::make('description'),
                SpatieMediaLibraryImageColumn::make('preview')
                    ->conversion('preview')
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make()
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRecipes::route('/'),
            'create' => CreateRecipe::route('/create'),
            'view' => ViewRecipe::route('/{record}'),
            'edit' => EditRecipe::route('/{record}/edit'),
        ];
    }
}
