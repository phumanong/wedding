<?php
/**
 * Created by PhpStorm.
 * User: Team
 * Date: 2/24/2016
 * Time: 12:20 PM
 */

namespace backend\utility\model;


use backend\models\Contact;
use Yii;

class ContactModel
{
    public static function saveModel($request, $customerId, $isCustomer)
    {
        $rowsEffected = 0;
        // contact information
        $checkContacts = $request->post('check_contact');
        $deleteContacts = $request->post('delete_contact');
        $contactNames = $request->post('contact_name');
        $emails = $request->post('email');
        $positions = $request->post('position');
        $telephonePrivates = $request->post('telephone_private');
        // end

        $fieldDatas = array();
        $fieldCustomer = $isCustomer ? 'customer_id' : 'customer_partner_id';
        $fields = ['name', 'position', 'email', 'phone', $fieldCustomer];
        $isNewContact = false;

        foreach ($contactNames as $key => $contactName) {
            if ($checkContacts[$key] == 0 && $deleteContacts[$key] == 0) {
                $isNewContact = true;
                $tempArray = array();
                $tempArray['name'] = $contactName;
                $tempArray['position'] = $positions[$key];
                $tempArray['email'] = $emails[$key];
                $tempArray['phone'] = $telephonePrivates[$key];
                $tempArray[$fieldCustomer] = $customerId;
                $fieldDatas[] = $tempArray;
            } else {
                $existedContact = Contact::findOne(['id' => $checkContacts[$key]]);
                $existedContact->customer_id = $customerId;
                $existedContact->name = $contactNames[$key];
                $existedContact->email = $positions[$key];
                $existedContact->phone = $telephonePrivates[$key];
                $existedContact->position = $positions[$key];
                $existedContact->save(false);
            }
        }
        if ($isNewContact) {
            $fieldDatas = json_decode(json_encode($fieldDatas), false);
            $rowsEffected = Yii::$app->db->createCommand()->batchInsert(Contact::tableName(), $fields, $fieldDatas)->execute();
        }

        return $rowsEffected;
    }
}