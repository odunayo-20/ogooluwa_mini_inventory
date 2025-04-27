@php
    // Define the school year
    $currentYear = \Carbon\Carbon::now()->year;
    $nextYear = $currentYear + 1;

    // Define school terms, holidays, and key dates
    $schoolCalendar = [
        'Term 1' => [
            'start_date' => '2023-09-05',
            'end_date' => '2023-12-15',
            'mid_term_break_start' => '2023-10-21',
            'mid_term_break_end' => '2023-10-25',
            'exams_start' => '2023-12-05',
            'exams_end' => '2023-12-12',
        ],
        'Term 2' => [
            'start_date' => '2024-01-10',
            'end_date' => '2024-04-10',
            'mid_term_break_start' => '2024-02-20',
            'mid_term_break_end' => '2024-02-24',
            'exams_start' => '2024-03-28',
            'exams_end' => '2024-04-05',
        ],
        'Term 3' => [
            'start_date' => '2024-04-25',
            'end_date' => '2024-07-20',
            'exams_start' => '2024-07-10',
            'exams_end' => '2024-07-18',
        ]
    ];
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>School Year Calendar {{ $currentYear }} - {{ $nextYear }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .calendar-container {
            width: 80%;
            margin: auto;
        }
        .term {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }
        .term-name {
            font-weight: bold;
            font-size: 1.5em;
            margin-bottom: 10px;
            text-align: center;
        }
        .date-info {
            margin-bottom: 10px;
        }
        .date-info input {
            padding: 5px;
            width: 100%;
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="calendar-container">
        <h1>School Year Calendar {{ $currentYear }} - {{ $nextYear }}</h1>

        @foreach ($schoolCalendar as $term => $details)
            <div class="term">
                <div class="term-name">{{ $term }}</div>
                <div class="date-info">
                    <label>Start Date:</label>
                    <input type="date" value="{{ $details['start_date'] }}">
                </div>
                <div class="date-info">
                    <label>End Date:</label>
                    <input type="date" value="{{ $details['end_date'] }}">
                </div>

                @if (isset($details['mid_term_break_start']))
                    <div class="date-info">
                        <label>Mid-Term Break Start:</label>
                        <input type="date" value="{{ $details['mid_term_break_start'] }}">
                    </div>
                    <div class="date-info">
                        <label>Mid-Term Break End:</label>
                        <input type="date" value="{{ $details['mid_term_break_end'] }}">
                    </div>
                @endif

                <div class="date-info">
                    <label>Exams Start:</label>
                    <input type="date" value="{{ $details['exams_start'] }}">
                </div>
                <div class="date-info">
                    <label>Exams End:</label>
                    <input type="date" value="{{ $details['exams_end'] }}">
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
