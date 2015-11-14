<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('breadcrumbs', function($expression) {
//            return "echo with{$expression}->format('m/d/Y H:i');
            $expression = \App\Helpers\Helper::substring($expression, 1, 1);
            $expression = \App\Helpers\Helper::stringRemove($expression, "'");
            $params = explode(", ", $expression);
            
            $string = "";
            $arrow = '<i class="fa fa-chevron-right navigation-arrow"></i>';
            for ($i = 0; $i < count($params) - 1; $i += 2) {
                $url = route($params[$i]);
                $title = $params[$i + 1];
                $string .= "<a href='$url'>$title</a>";

                if (isset($params[$i + 2])) {
                    $string .= $arrow;
                }
            }
            $string .= $params[count($params) - 1];

//            return "< ? php echo with{$string}; ;
            return $string;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
