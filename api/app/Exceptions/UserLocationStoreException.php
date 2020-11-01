<?php

namespace App\Exceptions;
use Exception;

class UserLocationStoreException extends Exception
{
	private $errors;

	private $status_code;

	public function __construct($message = null, $status_code = 500, array $errors = [])
	{
		parent::__construct($message ?? "Invalid request", $status_code);

		$this->errors = $errors;
		$this->status_code = $status_code;
	}

	/**
	 * Report the exception.
	 *
	 * @return void
	 */
	public function  report()
	{
		//
	}

	/**
	 * Report the exception.
	 *
	 * @param \Illuminate\Http\Request
	 * @return array
	 */
	public function render($request)
	{
		return response()->json([
			'message' => $this->getMessage(),
			'errors' => $this->errors,
		], $this->status_code);
	}
}