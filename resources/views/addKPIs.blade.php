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
        <h4 class="card-title mb-0">Enter a KPI (Max of 3 KPIs per objective) <a href="{{ url('/kpis') }}" class="pull-right">View Your KPIs</a> </h4>
        
      </div>
      <div class="card-body">
         <form method="POST" action="{{ route('kpi/submit') }}">
          {{ csrf_field() }}
            <div class="form-group">
              <label for="objective">Objective</label>
              <select name="objective" class="form-control select2" required="required">
              @if(isset($objectives))
                @foreach($objectives as $obj)
                  <option value="{{$obj->objective_id}}">{{$obj->objective}}</option>
                @endforeach
              @endif
              </select>
            </div>
             <div class="form-group">
              <label for="kpi">KPI</label>
             <textarea name="kpi" rows="4" class="form-control" required="required"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary btn-custom">Submit</button>
          </form>
        <div class="mr-5" id="mixed-chart-legend"></div>
      </div>
    </div>
  </div>
</div>
@endsection


