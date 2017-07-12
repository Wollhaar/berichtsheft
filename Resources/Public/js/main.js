$(Document).ready(function () {

    document.getElementById('btn-forward').onclick(function forwardLoadRecords(load) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('dump-record').innerHTML = this.responseText;
            }
        };

        console.log(load);
        xhttp.open('POST', 'index.php?case=getter', TRUE);
        xhttp.send('load=' + load);
    });

    document.getElementById('btn-back').onclick(function backLoadRecords(load) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('dump-record').innerHTML = this.responseText;
            }
        };

        console.log(load);
        xhttp.open('POST', 'index.php?case=getter', TRUE);
        xhttp.send('load=' + load);
    });


        document.getElementById('profile').onclick(function () {

            $('.profile-box').toggle();
        });

});

// javascript
function getStyleElement(id) {
    var style;
    style = document.defaultView.getComputedStyle(document.getElementById(id), '').getPropertyValue("display");
    return style;
}

function toggle_box() {

}