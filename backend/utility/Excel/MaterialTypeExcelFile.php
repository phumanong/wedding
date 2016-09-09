<?php
namespace backend\utility\Excel;

use backend\models\MaterialsType;
use backend\models\MaterialsUnit;
use yii\db\Exception;


class MaterialTypeExcelFile extends ExcelFileInfo implements IExcelFile
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
        $restrictColumn = $this->restrictColumn;
        $count = count($sheetData);
        //1: đè lại dữ liệu cũ, 0: ghi thêm
        for (; $rowBegin <= $count; $rowBegin++) {
            $materialType = MaterialsType::find()->where(['is_delete' => 0, $restrictColumn => $sheetData[$rowBegin][$columns[$restrictColumn]]])->one();
            $materialType = ($materialType !== null && $option === 1) ? $materialType : new MaterialsType();
            $materialType->name = $sheetData[$rowBegin][$columns['name']];
            $materialType->code = (!empty($sheetData[$rowBegin][$columns['code']])) ? $sheetData[$rowBegin][$columns['code']] : '';
            $materialType->type = (!empty($sheetData[$rowBegin][$columns['type']])) ? $sheetData[$rowBegin][$columns['type']] : '';
            $materialType->description = (!empty($sheetData[$rowBegin][$columns['description']])) ? $sheetData[$rowBegin][$columns['description']] : '';
            $materialUnitId = $this->getMaterialUnitId($sheetData[$rowBegin][$columns['material_unit_column']], $rowBegin);
            $materialType->material_unit_id = $materialUnitId ?: '';

            try {
                $materialType->save(false);
                $this->success++;
            } catch (Exception $e) {
                $this->error++;
                array_merge($this->exceptions, ['row' => $rowBegin, 'message' => $e->getName()]);
            }
        }
    }

    private function getMaterialUnitId($materialUnitName, $rowBegin)
    {
        $materialUnitId = '';
        if ($materialUnitName !== '') {
            $materialUnit = MaterialsUnit::find()->where(['like', 'name', $materialUnitName])->select('id')->one();
            if (count($materialUnit) > 0) {
                $materialUnitId = $materialUnit->id;
            } else {
                $this->error++;
                array_merge($this->exceptions, ['row' => $rowBegin, 'message' => 'Dữ liệu không hợp lệ']);
            }
        }
        return $materialUnitId;
    }

    public function getFileColumn($params)
    {
        $name = strtoupper($params['name_column']);
        $code = strtoupper($params['code_column']);
        $type = strtoupper($params['type_column']);
        $description = strtoupper($params['description_column']);
        $material_unit_column = strtoupper($params['material_unit_column']);

        $this->columns = [
            'name' => $name,
            'code' => $code,
            'type' => $type,
            'description' => $description,
            'material_unit_column' => $material_unit_column
        ];
    }
}