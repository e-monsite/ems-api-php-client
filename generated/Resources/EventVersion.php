<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * EventVersion resource class
 * 
 * @package Emonsite\Api\Resources
 */
class EventVersion 
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
	public $item_id;

	/**
	 * Format: ems-lang.
	 * 
	 * @var string
	 */
	public $lang;

	/**
	 * @var boolean
	 */
	public $active;

	/**
	 * @var string
	 */
	public $title;

	/**
	 * @var string
	 */
	public $content;

	/**
	 * @var string
	 */
	public $duration;

	/**
	 * @var string
	 */
	public $price;

	/**
	 * @var string
	 */
	public $town;

	/**
	 * @var string
	 */
	public $addr1;

	/**
	 * @var string
	 */
	public $addr2;

	/**
	 * @var string
	 */
	public $zip;

	/**
	 * @var string
	 */
	public $region;

	/**
	 * @var string
	 */
	public $country;

	/**
	 * @var boolean
	 */
	public $show_map;

	/**
	 * @var string
	 */
	public $ticketing_website;

	/**
	 * @var string
	 */
	public $ticketing_label;

	/**
	 * @var boolean
	 */
	public $member_participation_enable;

	/**
	 * @var string
	 */
	public $member_participation_display;

	/**
	 * @var string
	 */
	public $member_participation_group_id;

	/**
	 * @var string
	 */
	public $seo_uri;

	/**
	 * @var string
	 */
	public $seo_title;

	/**
	 * @var string
	 */
	public $seo_h1;

	/**
	 * @var string
	 */
	public $seo_keywords;

	/**
	 * @var string
	 */
	public $seo_description;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $seo_image_id;

	/**
	 * @var string
	 */
	public $seo_additional_meta;

	/**
	 * @var boolean
	 */
	public $seo_no_index;

	/**
	 * Format: date-time.
	 * 
	 * @var string
	 */
	public $add_dt;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $add_user_id;

	/**
	 * EventVersion resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $item_id Format: ems-uuid.
	 * @param string $lang Format: ems-lang.
	 * @param boolean $active
	 * @param string $title
	 * @param string $content
	 * @param string $duration
	 * @param string $price
	 * @param string $town
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
	 * @param string $seo_image_id Format: ems-uuid.
	 * @param string $seo_additional_meta
	 * @param boolean $seo_no_index
	 * @param string $add_dt Format: date-time.
	 * @param string $add_user_id Format: ems-uuid.
	 */
	public function __construct(ApiClient $apiClient, $item_id = null, $lang = null, $active = null, $title = null, $content = null, $duration = null, $price = null, $town = null, $addr1 = null, $addr2 = null, $zip = null, $region = null, $country = null, $show_map = null, $ticketing_website = null, $ticketing_label = null, $member_participation_enable = null, $member_participation_display = null, $member_participation_group_id = null, $seo_uri = null, $seo_title = null, $seo_h1 = null, $seo_keywords = null, $seo_description = null, $seo_image_id = null, $seo_additional_meta = null, $seo_no_index = null, $add_dt = null, $add_user_id = null)
	{
		$this->apiClient = $apiClient;
		$this->item_id = $item_id;
		$this->lang = $lang;
		$this->active = $active;
		$this->title = $title;
		$this->content = $content;
		$this->duration = $duration;
		$this->price = $price;
		$this->town = $town;
		$this->addr1 = $addr1;
		$this->addr2 = $addr2;
		$this->zip = $zip;
		$this->region = $region;
		$this->country = $country;
		$this->show_map = $show_map;
		$this->ticketing_website = $ticketing_website;
		$this->ticketing_label = $ticketing_label;
		$this->member_participation_enable = $member_participation_enable;
		$this->member_participation_display = $member_participation_display;
		$this->member_participation_group_id = $member_participation_group_id;
		$this->seo_uri = $seo_uri;
		$this->seo_title = $seo_title;
		$this->seo_h1 = $seo_h1;
		$this->seo_keywords = $seo_keywords;
		$this->seo_description = $seo_description;
		$this->seo_image_id = $seo_image_id;
		$this->seo_additional_meta = $seo_additional_meta;
		$this->seo_no_index = $seo_no_index;
		$this->add_dt = $add_dt;
		$this->add_user_id = $add_user_id;
	}
	/**
	 * Update a specified module Agenda event item version
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $siteId Site ID
	 * @param string $eventId Event ID
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
	public function update($siteId, $eventId, $lang, $active, $title = null, $content = null, $duration = null, $price = null, $town = null, $place = null, $addr1 = null, $addr2 = null, $zip = null, $region = null, $country = null, $show_map = null, $ticketing_website = null, $ticketing_label = null, $member_participation_enable = null, $member_participation_display = null, $member_participation_group_id = null, $seo_uri = null, $seo_title = null, $seo_h1 = null, $seo_keywords = null, $seo_description = null, $seo_image_id = null, $seo_additional_meta = null, $seo_no_index = null)
	{
		$routePath = '/api/site/{siteId}/module/agenda/model/event/{eventId}/version/{lang}';

		$pathReplacements = [
			'{siteId}' => $siteId,
			'{eventId}' => $eventId,
			'{lang}' => $this->lang,
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
}
