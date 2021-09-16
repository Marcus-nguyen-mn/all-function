
jQuery(document).ready(function(){
  var calendarEl = document.getElementById('calendar');
  if(document.querySelector("#calendar")){
    var userIdCurrent = document.querySelector("#calendar").getAttribute("data-user");
  jQuery.ajax({
    type : "POST",
    dataType : "json",
    url : 'https://localhost/diva-home/wp-admin/admin-ajax.php', 
    data : {
        action: "get_data_date", 
        userIdCurrent : userIdCurrent
    },
    success: function(response) {
        if(response) {
          console.log(response);
          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 650,
            events: response,
            dateClick: function(info) {
              date = new Date(calendar.getDate().toISOString());
              year = date.getFullYear();
              month = date.getMonth()+1;
              dt = date.getDate();
              if (dt < 10) {
                dt = '0' + dt;
              }
              if (month < 10) {
                month = '0' + month;
              }
              var dateDDCurrent = year+'-' + month + '-'+dt;
              if(dateDDCurrent > info.dateStr){
                alert("Không thể điểm danh ngày cũ");
              }
              else if(dateDDCurrent < info.dateStr){
                alert("Không thể điểm danh trước");
              }
              else if(dateDDCurrent == info.dateStr){
                var userIdSS = document.querySelector("#calendar").getAttribute("data-user");
                  jQuery.ajax({
                    type : "POST",
                    dataType : "json",
                    url : 'https://localhost/diva-home/wp-admin/admin-ajax.php',
                    data : {
                        action: "ss_data_date", 
                        start1 : info.dateStr,
                        userIdSS : userIdSS
                    },
                    success: function(response) {
                      console.log(response.result);
                        if(response.result == "false") {
                          var node = document.createElement("p");
                          var textnode = document.createTextNode("Đã điểm danh");
                          node.appendChild(textnode);
                          info.dayEl.appendChild(node);
                          var userId = document.querySelector("#calendar").getAttribute("data-user");
                          jQuery.ajax({
                              type : "POST",
                              dataType : "json",
                              url : 'https://localhost/diva-home/wp-admin/admin-ajax.php',
                              data : {
                                  action: "save_data_date", 
                                  title : 'Đã điểm danh',
                                  start : info.dateStr,
                                  userId : userId
                              },
                              success: function(response1) {
                                  if(response1) {
                                    // console.log(response1);
                                  }
                                  else {
                                      alert('Đã có lỗi xảy ra');
                                  }
                              },
                              error: function( jqXHR, textStatus, errorThrown ){
                                  console.log( 'The following error occured: ' + textStatus, errorThrown );
                              }
                          });
                        }
                        else if(response.result == "true") {
                          alert('Bạn đã điểm danh');
                        }
                    },
                    error: function( jqXHR, textStatus, errorThrown ){
                        console.log( 'The following error occured: ' + textStatus, errorThrown );
                    }
                });
              }
            },
          });
          calendar.render();
        }
        else {
            alert('Đã có lỗi xảy ra');
        }
    },
    error: function( jqXHR, textStatus, errorThrown ){
        console.log( 'The following error occured: ' + textStatus, errorThrown );
    }
  });
  }
  if(document.getElementById('calenderAdmin')){
    var calendarElAdmin = document.getElementById('calenderAdmin');
    var userIdCurrentAdmin = calendarElAdmin.getAttribute("data-usi");
    jQuery.ajax({
      type : "POST",
      dataType : "json",
      url : 'https://localhost/diva-home/wp-admin/admin-ajax.php', 
      data : {
          action: "get_data_date_admin", 
          userIdCurrentAdmin : userIdCurrentAdmin
      },
      success: function(response) {
          if(response) {
            var calendarAd = new FullCalendar.Calendar(calendarElAdmin, {
              initialView: 'dayGridMonth',
              events: response,
            });
            calendarAd.render();
          }
          else {
              alert('Đã có lỗi xảy ra');
          }
      },
      error: function( jqXHR, textStatus, errorThrown ){
          console.log( 'The following error occured: ' + textStatus, errorThrown );
      }
    });
  }
})