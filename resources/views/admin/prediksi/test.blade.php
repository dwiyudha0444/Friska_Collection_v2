<!DOCTYPE html>
<html>
<head>
    <title>Moving Average Helper</title>
</head>
<body>
    <h1>Moving Average Helper Example</h1>
    @php
        $data = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $movingAverages = \App\Helpers\MovingAverage::calculateMovingAverage($data);
    @endphp

    <h2>Data: {{ json_encode($data) }}</h2>
    <h2>3-Period Moving Averages: {{ json_encode($movingAverages) }}</h2>
</body>
</html>
