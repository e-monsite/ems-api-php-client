<?php

namespace Emonsite\Api\Managers;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;
use Emonsite\Api\Resources\SiteHasModuleResponse;
use Emonsite\Api\Resources\ErrorResponse;
use Emonsite\Api\Resources\ModelItemListResponse;
use Emonsite\Api\Resources\ModelCategoryListResponse;
use Emonsite\Api\Resources\SiteHasModule;
use Emonsite\Api\Resources\ModelItemBlockLineListResponse;
use Emonsite\Api\Resources\ModelItemBlockLineVersionListResponse;
use Emonsite\Api\Resources\ModelItemBlockLineVersion;
use Emonsite\Api\Resources\Meta;
use Emonsite\Api\Resources\Pagination;
use Emonsite\Api\Resources\ModelItemBlockCellListResponse;
use Emonsite\Api\Resources\ModelItemBlockCell;
use Emonsite\Api\Resources\ModelItemBlockLine;
use Emonsite\Api\Resources\ItemHasCategoryResponse;
use Emonsite\Api\Resources\ItemHasCategory;
use Emonsite\Api\Resources\ItemHasCategoryListResponse;
use Emonsite\Api\Resources\ModelItem;
use Emonsite\Api\Resources\ModelCategory;

/**
 * SiteHasModule manager class
 * 
 * @package Emonsite\Api\Managers
 */
class SiteHasModuleManager 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * SiteHasModule manager class constructor
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
	 * Get specified site has module relationship
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $siteId Site ID
	 * @param string $moduleId Module ID
	 * 
	 * @return SiteHasModuleResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function get($siteId, $moduleId)
	{
		$routePath = '/api/siteHasModule/{siteId},{moduleId}';

		$pathReplacements = [
			'{siteId}' => $siteId,
			'{moduleId}' => $moduleId,
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

		$response = new SiteHasModuleResponse(
			$this->apiClient, 
			new SiteHasModule(
				$this->apiClient, 
				$requestBody['data']['id'], 
				$requestBody['data']['site_id'], 
				$requestBody['data']['module_id'], 
				$requestBody['data']['active'], 
				$requestBody['data']['params'], 
				$requestBody['data']['add_dt']
			)
		);

		return $response;
	}
	
	/**
	 * Site has module model item list
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $siteId Site ID
	 * @param string $moduleId Module ID
	 * @param string $modelId Model ID
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return ModelItemListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getModelItems($siteId, $moduleId, $modelId, $include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/siteHasModule/{siteId},{moduleId}/modelItem/{modelId}';

		$pathReplacements = [
			'{siteId}' => $siteId,
			'{moduleId}' => $moduleId,
			'{modelId}' => $modelId,
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

		$response = new ModelItemListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new ModelItem(
					$this->apiClient, 
					$data['id'], 
					$data['site_id'], 
					((isset($data['modelItemBlockLines']) && !is_null($data['modelItemBlockLines'])) ? (new ModelItemBlockLineListResponse(
						$this->apiClient, 
						array_map(function($data) {
							return new ModelItemBlockLine(
								$this->apiClient, 
								$data['id'], 
								$data['item_id'], 
								$data['css_class'], 
								$data['css_id'], 
								$data['css_style'], 
								$data['height'], 
								$data['position'], 
								$data['pagination'], 
								((isset($data['modelItemBlockLineVersions']) && !is_null($data['modelItemBlockLineVersions'])) ? (new ModelItemBlockLineVersionListResponse(
									$this->apiClient, 
									array_map(function($data) {
										return new ModelItemBlockLineVersion(
											$this->apiClient, 
											$data['id'], 
											$data['block_line_id'], 
											$data['lang'], 
											$data['title']
										); 
									}, $requestBody['modelItemBlockLineVersions']['data']), 
									new Meta(
										$this->apiClient, 
										((isset($data['modelItemBlockLineVersions']['meta']['pagination']) && !is_null($data['modelItemBlockLineVersions']['meta']['pagination'])) ? (new Pagination(
											$this->apiClient, 
											$data['modelItemBlockLineVersions']['meta']['pagination']['total'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['count'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['per_page'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['current_page'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['total_pages'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['links']
										)) : null)
									)
								)) : null), 
								((isset($data['modelItemBlockCells']) && !is_null($data['modelItemBlockCells'])) ? (new ModelItemBlockCellListResponse(
									$this->apiClient, 
									array_map(function($data) {
										return new ModelItemBlockCell(
											$this->apiClient, 
											$data['id'], 
											$data['block_line_id'], 
											$data['width'], 
											$data['content_type'], 
											$data['widget_id'], 
											$data['css_class'], 
											$data['css_id'], 
											$data['css_style'], 
											$data['position']
										); 
									}, $requestBody['modelItemBlockCells']['data']), 
									new Meta(
										$this->apiClient, 
										((isset($data['modelItemBlockCells']['meta']['pagination']) && !is_null($data['modelItemBlockCells']['meta']['pagination'])) ? (new Pagination(
											$this->apiClient, 
											$data['modelItemBlockCells']['meta']['pagination']['total'], 
											$data['modelItemBlockCells']['meta']['pagination']['count'], 
											$data['modelItemBlockCells']['meta']['pagination']['per_page'], 
											$data['modelItemBlockCells']['meta']['pagination']['current_page'], 
											$data['modelItemBlockCells']['meta']['pagination']['total_pages'], 
											$data['modelItemBlockCells']['meta']['pagination']['links']
										)) : null)
									)
								)) : null)
							); 
						}, $requestBody['modelItemBlockLines']['data']), 
						new Meta(
							$this->apiClient, 
							((isset($data['modelItemBlockLines']['meta']['pagination']) && !is_null($data['modelItemBlockLines']['meta']['pagination'])) ? (new Pagination(
								$this->apiClient, 
								$data['modelItemBlockLines']['meta']['pagination']['total'], 
								$data['modelItemBlockLines']['meta']['pagination']['count'], 
								$data['modelItemBlockLines']['meta']['pagination']['per_page'], 
								$data['modelItemBlockLines']['meta']['pagination']['current_page'], 
								$data['modelItemBlockLines']['meta']['pagination']['total_pages'], 
								$data['modelItemBlockLines']['meta']['pagination']['links']
							)) : null)
						)
					)) : null), 
					((isset($data['mainItemHasCategory']) && !is_null($data['mainItemHasCategory'])) ? (new ItemHasCategoryResponse(
						$this->apiClient, 
						new ItemHasCategory(
							$this->apiClient, 
							$data['mainItemHasCategory']['data']['id'], 
							$data['mainItemHasCategory']['data']['site_id'], 
							$data['mainItemHasCategory']['data']['model_id'], 
							$data['mainItemHasCategory']['data']['item_id'], 
							$data['mainItemHasCategory']['data']['parent_id'], 
							$data['mainItemHasCategory']['data']['ordering'], 
							$data['mainItemHasCategory']['data']['add_dt'], 
							$data['mainItemHasCategory']['data']['add_user_id'], 
							$data['mainItemHasCategory']['data']['upd_dt'], 
							$data['mainItemHasCategory']['data']['upd_user_id']
						)
					)) : null), 
					((isset($data['aliasItemHasCategories']) && !is_null($data['aliasItemHasCategories'])) ? (new ItemHasCategoryListResponse(
						$this->apiClient, 
						array_map(function($data) {
							return new ItemHasCategory(
								$this->apiClient, 
								$data['id'], 
								$data['site_id'], 
								$data['model_id'], 
								$data['item_id'], 
								$data['parent_id'], 
								$data['ordering'], 
								$data['add_dt'], 
								$data['add_user_id'], 
								$data['upd_dt'], 
								$data['upd_user_id']
							); 
						}, $requestBody['aliasItemHasCategories']['data']), 
						new Meta(
							$this->apiClient, 
							((isset($data['aliasItemHasCategories']['meta']['pagination']) && !is_null($data['aliasItemHasCategories']['meta']['pagination'])) ? (new Pagination(
								$this->apiClient, 
								$data['aliasItemHasCategories']['meta']['pagination']['total'], 
								$data['aliasItemHasCategories']['meta']['pagination']['count'], 
								$data['aliasItemHasCategories']['meta']['pagination']['per_page'], 
								$data['aliasItemHasCategories']['meta']['pagination']['current_page'], 
								$data['aliasItemHasCategories']['meta']['pagination']['total_pages'], 
								$data['aliasItemHasCategories']['meta']['pagination']['links']
							)) : null)
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
	 * Site has module model category list
	 * 
	 * You can specify a GET parameter `root`
	 * (return only root categories if `true`, default is `false`)
	 * to filter results.
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $siteId Site ID
	 * @param string $moduleId Module ID
	 * @param string $modelId Model ID
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return ModelCategoryListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getModelCategories($siteId, $moduleId, $modelId, $include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/siteHasModule/{siteId},{moduleId}/modelCategory/{modelId}';

		$pathReplacements = [
			'{siteId}' => $siteId,
			'{moduleId}' => $moduleId,
			'{modelId}' => $modelId,
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

		$response = new ModelCategoryListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new ModelCategory(
					$this->apiClient, 
					$data['id'], 
					$data['site_id'], 
					$data['model_id'], 
					$data['parent_id'], 
					$data['ordering'], 
					$data['published'], 
					$data['masked'], 
					$data['params'], 
					$data['add_dt'], 
					$data['add_user_id'], 
					$data['upd_dt'], 
					$data['upd_user_id']
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
	 * Site model category model item list
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $siteId Site ID
	 * @param string $moduleId Module ID
	 * @param string $modelCategoryId Model Item ID
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return ModelItemListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getModelCategoryModelItems($siteId, $moduleId, $modelCategoryId, $include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/siteHasModule/{siteId},{moduleId}/modelCategory/{modelCategoryId}/modelItem';

		$pathReplacements = [
			'{siteId}' => $siteId,
			'{moduleId}' => $moduleId,
			'{modelCategoryId}' => $modelCategoryId,
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

		$response = new ModelItemListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new ModelItem(
					$this->apiClient, 
					$data['id'], 
					$data['site_id'], 
					((isset($data['modelItemBlockLines']) && !is_null($data['modelItemBlockLines'])) ? (new ModelItemBlockLineListResponse(
						$this->apiClient, 
						array_map(function($data) {
							return new ModelItemBlockLine(
								$this->apiClient, 
								$data['id'], 
								$data['item_id'], 
								$data['css_class'], 
								$data['css_id'], 
								$data['css_style'], 
								$data['height'], 
								$data['position'], 
								$data['pagination'], 
								((isset($data['modelItemBlockLineVersions']) && !is_null($data['modelItemBlockLineVersions'])) ? (new ModelItemBlockLineVersionListResponse(
									$this->apiClient, 
									array_map(function($data) {
										return new ModelItemBlockLineVersion(
											$this->apiClient, 
											$data['id'], 
											$data['block_line_id'], 
											$data['lang'], 
											$data['title']
										); 
									}, $requestBody['modelItemBlockLineVersions']['data']), 
									new Meta(
										$this->apiClient, 
										((isset($data['modelItemBlockLineVersions']['meta']['pagination']) && !is_null($data['modelItemBlockLineVersions']['meta']['pagination'])) ? (new Pagination(
											$this->apiClient, 
											$data['modelItemBlockLineVersions']['meta']['pagination']['total'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['count'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['per_page'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['current_page'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['total_pages'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['links']
										)) : null)
									)
								)) : null), 
								((isset($data['modelItemBlockCells']) && !is_null($data['modelItemBlockCells'])) ? (new ModelItemBlockCellListResponse(
									$this->apiClient, 
									array_map(function($data) {
										return new ModelItemBlockCell(
											$this->apiClient, 
											$data['id'], 
											$data['block_line_id'], 
											$data['width'], 
											$data['content_type'], 
											$data['widget_id'], 
											$data['css_class'], 
											$data['css_id'], 
											$data['css_style'], 
											$data['position']
										); 
									}, $requestBody['modelItemBlockCells']['data']), 
									new Meta(
										$this->apiClient, 
										((isset($data['modelItemBlockCells']['meta']['pagination']) && !is_null($data['modelItemBlockCells']['meta']['pagination'])) ? (new Pagination(
											$this->apiClient, 
											$data['modelItemBlockCells']['meta']['pagination']['total'], 
											$data['modelItemBlockCells']['meta']['pagination']['count'], 
											$data['modelItemBlockCells']['meta']['pagination']['per_page'], 
											$data['modelItemBlockCells']['meta']['pagination']['current_page'], 
											$data['modelItemBlockCells']['meta']['pagination']['total_pages'], 
											$data['modelItemBlockCells']['meta']['pagination']['links']
										)) : null)
									)
								)) : null)
							); 
						}, $requestBody['modelItemBlockLines']['data']), 
						new Meta(
							$this->apiClient, 
							((isset($data['modelItemBlockLines']['meta']['pagination']) && !is_null($data['modelItemBlockLines']['meta']['pagination'])) ? (new Pagination(
								$this->apiClient, 
								$data['modelItemBlockLines']['meta']['pagination']['total'], 
								$data['modelItemBlockLines']['meta']['pagination']['count'], 
								$data['modelItemBlockLines']['meta']['pagination']['per_page'], 
								$data['modelItemBlockLines']['meta']['pagination']['current_page'], 
								$data['modelItemBlockLines']['meta']['pagination']['total_pages'], 
								$data['modelItemBlockLines']['meta']['pagination']['links']
							)) : null)
						)
					)) : null), 
					((isset($data['mainItemHasCategory']) && !is_null($data['mainItemHasCategory'])) ? (new ItemHasCategoryResponse(
						$this->apiClient, 
						new ItemHasCategory(
							$this->apiClient, 
							$data['mainItemHasCategory']['data']['id'], 
							$data['mainItemHasCategory']['data']['site_id'], 
							$data['mainItemHasCategory']['data']['model_id'], 
							$data['mainItemHasCategory']['data']['item_id'], 
							$data['mainItemHasCategory']['data']['parent_id'], 
							$data['mainItemHasCategory']['data']['ordering'], 
							$data['mainItemHasCategory']['data']['add_dt'], 
							$data['mainItemHasCategory']['data']['add_user_id'], 
							$data['mainItemHasCategory']['data']['upd_dt'], 
							$data['mainItemHasCategory']['data']['upd_user_id']
						)
					)) : null), 
					((isset($data['aliasItemHasCategories']) && !is_null($data['aliasItemHasCategories'])) ? (new ItemHasCategoryListResponse(
						$this->apiClient, 
						array_map(function($data) {
							return new ItemHasCategory(
								$this->apiClient, 
								$data['id'], 
								$data['site_id'], 
								$data['model_id'], 
								$data['item_id'], 
								$data['parent_id'], 
								$data['ordering'], 
								$data['add_dt'], 
								$data['add_user_id'], 
								$data['upd_dt'], 
								$data['upd_user_id']
							); 
						}, $requestBody['aliasItemHasCategories']['data']), 
						new Meta(
							$this->apiClient, 
							((isset($data['aliasItemHasCategories']['meta']['pagination']) && !is_null($data['aliasItemHasCategories']['meta']['pagination'])) ? (new Pagination(
								$this->apiClient, 
								$data['aliasItemHasCategories']['meta']['pagination']['total'], 
								$data['aliasItemHasCategories']['meta']['pagination']['count'], 
								$data['aliasItemHasCategories']['meta']['pagination']['per_page'], 
								$data['aliasItemHasCategories']['meta']['pagination']['current_page'], 
								$data['aliasItemHasCategories']['meta']['pagination']['total_pages'], 
								$data['aliasItemHasCategories']['meta']['pagination']['links']
							)) : null)
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
}
