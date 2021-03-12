<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Services\TwitterService\TwitterService;
use Nette;


/**
 * Class HomepagePresenter is used for displaying Twitter posts as HTML in latte template
 *
 * @package App\Presenters
 */
final class HomepagePresenter extends Nette\Application\UI\Presenter
{
	/** @var TwitterService */
	private $twitterService;
	
	private $twitterUrl;
	private $showRetweeted;
	
	public function __construct(TwitterService $twitterService)
	{
		$this->twitterService = $twitterService;
	}
	
	/**
	 * Set parameters for displaying tweets from Twitter.
	 *
	 * @param string $twitterUrl base twitter URL for template
	 * @param bool $showRetweeted if retweeted tweets should be displayed
	 */
	public function setParams(string $twitterUrl, bool $showRetweeted)
	{
		$this->twitterUrl = $twitterUrl;
		$this->showRetweeted = $showRetweeted;
	}
	
	public function renderDefault(): void
	{
		$statusesResponse = $this->twitterService->loadPosts();
		$this->template->twitterUrl = $this->twitterUrl;
		$this->template->showRetweeted = $this->showRetweeted;
		$this->template->posts = $statusesResponse->statuses;
	}
}
