<!DOCTYPE html>
<html lang='en'>
<head>  
        

    <meta charset='utf-8'/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #calendar-container {
            position: auto;
            inset-block-start: 0;
            inset-inline-start: 0;
            inset-inline-end: 0;
            inset-block-end: 0;
        }
        #calendar {
            margin: 10px auto;
            padding: 10px;
            max-inline-size: 1100px;
            block-size: 700px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            inset-block-start: 0;;
            inline-size: 100%;
            block-size: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto; /* Centre horizontalement */
            margin-block-start: 10%; /* Ajoutez un peu d'espace en haut pour centrer verticalement */
            padding: 20px;
            border: 1px solid #888;
            inline-size: 80%;
            max-inline-size: 600px; /* Ajoutez une largeur maximale pour éviter que la modal ne soit trop large */
        }

        .close {
            color: #aaaaaa;
            float: inline-end;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

    </style>
    <script defer>
        create_UUID = () => {
            let dt = new Date().getTime();
            const uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, c => {
                let r = (dt + Math.random() * 16) % 16 | 0;
                dt = Math.floor(dt / 16);
                return (c == 'x' ? r :(r&0x3|0x8)).toString(16);
            });
            return uuid;
        }

        document.addEventListener('livewire:load', function () {
            const Calendar = FullCalendar.Calendar;
            const calendarEl = document.getElementById('calendar');

            if (!calendarEl) {
                console.error('Element with ID "calendar" not found');
                return;
            }

            const calendar = new Calendar(calendarEl, {
                locale: '{{ config('locale', 'fr') }}',
                headerToolbar: { left : 'prev,next,today', center : 'title', right : 'dayGridMonth,timeGridWeek,timeGridDay,listWeek' },
                events: JSON.parse(@this.events),
                editable: true,                
                eventResize: info => @this.saveEvent(info.event),
                eventDrop: info => @this.saveEvent(info.event),
                selectable: true,
                select: arg => {
                    console.log('select callback called with arguments:', arg);
                    document.getElementById('title').value = '';
                    document.getElementById('user').value = '';
                    document.getElementById('comment').value = '';
                    document.getElementById('start').value = arg.startStr;
                    document.getElementById('end').value = arg.endStr;
                    document.getElementById('myModal').style.display = "block";
                },
                eventClick: info => {
                    console.log('eventClick callback called with event:', info.event);
                    const event = info.event;
                    document.getElementById('title').value = event.title;
                    document.getElementById('user').value = event.extendedProps.user || '';
                    document.getElementById('comment').value = event.extendedProps.comment || '';
                    document.getElementById('myModal').style.display = "block"; 
                },
            });

            document.getElementById('myModal').getElementsByClassName('close')[0].addEventListener('click', function () {
                document.getElementById('myModal').style.display = "none";
            });

            window.onclick = function(event) {
                if (event.target == document.getElementById('myModal')) {
                    document.getElementById('myModal').style.display = "none";
                }
            }

            document.getElementById('eventForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                const title = document.getElementById('title').value;
                const user = document.getElementById('user').value;
                const comment = document.getElementById('comment').value;
                const start = document.getElementById('start').value;
                const end = document.getElementById('end').value;

                if (title && start && end) {
                    const id = create_UUID();
                    const eventData = {
                        id: id,
                        title: title,
                        start: start,
                        end: end,
                        extendedProps: {
                            user: user || '',   // Initialise avec une valeur par défaut si user est vide
                            comment: comment || ''  // Initialise avec une valeur par défaut si comment est vide
                        }
                    };
                    calendar.addEvent(eventData);
                    @this.saveEvent(eventData);
                    document.getElementById('myModal').style.display = "none";
                    calendar.unselect();
                }
            });

            calendar.render();
        });
    </script>
    
</head>
<body>
    <div>
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>
        </div>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="eventForm" action="AddEvent" method="POST">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="user">User:</label>
                    <select type="text" name="user" class="form-control" id="user">
                        <option value="selctionner un techniciens(s)">selctionner un techniciens(s)</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <input type="text" id="comment" name="comment">
                </div>
                <input type="hidden" id="start" name="start">
                <input type="hidden" id="end" name="end">
                <button type="submit" class="btn btn-primary btn-block">Valider</button>
            </form>
        </div>
    </div>
    
    
</body>
</html>
