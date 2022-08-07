<?php

namespace Vilija19\Modelshistory;

/**
 * UpdateModelLogger
 * This class is used to log changes in models.
 * If you want to get history of changes for your models, you need add this trait to model:
 * use Vilija19\Modelshistory\ModelsHistoryTrait;
 */

class UpdateModelLogger
{
    /**
     * @var Object $event
     * @return void
     */
    public function handle(\Illuminate\Database\Eloquent\Model $event)
    {
        $changes = $event->getDirty();
        if (!$changes) {
            return;
        }

        $transaction_id = time();

        foreach ($changes as $attribute_name => $value) {
            $historyLogger = new ModelsHistory();
            if (in_array($attribute_name, ['updated_at', 'created_at'])) {
                continue;
            }

            $historyLogger->entity_type = get_class($event);
            $historyLogger->entity_id = $event->id;
            $historyLogger->field_name = $attribute_name;
            $historyLogger->old_content = $event->getOriginal($attribute_name);
            $historyLogger->new_content = $value;
            $historyLogger->user_id = auth()->id() ?? 0;
            $historyLogger->transaction_id = $transaction_id;
            $historyLogger->save();
        }

        return;
    }
}

