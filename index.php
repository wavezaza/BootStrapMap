<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_8-hzYgeEoel1CfssvyMnLS-vjnl4zw8&callback=initMap"async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body class=" p-2 bg-dark">
    <div class="container bg-dark text-white mt-5 p-5 border border-primary">
        <div class="d-flex justify-content-center">
            <h1 class="display-2"> Map </h1>
        </div>
        <div class="container my-4 ">
            <div class="d-flex justify-content-center my-3">
                <h5 class="display-9"> หากต้องการค้นหาพื้นที่ และดูข้อมูล โปรดคลิกที่ปุ่มค้นหาตำแหน่งเพื่อกรอกข้อมูล </h5>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-outline-success" data-bs-target="#showForm" data-bs-toggle="modal">ค้นหาตำแหน่ง</button>
            </div>
            <div class="modal fade " id="showForm" style="display: none;" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content text-light bg-dark">
                        <div class="modal-header">
                            <h5 class="modal-title">โปรดระบุพื้นที่</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body ">
                            <form>
                                <div class=" input-group mb-3 ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-light bg-dark">Lat (เส้นละติจูด)</span>
                                    </div>
                                    <input id="X" type="text" placeholder="โปรดป้อน lat ของคุณ" class="form-control text-light bg-dark">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-light bg-dark">Long (เส้นลองจิจูด)</span>
                                    </div>
                                    <input id="Y" type="text" placeholder="โปรดป้อน lng ของคุณ" class="form-control text-light bg-dark">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button id="btn" class="btn btn-outline-success" data-bs-dismiss="modal">ค้นหาตำแหน่ง</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4" id="map" style="height: 500px; width: 100%;"></div>
        <script>
            // map
            var map;
            function initMap(x, y) {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: x, lng: y },
                    zoom: 12
                });
            };
            // maps
        </script>
        <div id="data-text"></div>
    </div>
</body>
<script>
    $("#btn").click(() => {
        var x = parseInt($("#X").val());
        var y = parseInt($("#Y").val());
        initMap(x, y);
        Posts(x, y);
    });
    function Posts(x, y, z) {
        var url = "https://api.openweathermap.org/data/2.5/weather?lat=" + x + "&lon=" + y + "&appid=e0201ad6f50928548a0ceb7ea7920a94"
        $.getJSON(url)
            .done((data) => {
                let unix_timestamp = data.dt;
                var date = new Date(unix_timestamp * 1000);
                var hours = date.getHours();
                var minutes = "0" + date.getMinutes();
                var seconds = "0" + date.getSeconds();
                var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

                let unix_timestamp_1 = data.sys.sunrise;
                var date_1 = new Date(unix_timestamp_1 * 1000);
                var hours_1 = date_1.getHours();
                var minutes_1 = "0" + date_1.getMinutes();
                var seconds_1 = "0" + date_1.getSeconds();
                var formattedTime_1 = hours_1 + ':' + minutes_1.substr(-2) + ':' + seconds_1.substr(-2);

                let unix_timestamp_2 = data.sys.sunset;
                var date_2 = new Date(unix_timestamp_2 * 1000);
                var hours_2 = date_2.getHours();
                var minutes_2 = "0" + date_2.getMinutes();
                var seconds_2 = "0" + date_2.getSeconds();
                var formattedTime_2 = hours_2 + ':' + minutes_2.substr(-2) + ':' + seconds_2.substr(-2);
            
                var line = "<div class='accordion-item border border-primary  mt-3' >"
                line += "<h2 class='accordion-header'><button class=' accordion-button collapsed text-light bg-secondary' data-bs-toggle='collapse' data-bs-target='#content1'aria-expanded='false'>Country : " + data.sys.country + "  (" + data.name + ")</button></h2>"
                line += "<div id='content1' class='collapse text-light bg-dark'>"
                line += "<div class='accordion-body'>"
                line += "<p id='text-1'>เวลา : " + formattedTime + "</p>"
                line += "<p id='text-1'>สภาพอากาศ : " + data.weather[0].description + "</p>"
                line += "<p id='text-1'>องศาลม : " + data.wind.deg + "</p>"
                line += "<p id='text-1'>ความเร็วลม : " + data.wind.speed + "</p>"
                line += "<p id='text-1'>ความชื้น : " + data.main.humidity + "</p>"
                line += "<p id='text-1'>ความดัน : " + data.main.pressure + "</p>"
                line += "<p id='text-1'>พระอาทิตย์ขึ้น : " + formattedTime_1 + "</p>"
                line += "<p id='text-1'>พระอาทิตย์ตก : " + formattedTime_2 + "</p>"
                line += "<p id='text-1'></p>"
                line += "</div>"
                line += "</div>"
                line += "</div>"
                $("#data-text").append(line);
            })
            .fail((xhr, err, statu) => {
            })
    }
</script>
</html>
