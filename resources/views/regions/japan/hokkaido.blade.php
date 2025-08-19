<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>北海道</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { margin: 0; font-family: sans-serif; }
        .container { margin-top: 20px; }
        .job-card {
            width: 100%;
            max-width: 600px;
            padding: 16px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .job-link {
            display: inline-block;
            margin-top: 8px;
            text-decoration: underline;
            color: #0d6efd;
            cursor: pointer;
        }
        .job-link:hover { color: #0a58ca; }
        .salary {
            font-size: 16px;
            font-weight: bold;
            color: #198754;
        }
        .worker-count {
            font-size: 16px;
            font-weight: bold;
            color: #d63384;
        }
        .job-image {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container d-flex flex-column align-items-center">
        <!-- タイトルと戻るボタン -->
        <div class="d-flex align-items-center mb-4 position-relative w-100">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary position-absolute start-0">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4 class="mx-auto">{{ $region }}</h4>
        </div>

        <!-- DBのデータを使った県ごとの表示 -->
        @php
            $jobsByPrefecture = $jobs->groupBy('prefecture');
        @endphp

        @foreach($jobsByPrefecture as $prefecture => $jobsInPref)
            <div class="job-card my-3 text-center">
                <h5 class="mb-3">{{ $prefecture }}</h5>
                <p>この県でリゾートバイトしている人数: 
                    <span class="worker-count">{{ $jobsInPref->sum('workers') }}人</span>
                </p>

                @foreach($jobsInPref as $job)
                    <div class="mb-4">
                        <img src="{{ $job->image_url }}" class="job-image mx-auto d-block" alt="{{ $job->facility_name }}">
                        <p><strong>{{ $job->facility_name }}</strong></p>
                        <p class="salary">推定給料: {{ $job->salary }}円</p>
                        <a href="{{ $job->url }}" target="_blank" class="job-link">求人ページへ</a>
                    </div>
                    <hr>
                @endforeach
            </div>
        @endforeach
    </div>
</body>
</html>