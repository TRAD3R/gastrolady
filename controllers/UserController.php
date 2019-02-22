<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 19:53
 */

namespace app\controllers;


use app\models\User;
use app\models\UserJoinForm;
use app\models\UserLoginForm;
use Yii;
use yii\web\Controller;

class UserController extends Controller
{
    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionJoin(){
        $userJoinForm = new UserJoinForm();

        if(Yii::$app->request->isPost){
            $userJoinForm->load(Yii::$app->request->post());
            if($userJoinForm->validate()){
                $user = new User();
                $user->added = time();
                $user->username = $userJoinForm->username;
                $user->email = $userJoinForm->email;
                $user->hashPassword($userJoinForm->password);

                if($user->save())
                    return $this->redirect('/');
            }
        }
        return $this->render('join', [
            "userJoinForm" => $userJoinForm
        ]);
    } // actionJoin

    public function actionLogin(){
        $userLoginForm = new UserLoginForm();

        if(Yii::$app->request->isPost){
            $userLoginForm->load(Yii::$app->request->post());
            if($userLoginForm->validate()){
                $user = User::findByEmail($userLoginForm->email);

                if($user && $user->validatePassword($userLoginForm->password)){
                    Yii::$app->user->login($user, $userLoginForm->rememberMe * 3600 * 24 * 7);
                    return $this->redirect('/');
                }else{
                    $userLoginForm->addError('password', Yii::t('app', 'Wrong email or password'));
                }
            }
        }
        return $this->render('login', [
            'userLoginForm' => $userLoginForm
        ]);
    } // actionLogin

    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->redirect("/");
    } // actionLogout
}