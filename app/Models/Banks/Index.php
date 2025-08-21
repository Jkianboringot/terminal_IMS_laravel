<?php

namespace App\Livewire\Admin\Banks;

use App\Models\Bank;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public string $search = '';

       public function updatingSearch()
    {
        // Reset pagination when search input changes
        $this->resetPage();
    }
        function delete($id)
    {
        try {
            $bank = Bank::findOrFail($id);
            if (count($bank->clients) >0 || count($bank->suppliers) >0) {
                throw new \Exception("Permission denied: This Bank has {$bank->clients->count()} Client & {$bank->suppliers->count()} Supplier", 1);
            }

       
            $bank->delete();

            $this->dispatch('done', success: "Successfully Deleted this Bank");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
  public function render()
{
    $search = trim($this->search);

    $banks = Bank::when($search, fn ($query) =>
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('short_name', 'like', "%$search%")
              ->orWhere('sort_code', 'like', "%$search%");
        })
    )
    ->orderBy('name')
    ->paginate(10);

    return view('livewire.admin.banks.index', [
        'banks' => $banks
    ]);
}

}


 