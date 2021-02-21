<!-- Left side column. contains the logo and sidebar -->
<style>
    #wordpress-menu span{
        color:black;
    }
</style>
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

	<a href="{{route('home')}}" class="logo">
		<span class="logo-lg">{{ Session::get('business.name') }}</span>
	</a>

    <!-- Sidebar Menu -->
    {!! Menu::render('admin-sidebar-menu', 'adminltecustom'); !!}
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        var c='<li><a href="{{URL::to('/sell-returns/getinv')}}" ><i class="fa fas fa-list"></i><strong>مرتجع المبيعات</strong></a> </li>';
        var less ='';//'<li><a href="{{URL::to('/reports/less-trending-products')}}" ><i class="fa fas fa-list"></i><strong>المنتجات الراكدة </strong></a> </li>';
       
        


   
     //  $("#tour_step7 ul").append(c) ;
    
       $("#tour_step8 ul").append(less) ;
      

    });
</script>
@if (!auth()->user()->can('projects.show') ) 
    <script>
    $(document).ready(function(){
       $('a[href="{{URL::to('/project/project?project_view=list_view')}}"]').hide();
    });    
    </script>
@endif
@if (!auth()->user()->can('hrm_show') ) 
    <script>
    $(document).ready(function(){
        $('a[href="{{URL::to('/hrm/dashboard')}}"]').hide();
    });    
    </script>
@endif
@if (!auth()->user()->can('sales.show') ) 
    <script>
    $(document).ready(function(){
          $("#tour_step7").hide() ;
    });    
    </script>
@endif

    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
