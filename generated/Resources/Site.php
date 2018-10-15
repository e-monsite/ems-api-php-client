<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * Site resource class
 * 
 * @package Emonsite\Api\Resources
 */
class Site 
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
	public $brand_id;

	/**
	 * Format: ems-shardid.
	 * 
	 * @var string
	 */
	public $shard_id;

	/**
	 * @var string
	 */
	public $sitename;

	/**
	 * @var string
	 */
	public $host;

	/**
	 * @var boolean
	 */
	public $site_deleted;

	/**
	 * @var boolean
	 */
	public $site_suspend;

	/**
	 * Format: date-time.
	 * 
	 * @var string
	 */
	public $add_dt;

	/**
	 * @var ShardSiteResponse
	 */
	public $shardSite;

	/**
	 * Site resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $brand_id Format: ems-uuid.
	 * @param string $shard_id Format: ems-shardid.
	 * @param string $sitename
	 * @param string $host
	 * @param boolean $site_deleted
	 * @param boolean $site_suspend
	 * @param string $add_dt Format: date-time.
	 * @param ShardSiteResponse $shardSite
	 */
	public function __construct(ApiClient $apiClient, $id = null, $brand_id = null, $shard_id = null, $sitename = null, $host = null, $site_deleted = null, $site_suspend = null, $add_dt = null, $shardSite = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->brand_id = $brand_id;
		$this->shard_id = $shard_id;
		$this->sitename = $sitename;
		$this->host = $host;
		$this->site_deleted = $site_deleted;
		$this->site_suspend = $site_suspend;
		$this->add_dt = $add_dt;
		$this->shardSite = $shardSite;
	}
	/**
	 * Show site site version list
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return SiteVersionListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getSiteVersions($search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/versions';

		$pathReplacements = [
			'{siteId}' => $this->id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

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

		$response = new SiteVersionListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new SiteVersion(
					$this->apiClient, 
					$data['item_id'], 
					$data['lang'], 
					$data['title'], 
					$data['active'], 
					$data['description'], 
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
	
	/**
	 * Show site has module relationship
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return SiteHasModuleListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getSiteHasModules($search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/siteHasModule';

		$pathReplacements = [
			'{siteId}' => $this->id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

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

		$response = new SiteHasModuleListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new SiteHasModule(
					$this->apiClient, 
					$data['id'], 
					$data['site_id'], 
					$data['module_id'], 
					$data['active'], 
					$data['params'], 
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
	
	/**
	 * Site module Pages page item list
	 * 
	 * You can specify a GET parameter `root`
	 * (return only root items if `true`, default is `false`)
	 * to filter results.
	 * 
	 * You can specify a GET parameters `published` and/or `trash` to filter results.
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return PageListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getPages($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/module/pages/model/page';

		$pathReplacements = [
			'{siteId}' => $this->id,
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

		$response = new PageListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new Page(
					$this->apiClient, 
					$data['id'], 
					$data['site_id'], 
					$data['parent_id'], 
					$data['is_pageindex'], 
					$data['published'], 
					$data['publish_from'], 
					$data['trash'], 
					$data['trash_dt'], 
					$data['trash_user_id'], 
					$data['add_dt'], 
					$data['add_user_id'], 
					$data['upd_dt'], 
					$data['upd_user_id'], 
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
					)) : null), 
					(isset($data['item_url']) ? $data['item_url'] : null)
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
	 * Create and store new module Pages page item
	 * 
	 * Excepted HTTP code : 201
	 * 
	 * @param boolean $is_pageindex
	 * @param boolean $published
	 * @param string $parent_id
	 * @param int $publish_from
	 * @param boolean $trash
	 * @param int $trash_dt
	 * @param string $trash_user_id
	 * 
	 * @return PageResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function createPage($is_pageindex, $published, $parent_id = null, $publish_from = null, $trash = null, $trash_dt = null, $trash_user_id = null)
	{
		$routePath = '/api/site/{siteId}/module/pages/model/page';

		$pathReplacements = [
			'{siteId}' => $this->id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$bodyParameters = [];
		$bodyParameters['is_pageindex'] = $is_pageindex;
		$bodyParameters['published'] = $published;

		if (!is_null($parent_id)) {
			$bodyParameters['parent_id'] = $parent_id;
		}

		if (!is_null($publish_from)) {
			$bodyParameters['publish_from'] = $publish_from;
		}

		if (!is_null($trash)) {
			$bodyParameters['trash'] = $trash;
		}

		if (!is_null($trash_dt)) {
			$bodyParameters['trash_dt'] = $trash_dt;
		}

		if (!is_null($trash_user_id)) {
			$bodyParameters['trash_user_id'] = $trash_user_id;
		}

		$requestOptions = [];
		$requestOptions['form_params'] = $bodyParameters;

		$request = $this->apiClient->getHttpClient()->request('post', $routeUrl, $requestOptions);

		if ($request->getStatusCode() != 201) {
			$requestBody = json_decode((string) $request->getBody(), true);

			$apiExceptionResponse = new ErrorResponse(
				$this->apiClient, 
				$requestBody['message'], 
				(isset($requestBody['errors']) ? $requestBody['errors'] : null), 
				(isset($requestBody['status_code']) ? $requestBody['status_code'] : null), 
				(isset($requestBody['debug']) ? $requestBody['debug'] : null)
			);

			throw new UnexpectedResponseException($request->getStatusCode(), 201, $request, $apiExceptionResponse);
		}

		$requestBody = json_decode((string) $request->getBody(), true);

		$response = new PageResponse(
			$this->apiClient, 
			new Page(
				$this->apiClient, 
				$requestBody['data']['id'], 
				$requestBody['data']['site_id'], 
				$requestBody['data']['parent_id'], 
				$requestBody['data']['is_pageindex'], 
				$requestBody['data']['published'], 
				$requestBody['data']['publish_from'], 
				$requestBody['data']['trash'], 
				$requestBody['data']['trash_dt'], 
				$requestBody['data']['trash_user_id'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id'], 
				$requestBody['data']['upd_dt'], 
				$requestBody['data']['upd_user_id'], 
				((isset($requestBody['data']['modelItemBlockLines']) && !is_null($requestBody['data']['modelItemBlockLines'])) ? (new ModelItemBlockLineListResponse(
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
					}, $requestBody['data']['modelItemBlockLines']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['modelItemBlockLines']['meta']['pagination']) && !is_null($requestBody['data']['modelItemBlockLines']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['total'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['count'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['per_page'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['current_page'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['total_pages'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
				((isset($requestBody['data']['mainItemHasCategory']) && !is_null($requestBody['data']['mainItemHasCategory'])) ? (new ItemHasCategoryResponse(
					$this->apiClient, 
					new ItemHasCategory(
						$this->apiClient, 
						$requestBody['data']['mainItemHasCategory']['data']['id'], 
						$requestBody['data']['mainItemHasCategory']['data']['site_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['model_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['item_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['parent_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['ordering'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_user_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_user_id']
					)
				)) : null), 
				((isset($requestBody['data']['aliasItemHasCategories']) && !is_null($requestBody['data']['aliasItemHasCategories'])) ? (new ItemHasCategoryListResponse(
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
					}, $requestBody['data']['aliasItemHasCategories']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['aliasItemHasCategories']['meta']['pagination']) && !is_null($requestBody['data']['aliasItemHasCategories']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['count'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['per_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['current_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total_pages'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
				(isset($requestBody['data']['item_url']) ? $requestBody['data']['item_url'] : null)
			)
		);

		return $response;
	}
	
	/**
	 * Get specified module Pages page item
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $pageId Page ID
	 * 
	 * @return PageResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getPage($pageId)
	{
		$routePath = '/api/site/{siteId}/module/pages/model/page/{pageId}';

		$pathReplacements = [
			'{siteId}' => $this->id,
			'{pageId}' => $pageId,
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

		$response = new PageResponse(
			$this->apiClient, 
			new Page(
				$this->apiClient, 
				$requestBody['data']['id'], 
				$requestBody['data']['site_id'], 
				$requestBody['data']['parent_id'], 
				$requestBody['data']['is_pageindex'], 
				$requestBody['data']['published'], 
				$requestBody['data']['publish_from'], 
				$requestBody['data']['trash'], 
				$requestBody['data']['trash_dt'], 
				$requestBody['data']['trash_user_id'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id'], 
				$requestBody['data']['upd_dt'], 
				$requestBody['data']['upd_user_id'], 
				((isset($requestBody['data']['modelItemBlockLines']) && !is_null($requestBody['data']['modelItemBlockLines'])) ? (new ModelItemBlockLineListResponse(
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
					}, $requestBody['data']['modelItemBlockLines']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['modelItemBlockLines']['meta']['pagination']) && !is_null($requestBody['data']['modelItemBlockLines']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['total'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['count'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['per_page'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['current_page'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['total_pages'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
				((isset($requestBody['data']['mainItemHasCategory']) && !is_null($requestBody['data']['mainItemHasCategory'])) ? (new ItemHasCategoryResponse(
					$this->apiClient, 
					new ItemHasCategory(
						$this->apiClient, 
						$requestBody['data']['mainItemHasCategory']['data']['id'], 
						$requestBody['data']['mainItemHasCategory']['data']['site_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['model_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['item_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['parent_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['ordering'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_user_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_user_id']
					)
				)) : null), 
				((isset($requestBody['data']['aliasItemHasCategories']) && !is_null($requestBody['data']['aliasItemHasCategories'])) ? (new ItemHasCategoryListResponse(
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
					}, $requestBody['data']['aliasItemHasCategories']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['aliasItemHasCategories']['meta']['pagination']) && !is_null($requestBody['data']['aliasItemHasCategories']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['count'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['per_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['current_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total_pages'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
				(isset($requestBody['data']['item_url']) ? $requestBody['data']['item_url'] : null)
			)
		);

		return $response;
	}
	
	/**
	 * Update a specified module Agenda event item
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $eventId Event ID
	 * @param boolean $published
	 * @param string $parent_id
	 * @param int $publish_from
	 * @param int $publish_to
	 * @param string $date_start
	 * @param string $date_end
	 * @param string $hour
	 * @param string $hour_end
	 * @param string $website
	 * @param string $contact
	 * @param string $recurrent
	 * @param boolean $is_recurrent
	 * @param string $recurrent_end
	 * @param string $organizer_id
	 * @param boolean $trash
	 * @param int $trash_dt
	 * @param string $trash_user_id
	 * 
	 * @return EventResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function update($eventId, $published, $parent_id = null, $publish_from = null, $publish_to = null, $date_start = null, $date_end = null, $hour = null, $hour_end = null, $website = null, $contact = null, $recurrent = null, $is_recurrent = null, $recurrent_end = null, $organizer_id = null, $trash = null, $trash_dt = null, $trash_user_id = null)
	{
		$routePath = '/api/site/{siteId}/module/agenda/model/event/{eventId}';

		$pathReplacements = [
			'{siteId}' => $this->id,
			'{eventId}' => $eventId,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$bodyParameters = [];
		$bodyParameters['published'] = $published;

		if (!is_null($parent_id)) {
			$bodyParameters['parent_id'] = $parent_id;
		}

		if (!is_null($publish_from)) {
			$bodyParameters['publish_from'] = $publish_from;
		}

		if (!is_null($publish_to)) {
			$bodyParameters['publish_to'] = $publish_to;
		}

		if (!is_null($date_start)) {
			$bodyParameters['date_start'] = $date_start;
		}

		if (!is_null($date_end)) {
			$bodyParameters['date_end'] = $date_end;
		}

		if (!is_null($hour)) {
			$bodyParameters['hour'] = $hour;
		}

		if (!is_null($hour_end)) {
			$bodyParameters['hour_end'] = $hour_end;
		}

		if (!is_null($website)) {
			$bodyParameters['website'] = $website;
		}

		if (!is_null($contact)) {
			$bodyParameters['contact'] = $contact;
		}

		if (!is_null($recurrent)) {
			$bodyParameters['recurrent'] = $recurrent;
		}

		if (!is_null($is_recurrent)) {
			$bodyParameters['is_recurrent'] = $is_recurrent;
		}

		if (!is_null($recurrent_end)) {
			$bodyParameters['recurrent_end'] = $recurrent_end;
		}

		if (!is_null($organizer_id)) {
			$bodyParameters['organizer_id'] = $organizer_id;
		}

		if (!is_null($trash)) {
			$bodyParameters['trash'] = $trash;
		}

		if (!is_null($trash_dt)) {
			$bodyParameters['trash_dt'] = $trash_dt;
		}

		if (!is_null($trash_user_id)) {
			$bodyParameters['trash_user_id'] = $trash_user_id;
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

		$response = new EventResponse(
			$this->apiClient, 
			new Event(
				$this->apiClient, 
				$requestBody['data']['id'], 
				$requestBody['data']['site_id'], 
				$requestBody['data']['parent_id'], 
				$requestBody['data']['published'], 
				$requestBody['data']['publish_from'], 
				$requestBody['data']['publish_to'], 
				$requestBody['data']['date_start'], 
				$requestBody['data']['date_end'], 
				$requestBody['data']['hour'], 
				$requestBody['data']['hour_end'], 
				$requestBody['data']['website'], 
				$requestBody['data']['contact'], 
				$requestBody['data']['recurrent'], 
				$requestBody['data']['is_recurrent'], 
				$requestBody['data']['recurrent_end'], 
				$requestBody['data']['organizer_id'], 
				$requestBody['data']['trash'], 
				$requestBody['data']['trash_dt'], 
				$requestBody['data']['trash_user_id'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id'], 
				$requestBody['data']['upd_dt'], 
				$requestBody['data']['upd_user_id'], 
				((isset($requestBody['data']['modelItemBlockLines']) && !is_null($requestBody['data']['modelItemBlockLines'])) ? (new ModelItemBlockLineListResponse(
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
					}, $requestBody['data']['modelItemBlockLines']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['modelItemBlockLines']['meta']['pagination']) && !is_null($requestBody['data']['modelItemBlockLines']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['total'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['count'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['per_page'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['current_page'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['total_pages'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
				((isset($requestBody['data']['mainItemHasCategory']) && !is_null($requestBody['data']['mainItemHasCategory'])) ? (new ItemHasCategoryResponse(
					$this->apiClient, 
					new ItemHasCategory(
						$this->apiClient, 
						$requestBody['data']['mainItemHasCategory']['data']['id'], 
						$requestBody['data']['mainItemHasCategory']['data']['site_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['model_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['item_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['parent_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['ordering'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_user_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_user_id']
					)
				)) : null), 
				((isset($requestBody['data']['aliasItemHasCategories']) && !is_null($requestBody['data']['aliasItemHasCategories'])) ? (new ItemHasCategoryListResponse(
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
					}, $requestBody['data']['aliasItemHasCategories']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['aliasItemHasCategories']['meta']['pagination']) && !is_null($requestBody['data']['aliasItemHasCategories']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['count'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['per_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['current_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total_pages'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
				$requestBody['data']['item_url']
			)
		);

		return $response;
	}
	
	/**
	 * Site module Pages page category list
	 * 
	 * You can specify a GET parameter `root`
	 * (return only root categories if `true`, default is `false`)
	 * to filter results.
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return PageCategoryListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getPageCategories($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/module/pages/category/page';

		$pathReplacements = [
			'{siteId}' => $this->id,
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

		$response = new PageCategoryListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new PageCategory(
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
	 * Site module Agenda event item list
	 * 
	 * You can specify a GET parameter `root`
	 * (return only root items if `true`, default is `false`)
	 * to filter results.
	 * 
	 * You can specify a GET parameters `published` and/or `trash` to filter results.
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return EventListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getEvents($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/module/agenda/model/event';

		$pathReplacements = [
			'{siteId}' => $this->id,
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

		$response = new EventListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new Event(
					$this->apiClient, 
					$data['id'], 
					$data['site_id'], 
					$data['parent_id'], 
					$data['published'], 
					$data['publish_from'], 
					$data['publish_to'], 
					$data['date_start'], 
					$data['date_end'], 
					$data['hour'], 
					$data['hour_end'], 
					$data['website'], 
					$data['contact'], 
					$data['recurrent'], 
					$data['is_recurrent'], 
					$data['recurrent_end'], 
					$data['organizer_id'], 
					$data['trash'], 
					$data['trash_dt'], 
					$data['trash_user_id'], 
					$data['add_dt'], 
					$data['add_user_id'], 
					$data['upd_dt'], 
					$data['upd_user_id'], 
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
					)) : null), 
					$data['item_url']
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
	 * Create and store new module Agenda event item
	 * 
	 * Excepted HTTP code : 201
	 * 
	 * @param boolean $published
	 * @param string $parent_id
	 * @param int $publish_from
	 * @param int $publish_to
	 * @param string $date_start
	 * @param string $date_end
	 * @param string $hour
	 * @param string $hour_end
	 * @param string $website
	 * @param string $contact
	 * @param string $recurrent
	 * @param boolean $is_recurrent
	 * @param string $recurrent_end
	 * @param string $organizer_id
	 * @param boolean $trash
	 * @param int $trash_dt
	 * @param string $trash_user_id
	 * 
	 * @return EventResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function createEvent($published, $parent_id = null, $publish_from = null, $publish_to = null, $date_start = null, $date_end = null, $hour = null, $hour_end = null, $website = null, $contact = null, $recurrent = null, $is_recurrent = null, $recurrent_end = null, $organizer_id = null, $trash = null, $trash_dt = null, $trash_user_id = null)
	{
		$routePath = '/api/site/{siteId}/module/agenda/model/event';

		$pathReplacements = [
			'{siteId}' => $this->id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$bodyParameters = [];
		$bodyParameters['published'] = $published;

		if (!is_null($parent_id)) {
			$bodyParameters['parent_id'] = $parent_id;
		}

		if (!is_null($publish_from)) {
			$bodyParameters['publish_from'] = $publish_from;
		}

		if (!is_null($publish_to)) {
			$bodyParameters['publish_to'] = $publish_to;
		}

		if (!is_null($date_start)) {
			$bodyParameters['date_start'] = $date_start;
		}

		if (!is_null($date_end)) {
			$bodyParameters['date_end'] = $date_end;
		}

		if (!is_null($hour)) {
			$bodyParameters['hour'] = $hour;
		}

		if (!is_null($hour_end)) {
			$bodyParameters['hour_end'] = $hour_end;
		}

		if (!is_null($website)) {
			$bodyParameters['website'] = $website;
		}

		if (!is_null($contact)) {
			$bodyParameters['contact'] = $contact;
		}

		if (!is_null($recurrent)) {
			$bodyParameters['recurrent'] = $recurrent;
		}

		if (!is_null($is_recurrent)) {
			$bodyParameters['is_recurrent'] = $is_recurrent;
		}

		if (!is_null($recurrent_end)) {
			$bodyParameters['recurrent_end'] = $recurrent_end;
		}

		if (!is_null($organizer_id)) {
			$bodyParameters['organizer_id'] = $organizer_id;
		}

		if (!is_null($trash)) {
			$bodyParameters['trash'] = $trash;
		}

		if (!is_null($trash_dt)) {
			$bodyParameters['trash_dt'] = $trash_dt;
		}

		if (!is_null($trash_user_id)) {
			$bodyParameters['trash_user_id'] = $trash_user_id;
		}

		$requestOptions = [];
		$requestOptions['form_params'] = $bodyParameters;

		$request = $this->apiClient->getHttpClient()->request('post', $routeUrl, $requestOptions);

		if ($request->getStatusCode() != 201) {
			$requestBody = json_decode((string) $request->getBody(), true);

			$apiExceptionResponse = new ErrorResponse(
				$this->apiClient, 
				$requestBody['message'], 
				(isset($requestBody['errors']) ? $requestBody['errors'] : null), 
				(isset($requestBody['status_code']) ? $requestBody['status_code'] : null), 
				(isset($requestBody['debug']) ? $requestBody['debug'] : null)
			);

			throw new UnexpectedResponseException($request->getStatusCode(), 201, $request, $apiExceptionResponse);
		}

		$requestBody = json_decode((string) $request->getBody(), true);

		$response = new EventResponse(
			$this->apiClient, 
			new Event(
				$this->apiClient, 
				$requestBody['data']['id'], 
				$requestBody['data']['site_id'], 
				$requestBody['data']['parent_id'], 
				$requestBody['data']['published'], 
				$requestBody['data']['publish_from'], 
				$requestBody['data']['publish_to'], 
				$requestBody['data']['date_start'], 
				$requestBody['data']['date_end'], 
				$requestBody['data']['hour'], 
				$requestBody['data']['hour_end'], 
				$requestBody['data']['website'], 
				$requestBody['data']['contact'], 
				$requestBody['data']['recurrent'], 
				$requestBody['data']['is_recurrent'], 
				$requestBody['data']['recurrent_end'], 
				$requestBody['data']['organizer_id'], 
				$requestBody['data']['trash'], 
				$requestBody['data']['trash_dt'], 
				$requestBody['data']['trash_user_id'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id'], 
				$requestBody['data']['upd_dt'], 
				$requestBody['data']['upd_user_id'], 
				((isset($requestBody['data']['modelItemBlockLines']) && !is_null($requestBody['data']['modelItemBlockLines'])) ? (new ModelItemBlockLineListResponse(
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
					}, $requestBody['data']['modelItemBlockLines']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['modelItemBlockLines']['meta']['pagination']) && !is_null($requestBody['data']['modelItemBlockLines']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['total'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['count'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['per_page'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['current_page'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['total_pages'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
				((isset($requestBody['data']['mainItemHasCategory']) && !is_null($requestBody['data']['mainItemHasCategory'])) ? (new ItemHasCategoryResponse(
					$this->apiClient, 
					new ItemHasCategory(
						$this->apiClient, 
						$requestBody['data']['mainItemHasCategory']['data']['id'], 
						$requestBody['data']['mainItemHasCategory']['data']['site_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['model_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['item_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['parent_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['ordering'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_user_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_user_id']
					)
				)) : null), 
				((isset($requestBody['data']['aliasItemHasCategories']) && !is_null($requestBody['data']['aliasItemHasCategories'])) ? (new ItemHasCategoryListResponse(
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
					}, $requestBody['data']['aliasItemHasCategories']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['aliasItemHasCategories']['meta']['pagination']) && !is_null($requestBody['data']['aliasItemHasCategories']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['count'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['per_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['current_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total_pages'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
				$requestBody['data']['item_url']
			)
		);

		return $response;
	}
	
	/**
	 * Get specified module Agenda event item
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $eventId Event ID
	 * 
	 * @return EventResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getEvent($eventId)
	{
		$routePath = '/api/site/{siteId}/module/agenda/model/event/{eventId}';

		$pathReplacements = [
			'{siteId}' => $this->id,
			'{eventId}' => $eventId,
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

		$response = new EventResponse(
			$this->apiClient, 
			new Event(
				$this->apiClient, 
				$requestBody['data']['id'], 
				$requestBody['data']['site_id'], 
				$requestBody['data']['parent_id'], 
				$requestBody['data']['published'], 
				$requestBody['data']['publish_from'], 
				$requestBody['data']['publish_to'], 
				$requestBody['data']['date_start'], 
				$requestBody['data']['date_end'], 
				$requestBody['data']['hour'], 
				$requestBody['data']['hour_end'], 
				$requestBody['data']['website'], 
				$requestBody['data']['contact'], 
				$requestBody['data']['recurrent'], 
				$requestBody['data']['is_recurrent'], 
				$requestBody['data']['recurrent_end'], 
				$requestBody['data']['organizer_id'], 
				$requestBody['data']['trash'], 
				$requestBody['data']['trash_dt'], 
				$requestBody['data']['trash_user_id'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id'], 
				$requestBody['data']['upd_dt'], 
				$requestBody['data']['upd_user_id'], 
				((isset($requestBody['data']['modelItemBlockLines']) && !is_null($requestBody['data']['modelItemBlockLines'])) ? (new ModelItemBlockLineListResponse(
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
					}, $requestBody['data']['modelItemBlockLines']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['modelItemBlockLines']['meta']['pagination']) && !is_null($requestBody['data']['modelItemBlockLines']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['total'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['count'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['per_page'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['current_page'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['total_pages'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
				((isset($requestBody['data']['mainItemHasCategory']) && !is_null($requestBody['data']['mainItemHasCategory'])) ? (new ItemHasCategoryResponse(
					$this->apiClient, 
					new ItemHasCategory(
						$this->apiClient, 
						$requestBody['data']['mainItemHasCategory']['data']['id'], 
						$requestBody['data']['mainItemHasCategory']['data']['site_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['model_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['item_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['parent_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['ordering'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_user_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_user_id']
					)
				)) : null), 
				((isset($requestBody['data']['aliasItemHasCategories']) && !is_null($requestBody['data']['aliasItemHasCategories'])) ? (new ItemHasCategoryListResponse(
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
					}, $requestBody['data']['aliasItemHasCategories']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['aliasItemHasCategories']['meta']['pagination']) && !is_null($requestBody['data']['aliasItemHasCategories']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['count'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['per_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['current_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total_pages'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
				$requestBody['data']['item_url']
			)
		);

		return $response;
	}
	
	/**
	 * Site module Agenda event category list
	 * 
	 * You can specify a GET parameter `root`
	 * (return only root categories if `true`, default is `false`)
	 * to filter results.
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return EventCategoryListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getEventCategories($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/module/agenda/category/event';

		$pathReplacements = [
			'{siteId}' => $this->id,
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

		$response = new EventCategoryListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new EventCategory(
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
	 * Site module Album image item list
	 * 
	 * You can specify a GET parameter `root`
	 * (return only root items if `true`, default is `false`)
	 * to filter results.
	 * 
	 * You can specify a GET parameters `published` and/or `trash` to filter results.
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return ImageListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getImages($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/module/album/model/image';

		$pathReplacements = [
			'{siteId}' => $this->id,
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

		$response = new ImageListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new Image(
					$this->apiClient, 
					$data['id'], 
					$data['site_id'], 
					$data['parent_id'], 
					$data['published'], 
					$data['publish_from'], 
					$data['storageserver_id'], 
					$data['privatefilepath'], 
					$data['privatefilename'], 
					$data['publicfilepath'], 
					$data['publicfilename'], 
					$data['filesize'], 
					$data['mime'], 
					$data['transaction_id'], 
					$data['cover'], 
					$data['emstorage_id'], 
					$data['trash'], 
					$data['trash_dt'], 
					$data['trash_user_id'], 
					$data['add_dt'], 
					$data['add_user_id'], 
					$data['upd_dt'], 
					$data['upd_user_id'], 
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
					)) : null), 
					$data['item_url'], 
					$data['image_url']
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
	 * Create and store new module Album image item
	 * 
	 * Excepted HTTP code : 201
	 * 
	 * @param boolean $published
	 * @param string $file Format: binary.
	 * @param boolean $cover
	 * @param string $parent_id
	 * @param int $publish_from
	 * @param boolean $trash
	 * @param int $trash_dt
	 * @param string $trash_user_id
	 * 
	 * @return ImageResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function createImage($published, $file, $cover, $parent_id = null, $publish_from = null, $trash = null, $trash_dt = null, $trash_user_id = null)
	{
		$routePath = '/api/site/{siteId}/module/album/model/image';

		$pathReplacements = [
			'{siteId}' => $this->id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$bodyParameters = [];
		$bodyParameters['published'] = $published;
		$bodyParameters['file'] = $file;
		$bodyParameters['cover'] = $cover;

		if (!is_null($parent_id)) {
			$bodyParameters['parent_id'] = $parent_id;
		}

		if (!is_null($publish_from)) {
			$bodyParameters['publish_from'] = $publish_from;
		}

		if (!is_null($trash)) {
			$bodyParameters['trash'] = $trash;
		}

		if (!is_null($trash_dt)) {
			$bodyParameters['trash_dt'] = $trash_dt;
		}

		if (!is_null($trash_user_id)) {
			$bodyParameters['trash_user_id'] = $trash_user_id;
		}

		$requestOptions = [];
		$requestOptions['form_params'] = $bodyParameters;

		$request = $this->apiClient->getHttpClient()->request('post', $routeUrl, $requestOptions);

		if ($request->getStatusCode() != 201) {
			$requestBody = json_decode((string) $request->getBody(), true);

			$apiExceptionResponse = new ErrorResponse(
				$this->apiClient, 
				$requestBody['message'], 
				(isset($requestBody['errors']) ? $requestBody['errors'] : null), 
				(isset($requestBody['status_code']) ? $requestBody['status_code'] : null), 
				(isset($requestBody['debug']) ? $requestBody['debug'] : null)
			);

			throw new UnexpectedResponseException($request->getStatusCode(), 201, $request, $apiExceptionResponse);
		}

		$requestBody = json_decode((string) $request->getBody(), true);

		$response = new ImageResponse(
			$this->apiClient, 
			new Image(
				$this->apiClient, 
				$requestBody['data']['id'], 
				$requestBody['data']['site_id'], 
				$requestBody['data']['parent_id'], 
				$requestBody['data']['published'], 
				$requestBody['data']['publish_from'], 
				$requestBody['data']['storageserver_id'], 
				$requestBody['data']['privatefilepath'], 
				$requestBody['data']['privatefilename'], 
				$requestBody['data']['publicfilepath'], 
				$requestBody['data']['publicfilename'], 
				$requestBody['data']['filesize'], 
				$requestBody['data']['mime'], 
				$requestBody['data']['transaction_id'], 
				$requestBody['data']['cover'], 
				$requestBody['data']['emstorage_id'], 
				$requestBody['data']['trash'], 
				$requestBody['data']['trash_dt'], 
				$requestBody['data']['trash_user_id'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id'], 
				$requestBody['data']['upd_dt'], 
				$requestBody['data']['upd_user_id'], 
				((isset($requestBody['data']['mainItemHasCategory']) && !is_null($requestBody['data']['mainItemHasCategory'])) ? (new ItemHasCategoryResponse(
					$this->apiClient, 
					new ItemHasCategory(
						$this->apiClient, 
						$requestBody['data']['mainItemHasCategory']['data']['id'], 
						$requestBody['data']['mainItemHasCategory']['data']['site_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['model_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['item_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['parent_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['ordering'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_user_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_user_id']
					)
				)) : null), 
				((isset($requestBody['data']['aliasItemHasCategories']) && !is_null($requestBody['data']['aliasItemHasCategories'])) ? (new ItemHasCategoryListResponse(
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
					}, $requestBody['data']['aliasItemHasCategories']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['aliasItemHasCategories']['meta']['pagination']) && !is_null($requestBody['data']['aliasItemHasCategories']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['count'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['per_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['current_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total_pages'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
				$requestBody['data']['item_url'], 
				$requestBody['data']['image_url']
			)
		);

		return $response;
	}
	
	/**
	 * Get specified module Album image item
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $imageId Image ID
	 * 
	 * @return ImageResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getImage($imageId)
	{
		$routePath = '/api/site/{siteId}/module/album/model/image/{imageId}';

		$pathReplacements = [
			'{siteId}' => $this->id,
			'{imageId}' => $imageId,
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

		$response = new ImageResponse(
			$this->apiClient, 
			new Image(
				$this->apiClient, 
				$requestBody['data']['id'], 
				$requestBody['data']['site_id'], 
				$requestBody['data']['parent_id'], 
				$requestBody['data']['published'], 
				$requestBody['data']['publish_from'], 
				$requestBody['data']['storageserver_id'], 
				$requestBody['data']['privatefilepath'], 
				$requestBody['data']['privatefilename'], 
				$requestBody['data']['publicfilepath'], 
				$requestBody['data']['publicfilename'], 
				$requestBody['data']['filesize'], 
				$requestBody['data']['mime'], 
				$requestBody['data']['transaction_id'], 
				$requestBody['data']['cover'], 
				$requestBody['data']['emstorage_id'], 
				$requestBody['data']['trash'], 
				$requestBody['data']['trash_dt'], 
				$requestBody['data']['trash_user_id'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id'], 
				$requestBody['data']['upd_dt'], 
				$requestBody['data']['upd_user_id'], 
				((isset($requestBody['data']['mainItemHasCategory']) && !is_null($requestBody['data']['mainItemHasCategory'])) ? (new ItemHasCategoryResponse(
					$this->apiClient, 
					new ItemHasCategory(
						$this->apiClient, 
						$requestBody['data']['mainItemHasCategory']['data']['id'], 
						$requestBody['data']['mainItemHasCategory']['data']['site_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['model_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['item_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['parent_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['ordering'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_user_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_user_id']
					)
				)) : null), 
				((isset($requestBody['data']['aliasItemHasCategories']) && !is_null($requestBody['data']['aliasItemHasCategories'])) ? (new ItemHasCategoryListResponse(
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
					}, $requestBody['data']['aliasItemHasCategories']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['aliasItemHasCategories']['meta']['pagination']) && !is_null($requestBody['data']['aliasItemHasCategories']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['count'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['per_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['current_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total_pages'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
				$requestBody['data']['item_url'], 
				$requestBody['data']['image_url']
			)
		);

		return $response;
	}
	
	/**
	 * Site module Album image category list
	 * 
	 * You can specify a GET parameter `root`
	 * (return only root categories if `true`, default is `false`)
	 * to filter results.
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return ImageCategoryListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getImageCategories($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/module/album/category/image';

		$pathReplacements = [
			'{siteId}' => $this->id,
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

		$response = new ImageCategoryListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new ImageCategory(
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
	 * Show site has offer relationship
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return SiteHasOfferListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getSiteHasOffers($search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/siteHasOffer';

		$pathReplacements = [
			'{siteId}' => $this->id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

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

		$response = new SiteHasOfferListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new SiteHasOffer(
					$this->apiClient, 
					$data['id'], 
					$data['site_id'], 
					$data['offer_id'], 
					$data['expiration_date'], 
					$data['offer_added_at'], 
					$data['offer_renewed_at'], 
					$data['domain'], 
					$data['support_user_id']
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
	 * Show site had offer relationship
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return SiteHadOfferListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getSiteHadOffers($search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/siteHadOffer';

		$pathReplacements = [
			'{siteId}' => $this->id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

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

		$response = new SiteHadOfferListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new SiteHadOffer(
					$this->apiClient, 
					$data['id'], 
					$data['site_id'], 
					$data['offer_id'], 
					$data['expiration_date'], 
					$data['domain'], 
					$data['support_user_id']
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
