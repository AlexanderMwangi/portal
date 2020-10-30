@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 border-bottom bg-light">
        <h4 class="card-title mb-0">Your Objectives 
          @if($objectivesCount < 5)
            <a href="{{ url('/objectives/add') }}" class="pull-right">Add New Objective</a>
          @endif 
        </h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
           @foreach($objectives as $obj)
             <b>{{$obj->objective_id}}. {{$obj->objective}}</b>
             <p>Year:  {{$obj->year}}</p>
              <p>Organnization Goal: {{$obj->organization_goal}}</p>
              <p>Department Goal: {{$obj->department_goal}}</p>
              <p>Date Submitted: {{$obj->date_added}}</p>
              
              <br>
           @endforeach
        </div>
        <div class="mr-5" id="mixed-chart-legend"></div>
      </div>
    </div>
  </div>
</div>
@endsection

