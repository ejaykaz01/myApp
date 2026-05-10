<x-app-layout>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
body{
    margin:0;
    font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial;
    background:linear-gradient(180deg,#f5f6f8,#eef1f5);
}

/* ===== ADMIN LAYOUT ===== */
.admin-layout{
    display:flex;
    min-height:100vh;
}

/* ===== SIDEBAR ===== */
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

/* ===== MAIN WRAPPER ===== */
.main{
    flex:1;
    padding:30px;
}

/* HEADER */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:18px;
}

.title{
    font-size:20px;
    font-weight:800;
    color:#111827;
}

/* FILTERS */
.filters{
    display:flex;
    gap:8px;
    background:#fff;
    padding:6px;
    border-radius:12px;
    border:1px solid #e5e7eb;
}

.filters button{
    border:none;
    background:transparent;
    padding:8px 14px;
    border-radius:10px;
    cursor:pointer;
    font-size:13px;
    font-weight:600;
    color:#6b7280;
}

.filters button.active{
    background:#111827;
    color:#fff;
}

/* TABLE */
.table-card{
    background:#fff;
    border-radius:16px;
    border:1px solid #e5e7eb;
    overflow:hidden;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    text-align:left;
    font-size:12px;
    text-transform:uppercase;
    color:#6b7280;
    background:#f9fafb;
    padding:14px;
}

td{
    padding:14px;
    font-size:13px;
    border-top:1px solid #f1f1f1;
}

tr:hover{
    background:#f9fafb;
}

/* BADGES */
.badge{
    padding:5px 10px;
    border-radius:999px;
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
}

.lost{background:#fee2e2;color:#b91c1c;}
.found{background:#dcfce7;color:#166534;}

.pending{background:#fef3c7;color:#92400e;}
.approved{background:#dbeafe;color:#1e40af;}
.rejected{background:#fee2e2;color:#991b1b;}
.solved{background:#dcfce7;color:#065f46;}

/* BUTTONS */
.btn{
    padding:6px 10px;
    font-size:12px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
}

.approve{background:#16a34a;color:#fff;}
.reject{background:#dc2626;color:#fff;}
.delete{background:#ef4444;color:#fff;}

.btn:hover{
    opacity:0.85;
}


/* =========================
   RESPONSIVE FIX (NO DESIGN CHANGE)
========================= */

/* tablets + small laptops */
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

    .main {
        padding: 18px;
    }

    .topbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .filters {
        width: 100%;
        overflow-x: auto;
    }

    .filters button {
        white-space: nowrap;
    }
}

/* mobile */
@media (max-width: 768px) {

    .table-card {
        overflow-x: auto;
    }

    table {
        min-width: 800px;
    }

    td, th {
        font-size: 12px;
        padding: 10px;
    }

    .btn {
        font-size: 11px;
        padding: 5px 8px;
    }

    .title {
        font-size: 16px;
    }
}

/* very small phones */
@media (max-width: 480px) {

    .sidebar {
        flex-wrap: wrap;
        justify-content: center;
    }

    .filters {
        flex-wrap: wrap;
    }

    .filters button {
        flex: 1;
    }
}
</style>

<div class="admin-layout">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Admin Panel</h2>

        <a href="/admin/items" class="active">Dashboard</a>
        <a href="/admin/claims" >Claims</a>
        <a href="/admin/students" >Students</a>
    </div>

    <!-- MAIN -->
    <div class="main">

        <div class="topbar">
            <div class="title">Admin Dashboard</div>

            <div class="filters">
                <button class="active" onclick="loadData('all')">All</button>
                <button onclick="loadData('pending')">Pending</button>
                <button onclick="loadData('approved')">Approved</button>
                <button onclick="loadData('rejected')">Rejected</button>
            </div>
        </div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>User</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="tableBody"></tbody>
            </table>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

let currentFilter = 'all';

function loadData(status='all'){
    currentFilter = status;

    $.get('/admin/items/data',{status:status},function(res){

        let rows='';

        res.data.forEach(item=>{
            rows+=`
            <tr>
                <td>${item.id}</td>
                <td><b>${item.title}</b></td>

                <td><span class="badge ${item.type}">${item.type}</span></td>
                <td><span class="badge ${item.status}">${item.status}</span></td>

                <td>${item.user_name}</td>
                <td>${item.created_at}</td>

                <td>
                    <button class="btn approve" onclick="approveItem(${item.id})">Approve</button>
                    <button class="btn reject" onclick="rejectItem(${item.id})">Reject</button>
                    <button class="btn delete" onclick="deleteItem(${item.id})">Delete</button>
                </td>
            </tr>`;
        });

        $('#tableBody').html(rows);
    });
}

/* APPROVE */
function approveItem(id){
    $.post('/admin/items/approve/'+id,{
        _token:$('meta[name="csrf-token"]').attr('content')
    },()=>loadData(currentFilter));
}

/* REJECT */
function rejectItem(id){
    $.post('/admin/items/reject/'+id,{
        _token:$('meta[name="csrf-token"]').attr('content')
    },()=>loadData(currentFilter));
}

/* DELETE */
function deleteItem(id){
    if(!confirm('Delete this item?')) return;

    $.ajax({
        url:'/admin/items/delete/'+id,
        method:'DELETE',
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        success:()=>loadData(currentFilter)
    });
}

loadData('all');

</script>

</x-app-layout>