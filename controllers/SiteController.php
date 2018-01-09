<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\LinkForm;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'link', 'profile', 'signup'],
                'rules' => [
                    [
                        'actions' => ['logout', 'link', 'profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
        return $this->render('index');
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
            return $this->redirect(['site/link']);
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

    public function actionSignup()
    {
        $model = new SignupForm();

        $model->loadReferal(Yii::$app->request->get('partnerLink'));

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['site/link']);
                }
            }
        }

        return $this->render('signup', [
                'model' => $model,
        ]);
    }

    public function actionLink()
    {
        $linkForm = new LinkForm();

        if ($linkForm->load(Yii::$app->request->post())) {
            $linkForm->generateLink();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => \Yii::$app->user->identity->getLinks(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('link', [
                'linkForm' => $linkForm,
                'dataProvider' => $dataProvider
        ]);
    }

    public function actionProfile()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => \Yii::$app->user->identity->getReferals(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        
        return $this->render('profile', [
                'dataProvider' => $dataProvider,
                'parentReferal' => Yii::$app->user->identity->parentReferal
        ]);
    }
}
