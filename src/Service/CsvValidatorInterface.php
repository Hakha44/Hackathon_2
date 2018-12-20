<?php
/**
 * Created by PhpStorm.
 * User: amelie
 * Date: 20/12/18
 * Time: 10:07
 */

namespace App\Service;

/**
 * Interface CsvValidatorInterface
 * @package App\Service
 */
interface CsvValidatorInterface
{
    /**
     * Validate if CSV formating is ok
     * @return bool
     */
    public function validate() : bool;
}
