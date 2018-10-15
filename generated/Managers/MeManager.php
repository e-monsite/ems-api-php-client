<?php

namespace Emonsite\Api\Managers;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;
use Emonsite\Api\Resources\UserResponse;
use Emonsite\Api\Resources\ErrorResponse;
use Emonsite\Api\Resources\SiteListResponse;
use Emonsite\Api\Resources\SiteHasUserListResponse;
use Emonsite\Api\Resources\User;
use Emonsite\Api\Resources\ShardSiteResponse;
use Emonsite\Api\Resources\ShardSite;
use Emonsite\Api\Resources\Site;
use Emonsite\Api\Resources\Meta;
use Emonsite\Api\Resources\Pagination;
use Emonsite\Api\Resources\SiteHasUser;

/**
 * Me manager class
 * 
 * @package Emonsite\Api\Managers
 */
class MeManager 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * Me manager class constructor
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
	 * Get current user
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @return UserResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getUser()
	{
		$routeUrl = '/api/me';

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
	 * Current user Emonsite site list
	 * 
	 * You can specify GET parameters `role`, `site_deleted` and/or `site_suspend` to filter results.
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return SiteListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getSites($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routeUrl = '/api/me/site';

		$queryParameters = [];

		if (!is_null($include)) {
			$queryParameters['include'] = $include;
		}

		if (!is_null($search)) {
			$queryParameters['search'] = $search;
		}

		if (!is_null($page)) {
			$queryParameters['page'] = $page;
		}

		if (!is_null($limit)) {
			$queryParameters['limit'] = $limit;
		}

		if (!is_null($order_by)) {
			$queryParameters['order_by'] = $order_by;
		}

		$requestOptions = [];
		$requestOptions['query'] = $queryParameters;

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

		$response = new SiteListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new Site(
					$this->apiClient, 
					$data['id'], 
					$data['brand_id'], 
					$data['shard_id'], 
					$data['sitename'], 
					$data['host'], 
					$data['site_deleted'], 
					$data['site_suspend'], 
					$data['add_dt'], 
					((isset($data['shardSite']) && !is_null($data['shardSite'])) ? (new ShardSiteResponse(
						$this->apiClient, 
						new ShardSite(
							$this->apiClient, 
							$data['shardSite']['data']['id'], 
							$data['shardSite']['data']['timezone'], 
							$data['shardSite']['data']['activity'], 
							$data['shardSite']['data']['add_dt']
						)
					)) : null)
				); 
			}, $requestBody['data']), 
			new Meta(
				$this->apiClient, 
				((isset($requestBody['meta']['pagination']) && !is_null($requestBody['meta']['pagination'])) ? (new Pagination(
					$this->apiClient, 
					$requestBody['meta']['pagination']['total'], 
					$requestBody['meta']['pagination']['count'], 
					$requestBody['meta']['pagination']['per_page'], 
					$requestBody['meta']['pagination']['current_page'], 
					$requestBody['meta']['pagination']['total_pages'], 
					$requestBody['meta']['pagination']['links']
				)) : null)
			)
		);

		return $response;
	}
	
	/**
	 * Current user Emonsite site has user relationship list
	 * 
	 * You can specify a GET parameter `role` to filter results.
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return SiteHasUserListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getSiteHasUsers($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routeUrl = '/api/me/siteHasUser';

		$queryParameters = [];

		if (!is_null($include)) {
			$queryParameters['include'] = $include;
		}

		if (!is_null($search)) {
			$queryParameters['search'] = $search;
		}

		if (!is_null($page)) {
			$queryParameters['page'] = $page;
		}

		if (!is_null($limit)) {
			$queryParameters['limit'] = $limit;
		}

		if (!is_null($order_by)) {
			$queryParameters['order_by'] = $order_by;
		}

		$requestOptions = [];
		$requestOptions['query'] = $queryParameters;

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

		$response = new SiteHasUserListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new SiteHasUser(
					$this->apiClient, 
					$data['id'], 
					$data['site_id'], 
					$data['user_id'], 
					$data['role'], 
					$data['active'], 
					$data['add_dt']
				); 
			}, $requestBody['data']), 
			new Meta(
				$this->apiClient, 
				((isset($requestBody['meta']['pagination']) && !is_null($requestBody['meta']['pagination'])) ? (new Pagination(
					$this->apiClient, 
					$requestBody['meta']['pagination']['total'], 
					$requestBody['meta']['pagination']['count'], 
					$requestBody['meta']['pagination']['per_page'], 
					$requestBody['meta']['pagination']['current_page'], 
					$requestBody['meta']['pagination']['total_pages'], 
					$requestBody['meta']['pagination']['links']
				)) : null)
			)
		);

		return $response;
	}
}
