<?php

namespace app\controllers;

use app\models\OfferDiscount;
use app\models\Package;
use app\models\School;
use app\models\Sections;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'index' => ['get', 'post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            $model = new OfferDiscount(Yii::$app->request->post());
            if (!$model->save()) {
                Yii::error($model->errors, __METHOD__);
            }
        }
        $packages = [];
        $aliases = Sections::getAliases();
        foreach ($aliases as $sectionId => $alias) {
            $packages[$sectionId] = Package::find()
                                                ->andWhere(['section' => $sectionId])
                                                ->orderBy('sort_index')
                                                ->cache(60)
                                                ->all();
        }

        $this->layout = false;
        return $this->render('index', [
            'sections' => Sections::getList(),
            'sectionsAliases' => $aliases,
            'packages' => $packages,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Lists all School models.
     * @return mixed
     */
    public function actionSchoolList()
    {
        $list = School::find()->all();
        if (count($list) > 0) {
            foreach ($list as $item) {
                $out[] = ['title' => $item['title'], 'info' => $item['info'], 'lat' => $item['lat'], 'lng' => $item['lng'],];
            }
            // Shows how you can preselect a value
            return Json::encode(['output' => $out]);
        }
    }
}
