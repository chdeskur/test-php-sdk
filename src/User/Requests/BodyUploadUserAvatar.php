<?php

namespace NewDemo\User\Requests;

use NewDemo\Core\Json\JsonSerializableType;
use NewDemo\Utils\File;

class BodyUploadUserAvatar extends JsonSerializableType
{
    /**
     * @var File $image
     */
    public File $image;

    /**
     * @param array{
     *   image: File,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->image = $values['image'];
    }
}
