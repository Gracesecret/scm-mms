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
							</div>
						</div>
					</div>
				</div>
@endsection
@section('dashboard2')
<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Total Material</div>
									<div class="card-category"></div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-3"></div>
											<div class="fw-bold mt-3 mb-0">
											<a href="{{route('list-material')}}">See Detail ..</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title ">Value Material Main Store</div>
									<div class="card-category "></div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
										<div id=""></div>
										<h2><strong>@currency($val)</strong></h2>
											<div class="fw-bold mt-3 mb-0">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title ">Total Departement</div>
									<div class="card-category "></div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
										<div id=""></div>
										<h2><strong>{{$dept}}</strong></h2>
											<div class="fw-bold mt-3 mb-0">
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
			value:{{$material}},
			maxValue:15,
			width:7,
			text: {{$material}},
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
			value:{{$material}},
			maxValue:100,
			width:7,
			text: {{$material}},
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

	</script>
@endpush