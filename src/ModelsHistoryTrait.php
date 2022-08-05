<?php

trait ModelsHistoryTrait 
{

    public function history()
    {
      return $this->morphMany(\Vilija19\Modelshistory\ModelsHistory::class,'historyable');
    }
}