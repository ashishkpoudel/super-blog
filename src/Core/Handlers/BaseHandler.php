<?php

namespace src\Core\Handlers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

abstract class BaseHandler extends Controller
{
    use AuthorizesRequests;

    /** @var int */
    private $statusCode = 200;

    /** @var string */
    private $message;

    /** @var string */
    private $error;

    private $pagination;

    /** @var array */
    private $meta;

    public function statusCode(int $code)
    {
        $this->statusCode = $code;

        return $this;
    }

    public function message(string $message)
    {
        $this->message = $message;

        return $this;
    }

    public function error(string $error)
    {
        $this->error = $error;

        return $this;
    }

    public function meta(array $meta)
    {
        $this->meta = $meta;

        return $this;
    }

    public function pagination(LengthAwarePaginator $pagination)
    {
        $this->pagination = [
            'total' => $pagination->total(),
            'per_page' => min($pagination->total(), $pagination->perPage()),
            'current_page' => $pagination->currentPage(),
            'last_page' => $pagination->lastPage(),
            'first_page_url' => $pagination->url(1),
            'last_page_url' => $pagination->url($pagination->lastPage()),
            'next_page_url' => $pagination->nextPageUrl(),
            'prev_page_url' => $pagination->previousPageUrl(),
            'path' => url('v1'),
            'from' => $pagination->firstItem(),
            'to' => $pagination->lastItem(),
        ];

        return $this;
    }

    /**
     * @param array|string|object|null $data
     * @param array                    $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function content($data, $headers = [])
    {
        $responseData = [];

        if ($data) {
            $responseData['data'] = $data;
        }

        if (!empty($this->meta)) {
            $responseData['meta'] = $this->meta;
        }

        if (!empty($this->pagination)) {
            $responseData['pagination'] = $this->pagination;
        }

        if ($this->message) {
            $responseData['message'] = $this->message;
        }

        if ($this->error) {
            $responseData['error'] = $this->error;
        }

        return response()->json($responseData, $this->statusCode, $headers);
    }

    public function ok($data = null)
    {
        return $this->statusCode(Response::HTTP_OK)->content($data);
    }

    public function created($data)
    {
        return $this->statusCode(Response::HTTP_CREATED)->content($data);
    }

    public function updated($data)
    {
        return $this->statusCode(Response::HTTP_OK)->content($data);
    }

    public function noContent()
    {
        return $this->statusCode(Response::HTTP_NO_CONTENT)->content(null);
    }

    public function notFound(string $message = 'Not Found')
    {
        return $this->statusCode(Response::HTTP_NOT_FOUND)->message($message)->content(null);
    }

    public function badRequest(string $message = 'Bad Request')
    {
        return $this->statusCode(Response::HTTP_BAD_REQUEST)->message($message)->content(null);
    }

    public function unauthorized(string $message = 'Unauthorized!')
    {
        return $this->statusCode(Response::HTTP_UNAUTHORIZED)->message($message)->content(null);
    }

    public function deleted()
    {
        return $this->statusCode(Response::HTTP_NO_CONTENT)->content(null);
    }
}
