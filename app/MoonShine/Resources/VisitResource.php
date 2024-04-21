<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Visit;
use Illuminate\Database\Eloquent\Model;

use MoonShine\Fields\Date;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<Visit>
 */
class VisitResource extends ModelResource
{
    protected string $model = Visit::class;

    protected string $title = 'Visit';

    protected bool $createInModal = true;

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Date::make('Date', 'created_at'),
                BelongsTo::make('User', 'user', 'name'),
                BelongsTo::make('Library', 'library', 'name'),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
