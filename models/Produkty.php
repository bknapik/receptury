<?php
/**
 * Created by PhpStorm.
 * User: knapi_000
 * Date: 15.02.15
 * Time: 11:55
 */

namespace app\models;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Produkty  extends ActiveRecord{

    public $file_rem = 0;

    public static function tableName(){
        return 'produkty';
    }

    public function rules()
    {
        return [
            [['grafika'], 'file'],
        ];
    }
} 