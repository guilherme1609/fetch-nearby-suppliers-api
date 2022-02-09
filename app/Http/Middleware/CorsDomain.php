<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\DB;

class CorsDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('OPTIONS')) {
            return response()->json(null, 200)->header(
                'Access-Control-Allow-Methods',
                'HEAD, GET, POST, PUT, PATCH, DELETE'
            )
                ->header(
                    'Access-Control-Allow-Headers',
                    $request->header('Access-Control-Request-Headers')
                )
                ->header('Access-Control-Allow-Origin', '*');
        }
        DB::beginTransaction();
        $response =  $next($request);
        $responseJson = json_decode($response->content());
        if ($response->getStatusCode() == 200 && isset($responseJson->success) && $responseJson->success == true) {
            DB::commit();
        } else {
            DB::rollback();
        }

        return $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'))
            ->header('Access-Control-Allow-Origin', '*');
    }
}
