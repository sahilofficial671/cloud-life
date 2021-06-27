<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Success
        Blade::directive('alertSuccess', function () {
            $message = '<?php if(session(\'success\')){ ?>';
            $message .= '<div x-data="{ isHidden: false }">';
            $message .= '<div class="bg-green-100 text-green-900 border-green-200 border-2 shadow-md rounded px-2 py-2 flex justify-between items-center pl-6" :class="{\'hidden\': isHidden }">
                                    <div class="message">{{session(\'success\')}}</div>
                                    <button @click="isHidden = ! isHidden" class="inline-flex items-center justify-center p-2 lg:p-0 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500">
                                        <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path :class="{\'hidden\': isHidden }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>';
            $message .= '</div>';
            $message .= '<?php } ?>';

            return $message;
        });

        // Error
        Blade::directive('alertError', function () {
            $message = '<?php if(session(\'error\')){ ?>';
            $message .= '<div x-data="{ isHidden: false }">';
            $message .= '<div class="bg-red-100 text-red-900 border-red-200 border-2 shadow-md rounded px-2 py-2 flex justify-between items-center pl-6" :class="{\'hidden\': isHidden }">
                                    <div class="message">{{session(\'error\')}}</div>
                                    <button @click="isHidden = ! isHidden" class="inline-flex items-center justify-center p-2 lg:p-0 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500">
                                        <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path :class="{\'hidden\': isHidden }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>';
            $message .= '</div>';
            $message .= '<?php } ?>';

            return $message;
        });
    }
}
