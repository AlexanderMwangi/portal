@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin">
    @if (session('status'))
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
      <div class="p-4 border-bottom bg-light">
        <h4 class="card-title mb-0">Enter New Objective (Max 5) <a href="{{ url('/objectives') }}" class="pull-right">View Your Objectives</a> </h4>
        
      </div>
      <div class="card-body">
         <form method="POST" action="{{ route('objective/submit') }}">
          {{ csrf_field() }}
            <div class="form-group">
              <label for="year">Year: </label>
              <select name="year" required="required">
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
              </select>
            </div>

            <div class="form-group">
              <label for="organization_goals">Organizational Goals</label>
              <select name="organization_goal" class="form-control select2" required="required">
                  <option value="1">Human Resources for Health</option>
                  <option value="2">Innovative Health Services and Solutions</option>
                  <option value="3">Investments in Health</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Department Goals</label>
              <select name="department_goal" class="form-control select2" required="required">
                  <option value="1">Department Goal 1</option>
                  <option value="2">Department Goal 2</option>
                  <option value="3">Department Goal 3</option>
              </select>
            </div>
             <div class="form-group">
              <label for="objective">Objective</label>
             <textarea name="objective" rows="4" class="form-control" required="required"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary btn-custom">Submit</button>
          </form>
        <div class="mr-5" id="mixed-chart-legend"></div>
      </div>
    </div>
  </div>
</div>
@endsection

