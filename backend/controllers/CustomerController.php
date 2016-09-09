<?php
namespace backend\controllers;

use Yii;
use system\models\Customer;
use system\controller\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use system\utilities\table\DataTableFacade;
use system\utilities\table\CustomerTable;

class CustomerController extends Controller
{
	public function actionAjaxTable() {
		if ( Yii::$app->request->isAjax ):
			$dataTableFacade = new DataTableFacade( new CustomerTable( Yii::$app->request->post() ) );
			$dataArray       = $dataTableFacade->getData();
			$json            = Json::encode( $dataArray );
			$data            = '{"draw": ' . $dataTableFacade->getDraw() . ',"recordsTotal": ' . $dataTableFacade->getTotalRecord() . ',"recordsFiltered": ' . $dataTableFacade->getTotalFiltered() . ',"data": ' . $json . '}';

			return $data;
        endif;
	}
    public function actionLoadData(){
        if ( Yii::$app->request->isAjax ):
            $action = Yii::$app->request->post('action','');
            $data = Yii::$app->request->post('data','');
            if($action != '' && $data != ''):
                foreach ($data as $key => $value):
                    if($action == 'create'):
                        
                    elseif($action == 'edit'):
                        
                    elseif($action == 'remove'):

                    endif;
                endforeach;
            else:
                $dataTableFacade = new DataTableFacade( new CustomerTable( Yii::$app->request->get() ) );
                $dataArray       = $dataTableFacade->getData();
                $json            = Json::encode( $dataArray );
                $data            = '{"draw": ' . $dataTableFacade->getDraw() . ',"recordsTotal": ' . $dataTableFacade->getTotalRecord() . ',"recordsFiltered": ' . $dataTableFacade->getTotalFiltered() . ',"data": ' . $json . '}';
                return $data;
            endif;
        endif;
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
