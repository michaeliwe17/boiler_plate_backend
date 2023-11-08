<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\PaginateResource;
use App\Http\Resources\ErrorResource;

class BoilerPlateController extends Controller
{
    public function index()
    {
        try {
            $query = DB::table('public.users')->paginate(5);
            $data = $query->toArray()['data'];

            if ($data) {
                return new PaginateResource(true, 'List data user', $data, $query);
            } else {
                return (new ErrorResource('Mohon maaf data user tidak ditemukan'))->response()->setStatusCode(404);
            }
        } catch (\Throwable $th) {
            return (new ErrorResource('Mohon maaf terjadi kesalahan'))->response()->setStatusCode(500);
            //throw $th;
        }

    }
}
