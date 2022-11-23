<?php

namespace App\Http\Controllers\API;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Mockery\CountValidator\Exception;

class UserController extends Controller
{
    public $url = 'https://test.conectadosweb.com.co/users/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $page = 1)
    {
        try {
            if ($request['token']) {
                $token = $request['token'];
                $completeResoure = $this->url . $token;
                $result = Http::get($completeResoure . "?page=$page");
                $result = json_decode($result->getBody()->getContents(), true);
                usort($result, array('App\Helpers\AppHelper', 'date_compare'));
                $totalUsers = count($result);
                $meta = AppHelper::defaultMetaInput($request->only(['page', 'perPage', 'order', 'dir','search']));
                $meta = AppHelper::additionalMeta($meta, $totalUsers);

                if ($meta['perPage'] != '-1') {
                    $meta['offset'] = $meta['perPage'];
                }

                foreach ($result as $key => $value) {
                    $result[$key]['created_at'] = AppHelper::conversionDateTime($value['created_at']);
                    $result[$key]['updated_at'] = AppHelper::conversionDateTime($value['updated_at']);;
                }

                $data = ['result' => $result, 'meta' => $meta, 'token' => $token];
                return view('Users.listUsers',compact('data'));
            } else {
                return response()->json([
                    'message' => 'Token incorrecto'
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Token incorrecto'
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $token, $id)
    {
        try {
            //code...
            if ($token) {
                $clientId = $id;
                $completeResoure = $this->url . $token . '/' . $request->segment(3) . '/' . $clientId;
                $result = Http::get($completeResoure)->json();
                usort($result, array('App\Helpers\AppHelper', 'date_compare'));
                $totalTransactions = count($result);
                $meta = AppHelper::defaultMetaInput($request->only(['page', 'perPage', 'order', 'dir','search']));
                $meta = AppHelper::additionalMeta($meta, $totalTransactions);

                if ($meta['perPage'] != '-1') {
                    $meta['offset'] = $meta['perPage'];
                }
                
                $newDateTime = '';
                
                foreach ($result as $key => $value) {
                    $result[$key]['created_at'] = AppHelper::conversionDateTime($value['created_at']);
                    $result[$key]['updated_at'] = AppHelper::conversionDateTime($value['updated_at']);;
                }
                
                $data = ['result' => $result, 'meta' => $meta, 'clientId' => $clientId];
                return view('Users.transactionsUsers', compact('data'));
            } else {
                return response()->json([
                    'message' => 'Token incorrecto'
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Token incorrecto'
            ], 401);
        }
    }

}
