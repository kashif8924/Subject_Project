<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Repository\UserRepository;
use App\Repositories\Interfaces\SubjectInterface;
use App\Repositories\Repository\SubjectRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(UserInterface::class,UserRepository::class);
        $this->app->bind(SubjectInterface::class,SubjectRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
