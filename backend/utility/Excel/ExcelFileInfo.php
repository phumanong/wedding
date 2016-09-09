<?php
namespace backend\utility\Excel;

include_once(__DIR__ . '/../../utility/phpexcel/PHPExcel/IOFactory.php');

/**
 *
 */
class ExcelFileInfo
{
    public $success = 0;
    public $error = 0;
    public $files = '';
    public $data = '';
    public $exceptions = [];
    public $columns = [];
    public $option = 0;
    public $restrictColumn = '';

    public function __construct($files)
    {
        if (!empty($files)) {
            $this->files = \PHPExcel_IOFactory::load($files['excelFile']['tmp_name']);
        }
    }

    public function getSheetNames()
    {
        $sheet = [];
        //Loop thourgh sheet names and index base 0
        foreach ($this->files->getSheetNames() as $name) {
            $sheet[] = $name;
        }
        return $sheet;
    }

    public function sheetData($index = 0)
    {
        $this->files->setActiveSheetIndex((int)$index);
        return $this->data = $this->files->getActiveSheet()->toArray(null, true, true, true);
    }

    public function getHeader($params)
    {
        $row = $params['row_header'];
        $headers = [];
        $data = $this->sheetData($params['sheet_index']);
        $colBegin = 'A';
        $colEnd = 'Z';
        for ($col = $colBegin; $col <= $colEnd; $col++) {
            if (array_key_exists($col, $data[$row]) && $data[$row][$col] != '') {
                $headers[$col] = $data[$row][$col];
            }
        }
        return $headers;
    }
}

?>