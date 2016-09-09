<?php
namespace backend\utility\Excel;

use backend\models\Product;
use yii\db\Exception;

/**
 *
 */
class ProductExcelFile extends ExcelFileInfo implements IExcelFile
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
        $productName = strtoupper($params['name_column']);
        $productCode = strtoupper($params['code_column']);
        $note = strtoupper($params['description_column']);
        $this->columns = [
            'product_name' => $productName,
            'product_code' => $productCode,
            'note' => $note,
        ];
    }

    public function importData()
    {
        $sheetData = $this->data;
        $rowBegin = $this->row_begin;
        $option = $this->option;
        $columns = $this->columns;
        $restrictColumn = $this->restrictColumn;
        $count = count($sheetData);
        //1: đè lại dữ liệu cũ, 0: ghi thêm
        for (; $rowBegin <= $count; $rowBegin++) {
            $product = Product::find()->where(['is_delete' => 0, $restrictColumn => $sheetData[$rowBegin][$columns[$restrictColumn]]])->one();
            $product = ($product !== null && $option == 1) ? $product : new Product();
            $product->product_name = $sheetData[$rowBegin][$columns['product_name']];
            $product->product_code = (!empty($sheetData[$rowBegin][$columns['product_code']])) ? $sheetData[$rowBegin][$columns['product_code']] : '';
            $product->note = (!empty($sheetData[$rowBegin][$columns['note']])) ? $sheetData[$rowBegin][$columns['note']] : '';
            try {
                $product->save(false);
                $this->success++;
            } catch (Exception $e) {
                $this->error++;
                array_merge($this->exceptions, ['row' => $rowBegin, 'message' => $e->getName()]);
            }
        }
    }
}

?>