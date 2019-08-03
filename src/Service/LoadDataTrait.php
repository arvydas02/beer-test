<?php


namespace App\Service;

/**
 * Trait LoadDataTrait
 * @package App\Service
 */
trait LoadDataTrait
{
    /**
     * @param string $file
     * @return array
     */
    public function loadData(string $file): array
    {
        $data = [];
        $firstRow = true;
        if (($handle = fopen($file, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 4000, ',')) !== FALSE) {
                if (!$firstRow) {
                    $data[] = $row;
                }
                $firstRow = false;
            }
            fclose($handle);
        }

        return $data;
    }
}
