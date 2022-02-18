@extends('layouts.master')
@section('title')
Dashboard | MMS
@endsection
@section('dashboard1')
<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Hi, Welcome {{auth()->user()->username}}</h2>
								<h5 class="text-white op-7 mb-2">Have A Good Day On {{$year->format('D')}}</h5>
							</div>
							<div class="ml-md-auto py-2 py-md-0">
								<a href="{{route('list-material')}}" class="btn btn-white btn-border btn-round mr-2">Material</a>
								<a href="{{route('formadd-pr')}}" class="btn btn-secondary btn-round">Add PR</a>
							</div>
						</div>
					</div>
				</div>
@endsection
@section('dashboard2')
<div class="page-inner mt--5">
					<div class="row mt--2">
					<div class="col-md-8">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Spending Material</div>
									<div class="row py-3">
										<div class="col-md-4 d-flex flex-column justify-content-around">
											<div>
												<h6 class="fw-bold text-uppercase text-success op-8">Total Outcome This Year</h6>
												<h3 class="fw-bold">@currency($spendpo)</h3>
											</div>
											<div>
												<h6 class="fw-bold text-uppercase text-danger op-8">Spending Material</h6>
												<h3 class="fw-bold">@currency($spendmaterial)</h3>
											</div>
										</div>
										<div class="col-md-8">
											<div id="chart-container">
												<canvas id="totalIncomeChart"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Material Under Minimal Stok</div>
									<div class="card-category">Quantity material under minimal stok</div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-3"></div>
											<div class="fw-bold mt-3 mb-0">
											<a href="{{route('minstok')}}">See Detail ..</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title ">Pending PR</div>
									<div class="card-category ">Quantity Pending PR</div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-1"></div>
											<div class="fw-bold mt-3 mb-0">
											<a class="" href="{{route('pending-pr')}}">See Detail ..</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Spending Budget</div>
									<div class="row py-3">
										<div class="col-md-4 d-flex flex-column justify-content-around">
											<div>
												<h6 class="fw-bold text-uppercase text-success op-8">Opening Budget</h6>
												<h3 class="fw-bold">@currency($budget)</h3>
											</div>
											<div>
												<h6 class="fw-bold text-uppercase text-danger op-8">Available Budget</h6>
												<h3 class="fw-bold">@currency($budget - $spendpo)</h3>
											</div>
										</div>
										<div class="col-md-8">
											<div id="chart-container">
												<canvas id="totalOutcomeChart"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
</div>
@endsection
@push('js')
<script>
		Circles.create({
			id:'circles-1',
			radius:45,
			value:{{$pendingpr}},
			maxValue:15,
			width:7,
			text: {{$pendingpr}},
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-2',
			radius:45,
			value:70,
			maxValue:100,
			width:7,
			text: 36,
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-3',
			radius:45,
			value:{{$jmlminstok}},
			maxValue:100,
			width:7,
			text: {{$jmlminstok}},
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				datasets : [{
					label: "Total Income",
					backgroundColor: '#ff9e27',
					borderColor: 'rgb(23, 125, 255)',
					data: <?php echo json_encode($q); ?>,
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines : {
							drawBorder: false,
							display : false
						}
					}],
					xAxes : [ {
						gridLines : {
							drawBorder: false,
							display : false
						}
					}]
				},
			}
		});

		$('#lineChart').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
		var totalOutcomeChart = document.getElementById('totalOutcomeChart').getContext('2d');

		var mytotalOutcomeChart = new Chart(totalOutcomeChart, {
			type: 'bar',
			data: {
				labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				datasets : [{
					label: "Total Income",
					backgroundColor: '#ff9e27',
					borderColor: 'rgb(23, 125, 255)',
					data: <?php echo json_encode($x); ?>,
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines : {
							drawBorder: false,
							display : false
						}
					}],
					xAxes : [ {
						gridLines : {
							drawBorder: false,
							display : false
						}
					}]
				},
			}
		});

		$('#lineChart').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});		
	</script>
@endpush