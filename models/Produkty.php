<?php
/**
 * Created by PhpStorm.
 * User: kinga
 * Date: 15.02.15
 * Time: 11:55
 */

namespace app\models;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Class Produkty
 * @package app\models
 */
class Produkty  extends ActiveRecord{

    /**
     * @var int informs if the attached graphic file should be removed
     */
    public $file_rem = 0;


    /**
     * Defines rules for validator
     * Overrides method from Model class
     * @return array validation rules
     */
    public function rules()
    {
        return [
            [['grafika'], 'file'],
        ];
    }

    /**
     * Sets default prices and order for new product model
     */
    public function setDefault(){
        $max = Produkty::find()->having('sortowanie = max(sortowanie)')->all();
        if (empty($max)) {
            $this->sortowanie = 1;
        } else {
            $this->sortowanie = $max[0]->sortowanie + 1;
        }
        $this->cena_det_netto = 0;
        $this->cena_det_brutto = 0;
        $this->cena_hurt_netto = 0;
        $this->cena_hurt_brutto = 0;
    }

    /**
     * Formats numeric fields as x xxx,xx
     * @param $name string name of the field to format
     * @return string formatted value of field
     */
    public function getFormatted($name){
        if($this->{$name} != '' && $this->{$name} != null && $this->{$name} > 0){
            return number_format($this->{$name}, 2, ',',' ');
        } else {
            return '';
        }
    }

    /**
     * Count price for 1 kilogram of product and formats it as x xxx,xx
     * @return string formatted price for kilogram
     */
    public function getPLNPerKg(){
        return (($this->cena_det_brutto > 0) ?
            number_format($this->cena_det_brutto / $this->masa_netto, 2, ',', ' ') :
            '');
    }

    /**
     * Saves picture for product
     */
    public function handlePictureUpload(){
        if (UploadedFile::getInstance($this, 'grafika') != null) {
            if ($this->grafika != null && $this->grafika != '') {
                unlink('uploads/' . $this->grafika);
            }
            $this->grafika = UploadedFile::getInstance($this, 'grafika');
            $this->grafika->saveAs('uploads/' . $this->grafika->baseName . '.' . $this->grafika->extension);
        } else if ($this->file_rem == '1') {
            unlink('uploads/' . $this->grafika);
            $this->grafika = null;
        }
    }
} 