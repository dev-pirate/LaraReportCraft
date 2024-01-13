<script>
    const laraReportCraftReportsListFetchRoute = "{{ route('lara_report_craft.reports_fetch') }}";
    const laraReportCraftReportsGenerateRoute = "{{ route('lara_report_craft.reports_generate') }}";
    const laraReportCraftReportsPrintingRoute = "{{ route('lara_report_craft.reports_printing', ['reportTitle' => '__#REPORTNAME#__']) }}";
</script>

<script src="{{ asset('vendor/lara-report-craft/js/index.js') }}" defer></script>
