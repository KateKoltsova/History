<?php

namespace Koltsova\History_writer\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

/**
 * @property int $id
 * @property string $field_name
 * @property string $field_old_value
 * @property string $field_new_value
 * @property int $user_id
 * @property int $historian_id
 * @property string $historian_type
 * @property DateTime $modification_date
 *
 */
class ModelsHistory extends Model
{
    protected $table = 'models_history';

    public function historiable()
    {
        return $this->morphTo();
    }
}