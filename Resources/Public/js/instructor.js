/*
Prüfen welches der Nav Elemente Betrieb/Extern/Schule aktiv ist
aus der Session variable Instructor dementsprechende Instructoren ziehen
anzahl benötigter Felder erzeugen und mit Inhalt füllen
 */

function addInstructor()
{

  var instructorForm = "<form id='instructorForm' method='post'>\n" +
    "      <div class=\"row\">\n" +
    "        <div class=\"col-md-4\">\n" +
    "          <div class=\"form-group\">\n" +
    "            <label for=\"instructorName\">Name</label>\n" +
    "            <input type=\"text\" class=\"form-control formInput\" id=\"instructorName\"></input>\n" +
    "          </div>\n" +
    "          <div class=\"form-group\">\n" +
    "            <label for=\"instructorVorname\">Vorname</label>\n" +
    "            <input type=\"text\" class=\"form-control formInput\" id=\"instructorVorname\"></input>\n" +
    "          </div>\n" +
    "          <div class=\"form-group\">\n" +
    "            <label for=\"instructorRolle\">Rolle</label>\n" +
    "            <input type=\"text\" class=\"form-control formInput\" id=\"instructorRolle\"></input>\n" +
    "          </div>\n" +
    "        </div>\n" +
    "        <div class=\"col-md-4\">\n" +
    "          <div class=\"form-group\">\n" +
    "            <label for=\"location\">Location</label>\n" +
    "            <select class=\"form-control formInput\" id=\"location\">\n" +
    "              <option value=\"Betrieb\" class=\"location\">Betrieb</option>\n" +
    "              <option value=\"Schule\" class=\"location\">Schule</option>\n" +
    "              <option value=\"Extern\" class=\"location\">Extern</option>\n" +
    "            </select>\n" +
    "          </div>\n" +
    "          <div class=\"form-group\">\n" +
    "            <label for=\"content\">Kurzbeschreibung</label>\n" +
    "            <textarea class=\"form-control formInput\" id=\"content\" rows=\"6\"></textarea>\n" +
    "          </div>\n" +
    "          <div class=\"form-group\">\n" +
    "            <button type=\"button\" id=\"submitB\" class=\"btn btn-default formInput\"  onclick=\"addDB();\">\n" +
    "              <span class=\"glyphicon glyphicon glyphicon-ok formInput\" aria-hidden=\"true\"></span>\n" +
    "            </button>\n" +
    "            <button type=\"button\" class=\"btn btn-default\" onclick=\"reseter();\">\n" +
    "              <span class=\"glyphicon glyphicon glyphicon-remove\" aria-hidden=\"true\" ></span>\n" +
    "            </button>\n" +
    "          </div>\n" +
    "        </div>\n" +
    "      </div>\n" +
    "    </form>"

  document.getElementById("edit").innerHTML = instructorForm;

}

function reseter()
{
  console.log("Do something");
  var parent = document.getElementById('edit');
  var chield = document.getElementById('instructorForm');
  parent.removeChild(chield);

  document.getElementById("jumb").innerHTML = addForm;

}

function addDB()
{

  var URL = "http://recordbook.frankb.exinitdev.de/Resources/PHP/model/AJAXControler/AJAXController.php";
//  var data = "method=writeInstructor";
  var data = {
    method: "writeInstructor",
    name: document.getElementById('instructorName').value,
    vorname: document.getElementById('instructorVorname').value,
    rolle: document.getElementById('instructorRolle').value,
    location: document.getElementById('location').value,
    content: document.getElementById('content').value
  };
  var dataType = "text";

  $.post(URL, data, function (response, status, xhr) {
    if (status != 'success') {
      console.log("Status: " + status + " XHR: " + xhr);
    }

    console.log(response);

  }, dataType)

}

function allowDrop(ev)
{
  ev.preventDefault();
}

function drag(ev)
{
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev)
{
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
}

function updateInstructor(inputElement)
{

  var url = "http://recordbook.frankb.exinitdev.de/Resources/PHP/model/AJAXControler/AJAXController.php";
  var data = {
    method: 'getSingleInstructor',
    single_id: document.getElementById('instructorId').value
  }
  var dataType = "text";
  $.post(url, data, function (response, status, xhr) {
    if (status != 'success') {
      console.log("Status: " + status + " XHR: " + xhr);
    }

    console.log(response);
    var jsonObject = JSON.parse(response);
    console.log(jsonObject[0]);


  }), dataType


  var string = inputElement.value;
  var splitter = string.split("\t");

  console.log(inputElement.parentNode.getAttributeNode('id'));

  var test = document.getElementById('jumbDrop');
  if (inputElement.parentNode.getAttributeNode('id') == test.getAttributeNode('id')) {

    addInstructor();

    document.getElementById('instructorName').value = splitter[0];
    document.getElementById('instructorVorname').value = splitter[1];
    document.getElementById('instructorRolle').value = splitter[2];
    document.getElementById('location').value = document.getElementById('location') ;
    document.getElementById('content').value = document.getElementById('content');
//    document.getElementById('imgPath').value = $() ;

    document.getElementById('submitB').setAttribute("onclick", "transmit()");
  }

}

function transmit()
{
  var url = "http://recordbook.frankb.exinitdev.de/Resources/PHP/model/AJAXControler/AJAXController.php";
  var data = {
    method: "updateInstructor",
    name: document.getElementById('instructorName').value,
    vorname: document.getElementById('instructorVorname').value,
    role: document.getElementById('instructorRolle').value,
    location: document.getElementById('location').value,
    content: document.getElementById('content').value,
    instructor_id: document.getElementById('instructorId').value
  };

  var dataType = "text";

  $.post(url, data, function (response, status, xhr) {
    if (status != 'success') {
      console.log("Status: " + status + " XHR: " + xhr);
    }

    var jsonObject = JSON.parse(response);
    if (jsonObject == true) {
      reseter();
      console.log(jsonObject);
    }

  }), dataType;

}

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
    //Object {name: "Berdel", vorname: "Frank", role: "Nabel Instructor", location: "Betrieb", imgPath: "img/thumb/frank.jpg"}

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
              "        <form class=\"form-horizontal\" >" +
              "          <div class=\"form-group\">" +
              "            <div class=\"col-md-6\">" +
              "              <input id='drag" + i + "' draggable=\"true\" ondragstart=\"drag(event)\" type=\"text\" class=\"form-control inputInstructors\" value='" + jsonObject[i]['name'] + "\t" + jsonObject[i]['vorname'] + "\t" + jsonObject[i]['role'] + "' readonly=\"true\" onclick=\"updateInstructor(this)\">" +
              "            </div>" +
              "            <a href=\"#\" data-toggle=\"popover" + i + "\" data-trigger=\"focus\"><img src=\"img/Icon/Informations-Icon.png\"></a>" +
              "          </div>" +
              "           <input id='instructorId' value='" + jsonObject[i]['instructor_id'] + "'></input>" +
              "        </form>";

        /*
        Evt. bessere Lösung wäre es den popoverScrpt variable mit eval() ausführen zu lassen
         */

        var popoverScript = "<script>" +
          "          $(document).ready(function ()" +
          "          {" +
          "            $('[data-toggle=\"popover" + i + "\"]')" +
          "              .popover({\n" +
          "                title: \"<img src='" + jsonObject[i]['imgPath'] + "' class='img-responsive'>\"," +
          "                content: \"<h4>Ausbilder</h4><p>" + jsonObject[i]['content'] + "</P>\"," +
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
        }
        if (i == jsonObject.length) {
          firm += endRow;
        }
        else {
          firm += form + popoverScript + endBlog
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
              "              <input id='drag" + i + "' draggable=\"true\" ondragstart=\"drag(event)\" type=\"text\" class=\"form-control inputInstructors\" value='" + jsonObject[i]['name'] + "\t" + jsonObject[i]['vorname'] + "\t" + jsonObject[i]['role'] + "' readonly=\"true\" onclick=\"updateInstructor(this)\">" +
              "            </div>" +
              "            <a href=\"#\" data-toggle=\"popover" + i + "\" data-trigger=\"focus\"><img src=\"img/Icon/Informations-Icon.png\"></a>" +
              "          </div>" +
              "           <input style='visibility: hidden' id='instructorId' value='" + jsonObject[i]['instructor_id'] + "'></input>" +
              "        </form>";

        var popoverScript = "<script>" +
          "          $(document).ready(function ()" +
          "          {" +
          "            $('[data-toggle=\"popover" + i + "\"]')" +
          "              .popover({\n" +
          "                title: \"<img src='" + jsonObject[i]['imgPath'] + "' class='img-responsive'>\"," +
          "                 content: \"<h4>Ausbilder</h4><p>" + jsonObject[i]['content'] + "</P>\"," +
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
              "              <input id='drag" + i + "' draggable=\"true\" ondragstart=\"drag(event)\" type=\"text\" class=\"form-control inputInstructors\" value='" + jsonObject[i]['name'] + "\t" + jsonObject[i]['vorname'] + "\t" + jsonObject[i]['role'] + "' readonly=\"true\" onclick=\"updateInstructor(this)\">" +
              "            </div>" +
              "            <a href=\"#\" data-toggle=\"popover" + i + "\" data-trigger=\"focus\"><img src=\"img/Icon/Informations-Icon.png\"></a>" +
              "          </div>" +
              "           <input style='visibility: hidden' id='instructorId' value='" + jsonObject[i]['instructor_id'] + "'></input>" +
              "        </form>";

        var popoverScript = "<script>" +
          "          $(document).ready(function ()" +
          "          {" +
          "            $('[data-toggle=\"popover" + i + "\"]')" +
          "              .popover({\n" +
          "                title: \"<img src='" + jsonObject[i]['imgPath'] + "' class='img-responsive'>\"," +
          "                content: \"<h4>Ausbilder</h4><p>" + jsonObject[i]['content'] + "</P>\"," +
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



