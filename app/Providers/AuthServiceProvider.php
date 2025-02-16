<?php
use App\Models\Book;
use App\Policies\BookPolicy;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider{

        protected $policies = [
            Book::class => BookPolicy::class,
        ];

}