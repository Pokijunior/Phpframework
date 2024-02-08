<?php

namespace Lovro\Phpframework\Traits;

trait HasTimestamps
{
    protected bool $timestampsEnabled = true;
    

    public function disableTimestamps(): void
    {
        $this->timestampsEnabled = false;
    }

    public function setUpdatedAt(): void
    {
        $this->columns['updated_at'] = date('Y-m-d H:i:s');
    }

    public function setCreatedAt(): void
    {
        $this->columns['created_at'] = date('Y-m-d H:i:s');
    }

    public function setDeletedAt(): void
    {
        $this->columns['deleted_at'] = date('Y-m-d H:i:s');
    }
}