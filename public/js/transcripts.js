if ($("#transcripts_listing").length > 0) {
    $("#transcripts_listing").DataTable({
        "columnDefs": [{
            "orderable": false,
            "targets": [7]
        }],
        "bFilter": false,
        "bPaginate": false,
    });
};

$(document).on('click', '#custom_transcripts_listing .pagination a', function() {
    event.preventDefault();
    var page = checkParam('page', $(this).attr('href'));
    var keyword = checkParam('keyword', $(this).attr('href'));
    var url = keyword;
    loadNext(page, url);
});

function checkParam(name, url) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(url);
    return (results != null) ? decodeURIComponent(results[1]) : '';
}

function loadNext(page, keyword) {
    var currentURL = window.location.href;
    var urlChunk = currentURL.split("/").slice(-2, -1)[0];
    $.ajax({
        method: "GET",
        url: routes.fetchCertification + '?page=' + page + '&keyword=' + keyword + '&urlChunk=' + urlChunk,
        success: function(data) {
            $("#custom_users_listing").html(data);
            $("#users_listing").DataTable({
                "columnDefs": [{
                    "orderable": false,
                    "targets": [6]
                }],
                "bFilter": false,
                "bPaginate": false,
            });
        }
    });
}

function search_data(url = '') {
    $.ajax({
        method: "GET",
        url: routes.fetchUsers + '?keyword=' + url,
        success: function(response) {
            $("#custom_users_listing").html(response);
            $("#users_listing").DataTable({
                "columnDefs": [{
                    "orderable": false,
                    "targets": [7]
                }],
                "bFilter": false,
                "bPaginate": false,
            });
        }
    });
}

$("#search_users").click(function() {
    event.preventDefault();
    var keyword = $("#keyword").val();
    var country = $("#country").find(":selected").val();
    var state = $("#state").find(":selected").val();
    var city = $("#city").find(":selected").val();
    var verified = $("#verified").find(":selected").val();
    var is_approved = $("#is_approved").find(":selected").val();
    var last_login = $("#last_login").find(":selected").val();
    var last_sign_in = $("#last_sign_in").val();

    var url = keyword + '&country=' + country + '&state=' + state + '&city=' + city + '&verified=' + verified + '&is_approved=' + is_approved + '&last_login=' + last_login + '&last_sign_in=' + last_sign_in;
    search_data(url);
});




