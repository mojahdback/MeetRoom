
import Chart from 'chart.js/auto';

fetch('/rooms-of-each-building')
    .then(response => response.json())
    .then(data => {
        const labels = data.map(item => item.name);
        const roomCounts = data.map(item => item.totalRooms);

        const ctx = document.getElementById('buildingChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Rooms',
                    data: roomCounts,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    });

fetch('/taux-occupation')
    .then(response => response.json())
    .then(data => {
        const labels = data.map(item => item.buildingName);
        const tauxDoccupation= data.map(item => item.tauxDoccupation);

        const ctx = document.getElementById('tauxDoccupationChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'taux Doccupation',
                    data: tauxDoccupation,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    });
