<!DOCTYPE html>
<html>
<head>
    <title>Items</title>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>

<h2>Lost & Found Items</h2>

<form id="addForm">
    <input type="text" name="title" placeholder="Title" required>
    <input type="text" name="description" placeholder="Description">
    
    <select name="type">
        <option value="lost">Lost</option>
        <option value="found">Found</option>
    </select>

    <button type="submit">Add Item</button>
</form>

<hr>

<table id="itemsTable" border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Type</th>
            <th>Status</th>
            <th>User</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>

<script id="6v1t4e">
$(document).ready(function () {

    var table = $('#itemsTable').DataTable({
        ajax: '/items/data',
        columns: [
            { data: 'id' },
            { data: 'title' },
            { data: 'type' },
            { data: 'status' },
            { data: 'user_name' },
            {
                data: null,
                render: function(data) {
                    return `
                        <button onclick="editItem(${data.id})">Edit</button>
                        <button onclick="deleteItem(${data.id})">Delete</button>
                    `;
                }
            }
        ]
    });

   
    $('#addForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: '/items/store',
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function() {
                alert('Item added!');
                $('#addForm')[0].reset();
                table.ajax.reload();
            }
        });
    });


    window.deleteItem = function(id) {
        if(confirm('Delete this item?')) {
            $.ajax({
                url: '/items/delete/' + id,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function() {
                    table.ajax.reload();
                }
            });
        }
    };

});
</script>

</body>
</html>