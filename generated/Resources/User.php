<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * User resource class
 * 
 * @package Emonsite\Api\Resources
 */
class User 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * Format: uuid.
	 * 
	 * @var string
	 */
	public $id;

	/**
	 * @var string
	 */
	public $emonsite_user_id;

	/**
	 * Format: uuid.
	 * 
	 * @var string
	 */
	public $user_group_id;

	/**
	 * @var string
	 */
	public $name;

	/**
	 * Format: email.
	 * 
	 * @var string
	 */
	public $email;

	/**
	 * Format: password.
	 * 
	 * @var string
	 */
	public $password;

	/**
	 * @var string
	 */
	public $preferred_language;

	/**
	 * Format: date-time.
	 * 
	 * @var string
	 */
	public $created_at;

	/**
	 * Format: date-time.
	 * 
	 * @var string
	 */
	public $updated_at;

	/**
	 * User resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: uuid.
	 * @param string $emonsite_user_id
	 * @param string $user_group_id Format: uuid.
	 * @param string $name
	 * @param string $email Format: email.
	 * @param string $password Format: password.
	 * @param string $preferred_language
	 * @param string $created_at Format: date-time.
	 * @param string $updated_at Format: date-time.
	 */
	public function __construct(ApiClient $apiClient, $id = null, $emonsite_user_id = null, $user_group_id = null, $name = null, $email = null, $password = null, $preferred_language = null, $created_at = null, $updated_at = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->emonsite_user_id = $emonsite_user_id;
		$this->user_group_id = $user_group_id;
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
		$this->preferred_language = $preferred_language;
		$this->created_at = $created_at;
		$this->updated_at = $updated_at;
	}
	/**
	 * Update a specified user
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $user_group_id
	 * @param string $name
	 * @param string $email Format: email.
	 * @param string $password Format: password.
	 * @param string $emonsite_user_id
	 * @param string $preferred_language
	 * 
	 * @return UserResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function update($user_group_id, $name, $email, $password, $emonsite_user_id = null, $preferred_language = null)
	{
		$routePath = '/api/user/{userId}';

		$pathReplacements = [
			'{userId}' => $this->id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$bodyParameters = [];
		$bodyParameters['user_group_id'] = $user_group_id;
		$bodyParameters['name'] = $name;
		$bodyParameters['email'] = $email;
		$bodyParameters['password'] = $password;

		if (!is_null($emonsite_user_id)) {
			$bodyParameters['emonsite_user_id'] = $emonsite_user_id;
		}

		if (!is_null($preferred_language)) {
			$bodyParameters['preferred_language'] = $preferred_language;
		}

		$requestOptions = [];
		$requestOptions['form_params'] = $bodyParameters;

		$request = $this->apiClient->getHttpClient()->request('patch', $routeUrl, $requestOptions);

		if ($request->getStatusCode() != 200) {
			$requestBody = json_decode((string) $request->getBody(), true);

			$apiExceptionResponse = new ErrorResponse(
				$this->apiClient, 
				$requestBody['message'], 
				(isset($requestBody['errors']) ? $requestBody['errors'] : null), 
				(isset($requestBody['status_code']) ? $requestBody['status_code'] : null), 
				(isset($requestBody['debug']) ? $requestBody['debug'] : null)
			);

			throw new UnexpectedResponseException($request->getStatusCode(), 200, $request, $apiExceptionResponse);
		}

		$requestBody = json_decode((string) $request->getBody(), true);

		$response = new UserResponse(
			$this->apiClient, 
			new User(
				$this->apiClient, 
				$requestBody['data']['id'], 
				(isset($requestBody['data']['emonsite_user_id']) ? $requestBody['data']['emonsite_user_id'] : null), 
				$requestBody['data']['user_group_id'], 
				$requestBody['data']['name'], 
				$requestBody['data']['email'], 
				(isset($requestBody['data']['password']) ? $requestBody['data']['password'] : null), 
				$requestBody['data']['preferred_language'], 
				$requestBody['data']['created_at'], 
				$requestBody['data']['updated_at']
			)
		);

		return $response;
	}
	
	/**
	 * Delete specified user
	 * 
	 * Excepted HTTP code : 204
	 * 
	 * @return ErrorResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function delete()
	{
		$routePath = '/api/user/{userId}';

		$pathReplacements = [
			'{userId}' => $this->id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$requestOptions = [];

		$request = $this->apiClient->getHttpClient()->request('delete', $routeUrl, $requestOptions);

		if ($request->getStatusCode() != 204) {
			$requestBody = json_decode((string) $request->getBody(), true);

			$apiExceptionResponse = new ErrorResponse(
				$this->apiClient, 
				$requestBody['message'], 
				(isset($requestBody['errors']) ? $requestBody['errors'] : null), 
				(isset($requestBody['status_code']) ? $requestBody['status_code'] : null), 
				(isset($requestBody['debug']) ? $requestBody['debug'] : null)
			);

			throw new UnexpectedResponseException($request->getStatusCode(), 204, $request, $apiExceptionResponse);
		}

		$requestBody = json_decode((string) $request->getBody(), true);

		$response = new ErrorResponse(
			$this->apiClient, 
			$requestBody['message'], 
			(isset($requestBody['errors']) ? $requestBody['errors'] : null), 
			(isset($requestBody['status_code']) ? $requestBody['status_code'] : null), 
			(isset($requestBody['debug']) ? $requestBody['debug'] : null)
		);

		return $response;
	}
}
