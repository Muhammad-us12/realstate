
@extends('adminPanel/master')   
         @section('content')        
         
                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <form class="d-flex">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-light" id="dash-daterange">
                                                <span class="input-group-text bg-primary border-primary text-white">
                                                    <i class="mdi mdi-calendar-range font-13"></i>
                                                </span>
                                            </div>
                                            <a href="javascript: void(0);" class="btn btn-primary ms-2">
                                                <i class="mdi mdi-autorenew"></i>
                                            </a>
                                            <a href="javascript: void(0);" class="btn btn-primary ms-1">
                                                <i class="mdi mdi-filter-variant"></i>
                                            </a>
                                        </form>
                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            
                            <?php 
                                $user_role = \Auth::user()->role;
                                if($user_role == 'admin'){
                            ?>
                            <div class="col-xl-12 col-lg-6">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Sale Files</h5>
                                                <h4 class="mt-3 mb-3">{{ number_format($sales_files) }}</h4>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>Sale Files :{{ number_format($sales_files_count) }}</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-sm-2">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-cart-plus widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Purchase File</h5>
                                                <h4 class="mt-3 mb-3">{{ number_format($purchase_files) }}</h4>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>Purchase Files :{{ number_format($purchase_files_count) }}</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                    
                                    <div class="col-sm-2">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-pulse widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Growth">Commission</h5>
                                                <h4 class="mt-3 mb-3">{{ number_format($localproperty) }}</h4>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>Local Properties : {{ number_format($localpropertyCount) }}</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-sm-2">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-currency-usd widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Total Expense</h5>
                                                <h4 class="mt-3 mb-3">{{ number_format($expense) }}</h4>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i>Expenses Count :{{ number_format($expenseCount) }}</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                    <div class="col-sm-2">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-currency-usd widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Today Expense</h5>
                                                <h4 class="mt-3 mb-3">{{ number_format($today_expense) }}</h4>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i>Expenses Count :{{ number_format($today_expense_count) }}</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                    <div class="col-sm-2">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-currency-usd widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Total Profit</h5>
                                                <h4 class="mt-3 mb-3">{{ number_format($today_profit) }}</h4>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>Today Profit</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                </div> <!-- end row -->

                                

                            </div> <!-- end col -->

                            <div class="col-xl-12 col-lg-6">
                                <div class="card card-h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                           
                                            <h4 class="header-title">
                                                <span style="background-color:#39afd1;color:white;padding:5px;">Purchase</span>
                                                <span style="background-color:#0acf97;color:white;padding:5px;">Sale</span>
                                                <span style="background-color:#fa5c7c;color:white;padding:5px;">Expense</span>
                                                
                                                Chart</h4>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div dir="ltr">
                                            <div id="revenue-chart" class="apex-charts mt-3" data-colors="#727cf5,#0acf97"></div>
                                        </div>
                                            
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->

                            </div> <!-- end col -->
                            <div class="col-md-12">
                                <div class="card card-h-100">
                                    <div class="card-body">
                                       
                                        <ul class="nav float-end d-none d-lg-flex">
                                           
                                        </ul>
                                        <h4 class="header-title mb-3">Month Wise Profit Chart</h4>

                                        <div dir="ltr">
                                            <div id="sessions-overview" class="apex-charts mt-3" data-colors="#0acf97"></div>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div>
                            
                            
                            <?php 
                                }else{
                                    ?>
                                <div class="col-xl-12 col-lg-6 text-center">
                                    <img src="https://thechoicemarketing.net/public/adminPanel/assets/images/choice_logo.jpeg" style="width:40%;" alt="">
                                </div>
                                    <?php
                                }
                            ?>
                        </div>
                     
                        <!-- end row -->

                    </div>
         @endsection

         @section('scripts')
            <script>
! function(o) {
    "use strict";

    function e() {
        this.$body = o("body"), this.charts = []
    }
    e.prototype.initCharts = function() {
        window.Apex = {
            chart: {
                parentHeightOffset: 0,
                toolbar: {
                    show: !1
                }
            },
            grid: {
                padding: {
                    left: 0,
                    right: 0
                }
            },
            colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]
        };
        var e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"],
            t = o("#revenue-chart").data("colors");
        t && (e = t.split(","));
        var r = {
            chart: {
                height: 257,
                type: "bar",
                dropShadow: {
                    enabled: !0,
                    opacity: .2,
                    blur: 7,
                    left: -7,
                    top: 7
                }
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: 4
            },
            series: [{
                name: "Purchase Amount",
                data: {{ json_encode($purchase_month_ar) }}
            }, {
                name: "Sale Amount",
                data: {{ json_encode($sale_month_ar) }}
            }, {
                name: "Expense Amount",
                data: {{ json_encode($expense_month_ar) }}
            }
            ],
            colors: ["#39afd1","#0acf97","#fa5c7c"],
            zoom: {
                enabled: !1
            },
            legend: {
                show: !1
            },
            xaxis: {
                type: "string",
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                tooltip: {
                    enabled: !1
                },
                axisBorder: {
                    show: !1
                }
            },
            yaxis: {
                labels: {
                    formatter: function(e) {
                        return e + " PKR"
                    },
                    offsetX: -15
                }
            }
        };
        new ApexCharts(document.querySelector("#revenue-chart"), r).render();

        
        new ApexCharts(document.querySelector("#average-sales"), r).render()
    }, e.prototype.initMaps = function() {
        0 < o("#world-map-markers").length && o("#world-map-markers").vectorMap({
            map: "world_mill_en",
            normalizeFunction: "polynomial",
            hoverOpacity: .7,
            hoverColor: !1,
            regionStyle: {
                initial: {
                    fill: "#e3eaef"
                }
            },
            markerStyle: {
                initial: {
                    r: 9,
                    fill: "#727cf5",
                    "fill-opacity": .9,
                    stroke: "#fff",
                    "stroke-width": 7,
                    "stroke-opacity": .4
                },
                hover: {
                    stroke: "#fff",
                    "fill-opacity": 1,
                    "stroke-width": 1.5
                }
            },
            backgroundColor: "transparent",
            markers: [{
                latLng: [40.71, -74],
                name: "New York"
            }, {
                latLng: [37.77, -122.41],
                name: "San Francisco"
            }, {
                latLng: [-33.86, 151.2],
                name: "Sydney"
            }, {
                latLng: [1.3, 103.8],
                name: "Singapore"
            }],
            zoomOnScroll: !1
        })
    }, e.prototype.init = function() {
        o("#dash-daterange").daterangepicker({
            singleDatePicker: !0
        }), this.initCharts(), this.initMaps()
    }, o.Dashboard = new e, o.Dashboard.Constructor = e
}(window.jQuery),
function(t) {
    "use strict";
    t(document).ready(function(e) {
        t.Dashboard.init()
    })
}(window.jQuery);


! function(i) {
    "use strict";

    function e() {
        this.$body = i("body"), this.charts = []
    }
    e.prototype.initCharts = function() {
        window.Apex = {
            chart: {
                parentHeightOffset: 0,
                toolbar: {
                    show: !1
                }
            },
            grid: {
                padding: {
                    left: 0,
                    right: 0
                }
            },
            colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]
        };
        var e = new Date,
            t = function(e, t) {
                for (var a = new Date(t, e, 1), o = [], r = 0; a.getMonth() === e && r < 15;) {
                    var s = new Date(a);
                    o.push(s.getDate() + " " + s.toLocaleString("en-us", {
                        month: "short"
                    })), a.setDate(a.getDate() + 1), r += 1
                }
                return o
            }(e.getMonth() + 1, e.getFullYear()),
            a = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"],
            o = i("#sessions-overview").data("colors");
        o && (a = o.split(","));
        var r = {
            chart: {
                height: 309,
                type: "area"
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: 4
            },
            series: [{
                name: "Profit",
                data: {{ json_encode($total_profit) }}
            }],
            zoom: {
                enabled: !1
            },
            legend: {
                show: !1
            },
            colors: a,
            xaxis: {
                type: "string",
                categories: {!! json_encode($month_names) !!},
                tooltip: {
                    enabled: !1
                },
                axisBorder: {
                    show: !1
                },
                labels: {}
            },
            yaxis: {
                labels: {
                    formatter: function(e) {
                        return e + " PKR"
                    },
                    offsetX: -15
                }
            },
            fill: {
                type: "gradient",
                gradient: {
                    type: "vertical",
                    shadeIntensity: 1,
                    inverseColors: !1,
                    opacityFrom: .45,
                    opacityTo: .05,
                    stops: [45, 100]
                }
            }
        };
        new ApexCharts(document.querySelector("#sessions-overview"), r).render();
       
    }, e.prototype.initMaps = function() {
        0 < i("#world-map-markers").length && i("#world-map-markers").vectorMap({
            map: "world_mill_en",
            normalizeFunction: "polynomial",
            hoverOpacity: .7,
            hoverColor: !1,
            regionStyle: {
                initial: {
                    fill: "rgba(93,106,120,0.2)"
                }
            },
            series: {
                regions: [{
                    values: {
                        KR: "#e6ebff",
                        CA: "#b3c3ff",
                        GB: "#809bfe",
                        NL: "#4d73fe",
                        IT: "#1b4cfe",
                        FR: "#727cf5",
                        JP: "#e7fef7",
                        US: "#e7e9fd",
                        CN: "#8890f7",
                        IN: "#727cf5"
                    },
                    attribute: "fill"
                }]
            },
            backgroundColor: "transparent",
            zoomOnScroll: !1
        })
    }, e.prototype.init = function() {
        i("#dash-daterange").daterangepicker({
            singleDatePicker: !0
        }), this.initCharts(), this.initMaps(), window.setInterval(function() {
            var e = Math.floor(600 * Math.random() + 150);
            i("#active-users-count").text(e), i("#active-views-count").text(Math.floor(Math.random() * e + 200))
        }, 2e3)
    }, i.AnalyticsDashboard = new e, i.AnalyticsDashboard.Constructor = e
}(window.jQuery),
function() {
    "use strict";
    window.jQuery.AnalyticsDashboard.init()
}();
            </script>         
         @endsection
                    <!-- container -->

                