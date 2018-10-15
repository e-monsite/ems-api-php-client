<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * Event resource class
 * 
 * @package Emonsite\Api\Resources
 */
class Event 
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
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $parent_id;

	/**
	 * @var boolean
	 */
	public $published;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $publish_from;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $publish_to;

	/**
	 * Format: date.
	 * 
	 * @var string
	 */
	public $date_start;

	/**
	 * Format: date.
	 * 
	 * @var string
	 */
	public $date_end;

	/**
	 * @var string
	 */
	public $hour;

	/**
	 * @var string
	 */
	public $hour_end;

	/**
	 * @var string
	 */
	public $website;

	/**
	 * @var string
	 */
	public $contact;

	/**
	 * @var string
	 */
	public $recurrent;

	/**
	 * @var boolean
	 */
	public $is_recurrent;

	/**
	 * Format: date-time.
	 * 
	 * @var string
	 */
	public $recurrent_end;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $organizer_id;

	/**
	 * @var boolean
	 */
	public $trash;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $trash_dt;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $trash_user_id;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $add_dt;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $add_user_id;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $upd_dt;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $upd_user_id;

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
	 * Format: uri.
	 * 
	 * @var string
	 */
	public $item_url;

	/**
	 * Event resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $site_id Format: ems-uuid.
	 * @param string $parent_id Format: ems-uuid.
	 * @param boolean $published
	 * @param int $publish_from Format: int32.
	 * @param int $publish_to Format: int32.
	 * @param string $date_start Format: date.
	 * @param string $date_end Format: date.
	 * @param string $hour
	 * @param string $hour_end
	 * @param string $website
	 * @param string $contact
	 * @param string $recurrent
	 * @param boolean $is_recurrent
	 * @param string $recurrent_end Format: date-time.
	 * @param string $organizer_id Format: ems-uuid.
	 * @param boolean $trash
	 * @param int $trash_dt Format: int32.
	 * @param string $trash_user_id Format: ems-uuid.
	 * @param int $add_dt Format: int32.
	 * @param string $add_user_id Format: ems-uuid.
	 * @param int $upd_dt Format: int32.
	 * @param string $upd_user_id Format: ems-uuid.
	 * @param ModelItemBlockLineListResponse $modelItemBlockLines
	 * @param ItemHasCategoryResponse $mainItemHasCategory
	 * @param ItemHasCategoryListResponse $aliasItemHasCategories
	 * @param string $item_url Format: uri.
	 */
	public function __construct(ApiClient $apiClient, $id = null, $site_id = null, $parent_id = null, $published = null, $publish_from = null, $publish_to = null, $date_start = null, $date_end = null, $hour = null, $hour_end = null, $website = null, $contact = null, $recurrent = null, $is_recurrent = null, $recurrent_end = null, $organizer_id = null, $trash = null, $trash_dt = null, $trash_user_id = null, $add_dt = null, $add_user_id = null, $upd_dt = null, $upd_user_id = null, $modelItemBlockLines = null, $mainItemHasCategory = null, $aliasItemHasCategories = null, $item_url = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->site_id = $site_id;
		$this->parent_id = $parent_id;
		$this->published = $published;
		$this->publish_from = $publish_from;
		$this->publish_to = $publish_to;
		$this->date_start = $date_start;
		$this->date_end = $date_end;
		$this->hour = $hour;
		$this->hour_end = $hour_end;
		$this->website = $website;
		$this->contact = $contact;
		$this->recurrent = $recurrent;
		$this->is_recurrent = $is_recurrent;
		$this->recurrent_end = $recurrent_end;
		$this->organizer_id = $organizer_id;
		$this->trash = $trash;
		$this->trash_dt = $trash_dt;
		$this->trash_user_id = $trash_user_id;
		$this->add_dt = $add_dt;
		$this->add_user_id = $add_user_id;
		$this->upd_dt = $upd_dt;
		$this->upd_user_id = $upd_user_id;
		$this->modelItemBlockLines = $modelItemBlockLines;
		$this->mainItemHasCategory = $mainItemHasCategory;
		$this->aliasItemHasCategories = $aliasItemHasCategories;
		$this->item_url = $item_url;
	}
	/**
	 * Update a specified module Agenda event item version
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $lang
	 * @param boolean $active
	 * @param string $title
	 * @param string $content
	 * @param string $duration
	 * @param string $price
	 * @param string $town
	 * @param string $place
	 * @param string $addr1
	 * @param string $addr2
	 * @param string $zip
	 * @param string $region
	 * @param string $country
	 * @param boolean $show_map
	 * @param string $ticketing_website
	 * @param string $ticketing_label
	 * @param boolean $member_participation_enable
	 * @param string $member_participation_display
	 * @param string $member_participation_group_id
	 * @param string $seo_uri
	 * @param string $seo_title
	 * @param string $seo_h1
	 * @param string $seo_keywords
	 * @param string $seo_description
	 * @param string $seo_image_id
	 * @param string $seo_additional_meta
	 * @param boolean $seo_no_index
	 * 
	 * @return EventResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function update($lang, $active, $title = null, $content = null, $duration = null, $price = null, $town = null, $place = null, $addr1 = null, $addr2 = null, $zip = null, $region = null, $country = null, $show_map = null, $ticketing_website = null, $ticketing_label = null, $member_participation_enable = null, $member_participation_display = null, $member_participation_group_id = null, $seo_uri = null, $seo_title = null, $seo_h1 = null, $seo_keywords = null, $seo_description = null, $seo_image_id = null, $seo_additional_meta = null, $seo_no_index = null)
	{
		$routePath = '/api/site/{siteId}/module/agenda/model/event/{eventId}/version/{lang}';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{eventId}' => $this->id,
			'{lang}' => $lang,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$bodyParameters = [];
		$bodyParameters['lang'] = $lang;
		$bodyParameters['active'] = $active;

		if (!is_null($title)) {
			$bodyParameters['title'] = $title;
		}

		if (!is_null($content)) {
			$bodyParameters['content'] = $content;
		}

		if (!is_null($duration)) {
			$bodyParameters['duration'] = $duration;
		}

		if (!is_null($price)) {
			$bodyParameters['price'] = $price;
		}

		if (!is_null($town)) {
			$bodyParameters['town'] = $town;
		}

		if (!is_null($place)) {
			$bodyParameters['place'] = $place;
		}

		if (!is_null($addr1)) {
			$bodyParameters['addr1'] = $addr1;
		}

		if (!is_null($addr2)) {
			$bodyParameters['addr2'] = $addr2;
		}

		if (!is_null($zip)) {
			$bodyParameters['zip'] = $zip;
		}

		if (!is_null($region)) {
			$bodyParameters['region'] = $region;
		}

		if (!is_null($country)) {
			$bodyParameters['country'] = $country;
		}

		if (!is_null($show_map)) {
			$bodyParameters['show_map'] = $show_map;
		}

		if (!is_null($ticketing_website)) {
			$bodyParameters['ticketing_website'] = $ticketing_website;
		}

		if (!is_null($ticketing_label)) {
			$bodyParameters['ticketing_label'] = $ticketing_label;
		}

		if (!is_null($member_participation_enable)) {
			$bodyParameters['member_participation_enable'] = $member_participation_enable;
		}

		if (!is_null($member_participation_display)) {
			$bodyParameters['member_participation_display'] = $member_participation_display;
		}

		if (!is_null($member_participation_group_id)) {
			$bodyParameters['member_participation_group_id'] = $member_participation_group_id;
		}

		if (!is_null($seo_uri)) {
			$bodyParameters['seo_uri'] = $seo_uri;
		}

		if (!is_null($seo_title)) {
			$bodyParameters['seo_title'] = $seo_title;
		}

		if (!is_null($seo_h1)) {
			$bodyParameters['seo_h1'] = $seo_h1;
		}

		if (!is_null($seo_keywords)) {
			$bodyParameters['seo_keywords'] = $seo_keywords;
		}

		if (!is_null($seo_description)) {
			$bodyParameters['seo_description'] = $seo_description;
		}

		if (!is_null($seo_image_id)) {
			$bodyParameters['seo_image_id'] = $seo_image_id;
		}

		if (!is_null($seo_additional_meta)) {
			$bodyParameters['seo_additional_meta'] = $seo_additional_meta;
		}

		if (!is_null($seo_no_index)) {
			$bodyParameters['seo_no_index'] = $seo_no_index;
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
	 * Site module Agenda event item version list
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return EventVersionListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getEventVersions($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/module/agenda/model/event/{eventId}/version';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{eventId}' => $this->id,
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

		$response = new EventVersionListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new EventVersion(
					$this->apiClient, 
					$data['item_id'], 
					$data['lang'], 
					$data['active'], 
					$data['title'], 
					$data['content'], 
					$data['duration'], 
					$data['price'], 
					$data['town'], 
					$data['addr1'], 
					$data['addr2'], 
					$data['zip'], 
					$data['region'], 
					$data['country'], 
					$data['show_map'], 
					$data['ticketing_website'], 
					$data['ticketing_label'], 
					$data['member_participation_enable'], 
					$data['member_participation_display'], 
					$data['member_participation_group_id'], 
					$data['seo_uri'], 
					$data['seo_title'], 
					$data['seo_h1'], 
					$data['seo_keywords'], 
					$data['seo_description'], 
					$data['seo_image_id'], 
					$data['seo_additional_meta'], 
					$data['seo_no_index'], 
					$data['add_dt'], 
					$data['add_user_id']
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
	 * Create and store new module Agenda event item version
	 * 
	 * Excepted HTTP code : 201
	 * 
	 * @param string $lang
	 * @param boolean $active
	 * @param string $title
	 * @param string $content
	 * @param string $duration
	 * @param string $price
	 * @param string $town
	 * @param string $place
	 * @param string $addr1
	 * @param string $addr2
	 * @param string $zip
	 * @param string $region
	 * @param string $country
	 * @param boolean $show_map
	 * @param string $ticketing_website
	 * @param string $ticketing_label
	 * @param boolean $member_participation_enable
	 * @param string $member_participation_display
	 * @param string $member_participation_group_id
	 * @param string $seo_uri
	 * @param string $seo_title
	 * @param string $seo_h1
	 * @param string $seo_keywords
	 * @param string $seo_description
	 * @param string $seo_image_id
	 * @param string $seo_additional_meta
	 * @param boolean $seo_no_index
	 * 
	 * @return EventVersionResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function createEventVersion($lang, $active, $title, $content = null, $duration = null, $price = null, $town = null, $place = null, $addr1 = null, $addr2 = null, $zip = null, $region = null, $country = null, $show_map = null, $ticketing_website = null, $ticketing_label = null, $member_participation_enable = null, $member_participation_display = null, $member_participation_group_id = null, $seo_uri = null, $seo_title = null, $seo_h1 = null, $seo_keywords = null, $seo_description = null, $seo_image_id = null, $seo_additional_meta = null, $seo_no_index = null)
	{
		$routePath = '/api/site/{siteId}/module/agenda/model/event/{eventId}/version';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{eventId}' => $this->id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$bodyParameters = [];
		$bodyParameters['lang'] = $lang;
		$bodyParameters['active'] = $active;
		$bodyParameters['title'] = $title;

		if (!is_null($content)) {
			$bodyParameters['content'] = $content;
		}

		if (!is_null($duration)) {
			$bodyParameters['duration'] = $duration;
		}

		if (!is_null($price)) {
			$bodyParameters['price'] = $price;
		}

		if (!is_null($town)) {
			$bodyParameters['town'] = $town;
		}

		if (!is_null($place)) {
			$bodyParameters['place'] = $place;
		}

		if (!is_null($addr1)) {
			$bodyParameters['addr1'] = $addr1;
		}

		if (!is_null($addr2)) {
			$bodyParameters['addr2'] = $addr2;
		}

		if (!is_null($zip)) {
			$bodyParameters['zip'] = $zip;
		}

		if (!is_null($region)) {
			$bodyParameters['region'] = $region;
		}

		if (!is_null($country)) {
			$bodyParameters['country'] = $country;
		}

		if (!is_null($show_map)) {
			$bodyParameters['show_map'] = $show_map;
		}

		if (!is_null($ticketing_website)) {
			$bodyParameters['ticketing_website'] = $ticketing_website;
		}

		if (!is_null($ticketing_label)) {
			$bodyParameters['ticketing_label'] = $ticketing_label;
		}

		if (!is_null($member_participation_enable)) {
			$bodyParameters['member_participation_enable'] = $member_participation_enable;
		}

		if (!is_null($member_participation_display)) {
			$bodyParameters['member_participation_display'] = $member_participation_display;
		}

		if (!is_null($member_participation_group_id)) {
			$bodyParameters['member_participation_group_id'] = $member_participation_group_id;
		}

		if (!is_null($seo_uri)) {
			$bodyParameters['seo_uri'] = $seo_uri;
		}

		if (!is_null($seo_title)) {
			$bodyParameters['seo_title'] = $seo_title;
		}

		if (!is_null($seo_h1)) {
			$bodyParameters['seo_h1'] = $seo_h1;
		}

		if (!is_null($seo_keywords)) {
			$bodyParameters['seo_keywords'] = $seo_keywords;
		}

		if (!is_null($seo_description)) {
			$bodyParameters['seo_description'] = $seo_description;
		}

		if (!is_null($seo_image_id)) {
			$bodyParameters['seo_image_id'] = $seo_image_id;
		}

		if (!is_null($seo_additional_meta)) {
			$bodyParameters['seo_additional_meta'] = $seo_additional_meta;
		}

		if (!is_null($seo_no_index)) {
			$bodyParameters['seo_no_index'] = $seo_no_index;
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

		$response = new EventVersionResponse(
			$this->apiClient, 
			new EventVersion(
				$this->apiClient, 
				$requestBody['data']['item_id'], 
				$requestBody['data']['lang'], 
				$requestBody['data']['active'], 
				$requestBody['data']['title'], 
				$requestBody['data']['content'], 
				$requestBody['data']['duration'], 
				$requestBody['data']['price'], 
				$requestBody['data']['town'], 
				$requestBody['data']['addr1'], 
				$requestBody['data']['addr2'], 
				$requestBody['data']['zip'], 
				$requestBody['data']['region'], 
				$requestBody['data']['country'], 
				$requestBody['data']['show_map'], 
				$requestBody['data']['ticketing_website'], 
				$requestBody['data']['ticketing_label'], 
				$requestBody['data']['member_participation_enable'], 
				$requestBody['data']['member_participation_display'], 
				$requestBody['data']['member_participation_group_id'], 
				$requestBody['data']['seo_uri'], 
				$requestBody['data']['seo_title'], 
				$requestBody['data']['seo_h1'], 
				$requestBody['data']['seo_keywords'], 
				$requestBody['data']['seo_description'], 
				$requestBody['data']['seo_image_id'], 
				$requestBody['data']['seo_additional_meta'], 
				$requestBody['data']['seo_no_index'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id']
			)
		);

		return $response;
	}
	
	/**
	 * Get specified module Agenda event item version
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $lang Lang
	 * 
	 * @return EventVersionResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getEventVersion($lang)
	{
		$routePath = '/api/site/{siteId}/module/agenda/model/event/{eventId}/version/{lang}';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{eventId}' => $this->id,
			'{lang}' => $lang,
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

		$response = new EventVersionResponse(
			$this->apiClient, 
			new EventVersion(
				$this->apiClient, 
				$requestBody['data']['item_id'], 
				$requestBody['data']['lang'], 
				$requestBody['data']['active'], 
				$requestBody['data']['title'], 
				$requestBody['data']['content'], 
				$requestBody['data']['duration'], 
				$requestBody['data']['price'], 
				$requestBody['data']['town'], 
				$requestBody['data']['addr1'], 
				$requestBody['data']['addr2'], 
				$requestBody['data']['zip'], 
				$requestBody['data']['region'], 
				$requestBody['data']['country'], 
				$requestBody['data']['show_map'], 
				$requestBody['data']['ticketing_website'], 
				$requestBody['data']['ticketing_label'], 
				$requestBody['data']['member_participation_enable'], 
				$requestBody['data']['member_participation_display'], 
				$requestBody['data']['member_participation_group_id'], 
				$requestBody['data']['seo_uri'], 
				$requestBody['data']['seo_title'], 
				$requestBody['data']['seo_h1'], 
				$requestBody['data']['seo_keywords'], 
				$requestBody['data']['seo_description'], 
				$requestBody['data']['seo_image_id'], 
				$requestBody['data']['seo_additional_meta'], 
				$requestBody['data']['seo_no_index'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id']
			)
		);

		return $response;
	}
}
