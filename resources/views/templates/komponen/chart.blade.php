@component('templates.widgets')
    @slot('header')
        <!-- INTERNAL Morris Charts css -->
		<link href="{{ asset('assets/plugins/morris/morris.css')}}" rel="stylesheet" />
    @endslot
    @slot('footer')
        <!--Othercharts js-->
		<script src="{{asset('assets/plugins/othercharts/jquery.sparkline.min.js')}}"></script>
        <!--INTERNAL Flot Charts js-->
		<script src="{{asset('assets/plugins/flot/jquery.flot.js')}}"></script>
		<script src="{{asset('assets/plugins/flot/jquery.flot.fillbetween.js')}}"></script>
		<script src="{{asset('assets/plugins/flot/jquery.flot.pie.js')}}"></script>
		<script src="{{asset('assets/js/dashboard.sampledata.js')}}"></script>
		<script src="{{asset('assets/js/chart.flot.sampledata.js')}}"></script>

        <!-- INTERNAL Chart js -->
		<script src="{{asset('assets/plugins/chart/chart.bundle.js')}}"></script>
		<script src="{{asset('assets/plugins/chart/utils.js')}}"></script>

		<!-- INTERNAL Apexchart js -->
		<script src="{{asset('assets/js/apexcharts.js')}}"></script>

        <!-- Rounded bar chart js-->
		<script src="{{asset('assets/js/rounded-barchart.js')}}"></script>
    @endslot
@endcomponent

