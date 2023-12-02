<?php

/**
 * https://github.com/suendri
 * --
 * e-mail : suendri@gmail.com
 * WA     : 62852-6361-6901
 * --
 */

namespace App\Core;

use Kreait\Firebase\Factory;

class Model
{

	protected $factory;
	protected $db;

	public function __construct()
	{

		try {

			$this->factory = (new Factory)->withServiceAccount(FIREBASE_CREDENTIALS)
				->withDatabaseUri(FIREBASE_DATABASE_URL);

			$this->db = $this->factory->createDatabase();
		} catch (Exception $e) {
			die("error! " . $e->getMessage());
		}
	}
}
