<?php

/**
 * https://github.com/suendri
 * --
 * e-mail : suendri@gmail.com
 * WA     : 62852-6361-6901
 * --
 */

namespace App\Models;

use App\Core\Model;
//use Kreait\Firebase\Contract\Auth as FirebaseAuth;

class Login extends Model
{
     public function proses()
     {

          $email = $_POST['email'];
          $password = $_POST['password'];

          $ref = $this->db->getReference('tb_users')
               ->orderByChild('user_email')->equalTo($email)
               ->getValue();

          $uid = array_key_first($ref);

          $row = $this->db->getReference('tb_users/' . $uid)->getValue() ?? [];

          if (!empty($ref) and password_verify($password, $row['user_password'])) {
               return $row;
          }
     }
}
