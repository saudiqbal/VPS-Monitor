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
                    <div class="alert alert-info" role="alert" id="general_info">-</div>
                </div>
            </div>

            <section id="mainchart"></section>

            <div class="row">
                <div class="col-md-2">
                    <div class="card" id="ram-usage">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">RAM</h4>
                                <h6 class="card-subtitle text-muted mb-0">-</h6>
                            </div>
                            <h3 class="text-muted mb-0">0 %</h3>
                        </div>
                        <div class="progress rounded-0" role="progressbar" aria-label="RAM usage" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-danger">Usage: <span class="usage">0</span></li>
                            <li class="list-group-item list-group-item-info">Total: <span class="total">0</span></li>
                            <li class="list-group-item list-group-item-success">Free: <span class="free">0</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card" id="drive-usage">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">Drive</h4>
                                <h6 class="card-subtitle text-muted mb-0">-</h6>
                            </div>
                            <h3 class="text-muted mb-0">0 %</h3>
                        </div>
                        <div class="progress rounded-0" role="progressbar" aria-label="Drive usage" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-danger">Usage: <span class="usage">0</span></li>
                            <li class="list-group-item list-group-item-info">Total: <span class="total">0</span></li>
                            <li class="list-group-item list-group-item-success">Free: <span class="free">0</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="col">
                        <div class="card" id="cpu-usage">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <h4 class="card-title">CPU</h4>
                                <h3 class="text-muted mb-0">0 %</h3>
                            </div>
                            <div class="progress rounded-0" role="progressbar" aria-label="CPU usage" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 0%"></div>
                            </div>
                            <ul class="list-group list-group-flush"></ul>
                        </div>
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
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.highcharts.com/stock/highstock.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>
