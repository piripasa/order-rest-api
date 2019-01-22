<?php

namespace App\Transformers;


class OrderTransformer extends BaseTransformer
{
    public function transform($object)
    {
        return [
            'id' => (int) $object->id,
            'distance' => (int) $object->distance,
            'status' => (string) $object->status,
        ];
    }
}