/**
 * Created by exinit on 19.06.2017.
 */

var recordCount = 0;


function doNothing(){
  alert('Do Nothing');
  if(recordCount==0){
    document.getElementById('addRecordButton').setAttribute('onclick', 'addRecord()');
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
            '<input class="form-control" id="record' + recordCount +'" type="text" value="Berichtshefteintrag">' +
          '</div> ' +
          '<div class="col-md-1"> ' +
            '<input class="form-control" id="time' + recordCount +'" type="text" value="00:h 00:m">' +
          '</div> ' +
          '<div class="col-md-4">' +
            '<input class="form-control" id="comment' + recordCount + '" type="text" value="Kommentare zum Eintrag">' +
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
      '<input class="form-control" id="record' + recordCount +'" type="text" value="Berichtshefteintrag">' +
      '</div> ' +
      '<div class="col-md-1"> ' +
      '<input class="form-control" id="time' + recordCount +'" type="text" value="00:h 00:m">' +
      '</div> ' +
      '<div class="col-md-4">' +
      '<input class="form-control" id="comment' + recordCount + '" type="text" value="Kommentare zum Eintrag">' +
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
