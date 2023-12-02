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

class Category extends Model
{

     public function show()
     {

          $ref = $this->db->getReference('tb_categories')->getValue() ?? [];

          return $ref;
     }

     public function save()
     {

          $cat_name = $_POST['cat_name'];
          $uuid = UuidV4::uuid4()->toString();

          $data = [
               'cat_id' => $uuid,
               'cat_name' => $cat_name
          ];

          $this->db->getReference('tb_categories/' . $uuid)->set($data);
     }

     public function edit($id)
     {

          $ref = $this->db->getReference('tb_categories/' . $id)->getValue() ?? [];

          return $ref;
     }

     public function update()
     {

          $cat_name = $_POST['cat_name'];
          $id = $_POST['id'];

          $data = [
               'cat_id' => $id,
               'cat_name' => $cat_name
          ];

          $this->db->getReference('tb_categories/' . $id)->update($data);
     }
}
