function getRoomtypes() {
    $.ajax({
        type: "post",
        url: "php/roomprice_operations.php",
        data: "get",
        success: function(data, status) {            
            var data = JSON.parse(data);

            var tablecontent = "";
            var listcontent = "";

            data.forEach(element => {
                tablecontent += "<tr>"
                tablecontent += "<td>" + element.roomtype + "</td>"
                tablecontent += "<td>" + element.price + "</td>"
                tablecontent += "</tr>" 

                listcontent += "<option value='" + element.roomtype + "'></option>";
            });



            $("#tablecontent").html(tablecontent);
            $("#roomtypelist").html(listcontent);
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

function addRoomtype() {
    var form = $("#roompriceform");
    var formData = form.serialize();
    formData += "&update";

    $.ajax({
        type: "post",
        url: "php/roomprice_operations.php",
        data: formData,
        success: function(data, status) {  
            console.log(data);
            if(data == "err-notvalid") {
                form.prop("class", "needs-validation w-100 was-validated"); 
            }      
            else if(data == "err-price") {
                form.prop("class", "needs-validation w-100 was-validated");
                vt.error("Please put a valid price", {position: "top-center", duration: 2000});
            }   
            else if(data == "true") {
                form.prop("class", "needs-validation w-100 was-validated");
                vt.success("Room price updated", {position: "top-center", duration: 2000});
                getRoomtypes();
            }  
            else {
                form.prop("class", "needs-validation w-100");
                $("#tablecontent").html(data);
            } 
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}

getRoomtypes();
