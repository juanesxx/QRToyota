@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>LECTOR QR</h3>
            <div id="loadingMessage">🎥 Incapaz de acceder a la cámara web (asegúrate de tener la cámara activada)</div>
            <canvas id="canvas" hidden></canvas>
            <div id="output" hidden>
                <div id="outputMessage"><h6>No ha detectado un código QR</h6></div>
                <form method="POST" action="{{ route('cupon.store') }}">
                    @csrf
                    <div hidden><b>Datos:</b> <span id="outputData"></span></div>
                    <input type="hidden" name="placa" id="placa">
                    <button class="btn btn-primary mt-2" type="submit">Redimir código</button>
                </form>
                @if(Session::has('success'))
                    <div class="alert alert-success mt-2">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('errorOne'))
                  <div class="alert alert-danger mt-2">{{Session::get('errorOne')}}</div>
                @endif
                @if(Session::has('errorTwo'))
                <div class="alert alert-warning mt-2" role="alert">
                <h5 class="alert-heading">Este cupon ya fue redimido</h5>
                    <hr>
                    <p class="mb-0">{{Session::get('errorTwo')}}</p>
                    <p class="mb-0">{{Session::get('who')}}</p>
                    <p class="mb-0">{{Session::get('updated')}}</p>

                </div>
                @endif
            </div>
      <div>
            </div>
            <script>
                var video = document.createElement("video");
                var canvasElement = document.getElementById("canvas");
                var canvas = canvasElement.getContext("2d");
                var loadingMessage = document.getElementById("loadingMessage");
                var outputContainer = document.getElementById("output");
                var outputMessage = document.getElementById("outputMessage");
                var outputData = document.getElementById("outputData");
                var placa = document.getElementById("placa");


                function drawLine(begin, end, color) {
                    canvas.beginPath();
                    canvas.moveTo(begin.x, begin.y);
                    canvas.lineTo(end.x, end.y);
                    canvas.lineWidth = 4;
                    canvas.strokeStyle = color;
                    canvas.stroke();
                }

                // Use facingMode: environment to attemt to get the front camera on phones
                navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: "environment"
                    }
                }).then(function(stream) {
                    video.srcObject = stream;
                    video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                    video.play();
                    requestAnimationFrame(tick);
                });

                function tick() {
                    loadingMessage.innerText = "⌛ Loading video..."
                    if (video.readyState === video.HAVE_ENOUGH_DATA) {
                        loadingMessage.hidden = true;
                        canvasElement.hidden = false;
                        outputContainer.hidden = false;

                        canvasElement.height = video.videoHeight;
                        canvasElement.width = video.videoWidth;
                        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
                        var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
                        var code = jsQR(imageData.data, imageData.width, imageData.height, {
                            inversionAttempts: "dontInvert",
                        });
                        if (code) {
                            drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
                            drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
                            drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
                            drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
                            outputMessage.hidden = true;
                            outputData.parentElement.hidden = false;
                            outputData.innerText = code.data;
                            placa.value = code.data;
                        }
                        // } else {
                        //   outputMessage.hidden = false;
                        //   outputData.parentElement.hidden = true;
                        // }
                    }
                    requestAnimationFrame(tick);
                }
            </script>
        </div>
    </div>
</div>
@endsection