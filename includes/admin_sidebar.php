<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside id="sidebar"
    class="fixed md:static z-40 inset-y-0 left-0 w-64 bg-indigo-950 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 flex flex-col">

    <div class="p-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">Work Connect</h1>
            <p class="text-indigo-400 text-xs uppercase tracking-widest font-bold">Admin Control</p>
        </div>
        <button onclick="toggleSidebar()" class="md:hidden">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="flex-grow mt-6 px-4 space-y-2">
        <a href="dashboard.php"
           class="flex items-center space-x-3 p-3 rounded-xl <?php echo $current_page == 'dashboard.php' ? 'bg-indigo-800' : 'hover:bg-indigo-900'; ?> transition-colors">
            <i class="fas fa-chart-line"></i>
            <span>Overview</span>
        </a>
        <a href="users.php"
           class="flex items-center space-x-3 p-3 rounded-xl <?php echo $current_page == 'users.php' ? 'bg-indigo-800' : 'hover:bg-indigo-900'; ?> transition-colors">
            <i class="fas fa-users-cog"></i>
            <span>Manage Users</span>
        </a>
        <a href="jobs.php"
           class="flex items-center space-x-3 p-3 rounded-xl <?php echo $current_page == 'jobs.php' ? 'bg-indigo-800' : 'hover:bg-indigo-900'; ?> transition-colors">
            <i class="fas fa-briefcase"></i>
            <span>Moderate Jobs</span>
        </a>
        <a href="reports.php"
           class="flex items-center space-x-3 p-3 rounded-xl <?php echo $current_page == 'reports.php' ? 'bg-indigo-800' : 'hover:bg-indigo-900'; ?> transition-colors">
            <i class="fas fa-flag"></i>
            <span>Reports</span>
        </a>
    </nav>

    <div class="p-4 border-t border-indigo-900">
        <a href="../logout.php"
           class="flex items-center space-x-3 p-3 rounded-xl hover:bg-red-600 transition-colors">
            <i class="fas fa-sign-out-alt"></i>
            <span>System Logout</span>
        </a>
    </div>
</aside>

<div id="overlay" onclick="toggleSidebar()" 
     class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 md:hidden"></div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-translate-x-full');
    document.getElementById('overlay').classList.toggle('hidden');
}
</script>
