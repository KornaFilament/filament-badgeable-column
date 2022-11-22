<?php

namespace Awcodes\FilamentBadgeableColumn\Components;

use Filament\Support\Components\ViewComponent;
use Filament\Support\Concerns\HasExtraAttributes;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\BelongsToLayout;
use Filament\Tables\Columns\Concerns\BelongsToTable;
use Filament\Tables\Columns\Concerns\CanBeHidden;
use Filament\Tables\Columns\Concerns\HasLabel;
use Filament\Tables\Columns\Concerns\HasName;
use Awcodes\FilamentBadgeableColumn\Components\Concerns\HasColor;
use Filament\Tables\Columns\Concerns\HasRecord;
use Filament\Tables\Columns\Concerns\HasRowLoopObject;
use Filament\Tables\Columns\Concerns\HasState;
use Filament\Tables\Concerns\BelongsToLivewire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\Conditionable;

class Badge extends ViewComponent
{
    use HasColor;
    use HasLabel;
    use HasName;
    use HasRecord;
    use CanBeHidden;

    protected string $view = 'filament-badgeable-column::components.badge';

    protected Column $column;

    final public function __construct(string $name)
    {
        $this->name($name);
    }

    public static function make(string $name): static
    {
        $static = app(static::class, ['name' => $name]);

        return $static;
    }

    public function column(Column $column): static
    {
        $this->column = $column;

        return $this;
    }

    public function getRecord(): ?Model
    {
        return $this->column->getRecord();
    }

    protected function getDefaultEvaluationParameters(): array
    {
        return array_merge(parent::getDefaultEvaluationParameters(), [
            'record' => $this->getRecord(),
        ]);
    }
}