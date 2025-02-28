<x-guest-layout>
    <x-original.dashboard>

        <div id="calendar" class="h-full"></div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    displayEventTime: false,

                    timeZone: 'UTC',

                    events: @json($events)
                });
                calendar.render();
            });


        </script>
    </x-original.dashboard>
</x-guest-layout>