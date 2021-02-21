@if(!empty($__subscription) && env('APP_ENV') != 'demo')
  <button type="button" class="btn btn-success btn-flat pull-left m-8 hidden-xs btn-sm mt-10 popover-default" data-toggle="collapse" data-target="#ac_sub">  تفاصيل ترخيص النشاط <i class="fas fa-info-circle"></i></button>

 <style>
     #ac_sub{
         position: fixed;
        background: white;
        z-index: 10;
        border: 2px solid;
        padding: 10px;
        border-radius: 7px;
        top:47px;
  
     }
 </style>  
   
   <div id="ac_sub" class="collapse">
       <h3>تفاصيل ترخيص النشاط</h3>
    <table class='table table-condensed'>
     <tr class='text-center'> 
        <td colspan='2'>
            {{$__subscription->package_details['name'] }}
        </td>
     </tr>
     <tr class='text-center'>
        <td colspan='2'>
            تاريخ بداية الترخيص :
            {{ @format_date($__subscription->start_date) }} 
        </td>
     </tr>
      <tr class='text-center'>
        <td colspan='2'>
            تاريخ نهاية الترخيص :
           {{@format_date($__subscription->end_date) }}
        </td>
     </tr>
     <tr> 
        <td colspan='2'>
            <i class='fa fa-check text-success'></i>
             @lang('business.business_locations')
            @if($__subscription->package_details['location_count'] == 0)
                @lang('superadmin::lang.unlimited')
            @else
                {{$__subscription->package_details['location_count']}}
            @endif

           
        </td>
     </tr>
     <tr>
        <td colspan='2'>
            <i class='fa fa-check text-success'></i>
             @lang('superadmin::lang.users')
            @if($__subscription->package_details['user_count'] == 0)
                @lang('superadmin::lang.unlimited')
            @else
                {{$__subscription->package_details['user_count']}}
            @endif

           
        </td>
     <tr>
     <tr>
        <td colspan='2'>
            <i class='fa fa-check text-success'></i>
            @lang('superadmin::lang.products')
            @if($__subscription->package_details['product_count'] == 0)
                @lang('superadmin::lang.unlimited')
            @else
                {{$__subscription->package_details['product_count']}}
            @endif

            
        </td>
     </tr>
     <tr>
        <td colspan='2'>
            <i class='fa fa-check text-success'></i>
            @lang('superadmin::lang.invoices')
            @if($__subscription->package_details['invoice_count'] == 0)
                @lang('superadmin::lang.unlimited')
            @else
                {{$__subscription->package_details['invoice_count']}}
            @endif

            
        </td>
     </tr>
     
    </table>                     
</div>
@endif