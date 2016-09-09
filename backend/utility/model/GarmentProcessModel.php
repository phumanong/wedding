<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 03/03/2016
 * Time: 11:38
 */

namespace backend\utility\model;

use backend\models\GarmentProcessDeail;
use Yii;

class GarmentProcessModel
{
    public static function saveModel($request, $garmentProcessId)
    {
        $rowsEffected = 0;
        $checkGarmentProcess = $request->post('check_plan');
        $deleteGarmentProcess = $request->post('delete_plan');
        $technology = $request->post('technology');
        $submit = $request->post('submit');
        $time = $request->post('time');
        $description = $request->post('note');
        // end
        $fieldDatas = array();
        $fields = ['technology_id', 'submit', 'time', 'note','garment_process_id'];
        $isNew = false;
        foreach ($technology as $key => $technologys) {
            if ($checkGarmentProcess[$key] == 0 && $deleteGarmentProcess[$key] == 0) {
                $isNew = true;
                $tempArray = array();
                $tempArray['technology'] = $technologys;
                $tempArray['submit'] = $submit[$key];
                $tempArray['time'] = $time[$key];
                $tempArray['note'] = $description[$key];
                $tempArray['garment_process_id'] = $garmentProcessId;
                $fieldDatas[] = $tempArray;
            } else {
                $existedGarmentProcess = GarmentProcessDeail::findOne(['id' => $checkGarmentProcess[$key]]);
                $existedGarmentProcess->technology_id = $technologys;
                $existedGarmentProcess->submit = $submit[$key];
                $existedGarmentProcess->time = $time[$key];
                $existedGarmentProcess->note = $description[$key];
                $existedGarmentProcess->update(false);
            }
        }
        if ($isNew) {
            $fieldDatas = json_decode(json_encode($fieldDatas), false);
            $rowsEffected = Yii::$app->db->createCommand()->batchInsert(GarmentProcessDeail::tableName(), $fields, $fieldDatas)->execute();
        }
        return $rowsEffected;
    }
}