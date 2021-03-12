<?php

declare(strict_types=1);

namespace App\Services\TwitterService;

use Abraham\TwitterOAuth\TwitterOAuth;
use InvalidArgumentException;

/**
 * Class TwitterService is used for authorization to Twitter API and loading posts based on configuration in
 * common.neon config file
 *
 * This class uses TwitterOAuth library - PHP library for use with the Twitter OAuth REST API.
 *
 * @package App\Services\TwitterService
 */
class TwitterService
{
	private $twitterOAuth;
	
	private $orQueryParams;
	private $count;
	private $tweetMode;
	
	const RESPONSE_STATUS_OK = 200;
	
	public function __construct(string $consumerKey, string $consumerSecret, string $oauthAccessToken, string $oauthAccessTokenSecret)
	{
		$this->twitterOAuth = new TwitterOAuth($consumerKey, $consumerSecret, $oauthAccessToken, $oauthAccessTokenSecret);
		$this->twitterOAuth->get("account/verify_credentials");
		if ($this->twitterOAuth->getLastHttpCode() != self::RESPONSE_STATUS_OK) {
			throw new TwitterServiceException('Could not authenticate Twitter API user');
		}
	}
	
	public function setLoadPostsParams(array $orQueryParamsValidationRegex, array $orQueryParams, int $count = 100,
									   string $tweetMode = 'extended')
	{
		foreach($orQueryParams as $orQueryParam) {
			$valid = false;
			foreach($orQueryParamsValidationRegex as $regex) {
				if(preg_match("/" . $regex . "/", $orQueryParam)) {
					$valid = true;
				}
			}
			if(!$valid) {
				throw new InvalidArgumentException("OrQueryParam: $orQueryParam is not valid!");
			}
		}
		$this->orQueryParams = $orQueryParams;
		$this->count = $count;
		$this->tweetMode = $tweetMode;
	}
	
	public function loadPosts()
	{
		$queryString = implode(' OR ', $this->orQueryParams);
		$response = $this->twitterOAuth->get('search/tweets', ['q' => $queryString, 'count' => $this->count,
'tweet_mode' => $this->tweetMode]);
		if ($this->twitterOAuth->getLastHttpCode() == self::RESPONSE_STATUS_OK) {
			return $response;
		} else {
			throw new TwitterServiceException('Could not get TwitterService response');
		}
	}
}