<?php

namespace frontend\models;
use yii\web\IdentityInterface;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tbl_user".
 *
 * @property int $idUser
 * @property string $username
 * @property string $name
 * @property string $surname
 * @property string $photo
 * @property string $birth_date
 * @property string $telephone
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 *
 * @property TblAddress[] $tblAddresses
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    public $password;
    public $confirmarpassword;
    public $file;
    public $verifyCode;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            ['username', 'trim'],
            ['username', 'required', 'message' => 'É obrigatório preencher o username!'],
            ['username', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'Este username já existe!'],
            ['username', 'string', 'max' => 255],
            ['name', 'trim'],
            ['surname', 'trim'],
            ['email', 'trim'],
            ['birth_date', 'trim'],
            ['telephone', 'trim'],
            ['email', 'required', 'message' => 'É obrigatório preencher o email!'],
            ['email', 'email', 'message' => 'O email não é válido!'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'Este email já existe!'],
            ['password', 'required', 'message' => 'É obrigatório preencher a palavra-passe!'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'A palavra-passe tem de conter pelo menos 6 carateres!'],
            ['password', 'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message' => 'A palavra-passe deve conter pelo menos um carácter minúsculo e maiúsculo e um dígito!'],
            ['confirmarpassword', 'required', 'message' => 'É obrigatório preencher o confirmar palavra-passe!'],
            ['confirmarpassword', 'compare', 'compareAttribute'=>'password', 'message'=>"As palavras-passe não combinam!" ],
            ['photo', 'trim'],
            [['file'], 'file', 'extensions' => 'png, jpg, jpeg'],
            ['verifyCode', 'captcha', 'message' => 'O código de verificação está incorreto!'],
        ];
    } 
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUser' => 'Id User',
            'username' => 'Username',
            'name' => 'Name',
            'surname' => 'Surname',
            'file' => 'Photo',
            'birth_date' => 'Birth Date',
            'telephone' => 'Telephone',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['idUser' => 'idUser']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdeaBook()
    {
        return $this->hasMany(IdeaBook::className(), ['idUser' => 'idUser']);
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['idUser' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }
    public function beforeSave($insert)
    {         
        if (parent::beforeSave($insert)) 
        {             
            if ($this->isNewRecord) 
            {                      
                $this->setPassword($this->password);
                $this->auth_key = \Yii::$app->security->generateRandomString();            
                $this->created_at = time();    
            }
            else
            {
                if (!empty($this->password))
                {
                    $this->setPassword($this->password);
                } else 
                {
                    $this->password_hash = (string) $this->getOldAttribute('password_hash');
                }      
            }                         
            $this->updated_at = time();            
            return true;         
        }
        return false;   
    }

}
