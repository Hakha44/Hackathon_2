<?php
/**
 * Created by PhpStorm.
 * User: amelie
 * Date: 20/12/18
 * Time: 10:08
 */

namespace App\Service;

/**
 * Interface CsvImportInterface
 * @package App\Service
 */
interface CsvImportInterface
{
    /**
     * Import CSV
     */
    public function import() : void;
}