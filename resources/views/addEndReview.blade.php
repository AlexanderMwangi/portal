@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="p-4 border-bottom bg-light">
          <p>Year End Self-Appraisal for : <b>{{Session::get('name')}} </b> 
            <a href="{{ url('/review/end') }}" class="pull-right">View End Year Review</a>
          </p> 
          <div class="clear"></div>
      </div>
      <div class="card-body margin-thirty">
        <p class="mb-0 ml-2">
           <h4>
             Rating scale:
           </h4> <hr>

           5:   Excellent (consistently exceeds standards)<br>
           4:   Outstanding (frequently exceeds standards)<br>
           3:   Satisfactory (generally meets standards)<br>
           2:   Needs improvement (frequently fails to meet standards)<br>
           1:    Unacceptable (fails to meet standards)<br>
        </p>
        <!-- <h2 class="card-title mb-0">Section 1: Objectives</h2> <hr>
             @foreach($objectives as $obj)
               <b>{{$obj->objective_id}}.</b> {{$obj->objective}}<br>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optradio">Unacceptable
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optradio"value="2">Needs improvement
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optradio"value="3">Satisfactory
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optradio"value="4">Outstanding
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optradio"value="5">Excellent
                  </label>
                </div> 
                <br><br> 
             @endforeach -->
        <h4>Appraisal Rating</h4><hr>
        <p class="mb-0 ml-2">
          <form method="POST" action="{{ route('postEnd') }}">
            {{ csrf_field() }}
            <b>1. Performance against goals / objectives:</b>(Degree of achievement vs targets for the year)<br>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="goals" value="1">Unacceptable
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="goals"value="2">Needs improvement
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="goals"value="3">Satisfactory
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="goals"value="4">Outstanding
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="goals"value="5">Excellent
              </label>
            </div> 
            <br><br> 
            <b>2. Job Knowledge:</b>(Applies the technical and professional skills needed for the job.)<br>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="job_knowledge" value="1">Unacceptable
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="job_knowledge"value="2">Needs improvement
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="job_knowledge"value="3">Satisfactory
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="job_knowledge"value="4">Outstanding
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="job_knowledge"value="5">Excellent
              </label>
            </div> 
            <br><br>
            <b>3. Communication Skills:</b>(Listens effectively and provides information and guidance to individuals in an appropriate and timely manner.)<br>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="communication_skills" value="1">Unacceptable
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="communication_skills"value="2">Needs improvement
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="communication_skills"value="3">Satisfactory
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="communication_skills"value="4">Outstanding
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="communication_skills"value="5">Excellent
              </label>
            </div> 
            <br><br> 
            <b>4. Management Skills:</b>(Guides team to achieve desired results. Delegates responsibilities appropriately and effectively, while developing direct reports.)<br>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="management_skills" value="1">Unacceptable
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="management_skills"value="2">Needs improvement
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="management_skills"value="3">Satisfactory
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="management_skills"value="4">Outstanding
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="management_skills"value="5">Excellent
              </label>
            </div> 
            <br><br> 
            <b>5. Organizational Skills:</b>(Sets appropriate objectives to meet commitments within budget. Establishes priorities and organizes workflow to meet objectives.)<br>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="organizational_skills" required="required" value="1">Unacceptable
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="organizational_skills"value="2">Needs improvement
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="organizational_skills"value="3">Satisfactory
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="organizational_skills"value="4">Outstanding
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="organizational_skills"value="5">Excellent
              </label>
            </div> 
            <br><br> 
            <b>6. Initiative:</b>(The degree to which an employee searches out new tasks and expands abilities professionally and personally.)<br>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="initiative" required="required" value="1">Unacceptable
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="initiative"value="2">Needs improvement
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="initiative"value="3">Satisfactory
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="initiative"value="4">Outstanding
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="initiative"value="5">Excellent
              </label>
            </div>
            <br><br> 
            <button type="submit" class="btn btn-primary btn-custom">Submit</button>
          </form>
        </p>
        <div class="mr-5" id="mixed-chart-legend"></div>
      </div>
    </div>
  </div>
</div>
@endsection

