/*
Prüfen welches der Nav Elemente Betrieb/Extern/Schule aktiv ist
aus der Session variable Instructor dementsprechende Instructoren ziehen
anzahl benötigter Felder erzeugen und mit Inhalt füllen
 */

function showIstructors(ca)
{

  var URL = "http://recordbook.frankb.exinitdev.de/Resources/PHP/model/AJAXControler/AJAXController.php";
  var data = "method=getInstructor";
  var dataType = "text";

  $.post(URL, data, function (response, status, xhr) {
    if (status != 'success') {
      document.getElementById(
        'jumb').innerHTML = '<div>Fehler: ' + status + '<p>' + xhr + '</p></div>';
    }

    var jsonObject = JSON.parse(response);
    console.log('Status: ' + status + ' xhr: ' + xhr);
    console.log(jsonObject[0]); //Object {name: "Berdel", vorname: "Frank", role: "Nabel Instructor"}

    var firm = "";
    var school = "";
    var ext = "";

    var firmcount = 0;
    var schoolcount = 0;
    var extcount = 0;

    for (var i = 0; i < jsonObject.length; i++) {

      if (jsonObject[i]['location'] == 'Betrieb') {
        firmcount++;
        var head = "<div class=\"row\" id=\"firmRow\">" +
          "      <div class=\"col-md-12 col-md-offset-1\">" +
          "        <label><h2>Betrieblicher Ausbilder</h2></label>";

        var form =
              "        <form class=\"form-horizontal\">" +
              "          <div class=\"form-group\">" +
              "            <div class=\"col-md-6\">" +
              "              <input type=\"text\" class=\"form-control\" value=" + jsonObject[i]['name'] + jsonObject[i]['vorname'] + jsonObject[i]['role'] + " readonly=\"true\">" +
              "            </div>" +
              "            <a href=\"#\" data-toggle=\"popover\"><img src=\"img/Icon/Informations-Icon.png\"></a>" +
              "          </div>" +
              "        </form>";

        var popoverScript = "<script>" +
          "          $(document).ready(function ()" +
          "          {\n" +
          "            $('[data-toggle=\"popover\"]')" +
          "              .popover({\n" +
          "                title: \"<img src='img/img/Profilbild_Ausbilder.png'>\"," +
          "                content: \"Lorem Ipsum\"," +
          "                placment: \"right\"," +
          "                html: true" +
          "              });" +
          "          });" +
          "        </script>";

        var endBlog = "<span class=\"col-md-12\" id=\"instructorBlog\"></span>";

        var endRow =
              "      </div>" +
              "" +
              "    </div>";

        if (firmcount == 1) {
          firm = head;
//          $('#instructorBlog').append(head + form + popoverScript + endBlog);
        }
        if (i == jsonObject.length) {
          firm += endRow;
//          $('#instructorBlog').append(endRow);
        }
        else {
          firm += form + popoverScript + endBlog
//          $('#instructorBlog').append(form + popoverScript + endBlog);
        }
      }
      if (jsonObject[i]['location'] == 'Schule') {
        schoolcount++;
        var head = "<div class=\"row\" id=\"schoolRow\">" +
          "      <div class=\"col-md-12 col-md-offset-1\">" +
          "        <label><h2>Schulische Ausbilder</h2></label>";

        var form =
              "        <form class=\"form-horizontal\">" +
              "          <div class=\"form-group\">" +
              "            <div class=\"col-md-6\">" +
              "              <input type=\"text\" class=\"form-control\" value=" + jsonObject[i]['name'] + jsonObject[i]['vorname'] + jsonObject[i]['role'] + " readonly=\"true\">" +
              "            </div>" +
              "            <a href=\"#\" data-toggle=\"popover\"><img src=\"img/Icon/Informations-Icon.png\"></a>" +
              "          </div>" +
              "        </form>";

        var popoverScript = "<script>" +
          "          $(document).ready(function ()" +
          "          {\n" +
          "            $('[data-toggle=\"popover\"]')" +
          "              .popover({\n" +
          "                title: \"<img src='img/img/Profilbild_Ausbilder.png'>\"," +
          "                content: \"Lorem Ipsum\"," +
          "                placment: \"right\"," +
          "                html: true" +
          "              });" +
          "          });" +
          "        </script>";

        var endBlog = "<span class=\"col-md-12\" id=\"instructorBlog\"></span>";

        var endRow =
              "      </div>" +
              "" +
              "    </div>";

        if (schoolcount == 1) {
          school = head;
        }
        if (i == jsonObject.length) {
          school += endRow;
        }
        else {
          school += form + popoverScript + endBlog
        }
      }
      if (jsonObject[i]['location'] == 'Extern') {
        extcount++;
        var head = "<div class=\"row\" id=\"extRow\">" +
          "      <div class=\"col-md-12 col-md-offset-1\">" +
          "        <label><h2>Externe Ausbilder</h2></label>";

        var form =
              "        <form class=\"form-horizontal\">" +
              "          <div class=\"form-group\">" +
              "            <div class=\"col-md-6\">" +
              "              <input type=\"text\" class=\"form-control\" value=" + jsonObject[i]['name'] + jsonObject[i]['vorname'] + jsonObject[i]['role'] + " readonly=\"true\">" +
              "            </div>" +
              "            <a href=\"#\" data-toggle=\"popover\"><img src=\"img/Icon/Informations-Icon.png\"></a>" +
              "          </div>" +
              "        </form>";

        var popoverScript = "<script>" +
          "          $(document).ready(function ()" +
          "          {\n" +
          "            $('[data-toggle=\"popover\"]')" +
          "              .popover({\n" +
          "                title: \"<img src='img/img/Profilbild_Ausbilder.png'>\"," +
          "                content: \"Lorem Ipsum\"," +
          "                placment: \"right\"," +
          "                html: true" +
          "              });" +
          "          });" +
          "        </script>";

        var endBlog = "<span class=\"col-md-12\" id=\"instructorBlog\"></span>";

        var endRow =
              "      </div>" +
              "" +
              "    </div>";

        if (extcount == 1) {
          ext = head;
        }
        if (i == jsonObject.length) {
          ext += endRow;
        }
        else {
          ext += form + popoverScript + endBlog
        }
      }
    }

    switch (ca) {
      case 'Betrieb': {
        $('#firmRow').remove();
        $('#schoolRow').remove();
        $('#extRow').remove();
        $('#instructorBlog').append(firm);
        break;
      }
      case 'Schule': {
        $('#schoolRow').remove();
        $('#firmRow').remove();
        $('#extRow').remove();
        $('#instructorBlog').append(school);
        break;
      }
      case 'Extern': {
        $('#extRow').remove();
        $('#firmRow').remove();
        $('#schoolRow').remove();
        $('#instructorBlog').append(ext);
        break
      }
    }
  }, dataType)
}



