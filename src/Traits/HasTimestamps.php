<?php

namespace Lovro\Phpframework\Traits;

trait HasTimestamps
{
    private bool $timestampsEnabled = false;
    

    public function enableTimestamps()
    {
        $this->timestampsEnabled = true;
    }

    public function setUpdatedAt() 
    {
        $this->columns['updated_at'] = date('Y-m-d H:i:s');
    }

    public function setCreatedAt()
    {
        $this->columns['created_at'] = date('Y-m-d H:i:s');
    }

    public function setDeletedAt() 
    {
        $this->columns['deleted_at'] = date('Y-m-d H:i:s');
    }
}