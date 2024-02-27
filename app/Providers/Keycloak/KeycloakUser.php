<?php 

namespace App\Providers\Keycloak;


class KeycloakUser
{
    private $decodedToken;
    public $id;
    public $email;
    public $username;
    public $full_name;
    public $phone;
    public $roles;

    public function __construct($decodedToken)
    {
        // dd($decodedToken);
        $this->decodedToken = $decodedToken;
        $this->id = $decodedToken->sub;
        $this->email = $decodedToken->email;
        $this->username = $decodedToken->preferred_username;
        $this->full_name = $decodedToken->name;
        $this->phone = $decodedToken->phone??null;
        $clientId = env('KEYCLOAK_CLIENT_ID');

        $this->roles = $this->decodedToken->resource_access->{$clientId}->roles;
    }

    public function __get($name)
    {
        return $this->decodedToken->$name ?? null;
    }

    public function hasRole($role)
    {
        $clientId = env('KEYCLOAK_CLIENT_ID');

        $roles = $this->decodedToken->resource_access->{$clientId}->roles;
        $explodedRole = explode("|", $role);

        return !empty(array_intersect($explodedRole, $roles));
    }

    // You can add more custom methods as needed

    // Example method:
    // public function getCustomClaim($claimName)
    // {
    //     return $this->decodedToken->$claimName ?? null;
    // }
}