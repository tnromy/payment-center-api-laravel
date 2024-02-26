<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model {
    use HasFactory;

    protected $table = 'lokasi';
    protected $primaryKey = 'lokasi_id';

    public static function selectByVillageCode($villageCode) {
        $arr = explode(".", $villageCode);

        $state = lokasi::where('lokasi_kode', $arr[0])->first();
        $city = lokasi::where('lokasi_kode', $arr[0] . "." . $arr[1])->first();
        $district = lokasi::where('lokasi_kode', $arr[0] . "." . $arr[1] . "." . $arr[2])->first();
        $village = lokasi::where('lokasi_kode', $villageCode)->first();

        return compact([
            'state',
            'city',
            'district',
            'village'
        ]);
    }

    public static function states() {
        $states = lokasi::whereRaw( 'CHAR_LENGTH(lokasi_kode) <= 2' )->get();

        return $states;
    }

    public static function cities( $lokasi_kode ) {
        $cities = lokasi::where( 'lokasi_kode', 'like', $lokasi_kode . '.%' )->where( 'lokasi_kode', 'not like', $lokasi_kode . '.%.%' )->get();

        return $cities;
    }

    public static function districts( $lokasi_kode ) {
        $districts = lokasi::where( 'lokasi_kode', 'like', $lokasi_kode . '.%' )->where( 'lokasi_kode', 'not like', $lokasi_kode . '.%.%' )->get();

        return $districts;
    }

    public static function villages( $lokasi_kode ) {
        $villages = lokasi::where( 'lokasi_kode', 'like', $lokasi_kode . '.%' )->get();

        return $villages;
    }
}
