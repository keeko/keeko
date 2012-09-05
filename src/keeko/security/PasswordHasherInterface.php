<?php
namespace keeko\security;

interface PasswordHasherInterface
{
	/**
	 * Hashes the provided plaintext password and returns the hashed one
	 *
	 * @param string $password
	 * @return string
	 */
	public function hash($password);

	/**
	 * Validates a given plaintext password against the given hashed password
	 *
	 * @param string $password
	 * @param string $hash
	 * @return bool
	*/
	public function validate($password, $hash);
}
