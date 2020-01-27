<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Project;
use frontend\models\User;
use yii\data\Pagination;
use frontend\models\IdeaBook;
use frontend\models\ProjectIdeaBook;
use frontend\models\Category;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
                'class' => 'developit\captcha\CaptchaAction',
                'type' => 'default', // 'numbers', 'letters' or 'default' (contains numbers & letters)
                'minLength' => 4,
                'maxLength' => 4,

            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $livro = new ProjectIdeaBook();
        $dataProjects = Project::find();
        $totalCount = clone $dataProjects;
        $pagination = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => count($totalCount->all()),
        ]);

        $projetos = $totalCount->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('index', [
            'dataProjects' => $projetos,
            'pages' => $pagination,
            'livro' => $livro,
        ]);
    }
    public function actionCategory()
    {   
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $categoria = $data['categoria'];
            $nomeCategoria = $data['nome'];
            $projetos = Project::find()
            ->select('tbl_project.name, tbl_project.idProject, tbl_project.description')
            ->innerJoin('tbl_projectcategory', 'tbl_project.idProject = tbl_projectcategory.idProject')
            ->where(['idCategory' => $categoria])
            ->orderBy('idProject desc')
            ->all();
            if(!empty($projetos))
            {
                $output = '';
                foreach($projetos as $projeto)
                {
                    $idProjeto = $projeto->idProject;
                    foreach($projeto->images as $image)
                    {
                        $imagem = $image->name;
                        break;
                    }
                    $output .= '<div class="col s6 m3">
                        <div class="card">
                            <div class="card-image">
                                <div class="guardar">
                                    <img class="image" style="height:210px;" src="http://backend.test/'.$imagem.'">
                                    <div class="button">';
                                        if (!Yii::$app->user->isGuest) 
                                            $output .= '<div class="middle"><a id="'. $idProjeto .'" style="background-color:rgb(30, 56, 71);" class="waves-effect waves-light btn modal-trigger botao" href="#modal1"><i class="material-icons right">add</i>Guardar</a></div>';
                                        else 
                                            $output .= '<div class="middle"><a onclick="myFunction()" style="background-color:rgb(30, 56, 71);" class="waves-effect waves-light btn"><i class="material-icons right">add</i>Guardar</a></div>';
                                    $output .= '</div>  
                                </div>
                            </div>
                            <div style="height:170px;margin-top:-40px" class="card-content">
                                <p style="font-weight:bold;font-size:20px;">' . $projeto->name . '</p>
                                <p>'. $projeto->description . '</p>
                            </div>
                            <div class="card-action">
                                <a style="color:rgb(30, 56, 71);" href="/project/detalhes?id='. $projeto->idProject . '">Detalhes</a>
                            </div>
                        </div>
                    </div>';
            
                }
                echo $output;
            }
            else
            {
                echo '<div style="background-color:rgb(30, 56, 71);height:80px;border-radius:15px;">
                        <h6 style="text-align:center;color:white;padding:32px;font-weight:600;">Não existem projetos com a categoria <a style="color:rgb(235, 217, 142);">'.$nomeCategoria.'</a></h6>
                    </div>';
            }
        }
    }
    public function actionPrice()
    {   
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $precoMinimo = $data['precoMinimo'];
            $precoMaximo = $data['precoMaximo'];
            $projetos = Project::find()       
            ->where(['between', 'price', $precoMinimo, $precoMaximo])
            ->all();
            if(!empty($projetos))
            {
               $output = '';
                foreach($projetos as $projeto)
                {
                    $idProjeto = $projeto->idProject;
                    foreach($projeto->images as $image)
                    {
                        $imagem = $image->name;
                        break;
                    }
                    $output .= '<div class="col s6 m3">
                        <div class="card">
                            <div class="card-image">
                                <div class="guardar">
                                    <img class="image" style="height:210px;" src="http://backend.test/'.$imagem.'">
                                    <div class="button">';
                                        if (!Yii::$app->user->isGuest) 
                                            $output .= '<div class="middle"><a id="'. $idProjeto .'" style="background-color:rgb(30, 56, 71);" class="waves-effect waves-light btn modal-trigger botao" href="#modal1"><i class="material-icons right">add</i>Guardar</a></div>';
                                        else 
                                            $output .= '<div class="middle"><a onclick="myFunction()" style="background-color:rgb(30, 56, 71);" class="waves-effect waves-light btn"><i class="material-icons right">add</i>Guardar</a></div>';
                                    $output .= '</div>  
                                </div>
                            </div>
                            <div style="height:170px;margin-top:-40px" class="card-content">
                                <p style="font-weight:bold;font-size:20px;">' . $projeto->name . '</p>
                                <p>'. $projeto->description . '</p>
                            </div>
                            <div class="card-action">
                                <a style="color:rgb(30, 56, 71);" href="/project/detalhes?id='. $projeto->idProject . '">Detalhes</a>
                            </div>
                        </div>
                    </div>';
            
                }
                echo $output;
            }
            else
            {
                echo '<div style="background-color:rgb(30, 56, 71);height:80px;border-radius:15px;">
                        <h6 style="text-align:center;color:white;padding:32px;font-weight:600;">Não existem projetos entre o preço <a style="color:rgb(235, 217, 142);">'.$precoMinimo.' €</a> e <a style="color:rgb(235, 217, 142);">'.$precoMaximo.' €</a> </h6>
                    </div>';
            }
        }
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) 
            {
                Yii::$app->session->setFlash('contato', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } 
            else 
            {
                Yii::$app->session->setFlash('errorcontato', 'There was an error sending your message.');
            }
            return $this->redirect(['site/index']); 
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new User(['scenario' => 'create']);
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $model->generateEmailVerificationToken();
                $model->save(false);
                Yii::$app->session->setFlash('success', "Registo");
            } 
            else
            {
                return $this->render('signup', [
                    'model' => $model,
                ]);
            }
            return $this->redirect(['index']);
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('email', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('password', 'New password saved.');
            return $this->redirect('login');
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
