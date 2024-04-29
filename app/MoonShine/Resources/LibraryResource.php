<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Library;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Database\Eloquent\Model;

use MoonShine\Components\FlexibleRender;
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

    public function detailFields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Name'),
                Text::make('Uuid'),
            ]),
            Block::make([
                FlexibleRender::make($this->qr($this->item->uuid)),
            ])
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    private function qr(string $uuid): string
    {
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        return $writer->writeString($uuid);
    }
}
