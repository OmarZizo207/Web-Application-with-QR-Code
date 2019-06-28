@extends('style.index')
@section('content')

@push('js')
    <script type="text/javascript">
        var video = document.getElementById('video');
        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');

        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.oGetUserMedia || msGetUserMedia;

        if(navigator.getUserMedia) {
            navigator.getUserMedia({video: true}, streamWebCam, throwError);
        }

        function streamWebCam(stream)
        {
            try {
                video.srcObject = stream;
            } catch (error) {
                video.src = window.URL.createObjectURL(stream);
            }
            video.play();
        }
        function throwError(e)
        {
            alert(e.name);
        }
        function snap()
        {
            canvas.width = video.clientWidth;
            canvas.height = video.clientHeight;
            context.drawImage(video, 0, 0);
        }
    </script>
@endpush

<div class="cam" style="margin-top: 200px;">
    <video id="video"></video>
    <canvas id="canvas"></canvas>
    <button onclick="snap();">Snap</button>
</div>
@endsection