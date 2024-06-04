<!-- BEGIN: Vendor JS-->
<script src="{{asset('assets/vendors/js/vendors.min.js')}}"></script>
<script src="{{asset('assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('assets/vendors/js/ui/prism.min.js')}}"></script>
<script src="{{asset('assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('assets/js/scripts/datatables/datatable.js')}}"></script>
<script src="{{asset('assets/js/scripts/pages/user-profile.js')}}"></script>
<script src="{{asset('assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>
<script src=" {{asset('assets/js/scripts/extensions/ext-component-ratings.js')}} "></script>
<script src=" {{asset('assets/vendors/js/extensions/jquery.rateyo.min.js')}} "></script>
<script src="{{asset('assets/js/scripts/forms/select/form-select2.js')}}"></script>
<!-- END: Page JS-->


{{-- custom range  --}}
<script src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('vendor/daterangepicker/daterangepicker.min.js')}}"></script>

<script type="text/javascript">
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#tangalrange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        }

        $('#tanggalrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Hari ini': [moment(), moment()],
                'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
                '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
                'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Tahun ini': [moment().startOf('year'), moment().endOf('year')],
                'Tahun lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
            }
        }, cb);

        cb(start, end);
    });

    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            buttons: ['copy', 'csv', 'print', 'excel', 'pdf'],
            dom: "<'row px-2 px-md-4 pt-2'<'col-md-3'l><'col-md-5 text-center'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row px-2 px-md-4 py-3'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            columnDefs: [{
                targets: -1,
                orderable: false,
                searchable: false
            }]
        });

        table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');
    });
</script>

