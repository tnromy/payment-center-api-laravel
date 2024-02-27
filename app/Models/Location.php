<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model {
    use HasFactory;

    protected $primaryKey = 'location_id';

    public static function selectByVillageCode($villageCode) {
        $arr = explode(".", $villageCode);

        $state = location::where('location_code', $arr[0])->first();
        $city = location::where('location_code', $arr[0] . "." . $arr[1])->first();
        $district = location::where('location_code', $arr[0] . "." . $arr[1] . "." . $arr[2])->first();
        $village = location::where('location_code', $villageCode)->first();

        return compact([
            'state',
            'city',
            'district',
            'village'
        ]);
    }

    public static function states() {
        $states = location::whereRaw( 'CHAR_LENGTH(location_code) <= 2' )->get();

        return $states;
    }

    public static function cities( $location_code ) {
        $cities = location::where( 'location_code', 'like', $location_code . '.%' )->where( 'location_code', 'not like', $location_code . '.%.%' )->get();

        return $cities;
    }

    public static function districts( $location_code ) {
        $districts = location::where( 'location_code', 'like', $location_code . '.%' )->where( 'location_code', 'not like', $location_code . '.%.%' )->get();

        return $districts;
    }

    public static function villages( $location_code ) {
        $villages = location::where( 'location_code', 'like', $location_code . '.%' )->get();

        return $villages;
    }
}
