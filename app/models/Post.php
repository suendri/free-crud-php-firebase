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

class Post extends Model
{

     public function show()
     {

          $ref = $this->db->getReference('tb_posts')->getValue() ?? [];

          return $ref;
     }

     public function optCat()
     {

          $ref = $this->db->getReference('tb_categories')->getValue() ?? [];

          return $ref;
     }

     public function save()
     {

          $post_id_cat = $_POST['post_id_cat'];
          $post_title = $_POST['post_title'];
          $post_text = $_POST['post_text'];
          $uuid = UuidV4::uuid4()->toString();

          $cat = $this->db->getReference('tb_categories/' . $post_id_cat)->getValue();

          $data = [
               'post_id' => $uuid,
               'post_title' => $post_title,
               'post_text' => $post_text,
               'post_categories' => [
                    'cat_id' => $cat['cat_id'],
                    'cat_name' => $cat['cat_name']
               ]

          ];

          $this->db->getReference('tb_posts/' . $uuid)->set($data);
     }

     public function edit($id)
     {

          $ref = $this->db->getReference('tb_posts/' . $id)->getValue() ?? [];

          return $ref;
     }

     public function update()
     {

          $post_id_cat = $_POST['post_id_cat'];
          $post_title = $_POST['post_title'];
          $post_text = $_POST['post_text'];
          $id = $_POST['id'];

          $cat = $this->db->getReference('tb_categories/' . $post_id_cat)->getValue();

          $data = [
               'post_id' => $id,
               'post_title' => $post_title,
               'post_text' => $post_text,
               'post_categories' => [
                    'cat_id' => $cat['cat_id'],
                    'cat_name' => $cat['cat_name']
               ]

          ];

          $this->db->getReference('tb_posts/' . $id)->update($data);
     }

     public function delete($id)
     {

          $this->db->getReference('tb_posts/' . $id)->remove();
     }
}
