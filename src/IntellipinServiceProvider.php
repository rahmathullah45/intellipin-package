<?php

namespace Rahmat\Intellipin;

use Illuminate\Support\ServiceProvider;

class IntellipinServiceProvider extends ServiceProvider{

    public function boot(){
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register(){

    }
}

?>