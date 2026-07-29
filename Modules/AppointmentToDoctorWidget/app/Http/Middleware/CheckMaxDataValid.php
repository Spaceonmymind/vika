<?php

namespace Modules\AppointmentToDoctorWidget\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckMaxDataValid
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->has('web_app_data') || !$request->has('hash')) {

            return response(['error' => 'Не валидный запрос к виджету, виджет может быть запущен только из MAX'], 403);
        }
        if (!$this->isDataValid($request->get('web_app_data'), $request->get('hash')) &&
            !$this->isDataValid(str_replace('+',' ',$request->get('web_app_data')), $request->get('hash'))){

            return response(['error' => 'Не удалось подтвердить подлинность данных'], 403);
        }

        $webAppData = $this->parseWebAppData($request->get('web_app_data'));

        $request->merge(['web_app_data'=>$webAppData]);

        return $next($request);
    }

    private function isDataValid(string $webAppData, string $hash): bool
    {
        $secret = hash_hmac('sha256',
            config('services.max.token'),
            'WebAppData',
            true);

        $calculatedHash = hash_hmac('sha256',
            $webAppData,
            $secret,
            false);

        return $calculatedHash === $hash;
    }

    private function parseWebAppData(string $webAppData):array
    {
        $parsed=explode("\n",$webAppData);
        $data=[];
         foreach ($parsed as $value) {
             [$key, $val] = explode('=', $value, 2);
             $data[$key] = $val;

             if(json_validate($val)){
                 $data[$key]=json_decode($val,true);
             }
         }

         return $data;
     }
}
