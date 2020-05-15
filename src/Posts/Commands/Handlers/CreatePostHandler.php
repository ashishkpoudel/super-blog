<?php

namespace src\Posts\Commands\Handlers;

use Illuminate\Support\Str;
use Illuminate\Log\Logger;
use src\Posts\Commands\CreatePost;
use src\Posts\Exceptions\CannotCreatePostException;
use src\Posts\Models\Post;

class CreatePostHandler
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function handle(CreatePost $command): void
    {
        try {
            $post = new Post();
            $post->id = $command->postId->getValue();
            $post->userId = $command->userId->getValue();
            $post->title = $command->title;
            $post->slug = Str::slug($command->title);
            $post->body = $command->body;
            $post->save();

        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
            throw new CannotCreatePostException(
                'Failed to create post'
            );
        }
    }
}
