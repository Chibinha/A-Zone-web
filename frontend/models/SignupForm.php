<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Profile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $firstName;
    public $lastName;
    public $phone;
    public $address;
    public $nif;
    public $postal_code;
    public $city;
    public $country;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Introduza um username.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este username já foi registado.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Introduza o seu e-mail.'],
            ['email', 'email', 'message' => 'Introduza um e-mail válido.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este e-mail já foi registado.'],

            ['password', 'required', 'message' => 'Introduza uma password.'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['firstName', 'trim'],
            ['firstName', 'required', 'message' => 'Introduza o seu nome.'],
            ['firstName', 'string', 'max' => 30, 
            'tooLong' => 'Nome demasiado longo (30 caracteres), arranje outro'
            ],

            ['lastName', 'trim'],
            ['lastName', 'required', 'message' => 'Introduza o seu apelido.'],
            ['lastName', 'string', 'max' => 30, 
            'tooLong' => 'Nome demasiado longo (30 caracteres), arranje outro'
            ],

            ['nif', 'trim'],
            ['nif', 'required', 'message' => 'Introduza o seu nif.'],
            ['nif', 'integer', 'message' => 'NIF incorreto.'],
            ['nif', 'unique', 'targetClass' => '\common\models\Profile', 'message' => 'NIF já registado.'],
            ['nif', 'string', 'min' => 9, 'max' => 9, 
                'tooShort' => 'O NIF tem que ter 9 dígitos.', 
                'tooLong' => 'O NIF tem que ter 9 dígitos.'
            ],
            
            ['phone', 'integer', 'message' => 'Número de telefone incorreto.'],
            ['phone', 'required', 'message' => 'Introduza o seu número de telefone.'],
            ['phone', 'string', 'min' => 9, 'max' => 9, 
                'tooShort' => 'O número de telefone tem que ter 9 dígitos.', 
                'tooLong' => 'O número de telefone tem que ter 9 dígitos.'
            ],

            ['address', 'trim'],
            ['address', 'required', 'message' => 'Introduza a sua morada.'],
            ['address', 'string', 'max' => 255, 
            'tooLong' => 'A morada não pode exceder os 255 digitos.'
            ],

            ['postal_code', 'trim'],
            ['postal_code', 'required', 'message' => 'Introduza o seu código de postal.'],
            ['postal_code', 'string', 'min' => 4, 'max' => 8, 
            'tooShort' => 'O código de postal tem no mínimo 4 digitos.',
            'tooLong' => 'O código de postal não pode exceder os 8 digitos.'
            ],

            ['city', 'trim'],
            ['city', 'required', 'message' => 'Introduza a sua cidade.'],
            ['city', 'string', 'max' => 50, 
            'tooLong' => 'O nome da cidade não pode exceder os 50 digitos,vai ter que se mudar.'
            ],

            ['country', 'trim'],
            ['country', 'required', 'message' => 'Introduza o seu país.'],
            ['country', 'string', 'min' => 4, 'max' => 100, 
            'tooShort' => 'Não existem paises com nomes menores que 4 digitos.',
            'tooLong' => 'O nome do país não pode exceder os 100 digitos, vai ter que se mudar.'
            ],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();

        $profile = new Profile();
        $profile->firstName = $this->firstName;
        $profile->lastName = $this->lastName;
        $profile->phone = $this->phone;
        $profile->address = $this->address;
        $profile->nif = $this->nif;
        $profile->postal_code = $this->postal_code;
        $profile->city = $this->city;
        $profile->country = $this->country;
        $profile->id_user = $user->id;
        return $profile->save();
    }
}
