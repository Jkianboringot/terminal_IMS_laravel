<?php

    namespace App\Livewire\Admin\UnsuccessfulTransactions;

    use App\Models\UnsuccessfulTransaction;
    use App\Models\Product;
    use Livewire\Component;
    use Livewire\WithPagination;

    class Index extends Component
    {
        use WithPagination;

        public string $search = '';

        public function updatingSearch(): void
        {
            $this->resetPage();
        }

        function delete($id)
        {
            try {
                $purchase = UnsuccessfulTransaction::findOrFail($id);
               

                $purchase->products()->detach();
                $purchase->delete();

                $this->dispatch('done', success: "Successfully Deleted this Purchase");
            } catch (\Throwable $th) {
                //throw $th;
                $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
            }
        } public function render()
{
    $search = trim($this->search);

    $unsuccessfulTransactions = UnsuccessfulTransaction::select('unsuccessful_transactions.*')
    ->when($search,fn($query)=>
    $query->where(function($sub) use ($search){
       $sub->where('unsuccessful_transactions.unsuccessful_transactions_date', 'like', "%$search%")
          ->orWhere('unsuccessful_transactions.name', 'like', "%$search%");
    }))
        ->orderBy('unsuccessful_transactions.unsuccessful_transactions_date', 'desc')
        ->paginate(10);


return view('livewire.admin.unsuccessful-transactions.index', [
        'unsuccessfulTransactions' => $unsuccessfulTransactions,

    ]);
}

    }
