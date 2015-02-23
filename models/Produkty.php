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

    public function get_formatted($name){
        if($this->{$name} != '' && $this->{$name} != null && $this->{$name} > 0){
            return number_format($this->{$name}, 2, ',',' ');
        } else {
            return '';
        }
    }

    public function getZlPerKg(){
        return (($this->cena_det_brutto > 0) ? number_format($this->cena_det_brutto / $this->masa_netto, 2, ',', ' ') : '');
    }

    public function managePicture(){
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

    public function getRecipesArr(){
        $recipes = Receptury::find()->where('(data_od IS NULL OR data_od <= NOW()) && (data_do IS NULL OR data_do >= NOW())')->all();
        $recipes_arr = array();
        foreach ($recipes as $recipe) {
            $recipes_arr[$recipe->id] = $recipe->nazwa;
        }
        return $recipes_arr;
    }

    public function getVatArr(){
        $vat = Stawki::find()->all();
        $vat_arr = array();
        foreach ($vat as $v) {
            $vat_arr[$v->id] = $v->nazwa;
        }
        return $vat_arr;
    }
} 