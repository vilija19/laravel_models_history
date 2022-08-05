<?php

namespace Vilija19\Modelshistory;

class UpdateModelLogger
{
    public function handle($event)
    {
        $changes = $event->getDirty();
        if (!$changes) {
            return;
        }

        $transaction_id = time();

        foreach ($changes as $attribute_name => $value) {
            $historyLogger = new ModelsHistory();
            if ($attribute_name == 'updated_at' || $attribute_name == 'created_at') {
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
        /*
        $user = auth()->user();
        $old = $event->oldAttributes;
        $new = $event->newAttributes;
        $fields = array_keys(array_diff_assoc($new, $old));
        foreach ($fields as $field) {
            $model->history()->create([
                'entity_type' => get_class($model),
                'entity_id' => $model->id,
                'field_name' => $field,
                'old_content' => $old[$field],
                'new_content' => $new[$field],
                'user_id' => $user->id,
            ]);
        }
        */
        return true;
    }
}

