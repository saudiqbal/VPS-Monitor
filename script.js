var mainchart;

var refresh_time = 1;

var prev_total = prev_idle = 0;

window.onload = () =>
{
    
    highChartsInit();

    setInterval(refresh, refresh_time * 1000); 
};

function highChartsInit() 
{
    Highcharts.setOptions({ global: { useUTC: false } });
    mainchart = new Highcharts.stockChart({
        rangeSelector: {
            buttons: [{
            count: 1,
            type: 'minute',
            text: '1M'
        },{
            count: 5,
            type: 'minute',
            text: '5M'
        },{
            count: 10,
            type: 'minute',
            text: '10M'
        },{
            count: 15,
            type: 'minute',
            text: '15M'
        },{
            type: 'all',
            text: 'All'
        }],
            inputEnabled: false,
            selected: 0
        },

        tooltip: { pointFormat: '{series.name}: <b>{point.y}%</b>' },
        chart: { renderTo: 'mainchart' },
        title: { text: 'Hardware usage' },
        xAxis: { title: "Time", type: "datetime" },

        yAxis: {
            title: 'Percentage',
            max: 100,
            min: 0,
            tickInterval:10
        },

        series: [
            { name: 'RAM', data: getDummyData() },
            { name: 'HDD', data: getDummyData() },
            { name: 'CPU', data: getDummyData() }
        ]
    });
}

function getDummyData()
{
    const chartdata = new Array(), curtime = new Date().getTime();

    for (i = -399; i <= 0; i++)	chartdata.push([curtime + i * 1000, 0]);
    
    chartdata.push([curtime, 0]);

    return chartdata;
}

function refresh()
{
    fetch('/lib/getData.php')
        .then(response => response.json())
        .then(data => {
            const time = (new Date()).getTime();

            const cpuload = getCpuLoad(data.CPUDetail);
            const currentram = ((data.memory[1] / data.memory[0]) * 100).toFixed(2);
            const currenthdd = ((data.storage["used"] / data.storage["total"]) * 100).toFixed(2);
            const currentcpu = cpuload > 100 ? 100 : cpuload;

            mainchart.series[0].addPoint([time, parseFloat(currentram)], false, true);
            mainchart.series[1].addPoint([time, parseFloat(currenthdd)], false, true);
            mainchart.series[2].addPoint([time, parseFloat(currentcpu)], true, true);

            document.querySelector('#ram-usage .usage').innerHTML = formatBytes(data.memory[1]) + " <br/>Cache: " + formatBytes(data.memory[3]);
            document.querySelector('#ram-usage .total').innerHTML = formatBytes(data.memory[0]);
            document.querySelector('#ram-usage .free').innerHTML = formatBytes(data.memory[2]);

            document.querySelector('#drive-usage .usage').innerText = formatBytes(data.storage["used"]);
            document.querySelector('#drive-usage .total').innerText = formatBytes(data.storage["total"]);
            document.querySelector('#drive-usage .free').innerText = formatBytes(data.storage["free"]);

            document.querySelector('#network .rec').innerHTML = formatBytes(data.network[0]) + " <br/>Packets: " + data.network[1];
            document.querySelector('#network .sent').innerHTML = formatBytes(data.network[2]) + " <br/>Packets: " + data.network[3];

            const info = "Uptime: " + getTime(data.uptime) + "<br />Operating System: " + data.OS;
            document.getElementById('general_info').innerHTML = info;

            document.querySelector('#cpu-usage .list-group').innerHTML = "";

            document.querySelector('#cpu-usage h3').innerText = parseFloat(currentcpu) + "%";
            document.querySelector('#ram-usage h3').innerText = parseFloat(currentram) + "%";
            document.querySelector('#drive-usage h3').innerText = parseFloat(currenthdd) + "%";

            document.querySelector('#cpu-usage .progress-bar').style.width = parseFloat(currentcpu) + "%";
            document.querySelector('#ram-usage .progress-bar').style.width = parseFloat(currentram) + "%";
            document.querySelector('#drive-usage .progress-bar').style.width = parseFloat(currenthdd) + "%";

            document.querySelector('#ram-usage .card-subtitle').innerText = formatBytes(data.memory[1]) + ' out of ' + formatBytes(data.memory[0]);
            document.querySelector('#drive-usage .card-subtitle').innerText = formatBytes(data.storage["used"]) + ' out of ' + formatBytes(data.storage["total"]);

            for (var i = 0; i < data.CPU.length; i++) 
            {
                if(i % 3 === 0)
                {
                    const listitem = document.createElement('li');
                    listitem.classList.add('list-group-item');
                    listitem.innerHTML = data.CPU[i][1] + "<br />" + data.CPU[i + 1][0] + ": " + data.CPU[i + 1][1] + "<br />" + data.CPU[i + 2][0] + ": " + data.CPU[i + 2][1];

                    document.querySelector("#cpu-usage .list-group").append(listitem);
                }
            }
        });
}

//Calculation by https://github.com/Leo-G/DevopsWiki/wiki/How-Linux-CPU-Usage-Time-and-Percentage-is-calculated
function getCpuLoad(input)
{
    var cpuload = input.split(' ');
    var sum = 0;

    for (var i = 0; i < cpuload.length; i++) {
        sum += parseInt(cpuload[i]);	
    }

    var idlecpuload = cpuload[3];
    var diff_idle = idlecpuload - prev_idle;
    var diff_total = sum - prev_total;
    var diff_usage = (1000 * (diff_total - diff_idle) / diff_total + 5) / 10;

    prev_total = sum;
    prev_idle = idlecpuload;
    
    return diff_usage.toFixed(2);
}

function formatNumber(number)
{
    return number.toLocaleString("en-US");
}
function formatBytes(bytes,decimals) {
   if(bytes == 0) return '0 Bytes';
   var k = 1024,
       dm = decimals <= 0 ? 0 : decimals || 2,
       sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
       i = Math.floor(Math.log(bytes) / Math.log(k));
   return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

function getTime(seconds) 
{
    var leftover = seconds;

    var days = Math.floor(leftover / 86400);
    leftover = leftover - (days * 86400);

    var hours = Math.floor(leftover / 3600);
    leftover = leftover - (hours * 3600);

    var minutes = Math.floor(leftover / 60);
    leftover = leftover - (minutes * 60);

    return days + " days, " + hours + " hours, " + minutes + " minutes, " + leftover + " seconds";
}
