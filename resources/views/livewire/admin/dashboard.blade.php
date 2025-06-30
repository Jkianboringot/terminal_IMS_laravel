<div>
  <x-slot name="header">

    Dashboard

  </x-slot>

  <div class="row mb-5">
    <div class="col-md-8 col-12">
      <div class="row">
        <div class="col-6 mb-3">
          <div class="card bg-inv-primary text-inv-secondary" style="border-raduis:0">
            <div class="card-body">
              <div class="card-title">
                <p>Total Sales <br>
                  <small>{{ ucwords(str_replace('_', ' ', $selectedOption))}}</small>
                </p>
              </div>
              <span class="text-end">
                <h6>PISO</h6>
                <h1>12323</h1>
              </span>

            </div>
          </div>
        </div>
        <div class="col-6 mb-3">
          <div class="card  bg-inv-secondary text-inv-primary" style="border-raduis:0">
            <div class="card-body">
              <div class="card-title">
                <p>Total Purchases <br>
                  <small>{{ ucwords(str_replace('_', ' ', $selectedOption))}}</small>
                </p>
              </div>
              <span class="text-end">
                <h6>PISO</h6>
                <h1>12323</h1>
              </span>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="card bg-inv-primary" style="min-height:500px">
    <div class="card-header border-3 border-inv-secondary d-flex">
      <h5 class="text-inv-secondary"> Sales & Purchase summary</h5>
      <div class="ms-auto">
        <select class="form-select border-inv-secondary  bg-inv-secondary " name="" id="" wire:model.live="selectedOption">
          @foreach ($options as $option)
        <option value="{{ $option }}">{{  ucwords(str_replace('_', ' ', $option)) }}</option>


      @endforeach
        </select>
      </div>

    </div>
    <div class="card-body wire:ignore">
      <div id="sales-purchases-chart"></div>
    </div>
  </div>


</div>

@push('scripts')
  <script>
    // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
    // IT'S ALL JUST JUNK FOR DEMO
    // ++++++++++++++++++++++++++++++++++++++++++

    const sales_purchases = {
    series: [{
      name: "Purchases",
      data: [28, 48, 40, 19, 86, 27, 90],
    },
    {
      name: "Sales",
      data: [65, 59, 80, 81, 56, 55, 40],
    },
    ],
    chart: {
      height: 300,
      type: "area",
      toolbar: {
      show: false,
      },
    },
    legend: {
      show: true,
    },
    colors: ["#ed9dc1", "#af1763"],
    dataLabels: {
      enabled: true,
    },
    stroke: {
      curve: "smooth",
    },
    xaxis: {
      type: "datetime",
      categories: [
      @foreach ($dateRange as $date)
     "{{Carbon\Carbon::parse($date)->format('Y-m-d') }}",
       @endforeach
          ],
    },
    tooltip: {
      x: {
      format: "MMMM yyyy",
      },
    },
    };

    Livewire.on('chart-updated',(e)=>{
        sales_purchases.xaxis.categories=e.$dateRange
    })
    const sales_purchases_chart = new ApexCharts(
    document.querySelector("#sales-purchases-chart"),
    sales_purchases,
    );
    sales_purchases_chart.render();
  </script> <!-- jsvectormap -->
@endpush