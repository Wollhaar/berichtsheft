function loadCurrentMonth()
{
  //url	Required. Specifies the URL you wish to load
  //data	Optional. Specifies data to send to the server along with the request
  //function(response,status,xhr)	Optional. Specifies a callback function to run when the load() method is completed.
  //
  //  Additional parameters:
  //  response - contains the result data from the request
  //status - contains the status of the request ("success", "notmodified", "error", "timeout", or "parsererror")
  //xhr - contains the XMLHttpRequest object

  var URL = "http://recordbook.frankb.exinitdev.de/Resources/PHP/model/AJAXControler/AJAXController.php";
  var data = "method=getCurrentMonth";
  var dataType = "text";

  $.post(URL, data, function (response, status, xhr)
  {

    if (status != 'success') {
      document.getElementById(
        'jumb').innerHTML = '<div>Fehler: ' + status + '<p>' + xhr + '</p></div>';
    }
    var jsonObject = JSON.parse(response);

    var monArray = [];
    var tueArray = [];
    var wedArray = [];
    var thuarray = [];
    var friarray = [];

    monArray.push('<div class="col-md-2">');
    monArray.push('<div class="list-group">');
    monArray.push('<button class="list-group-item">Montag</button>');

    tueArray.push('<div class="col-md-2">');
    tueArray.push('<div class="list-group">');
    tueArray.push('<button class="list-group-item">Diesnstag</button>');

    wedArray.push('<div class="col-md-2">');
    wedArray.push('<div class="list-group">');
    wedArray.push('<button class="list-group-item">Mittwoch</button>');

    thuarray.push('<div class="col-md-2">');
    thuarray.push('<div class="list-group">');
    thuarray.push('<button class="list-group-item">Donnerstag</button>');

    friarray.push('<div class="col-md-2">');
    friarray.push('<div class="list-group">');
    friarray.push('<button class="list-group-item">Freitag</button>');

    for (var i = 0; i < jsonObject.length; i++) {

      var newDate = new Date(jsonObject[i]['recorddate'])
      newDate.toDateString();
      var newDay = newDate.toString().slice(0, 3);
      newDate = newDate.getFullYear() + '-' + (newDate.getMonth() + 1) + '-' + newDate.getDate();

      switch (newDay) {
        case 'Mon': {
          monArray.push(
            '<button class="list-group-item" value="' + newDate + '" onclick="records(2017-06-05)">' + newDate + '</button>');
          break;
        }
        case 'Tue': {
          tueArray.push(
            '<button class="list-group-item">' + newDate + '</button>');
          break;
        }
        case 'Wed': {
          wedArray.push(
            '<button class="list-group-item">' + newDate + '</button>');
          break;
        }
        case 'Thu': {
          thuarray.push(
            '<button class="list-group-item">' + newDate + '</button>');
          break;
        }
        case 'Fri': {
          friarray.push(
            '<button class="list-group-item">' + newDate + '</button>');
          break;
        }
        default:
          ;
      }
    }

    monArray.push('</div>');
    monArray.push('</div>');
    tueArray.push('</div>');
    tueArray.push('</div>');
    wedArray.push('</div>');
    wedArray.push('</div>');
    thuarray.push('</div>');
    thuarray.push('</div>');
    friarray.push('</div>');
    friarray.push('</div>');

    var monday = "";
    var tuesday = "";
    var wendsday = "";
    var thursday = "";
    var friday = "";
    var week;

    for (var m = 0; m < monArray.length; m++) {
      monday += monArray[m];
    }
    week = monday;

    for (var m = 0; m < tueArray.length; m++) {
      tuesday += tueArray[m];
    }
    week += tuesday;

    for (var m = 0; m < wedArray.length; m++) {
      wendsday += wedArray[m];
    }
    week += wendsday;

    for (var m = 0; m < thuarray.length; m++) {
      thursday += thuarray[m];
    }
    week += thursday;

    for (var m = 0; m < monArray.length; m++) {
      friday += friarray[m];
    }
    week += friday;
    document.getElementById('jumb').innerHTML = week;

  }, dataType)
}

function records()
{
  //url	Required. Specifies the URL you wish to load
  //data	Optional. Specifies data to send to the server along with the request
  //function(response,status,xhr)	Optional. Specifies a callback function to run when the load() method is completed.
  //
  //  Additional parameters:
  //  response - contains the result data from the request
  //status - contains the status of the request ("success", "notmodified", "error", "timeout", or "parsererror")
  //xhr - contains the XMLHttpRequest object

  var URL = "http://recordbook.frankb.exinitdev.de/Resources/PHP/model/AJAXControler/AJAXController.php";
  var data = "method=getRecord&selectRec=2017-06-05";
  var dataType = "text";

  $.post(URL, data, function (response, status, xhr)
  {

    if (status != 'success') {
      document.getElementById(
        'jumb').innerHTML = '<div>Fehler: ' + status + '<p>' + xhr + '</p></div>';
    }

    var jsonObject = JSON.parse(response);

    var recordDat = [];
    for (var i = 0; i < jsonObject.length; i++) {
      recordDat.push(jsonObject[i]['status'], jsonObject[i]['place'],
        jsonObject[i]['record'], jsonObject[i]['comment']);
    }

    console.log(recordDat);

  }), dataType
}

function setSelectField(place, status)
{

  switch (status) {
    case 1: {
      document.getElementById('statusOption1').selected = true;
      break;
    }
    case 2: {
      document.getElementById('statusOption2').selected = true;
      break;
    }
    case 3: {
      document.getElementById('statusOption3').selected = true;
      break;
    }
    case 4: {
      document.getElementById('statusOption4').selected = true;
      break;
    }
    case 5: {
      document.getElementById('statusOption5').selected = true;
      break;
    }
  }

  switch (place) {
    case 1: {
      document.getElementById('placeOption1').selected = true;
      break;
    }
    case 2: {
      document.getElementById('placeOption2').selected = true;
      break;
    }
    case 3: {
      document.getElementById('placeOption3').selected = true;
      break;
    }
  }
}

var recordCount = 0;

function addRecord()
{

  if (recordCount == 0) {
    document.getElementById('end').innerHTML =
      '<div class="row" id="newRecordDiv' + recordCount + '">' +
      '<div class="row">' +
      '<div class="col-md-1 col-md-offset-1 form-group">' +
      '<label class="sr-only"></label>' +
      '<button id="delRecordButton' + recordCount + '" class="form-control" value="-" type="button" onclick="delRecord(this.id);">-</button>' +
      '</div>' +
      '<div class="col-md-3 form-group">' +
      '<label class="sr-only"></label>' +
      '<input class="form-control" id="record' + recordCount + '" name="record' + recordCount + '" type="text" value="Berichtshefteintrag">' +
      '</div> ' +
      '<div class="col-md-1 form-group"> ' +
      '<label class="sr-only"></label>' +
      '<input class="form-control" id="time' + recordCount + '" name="time' + recordCount + '" type="text" value="00:h 00:m">' +
      '</div> ' +
      '<div class="col-md-4 form-group">' +
      '<label class="sr-only"></label>' +
      '<input class="form-control" id="comment' + recordCount + '" name="comment' + recordCount + '" type="text" value="Kommentare zum Eintrag">' +
      '</div>' +
      '</div>' +
      '</div>' +
      '<div id="end' + recordCount + '"></div>';

  }
  else {
    document.getElementById('end' + (recordCount - 1)).innerHTML =
      '<div class="row" id="newRecordDiv' + recordCount + '">' +
      '<div class="row">' +
      '<div class="col-md-1 col-md-offset-1">' +
      '<button id="delRecordButton' + recordCount + '" class="form-control" value="delRecordButton' + recordCount + '" type="button" onclick="delRecord(this.id);">-</button>' +
      '</div>' +
      '<div class="col-md-3">' +
      '<input class="form-control" id="record' + recordCount + '" name="record' + recordCount + '" type="text" value="Berichtshefteintrag">' +
      '</div> ' +
      '<div class="col-md-1"> ' +
      '<input class="form-control" id="time' + recordCount + '" name="time' + recordCount + '" type="text" value="00:h 00:m">' +
      '</div> ' +
      '<div class="col-md-4">' +
      '<input class="form-control" id="comment' + recordCount + '" name="comment' + recordCount + '" type="text" value="Kommentare zum Eintrag">' +
      '</div>' +
      '</div>' +
      '</div>' +
      '<div id="end' + recordCount + '"></div>';
  }

  return recordCount++;
}

function delRecord(clicked_id)
{
  var id = document.getElementById(clicked_id).id;
  id = id.slice(15, 16);
  var record = document.getElementById('newRecordDiv' + id);
  record.parentNode.removeChild(record);

  return recordCount--;
}
