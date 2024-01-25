<?php

namespace Lovro\Phpframework\Interfaces;

interface RequestInterface
{
    public function Uri(): string;
    public function Method(): string;
    public function Params(): array;
}
