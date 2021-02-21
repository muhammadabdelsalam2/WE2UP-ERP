<!-- app css -->
@if(!empty($for_pdf))
	<link rel="stylesheet" href="{{ asset('css/app.css?v='.$asset_v) }}">
	<style>
	    body{
	        direction:rtl !important;
	    }
	</style>
@endif
<div class="col-md-12 col-sm-12 @if(!empty($for_pdf)) width-100 align-right @endif">
        <p class="text-right align-right"><strong>{{$contact->business->name}}</strong><br>{!! $contact->business->business_address !!}</p>
</div>
<div class="col-md-6 col-sm-6 col-xs-6 @if(!empty($for_pdf)) width-50 f-left @endif" style="float: left;margin-top: -135px;">
	<p class="blue-heading p-4 width-50">@lang('lang_v1.to'):</p>
	<p><strong>{{$contact->name}}</strong><br> {!! $contact->contact_address !!} @if(!empty($contact->email)) <br>@lang('business.email'): {{$contact->email}} @endif
	<br>@lang('contact.mobile'): {{$contact->mobile}}
	@if(!empty($contact->tax_number)) <br>@lang('contact.tax_no'): {{$contact->tax_number}} @endif
</p>
</div>

<div class="col-md-12 col-sm-12 @if(!empty($for_pdf)) width-100 @endif">
	<p class="text-center" style="text-align: center;"><strong>@lang('lang_v1.ledger_table_heading', ['start_date' => $ledger_details['start_date'], 'end_date' => $ledger_details['end_date']])</strong></p>
	<table class="table table-striped @if(!empty($for_pdf)) table-pdf td-border @endif" id="ledger_table">
		<thead>
			<tr class="row-border blue-heading">
				<th>تاريخ المعاملة</th>
				<th>@lang('purchase.ref_no')</th>
				<th>نوع الحركة</th>
				<th>@lang('sale.location')</th>
				<th>@lang('sale.payment_status')</th>
				<th>دائن </th>
				<th>@lang('account.debit')</th>
				<th>دفعات</th>
				<th>@lang('lang_v1.payment_method')</th>
				<th>@lang('report.others')</th>
			</tr>
		</thead>
		<tbody>
		    <!---
		    "location_id" => 3
        "res_table_id" => null
        "res_waiter_id" => null
        "res_order_status" => null
        "type" => "sell"
        "sub_type" => null
        "status" => "final"
        "is_quotation" => 0
        "payment_status" => "paid"
        "adjustment_type" => null
        "contact_id" => 4
		    -->
		    <?php $ledgers=array_reverse($ledger_details['ledger'],true);
		    $sum_debit=0;
		    $sum_credit=0;
		  //  dd($ledgers);
		    ?>
			@foreach( $ledgers as $data)
				<tr @if(!empty($for_pdf) && $loop->iteration % 2 == 0) class="odd" @endif>
					<td class="row-border">{{@format_datetime($data['date'])}}</td>
					<td>{{$data['ref_no']}}</td>
					<td>{{$data['type']}}</td>
					<td>{{$data['location']}}</td>
					<td>{{$data['payment_status']}}</td>
					@if($data['transaction_type'] =='purchase_return' || $data['transaction_type'] =='payment' || $data['transaction_type'] =='sell')
					  
					        <td class="ws-nowrap align-right"></td>
					        <td class="ws-nowrap align-right"> @format_currency($data['total']) </td>
					  
					@else
					    @if($data['payment_status_label'] =='payment')
					    <td class="ws-nowrap align-right"> @format_currency($data['credit']) </td>
					        <td class="ws-nowrap align-right">@format_currency($data['debit'])</td>
					   @else
					      <td class="ws-nowrap align-right"> @format_currency($data['total']) </td>
					    <td class="ws-nowrap align-right">  </td>
					   @endif
					    
					@endif
					<td></td>
					
					<td>{{$data['payment_method']}}</td>
					<td>{!! $data['others'] !!}</td>
				</tr>
				@if(isset($data['debit']))
			<?php
				$sum_debit += (float)$data['debit'];
				?>
				@endif
				
				@if(isset($data['credit']))
			<?php
				$sum_credit += (float)$data['credit']+(float)$data['total'];
				?>
				@endif
				
			@endforeach
		</tbody>
		<tfooter>
		    <tr>
		        <th colspan="5">المجموع</th>
		        <th> @format_currency($sum_credit)</th>
		        <th> @format_currency($sum_debit)</th>
		    </tr>
		</tfooter>
	</table>
</div>
<div class="col-md-6 col-sm-6 col-xs-6 text-right align-right @if(!empty($for_pdf)) width-50 f-right @endif">
	<h3 class="mb-0 blue-heading p-4">@lang('lang_v1.account_summary')</h3>
	<small>{{$ledger_details['start_date']}} @lang('lang_v1.to') {{$ledger_details['end_date']}}</small>
	<hr>
	<table class="table table-condensed text-right align-right no-border @if(!empty($for_pdf)) table-pdf @endif">
		<tr>
			<td>@lang('lang_v1.opening_balance')</td>
			<td class="align-right">@format_currency($ledger_details['beginning_balance'])</td>
		</tr>
	@if( $contact->type == 'supplier' || $contact->type == 'both')
	
		<tr>
			<td>اجمالي مرتجع المشتريات</td>

			<td class="align-right">@format_currency($ledger_details['total_purchase_return'])</td>
		</tr>
		<tr>
			<td>@lang('report.total_purchase')</td>

			<td class="align-right">@format_currency($ledger_details['total_purchase'])</td>
		</tr>
	@endif
	@if( $contact->type == 'customer' || $contact->type == 'both')
		<tr>
			<td>@lang('lang_v1.total_invoice')</td>
			<td class="align-right">@format_currency($ledger_details['total_invoice'])</td>
		</tr>
	@endif
	<tr>
		<td>@lang('sale.total_paid')</td>
		<td class="align-right">@format_currency($ledger_details['total_paid'])</td>
	</tr>
	<tr>
		<td>@lang('lang_v1.advance_balance')</td>
		<td class="align-right">@format_currency($contact->balance)</td>
	</tr>
	<tr>
		<td><strong>@lang('lang_v1.balance_due')</strong></td>
		<td class="align-right">@format_currency($ledger_details['balance_due'])</td>
	</tr>
	</table>
</div>
<div class="col-md-12 col-sm-12 @if(!empty($for_pdf)) width-100 @endif" style="display:none">
	<p class="text-center" style="text-align: center;"><strong>@lang('lang_v1.ledger_table_heading', ['start_date' => $ledger_details['start_date'], 'end_date' => $ledger_details['end_date']])</strong></p>
	<div class="table-responsive">
	<table class="table table-striped @if(!empty($for_pdf)) table-pdf td-border @endif" id="ledger_table" style="display:none">
		<thead>
			<tr class="row-border blue-heading">
				<th width="18%" class="text-center">@lang('lang_v1.date')</th>
				<th width="9%" class="text-center">@lang('purchase.ref_no')</th>
				<th width="8%" class="text-center">@lang('lang_v1.type')</th>
				<th width="10%" class="text-center">@lang('sale.location')</th>
				<th width="5%" class="text-center">@lang('sale.payment_status')</th>
				<th width="10%" class="text-center">@lang('sale.total')</th>
				<th width="10%" class="text-center">@lang('account.debit')</th>
				<th width="10%" class="text-center">@lang('account.credit')</th>
				<th width="5%" class="text-center">@lang('lang_v1.payment_method')</th>
				<th width="15%" class="text-center">@lang('report.others')</th>
			</tr>
		</thead>
		<tbody>
			@foreach($ledger_details['ledger'] as $data)
				<tr @if(!empty($for_pdf) && $loop->iteration % 2 == 0) class="odd" @endif>
					<td class="row-border">{{@format_datetime($data['date'])}}</td>
					<td>{{$data['ref_no']}}</td>
					<td>{{$data['type']}}</td>
					<td>{{$data['location']}}</td>
					<td>{{$data['payment_status']}}</td>
					<td class="ws-nowrap align-right">@if($data['total'] !== '') @format_currency($data['total']) @endif</td>
					<td class="ws-nowrap align-right">@if($data['debit'] != '') @format_currency($data['debit']) @endif</td>
					<td class="ws-nowrap align-right">@if($data['credit'] != '') @format_currency($data['credit']) @endif</td>
					<td>{{$data['payment_method']}}</td>
					<td>{!! $data['others'] !!}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>
</div>