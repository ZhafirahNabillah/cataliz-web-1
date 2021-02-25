@if (in_array(Route::currentRouteName(), ['login', 'show_register.coach','show_register.coachee']))
<!-- BEGIN: Vendor JS-->

<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('assets/js/scripts/pages/page-auth-login.js')}}"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
</script>

@elseif (in_array(Route::currentRouteName(), ['clients.index', 'plans.index', 'agendas.index', 'clients.show',
'plans.show', 'dashboard','roles.index','permissions.index','users.index', 'class.index', 'class.show']))


<!-- BEGIN: Vendor JS-->

<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
<script src="{{ asset('assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{ asset('assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/vendors/js/tables/datatable/jszip.min.js')}}"></script>
<script src="{{ asset('assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')}}"></script>
<!--
    <script src="{{ asset('assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
	-->
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('assets/js/core/app-menu.js')}}"></script>
<script src="{{ asset('assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->

<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })



</script>

@else

<!-- BEGIN: Vendor JS-->

<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{ asset('assets/vendors/js/extensions/toastr.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('assets/js/core/app-menu.js')}}"></script>
<script src="{{ asset('assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
</script>

@endif
