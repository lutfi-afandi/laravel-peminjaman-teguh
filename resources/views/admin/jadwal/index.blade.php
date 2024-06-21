@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Jadwal Ruangan')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-12">
            {{-- <div id="respon">
                @if (session()->has('msg'))
                    <div class="alert {{ session('class') }} alert-dark">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('msg') }}
                    </div>
                @endif
            </div> --}}
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6 panel-title">Jadwal Penggunaan Ruangan</div>
                        <div class="col-sm-6 card-tools text-right">
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div id="calendar"></div>
            
        </div>
    </div>

    @push('scripts')
        
        <script> 
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    slotMinTime: '7:00:00',
                    slotMaxTime: '22:00:00',
                    events: @json($events),
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                });
                calendar.render();
            });
        </script>
    @endpush

@endsection
