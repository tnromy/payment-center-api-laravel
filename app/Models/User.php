<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\OrganizationRole;
use Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'user_id';
   protected $keyType = "string";

    protected $fillable = [
        'user_id',
        'username',
        'full_name',
        'email',
        'phone',
        'tel',
            'password',
            'user_remember_me',
            'user_is_active',

            'user_added_by_user_id',
            'user_updated_by_user_id',
            'user_deleted_by_user_id',
            'user_added_by_ip_addr',
            'user_updated_ip_addr',
            'user_deleted_ip_addr',

    ];

    public static function isEmail($string) {
        if (filter_var($string, FILTER_VALIDATE_EMAIL)) {
    return true;
} else {
    return false;
}
    }

    public static function unAuth() {
        return response()->json([
                "status" => [
                    "http_status_code" => 401,
                    "http_status_message" => "Unauthorized"
                ],
                "errors" => "Email, username, NIP or password not match",
            ], 401);
    }

    public static function updateAva($file, $user_id) {
       $path = $file->store('profile');

       $user = user::find($user_id);
       $user->update([
        'ava_path' => $path
       ]);
       
       return $path; 
    }

    public static function getProfileInfo($user_id) {


                $user = \DB::select("SELECT users.*, (SELECT COUNT(organization_roles.organization_id) FROM organization_roles WHERE organization_roles.user_id = users.id AND organization_roles.role_level = 2 AND organization_roles.user_deleted_at IS null) AS managers, (SELECT COUNT(organization_roles.organization_id) FROM organization_roles WHERE organization_roles.user_id = users.id AND organization_roles.role_level = 3 AND organization_roles.user_deleted_at IS null) AS members FROM users WHERE users.id = ". $user_id ." AND users.user_deleted_at IS null")[0];

        $user->ava_path = Storage::url($user->ava_path);

        return $user;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
