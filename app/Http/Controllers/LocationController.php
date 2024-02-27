<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller {
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
        $states = location::states();

        return response()->json( [
            'status' => [
                'http_status_code' =>200,
                'http_status_message' => 'OK'
            ],
            'result' => $states
        ] );
    }

    public function cities( $code ) {
        $cities = location::cities( $code );

        return response()->json( [
            'status' => [
                'http_status_code' =>200,
                'http_status_message' => 'OK'
            ],
            'result' => $cities
        ] );
    }

    public function districts( $code ) {
        $districts = location::districts( $code );

        return response()->json( [
            'status' => [
                'http_status_code' =>200,
                'http_status_message' => 'OK'
            ],
            'result' => $districts
        ] );
    }

    public function villages( $code ) {
        $villages = location::villages( $code );

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
