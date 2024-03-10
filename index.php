<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>VPS Usage</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body>
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col">
                    <div class="alert alert-warning" role="alert"><b>Note:</b> Content refreshes every <span id="refresh_time"></span> second(s).</div>
                    <div class="alert alert-info" role="alert" id="general_info">-</div>
                    <section id="mainchart"></section>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="card" id="ram">
                        <div class="card-header">
                            RAM usage
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-danger">Usage: <span class="usage">0</span></li>
                            <li class="list-group-item list-group-item-info">Total: <span class="total">0</span> GB</li>
                            <li class="list-group-item list-group-item-success">Free: <span class="free">0</span> GB</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card" id="hdd">
                        <div class="card-header">
                            HDD usage
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-danger">Usage: <span class="usage">0</span> GB</li>
                            <li class="list-group-item list-group-item-info">Total: <span class="total">0</span> GB</li>
                            <li class="list-group-item list-group-item-success">Free: <span class="free">0</span> GB</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card" id="network">
                        <div class="card-header">
                            Network usage
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Received: <span class="rec">0</span></li>
                            <li class="list-group-item">Sent: <span class="sent">0</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" id="cpu">
                        <div class="card-header">
                            CPU's
                        </div>
                        <ul class="list-group list-group-flush"></ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div id="gaugeUsage"></div>
                </div>
            </div>
        </div>

        <script src="https://code.highcharts.com/stock/highstock.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>