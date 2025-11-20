<?php

namespace Crm\Base;

use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseBuilder
{
    private int $statusCode = 200;
    private $data = null;
    private array $errors = [];
    private $status = 'Success';
    private $meta = [];
const STATUS_SUCCESS = 'success';
const STATUS_ERROR = 'error';

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }
    public function setErrors(array $errors): self
    {
        $this->errors = $errors;
        return $this;
    }
    public function setStatus($status): self
    {
        $this->status = $status;
        return $this;
    }
    public function setMeta(array $meta): self
    {
        $this->meta = $meta;
        return $this;
    }
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
    public function getData()
    {
        return $this->data;
    }
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function getMeta(): array
    {
        return $this->meta;
    }
  public function response()
{
    $response = [
        'status' => $this->getStatus()
    ];

    if ($this->getStatus() === self::STATUS_SUCCESS) {
        $data = $this->getData();
        // إذا كانت Collection، حولها لـ array
        if ($data instanceof \Illuminate\Support\Collection) {
            $data = $data->toArray();
        }
        $response['data'] = $data;
    } else {
        $response['errors'] = $this->getErrors();
    }

    if (!empty($this->getMeta())) {
        $response['meta'] = $this->getMeta();
    }

    return response()->json($response, $this->getStatusCode());
}

}
