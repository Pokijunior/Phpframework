<?php

namespace Lovro\Phpframework\Interfaces;

interface RequestInterface
{
    public function getUri(): string;
    public function getMethod(): string;
}
