<?php
namespace Vilija19\Modelshistory;

trait ModelsHistoryTrait 
{

    public function history()
    {
      return $this->morphMany(ModelsHistory::class,'historyable','entity_type','entity_id');
    }
}