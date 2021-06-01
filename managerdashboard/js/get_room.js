function getRoom() {
    var params = "doornumber=" + $("#doornumber").prop("value");
    
    $.ajax({
        type: "get",
        url: "php/get_room.php",
        data: params,
        success: function(data, status) {     
            var room = JSON.parse(data);
            
            var typeIndex = null;
            if(room.roomtype == "vip") typeIndex = 0;
            else if(room.roomtype == "family") typeIndex = 1;
            else if(room.roomtype == "double") typeIndex = 2;
            else if(room.roomtype == "single") typeIndex = 3;

            $("#newdoornumber").prop("value", room.doornumber);
            $("#floor").prop('selectedIndex',room.floor - 1);
            $("#roomtype").prop('selectedIndex', typeIndex);
        },
        error: function(xhr, desc, err) {
            console.log(desc);
        }
    });
}