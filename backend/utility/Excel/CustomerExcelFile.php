<?php
namespace backend\utility\Excel;

use backend\models\Customer;
use Yii;
use yii\db\Exception;

/**
 *
 */
class CustomerExcelFile extends ExcelFileInfo implements IExcelFile
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
        $address = strtoupper($params['address_column']);
        $phone = strtoupper($params['phone_column']);
        $fax = strtoupper($params['fax_column']);
        $website = strtoupper($params['website_column']);
        $taxCode = strtoupper($params['tax_code_column']);
        $note = strtoupper($params['note_column']);
        $other = strtoupper($params['other_column']);
        $this->columns = [
            'name' => $name,
            'code' => $code,
            'address' => $address,
            'phone' => $phone,
            'fax' => $fax,
            'website' => $website,
            'tax_code' => $taxCode,
            'note' => $note,
            'other' => $other,
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
            $customer = Customer::find()->where(['is_delete' => 0, $restrictColumn => $sheetData[$rowBegin][$columns[$restrictColumn]]])->one();
            $customer = ($customer !== null && $option == 1) ? $customer : new Customer();
            $customer->name = $sheetData[$rowBegin][$columns['name']];
            $customer->code = (!empty($sheetData[$rowBegin][$columns['code']])) ? $sheetData[$rowBegin][$columns['code']] : '';
            $customer->address = (!empty($sheetData[$rowBegin][$columns['address']])) ? $sheetData[$rowBegin][$columns['address']] : '';
            $customer->phone = (!empty($sheetData[$rowBegin][$columns['phone']])) ? $sheetData[$rowBegin][$columns['phone']] : '';
            $customer->fax = (!empty($sheetData[$rowBegin][$columns['fax']])) ? $sheetData[$rowBegin][$columns['fax']] : '';
            $customer->website = (!empty($sheetData[$rowBegin][$columns['website']])) ? $sheetData[$rowBegin][$columns['website']] : '';
            $customer->tax_code = (!empty($sheetData[$rowBegin][$columns['tax_code']])) ? $sheetData[$rowBegin][$columns['tax_code']] : '';
            $customer->note = (!empty($sheetData[$rowBegin][$columns['note']])) ? $sheetData[$rowBegin][$columns['note']] : '';
            $customer->other = (!empty($sheetData[$rowBegin][$columns['other']])) ? $sheetData[$rowBegin][$columns['other']] : '';
            $customer->type_customer_id = 1;
            $customer->created_user = Yii::$app->user->id;
            try {
                $customer->save(false);
                $this->success++;
            } catch (Exception $e) {
                $this->error++;
                array_merge($this->exceptions, ['row' => $rowBegin, 'message' => $e->getName()]);
            }
        }
    }
}

?>