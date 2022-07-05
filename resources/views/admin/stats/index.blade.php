@extends('layouts.app')

@section('content')
    <div class="container">
      <div>
        <canvas id="chart" aria-label="nome chart da decidere" role="img">
          <p>Your browser does not support the canvas element.</p>
          {{-- il p è un testo fallback se non funziona il chart --}}
        </canvas>
      </div>
    </div>
@endsection

@section('scripts')
  <script>
    const ctx = document.getElementById('chart');
    const chart = new Chart(ctx, {
      type: 'line',
      // o type 'bar'
      data: {
          labels: [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
          ],
          // i label sono quelli dell'asse x
          datasets: [{
              label: 'Views',
              data: [12, 19, 3, 5, 2, 3, 10, 22, 33, 10, 3, 20],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)',
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
              // color: #000; per il colore del font
          }],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
              }
        }
    });
  </script>
@endsection
