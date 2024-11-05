<?php

namespace NewDemo\Types;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Core\Json\JsonProperty;
use NewDemo\Core\Types\ArrayType;

class ModelsMetadataResponse extends JsonSerializableType
{
    /**
     * @var string $name The name of the **class** of models.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $modelDescription A plain-english description of the class of models and what they represent.
     */
    #[JsonProperty('model_description')]
    public string $modelDescription;

    /**
     * @var array<ModelMetadata> $availableModels A list of implementations and variants of this class of models.
     */
    #[JsonProperty('available_models'), ArrayType([ModelMetadata::class])]
    public array $availableModels;

    /**
     * @param array{
     *   name: string,
     *   modelDescription: string,
     *   availableModels: array<ModelMetadata>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->modelDescription = $values['modelDescription'];
        $this->availableModels = $values['availableModels'];
    }
}
