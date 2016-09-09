<?php
namespace system\utilities;
use backend\models\MaterialInventory;
use backend\utilities\table\DataTable;

class MaterialInventoryTable extends DataTable
{
	public function getColumn()
	{
		switch ($this->column) {
			case '0':
				$field = 'import_date';
				break;
			case '1':
				$field = 'export_date';
				break;
			case '2':
				$field = 'user_id';
				break;
			case '3':
				$field = 'material_id';
				break;
			case '4':
				$field = 'quantity';
				break;
			case '5':
				$field = 'description';
				break;
			case '6':
				$field = 'expired_date';
				break;
			default:
				$field = 'name';
				break;
		}
		return $field;
	}
	public function getData()
	{
		$models = $this->getModels();
		$dataArray = [];
		foreach ($models as $model) {
			$tempArray = array();
			$tempArray[] = '<div><input class="ace cb_single" type="checkbox" id="'.$model->id.'"/></div>';
			$tempArray[] = $model->import_date;
			$tempArray[] = $model->export_date;
			$tempArray[] = $model->user_id;
			$tempArray[] = $model->material_id;
			$tempArray[] = $model->quantity;
			$tempArray[] = $model->description;
			$tempArray[] = $model->expired_date;
			$htmlAction = '<button class="btn btn-success btn-view" type="button" data-id="'.$model->id.'">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </button>';
            $htmlAction .= '&nbsp;<button class="btn btn-success btn-update" type="button" data-id="'.$model->id.'">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </button>';
			$htmlAction .= '&nbsp;<button class="btn btn-danger btn-delete" type="button" data-id="'.$model->id.'">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>';
			$tempArray[] = $htmlAction;
			$dataArray[] = $tempArray;
		}
		return $dataArray;
	}
	public function getModels()
	{
		$column = $this->getColumn();
		$models = MaterialInventory::find()->where(['is_delete' => 0]);

		$this->totalRecords = $models->count();

		$models = $models->andFilterWhere(['or',['like', 'name', $this->searchValue]])
		               ->limit($this->length)
		               ->offset($this->start)
		               ->orderBy([$column => $this->direction])
		               ->all();
		return $models;
	}
}
?>