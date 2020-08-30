@extends('layouts.admin')
@section('content')
<h3 class="page-title">{{ trans('global.systemCalendar') }}</h3>
<div class="card">
    <div class="card-header">
        {{ trans('global.systemCalendar') }}
    </div>

    <div class="card-body">
        <form action="{{ route('admin.systemCalendar') }}" method="GET">
            Smijer:
            <select name="smijer_id">
                @foreach($smijerovi as $smijer)
                    <option value="{{ $smijer->id }}"
                            @if (request('smijer_id') == $smijer->id) selected @endif>{{ $smijer->name }}</option>
                @endforeach
            </select>
            Godina:
            <select name="godina_id">
                    <option value="1" >1</option>
                    <option value="2" >2</option>
                    <option value="3" >3</option>
                    <option value="4" >4</option>
                    <option value="5" >5</option>
            </select>
            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
        </form>

        {{-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' /> --}}
        <div id='calendar'></div>


    </div>
</div>
@endsection

@section('scripts')
@parent
 <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script> 
{{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script> --}}
<link rel="stylesheet" href="css\Kalendar.scss">
<script src="js\kalendar.js"></script>
<script>
    $(document).ready(function () {
         
            events={!! json_encode($events) !!};
              $('#calendar').fullCalendar({
                header: {
          left: 'title',
          center: 'agendaDay,agendaWeek,month',
          right: 'prev,next today'
        },
        editable: false,
        firstDay: 0, //  1(Monday) this can be changed to 0(Sunday) for the USA system
        selectable: false,
        defaultView: 'month',
        axisFormat: 'h:mm',
        columnFormat: {
          month: 'ddd', // Mon
          week: 'ddd d', // Mon 7
          day: 'dddd M/d', // Monday 9/7
          agendaDay: 'dddd d'
        },
        titleFormat: {
          month: 'MMMM yyyy', // September 2009
          week: "MMMM yyyy", // September 2009
          day: 'MMMM yyyy' // Tuesday, Sep 8, 2009
        },
        droppable: false, 
  
                events: events,


            })
        });
</script>
@stop