<?php

namespace Emonsite\Api\Managers;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;
use Emonsite\Api\Resources\SiteListResponse;
use Emonsite\Api\Resources\ErrorResponse;
use Emonsite\Api\Resources\SiteResponse;
use Emonsite\Api\Resources\ShardSiteResponse;
use Emonsite\Api\Resources\ShardSite;
use Emonsite\Api\Resources\Site;
use Emonsite\Api\Resources\Meta;
use Emonsite\Api\Resources\Pagination;

/**
 * Site manager class
 * 
 * @package Emonsite\Api\Managers
 */
class SiteManager 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * Site manager class constructor
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
	 * Site list
	 * 
	 * You can specify GET parameters `site_deleted` and/or `site_suspend` to filter results.
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return SiteListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function all($search = null, $page = null, $limit = null, $order_by = null)
	{
		$routeUrl = '/api/site';

		$queryParameters = [];

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
	 * Get specified site
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $siteId Site ID
	 * 
	 * @return SiteResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function get($siteId)
	{
		$routePath = '/api/site/{siteId}';

		$pathReplacements = [
			'{siteId}' => $siteId,
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

		$response = new SiteResponse(
			$this->apiClient, 
			new Site(
				$this->apiClient, 
				$requestBody['data']['id'], 
				$requestBody['data']['brand_id'], 
				$requestBody['data']['shard_id'], 
				$requestBody['data']['sitename'], 
				$requestBody['data']['host'], 
				$requestBody['data']['site_deleted'], 
				$requestBody['data']['site_suspend'], 
				$requestBody['data']['add_dt'], 
				((isset($requestBody['data']['shardSite']) && !is_null($requestBody['data']['shardSite'])) ? (new ShardSiteResponse(
					$this->apiClient, 
					new ShardSite(
						$this->apiClient, 
						$requestBody['data']['shardSite']['data']['id'], 
						$requestBody['data']['shardSite']['data']['timezone'], 
						$requestBody['data']['shardSite']['data']['activity'], 
						$requestBody['data']['shardSite']['data']['add_dt']
					)
				)) : null)
			)
		);

		return $response;
	}
}
