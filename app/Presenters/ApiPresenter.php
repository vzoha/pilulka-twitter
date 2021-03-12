<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Services\TwitterService\TwitterService;
use Nette;


/**
 * Class ApiPresenter is used for displaying Twitter posts as JSON in API
 *
 * @package App\Presenters
 */
final class ApiPresenter extends Nette\Application\UI\Presenter
{
	/** @var TwitterService */
	private $twitterService;
	
	public function __construct(TwitterService $twitterService)
	{
		$this->twitterService = $twitterService;
	}
	
	public function actionPosts(): void
	{
		$statusesResponse = $this->twitterService->loadPosts();
		$this->sendJson($statusesResponse);
	}
}
