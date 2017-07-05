$(Document).ready(function () {

    function loadRecords() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('dump-record').innerHTML = this.responseText;
            }
        };

        xhttp.open('GET', 'ajax_info.txt', TRUE);
        xhttp.send();
    }
});