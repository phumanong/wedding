<?php
namespace backend\utility\Excel;

/**
 *
 */
class ExcelFileFacade
{
    private $excelFile = '';

    public function __construct(IExcelFile $excelFile)
    {
        $this->excelFile = $excelFile;
    }

    public function importData()
    {
        $this->excelFile->importData();
    }

    public function getImportResult()
    {
        return ['success' => $this->excelFile->success, 'error' => $this->excelFile->error, 'exceptions' => $this->excelFile->exceptions];
    }


}

?>