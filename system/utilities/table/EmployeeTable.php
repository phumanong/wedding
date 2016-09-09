<?php
namespace system\utilities;
use backend\models\Employee;
use backend\utilities\table\DataTable;

class EmployeeTable extends DataTable
{
	public function getColumn()
	{
		switch ($this->column) {
			case '0':
				$field = 'full_name';
				break;
			case '1':
				$field = 'phone';
				break;
			case '2':
				$field = 'birthday';
				break;
			case '3':
				$field = 'email';
				break;
			case '4':
				$field = 'cmnd';
				break;
			case '5':
				$field = 'address';
				break;
			case '6':
				$field = 'gender';
				break;
			case '7':
				$field = 'education';
				break;
			case '8':
				$field = 'images';
				break;
			case '9':
				$field = 'create_date';
				break;
			case '10':
				$field = 'update_date';
				break;
			case '11':
				$field = 'user_id';
				break;
			case '12':
				$field = 'group_id';
				break;
			case '13':
				$field = 'office_id';
				break;
			case '14':
				$field = 'salary';
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
			$tempArray[] = $model->full_name;
			$tempArray[] = $model->phone;
			$tempArray[] = $model->birthday;
			$tempArray[] = $model->email;
			$tempArray[] = $model->cmnd;
			$tempArray[] = $model->address;
			$tempArray[] = $model->gender;
			$tempArray[] = $model->education;
			$tempArray[] = $model->images;
			$tempArray[] = $model->create_date;
			$tempArray[] = $model->update_date;
			$tempArray[] = $model->user_id;
			$tempArray[] = $model->group_id;
			$tempArray[] = $model->office_id;
			$tempArray[] = $model->salary;
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
		$models = Employee::find()->where(['is_delete' => 0]);

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