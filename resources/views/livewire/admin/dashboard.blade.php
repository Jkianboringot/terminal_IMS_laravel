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
            <small>(last 30 days)</small>
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
            <small>(last 30 days)</small>
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
  <div class="card-header border-3 border-inv-secondary">
    <h5 class="text-inv-secondary"> Sales & Purchase summary</h5>
  </div>
  <div class="card-body">
    <div id="revenue-chart"></div>
  </div>
</div>


</div>

@push('scripts')
    <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        const sales_chart_options = {
            series: [{
                    name: "Digital Goods",
                    data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                    name: "Electronics",
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
                show: false,
            },
            colors: ["#0d6efd", "#20c997"],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
            },
            xaxis: {
                type: "datetime",
                categories: [
                    "2023-01-01",
                    "2023-02-01",
                    "2023-03-01",
                    "2023-04-01",
                    "2023-05-01",
                    "2023-06-01",
                    "2023-07-01",
                ],
            },
            tooltip: {
                x: {
                    format: "MMMM yyyy",
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector("#revenue-chart"),
            sales_chart_options,
        );
        sales_chart.render();
    </script> <!-- jsvectormap -->
@endpush