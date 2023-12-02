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
use Ramsey\Uuid\Rfc4122\UuidV4;

class User extends Model
{

      public function show()
      {
            $ref = $this->db->getReference('tb_users')->getValue() ?? [];

            return $ref;
      }

      public function save()
      {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $full_name = $_POST['full_name'];
            $uuid = UuidV4::uuid4()->toString();

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $data = [
                  'user_id' => $uuid,
                  'user_email' => $email,
                  'user_password' => $password_hash,
                  'user_full_name' => $full_name
            ];

            $this->db->getReference('tb_users/' . $uuid)->set($data);
      }

      public function edit($id)
      {
            $ref = $this->db->getReference('tb_users/' . $id)->getValue() ?? [];

            return $ref;
      }

      public function update()
      {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $full_name = $_POST['full_name'];
            $id = $_POST['id'];

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            if (!empty($password)) {
                  $data = [
                        'user_id' => $id,
                        'user_email' => $email,
                        'user_password' => $password_hash,
                        'user_full_name' => $full_name
                  ];
            } else {
                  $data = [
                        'user_id' => $id,
                        'user_email' => $email,
                        'user_full_name' => $full_name
                  ];
            }

            $this->db->getReference('tb_users/' . $id)->update($data);
      }

      public function delete($id)
      {

            $this->db->getReference('tb_users/' . $id)->remove($id);
      }
}
