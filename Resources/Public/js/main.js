


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

