<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $firstName
 * @property string $lastName
 * @property string|null $phone
 * @property string|null $address
 * @property int|null $nif
 * @property string|null $postal_code
 * @property string|null $city
 * @property string|null $country
 * @property int $id_user
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            
            [['id_user'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],

            ['firstName', 'trim'],
            ['firstName', 'required', 'message' => 'Introduza o seu nome.'],
            ['firstName', 'string', 'min' => 2,'max' => 30, 
            'tooLong' => 'Nome demasiado longo (30 caracteres), arranje outro'
            ],

            ['lastName', 'trim'],
            ['lastName', 'required', 'message' => 'Introduza o seu apelido.'],
            ['lastName', 'string', 'min' => 2,'max' => 30, 
            'tooLong' => 'Nome demasiado longo (30 caracteres), arranje outro'
            ],

            ['nif', 'trim'],
            ['nif', 'integer', 'message' => 'NIF incorreto.'],
            ['nif', 'required', 'message' => 'Introduza o seu NIF.'],
            ['nif', 'unique', 'targetClass' => '\common\models\Profile', 'message' => 'Este NIF já foi registado.'],
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
            ['address', 'string', 'min' => 2, 'max' => 255, 
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
            ['city', 'string', 'min' => 2, 'max' => 50, 
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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'phone' => 'Phone',
            'nif' => 'Nif',
            'address' => 'Address',
            'postal_code' => 'Postal Code',
            'city' => 'City',
            'country' => 'Country',
            'id_user' => 'Id User',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
