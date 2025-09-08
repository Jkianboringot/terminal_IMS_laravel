<?php

namespace App\Traits;

trait WithCancel
{
    public function cancel()
    {
        $this->reset(); 
        $this->dispatch('notify', 'Operation Canceled');
    }
}
