<?php

namespace Vilija19\Modelshistory;

use Illuminate\Database\Eloquent\Model;

/**
 * @property bigint $id
 * @property str $entity_type
 * @property bigint $entity_id
 * @property str $field_name
 * @property str $old_content
 * @property str $new_content
 * @property bigint $user_id
 * @property bigint $transaction_id
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */

class ModelsHistory extends Model
{
    /**
     * Get the parent history for some model. 
     */
    public function historyable()
    {
        return $this->morphTo();
    }
    
}
