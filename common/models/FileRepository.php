<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FileRepository extends Model
{
    const REPO_DIR = 'uploads/';
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['imageFile', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']
        ];
    }

    public function upload()
    {
        $path = self::REPO_DIR . time() . '.' . $this->imageFile->extension;
        if ($this->validate()
            && $this->imageFile->saveAs(\Yii::getAlias('@common/') . $path)) {
            return $path;
        } else {
            return false;
        }
    }
}
