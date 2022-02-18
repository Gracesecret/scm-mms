<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('currency', function ( $expression ) 
        { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });

        Blade::directive('canany', function ($arguments) {
            list($permissions, $guard) = explode(',', $arguments.',');
        
            $permissions = explode('|', str_replace('\'', '', $permissions));
        
            $expression = "<?php if(auth({$guard})->check() && ( false";
            foreach ($permissions as $permission) {
                $expression .= " || auth({$guard})->user()->can('{$permission}')";
            }
        
            return $expression . ")): ?>";
        });
        
        Blade::directive('endcanany', function () {
            return '<?php endif; ?>';
        });
        //
    }
}
