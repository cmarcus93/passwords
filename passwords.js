function changepw(id) {
    $('#exampleModal').modal('show')
    $('#dn').val(id);
}
function submit() {
    $.post( "index.php?mode=changePass", { 
        dn: $('#dn').val(), 
        pass:  $('#exampleInputPassword1').val()
    })
    .done(function( data ) {
        $('#results').html( data );
        $('#exampleInputPassword1').val("");
    });
}

table =  $('#example').DataTable( {
    "ajax": "index.php?mode=json",
    "dom": "ftplr",
    "order": [[ 0, "asc" ]],
    "pageLength": 200,
    "select": false,
    "columns": [
        { "data": "samaccountname" },
        { "data": "sn" },
        { "data": "givenname" },
        { "data": "mail" },
        { "data": "samaccountname", "render": function (data) { return '<button class="btn btn-sm btn-success" onclick="changepw(\'' + data + '\');">Reset</button>'; } }
    ]
} );