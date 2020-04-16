<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="{{url('js/jquery.min.js')}}"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-messaging.js"></script>
    
    <script  type="text/javascript" src="{{url('js/fcm.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <script>
        var socket = io("http://localhost:3000");
        $(document).ready(function() {
            $("#mrA").click(function() {
                var name = $("#name").val();
                var title = $("#title").val();
                var data = [name, title]
                // console.log(data)
                socket.emit("send-data", data);

                // Tạm thời chưa bật
                // let pushnotification = push(name, title);
                console.log(pushnotification)
            });

            //Đẩy thông báo lên FCM -> APP
            async function push(NameText, TitleText) {
                const FIREBASE_API_KEY = "AAAAqgYphBg:APA91bEV29uNbFJR2kF4Ldiz0Rvn8emaX1-BV1s14TYjdI8Yh3wnCNvoj71_DsS-d9JxBB6Uz9nBkOi62GT3kQyFgdcB1MKD51qE-i-E0cyLH6-6pQZ-pwKHKgEbxH0m3xEDC2Ra5RXL";
                const message = {
                    registration_ids: ["dJ1my11FDHg:APA91bGjjJhHjCvmMYNln2tc0FNVDfMngnvAvJwH49XPlySLXH-nt1kCvDI4wXgghAT3Z0xOQD2A_ICu4fZN6K3yZBYYRdddr7omEyKxy9FFQExEgK-lb48U-nZ6UgWOscs6yNTlMQgW"],
                    notification: {
                        title: NameText,
                        body: TitleText,
                        "vibrate": 1,
                        "sound": 1,
                        "show_in_foreground": true,
                        "priority": "high",
                        "content_available": true,
                    }
                }

                let headers = new Headers({
                    "Content-Type": "application/json",
                    "Authorization": "key=" + FIREBASE_API_KEY
                });

                let response = await fetch("https://fcm.googleapis.com/fcm/send", {
                    method: "POST",
                    headers,
                    body: JSON.stringify(message)
                })
                response = await response.json();
                return response;
            }
        })
    </script>

</head>

<body>
    Name<input type="text" id="name" />
    Title<input type="text" id="title" />
    <input type="button" id="mrA" value="Click">
    <h2 id="noidung"></h2>

    <hr>
    <h1>Thông báo mới</h1>
    @if(isset($count))
    <div style="color:red;">Đang có {{$count}} thông báo mới</div>
    @else
    <p>Không có</p>
    @endif
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown button
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @if(isset($android_data))
                @foreach($android_data as $key => $value)
                    <a class="dropdown-item" href="#">id : {{$key}}</a>
                    <a class="dropdown-item" href="#">Name : {{$value->name}}</a>
                    <a class="dropdown-item" href="#">Title{{$value->title}}</a>
                    <div class="dropdown-divider"></div>
                @endforeach
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>