<?php
namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use common\models\User as Utilizador;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $new_password;
    public $confirmpassword;
    /**
     * @var \common\models\User
     */
    private $_utilizador;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        $this->_utilizador = Utilizador::findByPasswordResetToken($token);
        if (!$this->_utilizador) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['new_password', 'required', 'message' => 'É obrigatório preencher a palavra-passe!'],
            ['confirmpassword', 'compare', 'compareAttribute'=>'new_password', 'message'=>"As palavras-passe não combinam!" ],
            ['confirmpassword', 'required', 'message' => 'É obrigatório preencher o confirmar palavra-passe!'],
            ['new_password', 'string', 'min' => 6, 'tooShort' => 'A palavra-passe tem de conter pelo menos 6 carateres!'],
            ['new_password', 'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message' => 'A palavra-passe deve conter pelo menos um carácter minúsculo e maiúsculo e um dígito!'],
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $utilizador = $this->_utilizador;
        $utilizador->setPassword($this->new_password);
        $utilizador->removePasswordResetToken();

        return $utilizador->save(false);
    }
}
