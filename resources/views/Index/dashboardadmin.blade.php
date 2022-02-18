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
</div>
@endsection
@push('js')
@endpush