@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 border-bottom bg-light">
        <h4 class="card-title mb-0">Your End Year Appraisal 
          <a href="{{ url('/review/mid/add') }}" class="pull-right">Rate Again</a>
        </h4>
        
      </div>
      <div class="card-body">
        <div class="table-responsive">
          @foreach($rating as $rate)
          <table class="table table-responsive table-bordered table-stripped table-{color}">
            <thead>
              <th> # </th>
              <th>Category</th>
              <th>Rating</th>
            </thead>
            <tbody>
              <tr class="table-info">
                <th>1</th>
                <td>Performance against goals / objectives</td>
                <td>{{$rate->goals}}</td>
              </tr>
              <tr class="table-primary">
                <td>2</td>
                <td>Job Knowledge</td>
                <td>{{$rate->job_knowledge}}</td>
              </tr>
              <tr class="table-success">
                <td>3</td>
                <td>Communication Skills</td>
                <td>{{$rate->communication_skills}}</td>
              </tr>
              <tr class="table-warning">
                <td>4</td>
                <td>Management Skills</td>
                <td>{{$rate->management_skills}}</td>
              </tr>
              <tr class="table-info">
                <td>5</td>
                <td>Organizational Skills</td>
                <td>{{$rate->organizational_skills}}</td>
              </tr>
              <tr class="table-primary">
                <td>6</td>
                <td>Initiative</td>
                <td>{{$rate->initiative}}</td>
              </tr>
              <tr class="table-danger">
                <td><b>Total</b></td>
                <td><b>Average Appraisal Score</b></td>
                <td><b>{{round($average,2)}}</b></td>
              </tr>
            </tbody>
          </table>
          @endforeach
        </div>
        <div class="mr-5" id="mixed-chart-legend"></div>
      </div>
    </div>
  </div>
</div>
@endsection

