<?php
/**
 * Created by PhpStorm.
 * User: Team
 * Date: 2/24/2016
 * Time: 12:27 PM
 */

namespace backend\utility\model;


use backend\models\Bank;
use Yii;

class BankModel
{
    public static function saveModel($request, $customerId, $isCustomer)
    {
        $rowsEffected = 0;
        // bank information
        $checkBanks = $request->post('check_bank');
        $deleteBank = $request->post('delete_bank');
        $bankNames = $request->post('bank_name');
        $beneficiaryNames = $request->post('beneficiary_name');
        $bankAccounts = $request->post('bank_account');
        $swifts = $request->post('swift');
        // end

        $fieldDatas = array();
        $fieldCustomer = $isCustomer ? 'customer_id' : 'customer_partner_id';
        $fields = ['name', 'account', 'account_name', 'swift_code', $fieldCustomer];
        $isNewBank = false;
        foreach ($bankNames as $key => $bankName) {
            if ($checkBanks[$key] == 0 && $deleteBank[$key] == 0) {
                $isNewBank = true;
                $tempArray = array();
                $tempArray['name'] = $bankName;
                $tempArray['account'] = $beneficiaryNames[$key];
                $tempArray['account_name'] = $bankAccounts[$key];
                $tempArray['swift_code'] = $swifts[$key];
                $tempArray[$fieldCustomer] = $customerId;
                $fieldDatas[] = $tempArray;
            } else {
                $existedBank = Bank::findOne(['id' => $checkBanks[$key]]);
                $existedBank->customer_id = $customerId;
                $existedBank->name = $bankName;
                $existedBank->account_name = $bankAccounts[$key];
                $existedBank->swift_code = $swifts[$key];
                $existedBank->account = $beneficiaryNames[$key];
                $existedBank->update(false);
            }
        }
        if ($isNewBank) {
            $fieldDatas = json_decode(json_encode($fieldDatas), false);
            $rowsEffected = Yii::$app->db->createCommand()->batchInsert(Bank::tableName(), $fields, $fieldDatas)->execute();
        }

        return $rowsEffected;
    }
}