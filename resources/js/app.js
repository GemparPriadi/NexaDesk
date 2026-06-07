import './bootstrap';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

import Swal from 'sweetalert2';

import Chart from 'chart.js/auto';

window.Chart = Chart;
window.Swal = Swal;
window.Pusher = Pusher;

/*
|--------------------------------------------------------------------------
| ECHO
|--------------------------------------------------------------------------
*/

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: 'local-key',
    wsHost: '127.0.0.1',
    wsPort: 8080,
    forceTLS: false,
    enabledTransports: ['ws', 'wss'],
});

console.log('Echo Loaded ✅');

/*
|--------------------------------------------------------------------------
| REALTIME ADMIN
|--------------------------------------------------------------------------
*/

function initRealtimeTicket() {

    const statusCanvas =
        document.getElementById('statusChart');

    if (!statusCanvas) {
        return;
    }

    if (!window.Echo) {
        return;
    }

    window.Echo.channel('tickets')
        .stopListening('TicketCreated')
        .listen('TicketCreated', () => {

            Swal.fire({

                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'New ticket created 🔥',

                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,

                background: '#0F172A',
                color: '#fff',

            });

            setTimeout(() => {

                window.location.reload();

            }, 1000);

        });

}

/*
|--------------------------------------------------------------------------
| DELETE CONFIRM
|--------------------------------------------------------------------------
*/

window.deleteConfirm = function(callback) {

    Swal.fire({

        title: 'Delete Ticket?',
        text: "Data can't be restored!",
        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',

        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel',

        background: '#0F172A',
        color: '#fff',

        reverseButtons: true,

    }).then((result) => {

        if (result.isConfirmed) {

            callback();

        }

    });

}

/*
|--------------------------------------------------------------------------
| SUCCESS TOAST
|--------------------------------------------------------------------------
*/

window.successToast = function(message = 'Success 🔥') {

    Swal.fire({

        toast: true,
        position: 'top-end',

        icon: 'success',
        title: message,

        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,

        background: '#0F172A',
        color: '#fff',

    });

}

/*
|--------------------------------------------------------------------------
| ERROR TOAST
|--------------------------------------------------------------------------
*/

window.errorToast = function(message = 'Something went wrong ❌') {

    Swal.fire({

        toast: true,
        position: 'top-end',

        icon: 'error',
        title: message,

        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,

        background: '#0F172A',
        color: '#fff',

    });

}

/*
|--------------------------------------------------------------------------
| ADMIN CHART
|--------------------------------------------------------------------------
*/

let statusChart;
let overviewChart;

window.initAdminCharts = () => {

    const statusCanvas =
        document.getElementById('statusChart');

    const overviewCanvas =
        document.getElementById('overviewChart');

    if (!statusCanvas || !overviewCanvas) {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY OLD
    |--------------------------------------------------------------------------
    */

    if (statusChart) {

        statusChart.destroy();

    }

    if (overviewChart) {

        overviewChart.destroy();

    }

    /*
    |--------------------------------------------------------------------------
    | DATA
    |--------------------------------------------------------------------------
    */

    const pending =
        Number(statusCanvas.dataset.pending);

    const process =
        Number(statusCanvas.dataset.process);

    const done =
        Number(statusCanvas.dataset.done);

    const users =
        Number(overviewCanvas.dataset.users);

    const tickets =
        Number(overviewCanvas.dataset.tickets);

    /*
    |--------------------------------------------------------------------------
    | STATUS CHART
    |--------------------------------------------------------------------------
    */

    statusChart = new Chart(statusCanvas, {

        type: 'doughnut',

        data: {

            labels: [
                'Pending',
                'Process',
                'Done'
            ],

            datasets: [{

                data: [
                    pending,
                    process,
                    done
                ],

                backgroundColor: [
                    '#facc15',
                    '#3b82f6',
                    '#22c55e'
                ],

                borderWidth: 0,
                hoverOffset: 20

            }]

        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            cutout: '72%',

            animation: {

                duration: 2500,
                easing: 'easeOutQuart'

            },

            plugins: {

                legend: {

                    position: 'bottom'

                }

            }

        }

    });

    /*
    |--------------------------------------------------------------------------
    | BAR CHART
    |--------------------------------------------------------------------------
    */

    overviewChart = new Chart(overviewCanvas, {

        type: 'bar',

        data: {

            labels: [
                'Users',
                'Tickets',
                'Pending',
                'Process',
                'Done'
            ],

            datasets: [{

                data: [
                    users,
                    tickets,
                    pending,
                    process,
                    done
                ],

                backgroundColor: [
                    '#3b82f6',
                    '#a855f7',
                    '#facc15',
                    '#2563eb',
                    '#22c55e'
                ],

                borderRadius: 14

            }]

        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            animation: {

                duration: 2200,
                easing: 'easeOutQuart'

            },

            plugins: {

                legend: {

                    display: false

                }

            }

        }

    });

}

/*
|--------------------------------------------------------------------------
| FIRST LOAD
|--------------------------------------------------------------------------
*/

window.addEventListener('load', () => {

    setTimeout(() => {

        window.initAdminCharts();

    }, 100);

});

/*
|--------------------------------------------------------------------------
| LIVEWIRE NAVIGATED
|--------------------------------------------------------------------------
*/

document.addEventListener('livewire:navigated', () => {

    setTimeout(() => {

        window.initAdminCharts();

    }, 100);

});