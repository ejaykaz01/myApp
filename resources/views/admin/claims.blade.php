<x-app-layout>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
body{
    margin:0;
    font-family:system-ui;
    background:#f5f6f8;
}


.admin-layout{
    display:flex;
    min-height:100vh;
}


.sidebar{
    width:240px;
    background:#111827;
    color:#fff;
    padding:18px;
    display:flex;
    flex-direction:column;
    gap:10px;
}

.sidebar h2{
    font-size:16px;
    margin-bottom:10px;
    font-weight:800;
}

.sidebar a{
    text-decoration:none;
    color:#cbd5e1;
    padding:10px 12px;
    border-radius:10px;
    font-size:13px;
    transition:.2s;
}

.sidebar a:hover{
    background:#1f2937;
    color:#fff;
}

.sidebar a.active{
    background:#374151;
    color:#fff;
    font-weight:600;
}


.wrapper{
    flex:1;
    max-width:1100px;
    margin:30px auto;
    padding:20px;
}


.title{
    font-size:20px;
    font-weight:800;
    margin-bottom:15px;
}


.card{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:12px;
    overflow:hidden;
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    padding:12px;
    font-size:13px;
    border-bottom:1px solid #eee;
}

th{
    background:#f9fafb;
    text-align:left;
}

.badge{
    padding:4px 10px;
    border-radius:999px;
    font-size:11px;
    font-weight:700;
}

.pending{background:#fef3c7;color:#92400e;}
.approved{background:#dcfce7;color:#166534;}
.rejected{background:#fee2e2;color:#991b1b;}


.btn{
    padding:6px 10px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-size:12px;
}

.approve{background:#16a34a;color:#fff;}
.reject{background:#dc2626;color:#fff;}




@media (max-width: 1024px) {

    .admin-layout {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        flex-direction: row;
        overflow-x: auto;
        align-items: center;
        gap: 8px;
    }

    .sidebar h2 {
        display: none;
    }

    .sidebar a {
        white-space: nowrap;
        font-size: 12px;
        padding: 8px 10px;
    }

    .wrapper {
        margin: 15px;
        padding: 10px;
    }

    .title {
        font-size: 18px;
    }
}

/* mobile */
@media (max-width: 768px) {

    .card {
        overflow-x: auto;
    }

    table {
        min-width: 700px;
    }

    th, td {
        font-size: 12px;
        padding: 10px;
    }

    .btn {
        font-size: 11px;
        padding: 5px 8px;
    }

    .badge {
        font-size: 10px;
    }
}


@media (max-width: 480px) {

    .sidebar {
        flex-wrap: wrap;
        justify-content: center;
    }

    .wrapper {
        margin: 10px;
        padding: 8px;
    }

    th, td {
        font-size: 11px;
    }
}

</style>

@php
    $path = request()->path();

    $section =
        str_starts_with($path, 'admin/items') ? 'dashboard' :
        (str_starts_with($path, 'admin/claims') ? 'claims' :
        (str_starts_with($path, 'admin/students') ? 'students' : ''));

@endphp

<div class="admin-layout">

    <div class="sidebar">
        <h2>Admin Panel</h2>

        <a href="/admin/items"
   class="{{ $section === 'dashboard' ? 'active' : '' }}">
     Dashboard
</a>

<a href="/admin/claims"
   class="{{ in_array($section, ['claims', 'dashboard']) ? 'active' : '' }}">
     Claims
</a>

<a href="/admin/students"
   class="{{ in_array($section, ['students', 'dashboard']) ? 'active' : '' }}">
     Students
</a>
    </div>

    <div class="wrapper">

        <div class="title">Claims Management</div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Claimed By</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($claims as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->item_title }}</td>
                        <td>{{ $c->user_name }}</td>
                        <td>{{ $c->message }}</td>

                        <td>
                            <span class="badge {{ $c->status }}">
                                {{ $c->status }}
                            </span>
                        </td>

                        <td>{{ $c->created_at }}</td>

                        <td>
                            <button class="btn approve" onclick="updateClaim({{ $c->id }},'approved')">Approve</button>
                            <button class="btn reject" onclick="updateClaim({{ $c->id }},'rejected')">Reject</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function updateClaim(id,status){
    $.post('/admin/claims/update/'+id,{
        _token:'{{ csrf_token() }}',
        status:status
    },function(){
        location.reload();
    });
}
</script>

</x-app-layout>