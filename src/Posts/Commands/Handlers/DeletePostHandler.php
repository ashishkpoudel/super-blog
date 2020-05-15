<?php

namespace src\Posts\Commands\Handlers;

use Illuminate\Log\Logger;
use src\Posts\Commands\DeletePost;
use src\Posts\Exceptions\CannotDeletePostException;
use src\Posts\Models\Post;

class DeletePostHandler
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function handle(DeletePost $command): void
    {
        try {
            $post = Post::query()->findOrFail($command->postId->getValue());
            $post->delete();
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTraceAsString());
            throw new CannotDeletePostException(
                'Unable to delete post'
            );
        }
    }
}
