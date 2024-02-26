<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;

class LokasiController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function states() {
        $states = lokasi::states();

        return response()->json( [
            'status' => [
                'http_status_code' =>200,
                'http_status_message' => 'OK'
            ],
            'result' => $states
        ] );
    }

    public function cities( $lokasi_kode ) {
        $cities = lokasi::cities( $lokasi_kode );

        return response()->json( [
            'status' => [
                'http_status_code' =>200,
                'http_status_message' => 'OK'
            ],
            'result' => $cities
        ] );
    }

    public function districts( $lokasi_kode ) {
        $districts = lokasi::districts( $lokasi_kode );

        return response()->json( [
            'status' => [
                'http_status_code' =>200,
                'http_status_message' => 'OK'
            ],
            'result' => $districts
        ] );
    }

    public function villages( $lokasi_kode ) {
        $villages = lokasi::villages( $lokasi_kode );

        return response()->json( [
            'status' => [
                'http_status_code' =>200,
                'http_status_message' => 'OK'
            ],
            'result' => $villages
        ] );
    }

    public function store( Request $request ) {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        //
    }
}
