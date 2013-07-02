<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('ProductTableSeeder');
		$this->call('CategoryTableSeeder');
		$this->call('CategoryProductTableSeeder');
	}

}