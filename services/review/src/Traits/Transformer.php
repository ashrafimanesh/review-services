<?php


namespace Services\Review\Traits;


use Illuminate\Support\Collection;

trait Transformer
{
    abstract protected function transformRow($row);

    public function transform($item): ?array
    {
        if (is_object($item) && ($item instanceof Collection)) {
            $response = [];
            foreach ($item as $row) {
                $transformedData = $this->transform($row);
                if ($transformedData) {
                    $response[] = $transformedData;
                }
            }
            return count($response) > 0 ? $response : null;
        }
        return $this->transformRow($item);
    }
}
