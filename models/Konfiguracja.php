<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 16.02.15
 * Time: 20:12
 */

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Class Konfiguracja
 * @package app\models
 */
class Konfiguracja extends ActiveRecord {

    public static $translateArray = null;

    /**
     * Saves company logo if edited key is 'logo'
     */
    public function handlePictureUpload(){
        if($this->klucz == 'logo'){
            if (UploadedFile::getInstance($this, 'wartosc') != null) {
                if ($this->wartosc != null && $this->wartosc != '' && file_exists('uploads/' . $this->wartosc)) {
                    unlink('uploads/' . $this->wartosc);
                }
                $this->wartosc = UploadedFile::getInstance($this, 'wartosc');
                $this->wartosc->saveAs('uploads/' . $this->wartosc->baseName . '.' . $this->wartosc->extension);
            }
        }
    }

    /**
     * Retrieves config value with specific key
     * @param string $key key of config value
     *
     * @return static $configValue config object
     */
    public function getByKey($key){
        $configValue = Konfiguracja::findOne($key);
        return $configValue;
    }

    /**
     * @param $text
     * @return mixed
     */
    public static function trans($text){
        if(self::$translateArray == null){
            $list = Konfiguracja::find()->all();
            self::$translateArray = array();
            foreach($list as $value){
                self::$translateArray[$value->klucz] = $value->wartosc;
            }
        }
        return (isset(self::$translateArray[$text])) ? self::$translateArray[$text] : $text;
    }
} 