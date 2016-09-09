<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use system\controller\Controller;
use common\models\LoginForm;
use yii\base\InvalidParamException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use backend\models\User;
class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionLogin()
    {
        $model = new LoginForm();
        if (Yii::$app->request->isAjax):
            $request = Yii::$app->request;
            $username = $request->post('username');
            $password = $request->post('password');
            $password = $password;
            $arr['username'] = $username;
            $arr['password'] = $password;
            $arr['rememberMe'] = 0;
            $array['_csrf'] = 'aTRJRWs5aTUHcQ5wXVQkWDluByQ8fVx8JGsMCRpwJ1QOchk1MkAOdw';
            $array['LoginForm'] = $arr;
            $array['login-button'] = '';
            if ($model->load($array) && $model->login()):
                return 'success';
            else:
                return 'login fail';
            endif;
        else:
            Yii::$app->layout = 'login';
            if (!\Yii::$app->user->isGuest) {
                return $this->goHome();
            }
            return $this->render('login', [
                'model' => $model,
            ]);
        endif;
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    public function actionPopupChangePassword()
    {
        if (Yii::$app->request->isAjax):
            return $this->renderPartial('_form_change_password');
        endif;
    }

    public function actionChangePassword()
    {
        if (Yii::$app->request->isAjax):
            $userId = Yii::$app->user->getId();
            $current_pass = Yii::$app->request->post('current_pass');
            $user = User::find()->where(['id' => $userId])->one();
            $valid = Yii::$app->getSecurity()->validatePassword($current_pass, $user->password_hash);
            if ($valid == 1):
                $new_pass = Yii::$app->request->post('new_pass');
                $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($new_pass);
                $user->save();
                Yii::$app->user->logout();
                return 1;
            else:
                return 0;
            endif;
        endif;
    }

    public function actionForgotpassword()
    {
        Yii::$app->layout = 'login';
        if (Yii::$app->request->isAjax):
            $email = Yii::$app->request->post('email','');
            $model = User::find()->where(['email' => $email])->one();
            if (isset($model)):
                $password_reset_token = new randomPass(45);
                $url = URL::to(['site/resetpassword', 'password_reset_token' => $password_reset_token], 'http');
                $model->password_reset_token = $password_reset_token;
                $model->expired_date = strtotime(date('Y-m-d H:i:s'));
                $model->save();
                Yii::$app->mailer->compose()
                    ->setFrom('hoabinhtest@gmail.com')
                    ->setTo($email)
                    ->setSubject('Thay đổi mật khẩu')
                    ->setTextBody('Yêu cầu thay đổi mật khẩu: ' . urldecode($url))
                    ->send();
                return "success";
            else:
                return "failed";
            endif;
            die;
        else:
            return $this->render('forgotpassword');
        endif;
    }

    public function actionResetpassword()
    {
        Yii::$app->layout = 'login';
        if (Yii::$app->request->isAjax):
            $password_reset_token = Yii::$app->request->post("token");
            $password = Yii::$app->request->post("password");
            $model = User::find()->where(['password_reset_token' => $password_reset_token])->one();
            $model->password_hash = Yii::$app->security->generatePasswordHash($password);
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->password_reset_token = '';
            $model->expired_date = '';
            $model->save();
            return "success";
            die;
        else:
            $password_reset_token = Yii::$app->request->get("token");
            $model = User::find()
                ->where('password_reset_token = "'.$password_reset_token.'"')
                ->one();
            if(is_null($model)){
                return false;
            }
            $day_now = strtotime(date('Y-m-d H:i:s'));
            $expired = $day_now - $model->expired_date;
            if($expired < 86400):
                return $this->render('resetpassword');
            else:
                return $this->goHome();
            endif;
        endif;
    }
    public function actionError()
    {
        $this->redirect(\Yii::$app->urlManager->createUrl('site/index'));
    }
}
function randomPass($length){
    $length = $length;
    $chars = array_merge(range(0,9), range('a','z'), range('A','Z'));
    shuffle($chars);
    $password = implode(array_slice($chars, 0, $length));
    return $password;
}