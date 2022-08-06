ModelsHistory for Laravel
=====================
### Description
This module logs changes in Models.
Models to observe should be set in config file.
### Install
```
composer require vilija19/modelshistory
```  
```
php artisan migrate
```
Set observing models in `yourAplicationsDIR/config/modelshistory.php`  
If you want to get a history of changes for your model, you need to add this trait to the model:  
`use Vilija19\Modelshistory\ModelsHistoryTrait;`
