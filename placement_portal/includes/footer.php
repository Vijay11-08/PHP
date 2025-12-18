    <?php if (isset($isPublicPage) && $isPublicPage): ?>
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Placement Portal</h4>
                    <p>Connecting talent with opportunity.</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact Us</h4>
                    <p>Email: info@placementportal.com</p>
                    <p>Phone: +1 234 567 890</p>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; <?php echo date('Y'); ?> Placement Portal. All rights reserved.
            </div>
        </div>
    </footer>
    <?php endif; ?>
    </div> <!-- End Main Content/Container -->
    </div> <!-- End Dashboard Container -->

    <script>
    class TableManager {
        constructor(config) {
            this.tableId = config.tableId;
            this.searchId = config.searchId;
            this.rowsSelectId = config.rowsSelectId;
            this.paginationId = config.paginationId;
            
            this.table = document.getElementById(this.tableId);
            this.tbody = this.table.querySelector('tbody');
            this.rows = Array.from(this.tbody.getElementsByTagName('tr'));
            this.pageSize = 10;
            this.currentPage = 1;
            this.filteredRows = this.rows; // Initially all rows

            this.init();
        }

        init() {
            // Bind Search
            if(this.searchId) {
                document.getElementById(this.searchId).addEventListener('keyup', (e) => this.handleSearch(e));
            }

            // Bind Row Selection
            if(this.rowsSelectId) {
                const select = document.getElementById(this.rowsSelectId);
                select.addEventListener('change', (e) => {
                    this.pageSize = parseInt(e.target.value);
                    this.currentPage = 1;
                    this.render();
                });
                this.pageSize = parseInt(select.value) || 10;
            }

            this.render();
        }

        handleSearch(e) {
            const term = e.target.value.toUpperCase();
            
            // Filter logic
            this.filteredRows = this.rows.filter(row => {
                // If row has display:none from some other logic (like tabs), ignore it? 
                // For now, simple text search across all cells
                return row.innerText.toUpperCase().indexOf(term) > -1;
            });

            // Specific logic for Manage Users: check data attributes if they exist (handled by server filters usually, but let's keep it robust)
            // If the user uses the dropdown filters in manage_users, they hide rows directly. 
            // We should respect currently visible rows if possible, but the previous filterUsers() was simple.
            // Let's assume this manager takes full control of visibility.
            
            this.currentPage = 1;
            this.render();
        }

        render() {
            // 1. Hide all rows first
            this.rows.forEach(r => r.style.display = 'none');

            // 2. Calculate pagination
            const total = this.filteredRows.length;
            const totalPages = Math.ceil(total / this.pageSize);
            
            // Ensure current page is valid
            if (this.currentPage > totalPages) this.currentPage = max(1, totalPages);

            const start = (this.currentPage - 1) * this.pageSize;
            const end = start + this.pageSize;

            // 3. Show slice of filtered rows
            this.filteredRows.slice(start, end).forEach(r => r.style.display = '');

            // 4. Render Pagination Controls
            this.renderPagination(totalPages);
        }

        renderPagination(totalPages) {
            const container = document.getElementById(this.paginationId);
            if(!container) return;

            let html = '';
            
            // Prev
            html += `<li class="page-item ${this.currentPage === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="tableManagers['${this.tableId}'].gotoPage(${this.currentPage - 1})">Previous</a>
                     </li>`;

            // Pages
            for(let i=1; i<=totalPages; i++) {
                 // Simple logic: show all. complex logic: show range. user asked for simple.
                 if(totalPages > 10 && Math.abs(this.currentPage - i) > 2 && i !== 1 && i !== totalPages) {
                     if(html.slice(-3) !== '...') html += '<li class="page-item disabled"><span class="page-link">...</span></li>';
                     continue;
                 }
                 
                 html += `<li class="page-item ${this.currentPage === i ? 'active' : ''}">
                            <a class="page-link" href="#" onclick="tableManagers['${this.tableId}'].gotoPage(${i})">${i}</a>
                          </li>`;
            }

            // Next
            html += `<li class="page-item ${this.currentPage === totalPages || totalPages === 0 ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="tableManagers['${this.tableId}'].gotoPage(${this.currentPage + 1})">Next</a>
                     </li>`;
            
            container.innerHTML = `<nav><ul class="pagination justify-content-end">${html}</ul></nav>`;
            
            // Update info text if exists
            const info = document.getElementById(this.tableId + '_info');
            if(info) {
                const start = (this.currentPage - 1) * this.pageSize + 1;
                const end = Math.min(start + this.pageSize - 1, this.filteredRows.length);
                info.innerText = totalPages > 0 ? `Showing ${start} to ${end} of ${this.filteredRows.length} entries` : 'No entries found';
            }
        }

        gotoPage(page) {
            if(page < 1) return;
            // Max page check is done in render
            this.currentPage = page;
            this.render();
        }
    }

    // Global registry for inline onclick handlers
    window.tableManagers = {};
    </script>
</body>
</html>
