@extends('layouts.appseller')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Total Sales and Total Order by Month') }}
                </div>
                <div id="saleschart" style="height: 300px;"></div>
                



            </div>

            <div class="card mt-3">
                <div class="card-header">{{ __('Total Sold Products') }}
                </div>
                <div id="productchart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>
<script>
    const chart = new Chartisan({
        el: '#saleschart',
        url: "@chart('sales_chart')",
        hooks: new ChartisanHooks()
            .colors()
            .borderColors()
            .responsive()
            .beginAtZero()
            .legend({
                position: 'bottom'
            })
            .title('Total Sales and Total Order by Month')
            .datasets([{
                type: 'line',
                fill: false
            }, 'bar']),
    });

    const chart2 = new Chartisan({
        el: '#productchart',
        url: "@chart('product_chart')",
        hooks: new ChartisanHooks()
            .pieColors()
            .borderColors()
            .responsive()
            .beginAtZero()
            .displayAxes(false)
            .legend(false)
            .title('Total Sold Products')
            .datasets([{
                type: 'bar',
                fill: false
            }]),
    });
</script>
@endsection