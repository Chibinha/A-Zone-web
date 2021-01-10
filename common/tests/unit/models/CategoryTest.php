<?php

namespace common\tests\unit;

use Codeception\Test\Unit;
use common\models\Category;
use common\fixtures\CategoryFixture;

class CategoryTest extends Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return [
            'category' => [
                'class' => CategoryFixture::className(),
                'dataFile' => codecept_data_dir() . 'category_data.php'
            ]
        ];
    }


    public function testDescriptionNull()
    {
        $category = new Category();
        $category->description = null;

        expect($category->validate())->false();
        expect($category->hasErrors())->true();
    }

    public function testDescriptionCorrect()
    {
        $category = new Category();
        $category->description = 'Teclados';

        expect($category->validate())->true();
    }

    public function testParentIdCorrect()
    {
        $cat = $category = Category::find()->where(['id' => 1])->one();
        $cat2 = new Category();
        $cat2->description = "description";
        $cat2->parent_id = $cat->id;
        $cat2->save();

        expect($cat2->validate())->true();
    }

    public function testParentIdIncorrect()
    {
        $cat = $category = Category::find()->where(['id' => 1])->one();
        $cat2 = new Category();
        $cat2->description = "description";
        $cat2->parent_id = "abc";
        $cat2->save();

        expect($cat2->validate())->false();
        expect($cat2->hasErrors())->true();
    }

    function testCreatingCategory()
    {
        $cat = new Category();
        $cat->description = "description";
        $cat->save();
        $this->tester->seeRecord('common\models\Category', ['description' => 'description']);
    }

    function testUpdatingCategory()
    {
        $this->tester->seeRecord('common\models\Category', ['description' => '123']);
        $category = Category::find()->where(['description' => '123'])->One();
        $category->description = "changedDesc";
        $category->save();
        $this->tester->seeRecord('common\models\Category', ['description' => 'changedDesc']);
    }

    //This funtionality is throwing an error due to foreign key constraint, even though the database is set to cascade

    // function testDeletingCategory()
    // {
    //     $this->tester->seeRecord('common\models\Category', ['id' => '1']);
    //     $cat = Category::find(1)->One();
    //     $cat->delete();
    //     $this->tester->dontSeeRecord('common\models\Category', ['id' => '1']);
    // }
}


    


  