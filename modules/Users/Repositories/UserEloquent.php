<?php
namespace Modules\Users\Repositories;

use Modules\Users\Models\User;

class UserEloquent implements UserRepository {
function getUser($email)
{
    return User::where("email", $email)->first();
    
}
function addUser(array $data)
{
   return User::create([
        'firstname' => $data['firstname'],
        'lastname'  => $data['lastname'],
        'email'     => $data['email'],
        'password'  => $data['password'],
        'phone'     => $data['phone'] ?? null,
        'avatar'    => $data['avatar'] ?? null,
    ]);
    
}  
function updateUser($data, $column,$value)
{ 
$allowed = ['firstname', 'lastname', 'phone', 'avatar'];
        $updateData = [];

        foreach ($allowed as $field) {
            if (array_key_exists($field, $data)) {
                $updateData[$field] = $data[$field];
            }
        }
   return User::where($column, $value)->update($updateData);
}
}