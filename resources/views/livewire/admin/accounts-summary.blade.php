<div>
    <x-slot:header>Accounts Summary</x-slot:header>

    <div class="mb-3">
        <input class="form-control bg-inv-primary text-inv-secondary " type="month" wire:model.live='month'>
    </div> 
    <div class="row mb-3">
        <!-- Revenue and Sales -->
        <div class="col-md-7">
            <div class="card text-center shadow-sm bg-inv-primary text-inv-secondary">
                <div class="card-body">
                    <i class="bi bi-currency-exchange display-4 text-inv-secondary"></i>
                    <h5 class="card-title mt-2">Total Revenue</h5>
                    <p class="fs-3 fw-bold">PISO {{ number_format($total_revenue, 2) }}</p>
                    <p class="text-{{ $revenueDeviation > 0 ? 'success' : 'danger' }}">
                        {{ number_format($revenueDeviation * 100, 2) }}%
                        compared to last month</p>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-12">
            <div class="card bg-inv-primary">
                <div class="card-header text-inv-secondary">
                    <h5>Generate Documents</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <button class="btn btn-secondary"
                                wire:click="downloadPLStatement('{{ $month }}')">P&L Statement</button>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-secondary"
                                wire:click="downloadAccountSummary('{{ $month }}')">Accounts
                                Summary</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <div class="row mb-3" >

        <div class="card bg-inv-primary" style="min-height: 500px">
            <div class="card-header border-3 border-inv-secondary d-flex">
                <h5 class="text-inv-secondary">
                    Sales & Purchase Summary
                </h5>
                <div class="ms-auto">

                </div>

            </div>
            <div class="card-body" wire:ignore>
                <livewire:livewire-line-chart :line-chart-model="$lineChartModel" />
            </div>
        </div>
    </div>
  
</div
