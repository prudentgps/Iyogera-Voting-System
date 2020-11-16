<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    @php
    $selected_branch_id = school_id();
    $selected_branch = \App\School::find($selected_branch_id); 
    isset($title) ? $title = $title." | ".$selected_branch->name : $title = $selected_branch->name; @endphp
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Best school ERP" name="description" />
    <meta content="Iyogera NG" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backend/images/student_image/preview.png')}}">
    @include('backend.layout.styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    @livewireStyles
</head>

<body @if(Request::route()->getName() == 'daily_attendance.index' || Request::route()->getName() == 'student.create' || Request::route()->getName() == 'exam.4print' || Request::route()->getName() == 'report.index' || Request::route()->getName() == 'invoice.index'|| Request::route()->getName() == 'student.bulk' || Request::route()->getName() == 'student.excel') class="enlarged" data-keep-enlarged="true" @endif >
<!-- Begin page -->
<div class="wrapper">

    @include('backend.'.Auth::user()->role.'.navigation.navigation')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            @include('backend.layout.header')

            <!-- Start Content-->
            <div class="container-fluid">

                @yield('content')
            </div>
            <!-- container -->

        </div>
        <!-- content -->

        @include('backend.layout.footer')

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

@include('backend.layout.scripts')
@include('backend.layout.modal')
@include('backend.layout.ajax_form')
@yield('scripts')
<script>
function switchLanguage(language_code) {
    $.post('{{ route('language.switch') }}',{_token:'{{ csrf_token() }}', locale:language_code}, function(data){
        location.reload();
    });
}
</script>
<script>
  if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  endif
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

@livewireScripts
</body>
</html>
