<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/inicio';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
            
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/Notas/notas-route.php'));
            
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/Bitacoras/bitacoras-route.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/Categorias/categorias-route.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/Compras/compras-route.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/Inicio/inicio-route.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/Nacionalidades/nacionalidades-route.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/Productos/productos-route.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/proveedores/proveedores-route.php'));
            
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/Permisos/permiso-route.php'));
            
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/Roles/roles-route.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/Stocks/stocks-route.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/Usuarios/usuarios-route.php'));
            
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/Personas/personas-route.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/Web/Ventas/ventas-route.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
