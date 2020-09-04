<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class FirebaseController extends AnotherClass
{
	public function sendAll(Request $request) {

		dd($request->all());
	}
}