/**
 * Created by exinit on 19.06.2017.
 */

var recordCount = 0;



function setSelectField(place, status){

  switch(status) {
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

    switch (place){
      case 1:{
        document.getElementById('placeOption1').selected = true;
        break;
      }
      case 2:{
        document.getElementById('placeOption2').selected = true;
        break;
      }
      case 3:{
        document.getElementById('placeOption3').selected = true;
        break;
      }
    }
  }





function addRecord(){

  if(recordCount == 0){
    document.getElementById('end').innerHTML =
      '<div class="row" id="newRecordDiv'+ recordCount + '">' +
        '<div class="row">' +
          '<div class="col-md-1 col-md-offset-1">' +
            '<button id="delRecordButton' + recordCount +'" class="form-control" value="-" type="button" onclick="delRecord(this.id);">-</button>' +
          '</div>'+
          '<div class="col-md-3">' +
            '<input class="form-control" id="record' + recordCount +'" name="record' + recordCount + '" type="text" value="Berichtshefteintrag">' +
          '</div> ' +
          '<div class="col-md-1"> ' +
            '<input class="form-control" id="time' + recordCount +'" name="time' + recordCount + '" type="text" value="00:h 00:m">' +
          '</div> ' +
          '<div class="col-md-4">' +
            '<input class="form-control" id="comment' + recordCount + '" name="comment' + recordCount + '" type="text" value="Kommentare zum Eintrag">' +
          '</div>' +
        '</div>' +
      '</div>' +
      '<div id="end' + recordCount +'"></div>';


      //document.getElementById('addRecordButton').setAttribute('onclick', 'doNothing()');



  }
  else{
    document.getElementById('end'+ (recordCount-1)).innerHTML =
      '<div class="row" id="newRecordDiv'+ recordCount + '">' +
        '<div class="row">' +
          '<div class="col-md-1 col-md-offset-1">' +
            '<button id="delRecordButton' + recordCount +'" class="form-control" value="delRecordButton' + recordCount + '" type="button" onclick="delRecord(this.id);">-</button>' +
          '</div>' +
      '<div class="col-md-3">' +
      '<input class="form-control" id="record' + recordCount +'" name="record' + recordCount + '" type="text" value="Berichtshefteintrag">' +
      '</div> ' +
      '<div class="col-md-1"> ' +
      '<input class="form-control" id="time' + recordCount +'" name="time' + recordCount + '" type="text" value="00:h 00:m">' +
      '</div> ' +
      '<div class="col-md-4">' +
      '<input class="form-control" id="comment' + recordCount + '" name="comment' + recordCount + '" type="text" value="Kommentare zum Eintrag">' +
      '</div>' +
      '</div>' +
      '</div>' +
      '<div id="end' + recordCount +'"></div>';
  }

  return recordCount++;
}


function delRecord(clicked_id){
  var id = document.getElementById(clicked_id).id;
  id = id.slice(15, 16);
    var record = document.getElementById('newRecordDiv' + id);
    record.parentNode.removeChild(record);


    return recordCount--;
}
