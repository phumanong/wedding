<?php
namespace backend\utility\Excel;

/**
 *
 */
interface IExcelFile
{
    public function importData();

    public function getFileColumn($params);
}

?>