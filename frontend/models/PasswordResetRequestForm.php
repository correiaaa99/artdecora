<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User as Utilizador;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required', 'message' => 'É obrigatório preencher o email!'],
            ['email', 'email', 'message' => 'O email não é válido!'],
            ['email', 'exist',
                'targetClass' => '\frontend\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Não existe nenhum utilizador com este email!'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = Utilizador::findOne([
            'status' => Utilizador::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }
        
        if (!Utilizador::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => 'ArtDecora'])
            ->setTo($this->email)
            ->setSubject('Alteração da palavra-passe')
            ->send();
    }
}
