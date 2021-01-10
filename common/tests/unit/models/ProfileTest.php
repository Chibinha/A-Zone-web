<?php

namespace common\tests\unit;

use Codeception\Test\Unit;
use common\models\Profile;
use common\models\User;
use common\fixtures\UserFixture;
use common\fixtures\ProfileFixture;

class ProfileTest extends Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user_data.php'
            ],
            'profile' => [
                'class' => ProfileFixture::className(),
                'dataFile' => codecept_data_dir() . 'profile_data.php'
            ],
        ];
    }


    public function testProfileFirstNameTooLong(){        
        $profile = new Profile();
        $profile->firstName = "tooooooooooooooooooooooooooooooooloooooooooooooooong";
        $this->assertFalse($profile->validate(['firstName']));
    }

    public function testProfileFirstNameTooShort(){        
        $profile = new Profile();
        $profile->firstName = "L";
        $this->assertFalse($profile->validate(['firstName']));
    }

    public function testProfileFirstNameNull(){        
        $profile = new Profile();
        $profile->firstName = null;
        $this->assertFalse($profile->validate(['firstName']));
    }

    public function testProfileFirstNameCorrect(){        
        $profile = new Profile();
        $profile->lastName = "João";
        $this->assertTrue($profile->validate(['lastName']));
    }

    public function testProfileLastNameTooLong(){        
        $profile = new Profile();
        $profile->lastName = "tooooooooooooooooooooooooooooooooloooooooooooooooong";
        $this->assertFalse($profile->validate(['lastName']));
    }

    public function testProfileLastNameTooShort(){        
        $profile = new Profile();
        $profile->lastName = "L";
        $this->assertFalse($profile->validate(['lastName']));
    }

    public function testProfileLastNameNull(){        
        $profile = new Profile();
        $profile->lastName = null;
        $this->assertFalse($profile->validate(['lastName']));
    }

    public function testProfileLastNameCorrect(){        
        $profile = new Profile();
        $profile->lastName = "Silva";
        $this->assertTrue($profile->validate(['lastName']));
    }

    public function testProfileNifTooLong(){        
        $profile = new Profile();
        $profile->nif = "12345678910";
        $this->assertFalse($profile->validate(['nif']));
    }

    public function testProfileNifTooShort(){        
        $profile = new Profile();
        $profile->nif = "12345678";
        $this->assertFalse($profile->validate(['nif']));
    }

    public function testProfileNifNull(){        
        $profile = new Profile();
        $profile->nif = null;
        $this->assertFalse($profile->validate(['nif']));
    }

    public function testProfileNifCorrect(){        
        $profile = new Profile();
        $profile->nif = "123456780";
        $this->assertTrue($profile->validate(['nif']));
    }

    public function testProfilePhoneTooLong(){        
        $profile = new Profile();
        $profile->phone = "12345678910";
        $this->assertFalse($profile->validate(['phone']));
    }

    public function testProfilePhoneTooShort(){        
        $profile = new Profile();
        $profile->phone = "12345678";
        $this->assertFalse($profile->validate(['phone']));
    }

    public function testProfilePhoneNull(){        
        $profile = new Profile();
        $profile->phone = null;
        $this->assertFalse($profile->validate(['phone']));
    }

    public function testProfilePhoneCorrect(){        
        $profile = new Profile();
        $profile->address = "123456789";
        $this->assertTrue($profile->validate(['address']));
    }

    public function testProfileAddressTooShort(){        
        $profile = new Profile();
        $profile->address = "L";
        $this->assertFalse($profile->validate(['address']));
    }

    public function testProfileAddressNull(){        
        $profile = new Profile();
        $profile->address = null;
        $this->assertFalse($profile->validate(['address']));
    }

    public function testProfileAddressCorrect(){        
        $profile = new Profile();
        $profile->address = "Rua Doutor Artur Figueiroa Rego";
        $this->assertTrue($profile->validate(['address']));
    }

    public function testProfilePostalCodeTooLong(){        
        $profile = new Profile();
        $profile->postal_code = "2050-0120";
        $this->assertFalse($profile->validate(['postal_code']));
    }

    public function testProfilePostalCodeTooShort(){        
        $profile = new Profile();
        $profile->postal_code = "205";
        $this->assertFalse($profile->validate(['postal_code']));
    }

    public function testProfilePostalCodeNull(){        
        $profile = new Profile();
        $profile->postal_code = null;
        $this->assertFalse($profile->validate(['postal_code']));
    }

    public function testProfilePostalCodeCorrect(){        
        $profile = new Profile();
        $profile->postal_code = "1234-123";
        $this->assertTrue($profile->validate(['postal_code']));
    }

    public function testProfileCityTooLong(){        
        $profile = new Profile();
        $profile->city = "tooooooooooooooooooooooooooooooooloooooooooooooooong";
        $this->assertFalse($profile->validate(['city']));
    }

    public function testProfileCityTooShort(){        
        $profile = new Profile();
        $profile->city = "L";
        $this->assertFalse($profile->validate(['city']));
    }

    public function testProfileCityNull(){        
        $profile = new Profile();
        $profile->city = null;
        $this->assertFalse($profile->validate(['city']));
    }

    public function testProfileCityCorrect(){        
        $profile = new Profile();
        $profile->city = "Leiria";
        $this->assertTrue($profile->validate(['city']));
    }

    public function testProfileCountryTooLong(){        
        $profile = new Profile();
        $profile->country = "toooooooooooooooooooooooooooooooooooooooooooooooooooooooloooooooooooooooooooooooooooooooooooooooooong";
        $this->assertFalse($profile->validate(['country']));
    }

    public function testProfileCountryTooShort(){        
        $profile = new Profile();
        $profile->country = "L";
        $this->assertFalse($profile->validate(['country']));
    }

    public function testProfileCountryNull(){        
        $profile = new Profile();
        $profile->country = null;
        $this->assertFalse($profile->validate(['country']));
    }

    public function testProfileCountryCorrect(){        
        $profile = new Profile();
        $profile->country = "Portugal";
        $this->assertTrue($profile->validate(['country']));
    }

    function testCreatingProfile()
    {
        $this->tester->seeRecord('common\models\User', ['username' => 'bayer.hudson']);
        $user = User::find()->where(['username' => 'bayer.hudson'])->One();

        $profile = new Profile();
        $profile->firstName = "some_firstname";
        $profile->lastName = "some_lastname";
        $profile->phone = "999999999";
        $profile->nif = "999999999";
        $profile->address = "some address";
        $profile->postal_code = "1234-123";
        $profile->city = "Some City";
        $profile->country = "Some Country";
        $profile->id_user = $user->id;
        $profile->save();

        $this->tester->seeRecord('common\models\Profile', ['firstName' => 'some_firstname']);
        $this->tester->seeRecord('common\models\Profile', ['nif' => '999999999']);
        $this->tester->seeRecord('common\models\Profile', ['city' => 'Some City']);
    }

    function testUpdatingProfile()
    {
        $this->tester->seeRecord('common\models\Profile', ['firstName' => 'firstName']);
        $this->tester->seeRecord('common\models\Profile', ['nif' => '123456789']);
        $this->tester->seeRecord('common\models\Profile', ['city' => 'City']);
        
        $prof = Profile::find()->where(['firstName' => 'firstName'])->One();

        $prof->firstName = "ChangeFirstName";
        $prof->nif = "987654321";
        $prof->city = "ChangeCity";
        $prof->save();
        
        $this->tester->dontseeRecord('common\models\Profile', ['firstName' => 'firstName']);
        $this->tester->dontseeRecord('common\models\Profile', ['nif' => '123456789']);
        $this->tester->dontseeRecord('common\models\Profile', ['city' => 'City']);
        $this->tester->seeRecord('common\models\Profile', ['firstName' => 'ChangeFirstName']);
        $this->tester->seeRecord('common\models\Profile', ['nif' => '987654321']);
        $this->tester->seeRecord('common\models\Profile', ['city' => 'ChangeCity']);
    }

    function testDeletingProfile()
    {
        $this->tester->seeRecord('common\models\Profile', ['firstName' => 'firstName']);
        $this->tester->seeRecord('common\models\Profile', ['nif' => '123456789']);
        $this->tester->seeRecord('common\models\Profile', ['city' => 'City']);
        
        $prof = Profile::find()->where(['firstName' => 'firstName'])->One();
        $prof->delete();
        
        $this->tester->dontseeRecord('common\models\Profile', ['firstName' => 'firstName']);
        $this->tester->dontseeRecord('common\models\Profile', ['nif' => '123456789']);
        $this->tester->dontseeRecord('common\models\Profile', ['city' => 'City']);
    }
}
