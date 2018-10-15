<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * SiteHasModule resource class
 * 
 * @package Emonsite\Api\Resources
 */
class SiteHasModule 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $id;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $site_id;

	/**
	 * Format: ems-moduleid.
	 * 
	 * @var string
	 */
	public $module_id;

	/**
	 * @var boolean
	 */
	public $active;

	/**
	 * @var object
	 */
	public $params;

	/**
	 * Format: date-time.
	 * 
	 * @var string
	 */
	public $add_dt;

	/**
	 * SiteHasModule resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $site_id Format: ems-uuid.
	 * @param string $module_id Format: ems-moduleid.
	 * @param boolean $active
	 * @param object $params
	 * @param string $add_dt Format: date-time.
	 */
	public function __construct(ApiClient $apiClient, $id = null, $site_id = null, $module_id = null, $active = null, $params = null, $add_dt = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->site_id = $site_id;
		$this->module_id = $module_id;
		$this->active = $active;
		$this->params = $params;
		$this->add_dt = $add_dt;
	}
	/**
	 * Site has module site has module version list
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return SiteHasModuleVersionListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getSiteHasModuleVersions($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/siteHasModule/{siteId},{moduleId}/version';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{moduleId}' => $this->module_id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

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

		$response = new SiteHasModuleVersionListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new SiteHasModuleVersion(
					$this->apiClient, 
					$data['item_id'], 
					$data['lang'], 
					$data['title'], 
					$data['active'], 
					$data['seo_uri'], 
					$data['params'], 
					$data['category_params'], 
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
