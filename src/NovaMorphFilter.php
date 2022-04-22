<?php

namespace Mostafaznv\NovaMorphFilter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Nova;
use Laravel\Nova\Resource;

class NovaMorphFilter extends Filter
{
    public $component = 'nova-morph-filter';

    protected array  $types = [];
    protected string $attribute;
    protected string $typeColumn;
    protected string $idColumn;


    public function __construct(string $name, string $attribute)
    {
        $this->name = $name;
        $this->attribute = $attribute;
        $this->typeColumn = "{$attribute}_type";
        $this->idColumn = "{$attribute}_id";

        $this->withMeta([
            'fieldAttribute' => $attribute,
        ]);
    }

    public function setTypeColumn(string $column): self
    {
        $this->typeColumn = $column;

        return $this;
    }

    public function setIdColumn(string $column): self
    {
        $this->idColumn = $column;

        return $this;
    }

    public function types(array $types): self
    {
        foreach ($types as $type) {
            if (is_subclass_of($type, Resource::class)) {
                $this->types[] = [
                    'display' => $type::singularLabel(),
                    'value'   => Str::replace('_', '-', $type::newModel()->getTable())
                ];
            }
        }

        return $this;
    }

    public function apply(Request $request, $query, $value): Builder
    {
        /** @var $resource Resource */
        $resource = Nova::resourceForKey($value['type']);
        $type = $resource::newModel()->getMorphClass();

        return $query
            ->where($this->typeColumn, $type)
            ->where($this->idColumn, $value['id']);
    }

    public function name(): string
    {
        return __($this->name ?: $this->attribute);
    }

    public function key(): string
    {
        return get_class($this) . '\\' . ucfirst($this->attribute);
    }

    public function options(Request $request): array
    {
        return [];
    }

    public function jsonSerialize(): array
    {
        $array = parent::jsonSerialize();
        $array['types'] = $this->types;

        return $array;
    }
}
