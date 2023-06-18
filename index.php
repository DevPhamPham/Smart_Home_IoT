<?php
include_once("connection.php");
session_start();
if (isset($_SESSION["user"])) {
    $username = $_SESSION["user"];
}else {
    header("Location: login.php"); // Đường dẫn tới trang đăng nhập
    exit; // Kết thúc script sau khi chuyển hướng
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SmartHome </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" type="text/javascript"></script>
    <link href="./vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <style>
        .switch {
          position: relative;
          display: inline-block;
          width: 60px;
          height: 34px;
        }
        
        .switch input { 
          opacity: 0;
          width: 0;
          height: 0;
        }
        
        .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
        }
        
        .slider:before {
          position: absolute;
          content: "";
          height: 26px;
          width: 26px;
          left: 4px;
          bottom: 4px;
          background-color: white;
          -webkit-transition: .4s;
          transition: .4s;
        }
        
        input:checked + .slider {
          background-color: #2196F3;
        }
        
        input:focus + .slider {
          box-shadow: 0 0 1px #2196F3;
        }
        
        input:checked + .slider:before {
          -webkit-transform: translateX(26px);
          -ms-transform: translateX(26px);
          transform: translateX(26px);
        }
        
        /* Rounded sliders */
        .slider.round {
          border-radius: 34px;
        }
        
        .slider.round:before {
          border-radius: 50%;
        }
    </style>

      <!-- Thư viện SweetAlert -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <style>
        h1,p,.dropdown span,h4,ul#bar_menu_active a,div.app_name,div.app_intro,i.mdi{
            color: #fff !important;
        }
        .container .col-lg-4.col-sm-6 .card{
            background-color: #bdcaff8f !important;
            border-radius: 20px !important;
        }
        #wrap_image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("./images/smarthome.jpg");
            background-repeat:repeat-y;
            background-size: contain;
            z-index: 0;
            opacity: 80%;
        }
        #body_web .container{
            position: relative;
            z-index: 1;
            background-color: #ffffff70 !important;
            border-radius: 25px;
            backdrop-filter: blur(7px);
        }
        
        h1{
            position: relative;
            z-index: 1;
        }
    </style>
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

    <div class="header text-center" style="position: fixed;z-index:9999; left:50%;transform: translateX(-50%); height: 126px; width: 100%;background-color: rgb(255 255 255 / 20%);backdrop-filter: blur(5px);">
        <!-- <div class="line" style="width:100vw; border-top: 8px solid #fff"></div> -->
        <div class="container" style="height: 121px">
        <div class="row h-100">

            <div class="col-3 logo-intro h-100 text-center">
            <div class="row h-100 d-flex align-items-center">
                <div class="image_vector col-3 text-end">
                <img width="42" height="39" src="./images/home.png" alt="logo">
                </div>
                <div class="wrap_text col-9" style="text-align: left">
                <div class="app_name" style="font-weight:700;font-size: 22px; text-align: left; font-family: 'Space Grotesk', sans-serif;">Smart Home IoT</div>
                <div class="app_intro" style="font-size:14px;font-family: 'Proxima Nova', sans-serif;text-align: left">Nhanh chóng. Tiện lợi. Thông minh</div>
                </div>
            </div>
            </div>

            <div class="col-9 menu-bar h-100 text-center">

            <div class="row h-100 d-flex align-items-center">
                <div class="horizontal_menu col-7">
                <ul class="d-flex flex-wrap" id="bar_menu_active" style="text-align: right">
                    <li class="mx-3"><a href="#" class="menu-link active" style="font-size:115%">Trang chủ</a></li>
                    <li class="mx-3"><a href="#" class="menu-link" style="font-size:115%">Tư vấn</a></li>
                    <li class="mx-3"><a href="#" class="menu-link" style="font-size:115%">Liên hệ</a></li>
                    <li class="mx-3"><a href="#" class="menu-link" style="font-size:115%">Tìm hiểu</a></li>
                </ul>
                </div>

                <div class="account_navbar col-3">
                    <ul>
                        <li class="non_anonymous">
                            <div class="dropdown">
                            <button class="avatar"><span style="font-family:'Space Grotesk', sans-serif; font-size:115%"> <?php echo $_SESSION["user"]; ?> </span><i class="mdi mdi-account" style="font-size:200%"></i></button>
                            <div class="dropdown-content">
                                <a href="/profile" style="font-size:115%">My Profile</a>
                                <a href="logout.php" style="font-size:115%">Log Out</a>
                            </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="get_started_navbar col-2">
                <button class="btn btn-warning py-2" style="border: 1px solid"><a href="#" style="font-weight: bold;font-size:115%">Get Started</a></button>
                </div>
            </div>
        <style>
        .horizontal_menu ul,
        .account_navbar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .horizontal_menu li,
        .account_navbar li {
            display: inline-block;
            margin-right: 10px;
        }

        .horizontal_menu a,
        .account_navbar a,
        .get_started_navbar a {
            text-decoration: none;
            color: #000;
        }

        .get_started_navbar {
            text-align: right;
        }

        .horizontal_menu ul li:hover a{
            color: darkgray;
        }

        .active{
            color: darkgray !important;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown .avatar {
            background-color: transparent;
            color: #000;
            border: none;
            cursor: pointer;
            padding: 0;
            font-size: inherit;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            z-index: 1;
            text-align: left;
        }

        .dropdown-content a {
            color: #000;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        {{!-- .non_anonymous{
            display: inline-block !important;
        }

        .anonymous{
            display: none !important;
        } --}}
        .get_started_navbar button:hover{
            background-color: #000;
        }
        .get_started_navbar button:hover a{
            color: #ffc107;
        }
        </style>
        </div>
        </div>
        </div>
    </div>
        
     
       
        <div id="body_web" class="content-body" style="margin-left:0 !important;">
        <div id="wrap_image"></div>
            <!-- row -->
            <div class="container">
                <h1 class="mb-5 text-center">Smart Home IoT</h1>

                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body" style="border-radius: 100% !important;">
                                <div class="stat-content">
                                    <div class="stat-text" style="font-weight: bold; color: #333;">Nhiệt độ </div>
                                    <div class="stat-digit"> <i class="fa fa-thermometer-half" aria-hidden="true"></i> <span id="nd">0</span>&#8451;</div>
                                </div>
                                <div class="progress">
                                    <!-- <div class="progress-bar progress-bar-warning w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div> -->
                                        <progress class="progress-bar  bg-warning" role="progressbar" style="width:100%;" id="progress_temp" value="50" max="100"> 32% </progress>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body" style="border-radius: 100% !important;">
                                <div class="stat-content">
                                    <div class="stat-text" style="font-weight: bold; color: black;">Độ ẩm</div>
                                    <div class="stat-digit"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-droplet" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M7.21.8C7.69.295 8 0 8 0c.109.363.234.708.371 1.038.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8zm.413 1.021A31.25 31.25 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10a5 5 0 0 0 10 0c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z"/>
                                        <path fill-rule="evenodd" d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448z"/>
                                      </svg></i> <span id="da"> 0 </span> %</div>
                                </div>
                                <div class="progress">
                                    <!-- <div class="progress-bar progress-bar-warning w-70" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div> -->
    
                                        <progress class="progress-bar" style="width:100%;" id="progress_humidity" value="50" max="100"> 32% </progress>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body" style="border-radius: 100% !important;">
                                <div class="stat-content">
                                    <div class="stat-text" style="font-weight: bold; color: black;"><img style="max-width:50px ;" src="./images/light-bulb.png" alt=""></div>
                                    <label class="switch">
                                        <input  id="light"  type="checkbox">
                                        <span class="slider"></span>
                                      </label>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body" style="border-radius: 100% !important;">
                                <div class="stat-content">
                                    <div class="stat-text" style="font-weight: bold; color: black;"><img style="max-width:50px ;" src="./images/door.png" alt=""></div>
                                    <label class="switch">
                                        <input  id="door"  type="checkbox">
                                        <span class="slider"></span>
                                      </label>

                                </div>
                                
                            </div>
                        </div>
                       
                    </div>
                      <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body" style="border-radius: 100% !important;">
                                 <div class="stat-content">
                                    <div class="stat-text" style="font-weight: bold; color: black;">Cảm biến sáng</div>
                                    <div class="stat-digit"> 
                                        <img style="max-width: 25px;" src="./images/sun.png" alt="">
                                      <span id="ds"> 0 </span> LUX</div>
                                </div>
                                <div class="progress">
                                    <!-- <div class="progress-bar progress-bar-warning w-70" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div> -->
    
                                        <progress class="progress-bar" style="width:100%;" id="progress_ds" value="50" max="6000"> 32lux </progress>
                                    
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body" style="border-radius: 100% !important;">
                                 <div class="stat-content">
                                    <div class="stat-text" style="font-weight: bold; color: black;">Cảm biến chuyển động</div>
                                    <div class="stat-digit"> 
                                        <img style="max-width: 50px;" src="./images/motion-sensor.png" alt="">
                                </div>
                                <div class="text-center">
                                    <div class="w-100">
                                        <span id="motion"></span>
                                    </div>
                                        <audio id="myAudio">
                                            <source src="audio/canhbao.mp3" type="audio/ogg">
                                            <source src="audio/canhbao.mp3" type="audio/mpeg">
                                        </audio>
                                    </div>
                                </div>
                            </div>
                       
                        </div>
                    </div>
                    
                    <!-- /# column -->
                </div>

                <div class="sales-boxes row">
                <div class="recent-sales box col-6">
                    <h4 class="title">THỐNG KÊ NHIỆT ĐỘ</h4>
                    <div class="sales-details">
                    <div id="chart" style="width:100%"></div>
                    </div>
                </div>
                <div class="recent-sales box col-6">
                    <h4 class="title">THỐNG KÊ ĐỘ ẨM</h4>
                    <div class="sales-details">
                    <div id="chart2" style="width:100%"></div>
                    </div>
                </div>
                <div class="recent-sales box col-6">
                    <h4 class="title">THỐNG KÊ CƯỜNG ĐỘ ÁNH SÁNG</h4>
                    <div class="sales-details">
                    <div id="chart5" style="width:100%"></div>
                    </div>
                </div>
                </div>

            </div>

            <div class="footer">
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js" integrity="sha512-Dz4zO7p6MrF+VcOD6PUbA08hK1rv0hDv/wGuxSUjImaUYxRyK2gLC6eQWVqyDN9IM1X/kUA8zkykJS/gEVOd3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
            <?php
    $channelID = '2193091';
    $apiKey = 'OQ3V0W1KGK3RBO3C';

    $url = "https://api.thingspeak.com/channels/{$channelID}/feeds.json";

    // Khởi tạo một session cURL
    $curl = curl_init();

    // Cấu hình yêu cầu cURL
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

    // Thêm các tham số vào URL
    $params = array(
        'api_key' => $apiKey,
        // 'results' => $results
    );
    $url = $url . '?' . http_build_query($params);
    curl_setopt($curl, CURLOPT_URL, $url);

    // Gửi yêu cầu GET và lấy phản hồi
    $response = curl_exec($curl);

    // Kiểm tra xem có lỗi xảy ra trong quá trình gửi yêu cầu hay không
    if ($response === false) {
        // Xử lý lỗi ở đây (ví dụ: in ra thông báo lỗi)
        echo "Đã xảy ra lỗi trong quá trình gửi yêu cầu.";
    } else {
        // Dữ liệu đã được nhận thành công
        // Tiếp tục xử lý dữ liệu ở đây
        // Ví dụ: gửi dữ liệu sang JavaScript
        echo "var responseData = " . json_encode($response) . ";";
    }

    // Đóng session cURL
    curl_close($curl);
    ?>
    responseData = JSON.parse(responseData)
    const data = responseData;
    const field1 = data.channel.field1;
    const field2 = data.channel.field2;
    const field3 = data.channel.field3;
    const feeds = data.feeds;
    const dataNhietDo = [];
    const dataDoAm = [];
    const dataAnhSang = [];
    const dataDate = [];

    feeds.forEach(feed =>{
      dataNhietDo.push(parseFloat(feed.field1));
      dataDoAm.push(parseFloat(feed.field2));
      dataAnhSang.push(parseFloat(feed.field3.replace(/\r/g, '')));
      dataDate.push(Date.parse(feed.created_at));
    });

    var options = {
            series: [{
                name: 'Nhiệt độ',
                type: 'line',
                data: dataNhietDo
            }, 
            ],
            colors: ['#FF0000'],
            chart: {
                height: 350,
                type: 'line',
                stacked: false,
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            plotOptions: {
                bar: {
                    columnWidth: '100%'
                }
            },

            fill: {
                opacity: [1],
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    opacityFrom: 0.9,
                    opacityTo: 0.6,
                    stops: [0, 100, 100, 100]
                }
            },
            labels: dataDate,
            markers: {
                size: 0
            },
            xaxis: {
                          title: {
              text: 'Thời gian',
            },
                type: 'datetime'
            },
            yaxis: {
                title: {
                    text: 'Nhiệt độ (℃)',
                },
                //min: 0
                labels: {
                  formatter: function (value) {
                    return value.toFixed(2); // Áp dụng hàm toFixed(2) để làm tròn dữ liệu trục y đến hai chữ số thập phân
                  }
                }
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                  formatter: function (y) {
                      if (typeof y !== "undefined" || y !=null) {
                          return y + " ℃";
                      }
                      return 0 + " ℃";
                  }
                }
            }
        };

    var options2 = {
        series: [{
            name: 'Độ ẩm',
            type: 'line',
            data: dataDoAm
        }, 
        ],
        colors: ['#00e600'],
        chart: {
            height: 350,
            type: 'line',
            stacked: false,
        },
        stroke: {
            width: 2,
            curve: 'smooth'
        },
        plotOptions: {
            bar: {
                columnWidth: '100%'
            }
        },

        fill: {
            opacity: [1],
            gradient: {
                inverseColors: false,
                shade: 'light',
                type: "vertical",
                opacityFrom: 0.9,
                opacityTo: 0.6,
                stops: [0, 100, 100, 100]
            }
        },
        labels: dataDate,
        markers: {
            size: 0
        },
        xaxis: {
                        title: {
            text: 'Thời gian',
        },
            type: 'datetime'
        },
        yaxis: {
            title: {
                text: 'Độ ẩm (%)',
            },
            //min: 0
            labels: {
                formatter: function (value) {
                return value.toFixed(2); // Áp dụng hàm toFixed(2) để làm tròn dữ liệu trục y đến hai chữ số thập phân
                }
            }
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                    if (typeof y !== "undefined" || y !=null) {
                        return y + " %";
                    }
                    return 0 + " %";
                }
            }
        }
    };
    var options5 = {
            series: [{
                name: 'Cường độ sáng',
                type: 'line',
                data: dataAnhSang
            }, 
            ],
            colors: ['#ff8000'],
            chart: {
                height: 350,
                type: 'line',
                stacked: false,
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            plotOptions: {
                bar: {
                    columnWidth: '100%'
                }
            },

            fill: {
                opacity: [1],
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    opacityFrom: 0.9,
                    opacityTo: 0.6,
                    stops: [0, 100, 100, 100]
                }
            },
            labels: dataDate,
            markers: {
                size: 0
            },
            xaxis: {
                          title: {
              text: 'Thời gian',
            },
                type: 'datetime'
            },
            yaxis: {
                title: {
                    text: 'Cường độ sáng (lux)',
                },
                //min: 0
                labels: {
                  formatter: function (value) {
                    return value.toFixed(2); // Áp dụng hàm toFixed(2) để làm tròn dữ liệu trục y đến hai chữ số thập phân
                  }
                }
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                  formatter: function (y) {
                      if (typeof y !== "undefined" || y !=null) {
                          return y + " lux";
                      }
                      return 0 + " lux";
                  }
                }
            }
        };
        

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
    var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
    chart2.render();
    var chart5 = new ApexCharts(document.querySelector("#chart5"), options5);
    chart5.render();

    </script>


    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>


    <!-- Vectormap -->
    <script src="./vendor/raphael/raphael.min.js"></script>
    <script src="./vendor/morris/morris.min.js"></script>


    <script src="./vendor/circle-progress/circle-progress.min.js"></script>
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>

    <script src="./vendor/gaugeJS/dist/gauge.min.js"></script>

    <!--  flot-chart js -->
    <script src="./vendor/flot/jquery.flot.js"></script>
    <script src="./vendor/flot/jquery.flot.resize.js"></script>

    <!-- Owl Carousel -->
    <script src="./vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Counter Up -->
    <script src="./vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="./vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="./vendor/jquery.counterup/jquery.counterup.min.js"></script>


    <!-- <script src="./js/dashboard/dashboard-1.js"></script> -->
    <!-- Control Firebase -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    
    <script  src="./js/main.js"></script>
  
</body>

</html>