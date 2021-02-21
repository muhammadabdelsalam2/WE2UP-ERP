@extends('layouts.auth2')
@section('title', __('lang_v1.register'))
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">
<style>
 
.text-white {
    color: #000!important;
    font-size: larger;
    font-weight: bold;
    font-family: 'Cairo', sans-serif !important;
}
</style>
@section('content')

<div class="login-form col-md-12 col-xs-12 right-col-content-register">
    
    <p class="form-header text-white">@lang('business.register_and_get_started_in_minutes')</p>
    {!! Form::open(['url' => route('business.postRegister'), 'method' => 'post', 
                            'id' => 'business_register_form','files' => true ]) !!}
        @include('business.partials.register_form')
        {!! Form::hidden('package_id', $package_id); !!}
    {!! Form::close() !!}
</div>
@stop
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_lang').change( function(){
            window.location = "{{ route('business.getRegister') }}?lang=" + $(this).val();
        });
    })
</script>
@endsection