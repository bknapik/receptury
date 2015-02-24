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

    /**
     * Saves company logo if edited key is 'logo'
     */
    public function managePicture(){
        if($this->klucz == 'logo'){
            if (UploadedFile::getInstance($this, 'wartosc') != null) {
                if ($this->wartosc != null && $this->wartosc != '') {
                    unlink('uploads/' . $this->wartosc);
                }
                $this->wartosc = UploadedFile::getInstance($this, 'grafika');
                $this->wartosc->saveAs('uploads/' . $this->wartosc->baseName . '.' . $this->wartosc->extension);
            }
        }
    }
} 