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

    public function importMessage($message)
    {
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' =>  __($message . ' has been imported successfully')
        ]);
    }

    public function exportMessage($message)
    {
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' =>  __($message . ' has been exported successfully')
        ]);
    }

    public function errorMessage($message)
    {
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'danger',
            'message' =>  __($message)
        ]);
    }
}
