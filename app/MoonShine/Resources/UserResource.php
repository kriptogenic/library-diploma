<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use MoonShine\Fields\Email;
use MoonShine\Fields\Password;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<User>
 */
class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Users';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                ...$this->fieldsBasic(),
            ]),
        ];
    }

    public function fieldsBasic(): array
    {
        return [
            Text::make('Name'),
            Text::make('Last name'),
            Text::make('Group'),
            Phone::make('Phone'),
            Email::make('Email'),
        ];
    }

    public function formFields(): array
    {
        return [
            Block::make([
                ...$this->fieldsBasic(),
                Password::make('Password'),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
