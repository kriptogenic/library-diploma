<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<Book>
 */
class BookResource extends ModelResource
{
    protected string $model = Book::class;

    protected string $title = 'Books';

    protected bool $createInModal = true;

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Image::make('Poster')->allowedExtensions(['jpg', 'png']),
                Text::make('Name'),
                Text::make('Author'),
                Text::make('Genre'),
                Select::make('Language')->options([
                    'O\'zbek',
                    'Rus',
                    'Ingliz',
                ])->default('O\'zbek'),
                Text::make('Publisher'),
                Number::make('Page count')
                    ->min(0),
                Number::make('year')
                    ->min(0)
                    ->max(now()->year),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
