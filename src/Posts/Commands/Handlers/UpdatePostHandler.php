<?php

namespace src\Posts\Commands\Handlers;

use Illuminate\Log\Logger;
use Illuminate\Support\Str;
use src\Posts\Commands\UpdatePost;
use src\Posts\Exceptions\CannotUpdatePostException;
use src\Posts\Models\Post;

class UpdatePostHandler
{
    public Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function handle(UpdatePost $command): void
    {
        try {
            $post = Post::query()->findOrFail($command->postId->getValue());
            $post->title = $command->title ?? $post->title;
            $post->body = $command->body ?? $post->body;
            if ($command->title) $post->slug = Str::slug($command->title);
            $post->save();

        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTraceAsString());
            throw new CannotUpdatePostException(
                'Unable to update post'
            );
        }
    }
}
