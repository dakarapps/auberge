"use strict";

$(document).ready(function() {
    initDatePicker();
    getSetUrlParams('search-rooms');

    if(globalVar.page === 'front_home'){
        let loadBanners = 0;
        const items = globalVar.banners;
        if(items.length > 0){
            setInterval(function(){ 
                loadBanners = loadBanners+1;
                const item = items[loadBanners-1];
                const imageUrl = base_url+'public/uploads/banners/'+item;
                $(".home-banner").css("background-image", "url(" + imageUrl + ")");
                if(loadBanners === items.length){
                    loadBanners = 0;
                }
            }, 5000);
        }
    }
    
});
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
if($(".summernote")[0] != undefined){
    $('.summernote').summernote({
     height: 250
    });
}
if($("#housekeeping_items")[0] != undefined){
    $('#housekeeping_items').select2({
      placeholder: '',
      allowClear: true
    });
}
$('.eye_icon').click(function(){
    const id = $(this).data('id');
    if('password' == $('#'+id).attr('type')){
         $('#'+id).prop('type', 'text');
         $(this).removeClass('fa-eye').addClass('fa-eye-slash');
    }else{
         $('#'+id).prop('type', 'password');
         $(this).removeClass('fa-eye-slash').addClass('fa-eye');
    }
});
if($('#customers')[0] != undefined){
    var selectize = $('#customers').selectize({
          plugins: ['remove_button'],
          maxItems: 1,
          valueField: 'id',
          labelField: 'display_text',
          searchField: 'display_text',
          create: false, 
          options: globalVar.customerList,   
    });
}
        
/* ***** start form validations ***** */
    if($("#database-form")[0] != undefined){
        $("#database-form").validate({
            rules: {
                "host": { required: true },
                "database": { required: true },
                "username": { required: true },
                "password": { required: true },
            }
        });
    }
    if($("#siteconfig-form")[0] != undefined){
        $("#siteconfig-form").validate({
            rules: {
                "site_page_title": { required: true },
                "site_language": { required: true },
                "hotel_name": { required: true },
                "name": { required: true, maxlength: 10 },
                "username": { required: true, email: true },
                "password": { required: true, minlength: 6, maxlength: 12 },
            }
        });
    }
    if($("#room-type-form")[0] != undefined){
        $("#room-type-form").validate({
            rules: {
                "title": { required: true },
                "short_code": { required: true },
                "adult_capacity": { required: true, minlength: 1, maxlength: 2, digits: true },
                "kids_capacity": { required: true, minlength: 1, maxlength: 2 },
                "base_price": { required: true, number: true },
                "amenities_ids[]": { required: true },
            }
        });
    }
    if($("#add-amenities-form")[0] != undefined){
        $("#add-amenities-form").validate({
            rules: {
                "name": { required: true },
            }
        });
    }
    if($("#room-form")[0] != undefined){
        $("#room-form").validate({
            rules: {
                "room_no": { required: true, minlength: 1, maxlength: 8 },
                "room_name": { required: true },
                "floor": { required: true },
                "room_type_id": { required: true },
                "description": { required: true, minlength: 50, maxlength: 500 },
            }
        });
    }
    if($("#add-user-form")[0] != undefined){
        $("#add-user-form").validate({
            rules: {
                "role_id": { required: true },
                "name": { required: true },
                "email": { required: true, email: true },
                "mobile": { required: true, minlength: 10, maxlength:10, digits:true, },
                "gender": { required: true },
                "address": { required: true },
                "new_password": { required: true, minlength: 6 },
                "conf_password": { required: true, minlength: 6, equalTo: "#password" },
                "status": { required: true },

            }
        });
    }
    if($("#edit-user-form")[0] != undefined){
        $("#edit-user-form").validate({
            rules: {
                "role_id": { required: true },
                "name": { required: true },
                "email": { required: true, email: true },
                "mobile": { required: true, minlength: 10, maxlength:10, digits:true, },
                "gender": { required: true },
                "address": { required: true },
                "status": { required: true },
            }
        });
    }
    if($("#profile-update-form")[0] != undefined){
        $("#profile-update-form").validate({
            rules: {
                "name": { required: true },
                "email": { required: true, email: true },
                "mobile": { required: true, minlength: 10, maxlength:10, digits:true, },
                "gender": { required: true },

            }
        });
    }
    if($("#password-update-form")[0] != undefined){
        $("#password-update-form").validate({
            rules: {
                "new_password": { required: true, minlength: 6 },
                "conf_password": { required: true, minlength: 6, equalTo: "#password" },
            }
        });
    }
    if($("#food-category-form")[0] != undefined){
        $("#food-category-form").validate({
            rules: {
                "name": { required: true },
                "status": { required: true },
            }
        });
    }
    if($("#food-item-form")[0] != undefined){
        $("#food-item-form").validate({
            rules: {
                "name": { required: true },
                "status": { required: true },
                "category_id": { required: true },
                "price": { required: true, number: true },
            }
        });
    }
    if($("#expense-category-form")[0] != undefined){
        $("#expense-category-form").validate({
            rules: {
                "name": { required: true },
                "status": { required: true },
            }
        });
    }
    if($("#expense-form")[0] != undefined){
        $("#expense-form").validate({
            rules: {
                "title": { required: true },
                "datetime": { required: true },
                "category_id": { required: true },
                "amount": { required: true, number: true },
            }
        });
    }
    if($("#add-product-form")[0] != undefined){
        $("#add-product-form").validate({
            rules: {
                "name": { required: true },
                "status": { required: true },
                "stock_qty": { required: true },
                "measurement": { required: true },
            }
        });
    }
    if($("#update-product-form")[0] != undefined){
        $("#update-product-form").validate({
            rules: {
                "name": { required: true },
                "status": { required: true },
            }
        });
    }
    if($("#amenities-form")[0] != undefined){
        $("#amenities-form").validate({
            rules: {
                "name": { required: true },
                "status": { required: true },
            }
        });
    }
    if($("#stock-form")[0] != undefined){
        $("#stock-form").validate({
            rules: {
                "product_id": { required: true },
                "stock_is": { required: true },
                "stock_date": { required: true },
                "qty": { required: true },
                //"price": { required: true },
            }
        });
    }
    if($("#add-reservation-form")[0] != undefined){
        $("#add-reservation-form").validate({
            rules: {
                "guest_type": { required: true },
                "selected_customer_id": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('existing');
                        }
                    },
                },
                "name": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('new');
                        }
                    },
                },
                "father_name": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('new');
                        }
                    },
                },
                "mobile": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('new');
                        }
                    },
                    minlength: 7, maxlength:15, digits:true,
                },
                "email": { 
                    required: false,
                    email: true,
                },
                "address": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('new');
                        }
                    },
                },
                "country_": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('new');
                        }
                    },
                },
                "state_": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('new');
                        }
                    },
                },
                "city_": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('new');
                        }
                    },
                },
                "gender": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('new');
                        }
                    },
                },
                "age_": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('new');
                        }
                    },
                },
                "check_in_date": { 
                    required: true,
                },
                "duration_of_stay": { 
                    required: true,
                    digit: true,
                },
                "room_type_id": { 
                    required: true,
                },
                "room_num[]": { 
                    required: true,
                },
                "adult": { 
                    required: true,
                },
                "kids": { 
                   // required: true,
                },
                "reason_visit_stay": { 
                    required: false,
                },
                "idcard_type": { 
                    required: true,
                },
                "idcard_no": { 
                    required: true,
                },
            }
        });
    }
    if($("#customer-form")[0] != undefined){
        $("#customer-form").validate({
            rules: {
                "name": { required: true },
                "father_name": { required: true },
                "mobile": { required: true, minlength: 10, maxlength:10, digits:true },
                "email": { required: true, email: true },
                "address": { required: true },
                "country": { required: true },
                "state": { required: false },
                "city": { required: false },
                "gender": { required: true },
                "age": { required: false },
            }
        });
    }
    if($("#swap-room-form")[0] != undefined){
        $("#swap-room-form").validate({
            rules: {
                "new_room": { required: true },
                "old_room": { required: true },
            }
        });
    }
    if($("#signup-form")[0] != undefined){
        $("#signup-form").validate({
            rules: {
                "firstname": { required: true },
                "lastname": { required: true },
                "email": { required: true, email: true },
                "mobile": { required: true, minlength: 6, maxlength:10, digits:true, },
                "gender": { required: true },
                "userCountry": { required: true },
                "state": { required: false },
                "city": { required: false },
                "address": { required: true },
                "password": { required: true, minlength: 6 },
                "confirm_password": { required: true, minlength: 6, equalTo: "#password" },
            }
        });
    }
    if($("#update-password-form")[0] != undefined){
        $("#update-password-form").validate({
            rules: {
                "old_password": { required: true, minlength: 6 },
                "new_password": { required: true, minlength: 6 },
                "conf_password": { required: true, minlength: 6, equalTo: "#password" },
            }
        });
    }
    if($("#vendor-category-form")[0] != undefined){
        $("#vendor-category-form").validate({
            rules: {
                "name": { required: true },
                "status": { required: true },
            }
        });
    }
    if($("#vendor-form")[0] != undefined){
        $("#vendor-form").validate({
            rules: {
                "category_id": { required: true },
                "vendor_name": { required: true },
                "vendor_country": { required: true },
                "vendor_email": { email: true },
                "vendor_mobile": { minlength: 6, maxlength: 12, digits: true },
                "contact_person_name": { required: true },
                "contact_person_email": { email: true },
                "contact_person_mobile": { minlength: 6, maxlength: 12, digits: true },
            }
        });
    }
    if($("#housekeeping-item-form")[0] != undefined){
        $("#housekeeping-item-form").validate({
            rules: {
                "name": { required: true }
            }
        });
    }
    if($("#housekeeping-order-form")[0] != undefined){
        $("#housekeeping-order-form").validate({
            rules: {
                "housekeeping_items": { required: true },
                "room_id": { required: true },
                "housekeeping_status_id": { required: true },
                "housekeeper_id": { required: true },
            }
        });
    }
    if($("#laundry-item-form")[0] != undefined){
        $("#laundry-item-form").validate({
            rules: {
                "name": { required: true }
            }
        });
    }
    if($("#laundry-order-form")[0] != undefined){
        $("#laundry-order-form").validate({
            rules: {
                "guest_type": { required: true },
                "selected_customer_id": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('existing');
                        }
                    },
                },
                "customer_name": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('new');
                        }
                    },
                    minlength: 2, 
                    maxlength: 50,
                },
                "customer_mobile": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('new');
                        }
                    },
                    minlength: 6, 
                    maxlength: 12, 
                    digits: true
                },
                "customer_gender": { 
                    required: {
                        depends: function(element) {
                          return checkGuestType('new');
                        }
                    },
                },
                "laundry_items": { required: true },
                "vendor_id": { required: true },
                "order_status": { required: true },
                "order_date": { required: true },
                "received_date": { required: true },
                "item[ids][]": { required: true },
                "item[sent_qty][]": { required: true },
                "item[rcv_qty][]": { required: true },
                "item[price][]": { required: true },
            }
        });
    }
    if($("#season-form")[0] != undefined){
        $("#season-form").validate({
            rules: {
                "name": { required: true },
                "start_date": { required: true },
                "end_date": { required: true },
                "week_days[]": { required: true },
            }
        });
    }
/* ***** end form validations ***** */

/* ***** start swal alert ***** */
    $(document).on('click','.delete_btn',function(){
    	var deleteUrl = $(this).data('url');
    	swal({
    	  title: 'Are you sure?',
    	  text: "You won't be able to revert this!",
    	  type: 'warning',
    	  showCancelButton: true,
    	  confirmButtonColor: '#3085d6',
    	  cancelButtonColor: '#d33',
    	  confirmButtonText: 'Yes, delete it!'
    	}).then(function (result) {
    	  if (result.value) {
    	    window.location.href=deleteUrl;
    	  }
    	});
    });
    $(document).on('click','.confirm_btn',function(){
        var url = $(this).data('url');
        swal({
          title: 'Are you sure?',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Confirm!'
        }).then(function (result) {
          if (result.value) {
            window.location.href=url;
          }
        });
    });
    $(document).on('click','.confirm_form',function(event){
        event.preventDefault();
        const formId = $(this).data('form');
        swal({
          title: 'Are you sure?',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Confirm!'
        }).then(function (result) {
          if (result.value) {
            $('#'+formId).submit();
          }
        });
    });
/* ***** start swal alert ***** */

/* ***** start custom functions ***** */
    function checkGuestType(type){
        return ($("input[name='guest_type']:checked").val()==type) ? true : false;
    }
    function getMaxDiscount(amount,perc=20){
        //var maxDiscount = (perc/100)*amount;
        var maxDiscount = amount;
        return maxDiscount;
    } 
    function initDatePicker(){
        if($('.datepicker')[0] != undefined){
            $('.datepicker').datepicker({
              format: 'yyyy-mm-dd',
              autoclose: true
            })
        }
    }
    function cleanCache(){
        globalFunc.ajaxCall('api/clean-cache','', 'GET', globalFunc.before, globalFunc.successCache, globalFunc.error, globalFunc.complete);
    }
  globalFunc.successCache=function(data){
    console.log(data);
  }
  if(current_segment === 'set-siteconfig'){
    cleanCache();
  }
/* ***** end custom functions ***** */


/* ***** start js room_reservation_view page ***** */
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
    });
/* ***** end js room_reservation_view page ***** */

$(document).on('click', '.select-room', async function(event) {
    globalVar.selectBtnRef = $(this);
    const {date_from, date_to, adults, children, location} = getSetUrlParams('search-rooms');
    const post_data={
        user_id:globalVar.selectBtnRef.data('userid'), 
        room_id:globalVar.selectBtnRef.data('roomid'), 
        date_from,
        date_to,
        adults,
        children,
        location,
    };
    globalFunc.ajaxCall('api/add-to-cart',post_data, 'POST', globalFunc.before, globalFunc.successAddRemoveCart, globalFunc.error, globalFunc.complete);
});
globalFunc.successAddRemoveCart=function(res){
    const { action, datalist } = res;
    console.log(res, datalist.length);
    if(action === 'added'){
        globalVar.selectBtnRef.addClass('btn-success').removeClass('btn-primary');
        globalVar.selectBtnRef.text('Selected');
    } else {
        globalVar.selectBtnRef.addClass('btn-primary').removeClass('btn-success');
        globalVar.selectBtnRef.text('Select');
    }
    const bookBtnRef = $('.book-now');
    if(datalist.length){
        bookBtnRef.show();
    } else {
        bookBtnRef.hide();
    }
    populateSelectedRooms(datalist);
    globalVar.selectBtnRef = null;
}

// populate cart list on page load/reload
if(globalVar.cartList){
    populateSelectedRooms(globalVar.cartList)
}
function populateSelectedRooms(datalist){
    $('#selected_rooms_list').html('');
    let totalAmount = 0;
    datalist.map((val,key)=>{
        const roomTypeId = val?.room?.room_type_id || 0;
        const roomName = val?.room?.room_name || '';
        const durationOfStay = val?.duration_of_stay || 0;
        const basePrice = val?.room?.room_type?.base_price || 0;
        const roomWithPriceInfo = globalVar.roomWithPriceList[roomTypeId];
        const amount = parseFloat(roomWithPriceInfo['total_price']);
        totalAmount += amount;
        $('#selected_rooms_list').append('<tr>\
                <td class="text-center">'+(key+1)+'</td>\
                <td class="text-center">'+roomName+'</td>\
                <td class="text-center">'+durationOfStay+'</td>\
                <td class="text-right"></td>\
                <td class="text-right">'+parseFloat(amount).toFixed(2)+'</td>\
            </tr>');
    });
    const {gst, cgst} = getCalculatedGst(totalAmount);
    $('#selected_rooms_list').append('<tr>\
                <th colspan="4" class="text-right">GST ('+globalVar.gstPercent+'%)</th>\
                <td class="text-right">'+parseFloat(gst).toFixed(2)+'</td>\
            </tr>\
            <tr>\
                <th colspan="4" class="text-right">CGST ('+globalVar.cgstPercent+'%)</th>\
                <td class="text-right">'+parseFloat(cgst).toFixed(2)+'</td>\
            </tr>\
            <tr>\
                <th colspan="4" class="text-right">Grand Total</th>\
                <td class="text-right">'+parseFloat(totalAmount+gst+cgst).toFixed(2)+'</td>\
            </tr>');

}
function getCalculatedGst(amount){
      const gst = (globalVar.gstPercent/100)*parseFloat(amount);
      const cgst = (globalVar.cgstPercent/100)*parseFloat(amount);
      return {gst, cgst}
}
function getSetUrlParams(page, key=null){
    if (location.href.includes('?')) { 
        let url = new URL(location.href);
        url.searchParams.delete('booknow');
        history.pushState({}, null, url.href); 
    }

    if (typeof window.URLSearchParams === 'undefined') {
        return;
    }
    const urlParams = new window.URLSearchParams(window.location.search);
    if(key){
        return urlParams.get(key);
    }
    if(page === 'search-rooms'){
        const dateParam = urlParams.get('dates');
        const dates = {from: "", to: ""};
        if(dateParam){
            const splitDates = dateParam.split('/');
            dates.from = splitDates[0].trim();
            dates.to = splitDates[1].trim();
        }

        const obj = {
            date_from: dates.from,
            date_to: dates.to,
            adults: urlParams.get('adults'),
            children: urlParams.get('children'),
            location: urlParams.get('location'),
        };
        $('#booking_dates').text(dateParam);
        $('#booking_adults').text(obj.adults);
        $('#booking_kids').text(obj.children);
        return obj;
    }
    return urlParams;
}

//read notifications
$(document).on('click', '.notifi-list', async function(event) {
    const post_data={
        user_id: $(this).data('userid'), 
    };
    globalFunc.ajaxCall('api/read-notifications',post_data, 'POST', globalFunc.before, globalFunc.successReadNotifications, globalFunc.error, globalFunc.complete);
});
globalFunc.successReadNotifications=function(res){
    const { notifiData } = res;
    console.log(res);
}


//local storage functions
async function setLocalItem(key, value){
    await window.localStorage.setItem(key, value);
}
async function getLocalItem(key){
    const data = await window.localStorage.getItem(key);
    return data;
}
async function removeLocalItem(key){
    await window.localStorage.removeItem(key);
}