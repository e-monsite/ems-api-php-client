<?php

namespace Emonsite\Api\Managers;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;
use Emonsite\Api\Resources\ModelCategoryResponse;
use Emonsite\Api\Resources\ErrorResponse;
use Emonsite\Api\Resources\ModelCategory;

/**
 * SiteModelCategory manager class
 * 
 * @package Emonsite\Api\Managers
 */
class SiteModelCategoryManager 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * SiteModelCategory manager class constructor
	 *
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 */
	public function __construct(ApiClient $apiClient)
	{
		$this->apiClient = $apiClient;
	}

	/**
	 * Return the API client used for this manager requests
	 *
	 * @return ApiClient
	 */
	public function getApiClient()
	{
		return $this->apiClient;
	}

	/**
	 * Get specified model category
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $siteId Site ID
	 * @param string $modelCategoryId Model Item ID
	 * 
	 * @return ModelCategoryResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function get($siteId, $modelCategoryId)
	{
		$routePath = '/api/site/{siteId}/modelCategory/{modelCategoryId}';

		$pathReplacements = [
			'{siteId}' => $siteId,
			'{modelCategoryId}' => $modelCategoryId,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$requestOptions = [];

		$request = $this->apiClient->getHttpClient()->request('get', $routeUrl, $requestOptions);

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

		$response = new ModelCategoryResponse(
			$this->apiClient, 
			new ModelCategory(
				$this->apiClient, 
				$requestBody['data']['id'], 
				$requestBody['data']['site_id'], 
				$requestBody['data']['model_id'], 
				$requestBody['data']['parent_id'], 
				$requestBody['data']['ordering'], 
				$requestBody['data']['published'], 
				$requestBody['data']['masked'], 
				$requestBody['data']['params'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id'], 
				$requestBody['data']['upd_dt'], 
				$requestBody['data']['upd_user_id']
			)
		);

		return $response;
	}
}
