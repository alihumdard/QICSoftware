<script>
    
    drawChart("canvas", "procent",{{ $sentQuote_percent }});
    drawChart("canvas1", "procent1",{{ $compCT_percent }});
    drawChart("canvas2", "procent2",{{ $compINV_percent }});


    function drawChart(canvasId, spanId,percentage) {
        var can = document.getElementById(canvasId),
            spanProcent = document.getElementById(spanId),
            c = can.getContext('2d');

        var posX = can.width / 2,
            posY = can.height / 2,
            fps = 1000 / 200,
            procent = 0,
            oneProcent = 360 / 100,
            result = oneProcent * percentage;

        c.lineCap = 'round';
        arcMove();

        function arcMove() {
            var degrees = 0;
            var arcInterval = setInterval(function() {
                degrees += 1;
                c.clearRect(0, 0, can.width, can.height);
                procent = degrees / oneProcent;

                document.getElementById(spanId).innerHTML = procent.toFixed();

                c.beginPath();
                c.arc(posX, posY, 65, (Math.PI / 180) * 270, (Math.PI / 180) * (270 + 360));
                c.strokeStyle = '#ECEAF3';
                c.lineWidth = '15';
                c.stroke();

                c.beginPath();
                c.strokeStyle = '#452C88';
                c.lineWidth = '15';
                c.arc(posX, posY, 65, (Math.PI / 180) * 270, (Math.PI / 180) * (270 + degrees));
                c.stroke();

                if (degrees >= result) clearInterval(arcInterval);
            }, fps);
        }
    }

    // Function to make the AJAX call and update the charts
    function updateCharts(selectedDate, user_id) {
        var apiname = 'dashboardCharts';
        var apiurl = "{{ end_url('') }}" + apiname;  
        var bearerToken = "{{session('user')}}";

        $.ajax({
            url: apiurl + `?selected_date=${selectedDate}&id=${user_id}`,
            type: 'GET',
            data: {
                selected_date: selectedDate,
                id: user_id,
            },
            headers: {
                'Authorization': 'Bearer ' + bearerToken
            },
            contentType: false,
            processData: false,
            beforeSend: function() {
                // Add any loading or UI updates before the API call
            },
            success: function(response) {
                if (response.status === 'success') {
                    var data = response.data; // Access the 'data' object from the response
                    drawChart("canvas", "procent",data.sentQuote_percent,true);
                    drawChart("canvas1", "procent1",data.compCT_percent,true);
                    drawChart("canvas2", "procent2",data.compINV_percent,true);
                } else {
                    // Handle other status cases if needed
                }
            },
            error: function(xhr, status, error) {
                console.log("Error:" +error);
            }
        });
    }

    // Bind the AJAX call to the date picker change event
    $('#datePickerInput').change(function () {
        var selectedDate = $(this).val();
        var user_id = "{{$user->id}}";
        updateCharts(selectedDate, user_id);
    });
</script>

