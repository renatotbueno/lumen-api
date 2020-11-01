<?php 

namespace App\Providers; 

use App\Repositories\UserLocationRepositoryInterface;
use App\Repositories\Eloquent\UserLocationRepository;
use Illuminate\Support\ServiceProvider; 

/** 
* Class RepositoryServiceProvider 
* @package App\Providers 
*/ 
class RepositoryServiceProvider extends ServiceProvider 
{ 
   /** 
    * Register services. 
    * 
    * @return void  
    */ 
   public function register() 
   { 
       $this->app->bind(UserLocationRepositoryInterface::class, UserLocationRepository::class);
   }
}