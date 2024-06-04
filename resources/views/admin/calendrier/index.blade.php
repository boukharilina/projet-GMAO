<!DOCTYPE html>
<html>
  <head>
    <style>
        #calendar {
            position: relative;
            inset-block-start: 0;
            inset-inline-start: 0;
            inset-inline-end: 0;
            inset-block-end: 0;
            margin: 10px auto;
            padding: 10px;
            max-inline-size: 1100px;
            block-size: 700px;
        }
        </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.css'>
    
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar')
        const calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale: '{{ config('locale', 'fr') }}',
        headerToolbar: { left : 'prev,next,today', 
        center : 'title', 
        right : 'dayGridMonth,timeGridWeek,timeGridDay,listWeek' 
        },
        dateClick: function(info) {
        var eventModal = new bootstrap.Modal(document.getElementById('event'));
        eventModal.show();
        }

          
        })
        calendar.render()
      }) 

    </script>
  </head>
  <body>
    <div class="container">
        <div id='calendar'></div>
    </div>
    

    <!-- Modal trigger button -->
    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-target="#event">Launch</button>
    
    <!-- Modal Body -->
    <div class="modal fade" id="event" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Modal title
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Saisir le titre de la maintenance"/>
                            <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="debut">Début</label>
                            <input type="text" class="form-control" name="debut" id="debut" aria-describedby="helpId" placeholder="Saisir le titre de la maintenance"/>
                            <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>

                        <div class="form-group">
                            <label for="fin">fin</label>
                            <input type="text" class="form-control" name="fin" id="fin" aria-describedby="helpId" placeholder="Saisir le titre de la maintenance"/>
                            <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>               
                    </form>
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    

    
  </body>
</html>