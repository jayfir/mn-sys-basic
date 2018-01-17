<?php

namespace jayfir\basics\common\models;

use yii;
use yii\db\ActiveRecord;

/**
 * @filename BaseModel.php
 * 
 * @encoding UTF-8
 * @author jinhuiZhang <chinhui@coderfarmer.com>
 * @datetime 2018-1-17 17:19:18
 */
class BaseModel extends ActiveRecord
{

    public function getOneError()
    {
        $errors = $this->getFirstErrors();
        return isset(array_values($errors)[0]) ? array_values($errors)[0] : "";
    }

}
