<?php
namespace backend\utility\Excel;

use backend\models\Customer;
use Yii;
use yii\db\Exception;

class PartnerExcelFile extends ExcelFileInfo implements IExcelFile
{
    private $typePartner;
    public function __construct($params, $files)
    {
        parent::__construct($files);
        $this->getFileColumn($params);
        $this->row_begin = $params['row_header'] + 1;
        $this->sheetData($params['sheet_name']);
        $this->option = $params['option'];
        $this->restrictColumn = $params['restrict_column'];
        $this->typePartner = $params['type_partner'];
    }

    public function getFileColumn($params)
    {
        $name = strtoupper($params['name_column']);
        $website = strtoupper($params['website_column']);
        $address = strtoupper($params['address_column']);
        $fax = strtoupper($params['fax_column']);
        $code = strtoupper($params['post_code_column']);
        $phone = strtoupper($params['phone_column']);
        $this->columns = [
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
            'code' => $code,
            'fax' => $fax,
            'website' => $website,
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
            $customer = Customer::find()
                ->where([
                    'is_delete' => 0,
                    $restrictColumn => $sheetData[$rowBegin][$columns[$restrictColumn]]
                ])
                ->one();
            $customer = ($customer !== null && $option == 1) ? $customer : new Customer();
            $customer->phone = $sheetData[$rowBegin][$columns['phone']];
            $customer->name = $sheetData[$rowBegin][$columns['name']];
            $customer->website = (!empty($sheetData[$rowBegin][$columns['website']])) ? $sheetData[$rowBegin][$columns['website']] : '';
            $customer->address = (!empty($sheetData[$rowBegin][$columns['address']])) ? $sheetData[$rowBegin][$columns['address']] : '';
            $customer->fax = (!empty($sheetData[$rowBegin][$columns['fax']])) ? $sheetData[$rowBegin][$columns['fax']] : '';
            $customer->code = (!empty($sheetData[$rowBegin][$columns['code']])) ? $sheetData[$rowBegin][$columns['code']] : '';
            $customer->type_customer_id = $this->typePartner;
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