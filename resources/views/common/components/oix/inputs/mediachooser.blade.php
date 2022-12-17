{{
    rohsyl\OmegaCore\Utils\Common\Facades\Plugin::types()
        ->getInput(
            rohsyl\OmegaCore\Utils\Common\Plugin\Type\MediaChooser\MediaChooser::class,
            [
                $name,
                [
                    'multiple' => $multiple ?? false,
                    'preview' => $preview ?? false,
                    'type' => $type ?? null,
                ],
                $value ?? null,
                null
            ]
        )
}}