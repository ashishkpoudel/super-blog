### Light weight CQRS With Laravel Bus (Experimental Project)

In simple words CQRS is a design pattern where you separate write operation and read operation.

I did quite a bit research on what php projects might be using CQRS and are opensource at the same time. Luckily i found one major project prestashop using CQRS.
  
Link (Prestashop):
https://github.com/PrestaShop/PrestaShop/tree/develop/src/Core/Domain

Link (Laminas skeleton):
https://github.com/reformo/hexagonal-cqrs-skeleton

So this is my attempt to make it happen with what laravel has to offer. All source code resides in `/src` folder with every module having it's own seperate folder. Implementation for `Events` is missing in this project. Simply `Events` will also reside with in the same structure along with Commands and Queries. 

````
/src
    Posts
        Commands
            Handlers
                CreatePostHandler.php
            CreatePost.php
        Exceptions
            CannotCreatePostException.php
            PostException.php
        Http
            Handlers
                CreatePostHandler.php
            Requests
            Resources
            routes.php
        Models
            Post.php
        Providers
            PostServiceProvider.php
        Queries
            Handlers
                GetPaginatedPost.php
        ValueObjects
            PostId.php
````

Same folder structure is being carried out across all project modules. As we can see there's two folder called `commands` and `queries` commands holds write operations where query is for quering data. 

Laravel also has `Jobs` which internally uses `Bus` i decided not to use it.
For every command and query we have two class one for actual implementation `CreatePostHandler` `GetAllPaginatedPostHandler` and another which acts as a DTO for transferring data in our handlers `CreatePost` `GetAllPaginatedPost`


Example: (Commands)
Commands in our application does not return any data according to the rule. But feel free to break it for your special uses cases. One command has only one handler.
```php
<?php

namespace src\Posts\Commands;

use src\Posts\ValueObjects\PostId;
use src\Users\ValueObjects\UserId;
use src\Core\Bus\Command\CommandInterface;

class CreatePost implements CommandInterface
{
    public PostId $postId;
    public UserId $userId;
    public string $title;
    public string $body;

    public function __construct(PostId $postId, UserId $userId, string $title, string $body)
    {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->title = $title;
        $this->body = $body;
    }
}

```

```php
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

```

Queries:
One query has only one handler. Query return's data

```php
<?php

namespace src\Posts\Queries;

use src\Core\Bus\Query\QueryInterface;
use src\Core\Support\QueryOptions;

class GetPaginatedPost implements QueryInterface
{
    public QueryOptions $query;

    public function __construct(QueryOptions $queryOptions)
    {
        $this->query = $queryOptions;
    }
}

```

```php
<?php

namespace src\Posts\Queries\Handlers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use src\Posts\Models\Post;
use src\Posts\Queries\GetPaginatedPost;

class GetPaginatedPostHandler
{
    public function handle(GetPaginatedPost $query): LengthAwarePaginator
    {
        $postQuery = Post::query();

        if (isset($query->query->filters['title'])) {
            $postQuery->where('title', 'like', '%' . $query->query->filters['title'] . '%');
        }

        if (isset($query->query->filters['slug'])) {
            $postQuery->where('slug', 'like', '%' . $query->query->filters['slug'] . '%');
        }

        return $postQuery->limit($query->query->limit)->paginate($query->query->page);
    }
}

```

How these `commands` and `queries` are called from our `http controllers` for this project i'm calling them `http handlers`
Every single action will have one HTTP handlers

```php
<?php

namespace src\Posts\Http\Handlers;

use src\Core\Http\Response\CreatedResponse;
use src\Posts\ValueObjects\PostId;
use src\Core\Handlers\BaseHandler;
use src\Posts\Commands\CreatePost;
use src\Posts\Http\Requests\PostRequest;
use src\Posts\Http\Resources\PostResource;
use src\Posts\Queries\GetPost;
use src\Users\ValueObjects\UserId;

final class CreatePostHandler extends BaseHandler
{
    public function __invoke(PostRequest $request)
    {
        $postId = PostId::new();
        $userId = UserId::fromString($request->user()->id);

        $this->commandBus()->execute(
            app(CreatePost::class, [
                'postId' => $postId,
                'userId' => $userId,
                'title' => $request->input('title'),
                'body' => $request->input('body'),
            ])
        );

        $post = $this->queryBus()->query(new GetPost($postId));

        return new CreatedResponse(
            PostResource::make($post)
        );
    }
}

```

Since our commands will not return any value i have to generate `UUID` outside commands and passing them in. We can choose to do it in other way.
For more details fell free to browser source code as i have not mentioned everything here. example things inside `/core` module.

I'm still experimenting with this project so things might move here and there a bit.
