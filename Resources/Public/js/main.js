$('div.record-box div > p').on('click', function () {
    var text = $('div > p').text();
    $(this).parent('div').html(function () {
        $(this).append('<textarea class="text-edit" name="record">'+text+'</textarea>');
    });
    $(this).remove();

    $('div.record-box div > textarea.text-edit').on('focus', function () {
        $(document).mouseup(function(e) {

            var container = $('textarea.text-edit');
            if (!container.is(e.target) && container.has(e.target).length === 0) {

                var text = $('div > textarea.text-edit').text();
                $(this).parent('div').html(function () {
                    $(this).append('<p>' + text + '</p>');
                });
                $(this).remove();

                // transmitting content over ajax and save in DB
                $.ajax({url: "/index.php?case=save&record=" + text, success: function (result) {console.log(result);} });
            }
        });

        $('textarea.text-edit').keypress(function (e) {

            var key = e.which;
            if (key == 13) {
                var text = $('div > textarea.text-edit').text();
                $(this).parent('div').html(function () {
                    $(this).append('<p>' + text + '</p>');
                });
                $(this).remove();

                // transmitting content over ajax and save in DB
                $.ajax({url: "/index.php?case=save&record=" + text, success: function (result) {console.log(result);} });
            }
        });
    });
});



    function forwardLoadRecords(load) {

            $("button").click(function(){
                $.ajax({url: "/index.php?case=getter&load="+load, success: function(result){
                    $("#dump-record").html(result);
                }});
            });

    /*var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('dump-record').innerHTML = this.responseText;
            }
            else {
                console.log(xhttp.responseText);
            }
        };

        xhttp.open('POST', '/index.php?case=getter'/!*, TRUE*!/);
        xhttp.send("load=" + load);*/
        // console.log(xhttp);
    }

    function backLoadRecords(load) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('dump-record').innerHTML = this.responseText;
            }
        };

        console.log(load);
        xhttp.open('POST', 'index.php?case=getter');
        xhttp.send('load=' + load);
    }

