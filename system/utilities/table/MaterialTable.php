<?php
namespace system\utilities;
use backend\models\Material;
use backend\utilities\table\DataTable;

class MaterialTable extends DataTable
{
	public function getColumn()
	{
		switch ($this->column) {
			case '0':
				$field = 'name';
				break;
			case '1':
				$field = 'description';
				break;
			case '2':
				$field = 'image';
				break;
			case '3':
				$field = 'create_date';
				break;
			case '4':
				$field = 'update_date';
				break;
			case '5':
				$field = 'note';
				break;
			case '6':
				$field = 'material_Type_id';
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
			$tempArray[] = $model->name;
			$tempArray[] = $model->description;
			$tempArray[] = $model->image;
			$tempArray[] = $model->create_date;
			$tempArray[] = $model->update_date;
			$tempArray[] = $model->note;
			$tempArray[] = $model->material_Type_id;
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
		$models = Material::find()->where(['is_delete' => 0]);

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