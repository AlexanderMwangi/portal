@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 border-bottom bg-light">
        <h4 class="card-title mb-0">Your KPIs 
          @if($kpisCount < 5)
            <a href="{{ url('/kpis/add') }}" class="pull-right">Add New KPI</a>
          @endif 
        </h4>
        
      </div>
      <div class="card-body">
        <div class="table-responsive">
             @foreach($kpis as $kpi)
               <b>{{$kpi->kpi_id}}. {{$kpi->kpi}}</b>
                <p><u>Related Objective:</u> {{$kpi->objective}}</p>
                <br>
             @endforeach
            </tbody>
          </table>
        </div>
        <div class="mr-5" id="mixed-chart-legend"></div>
      </div>
    </div>
  </div>
</div>
@endsection

