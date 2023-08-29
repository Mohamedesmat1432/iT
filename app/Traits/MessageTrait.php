<?php

namespace App\Traits;

trait MessageTrait
{
    public function createMessage($message)
    {
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' =>  __($message . ' has been created successfully')
        ]);
    }

    public function updateMessage($message)
    {
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' =>  __($message . ' has been updated successfully')
        ]);
    }

    public function deleteMessage($message)
    {
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' =>  __($message . ' has been deleted successfully')
        ]);
    }
}
