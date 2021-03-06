@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="row">
  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-left">
            <i class="mdi mdi-account-box-multiple text-info icon-lg"></i>
          </div>
          <div class="float-right">
            <p>Name: <b>{{$user->name}} </b></p>
            <p>Registered email address: <b>{{$user->email}} </b></p>
            <p>Staff ID: <b>A0001 </b></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-left">
            <i class="mdi mdi-chart-line text-warning icon-lg"></i>
          </div>
        </div>
        <div class="float-left">
            <p class="mb-0 text-right">Objectives</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium mb-0">{{$objectivesCount}}</h3>
            </div>
        </div>
        <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-left">
            <i class="mdi mdi-poll-box text-success icon-lg"></i>
          </div>
        </div>
        <div class="float-left">
          <p class="mb-0 text-right">Appraisal Progress </p>
          <div class="fluid-container">
            <h3 class="font-weight-medium mb-0">40%</h3>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
      </div>
    </div>
  </div>
   <div class="card col-md-12">
      <div class="p-4 border-bottom bg-light">
        <h4 class="card-title mb-0">Your KPIs Summary 
        </h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-responsive">
            <thead>
              <th>#</th>
              <th>KPI Summary</th>
            </thead>
            @php($counter = 1)
             @foreach($kpis as $kpi)
              <tr>
                <td>{{$counter}}</td>
                <td>{{$kpi->kpi}}</td>
              </tr>
            @php($counter = $counter+1)
             @endforeach
          </table>
        </div>
        <div class="mr-5" id="mixed-chart-legend"></div>
      </div>
    </div>
</div>
@endsection

