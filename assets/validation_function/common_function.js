var url = window.location.href;
var projet_path = url.split('/');
var url_path = window.location.origin + '/' + projet_path[3];
/* $(document).ready(function(){
 alert(url_path);
}); */

$(".error_msg").css('color', 'red');



$(document).ready(function () {
  // Basic
  $('.dropify').dropify();

  // Translated

});


var list_of_users = $('#list_of_users').DataTable({
  "processing": true,
  "serverSide": true,
  "order": [],
  "ajax": {
    url: url_path + '/table_list_of_users',
    type: "POST",
    data: function(data){
      // data.type_book = $("#segment_2").val();
    },
  },
  drawCallback: function (settings) {
    $('[data-toggle="tooltip"]').tooltip();
  },
  "columnDefs": [
    {
      "targets": [0, 6],
      "orderable": false,
    },
  ],
});


$("#book_search").keyup(function () {
  // alert('book_search')
  var input_val = $("#book_search").val();

  $.ajax({
    url: url_path + '/book_search_data',
    type: 'post',
    data: "input_val=" + input_val,
    success: function (response) {
      var data = jQuery.parseJSON(response);
      
      $("#main_book_display_div").empty();
      $("#main_book_display_div").append(data);
      
      

    }
  });
});




$(document).on('click', '.delete_data', function () {
  var split_id = this.id.split('->');
  var id = split_id[0];
  var table_name = split_id[1];
  var delete_status = split_id[2];
  var load_table = split_id[3];
  var column_pid = split_id[4];
  var disp_msg = '';
  if (load_table == "categorylist") {
    disp_msg = 'Category';
  }
  else if (load_table == "callforidealist") {
    disp_msg = 'Call For Idea';
  }
  else if (load_table == "submitidealist") {
    disp_msg = 'Submit Idea';
  }
  swal({
    title: "Are you sure?",
    text: "Do you want to remove this " + disp_msg + "?",
    type: "warning",
    showCancelButton: !0,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, Delete it!",
    cancelButtonText: "No, cancel Please!",
    closeOnConfirm: !1,
    closeOnCancel: !1,
    confirmButtonColor: "#f60e0e"
  }, function (isConfirm) {
    if (isConfirm) {
      $.ajax({
        url: url_path + '/common_delete',
        type: 'post',
        data: "id=" + id + "&table_name=" + table_name + "&delete_status=" + delete_status + "&column_pid=" + column_pid,
        success: function (response) {
          if (response == 1) {
            swal({
              title: "Deleted!",
              text: disp_msg + " deleted Successfully!",
              // text: "Record Deleted Successfully!",
              type: "success",
              confirmButtonColor: "#304ffe"
            }, function (isConfirm) {
              if (isConfirm) {
                Lobibox.notify('success', {
                  pauseDelayOnHover: true,
                  size: 'mini',
                  rounded: true,
                  icon: 'bx bx-check-circle',
                  delayIndicator: false,
                  continueDelayOnInactiveTab: false,
                  position: 'top right',
                  msg: disp_msg + ' deleted successfully!'

                });

                if (load_table == "list_of_users") {
                  list_of_users.ajax.reload();
                }
               
              }
            });
          }
        }
      });
    } else {
      swal({
        title: "Cancelled",
        text: "Your file is safe :)",
        type: "error",
        confirmButtonColor: "#f60e0e"
      });
    }
  });
});




$("#book_search_api").keyup(function () {
  // alert('book_search')
  // alert(54);
  var input_val = $("#book_search_api").val();

  $.ajax({
    url: 'https://www.googleapis.com/User App/v1/volumes?q=search+'+input_val,
    type: 'GET',
    // data: "input_val=" + input_val,
    success: function (response) {
    var data_test =   response.items;
    // console.log(response)

    var i = 0;
    var note_list ='';
    var start_rack = '<div class="User Apphelf">  <div class="covers">';

        data_test.forEach((index, array) => {
            
            console.log(index.volumeInfo);
            var book_data = index.volumeInfo;
        

            if(i % 3 == 0 && i != 0)
            {
                console.log("ani")
                start_rack = '</div> </div> <br>  <br><br><br><br>  <div class="User Apphelf">   <div class="covers">';
            }
            // var book_link = book_data.previewLink;
            note_list += start_rack ;
            note_list += '<div class="thumb book-1"><a> <img src="'+book_data.imageLinks.thumbnail+'"> </a> <label>Publisher : '+book_data.publisher +'<br>Title : '+ book_data.title+'<br></label> </div>';
                                
           start_rack = '';
            i++; 
            
        });

       note_list += '</div> </div> ';

       console.log(note_list)
    
      // var data = jQuery.parseJSON(response);
      
      $("#main_book_display_div_api_result").empty();
      $("#main_book_display_div_api_result").append(note_list);
      
      

    }
  });
});