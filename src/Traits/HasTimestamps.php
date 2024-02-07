<?php

namespace Lovro\Phpframework\Traits;

trait HasTimestamps
{
    protected bool $timestampsEnabled = true;
    
    // public function enableTimestamps()
    // {
    //     $this->timestampsEnabled = true;
    // }

    public function disableTimestamps()
    {
        $this->timestampsEnabled = false;
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