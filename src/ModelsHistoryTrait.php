<?php
namespace Vilija19\Modelshistory;

trait ModelsHistoryTrait 
{
    /**
     * Get the history for some model.
     * You should add this trait to your model,if you want to get history of changes for your model.
     */
    public function history()
    {
      /**
       * @var Object ModelHistory
       * @var str name of method for getting parent history
       * @var str name of attribute ModelHistory which contains type of relation (model's name).
       *      If you use Conventions, this argument is not necessary.
       * @var str name of attribute ModelHistory which contains id for related model instance
       *      If you use Conventions, this argument is not necessary.
       */
      return $this->morphMany(ModelsHistory::class,'historyable','entity_type','entity_id');
    }
}