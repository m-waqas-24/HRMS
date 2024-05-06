@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER  -->
        <div class="page-header d-lg-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Reports</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class=" btn-list">
                    <button  class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
                    <button  class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
                    <button  class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER  -->

        <!-- ROW -->
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mt-0 text-start"> <span class="fs-14 font-weight-semibold">Total Lend Amount</span>
                                            <h3 class="mb-0 mt-1 mb-2">{{ $totalLendAmount }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="icon1 bg-success my-auto  float-end"> <i class="feather feather-users"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mt-0 text-start"> <span class="fs-14 font-weight-semibold">Total Borrow Amount</span>
                                            <h3 class="mb-0 mt-1 mb-2">{{ $totalBorrowAmount }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="icon1 bg-primary my-auto  float-end"> <i class="feather feather-box"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mt-0 text-start"> <span class="fs-14 font-weight-semibold">Total Bank Account</span>
                                        <h3 class="mb-0 mt-1  mb-2">{{ $totalBankAccount }}</h3> </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="icon1 bg-danger brround my-auto  float-end"> <i class="fa fa-wpforms"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h3 class="card-title">Monthly Total Income & Expense</h3>
                    </div>
                    <div class="card-body">
                        <div id="chart-bar" class="chartsh "></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <div class="card-title">Monthly Expense Chart</div>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-wrapper-demo">
                            <div id="chart2" class="h-300 mh-300"></div>
                        </div>
                    </div>
                </div>
            </div><!-- col-6 -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <div class="card-title">Monthly Income Chart</div>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-wrapper-demo">
                            <div id="chart20" class="h-300 mh-300"></div>
                        </div>
                    </div>
                </div>
            </div><!-- col-6 -->
            {{-- <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <div class="card-title">Area Chart</div>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-wrapper-demo">
                             <div id="chart" class="h-300 mh-300"></div>
                        </div>
                    </div>
                </div>
            </div><!-- col-6 --> --}}
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

@endsection

@section('scripts')

<script>
      var incomesData = @json($IncomemonthlySum);
      var expensesData = @json($ExpensemonthlySum);
      var ExpensenameArray = @json($ExpensenameArray);
      var ExpenseamountArray = @json($ExpenseamountArray);
      var IncomenameArray = @json($IncomenameArray);
      var IncomeamountArray = @json($IncomeamountArray);
      
      var chart = c3.generate({
    bindto: '#chart-bar',
    // id of chart wrapper
    data: {
      columns: [
            ['data1'].concat(incomesData),
            ['data2'].concat(expensesData),
        ],
      type: 'bar',
      // default type of chart
      colors: {
        data1: '#3366ff',
        data2: '#fe7f00'
      },
      names: {
        // name of each serie
        'data1': 'Income',
        'data2': 'Expense'
      }
    },
    axis: {
      x: {
        type: 'category',
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'August', 'September', 'October', 'November', 'December']
      }
    },
    bar: {
      width: 16
    },
    legend: {
      show: false 

    },
    padding: {
      bottom: 0,
      top: 0
    }
  });
</script>

<script>
    var options2 = {
  series: [{
    data: ExpenseamountArray
  }],
  colors: ['#3366ff', '#fe7f00'],
  chart: {
    type: 'bar',
    height: 300
  },
  plotOptions: {
    bar: {
      horizontal: true
    }
  },
  dataLabels: {
    enabled: false
  },
  xaxis: {
    categories: ExpensenameArray
  },
  legend: {
    show: false
  }
};
var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
chart2.render();
</script>

<script>
    var options20 = {
  series: [{
    data: IncomeamountArray
  }],
  colors: ['#3366ff', '#fe7f00'],
  chart: {
    type: 'bar',
    height: 300
  },
  plotOptions: {
    bar: {
      horizontal: true
    }
  },
  dataLabels: {
    enabled: false
  },
  xaxis: {
    categories: IncomenameArray
  },
  legend: {
    show: false
  }
};
var chart20 = new ApexCharts(document.querySelector("#chart20"), options20);
chart20.render();
</script>
    
@endsection