<?php
namespace backend\models;

use Yii;
use yii\base\Model;
/**
 * Class LoginForm
 * @package backend\models
 */
class LoginForm extends Model
{

    public $username;
    public $password;
    public $rememberMe = true;

    protected $_user;

    public $verifyCode;

    /**
     * 默认登录失败3次显示验证码
     *
     * @var int
     */
    public $attempts = 3;

    /**
     * 统计登录次数
     *
     * @var
     */
    public $counter;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            ['verifyCode', 'captcha', 'on' => 'captchaRequired'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username'   => '用户名',
            'rememberMe' => '记住我',
            'password'   => '密码',
            'verifyCode' => '验证码',
        ];
    }

    /**
     * @return null|static
     */
    public function getUser()
    {
        if ($this->_user === null)
        {
            $this->_user = Manager::findByUsername($this->username);
        }

        return $this->_user;
    }

    /**
     * 登录
     *
     * @return bool
     */
    public function login()
    {
        if ($this->validate() && Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0))
        {
            Yii::$app->session->remove('loginCaptchaRequired');

            return true;
        }
        else
        {
            $this->counter = Yii::$app->session->get('loginCaptchaRequired') + 1;
            Yii::$app->session->set('loginCaptchaRequired', $this->counter);
            if ($this->counter >= $this->attempts)
            {
                $this->setScenario("captchaRequired");
            }

            return false;
        }
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

}
