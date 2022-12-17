<x-oix-input-group :label="$label ?? null" :helper="$helper ?? null" :name="$name">
    {{
        rohsyl\OmegaCore\Utils\Common\Facades\Plugin::types()
            ->getInput(
                rohsyl\OmegaCore\Utils\Common\Plugin\Type\TextSimple\TextSimple::class,
                [
                    $name,
                    null,
                    $value ?? null,
                    null
                ]
            )
    }}
</x-oix-input-group>
