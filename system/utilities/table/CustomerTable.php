<?php
namespace system\utilities\table;
use system\models\Customer;
use system\utilities\table\DataTable;

class CustomerTable extends DataTable
{
	public function getColumn()
	{
		switch ($this->column) {
			case '0':
				$field = 'gender';
				break;
			case '1':
				$field = 'name';
				break;
			case '2':
				$field = 'full_name';
				break;
			case '3':
				$field = 'phone';
				break;
			case '4':
				$field = 'address';
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
			$tempArray[] = $model->gender;
			$tempArray[] = $model->name;
			$tempArray[] = $model->full_name;
			$tempArray[] = $model->phone;
			$tempArray[] = $model->address;
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
		return $models;
	}
	public function getModels()
	{
		$column = $this->getColumn();
		$models = Customer::find();

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