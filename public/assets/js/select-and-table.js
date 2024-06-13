$(document).ready(function() {
    function fetchData(role, status) {
        let baseUrl = `/${role}/select-laporan-kejadian`; // Default base URL

        $.ajax({
            url: baseUrl,
            type: 'GET',
            data: { status: status },
            success: function(data) {
                const tbody = $('#data-table tbody');
                tbody.empty(); // Clear previous data

                data.forEach((item, index) => {
                    let statusClass = '';
                    switch(item.status) {
                        case 'Belum Diverifikasi':
                            statusClass = 'btn-danger';
                            break;
                        case 'On Process':
                            statusClass = 'btn-warning';
                            break;
                        case 'Selesai':
                            statusClass = 'btn-success';
                            break;
                        default:
                            statusClass = 'btn-secondary'; // Default or fallback class
                            break;
                    }

                    tbody.append(`
                        <tr class="${item.status === 'Terverifikasi' ? 'text-muted' : ''}">
                            <td>${index + 1}</td>
                            <td>${item.jenis}</td>
                            <td>${item.lokasi}</td>
                            <td>${item.waktu}</td>
                            <td>${item.update}</td>
                            <td>${item.keterangan}</td>
                            <td><p class="btn ${statusClass} btn-sm">${item.status}</p></td>
                            <td>
                                ${item.status === 'Belum Terverifikasi'
                                    ? `<a href="/${role}/edit-laporankejadian/${item.id}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-border-color"></i></a>
                                       <a href="/${role}/delete-laporankejadian/${item.id}" class="btn btn-danger btn-sm"><i class="menu-icon mdi mdi-delete"></i></a>`
                                    : `<a href="/${role}/edit-laporankejadian/${item.id}" class="btn btn-info btn-sm disabled"><i class="menu-icon mdi mdi-border-color"></i></a>
                                       <a href="/${role}/delete-laporankejadian/${item.id}" class="btn btn-danger btn-sm disabled"><i class="menu-icon mdi mdi-delete"></i></a>`
                                }
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(error) {
                console.log('Error fetching data:', error);
            }
        });
    }

    $('.dropdown-menu .dropdown-item').on('click', function() {
        const status = $(this).data('status');
        fetchData(userRole, status); // Use the userRole variable here
    });

    // Fetch all data on page load with default status ''
    fetchData(userRole, '');
});
