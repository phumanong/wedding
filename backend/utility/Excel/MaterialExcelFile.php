<?php
/**
 * Created by PhpStorm.
 * User: Team
 * Date: 1/7/2016
 * Time: 3:02 PM
 */

namespace backend\utility\Excel;


use backend\models\Materials;
use backend\models\MaterialsType;
use yii\db\Exception;

class MaterialExcelFile extends ExcelFileInfo implements IExcelFile
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
            $material = Materials::find()
                ->where([
                    'is_delete' => 0,
                    $restrict_column => $sheetData[$rowBegin][$columns[$restrict_column]]
                ])
                ->one();
            $material = ($material !== null && $option == 1) ? $material : new Materials();
            $material->code = $sheetData[$rowBegin][$columns['code']];
            $material->name = $sheetData[$rowBegin][$columns['name']];
            $material->length = (!empty($sheetData[$rowBegin][$columns['length']])) ? $sheetData[$rowBegin][$columns['length']] : '';
            $material->width = (!empty($sheetData[$rowBegin][$columns['width']])) ? $sheetData[$rowBegin][$columns['width']] : '';
            $materialTypeId = $this->getMaterialTypeId($sheetData[$rowBegin][$columns['material_type']], $rowBegin);
            $material->material_type_id = $materialTypeId;
            $material->description = (!empty($sheetData[$rowBegin][$columns['description']])) ? $sheetData[$rowBegin][$columns['description']] : '';
            try {
                $material->save(false);
                $this->success++;
            } catch (Exception $e) {
                $this->error++;
                array_merge($this->exceptions, ['row' => $rowBegin, 'message' => $e->getName()]);
            }
        }
    }

    private function getMaterialTypeId($materialTypeName, $rowBegin)
    {
        $materialTypeId = '';
        if ($materialTypeName !== '') {
            $materialType = MaterialsType::find()->where(['like', 'name', $materialTypeName])
                ->orWhere(['like', 'code', $materialTypeName])->select('id')->one();
            if (count($materialType) > 0) {
                $materialTypeId = $materialType->id;
            } else {
                $this->error++;
                array_merge($this->exceptions, ['row' => $rowBegin, 'message' => 'Dữ liệu không hợp lệ']);
            }
        }
        return $materialTypeId;
    }

    public function getFileColumn($params)
    {
        $name = strtoupper($params['name_column']);
        $code = strtoupper($params['code_column']);
        $materialType = strtoupper($params['material_type_column']);
        $length = strtoupper($params['length_column']);
        $width = strtoupper($params['width_column']);
        $description = strtoupper($params['description_column']);
        $this->columns = [
            'name' => $name,
            'code' => $code,
            'length' => $length,
            'width' => $width,
            'material_type' => $materialType,
            'description' => $description,
        ];
    }
}