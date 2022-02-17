function notify() {
    swal({
        title: "Hash Was Not Generated",
        text: "Do not fill the form until the hash is generated",
        type: "warning",
        button: "Ok",
        timer: 2000
    });
}

function hashgen(id) {
    var payload = document.getElementById('uname').value + id
    var data = $.ajax({
        type: "POST",
        url: "hash.php",
        data: {
            data: payload
        },
        cache: false,
        success: function (data) {
         
                function notify(data) {                                                                                 
                swal({
                title: 'K Id Generated successfully',
                text: 'K Id:'+data,
                type: "success",
                 button: "Ok",
                })
                }
                notify(data)
            },
            error: function (xhr, status, error) {
                console.error(xhr);
                    function notify() {                                                                                 
                    swal({
                    title: 'K Id Generation failed',
                    text: 'Take a screenshot for future reference',
                    type: "error",
                     button: "Ok",
                    })
                    } 
                    notify()
            }
    });

}

function updt(oid, id) {
    var name = document.getElementById('uname').value
    var gender = document.getElementById('gender').value
    var language = document.getElementById('lang').value
    var place = document.getElementById('place').value
    var dob = document.getElementById('DD').value + "/" + document.getElementById('MM').value + "/" + document.getElementById('YYYY').value
    var tob = document.getElementById('HR').value + ":" + document.getElementById('MINS').value + ":" + document.getElementById('SECS').value
    var orderid = oid;
    var transactionid = id;

    document.getElementById('V_Place').value = document.getElementById('place').value
    $.ajax({
        type: "POST",
        url: "./updt.php",
        data: {
            name: name,
            gender: gender,
            language: language,
            place: place,
            dob: dob,
            tob: tob,
            orderid: orderid,
            transactionid: transactionid,
            modules:'M096'
        },
        cache: false,
        success: function (data) { alert(data);},
        error: function (xhr, status, error) {
            console.error(xhr);
        }
    });

}

function updt_horo(oid, id) {
    var name = document.getElementById('uname').value
    var gender = document.getElementById('gender').value
    var language = document.getElementById('lang').value
    var place = document.getElementById('place').value
    var dob = document.getElementById('DD').value + "/" + document.getElementById('MM').value + "/" + document.getElementById('YYYY').value
    var tob = document.getElementById('HR').value + ":" + document.getElementById('MINS').value + ":" + document.getElementById('SECS').value
    var orderid = oid;
    var transactionid = id;

    document.getElementById('V_Place').value = document.getElementById('place').value
    $.ajax({
        type: "POST",
        url: "/EKundali/updt.php",
        data: {
            name: name,
            gender: gender,
            language: language,
            place: place,
            dob: dob,
            tob: tob,
            orderid: orderid,
            transactionid: transactionid,
            modules:'DH096'
        },
        cache: false,
        success: function (data) { alert(data);},
        error: function (xhr, status, error) {
            console.error(xhr);
        }
    });

}

$.getJSON('https://ipapi.co/json/', function (data) {
    document.getElementById('timezone').value = data.timezone;
});


function getlat() {
    var query = document.getElementById("place").value;
    var url = 'https://geocode.search.hereapi.com/v1/geocode?apiKey=FFkUHgsK5UIL0lE8D51BPEr9kQ_-_rZpLdEeYMnE5UE&q=' + query
    async function resp() {
        const response = await fetch(url)
        const data = await response.json()
        console.log(data)
        var Lat = data.items[0].position.lat
        var Lon = data.items[0].position.lng
        window.value = data.items[0].title

        document.getElementById("Latitude").value = Lat
        document.getElementById("Longitude").value = Lon
    }
    resp();

}

$(document).on('change', 'input', function () {
    updatedata();
});

function updatelocation() {
    const placeupdate = document.querySelector('input[id="place"]');
    placeupdate.addEventListener('blur', (event) => {
        document.getElementById("place").value = window.value;

    });
}

(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

document.addEventListener('load', () => {
    if (uname.value.length > 0) {
        pay_init.removeAttribute('disabled');

    }

    if (tr_id.value.length > 0) {
        Cnfrm.removeAttribute('disabled');
    }
    else {
        Cnfrm.setAttribute("disabled", "disabled")
    }
})
document.addEventListener('input', () => {
    if (uname.value.length > 0) {
        pay_init.removeAttribute('disabled');

    }

    if (tr_id.value.length > 0) {
        Cnfrm.removeAttribute('disabled');
    }
    else {
        Cnfrm.setAttribute("disabled", "disabled")
    }
})



function updatedata() {
    document.getElementById('V_Name').value = document.getElementById('uname').value
    document.getElementById('V_Gender').value = document.getElementById('gender').value
    document.getElementById('V_Lang').value = document.getElementById('lang').value
    document.getElementById('V_Dob_DD').value = document.getElementById('DD').value
    document.getElementById('V_Dob_MM').value = document.getElementById('MM').value
    document.getElementById('V_Dob_YYYY').value = document.getElementById('YYYY').value
    document.getElementById('V_Tob_Hour').value = document.getElementById('HR').value
    document.getElementById('V_Tob_Mins').value = document.getElementById('MINS').value
    document.getElementById('V_Tob_Sec').value = document.getElementById('SECS').value
    document.getElementById('V_Lati').value = document.getElementById('Latitude').value
    document.getElementById('V_Longi').value = document.getElementById('Longitude').value
    document.getElementById('V_Timezone').value = document.getElementById('timezone').value
    document.getElementById('V_Place').value = document.getElementById('place').value
}

