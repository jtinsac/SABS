<aside class="sidebar">
    <ul>
        <li><a href="index.php?page=dashboard">Dashboard</a></li>
        <li>
            <div class="sidebar-dropdown" onclick="toggleDropdown()">
                <span>Documents</span>
                <span class="arrow" id="arrow">&#9660;</span>
            </div>
            <ul class="dropdown" id="dropdown">
                <li><a href="index.php?page=outgoing">Outgoing</a></li>
                <li><a href="index.php?page=incoming">Incoming</a></li>
                <li><a href="index.php?page=received">Received</a></li>
            </ul>
        </li>
    </ul>
</aside>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown');
        const arrow = document.getElementById('arrow');
        dropdown.classList.toggle('open');
        arrow.innerHTML = dropdown.classList.contains('open') ? '&#9650;' : '&#9660;';
    }
</script>
