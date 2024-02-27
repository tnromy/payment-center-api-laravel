<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model {
    use HasFactory;


    public static function selectByVillageCode($villageCode) {
        $arr = explode(".", $villageCode);

        $state = location::where('code', $arr[0])->first();
        $city = location::where('code', $arr[0] . "." . $arr[1])->first();
        $district = location::where('code', $arr[0] . "." . $arr[1] . "." . $arr[2])->first();
        $village = location::where('code', $villageCode)->first();

        return compact([
            'state',
            'city',
            'district',
            'village'
        ]);
    }

    public static function states() {
        $states = location::whereRaw( 'CHAR_LENGTH(code) <= 2' )->get();

        return $states;
    }

    public static function cities( $code ) {
        $cities = location::where( 'code', 'like', $code . '.%' )->where( 'code', 'not like', $code . '.%.%' )->get();

        return $cities;
    }

    public static function districts( $code ) {
        $districts = location::where( 'code', 'like', $code . '.%' )->where( 'code', 'not like', $code . '.%.%' )->get();

        return $districts;
    }

    public static function villages( $code ) {
        $villages = location::where( 'code', 'like', $code . '.%' )->get();

        return $villages;
    }
}
