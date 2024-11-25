"use strict";
var datetimePickerOptions = {
  minView: 2,
  autoclose: true,
  format: 'yyyy-mm-dd',
};
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
});
$('#stock_is').on('change',function(){
    $('#price_section').hide();
    $('#room_section').hide();
    if($(this).val()=='add'){
      $('#price_section').show();
    } else if($(this).val()=='subtract'){
      $('#room_section').show();
    }
});
function printSlip(){
    window.print();
}

/* ***** ***** ***** ***** ***** start checkout page ***** ***** ***** ***** ***** */
if(globalVar.page=='checkout'){
 paymentInfo();  
  $('#check_in_date').datetimepicker(datetimePickerOptions);
  if(globalVar.userRole==3){
    $('#check_out_date').datetimepicker(datetimePickerOptions);
  } else {
    $('#check_out_date').datetimepicker(datetimePickerOptions);
  }

  $("#check_in_date").on("change",function(){
      globalVar.checkInDate = $(this).val();
      $("#check_out_date,#duration_of_stay").val('');
  });
  
  $("#check_out_date").on("change",function(){
      globalVar.checkOutDate = $(this).val();
      var endDate = moment(globalVar.checkOutDate, "YYYY.MM.DD");
      const diff = endDate.diff(globalVar.startDate, 'days');
      globalVar.durationOfStayDays = (diff>0) ? diff : 1;
      $('#duration_of_stay').val(globalVar.durationOfStayDays);

      //update durationOfStay for no_swapped room
      $('.no_swapped_room').each(function(i, selector){
        const dur = parseInt($(selector).text());
        $(selector).text(globalVar.durationOfStayDays);
      });

      paymentInfo();
  });
  
  $("#per_room_price").on("keyup click",function(){
      if($(this).val()>0) { globalVar.basePriceOneRoom = $(this).val(); } else { globalVar.basePriceOneRoom = 0; }
      paymentInfo();      
  });
  $("#duration_of_stay").on("keyup click",function(){
      if($(this).val()>0) { globalVar.durationOfStayDays = $(this).val(); } else { globalVar.durationOfStayDays = 0; }
      paymentInfo();      
  });
  
  $("#discount").on("keyup click",function(){
      $('.discount_room_err_msg').html('');
      if(globalVar.subTotalRoomAmount>0){
        if($(this).val()>0) { 
          globalVar.discount = $(this).val(); 
          if($('#room_discount_in').val() == 'perc'){
            globalVar.discount = (globalVar.discount/100)*globalVar.subTotalRoomAmount;
          }          
        } else { 
          globalVar.discount = 0; 
        }
        
        var maxDisc = getMaxDiscount(globalVar.subTotalRoomAmount); 
        if(globalVar.discount>maxDisc){
          globalVar.isError = true;
          $('.discount_room_err_msg').html('Allow only 100% of total amount');
        } else {
          globalVar.isError = false;
          paymentInfo(); 
        }
      } else {
        $(this).val(0);
      }     
  });
  $("#room_discount_in").on("change",function(){
    $("#discount").trigger('click');
  });

  $("#order_discount").on("keyup click",function(){
    $('.discount_order_err_msg').html('');
    if(globalVar.totalOrdersAmount>0){
      if($(this).val()>0) { 
        globalVar.foodOrderDiscount = $(this).val(); 
        if($('#order_discount_in').val() == 'perc'){
          globalVar.foodOrderDiscount = (globalVar.foodOrderDiscount/100)*globalVar.totalOrdersAmount;
        }
      } else { 
        globalVar.foodOrderDiscount = 0; 
      }
      
      var maxDisc = getMaxDiscount(globalVar.totalOrdersAmount); 
      if(globalVar.foodOrderDiscount>maxDisc){
        globalVar.isError = true;
        $('.discount_order_err_msg').html('Allow only 100% of total amount');
      } else {
        globalVar.isError = false;
        paymentInfo(); 
      }
    } else {
      $(this).val(0);
    }          
  });
  $("#order_discount_in").on("change",function(){
    $("#order_discount").trigger('click');
  });

  $("#apply_gst").on("click",function(){
      if($(this).prop("checked") == true){
          globalVar.applyFoodGst = 1;
      } else if($(this).prop("checked") == false){
          globalVar.applyFoodGst = 0;
      }
      $(this).val(globalVar.applyFoodGst);
      paymentInfo();      
  });
  $("#additional_amount").on("keyup click",function(){
      if($(this).val()>0) { 
        globalVar.additionalAmount = $(this).val();         
      } else { 
        globalVar.additionalAmount = 0; 
      }
      paymentInfo(); 
  });
  function paymentInfo(){
    if(globalVar.durationOfStayDays>=0) $('#td_dur_stay').html(globalVar.durationOfStayDays);
    
    //start room Amount Calculation
      var totalRoomAmount = 0;
      $('.per_room_tr').each(function(i, selector){
        const perRoomDur = $(selector).find('.duration_of_per_room').text();
        const perRoomPrice = $(selector).find('.per_room_price').val();
        const perRoomTotalAmount = parseFloat(perRoomPrice);
        totalRoomAmount = totalRoomAmount + perRoomTotalAmount;

        $(selector).find('.td_total_per_room_amount').html(currency_symbol+' '+parseFloat(perRoomTotalAmount).toFixed(2));
      });
      gstCalculation(totalRoomAmount,'room_gst');
      
      $('.td_total_room_amount').html(currency_symbol+' '+parseFloat(totalRoomAmount).toFixed(2));
      $('#total_room_amount').val(parseFloat(totalRoomAmount).toFixed(2));

      var finalRoomAmount = ( parseFloat(totalRoomAmount)+parseFloat(globalVar.gstRoomAmount)+parseFloat(globalVar.cgstRoomAmount)-parseFloat(globalVar.advanceAmount)-parseFloat(globalVar.discount) );
      $('#td_room_final_amount').html(currency_symbol+' '+parseFloat(finalRoomAmount).toFixed(2));
      $('#total_room_final_amount').val(parseFloat(finalRoomAmount).toFixed(2));

    //start foodOrders Amount Calculation
      gstCalculation(globalVar.totalOrdersAmount,'food_gst');
      
      var finalOrderAmount = ( parseFloat(globalVar.totalOrdersAmount)+parseFloat(globalVar.gstOrderAmount)+parseFloat(globalVar.cgstOrderAmount)-parseFloat(globalVar.foodOrderDiscount) );
      $('#td_order_final_amount').html(currency_symbol+' '+parseFloat(finalOrderAmount).toFixed(2));
      $('#total_order_final_amount').val(parseFloat(finalOrderAmount).toFixed(2));

    //start Final Amount Calculation
      var finalAmount = ( parseFloat(finalRoomAmount)+parseFloat(finalOrderAmount)+parseFloat(globalVar.additionalAmount) );
      $('#td_final_amount').html(currency_symbol+' '+parseFloat(finalAmount).toFixed(2) );
      $('#total_final_amount').val(parseFloat(finalAmount).toFixed(2));
  }

  $(document).on('click','.btn-submit-form',function(e){
    if( parseFloat($("#per_room_price").val() < parseFloat(globalVar.basePriceOneRoomOriginal) ) ){
        globalVar.isError = true;
        $('.base_price_err_msg').html('Base price must be greater than or equal to '+globalVar.basePriceOneRoomOriginal);
    }

    if(globalVar.isError){
      e.preventDefault();
    }
  });
}
/* ***** ***** ***** ***** ***** end checkout page ***** ***** ***** ***** ***** */

/* ***** ***** ***** ***** ***** start reservation page ***** ***** ***** ***** ***** */
if(globalVar.page=='room_reservation_add'){
  globalVar.checkInDate='';
  globalVar.checkOutDate='';
  globalVar.durationOfStayDays = 0;
  globalVar.basePriceOneRoom = 0;
  globalVar.room_nums = [];
  $(document).on('click','.add-new-row',function(){
    var html = $(".colne_persons_info_elem").html();
    $(".persons_info_parent").append(html);
  });
  $(document).on('click','.delete-row',function(){
    $(this).parents('.persons_info_elem').remove();
  });

  $('.guest_type').on('ifChanged',function(){
    $('#new_guest_section,#existing_guest_section').hide();
    var type = $(this).val();
    if(type=='new'){
      $('#new_guest_section').show();
    } else {
      $('#existing_guest_section').show();
    }
  });
  $(document).on('change', '#referred_by',function(){
      let val = 'OYO';
      if($(this).val()=='Self'){
         val = 'WALK-IN';
      }
      $('#referred_by_name').val(val);
  });

  $('#check_in_date').datetimepicker(datetimePickerOptions);
  $("#check_in_date").on("change",function(){
      globalVar.checkInDate = $(this).val();
      globalVar.checkOutDate = "";
      $("#check_out_date,#duration_of_stay").val('');
      $('#room_list_section').addClass('hide_elem');
  });
  $('#check_out_date').datetimepicker(datetimePickerOptions);
  $("#check_out_date").on("change",function(){
      if(!globalVar.checkInDate){
        $("#check_out_date").val('');
        swal({
          type: 'info',
          title: 'Oops...',
          text: 'Please select checkin date first',
        });
        return;
      }
      $('#room_list_section').removeClass('hide_elem');
      globalVar.checkOutDate = $(this).val();
      var startDate = moment(globalVar.checkInDate, "YYYY.MM.DD");
      var endDate = moment(globalVar.checkOutDate, "YYYY.MM.DD");
      globalVar.durationOfStayDays = endDate.diff(startDate, 'days');
      $('#duration_of_stay').val(globalVar.durationOfStayDays);
      paymentInfo();
  });


  $("#duration_of_stay").on("keyup click",function(){
       if($(this).val()>0) { 
        globalVar.durationOfStayDays = $(this).val();
      } else {
        globalVar.durationOfStayDays = 0;
      }
      paymentInfo();      
  });


  $(document).on('click','.room_type_by_rooms',function(e){
    globalVar.roomTypeSelector = $(this).parents('.panel-heading').siblings('.panel-collapse').find('.rooms_list');
    globalVar.roomTypeSelector.html('');
    $('#room_num').html('');
    const post_data={room_type_id:$(this).data('roomtypeid'), checkin_date: globalVar.checkInDate, checkout_date: globalVar.checkOutDate};
    globalFunc.ajaxCall('api/get-room-num-list', post_data, 'POST', globalFunc.before, globalFunc.listOfRooms, globalFunc.error, globalFunc.complete);
  });
  globalFunc.listOfRooms=function(data){
    var bookedRooms = data.booked_rooms;
    if(Object.keys(data.rooms).length>0){
        var k=1;
        $.each(data.rooms,function(index,val){
          var statusBtn = '<span class="btn btn-xs btn-success">Available</span>';
          var checkbox = '<input name="room_num[]" type="checkbox" data-roomid="'+index+'" value="'+val.room_type_id+'~'+val.id+'" class="room_checkbox">';
          if(bookedRooms[val.id]!=undefined){
            statusBtn = '<span class="btn btn-xs btn-cust">Booked</span>';
            checkbox = '<input name="room_num_booked[]" type="checkbox" value="'+val.room_type_id+'~'+val.id+'" disabled>';
          } 
          globalVar.roomTypeSelector.append('<tr>\
            <td width="5%">'+(k++)+'</td>\
            <td width="5%">'+checkbox+'</td>\
            <td>'+val.room_no+'</td>\
            <td>'+statusBtn+'</td>\
          </tr>');          
        });
    } else {
      addNoRoomTr();
    }
  }
  addNoRoomTr();
  function addNoRoomTr(){
    $('#rooms_list').append('<tr><td colspan="4"> No Rooms Found</td></tr>');
  }
  $(document).on('click','.room_checkbox',function(){
      let room_ids = [];
      globalVar.room_nums = [];
      $.each($(".room_checkbox:checked"), function(){
          globalVar.room_nums.push($(this).val());
          room_ids.push($(this).data('roomid'));
      });
      paymentInfo();

      let disabled = true;
      if(room_ids.length>0){
        disabled = false;
        const post_data={room_ids:room_ids};
        globalFunc.ajaxCall('api/get-room-details', post_data, 'POST', globalFunc.before, globalFunc.roomDetails, globalFunc.error, globalFunc.complete);
      } 
      $('.btn-submit-form').attr('disabled', disabled)
  });

  globalFunc.roomDetails=function(data){    
    globalVar.adultCapacity = 0;
    globalVar.kidsCapacity = 0;
    globalVar.basePrice = 0;
    if(data){
        $.each(data,function(index,val){
            globalVar.adultCapacity = globalVar.adultCapacity+parseInt(val.room_type.adult_capacity);
            globalVar.kidsCapacity = globalVar.kidsCapacity+parseInt(val.room_type.kids_capacity);
            globalVar.basePrice = globalVar.basePrice+parseInt(val.room_type.base_price);
            globalVar.basePriceOneRoom = parseInt(val.room_type.base_price);
        });
        paymentInfo();
    }
  }
  function paymentInfo(){
    return;
    if(globalVar.adultCapacity > 1){
      $("#adult").val(globalVar.adultCapacity);
    }
    if(globalVar.adultCapacity > 0){
      $("#kids").val(globalVar.kidsCapacity);
    }
  }
}
/* ***** ***** ***** ***** ***** end reservation page ***** ***** ***** ***** ***** */

/* ***** ***** ***** ***** ***** start foodorder final page ***** ***** ***** ***** ***** */
if(globalVar.page=='food_order_final'){
  globalVar.foodOrderDiscount = 0;
  globalVar.gstOrderAmount = 0;
  globalVar.cgstOrderAmount = 0;
  globalVar.applyFoodGst =1;
  globalVar.subtotalAmount = 0;
  globalVar.isError = false;

  calculateTotalAmount();
  $("#discount_amount").on("keyup click",function(){
      $('.discount_err_msg').html('');
      if(globalVar.subtotalAmount>0){
        if($(this).val()>0) { globalVar.foodOrderDiscount = $(this).val(); } else { globalVar.foodOrderDiscount = 0; }
        
        var maxDisc = getMaxDiscount(globalVar.subtotalAmount); 
        if(globalVar.foodOrderDiscount>maxDisc){
          globalVar.isError = true;
          $('.discount_err_msg').html('Allow only 100% of total amount');
        } else {
          globalVar.isError = false;
          calculateTotalAmount();  
        }
      } else {
        $(this).val(0);
      }
  });
  $("#apply_gst").on("click",function(){
        if($(this).prop("checked") == true){
            globalVar.applyFoodGst = 1;
        } else if($(this).prop("checked") == false){
            globalVar.applyFoodGst = 0;
        }
        calculateTotalAmount();      
  });
  $(document).on('click','.btn-submit-form',function(e){
    if(globalVar.isError){
      e.preventDefault();
    }
  })
  function calculateTotalAmount(){
      globalVar.subtotalAmount = 0;
      $.each($(".input-number"), function(){
          var calcAmount = parseInt($(this).val())*parseFloat($(this).data('price'));
          globalVar.subtotalAmount = globalVar.subtotalAmount + calcAmount;
      });
      gstCalculation(globalVar.subtotalAmount);
      var finalAmount = globalVar.subtotalAmount+parseFloat(globalVar.gstOrderAmount)+parseFloat(globalVar.cgstOrderAmount)-parseFloat(globalVar.foodOrderDiscount);

      $('#subtotal_amount').val(parseFloat(globalVar.subtotalAmount).toFixed(2));
      $('#final_amount').val(parseFloat(finalAmount).toFixed(2));

      $('#td_subtotal_amount').html(currency_symbol+' '+ parseFloat(globalVar.subtotalAmount).toFixed(2));
      $('#td_final_amount').html(currency_symbol+' '+ parseFloat(finalAmount).toFixed(2));
  }

  function gstCalculation(amount,type){
      if(globalVar.applyFoodGst==1){
        globalVar.gstOrderAmount = (globalVar.gstPercentFood/100)*parseFloat(amount).toFixed(2);
        globalVar.cgstOrderAmount = (globalVar.cgstPercentFood/100)*parseFloat(amount).toFixed(2);
      } else {
        globalVar.gstOrderAmount = '0.00';
        globalVar.cgstOrderAmount = '0.00';
      }
      $('#gst_amount').val(parseFloat(globalVar.gstOrderAmount).toFixed(2));
      $('#cgst_amount').val(parseFloat(globalVar.cgstOrderAmount).toFixed(2));

      $('#td_gst_amount').html(currency_symbol+' '+parseFloat(globalVar.gstOrderAmount).toFixed(2));
      $('#td_cgst_amount').html(currency_symbol+' '+parseFloat(globalVar.cgstOrderAmount).toFixed(2));
  }
}
/* ***** ***** ***** ***** ***** end foodorder final page ***** ***** ***** ***** ***** */

/* ***** ***** ***** ***** ***** start foodorder page ***** ***** ***** ***** ***** */
if(globalVar.page=='food_order_page'){
  globalVar.foodOrderDiscount = 0;
  globalVar.gstOrderAmount = 0;
  globalVar.cgstOrderAmount = 0;
  globalVar.applyFoodGst =0;
  //start table items seraching 
  $(document).ready(function(){
    $('#txt_searchall').keyup(function(){
      var search = $(this).val();
      $('.tr-items,.tr-bg').hide();
      var len = $('table tbody tr:not(.notfound) td:contains("'+search+'")').length;
      if(len > 0){
        $('table tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
          $(this).closest('tr').show();
        });
      }else{
        $('.notfound').show();
      }
    });
  });
  // Case-insensitive searching (Note - remove the below script for Case sensitive search )
  $.expr[":"].contains = $.expr.createPseudo(function(arg) {
     return function( elem ) {
       return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
     };
  });
  //end table items seraching 

  $(document).on('click','.btn-number',function(e){
      e.preventDefault();
      var fieldName = $(this).attr('data-field');
      var type      = $(this).attr('data-type');
      var input = $("input[name='"+fieldName+"']");
      var currentVal = parseInt(input.val());
      currentVal = isNaN(currentVal) ? 0 : currentVal;
      if (!isNaN(currentVal)) {
          if(type == 'minus') {
              
              if(currentVal > input.attr('min')) {
                  input.val(currentVal - 1).change();
              } 
              if(parseInt(input.val()) == input.attr('min')) {
                  $(this).attr('disabled', true);
              }

          } else if(type == 'plus') {
   
              if(currentVal < input.attr('max')) {
                  input.val(currentVal + 1).change();
              }
              if(parseInt(input.val()) == input.attr('max')) {
                  $(this).attr('disabled', true);
              }
          }
      } else {
          input.val(0);
      }
      calculateTotalAmount();
  });
  $('.input-number').focusin(function(){
     $(this).data('oldValue', $(this).val());
     calculateTotalAmount();
  });
  $('.input-number').change(function() {
      var minValue =  parseInt($(this).attr('min'));
      var maxValue =  parseInt($(this).attr('max'));
      var valueCurrent = parseInt($(this).val());
      
      name = $(this).attr('name');
      if(valueCurrent >= minValue) {
          $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
      } else {
          alert('Sorry, the minimum value was reached');
          $(this).val($(this).data('oldValue'));
      }
      if(valueCurrent <= maxValue) {
          $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
      } else {
          alert('Sorry, the maximum value was reached');
          $(this).val($(this).data('oldValue'));
      }
      calculateTotalAmount();    
  });
  $(".input-number").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) || 
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
    calculateTotalAmount();
  });
  $("#discount_amount").on("keyup click",function(){
      if($(this).val()>0) { globalVar.foodOrderDiscount = $(this).val(); } else { globalVar.foodOrderDiscount = 0; }
      calculateTotalAmount();      
  });
  $("#apply_gst").on("click",function(){
        if($(this).prop("checked") == true){
            globalVar.applyFoodGst = 1;
        } else if($(this).prop("checked") == false){
            globalVar.applyFoodGst = 0;
        }
        calculateTotalAmount();      
  });

  function calculateTotalAmount(){
      var subtotalAmount = 0;
      $.each($(".input-number"), function(){
          var calcAmount = parseInt($(this).val())*parseFloat($(this).data('price'));
          subtotalAmount = subtotalAmount + calcAmount;
      });
      gstCalculation(subtotalAmount);
      var finalAmount = subtotalAmount+parseFloat(globalVar.gstOrderAmount)+parseFloat(globalVar.cgstOrderAmount)-parseFloat(globalVar.foodOrderDiscount);

      $('#subtotal_amount').val(parseFloat(subtotalAmount).toFixed(2));
      $('#final_amount').val(parseFloat(finalAmount).toFixed(2));

      $('#td_subtotal_amount').html(currency_symbol+' '+ parseFloat(subtotalAmount).toFixed(2));
      $('#td_final_amount').html(currency_symbol+' '+ parseFloat(finalAmount).toFixed(2));
  }

  function gstCalculation(amount,type){
      if(globalVar.applyFoodGst==1){
        globalVar.gstOrderAmount = (globalVar.gstPercentFood/100)*parseFloat(amount).toFixed(2);
        globalVar.cgstOrderAmount = (globalVar.cgstPercentFood/100)*parseFloat(amount).toFixed(2);
      } else {
        globalVar.gstOrderAmount = '0.00';
        globalVar.cgstOrderAmount = '0.00';
      }
      $('#gst_amount').val(parseFloat(globalVar.gstOrderAmount).toFixed(2));
      $('#cgst_amount').val(parseFloat(globalVar.cgstOrderAmount).toFixed(2));

      $('#td_gst_amount').html(currency_symbol+' '+parseFloat(globalVar.gstOrderAmount).toFixed(2));
      $('#td_cgst_amount').html(currency_symbol+' '+parseFloat(globalVar.cgstOrderAmount).toFixed(2));
  }
}
/* ***** ***** ***** ***** ***** end foodorder page ***** ***** ***** ***** ***** */

/* ***** ***** ***** ***** ***** start dynamic dropdown page ***** ***** ***** ***** ***** */
if(globalVar.page=='list_dynamic_dropdowns'){
  $(document).on('click', '.delete-dropdown', function(event) {
    $(this).parents('tr').remove();
  });
  $(document).on('click', '.add-dropdown', function(event) {
    const elemName = $(this).data('tbody');
    $('.'+elemName).append('<tr>\
      <td><input type="text" name="'+elemName+'[]" class="form-control col-md-7 col-xs-12" required="required" placeholder="Enter Value"></td>\
      <td class="text-center">\
        <button type="button" class="btn btn-danger delete-dropdown"><i class="fa fa-minus"></i></button>\
      </td>\
      </tr>');
  });
}
/* ***** ***** ***** ***** ***** end dynamic dropdown page ***** ***** ***** ***** ***** */

/* ***** ***** ***** ***** ***** start dashboard page ***** ***** ***** ***** ***** */
if(globalVar.page=='dashboard_page'){
    globalVar.calendar = null;
    globalVar.calendarEl = null;
    globalVar.currDate = new Date();
    globalVar.cdate = new Date();
    function getDatesObj(){
      if(globalVar.calendar){
        globalVar.cdate = globalVar.calendar.getDate();
      }
      return { month: globalVar.cdate.getMonth()+1, year: globalVar.cdate.getFullYear() }
    }
    function getCalendarEvents(){
        const dateObj = getDatesObj();
        const post_data={month: dateObj.month, year: dateObj.year};
        globalFunc.ajaxCall('api/get-calendar-events', post_data, 'POST', globalFunc.before, globalFunc.successEvents, globalFunc.error, globalFunc.complete);
    }
    globalFunc.successEvents=function(data){
      if(globalVar.calendarEl){
          globalVar.calendar = new FullCalendar.Calendar(globalVar.calendarEl, {
            timeZone: globalVar.timezone,
            locale: globalVar.locale,
            initialDate: globalVar.cdate,
            editable: false,
            selectable: true,
            businessHours: false,
            displayEventTime : false,
            dayMaxEvents: true,
            aspectRatio: 1.50,
            headerToolbar: {
              left: 'dayGridMonth',
              center: 'title',
              right: 'prev next',
            },
            events: data.events,
            eventClick: function(info) {
              console.log('Event: ', info.event, 'Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY, 'View: ' + info.view.type);
            }
          });
          globalVar.calendar.render();
          
      }
    }
    $(document).ready(function(){
      globalVar.calendarEl = document.getElementById('calendar');
      getCalendarEvents('current');
    });
    $(document).on('click', '.fc-prev-button', function() {
      const m1 = globalVar.currDate.getMonth()+1;
      const m2 = globalVar.cdate.getMonth()+1;
      getCalendarEvents('prev');
    });
    $(document).on('click', '.fc-next-button', function() {
      getCalendarEvents('next');
    });
}
/* ***** ***** ***** ***** ***** end dashboard page ***** ***** ***** ***** ***** */

/* ***** ***** ***** ***** ***** start websitePages page ***** ***** ***** ***** ***** */
if(globalVar.page=='website_home_page'){
  if(globalVar.testimonialCount==0){
     cloneElements('testimonila')
  }
  if(globalVar.counterCount==0){
     cloneElements('counter')
  }
  if(globalVar.featuresCount==0){
     cloneElements('features')
  }
  $('.add-banner-img-elem').click(function(){
    cloneElements('banner_image');
  });
  $(document).on('click','.delete-banner-img-elem',function(){
    $(this).parents('.banner-img-child').remove();
  });

  $('.add-new-row').click(function(){
    cloneElements('features');
  });
  $(document).on('click','.delete-row',function(){
    $(this).parents('.features-row').remove();
  });

  $('.add-new-row-counter').click(function(){
    cloneElements('counter');
  });
  $(document).on('click','.delete-row-counter',function(){
    $(this).parents('.counter-sect-row').remove();
  });

  $('.add-new-row-cta').click(function(){
    cloneElements('cta');
  });
  $(document).on('click','.delete-row-cta',function(){
    $(this).parents('.cta-sect-row').remove();
  });

  $('.add-new-row-testimonial').click(function(){
    cloneElements('testimonila');
  });
  $(document).on('click','.delete-row-testimonial',function(){
    $(this).parents('.testimonial-sect-row').remove();
  });

  $(document).on('click','.rmvBanner', function(){
    var dataId = $(this).data('id');
    $('#'+dataId).attr('checked',true);
    $(this).parents('tr').remove();
  });
}
if(globalVar.page=='website_about_page'){
    if(globalVar.featuresCount==0){
       cloneElements('features')
    }
    $('.add-new-row').click(function(){
      cloneElements('features');
    });
    $(document).on('click','.delete-row',function(){
      $(this).parents('.features-row').remove();
    });

    $('.add-new-row-ourteam').click(function(){
      cloneElements('ourteam');
    });
    $(document).on('click','.delete-row-ourteam',function(){
      $(this).parents('.testimonial-sect-row').remove();
    });
}
function cloneElements(section){
  if(section == 'banner_image'){
    var html = $(".clone_banner_image_elem").html();
    $(".banner-img-parent").append(html);
  } else if(section == 'testimonila'){
    var html = $(".clone_testimonial_elem").html();
    $(".testimonial-sect-elem").append(html);
  } else if(section == 'features'){
    var html = $(".clone_features_elem").html();
    $(".features-elem").append(html);
  } else if(section == 'counter'){
    var html = $(".clone_counter_elem").html();
    $(".counter-sect-elem").append(html);
  } else if(section == 'cta'){
    var html = $(".clone_cta_elem").html();
    $(".cta-sect-elem").append(html);
  } else if(section == 'ourteam'){
    var html = $(".clone_ourteam_elem").html();
    $(".testimonial-sect-elem").append(html);
  }
}
/* ***** ***** ***** ***** ***** end websitePages page ***** ***** ***** ***** ***** */

/* ***** ***** ***** ***** ***** start housekeeping add/edit page ***** ***** ***** ***** ***** */
if(globalVar.page=='housekeeping_order_add_edit'){
  console.log('---',globalVar.selectedHousekeepingItems.split(','));
  if($("#housekeeping_items")[0] != undefined){
    const items = globalVar.selectedHousekeepingItems.split(',');
    $('#housekeeping_items').val(items);
  }
}
/* ***** ***** ***** ***** ***** start housekeeping add/edit page ***** ***** ***** ***** ***** */

/* ***** ***** ***** ***** ***** start laundary page ***** ***** ***** ***** ***** */
if(globalVar.page=='laundry_order_add_edit'){
  laundryPaymentInfo();

  $(document).on('click','.add-row',function(){
    var html = $(".colne_laundry_item_elem").html();
    $(".laundry_item_parent").append(html);
  });
  $(document).on('click','.delete-row',function(){
    $(this).parents('.laundry_item_elem').remove();
  });
  $('.guest_type').on('ifChanged',function(){
    $('#new_guest_section,#existing_guest_section').hide();
    var type = $(this).val();
    if(type=='new'){
      $('#new_guest_section').show();
    } else {
      $('#existing_guest_section').show();
    }
  });

  $("#apply_gst").on("click",function(){
      if($(this).prop("checked") == true){
          globalVar.applyGst = 1;
      } else if($(this).prop("checked") == false){
          globalVar.applyGst = 0;
      }
      $(this).val(globalVar.applyGst);
      laundryPaymentInfo();      
  });

  $(document).on("keyup click", ".per_item_price", function(){
      laundryPaymentInfo();      
  });
  $(document).on("keyup click", ".per_item_rcv_qty", function(){
      laundryPaymentInfo();      
  });
  $("#laundry_discount_in").on("change",function(){
    $("#discount").trigger('click');
  });
  $("#discount").on("keyup click",function(){
      $('.discount_err_msg').html('');
      if(globalVar.laundrySubtotalAmount>0){
        if($(this).val()>0) { 
          globalVar.discount = $(this).val(); 
          if($('#laundry_discount_in').val() == 'perc'){
            globalVar.discount = getPercentOfAmount(globalVar.discount, globalVar.laundrySubtotalAmount);
          }          
        } else { 
          globalVar.discount = 0; 
        }
        
        var maxDisc = getMaxDiscount(globalVar.laundrySubtotalAmount); 
        if(globalVar.discount>maxDisc){
          globalVar.isError = true;
          $('.discount_err_msg').html('Allow only 100% of total amount');
        } else {
          globalVar.isError = false;
          laundryPaymentInfo(); 
        }
      } else {
        $(this).val(0);
      }     
  });

  function laundryPaymentInfo(){
      let subtotalAmount = 0;
      $('.per_item_elem').each(function(i, selector){
        let perItemRcvQty = parseInt($(selector).find('.per_item_rcv_qty').val());
        perItemRcvQty = (perItemRcvQty > 0) ? perItemRcvQty : 0;

        let perItemPrice = parseFloat($(selector).find('.per_item_price').val());
        perItemPrice = (perItemPrice > 0) ? perItemPrice : 0;

        subtotalAmount += parseFloat(perItemRcvQty*perItemPrice);
      });
      globalVar.laundrySubtotalAmount = subtotalAmount;
      gstCalculation(subtotalAmount,'laundry_gst');
      
      $('#td_subtotal').html(getAmountWithCurrency(subtotalAmount));
      $('#subtotal').val(parseFloat(subtotalAmount).toFixed(2));

      const totalAmount = ( parseFloat(subtotalAmount)+parseFloat(globalVar.gstAmount)+parseFloat(globalVar.cgstAmount)-parseFloat(globalVar.discount) );
      $('#td_total_amount').html(getAmountWithCurrency(totalAmount));
      $('#total_amount').val(parseFloat(totalAmount).toFixed(2));
  }
}
/* ***** ***** ***** ***** ***** end laundary page ***** ***** ***** ***** ***** */

function gstCalculation(amount,type){
    if(type=='room_gst'){
      globalVar.gstRoomAmount = getPercentOfAmount(globalVar.gstPercent, amount);
      globalVar.cgstRoomAmount = getPercentOfAmount(globalVar.cgstPercent, amount);
      
      $('#total_room_amount_gst').val(globalVar.gstRoomAmount);
      $('#total_room_amount_cgst').val(globalVar.cgstRoomAmount);

      $('#td_total_room_amount_gst').html(getAmountWithCurrency(globalVar.gstRoomAmount));
      $('#td_total_room_amount_cgst').html(getAmountWithCurrency(globalVar.cgstRoomAmount));
    } 
    else if(type=='laundry_gst'){
      if(globalVar.applyGst==1){
        globalVar.gstAmount = getPercentOfAmount(globalVar.gstPercent, amount);
        globalVar.cgstAmount = getPercentOfAmount(globalVar.cgstPercent, amount);
      } else {
        globalVar.gstAmount = '0.00';
        globalVar.cgstAmount = '0.00';
      }
      
      $('#total_gst_amount').val(globalVar.gstAmount);
      $('#total_cgst_amount').val(globalVar.cgstAmount);

      $('#td_total_gst_amount').html(getAmountWithCurrency(globalVar.gstAmount));
      $('#td_total_cgst_amount').html(getAmountWithCurrency(globalVar.cgstAmount));
    } 
    else{
      if(globalVar.applyFoodGst==1){
        globalVar.gstOrderAmount = getPercentOfAmount(globalVar.gstPercentFood, amount);
        globalVar.cgstOrderAmount = getPercentOfAmount(globalVar.cgstPercentFood, amount);
      } else {
        globalVar.gstOrderAmount = '0.00';
        globalVar.cgstOrderAmount = '0.00';
      }
      $('#total_order_amount_gst').val(parseFloat(globalVar.gstOrderAmount).toFixed(2));
      $('#total_order_amount_cgst').val(parseFloat(globalVar.cgstOrderAmount).toFixed(2));

      $('#td_order_amount_gst').html(getAmountWithCurrency(globalVar.gstOrderAmount));
      $('#td_order_amount_cgst').html(getAmountWithCurrency(globalVar.cgstOrderAmount));
    }
    return;    
  }

  function getPercentOfAmount(perc, amount){
    return (perc/100)*parseFloat(amount).toFixed(2);
  }
  function getAmountWithCurrency(amount){
    return currency_symbol+' '+parseFloat(amount).toFixed(2);
  } 