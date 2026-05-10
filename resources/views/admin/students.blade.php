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
.title{
    font-size:20px;
    font-weight:800;
    color:#111827;
    margin-bottom:18px;
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

/* ROLE BADGES */
.badge{
    padding:5px 10px;
    border-radius:999px;
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
}

.admin{
    background:#fee2e2;
    color:#991b1b;
}

.student{
    background:#dbeafe;
    color:#1e40af;
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

        <a href="/admin/items"> Dashboard</a>
        <a href="/admin/claims"> Claims</a>
        <a href="/admin/students" class="active"> Students</a>
    </div>

    <!-- MAIN -->
    <div class="main">

        <div class="title">Students List</div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td><b>{{ $student->name }}</b></td>
                            <td>{{ $student->email }}</td>

                            <td>
                                <span class="badge {{ $student->role }}">
                                    {{ strtoupper($student->role) }}
                                </span>
                            </td>

                            <td>{{ $student->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;color:#6b7280;">
                                No students found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>

</x-app-layout>