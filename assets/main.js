$('document').ready(function () {
    var main_content = $('#main_content');
    //add click handler to save_task button
    $("#save_task").click(function () { 
        //get all the values from the form and add them to our data object for sending
        var todoadd = $("#todo-add");
        var form_data = {
                title: todoadd.find("input[name=title]").val(),
                date: todoadd.find("input[name=date]").val(),
                details: todoadd.find("textarea[name=details]").val(),
            } 
        
        //send our data to the add.php file
        $.ajax({
            url: 'actions/add.php', 
            data: form_data, 
            dataType: 'json', 
            cache: false, 
            method: 'POST', 
            success: function (data) { 
                console.log(data);
                todoadd.find("input[name=title]").val(" ");
                todoadd.find("input[name=date]").val(" ");
                todoadd.find("textarea[name=details]").val(" ");
                $("#display_refresh").click();
            }
        });
    }); //end of click handler

    $("#display_refresh").click(function () { //add a click handler to our data display button

        //get our data from the get.php file
        $.ajax({
            url: 'actions/get.php', 
            dataType: 'json',
            cache: false, 
            method: 'POST', 
            success: function (data) { 
                if (data.success) {
                    //take the html object of the data object, and put it into the display container
                    $("#todo-display > .display_container").html(data.html); 
                }
            }
        });

    });

    $("#display_refresh").click();

    main_content.on('click', '#btn_delete', function () {
        var listName = $(this).parent().attr('data-id');
        console.log(listName);
        var dataID = {
            dataid: listName
        }
        $(this).parent().addClass('deleting');
        var confirm = window.confirm("Are you sure you want to delete?");
        if(confirm){
        $.ajax({

            url: 'actions/remove.php',
            data: dataID,
            dataType: 'json', 
            cache: false,
            method: 'POST',
            success: function (data) {
                console.log(data);
                console.log("Deleted!");
                $("#display_refresh").click();

            },
            failure: function () {
                alert("Didnt receive anything back");
            }
        });
        }
        else{
            $(this).parent().removeClass('deleting');
        }
    });
    $("#display_refresh").click();

});