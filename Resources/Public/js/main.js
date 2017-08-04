$(Document).ready(function(){

    var arrNr;
    var year;
    var recorddate;
    var department;

    var attr = new Array();

    var target = $('select#recordtype');

    if (target.text() === null){
        arrNr = attr.push('täglich');
    }
    // start to selecting record
    target.on('change', function () {
        var select = target.val();
        if (select === 1) {
            arrNr = attr.slice(0, 1, select)
        }
        else {
            arrNr = attr.push(select);
        }
        console.log(attr[0]);
    });

    $('select#year option').on('click', function () {
        arrNr = attr.push($('select#year').text());
    });
    $('input#recorddate').on('click', function () {
        arrNr = attr.push($('input#recorddate').val());
        console.log($('#recorddate').val());
    });
    $('select#department').on('click', function () {
 // by select of an department
        arrNr = attr.push($('select#departemnt option:selected').text());
    });
    console.log(attr[1]);
    // console.log(attr[2]);
    // console.log(attr[3]);
    // console.log(attr[4]);
    // console.log(attr[5]);
    // console.log(attr[6]);
// when all four parameters are setted, ajax have to send over post the parameters
    if (attr.length >= 1){
        var url = '/index.php';
        var data = 'case=save&recordtype=';

        for (i = 1; i >= 3; i++) {
            if (attr.find(i)) {
                if (attr.find('täglich')) {
                    data += 'täglich'
                }
                if (attr.find('wöchentlich')) {
                    data += 'wöchentlich';
                }
                if (attr.find('monatlich')) {
                    data += 'monatlich';
                }

                data += '&year=';
                data += i;
                console.log(attr[i]);
            }
        }

        for (i = 0; i < 4; i++) {
            var check = Date.setTime(attr[i]);
            if (check instanceof Date) {
                data += '&recordate=';
                data += attr[i];
                console.log(attr[i]);
            }
        }

        for (i = 0; i < 4; i++) {
            if (attr[i] instanceof String) {
                data += '&department=';
                data += attr[i];
                console.log(attr[i]);
            }
        }

console.log(data);

        $.post(url, data, function(result, status, xhr) {
            $('div.work p').innerHTML = result;
            console.log(result+'<br/> neue zeile: '+status+'<br/> xhr: '+xhr)
        });
    }
// end of record-selection

//  by clicking in the recordfield the paragraph has to change with textarea the position to edit record
    $('div.record-box div > p').on('click', function () {
        var text = null;
        text = $('div > p').text();
        $(this).parent('div').html(function () {
            $(this).append('<textarea class="text-edit" name="record">' + text + '</textarea>');
        });
        $(this).remove();

        // leaving textarea by click outside the box
        $('div.record-box div > textarea.text-edit').on('focus', function () {
            $(document).mouseup(function (e) {

                var container = $('textarea.text-edit');
                if (!container.is(e.target) && container.has(e.target).length === 0) {

                    text = null;
                    text = $('div > textarea.text-edit').text();
                    $(this).parent('div').html(function () {
                        $(this).append('<p>' + text + '</p>');
                    });
                    $(this).remove();

                    var id = $('#hidden_id').text();
                    // transmitting content over ajax and save in DB
                    $.ajax({
                        url: "/index.php?case=save&id=" + id + "&record=" + text, success: function (result) {
                            console.log(result);
                        }
                    });
                }
            });

            // end edit in textarea by pressing return key
            $('textarea.text-edit').keypress(function (e) {

                var key = e.which;
                if (key == 13) {
                    text = null;
                    text = $('div > textarea.text-edit').text();
                    $(this).parent('div').html(function () {
                        $(this).append('<p>' + text + '</p>');
                    });
                    $(this).remove();

                    var id = $('#hidden_id').text();
                    // transmitting content over ajax and save in DB
                    var URL = "/index.php";
                    var data = "case=save&id=" + id + "record=" + text;
                    var dataType = "text";

                    $.post(URL, data, function (response, status, xhr) {
                        // $.ajax({url: "/index.php?case=save&record=" + text, success: function () {console.log(result);} });
                        console.log(response, status, xhr);
                    });
                }
            });
            console.log(text);
        });
        console.log(text);
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

