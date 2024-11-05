function saveData(id) {
    const username = $('#username').val();
    const bio = $('#bio').val();
    const password = $('#password').val();

    $.ajax({
        url: "/alumni_save-changes.php",
        type: "POST",
        data: {
            username: username,
            bio: bio,
            id: id, 
            password: password,
        },
        success: function(response) {
            alert(response);
        }
    });
}
