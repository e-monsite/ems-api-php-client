<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * ModelItem resource class
 * 
 * @package Emonsite\Api\Resources
 */
class ModelItem 
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
	 * @var ModelItemBlockLineListResponse
	 */
	public $modelItemBlockLines;

	/**
	 * @var ItemHasCategoryResponse
	 */
	public $mainItemHasCategory;

	/**
	 * @var ItemHasCategoryListResponse
	 */
	public $aliasItemHasCategories;

	/**
	 * ModelItem resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $site_id Format: ems-uuid.
	 * @param ModelItemBlockLineListResponse $modelItemBlockLines
	 * @param ItemHasCategoryResponse $mainItemHasCategory
	 * @param ItemHasCategoryListResponse $aliasItemHasCategories
	 */
	public function __construct(ApiClient $apiClient, $id = null, $site_id = null, $modelItemBlockLines = null, $mainItemHasCategory = null, $aliasItemHasCategories = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->site_id = $site_id;
		$this->modelItemBlockLines = $modelItemBlockLines;
		$this->mainItemHasCategory = $mainItemHasCategory;
		$this->aliasItemHasCategories = $aliasItemHasCategories;
	}
	/**
	 * Model item model item version list
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $moduleId Module ID
	 * @param string $modelId Model ID
	 * @param string $itemId Item ID
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return ModelItemVersionListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getModelItemVersions($moduleId, $modelId, $itemId, $include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/modelItem/{siteId},{moduleId},{modelId},{itemId}/version';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{moduleId}' => $moduleId,
			'{modelId}' => $modelId,
			'{itemId}' => $itemId,
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

		$response = new ModelItemVersionListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new ModelItemVersion(
					$this->apiClient, 
					$data['item_id'], 
					$data['lang']
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
