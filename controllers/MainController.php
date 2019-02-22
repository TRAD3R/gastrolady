<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 15:05
 */
namespace app\controllers;

use app\models\ContactEmailForm;
use Yii;
use yii\web\Controller;

class MainController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    } // actionIndex

    public function action404(){
        return $this->render("error");
    } // action404

    public function actionContact(){
        $contactEmailForm = new ContactEmailForm();

        if(!Yii::$app->user->isGuest){
            $user = Yii::$app->user->identity;
            $contactEmailForm->email = $user->email;
            $contactEmailForm->username = $user->username;
        }

        if(Yii::$app->request->isPost){
            $contactEmailForm->load(Yii::$app->request->post());
            if($contactEmailForm->validate()){
                Yii::$app->mailer->compose()
                    ->setFrom("gastrolady@yandex.ru")
                    ->setTo("rinkashiki89@mail.ru")
                    ->setSubject(Yii::t('app', 'Mail from contact form'))
                    ->setHtmlBody("<p>От: {$contactEmailForm->username}</p><p>E-mail: {$contactEmailForm->email}</p><p>Текст сообщения: <br>{$contactEmailForm->text}</p>")
                    ->send();
                Yii::$app->session->setFlash('info', "Ваше сообщение успешно отправлено");
                return $this->redirect("/");
            }
        }
        return $this->render('contact', [
            'contactEmailForm' => $contactEmailForm
        ]);
    } // actionContact

    public function actionAbout(){
        return $this->render('about');
    } // actionAbout

    public function actionRecaptcha(){
        if(Yii::$app->request->isGet){
            $token  = Yii::$app->request->get('token');
            $secret = '6LfPPYkUAAAAAM5KSe6PdRoMNVlV0J5gzbrk67WA';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$token);
            $responseData = json_decode($verifyResponse);
            if($responseData->success){
                echo "true";
            }else{
                echo "false";
            }
            exit;
        }
    } // actionRecaptcha
}