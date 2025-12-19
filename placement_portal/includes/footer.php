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

    // Restore simple filter function for non-paginated tables or legacy support
    function filterTable(inputId, tableId) {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById(inputId);
        filter = input.value.toUpperCase();
        table = document.getElementById(tableId);
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) { // Start at 1 to skip header
            var rowVisible = false;
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        rowVisible = true;
                        break;
                    }
                }
            }
            tr[i].style.display = rowVisible ? "" : "none";
        }
    }

    class TableExporter {
        constructor(tableId, filename = 'export') {
            this.tableId = tableId;
            this.filename = filename;
        }

        getData() {
            // Check if managed by TableManager to get filtered data
            if(window.tableManagers && window.tableManagers[this.tableId]) {
                const manager = window.tableManagers[this.tableId];
                // Get headers
                const headers = Array.from(manager.table.querySelectorAll('thead th')).map(th => th.innerText);
                // Get data from filtered rows
                const data = manager.filteredRows.map(row => 
                    Array.from(row.querySelectorAll('td')).map(td => td.innerText)
                );
                return { headers, data };
            }

            // Fallback to simple DOM scraping (visible rows only?)
            // If user wants "selected data", and no TableManager, we assume visible rows are what they want.
            const table = document.getElementById(this.tableId);
            const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.innerText);
            
            // Get visible rows only if no manager, or all rows? 
            // Let's get all rows associated with tbody for fallback
            const rows = Array.from(table.querySelectorAll('tbody tr'))
                .filter(tr => tr.style.display !== 'none') // Respect current filter
                .map(row => Array.from(row.querySelectorAll('td')).map(td => td.innerText));
                
            return { headers, data: rows };
        }

        exportToExcel() {
            try {
                if(typeof XLSX === 'undefined') { alert('Error: XLSX library not loaded.'); return; }
                
                const { headers, data } = this.getData();
                
                // Add Title Row
                const title = [this.filename.toUpperCase().replace(/_/g, ' ')];
                const exportData = [title, [], headers, ...data]; // Title, Empty row, Headers, Data
                
                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.aoa_to_sheet(exportData);
                
                // Merge title cells
                if(!ws['!merges']) ws['!merges'] = [];
                ws['!merges'].push({ s: {r:0, c:0}, e: {r:0, c:headers.length-1} });
                
                XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
                XLSX.writeFile(wb, this.filename + '.xlsx');
            } catch(e) {
                console.error(e);
                alert('Export Error: ' + e.message);
            }
        }

        exportToCSV() {
            this.exportToExcel(); // CSV is similar enough for simple use case, or use specific CSV writer if needed.
            // Actually let's just use the same logic but save as CSV if XLSX supports it easily, 
            // but standard XLSX.writeFile can save as CSV based on extension.
            // However, the function name suggests specific behavior.
            
            try {
                if(typeof XLSX === 'undefined') { alert('Error: XLSX library not loaded.'); return; }
                
                const { headers, data } = this.getData();
                const ws = XLSX.utils.aoa_to_sheet([headers, ...data]);
                const csv = XLSX.utils.sheet_to_csv(ws);
                
                // Download manually
                const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
                const link = document.createElement("a");
                const url = URL.createObjectURL(blob);
                link.setAttribute("href", url);
                link.setAttribute("download", this.filename + ".csv");
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } catch(e) {
                console.error(e);
                alert('Export Error: ' + e.message);
            }
        }

        exportToPDF() {
            try {
                if(typeof window.jspdf === 'undefined') { alert('Error: jsPDF library not loaded.'); return; }
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                
                const { headers, data } = this.getData();
                
                doc.autoTable({
                    head: [headers],
                    body: data,
                    startY: 20,
                    theme: 'striped',
                    headStyles: { fillColor: [41, 128, 185], fontStyle: 'bold' }, // Primary Color
                    didDrawPage: (data) => {
                        // Header
                        doc.setFontSize(18);
                        doc.text(this.filename.toUpperCase().replace(/_/g, ' '), 14, 15);
                        
                        // Footer
                        const str = 'Page ' + doc.internal.getNumberOfPages();
                        doc.setFontSize(10);
                        const pageSize = doc.internal.pageSize;
                        const pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();
                        doc.text(str, data.settings.margin.left, pageHeight - 10);
                        doc.text('Generated: ' + new Date().toLocaleDateString(), 150, pageHeight - 10);
                    }
                });
                
                doc.save(this.filename + '.pdf');
            } catch(e) {
                console.error(e);
                alert('PDF Export Error: ' + e.message);
            }
        }
    }
    </script>
</body>
</html>
