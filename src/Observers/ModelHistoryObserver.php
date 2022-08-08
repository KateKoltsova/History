<?php

namespace Koltsova\History_writer\Observers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Koltsova\History_writer\Models\ModelsHistory;

class ModelHistoryObserver
{
    /**
     * old model to save changes
     * @var Model
     */
    protected static Model $oldModel;

    /**
     * Get old model to save changes
     * @param Model $model
     * @return void
     */
    public function updating(Model $model)
    {
        self::$oldModel = $model;
    }
    public function updated(Model $newModel)
    {
        $fields = $newModel->getAttributes();
        foreach ($fields as $field => $value) {
            $oldValue = self::$oldModel->getOriginal($field);
            $newValue = $value;
            if ($newValue === $oldValue) {
                continue;
            }
            $history = new ModelsHistory();
            $history->field_name = $field;
            $history->field_old_value = $oldValue;
            $history->field_new_value = $newValue;
            if (Auth::check()) {
                $history->user_id = Auth::id();
            }
            $history->historian_id = $newModel->id;
            $history->historian_type = $newModel::class;
            $history->modification_date = Carbon::now();
            $history->save();
        }
    }
}
