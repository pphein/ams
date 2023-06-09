<?php

namespace App\DataModels;

class BaseDataModel
{
    /**
     * Mapping properties' values with data model and database query
     *
     * @param $dataModel
     * @return void
     */
    public function mapProperties($dataModel): void
    {
        $keys = get_class_vars($this::class);
        $values = $dataModel?->toArray();
        foreach ($keys as $key => $value) {
            if (isset($values[$key])) {
                $this->{$key} = $dataModel->{$key};
            }
        }
    }

    /**
     * Get array of properties of data model
     *
     * @return array
     */
    public function toArray(): array
    {
        return json_decode(json_encode($this), true);
    }

    public function parseItems($dataModelClass, $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            $item =  new $dataModelClass($value);
            array_push($result, $item);
        }

        return $result;
    }
}
