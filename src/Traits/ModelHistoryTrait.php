<?php

namespace Koltsova\History_writer\Traits;

use Koltsova\History_writer\Models\ModelsHistory;

trait ModelHistoryTrait
{
    public function history()
    {
        return $this->morphMany(ModelsHistory::class, 'historian');
    }
}