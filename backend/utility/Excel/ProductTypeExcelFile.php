<?php
namespace backend\utility\Excel;

use backend\models\ProductType;
use yii\db\Exception;

/**
 *
 */
class ProductTypeExcelFile extends ExcelFileInfo implements IExcelFile
{
    public function __construct($params, $files)
    {
        parent::__construct($files);
        $this->getFileColumn($params);
        $this->row_begin = $params['row_header'] + 1;
        $this->sheetData($params['sheet_name']);
        $this->option = $params['option'];
        $this->restrictColumn = $params['restrict_column'];
    }

    public function getFileColumn($params)
    {
        $name = strtoupper($params['name_column']);
        $code = strtoupper($params['code_column']);
        $description = strtoupper($params['description_column']);
        $this->columns = [
            'name' => $name,
            'code' => $code,
            'description' => $description,
        ];
    }

    public function importData()
    {
        $sheetData = $this->data;
        $rowBegin = $this->row_begin;
        $option = $this->option;
        $columns = $this->columns;
        $restrict_column = $this->restrictColumn;
        $count = count($sheetData);
        //1: đè lại dữ liệu cũ, 0: ghi thêm
        for (; $rowBegin <= $count; $rowBegin++) {
            $productType = ProductType::find()->where(['is_delete' => 0, $restrict_column => $sheetData[$rowBegin][$columns[$restrict_column]]])->one();
            $productType = ($productType !== null && $option == 1) ? $productType : new ProductType();
            $productType->name = $sheetData[$rowBegin][$columns["name"]];
            $productType->code = $sheetData[$rowBegin][$columns["code"]];
            $productType->description = (!empty($sheetData[$rowBegin][$columns["description"]])) ? $sheetData[$rowBegin][$columns["description"]] : "";
            try {
                $productType->save(false);
                $this->success++;
            } catch (Exception $e) {
                $this->error++;
                array_merge($this->exceptions, ['row' => $rowBegin, 'message' => $e->getName()]);
            }
        }
    }
}

?>