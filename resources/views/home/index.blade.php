

@extends('layouts.app')

@section('title', __('home.home'))
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js" integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg==" crossorigin="anonymous"></script>
@section('content')
<style>
@font-face {
  font-family: "icomoon";
  src: url("fonts/icomoon.eot");
  src: url("fonts/icomoon.eot?#iefix") format("embedded-opentype"), url("fonts/icomoon.woff")
      format("woff"), url("fonts/icomoon.ttf") format("truetype"), url("fonts/icomoon.svg#icomoon")
      format("svg");
  font-weight: normal;
  font-style: normal;
}
    .info-box-text {
    color: #01070e;
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 2px;
}

h5{
    font-family: 'Cairo', sans-serif;
        color: inherit;

}
.row-custom .col-custom {
    display: flex;
    /* margin: 0px; */
    padding: 0px 4px;
    margin: 0px 0px;
}
.box, .info-box {
    margin-bottom: 7px;
    box-shadow: 0 0 2rem 0 rgba(136,152,170,.15)!important;
    border-radius: 5px;
}
.box-icon{
    color: #40485b !important;
    background:white !important;
    text-align:center;
    border: none;
}
.box-icon:hover{
 background: #40485b !important;
    color:white !important;
    text-align:center;
}
.parent-box{
    border:1px solid #ddd;
    height: 110px;
    background:white;
    padding-top: 20px;
    color: #40485b;
 
}

.parent-box h5{
     font-family: 'Cairo', sans-serif;
      font-size: 13px;
}
.parent-box i{
         font-size: 36px;

    
}
.list-group-item {
    position: relative;
    display: block;
    padding: 5px 15px;
    margin-bottom: -1px;
    background: inherit;
    border: none;
    
}
.parent-box:hover{
    font-size: 36px;
    background: #40485b !important;
    color:white !important;
}
.list-group-item a{
        color: inherit;
        font-size: 10px;
        text-decoration: inherit;
}
.list-group-item a:hover{
        color: inherit;
        font-size: 10px;
        text-decoration: revert;
}
.icon-user-tie:before {
  content: "\e976";
}
.list-group-item {
    position: relative;
    display: block;
    padding: 9px 15px;
    margin-bottom: -1px;
    background: inherit;
    border: none;
}
.list-group{
    color: #40485b !important;
    background:white !important;
    text-decoration: none;
    height: 331px;
    
}
.list-group:hover{
    background: #40485b !important;
    color:white !important;
    text-decoration: revert;
}
.row{
    background:#fafafa;
}
.info-box-new-style .info-box-content {
    padding: 6px 12px 6px 12px;
    margin-left: 64px;
}
.info-box-number{
    float:left;
}
.total-labels{
    font-size:20px !important;
    float:right;
}
.change-charts{
    z-index: 100;
    position: relative;
    top: 36px;
    left:  -55%;
}

}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<!-- Content Header (Page header) -->

@if(auth()->user()->can('dashboard.data'))
<!-- Main content -->
<section class="content content-custom no-print">
    @if(!empty($widgets['after_sale_purchase_totals']))
      @foreach($widgets['after_sale_purchase_totals'] as $widget)
        {!! $widget !!}
      @endforeach
    @endif
    @if(!empty($all_locations))
  	<!-- sales chart start -->
  	<div class="row">
  	  
  		<div class="col-sm-6 thirty_day"> 
  		 <div class="col-md-4 col-xs-12">
      @if(count($all_locations) > 1)
        {!! Form::select('dashboard_location', $all_locations, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_location'), 'id' => 'dashboard_location']); !!}
      @endif
    </div>
  		    <button class="btn btn-default change-charts" onClick="change_chart();"><i class="fas fa-arrows-alt-h"></i></button>
            @component('components.widget', ['class' => 'box-primary', 'title' => __('home.sells_last_30_days')])
              {!! $sells_chart_1->container() !!}
            @endcomponent
  		</div>
  	
    @endif
    @if(!empty($widgets['after_sales_last_30_days']))
      @foreach($widgets['after_sales_last_30_days'] as $widget)
        {!! $widget !!}
      @endforeach
    @endif
    @if(!empty($all_locations))
  
  		<div class="col-sm-6 sells_currency" style="display:none">
  		    	 <div class="col-md-4 col-xs-12">
                  @if(count($all_locations) > 1)
                    {!! Form::select('dashboard_location', $all_locations, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_location'), 'id' => 'dashboard_location']); !!}
                  @endif
                </div>
  		    <button class="btn btn-default change-charts" onClick="change_chart();"><i class="fas fa-arrows-alt-h"></i></button>
            @component('components.widget', ['class' => 'box-primary', 'title' => __('home.sells_current_fy')])
              {!! $sells_chart_2->container() !!}
            @endcomponent
  		</div>
  	<div class="col-sm-4">
  	    <h5 >
  	        <i class="fas fa-rocket"></i>
  	        اجراءات عاجلة
  	    </h5>
  	    <div class="col-md-4 parent-box">
  	        <button type="button" class="box-icon btn-modal" 
                    data-href="{{action('ContactController@create', ['type' => 'customer'])}}" 
                    data-container=".contact_modal">
                      <h5><i class="fas fa-user"></i></h5>  
                     <h5>اضافة عميل</h5>
            </button>
                    <!--
  	        <a class="box-icon" href="{{URL::to('/contacts?type=customer')}}">
  	          <h5><i class="fas fa-user"></i></h5>  
  	            <h5>اضافة عميل</h5>
  	        </a>-->
  	    </div>
  	    <div class="col-md-4 parent-box">
  	        <a class="box-icon" href="{{URL::to('/sells/create')}}">
  	          <h5><i class="fa fa-calculator fa-lg"></i></h5>  
  	            <h5>انشاء عرض   </h5>
  	        </a>
  	    </div>
  	    <div class="col-md-4 parent-box">
  	        <a class="box-icon" href="{{URL::to('/pos/create')}}">
  	         <h5><i class="fas fa-file-invoice"></i></i></h5>
  	            <h5>انشاء  بيع  </h5>
  	        </a>
  	    </div>
  	    <div class="col-md-4 parent-box">
  	       <button type="button" class="box-icon btn-modal" 
                    data-href="{{action('ContactController@create', ['type' => 'supplier'])}}" 
                    data-container=".contact_modal">
                      <h5><i class="fas fa-user-tie"></i></h5>  
                     <h5>اضافة مورد</h5>
            </button>
  	    </div>
  	    <div class="col-md-4 parent-box">
  	        <a class="box-icon" href="{{URL::to('/purchases/create')}}">
  	             <h5><i class="far fa-file-alt"></i></h5>  
  	            
  	            <h5>فاتورة شراء </h5>
  	        </a>
  	    </div>
  	    <div class="col-md-4 parent-box">
  	        <a class="box-icon" href="{{URL::to('/products/create')}}">
  	          <h5><i class="fas fa-cube"></i></h5>  
  	            <h5> ادخال منتج</h5>
  	        </a>
  	    </div>
  	    <div class="col-md-4 parent-box">
  	        <a class="box-icon" href="{{URL::to('/contacts?type=customer')}}">
  	          <h5><i class="far fa-credit-card"></i></h5>  
  	            <h5>دفعات البيع </h5>
  	        </a>
  	    </div>
  	    <div class="col-md-4 parent-box">
  	        <a class="box-icon" href="{{URL::to('/contacts?type=supplier')}}">
  	          <h5><i class="fas fa-shopping-cart"></i></i></h5>  
  	            <h5>دفعات الشراء </h5>
  	        </a>
  	    </div>
  	    <div class="col-md-4 parent-box">
  	        <a class="box-icon" href="{{URL::to('/expenses/create')}}">
  	          <h5><i class="fas fa-dollar-sign"></i></h5>  
  	            <h5>ادخل مصروف </h5>
  	        </a>
  	    </div>
  	    
  	</div>
  	<div class="col-md-2" style="margin-right: -31px;">
  	    <h5 style="color:white">
  	        <i class="fas fa-rocket"></i>
  	        اجراءات عاجلة
  	    </h5>
  	    <ul class="list-group" style="width: 176px;border: 1px solid #ddd;">
        
           <li class="list-group-item">
              <i class="fas fa-file-invoice"></i>
              <a href="{{URL::to('/reports/product-purchase-report')}}">تقادم فواتير الشراء </a>
          </li>
           <li class="list-group-item">
              <i class="fas fa-file-invoice"></i>
              <a href="{{URL::to('/reports/purchase-payment-report')}}">  سجل دفعات الشراء </a>
          </li>
          
         <li class="list-group-item">
              <i class="fas fa-file-invoice"></i>
              <a href="{{URL::to('/reports/customer-supplier')}}">  الرصيد المتبقي للعملاء</a>
          </li>
          <li class="list-group-item">
              <i class="fas fa-file-invoice"></i>
              <a href="{{URL::to('/reports/customer-supplier')}}"> رصيد الموردين</a>
          </li>
          <li class="list-group-item">
              <i class="fas fa-file-invoice"></i>
              <a href="{{URL::to('/sells')}}"> المبيعات حسب الزبون</a>
          </li>
          <li class="list-group-item">
              <i class="fas fa-file-invoice"></i>
              <a href="{{URL::to('/reports/sales-representative-report')}}"> مبيعات كل مندوب</a>
          </li>
          <li class="list-group-item">
              <i class="fas fa-file-invoice"></i>
              <a href="{{URL::to('/products')}}"> قائمة اسعار المنتجات</a>
          </li>
           <li class="list-group-item">
              <i class="fas fa-file-invoice"></i>
              <a href="{{URL::to('/expenses')}}"> لائحة المصروفات</a>
          </li>
       <li class="list-group-item">
              <center>
                  <h5 style="font-family: 'Cairo', sans-serif;">التقارير</h5>
              </center>
          </li>
         
        </ul>
  	</div>
  </div>
    @endif
    <script>
    function change_chart(){
        $(".sells_currency").toggle();
         $(".thirty_day").toggle();
    }
</script>
  	<!-- sales chart end -->
    @if(!empty($widgets['after_sales_current_fy']))
      @foreach($widgets['after_sales_current_fy'] as $widget)
        {!! $widget !!}
      @endforeach
    @endif
  <br>
	<div class="row">
   
		<div class="col-md-8 col-xs-12"style="display:none">
			<div class="btn-group pull-right" data-toggle="buttons">
				<label class="btn btn-info active">
    				<input type="radio" name="date-filter"
    				data-start="{{ date('Y-m-d') }}" 
    				data-end="{{ date('Y-m-d') }}"
    				checked> {{ __('home.today') }}
  				</label>
  				<label class="btn btn-info">
    				<input type="radio" name="date-filter"
    				data-start="{{ $date_filters['this_week']['start']}}" 
    				data-end="{{ $date_filters['this_week']['end']}}"
    				> {{ __('home.this_week') }}
  				</label>
  				<label class="btn btn-info">
    				<input type="radio" name="date-filter-month"
    				data-start="{{ $date_filters['this_month']['start']}}" 
    				data-end="{{ $date_filters['this_month']['end']}}"
    				checked> {{ __('home.this_month') }}
  				</label>
  				<label class="btn btn-info">
    				<input type="radio" name="date-filter-year" 
    				data-start="{{ $date_filters['this_fy']['start']}}" 
    				data-end="{{ $date_filters['this_fy']['end']}}" 
    				checked> {{ __('home.this_fy') }}
  				</label>
            </div>
		</div>
	</div>
	<br>

	<div class="row row-custom">
	    <div class="col-md-6">
	        <div class="box box-warning">
    	      <div class="box-body">
    	        <div class="row">
    	            <div class="col-md-6 col-sm-6 col-xs-12 col-custom">
            	      <div class="info-box info-box-new-style">
    
            	        <div class="info-box-content">
            	          <span class="info-box-text" style="color:#2d91ea">{{ __('home.total_purchase') }}</span>
            	          <table style="width:185px">
            	              <tr>
            	                  <td><span class="total-labels">اليوم : </span></td>
            	                  <td><span class="info-box-number total_purchase"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i> </span></td>
            	              </tr>
            	              <tr>
            	                  <td></span><span class="total-labels">الشهر : </span></td>
            	                  <td><span class="info-box-number total_purchase_month"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></td>
            	              </tr>
            	              <tr>
            	                  <td></span><span class="total-labels">السنة  : </span></td>
            	                  <td><span class="info-box-number total_purchase_year"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></td>
            	              </tr>
            	          </table>
            	        </div>
            	        <!-- /.info-box-content -->
            	      </div>
            	      <!-- /.info-box -->
            	    </div>
            	    <!-- /.col -->
            	    <div class="col-md-6 col-sm-6 col-xs-12 col-custom">
            	      <div class="info-box info-box-new-style">
    
            	        <div class="info-box-content">
            	          <span class="info-box-text" style="color:#3ebfbe">{{ __('home.total_sell') }}</span>
            	           <table style="width:185px">
            	              <tr>
            	                  <td><span class="total-labels">اليوم : </span></td>
            	                  <td><span class="info-box-number total_sell"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i> </span></td>
            	              </tr>
            	              <tr>
            	                  <td></span><span class="total-labels">الشهر : </span></td>
            	                  <td><span class="info-box-number total_sell_month"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></td>
            	              </tr>
            	              <tr>
            	                  <td></span><span class="total-labels">السنة  : </span></td>
            	                  <td><span class="info-box-number total_sell_year"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></td>
            	              </tr>
            	          </table>
            	          

            	        </div>
            	        <!-- /.info-box-content -->
            	      </div>
            	      <!-- /.info-box -->
            	    </div>
            	    <!-- /.col -->
    	        </div>
    	   <div class="row"> 
    	    <div class="col-md-6 col-sm-6 col-xs-12 col-custom">
    	      <div class="info-box info-box-new-style">
    	       
    
    	        <div class="info-box-content">
    	          <span class="info-box-text" style="color:#ffb553">مستحقات مبيعات</span>
    	            <table style="width:185px">
            	              <tr>
            	                  <td><span class="total-labels">اليوم : </span></td>
            	                  <td><span class="info-box-number purchase_due"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i> </span></td>
            	              </tr>
            	              <tr>
            	                  <td></span><span class="total-labels">الشهر : </span></td>
            	                  <td><span class="info-box-number purchase_due_month"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></td>
            	              </tr>
            	              <tr>
            	                  <td></span><span class="total-labels">السنة  : </span></td>
            	                  <td><span class="info-box-number purchase_due_year"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></td>
            	       </tr>
            	   </table>
    	        </div>
    	        <!-- /.info-box-content -->
    	      </div>
    	      <!-- /.info-box -->
    	    </div>
    	    <!-- /.col -->
    
    	    <!-- fix for small devices only -->
    	    <!-- <div class="clearfix visible-sm-block"></div> -->
    	    <div class="col-md-6 col-sm-6 col-xs-12 col-custom">
    	      <div class="info-box info-box-new-style">
    	        
    
    	        <div class="info-box-content">
    	          <span class="info-box-text" style="color:#f33e6f">مستحقات مشتريات</span>
    	          <table style="width:185px">
            	              <tr>
            	                  <td><span class="total-labels">اليوم : </span></td>
            	                  <td><span class="info-box-number invoice_due"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i> </span></td>
            	              </tr>
            	              <tr>
            	                  <td></span><span class="total-labels">الشهر : </span></td>
            	                  <td><span class="info-box-number invoice_due_month"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></td>
            	              </tr>
            	              <tr>
            	                  <td></span><span class="total-labels">السنة  : </span></td>
            	                  <td><span class="info-box-number invoice_due_year"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></td>
            	              </tr>
            	   </table>
    	         
    	        </div>
    	        <!-- /.info-box-content -->
    	      </div>
    	      <!-- /.info-box -->
    	    </div>
    	    <!-- /.col -->
    	   </div>
    	      <div class="row">
            <!-- expense -->
            <div class="col-md-12 col-sm-12 col-xs-12 col-custom">
              <div class="info-box info-box-new-style">
                
    
                <div class="info-box-content">
                  <span class="info-box-text" style="color:#64d2e9">
                    {{ __('lang_v1.expense') }}
                  </span>
                  <table style="width:185px">
            	              <tr>
            	                  <td><span class="total-labels">اليوم : </span></td>
            	                  <td><span class="info-box-number total_expense"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i> </span></td>
            	              </tr>
            	              <tr>
            	                  <td></span><span class="total-labels">الشهر : </span></td>
            	                  <td><span class="info-box-number total_expense_month"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></td>
            	              </tr>
            	              <tr>
            	                  <td></span><span class="total-labels">السنة  : </span></td>
            	                  <td><span class="info-box-number total_expense_year"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></td>
            	              </tr>
            	   </table>
                  
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
        </div>
    	 </div>
	   </div>   
	    </div>
	    
	  <div class="col-md-6">
            <div class="box box-warning">
    	      <div class="box-body">
        	<div class="row" style="background:#fff">
        	    <label> أعلى المصاريف حسب التصنيف</label>
        	    <div class="col-md-12">
                    <canvas id="myChart" width="400" height="190"></canvas>
                    <script>
                    var ctx = document.getElementById('myChart');
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: [
                                @foreach($expenses as $row)
                                '{{$row->category ?? "اخري" }}',
                               @endforeach
                                ],
                            datasets: [{
                                label: '# of Votes',
                                data: [
                                    @foreach($expenses as $row)
                                   '{{$row->total_expense}}',
                                     @endforeach
                                    ],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: '  أعلى المصاريف حسب التصنيف ',
                                position: 'top',
                            },
                              legend: {
                              
                                position: 'left',
                            }
                        }
                      
                    });
                    </script>  	      
        	</div>
	  </div>
	  </div>
	  </div>
	  <div class="box box-warning">
    	      <div class="box-body">
	  	<div class="row" style="background:#fff">
        	    <div class="col-md-12">
        	        <label>الفواتير الأخيرة لجميع المستخدمين</label>
                  @php
                    	$subtype = '';
                    @endphp
                    @if(!empty($transaction_sub_type))
                    	@php
                    		$subtype = '?sub_type='.$transaction_sub_type;
                    	@endphp
                    @endif
                    
                    @if(!empty($transactions))
                    	<table class="table table-slim no-border" style="font-size: small;">
                    	    <tr>
                    	        <th>#</th>
                    	        <th>رقم الفاتورة</th>
                    	        <th>اسم العميل</th>
                    	        <th>الاجمالي </th>
                    	        <th>اجراء</th>
                    	    </tr>
                    		@foreach ($transactions as $transaction)
                    			<tr class="cursor-pointer" 
                    	    		title="Customer: {{optional($transaction->contact)->name}} 
                    		    		@if(!empty($transaction->contact->mobile) && $transaction->contact->is_default == 0)
                    		    			<br/>Mobile: {{$transaction->contact->mobile}}
                    		    		@endif
                    	    		" >
                    				<td>
                    					{{ $loop->iteration}}.
                    				</td>
                    				<td>{{ $transaction->invoice_no }}</td>
                    				<td>
                    				 ({{optional($transaction->contact)->name}})
                    					@if(!empty($transaction->table))
                    						- {{$transaction->table->name}}
                    					@endif
                    				</td>
                    				<td class="display_currency">
                    					{{ $transaction->final_total }}
                    				</td>
                    				<td>
                    				    <!--
                    					<a href="{{action('SellPosController@edit', [$transaction->id]).$subtype}}">
                    	    				<i class="fas fa-pen text-muted" aria-hidden="true" title="{{__('lang_v1.click_to_edit')}}"></i>
                    	    			</a>
                    	    			
                    	    			<a href="{{action('SellPosController@destroy', [$transaction->id])}}" class="delete-sale" style="padding-left: 20px; padding-right: 20px"><i class="fa fa-trash text-danger" title="{{__('lang_v1.click_to_delete')}}"></i></a>
                                        -->
                    	    			<a href="{{action('SellPosController@printInvoice', [$transaction->id])}}" class="print-invoice-link">
                    	    				<i class="fa fa-print text-muted" aria-hidden="true" title="{{__('lang_v1.click_to_print')}}"></i>
                    	    			</a>
                    				</td>
                    			</tr>
                    		@endforeach
                    	</table>
                    @else
                    	<p>@lang('sale.no_recent_transactions')</p>
                    @endif
                    <script>
                        $(document).on('click', '.print-invoice-link', function(e) {
                            e.preventDefault();
                            $.ajax({
                                url: $(this).attr('href') + "?check_location=true",
                                dataType: 'json',
                                success: function(result) {
                                    if (result.success == 1) {
                                        //Check if enabled or not
                                        if (result.receipt.is_enabled) {
                                            pos_print(result.receipt);
                                        }
                                    } else {
                                        toastr.error(result.msg);
                                    }
                        
                                },
                            });
                        });
function pos_print(receipt) {
    //If printer type then connect with websocket
    if (receipt.print_type == 'printer') {
        var content = receipt;
        content.type = 'print-receipt';

        //Check if ready or not, then print.
        if (socket != null && socket.readyState == 1) {
            socket.send(JSON.stringify(content));
        } else {
            initializeSocket();
            setTimeout(function() {
                socket.send(JSON.stringify(content));
            }, 700);
        }

    } else if (receipt.html_content != '') {
        //If printer type browser then print content
        $('#receipt_section').html(receipt.html_content);
        __currency_convert_recursively($('#receipt_section'));
        __print_receipt('receipt_section');
    }
}

                    </script>
        	</div>
	        </div>
        </div>
        </div>
  	</div>
  
</div>
    
  	<!-- products less than alert quntity -->
  	<div class="row">

      <div class="col-sm-6">
        @component('components.widget', ['class' => 'box-warning'])
          @slot('icon')
            <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
          @endslot
          @slot('title')
            {{ __('lang_v1.sales_payment_dues') }} @show_tooltip(__('lang_v1.tooltip_sales_payment_dues'))
          @endslot
          <table class="table table-bordered table-striped" id="sales_payment_dues_table">
            <thead>
              <tr>
                <th>@lang( 'contact.customer' )</th>
                <th>@lang( 'sale.invoice_no' )</th>
                <th>@lang( 'home.due_amount' )</th>
              </tr>
            </thead>
          </table>
        @endcomponent
      </div>

  		<div class="col-sm-6">

        @component('components.widget', ['class' => 'box-warning'])
          @slot('icon')
            <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
          @endslot
          @slot('title')
            {{ __('lang_v1.purchase_payment_dues') }} @show_tooltip(__('tooltip.payment_dues'))
          @endslot
          <table class="table table-bordered table-striped" id="purchase_payment_dues_table">
            <thead>
              <tr>
                <th>@lang( 'purchase.supplier' )</th>
                <th>@lang( 'purchase.ref_no' )</th>
                        <th>@lang( 'home.due_amount' )</th>
              </tr>
            </thead>
          </table>
        @endcomponent

  		</div>
    </div>

    <div class="row">
      
      <div class="col-sm-6">
        @component('components.widget', ['class' => 'box-warning'])
          @slot('icon')
            <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
          @endslot
          @slot('title')
            {{ __('home.product_stock_alert') }} @show_tooltip(__('tooltip.product_stock_alert'))
          @endslot
          <table class="table table-bordered table-striped" id="stock_alert_table">
            <thead>
              <tr>
                <th>@lang( 'sale.product' )</th>
                <th>@lang( 'business.location' )</th>
                        <th>@lang( 'report.current_stock' )</th>
              </tr>
            </thead>
          </table>
        @endcomponent
      </div>
      @can('stock_report.view')
        @if(session('business.enable_product_expiry') == 1)
          <div class="col-sm-6">
              @component('components.widget', ['class' => 'box-warning'])
                  @slot('icon')
                    <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                  @endslot
                  @slot('title')
                    {{ __('home.stock_expiry_alert') }} @show_tooltip( __('tooltip.stock_expiry_alert', [ 'days' =>session('business.stock_expiry_alert_days', 30) ]) )
                  @endslot
                  <input type="hidden" id="stock_expiry_alert_days" value="{{ \Carbon::now()->addDays(session('business.stock_expiry_alert_days', 30))->format('Y-m-d') }}">
                  <table class="table table-bordered table-striped" id="stock_expiry_alert_table">
                    <thead>
                      <tr>
                          <th>@lang('business.product')</th>
                          <th>@lang('business.location')</th>
                          <th>@lang('report.stock_left')</th>
                          <th>@lang('product.expires_in')</th>
                      </tr>
                    </thead>
                  </table>
              @endcomponent
          </div>
        @endif
      @endcan
  	</div>

    @if(!empty($widgets['after_dashboard_reports']))
      @foreach($widgets['after_dashboard_reports'] as $widget)
        {!! $widget !!}
      @endforeach
    @endif
</section>
 <div class="modal fade contact_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>
<!-- /.content -->
@stop
@section('javascript')
<?php // dd($sells_chart_1->script());?>
    <script src="{{ asset('js/home.js?v=' . $asset_v) }}"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <!--ch11-->
    @if(!empty($all_locations))
      {!! $sells_chart_1->script() !!}
      {!! $sells_chart_2->script() !!}
    @endif
@endif
<script type="text/javascript">
    $(document).on('shown.bs.modal', '.contact_modal', function(e) {
        initAutocomplete();
    });
</script>
@endsection

