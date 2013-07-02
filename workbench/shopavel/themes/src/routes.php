<?php

/*
|--------------------------------------------------------------------------
| Theme Routes
|--------------------------------------------------------------------------
| 
| These are the basic routes for a theme.
| 
*/

Route::get('/', function()
{
    return Theme::make('index');
});