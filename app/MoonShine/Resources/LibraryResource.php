<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Library;
use Illuminate\Database\Eloquent\Model;

use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<Library>
 */
class LibraryResource extends ModelResource
{
    protected string $model = Library::class;

    protected string $title = 'Libraries';

    protected bool $createInModal = true;

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Name'),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
