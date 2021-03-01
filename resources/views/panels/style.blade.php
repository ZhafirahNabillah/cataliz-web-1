@if (in_array(Route::currentRouteName(), ['login', 'show_register', 'password.request', 'show_reset_form']))
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/vendors.min.css')}}">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-extended.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/colors.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/components.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/dark-layout.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/bordered-layout.css')}}">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/core/menu/menu-types/vertical-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/plugins/forms/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-auth.css')}}">
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
<!-- END: Custom CSS-->

@elseif (in_array(Route::currentRouteName(), ['clients.index', 'plans.index', 'agendas.index', 'clients.show',
'plans.show', 'dashboard','roles.index','permissions.index','users.index', 'class.index', 'class.show']))

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/vendors.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-extended.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colors.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/dark-layout.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/bordered-layout.css') }}">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/menu/menu-types/vertical-menu.css') }}">
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
<!-- END: Custom CSS-->


@else
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/vendors.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/extensions/toastr.min.css')}}">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-extended.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colors.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/dark-layout.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/bordered-layout.css')}}">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/menu/menu-types/vertical-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/dashboard-ecommerce.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/charts/chart-apex.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/extensions/ext-component-toastr.css')}}">
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
<!-- END: Custom CSS-->
@endif