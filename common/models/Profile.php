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
            [['firstName', 'lastName', 'id_user'], 'required'],
            [['nif', 'id_user'], 'integer'],
            [['firstName', 'lastName', 'city'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 255],
            [['postal_code'], 'string', 'max' => 8],
            [['country'], 'string', 'max' => 100],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
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
            'address' => 'Address',
            'nif' => 'Nif',
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
