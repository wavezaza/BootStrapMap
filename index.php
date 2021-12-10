<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_8-hzYgeEoel1CfssvyMnLS-vjnl4zw8&callback=initMap"
        async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <style>
        #map {
            height: 100%;
        }
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 500px;
            width: 400px;
        }
    </style>
</head>
<body class="container bg-transparent">
    <div class=" bg-dark text-white m-5 p-5 border border-primary">
        <div class="d-flex justify-content-center">
            <h1 class="display-2"> Map </h1>
        </div>
            <div class="container my-4">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-outline-success" data-bs-target="#showForm" data-bs-toggle="modal">ค้นหาตำแหน่ง</button>
                </div>
                <div class="modal fade" id="showForm" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">แบบฟอร์มลงทะเบียน</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class=" input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">lat</span>
                                        </div>
                                        <input id="X" type="text" placeholder="โปรดป้อน lat ของคุณ" class="form-control">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">lng</span>
                                        </div>
                                        <input id="Y" type="text" placeholder="โปรดป้อน lng ของคุณ" class="form-control">
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
        
        <div class="container mt-4" id="map"></div>
        <script>
            // map
            var map;
            function initMap(x,y) {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: x, lng: y },
                    zoom: 11
                });
            };
            // map      
        </script>
    </div>
</body>
<script>
    $("#btn").click(() => {
        var x = parseInt($("#X").val());
        var y = parseInt($("#Y").val());
        initMap(x,y);
    });
</script>
</html>
