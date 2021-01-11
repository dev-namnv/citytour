@extends('layouts.manager.app')

@section('title', isset($category) ? $category->name : 'Thời gian biểu')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('Libraries/Manager/plugins/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('Libraries/Manager/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Thời gian biếu</span>
                    <span class="text-muted mt-1 font-weight-bold font-size-sm">Sự kiện và lịch đi Tour</span>
                </h3>
                @if(auth()->user()->role === GUIDE)
                    <div class="card-toolbar">
                        <a href="{{ route('tour-create') }}" class="btn btn-success font-weight-bold py-3 px-6">
                            <i class="ki ki-plus icon-1x mr-2"></i>Tạo Tour</a>
                    </div>
                @endif
            </div>
            <div class="card-body pt-10">
                <div id="kt_calendar"></div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script src="{{ asset('Libraries/Manager/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="node_modules/fullcalendar/locales-all.min.js"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        async function getCalendar() {
            let data = []
            await axios.get(`${BASE_URL}/api_v1/calendar`)
                    .then((response) => {
                        data = response.data
                    })
                    .catch((err) => console.log(err))
            return data
        }

        async function Calendar () {
            const dataCalendar = await getCalendar()
            const todayDate = moment().startOf('day');
            const TODAY = todayDate.format('YYYY-MM-DD');

            const calendarEl = document.getElementById('kt_calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                themeSystem: 'bootstrap',

                isRTL: KTUtil.isRTL(),

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                height: 800,
                contentHeight: 780,
                aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                nowIndicator: true,
                now: '{{ \Carbon\Carbon::now() }}', // just for demo

                views: {
                    dayGridMonth: { buttonText: 'Tháng' },
                    timeGridWeek: { buttonText: 'Tuần' },
                    timeGridDay: { buttonText: 'Ngày' }
                },

                defaultView: 'dayGridMonth',
                defaultDate: TODAY,

                editable: true,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                events: dataCalendar,

                eventRender: function(info) {
                    const element = $(info.el);

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                }
            });

            calendar.render();
        }
        Calendar()
    </script>
@endsection
